<template>
  <Dashboard_Pasante :seccionActiva="seccionActiva" @cambiarSeccion="$emit('cambiarSeccion', $event)" />
</template>

<script setup>
import Dashboard_Pasante from './Dashboard_Pasante.vue';
defineProps({ seccionActiva: String });
defineEmits(['cambiarSeccion']);
</script>
