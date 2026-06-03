<template>
  <div>
    <button @click="showModal = true">{{ $t('categories.create_category') }}</button>

    <div v-if="showModal" class="modal-overlay" @click.self="closeModal">
      <div class="modal-window">
        <h3>{{ $t('categories.create_category') }}</h3>
        <form @submit.prevent="submitForm">
          <div>
            <label>{{ $t('form.title') }}:</label>
            <input v-model="form.name" @blur="checkUnique('name')" />
            <div v-if="errors.name" style="color:red">{{ errors.name }}</div>
          </div>

          <div>
            <label>URL:</label>
            <input v-model="form.url" @blur="checkUnique('url')" />
            <div v-if="errors.url" style="color:red">{{ errors.url }}</div>
          </div>
          <div>
            <label>Status:</label>
            <input v-model="form.status" @blur="checkUnique('status')" />
            <div v-if="errors.status" style="color:red">{{ errors.status }}</div>
          </div>
          <button type="submit" :disabled="loading || hasErrors">{{ $t('form.submit') }}</button>
          <button type="button" @click="closeModal">{{ $t('form.cancel') }}</button>

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
        url: '',
        status: 'hidden'
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
   
        console.log(field);
      if (!this.form[field]) {
        this.errors[field] = `${field} не может быть пустым.`;
        return;
      }
      this.loading = true;
      fetch("/api/manager_secret/check-unique?field=" + field + "&value=" + encodeURIComponent(this.form[field]))
        .then(response => response.json())
        .then(data => {
          this.loading = false;
          console.log(data);
          if (!data.unique) {
            console.log('data.no unique' + data.unique);
            this.errors[field] = `${field} уже существует.`;
          } else {
            console.log('yes' + data.unique);
            delete this.errors[field];
          }
        }).catch(() => {
          this.loading = false;
          this.errors[field] = 'Ошибка проверки.';
        });
    },
    submitForm() {
      this.isSubmitting = true;
      this.errors = {};
      console.log('this.form');
      console.log(this.form);
      // Проверяем поля еще раз перед отправкой
      Promise.all([this.checkUnique('name'), this.checkUnique('url')]).then(() => {
        
        if (Object.keys(this.errors).length > 0) {
          this.isSubmitting = false;
          return;
        }
        fetch('/api/manager_secret/save-category', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          body: JSON.stringify(this.form),
        })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              this.closeModal();
              alert('Запись успешно сохранена');
            } else {
              this.errors = data.errors || {};
            }
            this.isSubmitting = false;
          })
          .catch(() => {
            alert('Ошибка при сохранении');
            this.isSubmitting = false;
          });
      });
    },
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
