<template>
  <div>
    <h1>Привет, {{ user?.name || 'гость' }}!</h1>
  </div>
</template>
<script>

export default {
  data() {
    return {
      user: null
    };
  },
  async mounted() {
    try {
      const response = await fetch('/api/manager_secret/en/user', {
        credentials: 'include', // передаём куки сессии
        headers: { 'Accept': 'application/json' }
      });
      //console.log('response');
      // console.log(response);
      if (response.ok) {
        this.user = await response.json();
      }
    } catch (e) {
      console.error('Ошибка при получении пользователя', e);
       //console.log('response error');
      //console.log(response);
    }
  }
}
</script>
