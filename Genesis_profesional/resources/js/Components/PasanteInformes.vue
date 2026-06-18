<template>
  <div class="pasante-informes p-4">
    <h2>Informes Mensuales</h2>
    <p>Lista y envío de informes de actividades.</p>
  </div>
</template>

<script setup>
defineProps({
  usuario: Object,
  informes: Array,
  cargandoInformes: Boolean
});
defineEmits(['informeEnviado']);
</script>

<style scoped>
.pasante-informes {
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}
</style>
