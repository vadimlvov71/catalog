/*
export function checkUnique1(field) {
   console.log('field');
    console.log(field);
    if (!field) {
        errors[field] = `${field} не может быть пустым.`;
        return;
    }
    //loading = true;
    fetch("/api/manager_secret/check-unique?field=" + field + "&value=" + encodeURIComponent(form[field]))
    .then(response => response.json())
    .then(data => {
        //loading = false;
        console.log(data);
        if (!data.unique) {
        console.log('data.no unique' + data.unique);
        errors[field] = `${field} уже существует.`;
        } else {
            console.log('yes' + data.unique);
            delete errors[field];
        }
    }).catch(() => {
        loading = false;
        errors[field] = 'Ошибка проверки.';
    });
}
*/
import { reactive } from 'vue';
//import { ref } from 'vue'

//export function useCheckUnique() {
//    const errors = ref({})
export function useCheckUnique(outsideErrors = reactive({})) {
  const errors = outsideErrors;  


  const checkUnique = async (fieldName, fieldValue, endpoint) => {
    console.log('useCheckUnique: ', fieldName);
    try {
      // Очистите предыдущую ошибку для этого поля
      errors[fieldName] = null

      // Проверка на пустое значение
      if (!fieldValue) return

      const response = await fetch(endpoint || `/api/manager_secret/check-unique/${fieldName}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ [fieldName]: fieldValue })
      })

      const data = await response.json()
        console.log('useCheckUnique response: ', data);
      if (!response.ok) {
        // Если ошибка валидации с сервера
        errors[fieldName] = data.message || `${fieldName} уже существует`
      }
    } catch (errors) {
      console.log('Ошибка проверки:', errors)
      errors[fieldName] = 'Ошибка проверки сервера'
    }
  }

  return { errors, checkUnique }
}