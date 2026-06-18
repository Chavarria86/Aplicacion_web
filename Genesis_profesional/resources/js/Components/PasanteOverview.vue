<template>
  <div class="pasante-overview">
    
    <!-- WELCOME BANNER -->
    <div class="welcome-banner mb-4">
      <div class="banner-content">
        <h1 class="banner-title">Hola de nuevo, {{ usuario.nombres }}</h1>
        <p class="banner-subtitle">
          Bienvenido/a de nuevo al portal de Génesis Profesional, aquí puedes gestionar tu curriculum, subir informes y monitorear tu proceso de pasantías
        </p>
      </div>
      <div class="banner-icon-container">
        <svg xmlns="http://www.w3.org/2000/svg" width="77" height="65" viewBox="0 0 77 65" fill="none" class="banner-icon-svg">
          <path d="M38.5 0L0 22.4583L38.5 44.9167L70.5833 26.2025V49.7292H77V22.4583L38.5 0ZM12.8301 36.8637V51.3333C15.8169 55.3198 19.6917 58.5553 24.147 60.7829C28.6023 63.0106 33.5156 64.1692 38.4968 64.1667C43.4785 64.1697 48.3924 63.0113 52.8484 60.7836C57.3043 58.556 61.1796 55.3202 64.1667 51.3333V36.867L38.5 51.8403L12.8301 36.8637Z" fill="white" fill-opacity="0.5"/>
        </svg>
      </div>
    </div>

    <!-- ESTADO DE MI PASANTÍA CARD -->
    <div class="status-card mb-4">
      <h3 class="status-card-title mb-4">Estado de mi pasantía</h3>
      <div class="row text-center gy-4">
        
        <!-- FASE 1: CURRICULUM -->
        <div class="col-6 col-md-3 d-flex flex-column align-items-center">
          <div class="phase-icon-wrapper mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none" class="phase-icon">
              <path d="M9.37259 29.75C8.71997 29.75 8.1755 29.5318 7.73917 29.0955C7.30284 28.6592 7.0842 28.1147 7.08325 27.4621V6.53792C7.08325 5.88625 7.30189 5.34225 7.73917 4.90592C8.17645 4.46958 8.72092 4.25094 9.37259 4.25H20.5416L26.9166 10.625V15.4473C26.4463 15.5106 26.0071 15.6542 25.5991 15.878C25.1911 16.1018 24.8133 16.3871 24.4658 16.7337L15.9658 25.1982V29.75H9.37259ZM19.3431 29.75V26.6192L26.8982 19.1009C27.0379 18.9781 27.1829 18.8884 27.3331 18.8317C27.4842 18.7732 27.6353 18.7439 27.7864 18.7439C27.9423 18.7439 28.1 18.7741 28.2596 18.8346C28.4201 18.896 28.5609 18.9876 28.6818 19.1094L29.9922 20.4467C30.1083 20.5865 30.1971 20.732 30.2585 20.8831C30.3189 21.0332 30.3492 21.1839 30.3492 21.335C30.3492 21.4861 30.3204 21.6382 30.2628 21.7912C30.2051 21.9442 30.1154 22.0906 29.9936 22.2303L22.4725 29.75H19.3431ZM27.7864 22.6879L29.0968 21.3336L27.7864 19.9977L26.4406 21.3435L27.7864 22.6879ZM19.8333 11.3333H25.4999L19.8333 5.66667V11.3333Z" fill="currentColor"/>
            </svg>
          </div>
          <span class="phase-name">Fase 1: Curriculum</span>
          <span :class="['badge-status', isFaseCompletada(1) ? 'status-completed' : 'status-pending']">
            <i v-if="isFaseCompletada(1)" class="bi bi-check-lg me-1"></i>
            {{ isFaseCompletada(1) ? 'Completado' : 'Pendiente' }}
          </span>
        </div>

        <!-- FASE 2: ACEPTADO -->
        <div class="col-6 col-md-3 d-flex flex-column align-items-center">
          <div class="phase-icon-wrapper mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="30" viewBox="0 0 36 30" fill="none" class="phase-icon">
              <path d="M36 18.1232V25.2632C36 26.5194 35.4311 27.7243 34.4184 28.6126C33.4057 29.5009 32.0322 30 30.6 30H5.4C3.96783 30 2.59432 29.5009 1.58162 28.6126C0.568927 27.7243 0 26.5194 0 25.2632V18.1232L0.9954 18.5605C6.27107 20.8914 12.0961 22.1053 18.0031 22.1047C23.9102 22.1042 29.7349 20.8892 35.01 18.5574L36 18.1232ZM21.6 0C23.0322 0 24.4057 0.499059 25.4184 1.38739C26.4311 2.27572 27 3.48055 27 4.73684V6.31579H30.6C32.0322 6.31579 33.4057 6.81485 34.4184 7.70318C35.4311 8.59151 36 9.79634 36 11.0526V14.5926L33.3954 15.7358C28.7353 17.7965 23.5993 18.8943 18.3808 18.9452C13.1624 18.9961 7.99984 17.9988 3.2886 16.0295L2.124 15.5242L0 14.5926V11.0526C0 9.79634 0.568927 8.59151 1.58162 7.70318C2.59432 6.81485 3.96783 6.31579 5.4 6.31579H9V4.73684C9 3.48055 9.56893 2.27572 10.5816 1.38739C11.5943 0.499059 12.9678 0 14.4 0H21.6ZM18 12.6316C17.5226 12.6316 17.0648 12.7979 16.7272 13.094C16.3896 13.3902 16.2 13.7918 16.2 14.2105C16.1988 14.4179 16.2442 14.6234 16.3336 14.8154C16.4229 15.0073 16.5545 15.182 16.7208 15.3293C16.8872 15.4767 17.0849 15.5938 17.3029 15.6742C17.5208 15.7545 17.7546 15.7963 17.991 15.7974C18.2274 15.7984 18.4617 15.7586 18.6805 15.6802C18.8994 15.6018 19.0984 15.4864 19.2664 15.3405C19.4344 15.1946 19.568 15.0211 19.6595 14.83C19.7511 14.6388 19.7988 14.4337 19.8 14.2263C19.8 13.3389 18.9936 12.6316 18 12.6316ZM21.6 3.15789H14.4C13.9226 3.15789 13.4648 3.32425 13.1272 3.62036C12.7896 3.91647 12.6 4.31808 12.6 4.73684V6.31579H23.4V4.73684C23.4 4.31808 23.2104 3.91647 22.8728 3.62036C22.5352 3.32425 22.0774 3.15789 21.6 3.15789Z" fill="currentColor"/>
            </svg>
          </div>
          <span class="phase-name">Fase 2: Aceptado</span>
          <span :class="['badge-status', isFaseCompletada(2) ? 'status-completed' : 'status-pending']">
            <i v-if="isFaseCompletada(2)" class="bi bi-check-lg me-1"></i>
            {{ isFaseCompletada(2) ? 'Completado' : 'Pendiente' }}
          </span>
        </div>

        <!-- FASE 3: PRÁCTICAS -->
        <div class="col-6 col-md-3 d-flex flex-column align-items-center">
          <div class="phase-icon-wrapper mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none" class="phase-icon">
              <path d="M7.99442 25.375C7.43778 25.375 6.97337 25.1889 6.60121 24.8168C6.22904 24.4446 6.04255 23.9802 6.04175 23.4235V5.57646C6.04175 5.02062 6.22823 4.55663 6.60121 4.18446C6.97418 3.81229 7.43858 3.62581 7.99442 3.625H17.5209L22.9584 9.0625V13.1757C22.5572 13.2296 22.1827 13.3521 21.8347 13.543C21.4867 13.7339 21.1644 13.9772 20.868 14.2728L13.618 21.4926V25.375H7.99442ZM16.4987 25.375V22.7046L22.9427 16.292C23.0619 16.1872 23.1856 16.1107 23.3137 16.0624C23.4426 16.0124 23.5714 15.9875 23.7003 15.9875C23.8332 15.9875 23.9678 16.0132 24.1039 16.0648C24.2409 16.1172 24.3609 16.1953 24.464 16.2992L25.5817 17.4399C25.6808 17.5591 25.7565 17.6832 25.8089 17.812C25.8604 17.9401 25.8862 18.0686 25.8862 18.1975C25.8862 18.3264 25.8616 18.4561 25.8125 18.5866C25.7634 18.7171 25.6868 18.8419 25.5829 18.9612L19.1679 25.375H16.4987ZM23.7003 19.3515L24.818 18.1963L23.7003 17.0568L22.5524 18.2048L23.7003 19.3515ZM16.9167 9.66667H21.7501L16.9167 4.83333V9.66667Z" fill="currentColor"/>
            </svg>
          </div>
          <span class="phase-name">Fase 3: Prácticas</span>
          <span :class="['badge-status', isFaseCompletada(3) ? 'status-completed' : 'status-pending']">
            <i v-if="isFaseCompletada(3)" class="bi bi-check-lg me-1"></i>
            {{ isFaseCompletada(3) ? 'Completado' : 'Pendiente' }}
          </span>
        </div>

        <!-- FASE 4: INFORME FINAL -->
        <div class="col-6 col-md-3 d-flex flex-column align-items-center">
          <div class="phase-icon-wrapper mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none" class="phase-icon">
              <path d="M7.99442 25.375C7.43778 25.375 6.97337 25.1889 6.60121 24.8168C6.22904 24.4446 6.04255 23.9802 6.04175 23.4235V5.57646C6.04175 5.02062 6.22823 4.55663 6.60121 4.18446C6.97418 3.81229 7.43858 3.62581 7.99442 3.625H17.5209L22.9584 9.0625V13.1757C22.5572 13.2296 22.1827 13.3521 21.8347 13.543C21.4867 13.7339 21.1644 13.9772 20.868 14.2728L13.618 21.4926V25.375H7.99442ZM16.4987 25.375V22.7046L22.9427 16.292C23.0619 16.1872 23.1856 16.1107 23.3137 16.0624C23.4426 16.0124 23.5714 15.9875 23.7003 15.9875C23.8332 15.9875 23.9678 16.0132 24.1039 16.0648C24.2409 16.1172 24.3609 16.1953 24.464 16.2992L25.5817 17.4399C25.6808 17.5591 25.7565 17.6832 25.8089 17.812C25.8604 17.9401 25.8862 18.0686 25.8862 18.1975C25.8862 18.3264 25.8616 18.4561 25.8125 18.5866C25.7634 18.7171 25.6868 18.8419 25.5829 18.9612L19.1679 25.375H16.4987ZM23.7003 19.3515L24.818 18.1963L23.7003 17.0568L22.5524 18.2048L23.7003 19.3515ZM16.9167 9.66667H21.7501L16.9167 4.83333V9.66667Z" fill="currentColor"/>
            </svg>
          </div>
          <span class="phase-name">Fase 4: Informe final</span>
          <span :class="['badge-status', isFaseCompletada(4) ? 'status-completed' : 'status-pending']">
            <i v-if="isFaseCompletada(4)" class="bi bi-check-lg me-1"></i>
            {{ isFaseCompletada(4) ? 'Completado' : 'Pendiente' }}
          </span>
        </div>

      </div>
    </div>

    <!-- BOTTOM SHORTCUTS GRID -->
    <div class="row g-4">
      
      <!-- PERFIL PROFESIONAL -->
      <div class="col-12 col-md-6">
        <div class="shortcut-card" @click="$emit('cambiarSeccion', 'perfil')">
          <div class="shortcut-icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 51 51" fill="none" class="shortcut-icon">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M34 19.125C34 21.3793 33.1045 23.5413 31.5104 25.1354C29.9163 26.7295 27.7543 27.625 25.5 27.625C23.2457 27.625 21.0837 26.7295 19.4896 25.1354C17.8955 23.5413 17 21.3793 17 19.125C17 16.8707 17.8955 14.7087 19.4896 13.1146C21.0837 11.5205 23.2457 10.625 25.5 10.625C27.7543 10.625 29.9163 11.5205 31.5104 13.1146C33.1045 14.7087 34 16.8707 34 19.125ZM29.75 19.125C29.75 20.2522 29.3022 21.3332 28.5052 22.1302C27.7082 22.9272 26.6272 23.375 25.5 23.375C24.3728 23.375 23.2918 22.9272 22.4948 22.1302C21.6978 21.3332 21.25 20.2522 21.25 19.125C21.25 17.9978 21.6978 16.9168 22.4948 16.1198C23.2918 15.3228 24.3728 14.875 25.5 14.875C26.6272 14.875 27.7082 15.3228 28.5052 16.1198C29.3022 16.9168 29.75 17.9978 29.75 19.125Z" fill="currentColor"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M25.5 2.125C12.5906 2.125 2.125 12.5906 2.125 25.5C2.125 38.4094 12.5906 48.875 25.5 48.875C38.4094 48.875 48.875 38.4094 48.875 25.5C48.875 12.5906 38.4094 2.125 25.5 2.125ZM6.375 25.5C6.375 29.9412 7.89013 34.0297 10.4295 37.2767C12.2133 34.9353 14.5141 33.0377 17.1522 31.732C19.7904 30.4264 22.6946 29.7481 25.6381 29.75C28.5438 29.7466 31.4119 30.4068 34.0237 31.6803C36.6354 32.9538 38.9219 34.8069 40.7086 37.0982C42.5498 34.6834 43.7895 31.8648 44.3252 28.8757C44.8608 25.8867 44.6769 22.813 43.7888 19.9091C42.9007 17.0052 41.3338 14.3545 39.2179 12.1763C37.102 9.99818 34.4978 8.3552 31.6208 7.38333C28.7438 6.41146 25.6768 6.13864 22.6735 6.58744C19.6701 7.03624 16.8168 8.19377 14.3496 9.96424C11.8825 11.7347 9.87235 14.0672 8.48561 16.7688C7.09888 19.4704 6.375 22.4633 6.375 25.5ZM25.5 44.625C21.1096 44.6321 16.8516 43.1217 13.447 40.3495C14.8172 38.3873 16.6413 36.7852 18.7639 35.6797C20.8865 34.5742 23.2449 33.9979 25.6381 34C28.0015 33.9979 30.3313 34.5598 32.4338 35.639C34.5364 36.7182 36.3512 38.2836 37.7273 40.205C34.2964 43.0674 29.9681 44.632 25.5 44.625Z" fill="currentColor"/>
            </svg>
          </div>
          <div class="shortcut-info">
            <h4 class="shortcut-title">Perfil profesional</h4>
            <p class="shortcut-description">Mira y edita tus datos institucionales</p>
          </div>
        </div>
      </div>

      <!-- CREAR NUEVO CV -->
      <div class="col-12 col-md-6">
        <div class="shortcut-card" @click="$emit('abrirWizard')">
          <div class="shortcut-icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 51" fill="none" class="shortcut-icon">
              <g clip-path="url(#clip0_6048_420)">
                <path d="M43.875 0H4.875C2.19375 0 0 2.15156 0 4.78125V46.2188C0 48.8484 2.19375 51 4.875 51H43.875C46.5563 51 48.75 48.8484 48.75 46.2188V4.78125C48.75 2.15156 46.5563 0 43.875 0ZM42.25 44.625H6.5V6.375H42.25V44.625ZM13 28.6875H35.75V31.875H13V28.6875ZM13 35.0625H35.75V38.25H13V35.0625ZM16.25 14.3438C16.2502 13.7157 16.3766 13.0938 16.6218 12.5136C16.8671 11.9334 17.2265 11.4062 17.6795 10.9622C18.1325 10.5183 18.6702 10.1661 19.2619 9.92596C19.8537 9.6858 20.4878 9.56229 21.1283 9.5625C21.7687 9.56271 22.4028 9.68663 22.9943 9.92718C23.5859 10.1677 24.1234 10.5202 24.5761 10.9645C25.0288 11.4088 25.3878 11.9361 25.6327 12.5165C25.8775 13.0969 26.0035 13.7188 26.0033 14.3469C26.0028 15.6154 25.4886 16.8318 24.5738 17.7285C23.6589 18.6251 22.4184 19.1286 21.125 19.1282C19.8316 19.1278 18.5914 18.6235 17.6772 17.7262C16.7629 16.8289 16.2496 15.6122 16.25 14.3438ZM24.375 19.125H17.875C15.1938 19.125 13 20.5594 13 22.3125V25.5H29.25V22.3125C29.25 20.5594 27.0562 19.125 24.375 19.125Z" fill="currentColor"/>
              </g>
              <defs>
                <clipPath id="clip0_6048_420">
                  <rect width="52" height="51" fill="white"/>
                </clipPath>
              </defs>
            </svg>
          </div>
          <div class="shortcut-info">
            <h4 class="shortcut-title">Crear nuevo CV</h4>
            <p class="shortcut-description">Genera un cv PDF estructurado usando nuestra plantilla</p>
          </div>
        </div>
      </div>

      <!-- SUBIR INFORME -->
      <div class="col-12 col-md-6">
        <div class="shortcut-card" @click="$emit('cambiarSeccion', 'informes')">
          <div class="shortcut-icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shortcut-icon">
              <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
            </svg>
          </div>
          <div class="shortcut-info">
            <h4 class="shortcut-title">Subir informe</h4>
            <p class="shortcut-description">Entrega tus reportes de progreso mensuales o tu informe final.</p>
          </div>
        </div>
      </div>

      <!-- SOLICITAR SUPERVISOR -->
      <div class="col-12 col-md-6">
        <div class="shortcut-card" @click="realizarSolicitudSupervisor">
          <div class="shortcut-icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" fill="none" class="shortcut-icon">
              <path d="M26.0001 8.66675C28.2986 8.66675 30.503 9.57984 32.1283 11.2052C33.7537 12.8305 34.6667 15.0349 34.6667 17.3334C34.6667 19.632 33.7537 21.8364 32.1283 23.4617C30.503 25.087 28.2986 26.0001 26.0001 26.0001C23.7015 26.0001 21.4971 25.087 19.8718 23.4617C18.2465 21.8364 17.3334 19.632 17.3334 17.3334C17.3334 15.0349 18.2465 12.8305 19.8718 11.2052C21.4971 9.57984 23.7015 8.66675 26.0001 8.66675ZM26.0001 30.3334C35.5767 30.3334 43.3334 34.2117 43.3334 39.0001V43.3334H8.66675V39.0001C8.66675 34.2117 16.4234 30.3334 26.0001 30.3334Z" fill="currentColor"/>
            </svg>
          </div>
          <div class="shortcut-info">
            <h4 class="shortcut-title">Solicitar supervisor</h4>
            <p class="shortcut-description">Pide asignacion a un supervisor para iniciar tus practicas</p>
          </div>
        </div>
      </div>

    </div>

  </div>
</template>

<script setup>
import axios from 'axios';

const props = defineProps({
  usuario: Object,
  perfilCompleto: Object
});

const emit = defineEmits(['cambiarSeccion', 'abrirWizard']);

// Determina dinámicamente si una fase está completada
const isFaseCompletada = (faseIndex) => {
  const faseActual = props.perfilCompleto?.fase_actual || 'F1';
  const supervisorId = props.perfilCompleto?.supervisor_id;
  
  if (faseIndex === 1) {
    // Fase 1 (Curriculum) se considera completa si el pasante tiene registro
    return true; 
  }
  if (faseIndex === 2) {
    // Fase 2 (Aceptado) se considera completa si tiene supervisor asignado o fase es F2+
    return !!supervisorId || faseActual !== 'F1';
  }
  if (faseIndex === 3) {
    // Fase 3 (Prácticas) completa si está en F3 o F4
    return faseActual === 'F3' || faseActual === 'F4' || faseActual === 'Fase 3' || faseActual === 'Fase 4';
  }
  if (faseIndex === 4) {
    // Fase 4 (Informe final) completa si está en F4
    return faseActual === 'F4' || faseActual === 'Fase 4';
  }
  return false;
};

// Llama al endpoint para solicitar un supervisor de forma interactiva
const realizarSolicitudSupervisor = async () => {
  if (props.perfilCompleto?.supervisor_id) {
    alertify.warning('Ya tienes un supervisor asignado.');
    return;
  }
  
  try {
    const res = await axios.get('/api/pasante/solicitar-supervisor', {
      headers: {
        'X-User-Id': props.usuario?.id
      }
    });
    alertify.success(res.data.mensaje || 'Solicitud enviada exitosamente.');
  } catch (err) {
    const msg = err.response?.data?.mensaje || 'Error al solicitar supervisor.';
    alertify.error(msg);
  }
};
</script>

<style scoped>
.pasante-overview {
  background-color: #F4F4F4;
  min-height: 100%;
}

/* WELCOME BANNER */
.welcome-banner {
  background: #000B58;
  border-radius: 16px;
  padding: 30px 40px;
  color: white;
  display: flex;
  align-items: center;
  justify-content: space-between;
  box-shadow: 0 4px 15px rgba(0, 11, 88, 0.15);
  position: relative;
  overflow: hidden;
}

.banner-content {
  max-width: 75%;
  z-index: 2;
}

.banner-title {
  font-family: 'Lora', serif;
  font-size: 28px;
  font-weight: 500;
  margin-bottom: 8px;
}

.banner-subtitle {
  font-family: 'Inter', sans-serif;
  font-size: 15px;
  opacity: 0.9;
  line-height: 1.4;
  margin: 0;
}

.banner-icon-container {
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1;
}

.banner-icon-svg {
  width: 77px;
  height: 65px;
  transform: rotate(5deg);
}

/* STATUS CARD (Estado de mi pasantía) */
.status-card {
  background: white;
  border-radius: 16px;
  padding: 28px 32px;
  border: 1px solid #E5E7EB;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
}

.status-card-title {
  font-family: 'Inter', sans-serif;
  font-size: 16px;
  font-weight: 600;
  color: #1F2937;
  margin: 0;
}

.phase-icon-wrapper {
  width: 44px;
  height: 44px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.phase-icon {
  font-size: 24px;
  color: #1F2937;
}

.phase-name {
  font-family: 'Inter', sans-serif;
  font-size: 13px;
  font-weight: 600;
  color: #1F2937;
  margin-bottom: 8px;
}

.badge-status {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-family: 'Inter', sans-serif;
  font-size: 12px;
  font-weight: 500;
  padding: 4px 16px;
  border-radius: 20px;
}

.status-completed {
  background-color: #10A957;
  color: white;
}

.status-pending {
  background-color: #E5E7EB;
  color: #6B7280;
}

/* SHORTCUT CARDS */
.shortcut-card {
  background: white;
  border-radius: 16px;
  padding: 24px;
  display: flex;
  align-items: center;
  gap: 20px;
  border: 1px solid #E5E7EB;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
  cursor: pointer;
  transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  height: 100%;
}

.shortcut-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
}

.shortcut-icon-container {
  width: 54px;
  height: 54px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.shortcut-icon {
  width: 54px;
  height: 54px;
  color: #00589B;
}

.shortcut-info {
  display: flex;
  flex-direction: column;
}

.shortcut-title {
  font-family: 'Inter', sans-serif;
  font-size: 15px;
  font-weight: 600;
  color: #1F2937;
  margin: 0 0 4px 0;
}

.shortcut-description {
  font-family: 'Inter', sans-serif;
  font-size: 12px;
  color: #6B7280;
  margin: 0;
  line-height: 1.4;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .welcome-banner {
    padding: 20px 24px;
  }
  .banner-content {
    max-width: 100%;
  }
  .banner-icon-container {
    display: none;
  }
  .status-card {
    padding: 20px;
  }
}
</style>
