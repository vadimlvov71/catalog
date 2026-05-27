<template>
  <div>
    <button @click="showModal = true">Добавить запись</button>

    <div v-if="showModal" class="modal-overlay" @click.self="closeModal">
      <div class="modal-window">
        <h3>Добавить новую запись</h3>
        <form @submit.prevent="submitForm">
          <div>
            <label>Title:</label>
            <input v-model="form.title" @blur="checkUnique('title')" />
            <div v-if="errors.title" style="color:red">{{ errors.title }}</div>
          </div>

          <div>
            <label>URL:</label>
            <input v-model="form.url" @blur="checkUnique('url')" />
            <div v-if="errors.url" style="color:red">{{ errors.url }}</div>
          </div>

          <button type="submit" :disabled="loading || hasErrors">Сохранить</button>
          <button type="button" @click="closeModal">Отмена</button>

          <div v-if="loading">Проверка...</div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showModal: false,
      loading: false,
      form: {
        title: '',
        url: ''
      },
      errors: {}
    };
  },
  computed: {
    hasErrors() {
      return Object.keys(this.errors).length > 0;
    }
  },
  methods: {
    closeModal() {
      this.showModal = false;
      this.form.title = '';
      this.form.url = '';
      this.errors = {};
      this.loading = false;
    },
    checkUnique(field) {
      if (!this.form[field]) {
        this.errors[field] = `${field} не может быть пустым.`;
        return;
      }
      this.loading = true;
      fetch(`/api/check-unique?field=${field}&value=` + encodeURIComponent(this.form[field]))
        .then(response => response.json())
        .then(data => {
          this.loading = false;
          if (data.exists) {
            this.errors[field] = `${field} уже существует.`;
          } else {
            delete this.errors[field];
          }
        }).catch(() => {
          this.loading = false;
          this.errors[field] = 'Ошибка проверки.';
        });
    },
    submitForm() {
      if (this.hasErrors) return;

      // Отправка формы на сервер, например, через axios или fetch
      alert(`Отправлено: title="${this.form.title}", url="${this.form.url}"`);
      this.closeModal();
    }
  }
};
</script>

<style>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
.modal-window {
  background: white;
  padding: 20px;
  border-radius: 8px;
  min-width: 300px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.3);
}
label {
  display: block;
  margin-top: 10px;
}
input {
  width: 100%;
  padding: 6px;
  margin-top: 4px;
}
button {
  margin-top: 12px;
  margin-right: 8px;
}
</style>
