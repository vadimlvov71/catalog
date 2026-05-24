<template>
  <form @submit.prevent="submitForm">
    <div :class="['form-group', errors.name ? 'has-error' : '']">
      <label for="name">Имя</label>
      <input
        id="name"
        v-model="form.name"
        @input="clearError('name')"
        type="text"
        class="form-control"
      />
      <span v-if="errors.name" class="error-text">{{ errors.name[0] }}</span>
    </div>

    <div :class="['form-group', errors.email ? 'has-error' : '']">
      <label for="email">Email</label>
      <input
        id="email"
        v-model="form.email"
        @input="clearError('email')"
        type="email"
        class="form-control"
      />
      <span v-if="errors.email" class="error-text">{{ errors.email[0] }}</span>
    </div>

    <button type="submit">Отправить</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: '',
        email: ''
      },
      errors: {}
    };
  },
  methods: {
    clearError(field) {
      // При новом вводе очистить ошибку и снять выделение
      if (this.errors[field]) {
        delete this.errors[field];
      }
    },
    submitForm() {
      // Отправка данных на сервер
      fetch('/api/form-submit', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(this.form)
      })
      .then(async response => {
        if (!response.ok) {
          // Обработка ошибок валидации
          const data = await response.json();
          if (data.errors) {
            this.errors = data.errors; // Laravel возвращает ошибки в поле errors
          }
          throw new Error('Ошибка валидации');
        }
        return response.json();
      })
      .then(data => {
        alert('Форма успешно отправлена!');
        this.form.name = '';
        this.form.email = '';
        this.errors = {};
      })
      .catch(error => {
        console.log(error);
      });
    }
  }
};
</script>

<style>
.form-group {
  margin-bottom: 1em;
}
.error-text {
  color: red;
  font-size: 0.9em;
}
.has-error input {
  border-color: red;
}
</style>
