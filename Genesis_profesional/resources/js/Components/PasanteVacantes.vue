<template>
  <div class="pasante-vacantes p-4">
    <h2>Vacantes Disponibles</h2>
    <p>Postulaciones y sugerencias de vacantes.</p>
  </div>
</template>

<script setup>
defineProps({
  usuario: Object
});
defineEmits(['postulado']);
</script>

<style scoped>
.pasante-vacantes {
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}
</style>
