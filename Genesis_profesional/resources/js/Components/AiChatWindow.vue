<template>
  <div class="ai-chat-window p-4">
    <h2>Análisis IA</h2>
    <p>Componente de Análisis con Inteligencia Artificial en migración...</p>
  </div>
</template>

<script setup>
defineProps({
  usuario: { type: Object, default: () => ({}) }
});
</script>

<style scoped>
.ai-chat-window {
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}
</style>
