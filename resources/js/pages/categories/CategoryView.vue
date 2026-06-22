<template>
  <v-container>
    <v-card class="pa-4 mb-6">
      <v-card-title>Редактирование категории</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="submitForm" ref="form">
          <v-text-field
            v-model="item.name"
            label="Имя"
            required
          />
          <v-text-field
            v-model="item.url"
            label="URL"
            required
          />
       0<!-- Блок с картинкой для формы -->
          <div class="my-4 ">
            <label>Изображение</label>
            <v-card class="my-2" elevation="1" rounded>
              <template v-if="item.preview_url">
                <div class="d-flex align-center image-container">
                  <v-img
                    :src="item.preview_url"
                   height="300"
              
                  ></v-img>
                  <v-btn
                    icon
                    small
                    @click="openImageUploadDialog(item)"
                   
                    class="ml-2"
                  >
                    <v-icon small>mdi-pencil</v-icon>
                  </v-btn>
                </div>
              </template>
              <template v-else>
                <v-btn
                  icon
                  @click="openImageUploadDialog(item)"
                  height="64"
                  class="d-flex align-center justify-center w-100"
                >
                  <v-icon>mdi-plus</v-icon>
                </v-btn>
              </template>
            </v-card>
          </div>

          <v-btn type="submit" color="primary" class="mt-4">Сохранить</v-btn>
        </v-form>
      </v-card-text>
    </v-card>

    <v-card>
      <v-card-title>Элементы таблицы</v-card-title>
      <v-data-table
        :headers="headers"
        :items="items"
        class="elevation-1"
        item-value="id"
      >
        <template v-slot:[`item.content`]="{ item }">
          <v-textarea
            v-model="item.content"
            dense
            hide-details
            rows="3"
          />
        </template>
      </v-data-table>
    </v-card>
  </v-container>
    <ImageCropDialogUpload 
      ref="ImageCropDialogUploadRef"
      v-model:dialog="dialogVisible" 
    />
</template>


<script setup>
import { reactive, ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import ImageCropDialogUpload from '../../components/dialog/ImageCropDialogUpload.vue'

const dialogVisible = ref(false)
// Template ref для доступа к методам компонента
const ImageCropDialogUploadRef = ref(null)

const route = useRoute();
const id = route.params.id;
console.log('Полученный id:', id);
const item = reactive({
  name: '',
  url: '',
  image: ''
});
const headers = [
  { text: 'Имя', value: 'name' },
  { text: 'Описание', value: 'description' },
  { text: 'Содержимое', value: 'content' }
];
const items = reactive([
  { id: 1, name: 'Объект 1', description: 'Описание 1', content: '' },
  { id: 2, name: 'Объект 2', description: 'Описание 2', content: '' },
  { id: 3, name: 'Объект 3', description: 'Описание 3', content: '' }
]);
const saveCategory = () => {
  alert(`Категория сохранена:\n${JSON.stringify(category, null, 2)}`);
  console.log('Элементы таблицы:', items);
};
onMounted(async () => {
    loadItem();
});
 async function loadItem() {
    try {
      const response = await fetch("/api/manager_secret/en/categories/edit/" + id);
      if (!response.ok) throw new Error('Ошибка загрузки данных');
      const data = await response.json();
      const category = data.items;
      item.name = category.name || '';
      item.url = category.url || '';
      item.image = category.image || '';
      item.preview_url = category.preview_url || '';
       //console.log('item:', item);
    } catch (error) {
      console.error('Ошибка при загрузке категории:', error);
    }
 }
async function submitForm() {
  console.log('submitForm category:', id);
  try {
    const response = await fetch(`/api/manager_secret/en/categories/update/${id}`, {
      method: 'POST', // или 'PUT', смотря как у вас API настроен
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(category)
    });
    //if (!response.ok) throw new Error('Ошибка при сохранении');
    const data = await response.json();
     console.log('data:', data);
    alert('Категория сохранена успешно');
    // Можно сделать перенаправление или обновление данных
  } catch (error) {
    alert(error.message);
  }
}

const openImageUploadDialog = (itemData) => {
   console.log('itemData:', itemData);
  item.value = itemData
  // Вызываем метод дочернего компонента
  ImageCropDialogUploadRef.value?.openDialog(itemData.id, 'category')
}

const showDialog = ref(false)
const selectedItem = ref(null)

const openComponent = (item) => {
  selectedItem.value = item
  showDialog.value = true
}

const closeDialog = () => {
  showDialog.value = false
  selectedItem.value = null
}
</script>

<style scoped>


.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>