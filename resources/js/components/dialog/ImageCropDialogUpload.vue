<template>
  <v-dialog v-model="dialog" width="450">
    <template #activator="{ props }">
      <v-btn v-bind="props" color="primary" @click="openDialog(recordId)">Загрузить картинку</v-btn>
    </template>

    <v-card>
      <v-card-title>Загрузить изображение</v-card-title>
      <v-card-text>
        <v-file-input
          label="Выберите изображение"
          accept="image/*"
          v-model="selectedFile"
          @change="onFileChange"
          outlined
          dense
          :show-size="true"
          clearable
        />
        
        <div v-if="previewUrl" class="mt-4 text-center">
          <v-img :src="previewUrl" max-width="200" max-height="200" class="mx-auto" />
          <div class="caption mt-2">Превью</div>
        </div>
      </v-card-text>

      <v-card-actions>
        <v-spacer />
        <v-btn text @click="closeDialog">Отмена</v-btn>
        <v-btn color="primary" :disabled="!compressedFile || !previewFile" @click="uploadImages">
          Загрузить
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  modelValue: Boolean,
});
const emits = defineEmits(['update:modelValue']);

const type = ref(null);
const dialog = ref(false);
const selectedFile = ref(null);
const recordId = ref(null);

const compressedFile = ref(null);  // большой файл
const previewFile = ref(null);     // превьюшный файл
const previewUrl = ref(null);



function close() {
  dialog.value = false;
  emits('update:modelValue', false);
}
defineExpose({ openDialog });
watch(dialog, val => {
  emits('update:modelValue', val);
});

function openDialog(id, typeArgument) {
  console.log(typeArgument);
  type.value = typeArgument;
  recordId.value = id;
  selectedFile.value = null;
  compressedFile.value = null;
  previewFile.value = null;
  previewUrl.value = null;
  dialog.value = true;
}

function closeDialog() {
  dialog.value = false;
  selectedFile.value = null;
  compressedFile.value = null;
  previewFile.value = null;
  previewUrl.value = null;
  recordId.value = null;
}

// Загрузка файла и создание двух версий: большой и превью (с кропом)
async function onFileChange(event) {
  if (!event) return;

  //const actualFile = Array.isArray(file) ? file[0] : file;
  const actualFile = event.target.files[0];
  
  if (!actualFile.type.startsWith('image/')) {
    alert('Пожалуйста, выберите изображение');
    selectedFile.value = null;
    return;
  }

  // Большой сжатый файл до 800px по ширине, качество 0.7
  const big = await resizeImage(actualFile, 800, 0.7);
  //const middle = await resizeImage(actualFile, 300, 0.7);
  // Превью - квадрат 200x200 с центрированным кропом
  const preview = await cropImageCenter(actualFile, 200, 200, 0.7);

  compressedFile.value = big.file;
  previewFile.value = preview.file;
  previewUrl.value = preview.url;
}


// Функция сжатия до максимальной ширины
function resizeImage(file, maxWidth, quality) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onload = e => {
      const img = new Image();
      img.onload = () => {
        const scale = maxWidth / img.width;
        const width = maxWidth;
        const height = img.height * scale;

        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0, width, height);

        canvas.toBlob(blob => {
          const resizedFile = new File([blob], file.name, { type: 'image/jpeg' });
          const url = URL.createObjectURL(blob);
          resolve({ file: resizedFile, url });
        }, 'image/jpeg', quality);
      };
      img.onerror = () => reject(new Error('Не удалось загрузить изображение'));
      img.src = e.target.result;
    };
    reader.onerror = () => reject(new Error('Ошибка чтения файла'));
    reader.readAsDataURL(file);
  });
}

// Функция центрированного кропа до ширины и высоты width,height
function cropImageCenter(file, width, height, quality) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onload = e => {
      const img = new Image();
      img.onload = () => {
        // Вычисляем размеры и позицию для центрального кропа:
        const minSide = Math.min(img.width, img.height);
        const sx = (img.width - minSide) / 2;
        const sy = (img.height - minSide) / 2;

        const canvas = document.createElement('canvas');
        canvas.width = width;
        canvas.height = height;
        const ctx = canvas.getContext('2d');

        // Кропаем центр исходника и масштабируем на canvas
        ctx.drawImage(img, sx, sy, minSide, minSide, 0, 0, width, height);

        canvas.toBlob(blob => {
          const croppedFile = new File([blob], 'preview-' + file.name, { type: 'image/jpeg' });
          const url = URL.createObjectURL(blob);
          resolve({ file: croppedFile, url });
        }, 'image/jpeg', quality);
      };
      img.onerror = () => reject(new Error('Не удалось загрузить изображение'));
      img.src = e.target.result;
    };
    reader.onerror = () => reject(new Error('Ошибка чтения файла'));
    reader.readAsDataURL(file);
  });
}

async function uploadImages() {
  if (!compressedFile.value || !previewFile.value || !recordId.value) return;

  const formData = new FormData();
  formData.append('file', compressedFile.value);
  formData.append('preview', previewFile.value);
  formData.append('id', recordId.value);
  formData.append('type', type.value);

  try {
    const res = await fetch('/api/manager_secret/image/upload', {
      method: 'POST',
      body: formData,
    });

    if (res.ok) {
      alert('Загрузка успешна!');
      closeDialog();
    } else {
      alert('Ошибка при загрузке');
    }
  } catch (e) {
    alert('Ошибка сети при загрузке');
  }
}
</script>
