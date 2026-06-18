<template>
  <div class="chat-interno p-4">
    <h2>Mensajería Interna</h2>
    <p>Componente de Mensajería en migración...</p>
  </div>
</template>

<script setup>
defineProps({
  usuario: { type: Object, default: () => ({}) },
  socket: { type: Object, default: null }
});
defineEmits(['activeChatChanged']);
</script>

<style scoped>
.chat-interno {
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}
</style>
