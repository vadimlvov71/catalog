<template>
  <v-dialog v-model="dialog" max-width="400px">
    <v-card>
      <v-card-title>Загрузить изображение</v-card-title>
      <v-card-text>
        <v-file-input
          label="Выберите изображение"
          accept="image/*"
          v-model="selectedFile"
          outlined
          dense
        ></v-file-input>
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
    };
  },
  methods: {
    openImageUpload(item) {
      this.currentItem = item;
      this.selectedFile = null;
      this.dialog = true;
    },
    closeDialog() {
      this.dialog = false;
      this.selectedFile = null;
      this.currentItem = null;
    },
    uploadImage() {
      if (!this.selectedFile || !this.currentItem) return;

      // Загрузка картинки или обновление item.image
      this.currentItem.image = this.selectedFile.name;

      this.closeDialog();
      // Можно вызвать уведомление об успешной загрузке
    },
  },
};
</script>
