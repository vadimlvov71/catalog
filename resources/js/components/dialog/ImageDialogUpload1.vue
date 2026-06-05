<template>
  <v-dialog v-model="dialog" max-width="400px">
    <v-card>
   <!--
        <input type="file" @change="onFileChange" accept="image/*" />
        <div v-if="imageUrl">
          <h3>Превью изображения:</h3>
        <img :src="imageUrl" alt="preview" style="max-width: 300px;" />
      </div>
-->
    <button @click="uploadImage" :disabled="!selectedFile">Загрузить</button>
      <v-card-title>Загрузить изображение</v-card-title>
      <v-card-text>
        <v-file-input
          label="Выберите изображение"
          accept="image/*"
          v-model="selectedFile"
          outlined
          dense
        ></v-file-input>
        <div v-if="imageUrl">
          <h3>Превью изображения:</h3>
          <img :src="imageUrl" alt="preview" style="max-width: 300px;" />
        </div>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn text @click="closeDialog">Отмена</v-btn>
        <v-btn color="primary" @click="uploadImage" :disabled="!selectedFile">
          Загрузить
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      selectedFile: null,
      currentItem: null,
      compressedFile: null,
      compressedImageUrl: null,
    };
  },
  methods: {
    openImageUpload(item, type) {
      this.currentItem = item;
      this.type = type;
      this.selectedFile = null;
      this.dialog = true;
    },
    closeDialog() {
      this.dialog = false;
      this.selectedFile = null;
      this.currentItem = null;
    },
    onFileChange(file) {
      console.log('onFileChange');
      console.log('Тип файла:', file && file.type ? file.type : file);
      // value – это либо File, либо File[] (если multiple)
     // let file = null;
      /*if (Array.isArray(value)) {
        file = value[0] || null;
      } else {
        file = value;
      }*/
      
      if (file && file.type && file.type.startsWith('image/')) {
        if (this.imageUrl) {
          URL.revokeObjectURL(this.imageUrl);
        }
        this.imageUrl = URL.createObjectURL(file);
      } else {
        if (this.imageUrl) {
          URL.revokeObjectURL(this.imageUrl);
        }
        this.imageUrl = null;
        this.selectedFile = null;
        alert('Пожалуйста, выберите валидный файл изображения.');
      }
    },
    uploadImage() {
       console.log('uploadImage type:' + this.type);
       console.log('uploadImage this.id:', this.currentItem.id);
      if (!this.selectedFile) return;
      const formData = new FormData();
      formData.append('file', this.selectedFile);
      formData.append('type', this.type);
      formData.append('id', this.currentItem.id);

      fetch('/api/manager_secret/image/upload', {
        method: 'POST',
        body: formData,
      })
        .then(response => {
          console.log('response');
          console.log(response);
          if (response.ok) {
            alert('Изображение успешно загружено!');
          } else {
            alert('Ошибка при загрузке.');
          }
        })
        .catch(() => alert('Ошибка сети при загрузке.'));

      this.currentItem.image = this.selectedFile.name;

      this.closeDialog();
      // Можно вызвать уведомление об успешной загрузке
    },
  },
  watch: {
    selectedFile(newFile) {
      const file = Array.isArray(newFile) ? newFile[0] : newFile;
      console.log('watch -- Тип файла:', file && file.type);
      //console.log('this.id:', this.currentItem.id);
      if (
        file &&
        ((file.type && file.type.startsWith('image/')) ||
        /\.(jpe?g|png|gif|bmp|webp)$/i.test(file.name))
      ) {
        if (this.imageUrl) {
          URL.revokeObjectURL(this.imageUrl);
        }
        this.imageUrl = URL.createObjectURL(file);
        this.selectedFile = file;
      } else {
        if (this.imageUrl) {
          URL.revokeObjectURL(this.imageUrl);
        }
        this.imageUrl = null;
        this.selectedFile = null;
        alert('Пожалуйста, выберите валидный файл изображения.');
      }
    }
  },
};
</script>
