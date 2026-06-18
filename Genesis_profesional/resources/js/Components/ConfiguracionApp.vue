<template>
  <div class="configuracion-app p-4">
    <h2>Configuración</h2>
    <div class="mt-3">
      <button class="btn btn-primary" @click="$emit('toggleDarkMode')">
        Cambiar Modo {{ isDark ? 'Claro' : 'Oscuro' }}
      </button>
    </div>
  </div>
</template>

<script setup>
defineProps({
  isDark: Boolean
});
defineEmits(['toggleDarkMode']);
</script>

<style scoped>
.configuracion-app {
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}
</style>
