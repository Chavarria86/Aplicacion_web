<template>
  <div class="pasante-progreso p-4">
    <h2>Progreso de la Pasantía</h2>
    <p>Visualización del estado y etapas de la pasantía.</p>
  </div>
</template>

<script setup>
defineProps({
  perfilCompleto: Object
});
</script>

<style scoped>
.pasante-progreso {
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}
</style>
