<template>
  <div class="vice-decano-dashboard p-4">
    <h2>Panel del Vicedecano</h2>
    <p>Funcionalidad administrativa en migración...</p>
  </div>
</template>

<script setup>
defineProps({
  seccionActiva: String,
  isDark: Boolean
});
defineEmits(['cambiarSeccion']);
</script>

<style scoped>
.vice-decano-dashboard {
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}
</style>
