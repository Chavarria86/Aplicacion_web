<template>
  <div class="dashboard-layout" :class="{ 'dark-mode': darkActive }">
    
    <!-- OVERLAY FOR MOBILE SIDEBAR -->
    <div class="sidebar-overlay" v-if="sidebarOpen" @click="sidebarOpen = false"></div>

    <!-- SIDEBAR -->
    <aside class="dashboard-sidebar" :class="{ 'open': sidebarOpen }">
      <div class="sidebar-header">
        <!-- Tu nuevo logo en imagen y toggle de modo oscuro -->
        <div class="d-flex flex-column align-items-center w-100 gap-3">
          <img :src="'/images/logo_ugb.png'" alt="Logo UGB" class="ugb-logo-img">
        </div>
      </div>

      <nav class="sidebar-nav">
        <ul>
          <li
            v-for="item in navItems"
            :key="item.seccion"
            :class="{ active: seccionActiva === item.seccion || (item.alias && item.alias.includes(seccionActiva)), 'nav-logout': item.logout }"
            @click="item.logout ? cerrarSesion() : cambiarSeccion(item.seccion)"
          >
            <a href="#" class="d-flex align-items-center w-100 justify-content-between">
              <span class="d-flex align-items-center">
                <!-- Custom SVGs for Pasante Sidebar Navigation -->
                <template v-if="item.seccion === 'perfil'">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22" fill="none" class="me-3 sidebar-icon-svg">
                    <path d="M10.9778 0C12.4336 0 13.8297 0.578293 14.859 1.60766C15.8884 2.63703 16.4667 4.03315 16.4667 5.4889C16.4667 6.94465 15.8884 8.34077 14.859 9.37014C13.8297 10.3995 12.4336 10.9778 10.9778 10.9778C9.52206 10.9778 8.12593 10.3995 7.09656 9.37014C6.0672 8.34077 5.4889 6.94465 5.4889 5.4889C5.4889 4.03315 6.0672 2.63703 7.09656 1.60766C8.12593 0.578293 9.52206 0 10.9778 0ZM10.9778 13.7223C17.043 13.7223 21.9556 16.1785 21.9556 19.2112V21.9556H0V19.2112C0 16.1785 4.91257 13.7223 10.9778 13.7223Z" fill="currentColor"/>
                  </svg>
                </template>
                <template v-else-if="item.seccion === 'informes'">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" fill="none" class="me-3 sidebar-icon-svg">
                    <g clip-path="url(#clip0_4312_274)">
                      <path d="M20.8407 0H2.31563C1.04203 0 0 1.04203 0 2.31563V22.3844C0 23.658 1.04203 24.7001 2.31563 24.7001H20.8407C22.1143 24.7001 23.1563 23.658 23.1563 22.3844V2.31563C23.1563 1.04203 22.1143 0 20.8407 0ZM20.0688 21.6126H3.08751V3.08751H20.0688V21.6126ZM6.17501 13.8938H16.9813V15.4375H6.17501V13.8938ZM6.17501 16.9813H16.9813V18.525H6.17501V16.9813ZM7.71877 6.94689C7.71887 6.6427 7.77889 6.3415 7.89539 6.0605C8.01189 5.7795 8.1826 5.5242 8.39777 5.30917C8.61294 5.09415 8.86836 4.92361 9.14944 4.80729C9.43051 4.69098 9.73175 4.63116 10.0359 4.63126C10.3401 4.63136 10.6413 4.69138 10.9223 4.80788C11.2033 4.92439 11.4586 5.0951 11.6737 5.31027C11.8887 5.52543 12.0592 5.78085 12.1755 6.06193C12.2919 6.34301 12.3517 6.64424 12.3516 6.94844C12.3514 7.56278 12.1071 8.15189 11.6726 8.58615C11.238 9.02042 10.6487 9.26427 10.0344 9.26407C9.42005 9.26386 8.83095 9.01962 8.39668 8.58506C7.96242 8.15051 7.71856 7.56124 7.71877 6.94689ZM11.5782 9.26252H8.49065C7.21705 9.26252 6.17501 9.95721 6.17501 10.8063V12.35H13.8938V10.8063C13.8938 9.95721 12.8517 9.26252 11.5782 9.26252Z" fill="currentColor"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_4312_274">
                        <rect width="24.7001" height="24.7001" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
                </template>
                <template v-else-if="item.seccion === 'progreso'">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="me-3 sidebar-icon-svg">
                    <path d="M11.7068 23.4136C14.8116 23.4136 17.7893 22.1802 19.9848 19.9848C22.1802 17.7893 23.4136 14.8116 23.4136 11.7068C23.4136 8.60196 22.1802 5.62429 19.9848 3.42884C17.7893 1.23339 14.8116 0 11.7068 0C8.60196 0 5.62429 1.23339 3.42884 3.42884C1.23339 5.62429 0 8.60196 0 11.7068C0 14.8116 1.23339 17.7893 3.42884 19.9848C5.62429 22.1802 8.60196 23.4136 11.7068 23.4136ZM11.7068 5.8534V11.7068H15.8878C16.1096 11.7068 16.3223 11.7949 16.4791 11.9517C16.6359 12.1085 16.724 12.3212 16.724 12.543C16.724 12.7648 16.6359 12.9775 16.4791 13.1343C16.3223 13.2911 16.1096 13.3792 15.8878 13.3792H10.8706C10.6488 13.3792 10.4361 13.2911 10.2793 13.1343C10.1225 12.9775 10.0344 12.7648 10.0344 12.543V5.8534C10.0344 5.63163 10.1225 5.41893 10.2793 5.26212C10.4361 5.1053 10.6488 5.0172 10.8706 5.0172C11.0924 5.0172 11.3051 5.1053 11.4619 5.26212C11.6187 5.41893 11.7068 5.63163 11.7068 5.8534Z" fill="currentColor"/>
                  </svg>
                </template>
                <template v-else-if="item.seccion === 'chat_ia'">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="me-3 sidebar-icon-svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.53947 10.728C2.52388 9.64265 2.72418 8.56505 3.12873 7.55781C3.53328 6.55057 4.13401 5.63379 4.89601 4.86077C5.658 4.08775 6.56605 3.47391 7.56737 3.05493C8.56869 2.63595 9.64331 2.42018 10.7288 2.42018C11.8142 2.42018 12.8888 2.63595 13.8901 3.05493C14.8915 3.47391 15.7995 4.08775 16.5615 4.86077C17.3235 5.63379 17.9242 6.55057 18.3288 7.55781C18.7333 8.56505 18.9336 9.64265 18.918 10.728C18.8871 12.8795 18.0107 14.9325 16.4783 16.4431C14.9459 17.9536 12.8805 18.8004 10.7288 18.8004C8.57698 18.8004 6.51164 17.9536 4.97922 16.4431C3.44679 14.9325 2.57039 12.8795 2.53947 10.728ZM10.7279 1.21504e-07C9.03556 -0.000254582 7.36716 0.399937 5.85907 1.16787C4.35098 1.9358 3.046 3.04968 2.05077 4.41846C1.05555 5.78725 0.39833 7.37211 0.132826 9.0435C-0.132678 10.7149 0.00106865 12.4254 0.523136 14.0352C1.0452 15.645 1.94078 17.1085 3.13666 18.3059C4.33254 19.5034 5.7948 20.4009 7.40392 20.9251C9.01305 21.4493 10.7234 21.5853 12.3951 21.322C14.0669 21.322 15.6526 20.4035 17.0227 19.4101L20.7339 23.1214C21.051 23.4386 21.481 23.617 21.9296 23.6171C22.3781 23.6173 22.8083 23.4393 23.1255 23.1222C23.4428 22.8052 23.6211 22.3751 23.6213 21.9266C23.6214 21.4781 23.4434 21.0479 23.1264 20.7306L19.4134 17.0194C20.5727 15.4186 21.2671 13.5286 21.4201 11.5581C21.5731 9.58758 21.1786 7.6131 20.2803 5.8526C19.3819 4.09211 18.0146 2.61405 16.3292 1.58158C14.6439 0.549102 12.7061 0.00235791 10.7296 0.0016909L10.7279 1.21504e-07ZM9.46828 6.80707C9.56644 6.9052 9.6443 7.02171 9.69742 7.14994C9.75055 7.27816 9.77789 7.4156 9.77789 7.5544C9.77789 7.69319 9.75055 7.83063 9.69742 7.95886C9.6443 8.08708 9.56644 8.20359 9.46828 8.30172L6.83405 10.9376L9.46828 13.5719C9.66648 13.7701 9.77783 14.0389 9.77783 14.3192C9.77783 14.5995 9.66648 14.8683 9.46828 15.0665C9.27008 15.2647 9.00126 15.3761 8.72096 15.3761C8.44066 15.3761 8.17184 15.2647 7.97363 15.0665L4.59208 11.685C4.49392 11.5868 4.41606 11.4703 4.36293 11.3421C4.30981 11.2139 4.28247 11.0764 4.28247 10.9376C4.28247 10.7988 4.30981 10.6614 4.36293 10.5332C4.41606 10.405 4.49392 10.2884 4.59208 10.1903L7.97363 6.80876C8.07176 6.71061 8.18827 6.63274 8.3165 6.57962C8.44473 6.5265 8.58216 6.49915 8.72096 6.49915C8.85975 6.49915 8.99719 6.5265 9.12542 6.57962C9.25364 6.63274 9.37015 6.70892 9.46828 6.80707ZM13.6952 6.80707C13.497 6.60887 13.2282 6.49752 12.9479 6.49752C12.6676 6.49752 12.3988 6.60887 12.2006 6.80707C12.0024 7.00527 11.891 7.27409 11.891 7.5544C11.891 7.8347 12.0024 8.10352 12.2006 8.30172L14.8348 10.936L12.2006 13.5719C12.0024 13.7701 11.891 14.0389 11.891 14.3192C11.891 14.5995 12.0024 14.8683 12.2006 15.0665C12.3988 15.2647 12.6676 15.3761 12.9479 15.3761C13.2282 15.3761 13.497 15.2647 13.6952 15.0665L17.0768 11.685C17.1749 11.5868 17.2528 11.4703 17.3059 11.3421C17.359 11.2139 17.3864 11.0764 17.3864 10.9376C17.3864 10.7988 17.359 10.6614 17.3059 10.5332C17.2528 10.405 17.1749 10.2884 17.0768 10.1903L13.6952 6.80707Z" fill="currentColor"/>
                  </svg>
                </template>
                <template v-else-if="item.seccion === 'configuracion'">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34 34" fill="none" class="me-3 sidebar-icon-svg">
                    <path d="M17 28.0768C17.85 28.0768 18.5385 28.7682 18.5385 29.621C18.5385 30.4738 17.85 31.1666 17 31.1666C16.15 31.1666 15.4615 30.4753 15.4615 29.6224C15.4615 28.7696 16.15 28.0768 17 28.0768ZM18.8969 7.73067C19.1235 7.73067 19.3318 7.89784 19.3502 8.12025L19.7115 10.5668C20.2883 10.7916 20.8302 11.0973 21.3208 11.4749L23.6696 10.5484C23.8963 10.4748 24.1428 10.5484 24.2575 10.7524L26.1516 13.9598C26.265 14.1638 26.2083 14.4046 26.0383 14.5533L24.0295 16.0918C24.0861 16.3893 24.106 16.6854 24.106 16.9999C24.106 17.3144 24.0677 17.6119 24.0295 17.908L26.0553 19.4465C26.1406 19.5169 26.1986 19.6148 26.2196 19.7234C26.2405 19.832 26.223 19.9444 26.17 20.0415L24.276 23.2474C24.2153 23.3424 24.1245 23.4141 24.0181 23.4511C23.9117 23.4881 23.7959 23.4882 23.6895 23.4514L21.3208 22.5249C20.832 22.8952 20.2973 23.2004 19.7299 23.433L19.37 25.8796C19.3487 25.9894 19.2898 26.0883 19.2034 26.1593C19.1171 26.2304 19.0087 26.2693 18.8969 26.2692H15.1087C14.9959 26.2724 14.8857 26.2348 14.7985 26.1632C14.7113 26.0916 14.6529 25.9909 14.6341 25.8796L14.2743 23.433C13.6974 23.2083 13.1556 22.9025 12.665 22.5249L10.3161 23.4514C10.0895 23.5251 9.84296 23.4514 9.72821 23.2474L7.83413 20.0401C7.78111 19.9434 7.76343 19.8312 7.78411 19.7229C7.80479 19.6146 7.86255 19.5169 7.94746 19.4465L9.9563 17.908C9.87837 17.3051 9.87837 16.6947 9.9563 16.0918L7.94746 14.5533C7.85853 14.4856 7.79777 14.3874 7.77685 14.2775C7.75593 14.1677 7.77633 14.054 7.83413 13.9583L9.72821 10.7524C9.78892 10.6572 9.88 10.5852 9.9867 10.5482C10.0934 10.5112 10.2095 10.5113 10.3161 10.5484L12.665 11.4749C13.1627 11.1083 13.7031 10.8034 14.2743 10.5668L14.6341 8.12025C14.6556 8.01024 14.7147 7.91115 14.8013 7.84004C14.8879 7.76893 14.9966 7.73025 15.1087 7.73067H18.8969ZM5.04188 21.8903C5.21864 21.7917 5.41315 21.7291 5.61421 21.706C5.81527 21.6829 6.01891 21.6998 6.2134 21.7558C6.40789 21.8118 6.58939 21.9057 6.74744 22.0321C6.90549 22.1585 7.03696 22.3149 7.1343 22.4923C7.54513 23.2389 7.27596 24.1782 6.53363 24.5933C6.35694 24.6916 6.16255 24.7541 5.96164 24.777C5.76072 24.8 5.55725 24.783 5.36293 24.727C5.16861 24.6711 4.98726 24.5773 4.82932 24.451C4.67138 24.3247 4.53997 24.1684 4.44263 23.9912C4.24458 23.6327 4.19659 23.2104 4.30917 22.8167C4.42174 22.4229 4.68429 22.0898 5.04188 21.8903ZM26.8656 22.4923C26.963 22.3151 27.0944 22.1588 27.2523 22.0325C27.4103 21.9063 27.5916 21.8124 27.7859 21.7565C27.9803 21.7005 28.1837 21.6835 28.3846 21.7065C28.5855 21.7295 28.7799 21.7919 28.9566 21.8903C29.7004 22.3039 29.9681 23.2446 29.5573 23.9912C29.4598 24.1683 29.3283 24.3244 29.1704 24.4506C29.0124 24.5768 28.8311 24.6705 28.6368 24.7265C28.4426 24.7824 28.2392 24.7994 28.0383 24.7766C27.8374 24.7537 27.643 24.6914 27.4663 24.5933C27.1087 24.3937 26.8447 24.0606 26.7322 23.6668C26.6196 23.2731 26.6676 22.8508 26.8656 22.4923ZM17.0028 14.219C15.4303 14.219 14.161 15.4614 14.161 16.9999C14.161 18.5384 15.4303 19.7808 17.0028 19.7808C18.5753 19.7808 19.8432 18.5384 19.8432 16.9999C19.8432 15.4614 18.5739 14.219 17.0028 14.219ZM27.4663 9.40659C27.643 9.30824 27.8374 9.24579 28.0383 9.22283C28.2392 9.19987 28.4427 9.21686 28.637 9.27281C28.8313 9.32877 29.0127 9.42258 29.1706 9.54887C29.3285 9.67515 29.46 9.83142 29.5573 10.0087C29.9681 10.7553 29.699 11.6959 28.9566 12.1096C28.7799 12.2079 28.5855 12.2704 28.3846 12.2933C28.1837 12.3163 27.9803 12.2993 27.7859 12.2434C27.5916 12.2434 27.4103 12.0936 27.2523 11.9673C27.0944 11.841 26.963 11.6848 26.8656 11.5075C26.6676 11.1491 26.6196 10.7268 26.7322 10.333C26.8447 9.93928 27.1087 9.60617 27.4663 9.40659ZM4.44263 10.0087C4.54011 9.83155 4.67159 9.67543 4.82955 9.54925C4.98751 9.42307 5.16882 9.32932 5.36309 9.27338C5.55737 9.21744 5.76077 9.20041 5.96164 9.22327C6.16251 9.24613 6.35689 9.30843 6.53363 9.40659C7.27738 9.82025 7.54513 10.7609 7.1343 11.5075C7.03696 11.6848 6.90555 11.841 6.74761 11.9673C6.58967 12.0936 6.40832 12.1874 6.214 12.2434C6.01967 12.2993 5.81621 12.3163 5.61529 12.2933C5.41438 12.2704 5.21999 12.2079 5.0433 12.1096C4.68571 11.91 4.42174 11.5769 4.30917 11.1832C4.19659 10.7894 4.24458 10.3671 4.44263 10.0087ZM17 2.83325C17.85 2.83325 18.5385 3.52459 18.5385 4.37742C18.5385 5.23025 17.85 5.923 17 5.923C16.15 5.923 15.4615 5.23167 15.4615 4.37884C15.4615 3.526 16.15 2.83325 17 2.83325Z" fill="currentColor"/>
                  </svg>
                </template>
                <template v-else-if="item.seccion === 'logout'">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23 23" fill="none" class="me-3 sidebar-icon-svg">
                    <path d="M20.125 2.875H2.875C2.08437 2.875 1.4375 3.52187 1.4375 4.3125V18.6875C1.4375 19.4781 2.08437 20.125 2.875 20.125H20.125C20.9156 20.125 21.5625 19.4781 21.5625 18.6875V4.3125C21.5625 3.52187 20.9156 2.875 20.125 2.875ZM20.125 10.7812H12.7937L15.3812 8.19375L14.375 7.1875L10.0625 11.5L14.375 15.8125L15.3812 14.8063L12.7937 12.2188H20.125V18.6875H8.625V4.3125H20.125V10.7812Z" fill="currentColor"/>
                  </svg>
                </template>
                <i v-else :class="item.icon + ' me-3'"></i>
                <span>{{ item.label }}</span>
              </span>
              <span 
                v-if="item.seccion === 'chat_interno' && unreadMessagesCount > 0" 
                class="chat-notification-badge"
              >
                {{ unreadMessagesCount }}
              </span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- MAIN AREA -->
    <div class="main-area">
      <!-- MOBILE TOP BAR -->
      <header class="mobile-top-bar">
        <button class="menu-toggle-btn" @click="toggleSidebar">
          <i class="bi bi-list"></i>
        </button>
        <img :src="'/images/logo_ugb.png'" alt="Logo UGB" class="mobile-logo">
        <div style="width: 40px;"></div> <!-- spacer to center the logo roughly -->
      </header>

      <!-- MAIN CONTENT -->
      <main class="dashboard-content">
        <AiChatWindow
          v-if="seccionActiva === 'chat_ia'"
          :usuario="usuario"
        />
        <ConfiguracionApp
          v-else-if="seccionActiva === 'configuracion'"
          :isDark="darkActive"
          @toggleDarkMode="toggleDarkMode"
        />
        <ChatInterno
          v-else-if="seccionActiva === 'chat_interno'"
          :usuario="usuario"
          :socket="globalSocket"
          @activeChatChanged="handleActiveChatChanged"
        />
        <component 
          v-else
          :is="dashboardComponent" 
          :seccionActiva="seccionActiva" 
          :isDark="darkActive"
          @cambiarSeccion="cambiarSeccion"
        ></component>
      </main>
    </div>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import AiChatWindow from './AiChatWindow.vue';
import ConfiguracionApp from './ConfiguracionApp.vue';
import ChatInterno from './ChatInterno.vue';
import { io } from 'socket.io-client';

const seccionActiva = ref('dashboard');
const sidebarOpen = ref(false);
const darkActive = ref(localStorage.getItem('theme') === 'dark');

const toggleDarkMode = () => {
  darkActive.value = !darkActive.value;
  localStorage.setItem('theme', darkActive.value ? 'dark' : 'light');
};

import PasanteDashboard from './PasanteDashboard.vue';
import SupervisorDashboard from './SupervisorDashboard.vue';
import ViceDecanoDashboard from './ViceDecanoDashboard.vue';

const usuario = ref({});
const globalSocket = ref(null);
const unreadMessagesCount = ref(0);
const activeChatUserId = ref(null);

const initGlobalSocket = () => {
  if (globalSocket.value || !usuario.value.id) return;
  
  globalSocket.value = io('http://localhost:3000');
  
  globalSocket.value.on('connect', () => {
    globalSocket.value.emit('register_user', usuario.value.id);
  });
  
  globalSocket.value.on('msg_notification', (mensaje) => {
    if (seccionActiva.value !== 'chat_interno' || activeChatUserId.value !== mensaje.remitente_id) {
      unreadMessagesCount.value++;
      const remitenteName = mensaje.remitente_nombre || 'Usuario';
      alertify.success(`Nuevo mensaje de ${remitenteName}: "${mensaje.texto.substring(0, 30)}${mensaje.texto.length > 30 ? '...' : ''}"`);
    }
  });
};

const handleActiveChatChanged = (id) => {
  activeChatUserId.value = id;
};

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value;
};

onMounted(() => {
  const userJson = localStorage.getItem('usuario');
  if (!userJson) {
    window.location.href = '/login';
    return;
  }
  usuario.value = JSON.parse(userJson);
  initGlobalSocket();
});

const dashboardComponent = computed(() => {
  if (usuario.value.rol === 'pasante') return PasanteDashboard;
  if (usuario.value.rol === 'supervisor') return SupervisorDashboard;
  if (usuario.value.rol === 'vice_decano') return ViceDecanoDashboard;
  return null;
});

// ── Sidebar items según rol ─────────────────────────────────
const navItems = computed(() => {
  const rol = usuario.value.rol;

  if (rol === 'supervisor') {
    return [
      { seccion: 'dashboard',        label: 'Dashboard',           icon: 'bi bi-grid-fill' },
      { seccion: 'validar_cv',        label: 'Validar CVs',         icon: 'bi bi-check2-square' },
      { seccion: 'solicitudes',       label: 'Postulaciones',       icon: 'bi bi-person-plus-fill' },
      { seccion: 'mis_pasantes',      label: 'Mis Pasantes',        icon: 'bi bi-people-fill' },
      { seccion: 'evaluar_informes',  label: 'Evaluar Informes',    icon: 'bi bi-file-earmark-check-fill' },
      { seccion: 'ver_vacantes',      label: 'Sugerir Vacantes',    icon: 'bi bi-building-fill-add' },
      { seccion: 'chat_ia',           label: 'Análisis IA',         icon: 'bi bi-search-heart' },
      { seccion: 'chat_interno',      label: 'Mensajería',          icon: 'bi bi-chat-dots-fill' },
      { seccion: 'configuracion',     label: 'Configuración',       icon: 'bi bi-gear-fill' },
      { seccion: 'logout',            label: 'Cerrar sesión',       icon: 'bi bi-box-arrow-left', logout: true },
    ];
  }

  if (rol === 'vice_decano') {
    return [
      { seccion: 'dashboard',            label: 'Dashboard',             icon: 'bi bi-grid-fill' },
      { seccion: 'crear_vacantes',       label: 'Crear Vacantes',        icon: 'bi bi-plus-square-dotted' },
      { seccion: 'asignar_supervisores', label: 'Asignar Supervisores',  icon: 'bi bi-person-lines-fill' },
      { seccion: 'evaluar_informe',      label: 'Evaluar Informes',      icon: 'bi bi-file-earmark-check-fill' },
      { seccion: 'postulaciones',        label: 'Postulaciones',         icon: 'bi bi-list-check' },
      { seccion: 'vista_supervisores',   label: 'Modo Supervisor',       icon: 'bi bi-person-badge-fill' },
      { seccion: 'estadisticas',         label: 'Estadísticas',          icon: 'bi bi-bar-chart-fill' },
      { seccion: 'chat_ia',              label: 'Análisis IA',           icon: 'bi bi-search-heart' },
      { seccion: 'chat_interno',         label: 'Mensajería',            icon: 'bi bi-chat-dots-fill' },
      { seccion: 'configuracion',        label: 'Configuración',         icon: 'bi bi-gear-fill' },
      { seccion: 'logout',               label: 'Cerrar sesión',         icon: 'bi bi-box-arrow-left', logout: true },
    ];
  }

  // Pasante (default)
  return [
    { seccion: 'dashboard',     label: 'Dashboard',            icon: 'bi bi-grid-fill', alias: [] },
    { seccion: 'perfil',        label: 'Perfil',               alias: ['cv'] },
    { seccion: 'informes',      label: 'Informes' },
    { seccion: 'progreso',      label: 'Historial de progreso' },
    { seccion: 'chat_ia',       label: 'Análisis IA' },
    { seccion: 'configuracion', label: 'Configuración',        alias: [] },
    { seccion: 'logout',        label: 'Cerrar sesión',        logout: true },
  ];
});

const formatTitle = (seccion) => {
  const labels = {
    dashboard:            'Dashboard',
    perfil:               'Perfil Profesional',
    cv:                   'Mi Currículum Vitae',
    informes:             'Informes',
    vacantes:             'Vacantes Disponibles',
    progreso:             'Historial de Progreso',
    configuracion:        'Configuración',
    validar_cv:           'Validar CVs de Pasantes',
    asignar:              'Asignar Vacantes',
    mis_pasantes:         'Gestión de Pasantes',
    solicitudes:          'Solicitudes de Pasantes',
    evaluar_informes:     'Evaluar Informes y Validar Horas',
    ver_vacantes:         'Sugerir Vacantes a Pasantes',
    evaluar_informe:      'Evaluar Informes Finales',
    postulaciones:        'Postulaciones de Pasantes',
    estadisticas:         'Estadísticas Generales',
    crear_vacantes:       'Crear Nuevas Vacantes',
    asignar_supervisores: 'Asignación de Supervisores',
    vista_supervisores:   'Modo Supervisor Global',
    chat_ia:              'Análisis IA',
    chat_interno:         'Mensajería Interna',
  };
  return labels[seccion] ?? 'Dashboard';
};

const cambiarSeccion = (nuevaSeccion) => {
  seccionActiva.value = nuevaSeccion;
  sidebarOpen.value = false;
  if (nuevaSeccion === 'chat_interno') {
    unreadMessagesCount.value = 0;
  }
};

const cerrarSesion = () => {
  localStorage.removeItem('token');
  localStorage.removeItem('usuario');
  window.location.href = '/login';
};
</script>

<style scoped>
.dashboard-layout {
  display: flex;
  height: 100vh;
  width: 100vw;
  font-family: 'Inter', sans-serif;
  background-color: #F4F4F4;
  overflow: hidden;
  position: relative;
}

/* Sidebar Overlay */
.sidebar-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.4);
  z-index: 998;
}

/* Sidebar */
.dashboard-sidebar {
  width: 200px;
  background-color: #ffffff;
  display: flex;
  flex-direction: column;
  border-right: 1px solid #e2e8f0;
  box-shadow: 4px 0 20px rgba(0,0,0,0.04);
  flex-shrink: 0;
  z-index: 1000;
  height: 100%;
}

.sidebar-header {
  padding: 20px 15px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-bottom: 1px solid #e2e8f0;
}

.ugb-logo-img {
  max-width: 90%;
  max-height: 70px;
  object-fit: contain;
  display: block;
  margin: 0 auto;
}

.sidebar-nav {
  flex: 1;
  overflow-y: auto;
}

.sidebar-nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.sidebar-nav li {
  width: 100%;
}

.sidebar-nav li a, .nav-logout a {
  display: flex;
  align-items: center;
  padding: 12px 18px;
  color: #1e293b;
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  transition: all 0.2s ease;
}

.sidebar-nav li:hover a {
  background-color: #f1f5f9;
  color: #000B58;
}

.sidebar-nav li.active a {
  background-color: #000B58; /* Deep navy blue, matching banner */
  color: #ffffff;
  font-weight: 600;
}

.sidebar-nav li a i, .nav-logout a i {
  font-size: 20px;
  color: inherit;
}

.nav-logout {
  cursor: pointer;
  border-top: 1px solid #f1f5f9;
  margin-top: auto; /* Push logout to bottom if there's space */
}

.nav-logout:hover a {
  background-color: #fef2f2;
  color: #991b1b;
}

/* Main Area */
.main-area {
  display: flex;
  flex-direction: column;
  flex: 1;
  overflow: hidden;
  height: 100vh;
}

/* Mobile Top Bar */
.mobile-top-bar {
  display: none;
  height: 64px;
  background-color: #ffffff;
  border-bottom: 1px solid #e2e8f0;
  align-items: center;
  justify-content: space-between;
  padding: 0 20px;
  flex-shrink: 0;
  z-index: 90;
  box-shadow: 0 2px 10px rgba(0,0,0,0.02);
}

.menu-toggle-btn {
  background: none;
  border: none;
  font-size: 28px;
  color: #000B58;
  cursor: pointer;
  padding: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  transition: background-color 0.2s;
}

.menu-toggle-btn:hover {
  background-color: #f1f5f9;
}

.mobile-logo {
  height: 44px;
  object-fit: contain;
}

.dashboard-content {
  flex: 1;
  padding: 35px 40px;
  overflow-y: auto;
  background-color: #F4F4F4;
}

.sidebar-icon-svg {
  width: 20px;
  height: 20px;
  color: inherit;
  flex-shrink: 0;
}

/* Responsive Styles */
@media (max-width: 991px) {
  .mobile-top-bar {
    display: flex;
  }

  .dashboard-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    transform: translateX(-100%);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 10px 0 30px rgba(0,0,0,0.1);
  }

  .dashboard-sidebar.open {
    transform: translateX(0);
  }

  .dashboard-content {
    padding: 20px 16px;
  }
}

.chat-notification-badge {
  background-color: #dc2626;
  color: #ffffff;
  font-size: 11px;
  font-weight: 700;
  padding: 2px 7px;
  border-radius: 10px;
  min-width: 18px;
  text-align: center;
  margin-left: auto;
  box-shadow: 0 2px 4px rgba(220, 38, 38, 0.3);
  animation: pulseBadge 2s infinite;
}

@keyframes pulseBadge {
  0% { transform: scale(1); }
  50% { transform: scale(1.1); }
  100% { transform: scale(1); }
}
</style>
