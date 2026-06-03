<template>
    <v-dialog max-width="500">
    <template v-slot:activator="{ props: activatorProps }">
        <v-btn
        v-bind="activatorProps"
        color="surface-variant"
        :text="$t('categories.create_category')"
        variant="flat"
        ></v-btn>
    </template>

    <template v-slot:default="{ isActive }">
        <v-card :title="$t('categories.create_category')">
        <v-card-text>

            <form @submit.prevent="submitForm(isActive)">
                
                <v-text-field
                :label="$t('form.title')"
                v-model="form.name"
                required
                @blur="checkUnique('name')"
                ></v-text-field>
                <div v-if="errors.name" style="color:red">{{ errors.name }}</div>

                <v-text-field
                label="URL"
                v-model="form.url"
                required
                @blur="checkUnique('url')"
                ></v-text-field>
                <div v-if="errors.url" style="color:red">{{ errors.url }}</div>
      
            
            <button type="submit" :disabled="loading || hasErrors">{{ $t('form.submit') }}</button>
            <button type="button" @click="closeModal">{{ $t('form.cancel') }}</button>

            <div v-if="loading">Проверка...</div>
            </form>
        </v-card-text>

        <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn
            text="Close Dialog"
            @click="isActive.value = false"
            ></v-btn>
        </v-card-actions>
        </v-card>
    </template>
    </v-dialog>
</template>
<script setup>
import { ref, reactive } from 'vue';
const showModal = ref(false);
const loading = ref(false);
const form = reactive({
    name: '',
    url: '',
});
const errors = reactive({});
const emit = defineEmits(['item-added']);

function checkUnique(field) {
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
function submitForm(isActive) {
      //isSubmitting = true;
      console.log('form');
      console.log(form);
      // Проверяем поля еще раз перед отправкой
      Promise.all([checkUnique('name'), checkUnique('url')]).then(() => {
        
        if (Object.keys(errors).length > 0) {
          isSubmitting = false;
          return;
        }
        fetch('/api/manager_secret/save-category', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          body: JSON.stringify(form),
        })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
             // closeModal();
              console.log('Запись успешно сохранена');
                isActive.value = false;
                emit('item-added');
            } else {
              errors = data.errors || {};
            }
               //isSubmitting = false;
          })
          .catch(() => {
            alert('Ошибка при сохранении');
                //isSubmitting = false;
          });
      });
    }
</script>