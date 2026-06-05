<template>
  <div>
    <AddCategoryDialog @item-added="refreshItems" />
    <div>
      <v-card flat>
        <v-card-title class="d-flex align-center pe-2">
          <v-icon icon="mdi-video-input-component"></v-icon> &nbsp;
          Find a Graphics Card

          <v-spacer></v-spacer>

          <v-text-field
            v-model="search"
            density="compact"
            label="Search"
            prepend-inner-icon="mdi-magnify"
            variant="solo-filled"
            flat
            hide-details
            single-line
          ></v-text-field>
        </v-card-title>

        <v-divider></v-divider>
        <v-data-table
          v-model:search="search"
          :filter-keys="['name']"
          :items="items"
        >
          <template v-slot:header.stock>
            <div class="text-end">Stock</div>
          </template>

          <!-- Таблица с изображениями -->


              <template v-slot:item.image="{ item }">
                <v-card class="my-2" elevation="1" rounded>
                  <template v-if="item.image_url">
                    <v-img
                      :src="`${item.image_url}`"
                      height="64"
                      cover
                    ></v-img>
                  </template>
                  <template v-else>
                    <v-btn
                      icon
                      @click="openImageUploadDialog(item)"
                      height="64"
                      class="d-flex align-center justify-center"
                    >
                      <v-icon>mdi-plus</v-icon>
                    </v-btn>
                  </template>
                </v-card>
              </template>
       
           <template v-slot:item.preview="{ item }">
                <v-card class="my-2" elevation="1" rounded>
                  <template v-if="item.preview_url">
                    <v-img
                      :src="`${item.preview_url}`"
                      height="64"
                      cover
                    ></v-img>
                  </template>
                  
                </v-card>
            </template>
        
         <template v-slot:item.status_index_page_show ="{ item }">
            <div class="text-end">
              <v-chip
                :color="item.status_index_page_show  ? 'green' : 'red'"
                :text="item.status_index_page_show  ? 'active' : 'hidden'"
                class="text-uppercase"
                size="small"
                label
              ></v-chip>
            </div>
          </template>

          <template v-slot:item.status="{ item }">
            <div class="text-end">
              <v-chip
                :color="item.status ? 'green' : 'red'"
                :text="item.status ? 'active' : 'hidden'"
                class="text-uppercase"
                size="small"
                label
              ></v-chip>
            </div>
          </template>
        </v-data-table>
      </v-card>
    </div>
    <div class="category-admin-panel">
      <table class="categories-table">
        <thead>
          <tr>
            <th>Название</th>
            <th>Изображение</th>
            <th>Статус</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items" :key="item.id">
            <td>{{ item.name }}</td>
            <td>
              <img :src="item.imageUrl" alt="item.name" class="category-image" />
            </td>
            
            <td>
              <select v-model="item.status" @change="updateStatus(item)">
                <option value="active">Активен</option>
                <option value="inactive">Неактивен</option>
                <option value="hidden">Архив</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <ImageDialogUpload ref="ImageDialogUpload" />
  <ImageCropDialogUpload ref="ImageCropDialogUpload" v-model:dialog="dialogVisible" />
</template>
<script>
//import AddCategoryForm from '../../components/forms/AddCategoryForm.vue'
import AddCategoryDialog from '../../components/forms/AddCategoryDialog.vue'
import ImageDialogUpload from '../../components/dialog/ImageDialogUpload.vue'
import ImageCropDialogUpload from '../../components/dialog/ImageCropDialogUpload.vue'

export default {
  
  data() {
    return {
      
      items: [],  // сюда подгрузятся данные
      dialog: false,
      dialogVisible: false,
      selectedFile: null,
      currentItem: null, // элемент, куда загружаем картинку
    };
  },

  components: {
    AddCategoryDialog,
    ImageDialogUpload,
    ImageCropDialogUpload
  },
  mounted() {
    this.loadItems();
    
  },
  methods: {
      loadItems() {
        fetch('/api/manager_secret/en/json/categories') // URL вашего Laravel контроллера (приведите к вашему маршруту)
        .then(response => response.json())
        .then(data => {
          if(data.status === 'success'){
            this.items = data.items; // в items приходит массив товаров
          } else {
            console.error('Ошибка при получении данных');
          }
        })
        .catch(error => {
          console.error('Ошибка сети или сервера', error);
        });
      },
      refreshItems() {
        this.loadItems();
      },
      handleClick() {
          this.$router.push('/items/create'); // путь маршрута Vue Router
      },
      openImageUploadDialog(item) {
      // Вызываем метод дочернего компонента по ref
        this.$refs.ImageCropDialogUpload.openDialog(item.id, 'category');
        //this.$refs.ImageDialogUpload.openImageUpload(item, 'category');
      },
    }
};
</script>


