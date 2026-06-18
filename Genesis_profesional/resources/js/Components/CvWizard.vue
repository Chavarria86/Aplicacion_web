<template>
  <div class="cv-wizard-overlay">
    <div class="cv-wizard-wrapper" :class="{ 'preview-mode': paso === 5 }">

      <!-- ===== HEADER ===== -->
      <div class="wiz-header">
        <div class="wiz-header-inner" :class="{ 'has-back-btn': paso > 0, 'preview-mode': paso === 5 }">
          <!-- Botón volver (flecha izquierda) a la altura de cerrar -->
          <button v-if="paso > 0" class="btn-volver-header" @click="handleAtras" title="Atrás">
            <i class="bi bi-arrow-left"></i>
          </button>

          <span v-if="paso === 0">Bienvenido a Genesis profesional! completa tu perfil profesional</span>
          <span v-else-if="paso === 1">Paso 1: Configuración del diseño</span>
          <span v-else-if="paso === 2">Paso 2: Información de Perfil</span>
          <span v-else-if="paso === 3">Paso 3: Objetivos y valores</span>
          <span v-else-if="paso === 4">Paso 4: Logros</span>
          <span v-else>Tu perfil ya casi está listo.</span>

          <!-- Botón cerrar / volver al dashboard siempre visible -->
          <button class="btn-cerrar-wizard" @click="confirmarSalida" title="Volver al Dashboard">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
      </div>

      <!-- ===== STEPPER (pasos 1-4) ===== -->
      <div class="wiz-stepper" v-if="paso >= 1 && paso <= 4">
        <div v-for="n in 4" :key="n" class="step-item">
          <div class="step-circle" 
               :class="{ active: paso >= n, clickable: cvAEditar || paso > n }" 
               @click="(cvAEditar || paso > n) ? paso = n : null">
            {{ n }}
          </div>
          <div class="step-line" v-if="n < 4" :class="{ active: paso > n }"></div>
        </div>
      </div>

      <!-- ===== PASO 0: INTRO + NOMBRE DEL CV ===== -->
      <div class="wiz-body paso0-onboarding-body" v-if="paso === 0">
        <div class="intro-title-text">
          Inicia la creación de tu perfil profesional siguiendo 4 sencillos pasos
        </div>

        <div class="intro-steps-container">
          <!-- STEP 1 CARD -->
          <div class="step-card-row row-left">
            <div class="step-card step-card-1">
              <div class="step-card-img-wrap">
                <img :src="'/images/cv_p1.png'" alt="Paso 1" class="step-card-img" />
              </div>
              <div class="step-card-content">
                <div class="step-card-title">Paso 1 Configuración del diseño:</div>
                <p class="step-card-desc">
                  Vas a elegir los colores y la letra para tu plantilla porque la primera impresión es importante.
                  Un diseño limpio y ordenado garantiza que los reclutadores no descarten tu CV a primera vista y puedan leerlo sin esfuerzo.
                </p>
              </div>
            </div>
            <!-- SVG Arrow 1: right side of card 1, goes down and left -->
            <div class="step-arrow-wrap arrow-1">
              <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 20 H70 V80" stroke="#7EADD3" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M60 70 L70 80 L80 70" stroke="#7EADD3" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
          </div>

          <!-- STEP 2 CARD -->
          <div class="step-card-row row-right">
            <!-- SVG Arrow 2: left side of card 2, goes down and left -->
            <div class="step-arrow-wrap arrow-2">
              <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M90 20 H30 V80" stroke="#67000F" stroke-opacity="0.5" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M20 70 L30 80 L40 70" stroke="#67000F" stroke-opacity="0.5" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="step-card step-card-2">
              <div class="step-card-img-wrap">
                <img :src="'/images/cv_p2.png'" alt="Paso 2" class="step-card-img" />
              </div>
              <div class="step-card-content">
                <div class="step-card-title">Paso 2: Información de Perfil</div>
                <p class="step-card-desc">
                  Aquí vas a poner tu foto, tus datos de contacto, tu carrera y un breve resumen sobre ti para que las empresas sepan quién eres.
                  Es fundamental porque si les interesa tu perfil, necesitan estos datos exactos para llamarte y agendar una entrevista.
                </p>
              </div>
            </div>
          </div>

          <!-- STEP 3 CARD -->
          <div class="step-card-row row-left">
            <div class="step-card step-card-3">
              <div class="step-card-img-wrap">
                <img :src="'/images/cv_p3.png'" alt="Paso 3" class="step-card-img" />
              </div>
              <div class="step-card-content">
                <div class="step-card-title">Paso 3: Objetivos y valores</div>
                <p class="step-card-desc">
                  En este paso vas a detallar tus metas, valores e idiomas, junto a tus conocimientos.
                  Esto sirve para demostrarle a la empresa que tienes las bases teóricas necesarias para el puesto y la actitud correcta para adaptarse a su equipo.
                </p>
              </div>
            </div>
            <!-- SVG Arrow 3: right side of card 3, goes down and right -->
            <div class="step-arrow-wrap arrow-3">
              <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 20 H70 V80" stroke="#FAD2A8" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M60 70 L70 80 L80 70" stroke="#FAD2A8" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
          </div>

          <!-- STEP 4 CARD -->
          <div class="step-card-row row-right">
            <div class="step-card step-card-4">
              <div class="step-card-img-wrap">
                <img :src="'/images/cv_p4.png'" alt="Paso 4" class="step-card-img" />
              </div>
              <div class="step-card-content">
                <div class="step-card-title">Paso 4: Logros</div>
                <p class="step-card-desc">
                  Vas a registrar tus certificados, tus premios y tus proyectos para demostrar tu talento.
                  Como estudiante, esta sección es tu mayor ventaja porque demuestra que eres proactivo, que te gusta aprender por tu cuenta y te hace resaltar entre los demás.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ===== PASO 1: DISEÑO ===== -->
      <div class="wiz-body paso1-body" v-else-if="paso === 1">
        <div class="paso1-left">
          <p class="label-section">Color de la Plantilla</p>
          <div class="color-options">
            <div v-for="c in colores" :key="c.val"
              class="color-circle"
              :style="{ backgroundColor: c.val }"
              :class="{ selected: diseno.color === c.val }"
              @click="diseno.color = c.val">
            </div>
          </div>
          <p class="label-section" style="margin-top:28px">Tipo de letra</p>
          <select class="font-select" v-model="diseno.fuente">
            <option v-for="f in fuentes" :key="f" :value="f">{{ f }}</option>
          </select>
        </div>
        <div class="paso1-right">
          <div class="cv-mini-preview" :style="{ fontFamily: diseno.fuente, '--cv-color': diseno.color }">
            <div class="mini-header" :style="{ backgroundColor: diseno.color }">
              <div class="mini-avatar"></div>
              <div>
                <div class="mini-name">YOUR NAME</div>
                <div class="mini-job">JOB TITLE</div>
              </div>
            </div>
            <div class="mini-body">
              <div class="mini-col left-col">
                <div class="mini-section-title" :style="{ borderColor: diseno.color }">CONTACT</div>
                <div class="mini-line"></div><div class="mini-line short"></div><div class="mini-line"></div>
                <div class="mini-section-title mt" :style="{ borderColor: diseno.color }">ABOUT ME</div>
                <div class="mini-line"></div><div class="mini-line"></div><div class="mini-line short"></div>
                <div class="mini-section-title mt" :style="{ borderColor: diseno.color }">SKILLS</div>
                <div class="mini-skill"><div class="skill-bar" :style="{ backgroundColor: diseno.color, width: '70%' }"></div></div>
                <div class="mini-skill"><div class="skill-bar" :style="{ backgroundColor: diseno.color, width: '50%' }"></div></div>
              </div>
              <div class="mini-col right-col">
                <div class="mini-section-title" :style="{ borderColor: diseno.color }">EDUCATION</div>
                <div class="mini-line"></div><div class="mini-line short"></div>
                <div class="mini-section-title mt" :style="{ borderColor: diseno.color }">EXPERIENCE</div>
                <div class="mini-line"></div><div class="mini-line short"></div><div class="mini-line"></div>
                <div class="mini-section-title mt" :style="{ borderColor: diseno.color }">LANGUAGES</div>
                <div class="mini-line short"></div><div class="mini-line short"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ===== PASO 2: PERFIL ===== -->
      <div class="wiz-body paso2-body" v-else-if="paso === 2">
        <div class="paso2-left">
          <div class="foto-wrap" @click="$refs.fotoInput.click()">
            <img v-if="perfil.fotoUrl" :src="perfil.fotoUrl" class="foto-preview" alt="foto" />
            <div v-else class="foto-placeholder"><i class="bi bi-person-fill"></i></div>
            <div class="foto-camara"><i class="bi bi-camera-fill"></i></div>
          </div>
          <p class="foto-label">Subir foto</p>
          <input ref="fotoInput" type="file" accept="image/*" style="display:none" @change="cargarFoto" />

          <div class="field-group">
            <label><i class="bi bi-person"></i> Nombre completo:</label>
            <input class="wiz-input" v-model="perfil.nombre" placeholder="Tu nombre completo" />
          </div>
          <div class="field-group">
            <label><i class="bi bi-briefcase"></i> Título profesional / Especialidad:</label>
            <input class="wiz-input" v-model="perfil.profesion" placeholder="Ej: Egresada de Ingeniería en sistemas..." />
          </div>
          <div class="field-group">
            <label><i class="bi bi-geo-alt"></i> Dirección:</label>
            <input class="wiz-input" v-model="perfil.direccion" placeholder="Ciudad, País" />
          </div>
          <div class="field-group">
            <label><i class="bi bi-envelope"></i> Email</label>
            <input class="wiz-input" v-model="perfil.email" placeholder="correo@ugb.edu.sv" />
          </div>
          <div class="field-group">
            <label><i class="bi bi-telephone"></i> Teléfono:</label>
            <input class="wiz-input" v-model="perfil.telefono" placeholder="7000-0000" />
          </div>
        </div>
        <div class="paso2-right">
          <div class="field-group">
            <label><i class="bi bi-chat-text"></i> Sobre mi:</label>
            <textarea class="wiz-textarea" v-model="perfil.sobreMi" placeholder="ej. Soy una persona apasionada por la tecnología..."></textarea>
          </div>
          <div class="field-group">
            <label><i class="bi bi-mortarboard"></i> Educación:</label>
            <textarea class="wiz-textarea" v-model="perfil.educacion" placeholder="Universidad, carrera, año..."></textarea>
          </div>
        </div>
      </div>

      <!-- ===== PASO 3: OBJETIVOS ===== -->
      <div class="wiz-body paso3-body" v-else-if="paso === 3">
        <div class="paso3-grid">
          <div class="field-group">
            <label><i class="bi bi-bullseye"></i> Mi objetivo:</label>
            <textarea class="wiz-textarea tall" v-model="objetivos.objetivo" placeholder="Incorporarme y consolidarme en un equipo..."></textarea>
          </div>
          <div class="field-group">
            <label><i class="bi bi-patch-check"></i> Valores profesionales</label>
            <textarea class="wiz-textarea tall" v-model="objetivos.valores" placeholder="– Liderazgo.&#10;– Compromiso.&#10;– Trabajo en equipo."></textarea>
          </div>
          <div class="field-group">
            <label><i class="bi bi-briefcase"></i> Conocimientos</label>
            <textarea class="wiz-textarea tall" v-model="objetivos.conocimientos" placeholder="Conocimientos en redes, seguridad..."></textarea>
          </div>
          <div class="field-group">
            <label><i class="bi bi-flag"></i> Idiomas</label>
            <textarea class="wiz-textarea tall" v-model="objetivos.idiomas" placeholder="– Español nativo&#10;– Inglés básico"></textarea>
          </div>
        </div>
      </div>

      <!-- ===== PASO 4: LOGROS ===== -->
      <div class="wiz-body paso3-body" v-else-if="paso === 4">
        <div class="paso3-grid">
          <div class="field-group">
            <label><i class="bi bi-award"></i> Certificados:</label>
            <textarea class="wiz-textarea tall" v-model="logros.certificados" placeholder="– CCNAv7: Introduction to Networks.&#10;– ..."></textarea>
          </div>
          <div class="field-group">
            <label><i class="bi bi-tools"></i> Habilidades:</label>
            <textarea class="wiz-textarea tall" v-model="logros.habilidades" placeholder="– Facilidad para expresarme..."></textarea>
          </div>
          <div class="field-group">
            <label><i class="bi bi-trophy"></i> Logros:</label>
            <textarea class="wiz-textarea tall" v-model="logros.logros" placeholder="Primer lugar en innovación..."></textarea>
          </div>
          <div class="field-group">
            <label><i class="bi bi-heart"></i> Proyectos de beneficio social:</label>
            <textarea class="wiz-textarea tall" v-model="logros.proyectos" placeholder="Asociación Juvenil..."></textarea>
          </div>
        </div>
      </div>

      <!-- ===== PASO 5: PREVIEW ===== -->
      <div class="wiz-body preview-body" v-else-if="paso === 5">
        <div class="preview-main-title">Vista previa</div>
        
        <div class="preview-container">
          <div id="cv-preview-render" class="cv-full-preview" :style="{ fontFamily: diseno.fuente, '--cv-color': diseno.color }">
            <!-- CABECERA DE ANCHO COMPLETO -->
            <div class="cvp-header" :style="{ backgroundColor: diseno.color }">
              <div class="cvp-header-foto-wrap">
                <img v-if="perfil.fotoUrl" :src="perfil.fotoUrl" class="cvp-header-foto" />
                <div v-else class="cvp-header-foto-placeholder"><i class="bi bi-person-fill"></i></div>
              </div>
              <div class="cvp-header-text">
                <h1 class="cvp-name">{{ perfil.nombre || 'Tu Nombre' }}</h1>
                <p class="cvp-subtitle">{{ perfil.profesion || 'Tu Título Profesional / Especialidad' }}</p>
              </div>
            </div>

            <!-- CUERPO DE DOS COLUMNAS -->
            <div class="cvp-content">
              <!-- COLUMNA IZQUIERDA -->
              <div class="cvp-column left-column">
                <!-- Contacto -->
                <div class="cvp-contact-info">
                  <div class="cvp-contact-item" v-if="perfil.direccion">
                    <i class="bi bi-geo-alt-fill" :style="{ color: diseno.color }"></i>
                    <span class="cvp-contact-label" :style="{ color: diseno.color }">Dirección:</span>
                    <span class="cvp-contact-val">{{ perfil.direccion }}</span>
                  </div>
                  <div class="cvp-contact-item" v-if="perfil.email">
                    <i class="bi bi-envelope-fill" :style="{ color: diseno.color }"></i>
                    <span class="cvp-contact-label" :style="{ color: diseno.color }">Email:</span>
                    <span class="cvp-contact-val">{{ perfil.email }}</span>
                  </div>
                  <div class="cvp-contact-item" v-if="perfil.telefono">
                    <i class="bi bi-telephone-fill" :style="{ color: diseno.color }"></i>
                    <span class="cvp-contact-label" :style="{ color: diseno.color }">Teléfono:</span>
                    <span class="cvp-contact-val">{{ perfil.telefono }}</span>
                  </div>
                </div>

                <!-- Sobre Mí -->
                <div class="cvp-section" v-if="perfil.sobreMi">
                  <h3 class="cvp-section-title" :style="{ color: diseno.color }">
                    <i class="bi bi-file-earmark-person-fill"></i> Sobre mí:
                  </h3>
                  <p class="cvp-section-text">{{ perfil.sobreMi }}</p>
                </div>

                <!-- Conocimientos -->
                <div class="cvp-section" v-if="objetivos.conocimientos">
                  <h3 class="cvp-section-title" :style="{ color: diseno.color }">
                    <i class="bi bi-brain-fill"></i> Conocimientos:
                  </h3>
                  <p class="cvp-section-text pre">{{ objetivos.conocimientos }}</p>
                </div>

                <!-- Mi Objetivo -->
                <div class="cvp-section" v-if="objetivos.objetivo">
                  <h3 class="cvp-section-title" :style="{ color: diseno.color }">
                    <i class="bi bi-bullseye"></i> Mi objetivo:
                  </h3>
                  <p class="cvp-section-text">{{ objetivos.objetivo }}</p>
                </div>

                <!-- Certificados -->
                <div class="cvp-section" v-if="logros.certificados">
                  <h3 class="cvp-section-title" :style="{ color: diseno.color }">
                    <i class="bi bi-award-fill"></i> Certificados:
                  </h3>
                  <p class="cvp-section-text pre">{{ logros.certificados }}</p>
                </div>

                <!-- Proyectos de beneficio social -->
                <div class="cvp-section" v-if="logros.proyectos">
                  <h3 class="cvp-section-title" :style="{ color: diseno.color }">
                    <i class="bi bi-heart-fill"></i> Proyectos de beneficio social:
                  </h3>
                  <p class="cvp-section-text pre">{{ logros.proyectos }}</p>
                </div>
              </div>

              <!-- COLUMNA DERECHA -->
              <div class="cvp-column right-column">
                <!-- Educación -->
                <div class="cvp-section" v-if="perfil.educacion">
                  <h3 class="cvp-section-title" :style="{ color: diseno.color }">
                    <i class="bi bi-mortarboard-fill"></i> Educación:
                  </h3>
                  <p class="cvp-section-text pre">{{ perfil.educacion }}</p>
                </div>

                <!-- Idiomas -->
                <div class="cvp-section" v-if="objetivos.idiomas">
                  <h3 class="cvp-section-title" :style="{ color: diseno.color }">
                    <i class="bi bi-flag-fill"></i> Idiomas:
                  </h3>
                  <p class="cvp-section-text pre">{{ objetivos.idiomas }}</p>
                </div>

                <!-- Valores profesionales -->
                <div class="cvp-section" v-if="objetivos.valores">
                  <h3 class="cvp-section-title" :style="{ color: diseno.color }">
                    <i class="bi bi-patch-check-fill"></i> Valores profesionales:
                  </h3>
                  <p class="cvp-section-text pre">{{ objetivos.valores }}</p>
                </div>

                <!-- Habilidades -->
                <div class="cvp-section" v-if="logros.habilidades">
                  <h3 class="cvp-section-title" :style="{ color: diseno.color }">
                    <i class="bi bi-tools"></i> Habilidades:
                  </h3>
                  <p class="cvp-section-text pre">{{ logros.habilidades }}</p>
                </div>

                <!-- Logros -->
                <div class="cvp-section" v-if="logros.logros">
                  <h3 class="cvp-section-title" :style="{ color: diseno.color }">
                    <i class="bi bi-trophy-fill"></i> Logros:
                  </h3>
                  <p class="cvp-section-text pre">{{ logros.logros }}</p>
                </div>
              </div>
            </div>
          </div>

          <div class="preview-actions-panel">
            <button class="btn-preview-action btn-outline" @click="paso = 1" style="font-style: italic;">
              Editar <i class="bi bi-pencil ms-1"></i>
            </button>
            <button class="btn-preview-action btn-outline" @click="soloDescargar">
              Imprimir cv
            </button>
            <button class="btn-preview-action btn-solid" @click="soloGuardar" :disabled="guardando">
              <span v-if="guardando" class="spinner-border spinner-border-sm me-1"></span>
              Guardar
            </button>
            <button class="btn-preview-action btn-outline" @click="soloDescargar" :disabled="descargando">
              <span v-if="descargando" class="spinner-border spinner-border-sm me-1"></span>
              Descargar CV
            </button>
          </div>
        </div>
        <p v-if="generando" class="gen-msg"><span class="spinner-border spinner-border-sm me-2"></span> Generando y guardando CV...</p>
      </div>

      <!-- ===== BOTONES INFERIORES ===== -->
      <div class="wiz-footer" v-if="paso < 5">
        <!-- Botón izquierdo: Cancelar (paso 0) o Atrás -->
        <div class="footer-left">
          <button class="btn-wiz btn-atras" @click="paso === 0 ? confirmarSalida() : handleAtras()">
            <i :class="paso === 0 ? 'bi bi-x-lg' : 'bi bi-arrow-left'" class="me-1"></i>
            {{ paso === 0 ? 'Cancelar' : 'Atrás' }}
          </button>
        </div>

        <!-- Botón derecho: acciones -->
        <div class="footer-right">
          <!-- Pasos 0-4: botón Siguiente / Vista Previa -->
          <button class="btn-wiz btn-siguiente" @click="handleSiguiente" :disabled="generando || (paso === 0 && !tituloCv.trim())">
            <span v-if="generando" class="spinner-border spinner-border-sm me-2"></span>
            <span v-if="paso === 4"><i class="bi bi-eye me-1"></i> Vista Previa</span>
            <span v-else-if="paso === 0">Iniciar &nbsp;<i class="bi bi-arrow-right"></i></span>
            <span v-else>Siguiente &nbsp;<i class="bi bi-arrow-right"></i></span>
          </button>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { jsPDF } from 'jspdf';
import html2canvas from 'html2canvas';
import axios from 'axios';

const props = defineProps({
  cvAEditar: { type: Object, default: null }
});

const emit = defineEmits(['cerrar', 'guardado']);

const paso = ref(0);
const generando = ref(false);
const guardandoParcial = ref(false);
const guardando = ref(false);
const descargando = ref(false);

// Título personalizado del CV
const tituloCv = ref('Mi Currículum');

const colores = [
  { val: '#010C67' },
  { val: '#67000F' },
  { val: '#2E6A8E' },
  { val: '#1a5c3a' },
  { val: '#4a0072' },
];

const fuentes = ['Montserrat', 'Inter', 'Lora', 'Roboto', 'Georgia'];

const diseno    = ref({ color: '#67000F', fuente: 'Montserrat' });
const perfil    = ref({ nombre: '', profesion: '', direccion: '', email: '', telefono: '', sobreMi: '', educacion: '', fotoUrl: '' });
const objetivos = ref({ objetivo: '', valores: '', conocimientos: '', idiomas: '' });
const logros    = ref({ certificados: '', habilidades: '', logros: '', proyectos: '' });

onMounted(() => {
  if (props.cvAEditar) {
    const cv = props.cvAEditar;
    tituloCv.value = cv.titulo_cv || '';
    diseno.value.color = cv.color_plantilla || '#67000F';
    diseno.value.fuente = cv.fuente || 'Montserrat';
    
    perfil.value.nombre = cv.nombre_completo || '';
    perfil.value.profesion = cv.profesion || '';
    perfil.value.fotoUrl = cv.foto_url || '';
    perfil.value.direccion = cv.direccion || '';
    perfil.value.email = cv.email || '';
    perfil.value.telefono = cv.telefono || '';
    perfil.value.sobreMi = cv.sobre_mi || '';
    perfil.value.educacion = cv.educacion || '';
    
    objetivos.value.objetivo = cv.objetivo || '';
    objetivos.value.valores = cv.valores || '';
    objetivos.value.conocimientos = cv.conocimientos || '';
    objetivos.value.idiomas = cv.idiomas || '';
    
    logros.value.certificados = cv.certificados || '';
    logros.value.habilidades = cv.habilidades || '';
    logros.value.logros = cv.logros || '';
    logros.value.proyectos = cv.proyectos_sociales || '';

    // Si está editando, saltamos el paso de bienvenida
    paso.value = 1;
  }
});

const cargarFoto = (e) => {
  const file = e.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = (ev) => { perfil.value.fotoUrl = ev.target.result; };
  reader.readAsDataURL(file);
};

// Confirmación antes de salir
const confirmarSalida = () => {
  alertify.confirm(
    'Salir del Asistente',
    '¿Seguro que deseas salir del asistente de Currículum? Se perderán los cambios no guardados.',
    () => emit('cerrar'),
    () => {}
  ).set({ labels: { ok: 'Sí, salir', cancel: 'Cancelar' } });
};

const handleAtras = () => {
  if (paso.value > 0) paso.value--;
};

const handleSiguiente = async () => {
  if (paso.value === 0 && !tituloCv.value.trim()) {
    alertify.warning('Por favor ponle un nombre a tu CV antes de continuar.');
    return;
  }
  if (paso.value < 5) {
    paso.value++;
    return;
  }
};

// Guardar avance parcial (sin PDF, solo datos)
const guardarParcial = async () => {
  guardandoParcial.value = true;
  const usuarioStr = localStorage.getItem('usuario');
  if (!usuarioStr) { guardandoParcial.value = false; return; }
  const usuario = JSON.parse(usuarioStr);
  try {
    await axios.post('/api/cv/guardar', {
      usuario_id: usuario.id,
      cv_id: props.cvAEditar?.id || null,
      pdf_base64: '',
      titulo_cv: tituloCv.value.trim() || 'Mi CV',
      perfil: perfil.value,
      objetivos: objetivos.value,
      logros: logros.value,
      diseno: diseno.value,
    });
    alertify.success('Avance guardado correctamente.');
    emit('guardado');
  } catch (err) {
    alertify.error('Error al guardar el avance. Inténtalo de nuevo.');
  } finally {
    guardandoParcial.value = false;
  }
};

// Captura el elemento CV como PDF y lo retorna
const capturarPdf = async () => {
  const el = document.getElementById('cv-preview-render');
  if (!el) throw new Error('No se encontró el elemento de vista previa.');

  // Clonar fuera del overlay fijo para que html2canvas lo capture bien
  const clone = el.cloneNode(true);
  clone.style.cssText = 'position:absolute;top:-9999px;left:-9999px;width:794px;background:#fff;';
  document.body.appendChild(clone);

  try {
    // scale:1.5 + JPEG 80% reduce el tamaño del payload significativamente
    const canvas = await html2canvas(clone, { scale: 1.5, useCORS: true, allowTaint: true, logging: false });
    const imgData = canvas.toDataURL('image/jpeg', 0.80);
    const pdf = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });
    const pdfW = pdf.internal.pageSize.getWidth();
    const pdfH = (canvas.height * pdfW) / canvas.width;
    pdf.addImage(imgData, 'JPEG', 0, 0, pdfW, pdfH);
    return pdf;
  } finally {
    document.body.removeChild(clone);
  }
};



// Solo descargar PDF (sin guardar en servidor)
const soloDescargar = async () => {
  descargando.value = true;
  try {
    const pdf = await capturarPdf();
    const nombre = (tituloCv.value.trim() || 'CV').replace(/\s+/g, '_');
    pdf.save(`${nombre}.pdf`);
    alertify.success('PDF descargado correctamente.');
  } catch (err) {
    console.error(err);
    alertify.error('Error al generar el PDF. Intenta de nuevo.');
  } finally {
    descargando.value = false;
  }
};

// Solo guardar en servidor (sin descargar)
const soloGuardar = async () => {
  guardando.value = true;
  try {
    const pdf = await capturarPdf();
    const pdfBase64 = pdf.output('datauristring');
    const usuarioStr = localStorage.getItem('usuario');
    if (!usuarioStr) {
      alertify.error('Sesión no encontrada. Inicia sesión de nuevo.');
      return;
    }
    const usuario = JSON.parse(usuarioStr);
    await axios.post('/api/cv/guardar', {
      usuario_id: usuario.id,
      cv_id: props.cvAEditar?.id || null,
      pdf_base64: pdfBase64,
      titulo_cv: tituloCv.value.trim() || 'Mi CV',
      perfil: perfil.value,
      objetivos: objetivos.value,
      logros: logros.value,
      diseno: diseno.value,
    });
    alertify.success('CV guardado correctamente en el sistema.');
    emit('guardado');
    setTimeout(() => emit('cerrar'), 1500);
  } catch (err) {
    console.error(err);
    alertify.error('Error al guardar el CV: ' + (err.response?.data?.mensaje || err.message));
  } finally {
    guardando.value = false;
  }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Inter:wght@400;500&family=Lora:wght@400;600&family=Roboto:wght@400;500&display=swap');

.cv-wizard-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.6);
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: center;
}

.cv-wizard-wrapper {
  background: #fff;
  width: 92%;
  max-width: 920px;
  max-height: 94vh;
  border-radius: 6px;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  box-shadow: 0 24px 70px rgba(0,0,0,0.45);
}

/* Header */
.wiz-header {
  background: #010C67;
  color: #fff;
  flex-shrink: 0;
}

.wiz-header-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 28px;
  font-family: 'Lora', serif;
  font-size: 18px;
  position: relative;
}

.wiz-header-inner.has-back-btn {
  padding-left: 76px;
}

.btn-volver-header {
  background: rgba(255,255,255,0.15);
  border: 1px solid rgba(255,255,255,0.3);
  color: #fff;
  border-radius: 6px;
  width: 34px; height: 34px;
  display: flex; align-items: center; justify-content: center;
  font-size: 15px;
  cursor: pointer;
  flex-shrink: 0;
  transition: background 0.2s;
  position: absolute;
  left: 28px;
  top: 50%;
  transform: translateY(-50%);
}
.btn-volver-header:hover { background: rgba(255,255,255,0.3); }

.btn-cerrar-wizard {
  background: rgba(255,255,255,0.15);
  border: 1px solid rgba(255,255,255,0.3);
  color: #fff;
  border-radius: 6px;
  width: 34px; height: 34px;
  display: flex; align-items: center; justify-content: center;
  font-size: 15px;
  cursor: pointer;
  flex-shrink: 0;
  transition: background 0.2s;
}
.btn-cerrar-wizard:hover { background: rgba(255,255,255,0.3); }

/* Stepper */
.wiz-stepper {
  display: flex; align-items: center;
  padding: 16px 40px 8px; flex-shrink: 0;
}
.step-item { display: flex; align-items: center; }
.step-circle {
  width: 34px; height: 34px; border-radius: 50%;
  background: #ccc; color: #fff; font-weight: 700; font-size: 14px;
  display: flex; align-items: center; justify-content: center;
  transition: background 0.3s;
}
.step-circle.clickable { cursor: pointer; }
.step-circle.active { background: #010C67; }
.step-line { flex: 1; height: 3px; background: #ccc; min-width: 55px; transition: background 0.3s; }
.step-line.active { background: #010C67; }

/* Body */
.wiz-body {
  flex: 1; overflow-y: auto; padding: 24px 40px;
}

/* Paso 0 — nombre del CV */
.paso0-onboarding-body {
  background: #ffffff;
  padding: 24px 40px;
}

.intro-title-text {
  font-family: 'Lora', serif;
  font-size: 20px;
  font-weight: 700;
  color: #000B58;
  text-align: center;
  margin-top: 10px;
  margin-bottom: 30px;
}

.intro-steps-container {
  display: flex;
  flex-direction: column;
  gap: 35px;
  position: relative;
  max-width: 820px;
  margin: 0 auto;
  padding: 10px 0 30px;
}

.step-card-row {
  display: flex;
  width: 100%;
  position: relative;
}

.row-left {
  justify-content: flex-start;
}

.row-right {
  justify-content: flex-end;
}

.step-card {
  width: 455px;
  min-height: 163px;
  border-radius: 12px;
  padding: 18px;
  display: flex;
  align-items: center;
  gap: 16px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
  box-sizing: border-box;
  color: #ffffff;
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.step-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}

.step-card-img-wrap {
  flex-shrink: 0;
  width: 135px;
  height: 120px;
  border-radius: 10px;
  overflow: hidden;
  background: rgba(255, 255, 255, 0.15);
}

.step-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.step-card-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.step-card-title {
  font-family: 'Inter', sans-serif;
  font-weight: 700;
  font-size: 14px;
  text-decoration: underline;
  text-underline-offset: 3px;
}

.step-card-desc {
  font-family: 'Inter', sans-serif;
  font-size: 11.5px;
  line-height: 1.45;
  margin: 0;
  opacity: 0.95;
}

/* Card Colors */
.step-card-1 {
  background: #00589B;
  border: 1px solid rgba(0, 88, 155, 0.3);
}

.step-card-2 {
  background: #67000F;
  border: 1px solid rgba(103, 0, 15, 0.3);
}

.step-card-3 {
  background: #8e95a5;
  border: 1px solid rgba(142, 149, 165, 0.3);
}

.step-card-4 {
  background: #10B981;
  border: 1px solid rgba(16, 185, 129, 0.3);
}

/* Arrow placement & styling */
.step-arrow-wrap {
  position: absolute;
  width: 100px;
  height: 100px;
  pointer-events: none;
  display: flex;
  align-items: center;
  justify-content: center;
}

.arrow-1 {
  left: 480px;
  top: 70px;
}

.arrow-2 {
  right: 480px;
  top: 70px;
}

.arrow-3 {
  left: 480px;
  top: 70px;
}

/* Paso 1 */
.paso1-body { display: flex; gap: 40px; align-items: flex-start; }
.paso1-left { flex: 0 0 220px; }
.paso1-right { flex: 1; display: flex; justify-content: center; }
.label-section { font-family: 'Lora', serif; font-size: 17px; font-weight: 700; margin-bottom: 12px; color: #111; }
.color-options { display: flex; gap: 12px; flex-wrap: wrap; }
.color-circle {
  width: 36px; height: 36px; border-radius: 50%;
  cursor: pointer; border: 3px solid transparent;
  transition: transform 0.2s, border-color 0.2s;
}
.color-circle:hover { transform: scale(1.1); }
.color-circle.selected { border-color: #aaa; transform: scale(1.15); }
.font-select {
  width: 100%; padding: 10px 14px; border: 1px solid #ccc;
  border-radius: 6px; font-size: 15px; cursor: pointer; background: #f5f5f5;
}

/* Mini preview */
.cv-mini-preview { width: 255px; height: 350px; border: 1px solid #ddd; border-radius: 4px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.15); }
.mini-header { padding: 12px 10px; display: flex; align-items: center; gap: 10px; color: #fff; }
.mini-avatar { width: 34px; height: 34px; border-radius: 50%; background: rgba(255,255,255,0.3); }
.mini-name { font-weight: 700; font-size: 10px; }
.mini-job { font-size: 8px; opacity: 0.8; }
.mini-body { display: flex; padding: 8px; gap: 8px; height: calc(100% - 58px); }
.mini-col { flex: 1; display: flex; flex-direction: column; gap: 4px; }
.mini-section-title { font-size: 7px; font-weight: 700; border-bottom: 1px solid; padding-bottom: 2px; margin-bottom: 2px; }
.mt { margin-top: 6px; }
.mini-line { height: 4px; background: #ddd; border-radius: 2px; margin: 2px 0; }
.mini-line.short { width: 65%; }
.mini-skill { height: 5px; background: #eee; border-radius: 3px; margin: 3px 0; overflow: hidden; }
.skill-bar { height: 100%; border-radius: 3px; }

/* Paso 2 */
.paso2-body { display: flex; gap: 40px; }
.paso2-left { flex: 0 0 260px; }
.paso2-right { flex: 1; }
.foto-wrap { width: 90px; height: 90px; border-radius: 50%; background: #ddd; cursor: pointer; position: relative; overflow: visible; display: inline-flex; align-items: center; justify-content: center; }
.foto-preview { width: 90px; height: 90px; border-radius: 50%; object-fit: cover; }
.foto-placeholder { font-size: 48px; color: #555; }
.foto-camara { position: absolute; bottom: -2px; right: -6px; background: #010C67; color: #fff; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; font-size: 14px; }
.foto-label { font-size: 13px; color: #555; margin-top: 8px; }

/* Paso 3/4 */
.paso3-body { }
.paso3-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

/* Inputs comunes */
.field-group { margin-bottom: 16px; }
.field-group label { display: block; font-size: 14px; font-weight: 600; color: #222; margin-bottom: 5px; }
.wiz-input { width: 100%; padding: 9px 12px; border: 1px solid #bbb; border-radius: 6px; font-size: 14px; color: #333; background: #fff; box-sizing: border-box; }
.wiz-textarea { width: 100%; padding: 9px 12px; border: 1px solid #bbb; border-radius: 6px; font-size: 14px; color: #333; resize: vertical; min-height: 90px; box-sizing: border-box; }
.wiz-textarea.tall { min-height: 120px; }
.wiz-input:focus, .wiz-textarea:focus { outline: none; border-color: #010C67; }

/* Preview */
.preview-main-title {
  text-align: center;
  font-family: 'Lora', serif;
  font-size: 24px;
  font-weight: 600;
  color: #111111;
  margin-bottom: 24px;
}

.preview-body {
  padding: 24px 40px;
  background: #f0f0f0;
  overflow-y: auto;
  overflow-x: auto;
}

.preview-container {
  display: flex;
  gap: 28px;
  justify-content: center;
  align-items: flex-start;
  width: 100%;
}

.cv-wizard-wrapper.preview-mode {
  max-width: 1060px;
}

.wiz-header-inner.preview-mode {
  justify-content: center;
  position: relative;
}

.wiz-header-inner.preview-mode .btn-cerrar-wizard {
  position: absolute;
  right: 28px;
  top: 50%;
  transform: translateY(-50%);
}

/* CV Full Sheet */
.cv-full-preview {
  width: 794px;
  min-height: 1050px;
  background: #ffffff;
  box-shadow: 0 12px 36px rgba(0, 0, 0, 0.12);
  border: 1px solid #dcdcdc;
  display: flex;
  flex-direction: column;
  box-sizing: border-box;
}

/* Header Band */
.cvp-header {
  padding: 32px 40px;
  color: #ffffff;
  display: flex;
  align-items: center;
  gap: 28px;
}

.cvp-header-foto-wrap {
  flex-shrink: 0;
}

.cvp-header-foto {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid rgba(255, 255, 255, 0.5);
}

.cvp-header-foto-placeholder {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.25);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 48px;
  color: #ffffff;
}

.cvp-header-text {
  flex-grow: 1;
}

.cvp-header-text h1.cvp-name {
  margin: 0 0 6px 0;
  font-size: 26px;
  font-weight: 700;
  letter-spacing: 0.5px;
  font-family: inherit;
}

.cvp-header-text p.cvp-subtitle {
  margin: 0;
  font-size: 15px;
  opacity: 0.95;
  font-weight: 500;
}

/* Body columns */
.cvp-content {
  display: flex;
  padding: 32px 40px 48px;
  gap: 40px;
  background: #ffffff;
  flex: 1;
}

.cvp-column {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 24px;
}

/* Contact info group */
.cvp-contact-info {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.cvp-contact-item {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 13px;
  color: #333333;
}

.cvp-contact-item i {
  font-size: 16px;
  flex-shrink: 0;
}

.cvp-contact-label {
  font-weight: 700;
  margin-right: 4px;
}

.cvp-contact-val {
  color: #333333;
}

/* Sections */
.cvp-section {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.cvp-section-title {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  font-weight: 700;
  margin: 0;
  border: none;
  padding: 0;
}

.cvp-section-title i {
  font-size: 16px;
}

.cvp-section-text {
  font-size: 12px;
  color: #444444;
  line-height: 1.6;
  margin: 0;
}

.cvp-section-text.pre {
  white-space: pre-wrap;
}

.gen-msg {
  text-align: center;
  color: #555;
  margin-top: 16px;
  font-size: 14px;
}

/* Action panel on the right */
.preview-actions-panel {
  display: flex;
  flex-direction: column;
  gap: 12px;
  width: 140px;
  flex-shrink: 0;
  padding-top: 10px;
}

.btn-preview-action {
  width: 100%;
  padding: 10px 16px;
  border-radius: 20px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  outline: none;
  text-decoration: none;
  border: none;
  box-shadow: none;
}

.btn-preview-action.btn-outline {
  background: #ffffff;
  color: #222222;
  border: 1px solid #777777;
}

.btn-preview-action.btn-outline:hover {
  background: #f4f4f4;
  border-color: #222222;
}

.btn-preview-action.btn-solid {
  background: #010C67;
  color: #ffffff;
  border: 1px solid #010C67;
}

.btn-preview-action.btn-solid:hover {
  background: #000c50;
}

.btn-preview-action:disabled {
  opacity: 0.65;
  cursor: not-allowed;
}

/* Footer */
.wiz-footer {
  display: flex; justify-content: space-between; align-items: center;
  padding: 14px 28px; border-top: 1px solid #e0e0e0;
  flex-shrink: 0; background: #fafafa; gap: 12px;
}
.footer-left  { display: flex; align-items: center; gap: 10px; }
.footer-right { display: flex; align-items: center; gap: 10px; }

.btn-wiz {
  font-family: 'Lora', serif; font-size: 16px; font-weight: 600;
  border-radius: 10px; padding: 10px 24px;
  cursor: pointer; transition: background-color 0.2s, opacity 0.2s;
  display: inline-flex; align-items: center; gap: 6px;
  -webkit-appearance: none;
  appearance: none;
  outline: none !important;
  box-shadow: none !important;
  text-decoration: none;
}
.btn-wiz:focus, .btn-wiz:focus-visible {
  outline: none !important;
  box-shadow: none !important;
}
.btn-atras {
  background: #67000F;
  color: #ffffff;
  border: none;
  font-size: 14px;
  padding: 10px 24px;
  font-weight: 600;
  transition: transform 0.2s ease, filter 0.2s ease;
}
.btn-atras:hover {
  filter: brightness(1.15);
}

.btn-siguiente {
  background: #000B58;
  color: #ffffff;
  border: none;
  font-size: 14px;
  padding: 10px 24px;
  font-weight: 600;
  transition: transform 0.2s ease, filter 0.2s ease;
}
.btn-siguiente:hover:not(:disabled) {
  filter: brightness(1.15);
}
.btn-siguiente:disabled {
  opacity: 0.65;
  cursor: not-allowed;
}

/* Responsive CV Wizard */
@media (max-width: 768px) {
  .cv-wizard-wrapper {
    width: 96%;
    max-height: 98vh;
  }
  .wiz-stepper {
    padding: 16px 20px 8px;
  }
  .step-line {
    min-width: 30px;
  }
  .wiz-body {
    padding: 16px 20px;
  }
  .paso1-body {
    flex-direction: column;
    align-items: center;
    gap: 20px;
  }
  .paso1-left {
    flex: none;
    width: 100%;
  }
  .paso2-body {
    flex-direction: column;
    gap: 20px;
  }
  .paso2-left {
    flex: none;
    width: 100%;
  }
  .paso3-grid {
    grid-template-columns: 1fr;
    gap: 15px;
  }
  .preview-container {
    flex-direction: column;
    align-items: center;
    gap: 20px;
  }
  .preview-actions-panel {
    width: 100%;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
  }
  .btn-preview-action {
    width: auto;
    flex: 1 1 120px;
  }
  .preview-body {
    overflow-x: auto;
  }
  .wiz-footer {
    padding: 12px 20px;
  }
  
  /* Onboarding responsive rules */
  .paso0-onboarding-body {
    padding: 16px 20px;
  }
  .intro-steps-container {
    gap: 20px;
    align-items: center;
  }
  .step-card-row {
    justify-content: center !important;
  }
  .step-card {
    width: 100%;
    max-width: 455px;
    height: auto;
    min-height: 163px;
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
  }
  .step-card-img-wrap {
    width: 100%;
    height: 150px;
  }
  .step-arrow-wrap {
    display: none; /* Ocultar flechas L en móvil ya que los elementos se apilan */
  }
}
</style>
