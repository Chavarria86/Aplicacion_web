<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Génesis Profesional - Autenticación</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Lora:wght@400;500&display=swap" rel="stylesheet">

    <!-- Vue 3 y Axios -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- AlertifyJS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <style>
        :root {
            --color-primario: #010C67;
            --color-secundario-1: #00589B;
            --color-secundario-2: #67000F;
            --color-acento: #FFB75B;
            --color-gris-1: #B1ABAB;
            --color-gris-2: #A8A8A8;
            --color-gris-3: #DEDCDC;
            --color-fondo-input: #EFEFEF;

            --font-titulo: 'Lora', serif;
            --font-texto: 'Inter', sans-serif;
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: var(--font-texto);
            background: linear-gradient(rgba(0, 11, 88, 0.65), rgba(0, 11, 88, 0.65)), url('{{ asset('images/Fondo_login.png') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            position: relative;
        }

        .titulo-genesis {
            font-family: var(--font-titulo);
            font-weight: 500;
            font-size: 32px;
            color: #000;
            margin-bottom: 10px;
        }

        .subtitulo-genesis {
            font-family: var(--font-texto);
            font-weight: 400;
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }

        .label-genesis {
            font-family: var(--font-titulo);
            font-size: 18px;
            color: #000;
            display: block;
            text-align: center;
            margin-bottom: 8px;
            margin-top: 15px;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 15px;
            width: 100%;
        }

        .input-genesis {
            width: 100%;
            padding: 12px 15px;
            font-family: var(--font-texto);
            font-size: 16px;
            background-color: var(--color-fondo-input);
            border: 1px solid #777;
            border-radius: 15px;
            outline: none;
            color: #333;
            box-sizing: border-box;
            text-align: left;
        }

        .input-genesis:focus {
            border-color: var(--color-primario);
            box-shadow: 0 0 5px rgba(1, 12, 103, 0.3);
        }

        .icon-eye {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .btn-genesis {
            background-color: var(--color-primario);
            color: white;
            font-family: var(--font-titulo);
            font-size: 20px;
            font-weight: 500;
            border: none;
            border-radius: 18px;
            padding: 12px 0;
            width: 80%;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            display: block;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }

        .btn-genesis:hover {
            background-color: #01084a;
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(0,0,0,0.3);
        }
        
        .btn-genesis:disabled {
            background-color: var(--color-gris-2);
            cursor: not-allowed;
            transform: none;
        }

        .text-link {
            color: var(--color-secundario-1);
            font-family: var(--font-texto);
            font-size: 14px;
            text-decoration: underline;
            cursor: pointer;
        }

        .terms-container {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-texto);
            font-size: 14px;
            margin-top: 20px;
            gap: 8px;
            text-align: left;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #555;
        }

        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content-genesis {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            position: relative;
            text-align: left;
        }
        
        .modal-content-genesis h3 {
            font-family: var(--font-titulo);
            color: var(--color-primario);
            margin-bottom: 20px;
        }
        
        .modal-content-genesis p {
            font-family: var(--font-texto);
            font-size: 14px;
            color: #333;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .btn-modal-close {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 15px;
            cursor: pointer;
            float: right;
            font-family: var(--font-texto);
        }

        .codigo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 25px 0;
        }

        .codigo-box {
            width: 45px;
            height: 55px;
            background-color: var(--color-fondo-input);
            border: 1px solid #B1ABAB;
            border-radius: 8px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            outline: none;
            color: #333;
        }

        .codigo-box:focus {
            border-color: var(--color-primario);
            box-shadow: 0 0 5px rgba(1,12,103,0.3);
        }

        .codigo-guion {
            font-size: 24px;
            color: #555;
            margin: 0 5px;
        }

        .reenviar-text {
            font-size: 13px;
            color: #555;
            margin-bottom: 20px;
        }

        .reenviar-text a {
            color: var(--color-secundario-1);
            text-decoration: none;
            font-weight: 500;
        }

        .btn-cancelar {
            background-color: var(--color-secundario-2);
            color: white;
            border: none;
            border-radius: 18px;
            padding: 10px 25px;
            font-family: var(--font-titulo);
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
            width: 45%;
        }

        .btn-verificar {
            background-color: var(--color-primario);
            color: white;
            border: none;
            border-radius: 18px;
            padding: 10px 25px;
            font-family: var(--font-titulo);
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
            width: 45%;
        }

        .btn-cancelar:hover, .btn-verificar:hover {
            filter: brightness(1.2);
            transform: translateY(-2px);
        }

        /* AlertifyJS Custom Theme Buttons */
        .btn-alertify-ok {
            background-color: var(--color-primario) !important;
            color: #ffffff !important;
            border: none !important;
            border-radius: 18px !important;
            padding: 10px 24px !important;
            font-family: var(--font-titulo) !important;
            font-size: 16px !important;
            font-weight: 500 !important;
            transition: all 0.2s ease-in-out !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2) !important;
        }

        .btn-alertify-ok:hover {
            background-color: #01084a !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 10px rgba(0,0,0,0.3) !important;
        }

        .btn-alertify-cancel {
            background-color: var(--color-secundario-2) !important;
            color: #ffffff !important;
            border: none !important;
            border-radius: 18px !important;
            padding: 10px 24px !important;
            font-family: var(--font-titulo) !important;
            font-size: 16px !important;
            font-weight: 500 !important;
            transition: all 0.2s ease-in-out !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2) !important;
        }

        .btn-alertify-cancel:hover {
            background-color: #8b0015 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 10px rgba(0,0,0,0.3) !important;
        }

        /* Back Arrow Buttons */
        .back-arrow-btn {
            position: absolute;
            top: 20px;
            left: 24px;
            color: var(--color-primario) !important;
            font-size: 24px;
            text-decoration: none;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .back-arrow-btn:hover {
            transform: translateX(-3px);
            opacity: 0.8;
            color: var(--color-secundario-1) !important;
        }

        /* ALERTA TÉRMINOS Y CONDICIONES */
        .alerta-terminos {
            position: fixed;
            bottom: 30px;
            right: 30px;
            border-radius: var(--sds-size-radius-200, 8px);
            border: var(--sds-size-stroke-border, 1px) solid var(--color-advertencia, rgba(255, 123, 0, 0.63));
            background: var(--color-advertencia, rgba(255, 123, 0, 0.63));
            display: flex;
            width: 455px;
            height: 163px;
            padding: 20px;
            justify-content: center;
            align-items: center;
            gap: var(--sds-size-space-100, 8px);
            z-index: 2000;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
            color: white;
            box-sizing: border-box;
            font-family: var(--font-texto);
        }

        .alerta-close-btn {
            position: absolute;
            top: 12px;
            right: 15px;
            background: none;
            border: none;
            font-size: 20px;
            color: white;
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.2s;
            line-height: 1;
        }

        .alerta-close-btn:hover {
            opacity: 1;
        }

        .btn-alerta-aceptar {
            background-color: transparent;
            border: 1px solid white;
            border-radius: 6px;
            color: white;
            padding: 6px 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            font-family: var(--font-texto);
        }

        .btn-alerta-aceptar:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity 0.3s, transform 0.3s;
        }
        .fade-enter-from, .fade-leave-to {
            opacity: 0;
            transform: translateY(20px);
        }

        /* REGISTRATION NOTIFICATION MODAL */
        .notification-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 11, 88, 0.4);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-card {
            background: #010C67;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 32px;
            width: 450px;
            max-width: 90%;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.35);
        }

        .notification-header-row {
            display: flex;
            align-items: center;
            gap: var(--spacing-padding-spacing-16, 16px);
            flex: 1 0 0;
            align-self: stretch;
        }

        .notification-header-left {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #ffffff;
        }

        .check-icon {
            flex-shrink: 0;
            color: #ffffff;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-title {
            font-family: var(--font-titulo);
            font-size: 20px;
            font-weight: 500;
            color: #ffffff;
        }

        .striped-divider {
            height: 6px;
            align-self: stretch;
            background: repeating-linear-gradient(
                -45deg,
                #e95997,
                #e95997 6px,
                #ffffff 6px,
                #ffffff 12px
            );
            border-radius: 3px;
        }

        .notification-body-text {
            display: flex;
            padding-left: var(--spacing-padding-spacing-32, 32px);
            flex-direction: column;
            align-items: flex-start;
            gap: var(--spacing-padding-spacing-0, 0);
            align-self: stretch;
            font-family: var(--font-texto);
            font-size: 14px;
            font-weight: 500;
            color: #ffffff;
            opacity: 0.95;
        }

        .notification-spinner-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .custom-spinner-svg {
            width: 78px;
            height: 78px;
            animation: spin-notification 1.5s linear infinite;
        }

        @keyframes spin-notification {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <div id="app" class="w-100 d-flex justify-content-center px-3">
        
        <!-- INICIAR SESIÓN -->
        <div class="auth-card" v-if="vistaActual === 'login'">
            <!-- Botón de regresar (flecha izquierda) -->
            <a href="/" class="back-arrow-btn">
                <i class="bi bi-arrow-left"></i>
            </a>

            <!-- Logo UGB -->
            <img src="{{ asset('images/logo_ugb.png') }}" alt="Logo UGB" class="mb-3 mx-auto" style="height: 72px; object-fit: contain; display: block;">


            <h2 class="titulo-genesis">Iniciar sesión</h2>
            <p class="subtitulo-genesis" style="margin-bottom: 4px; font-weight: 500;">¡Bienvenido!</p>
            <p class="subtitulo-genesis" style="margin-bottom: 24px; font-size: 14px;">Ingresa tu correo y contraseña para iniciar</p>
            
            <form @submit.prevent="iniciarSesion">
                
                <label class="label-genesis">Correo:</label>
                <div class="input-group-custom">
                    <input type="email" class="input-genesis" v-model="loginForm.correo" placeholder="usss@000ugb.edu.sv" required :disabled="cargando">
                </div>
                
                <label class="label-genesis">Contraseña:</label>
                <div class="input-group-custom">
                    <input :type="mostrarPassword ? 'text' : 'password'" class="input-genesis" v-model="loginForm.contrasena" placeholder="********" required :disabled="cargando">
                    <i class="bi icon-eye" :class="mostrarPassword ? 'bi-eye-slash' : 'bi-eye'" @click="mostrarPassword = !mostrarPassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #777;"></i>
                </div>

                <div class="text-center mb-3">
                    <a href="#" class="text-link small" @click.prevent="cambiarVista('recuperar')">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="btn-genesis" :disabled="cargando" style="background-color: #000B58; font-size: 16px; width: 171px; height: 41px; padding: 0; border-radius: 18px; margin-top: 10px;">
                    <span v-if="cargando" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Iniciar sesión
                </button>

                <div class="mt-4" style="font-size: 14px; color: #555;">
                    ¿No tienes cuenta? <a href="#" class="text-link" @click.prevent="cambiarVista('registro')">Crear una cuenta</a>
                </div>
            </form>
        </div>

        <!-- REGISTRO -->
        <div class="auth-card" v-if="vistaActual === 'registro'">
            <!-- Botón de regresar (flecha izquierda) -->
            <a href="/" class="back-arrow-btn">
                <i class="bi bi-arrow-left"></i>
            </a>

            <!-- Logo UGB -->
            <img src="{{ asset('images/logo_ugb.png') }}" alt="Logo UGB" class="mb-3 mx-auto" style="height: 72px; object-fit: contain; display: block;">


            <h2 class="titulo-genesis">Crea una cuenta</h2>
            <p class="subtitulo-genesis">Ingresa tus datos para crear una cuenta</p>
            
            <form @submit.prevent="registrarUsuario">
                
                <!-- Ocultamos nombres y apellidos lógicamente en backend, pero los pedimos en frontend por el diseño -->
                <label class="label-genesis">Nombres<span style="color: red;">*</span></label>
                <div class="input-group-custom">
                    <input type="text" class="input-genesis" v-model="registroForm.nombres" placeholder="Tus nombres" required :disabled="cargando">
                </div>

                <label class="label-genesis">Apellidos<span style="color: red;">*</span></label>
                <div class="input-group-custom">
                    <input type="text" class="input-genesis" v-model="registroForm.apellidos" placeholder="Tus apellidos" required :disabled="cargando">
                </div>

                <label class="label-genesis">Correo institucional<span style="color: red;">*</span></label>
                <div class="input-group-custom">
                    <input type="email" class="input-genesis" v-model="registroForm.correo" placeholder="usss@000ugb.edu.sv" required :disabled="cargando">
                </div>
                
                <label class="label-genesis">Contraseña<span style="color: red;">*</span></label>
                <div class="input-group-custom">
                    <input :type="mostrarPassword ? 'text' : 'password'" class="input-genesis" v-model="registroForm.contrasena" placeholder="********" required :disabled="cargando">
                    <i class="bi icon-eye" :class="mostrarPassword ? 'bi-eye-slash' : 'bi-eye'" @click="mostrarPassword = !mostrarPassword"></i>
                </div>

                <label class="label-genesis">Confirmar contraseña<span style="color: red;">*</span></label>
                <div class="input-group-custom">
                    <input :type="mostrarPassword2 ? 'text' : 'password'" class="input-genesis" v-model="registroForm.confirmar" placeholder="********" required :disabled="cargando">
                    <i class="bi icon-eye" :class="mostrarPassword2 ? 'bi-eye-slash' : 'bi-eye'" @click="mostrarPassword2 = !mostrarPassword2"></i>
                </div>

                <div class="terms-container">
                    <input type="checkbox" id="terms" v-model="registroForm.terminos">
                    <label for="terms">He leído y acepto los <a href="#" class="text-link" @click.prevent="mostrarTerminos = true">Términos y Condiciones de Uso</a></label>
                </div>

                <button type="submit" class="btn-genesis" :disabled="cargando" style="background-color: #000B58; font-size: 16px; width: 171px; height: 41px; padding: 0; border-radius: 18px; margin-top: 20px;">
                    <span v-if="cargando" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    Siguiente
                </button>

                <div class="mt-4" style="font-size: 14px; color: #555;">
                    ¿Ya tienes cuenta? <a href="#" class="text-link" @click.prevent="cambiarVista('login')">Iniciar sesión</a>
                </div>
            </form>
        </div>

        <!-- MODAL TÉRMINOS -->
        <div class="modal-overlay" v-if="mostrarTerminos" @click.self="mostrarTerminos = false">
            <div class="modal-content-genesis">
                <button class="close-btn" @click="mostrarTerminos = false">&times;</button>
                <h3>Términos y Condiciones</h3>
                <p><strong>1. Aceptación de los Términos</strong><br>Al acceder y utilizar la plataforma Génesis Profesional, usted acepta estar sujeto a estos términos y condiciones. Si no está de acuerdo, por favor no utilice este servicio.</p>
                <p><strong>2. Uso de la Plataforma</strong><br>Esta herramienta está diseñada exclusivamente para conectar estudiantes y pasantes con empresas tecnológicas. Está estrictamente prohibido el uso de la plataforma para fines comerciales no autorizados o actividades ilícitas.</p>
                <p><strong>3. Privacidad de los Datos</strong><br>La información ingresada (incluyendo currículums y datos de contacto) será compartida únicamente con las empresas socias con el fin de gestionar prácticas profesionales.</p>
                <p><strong>4. Responsabilidad</strong><br>Génesis Profesional actúa como intermediario. No garantizamos la contratación final por parte de las empresas.</p>
                <button class="btn-modal-close" @click="mostrarTerminos = false">Cerrar</button>
            </div>
        </div>

        <!-- RECUPERAR CONTRASEÑA -->
        <div class="auth-card" v-if="vistaActual === 'recuperar'">
            <!-- Botón de regresar a login (flecha izquierda) -->
            <a href="#" class="back-arrow-btn" @click.prevent="cambiarVista('login')">
                <i class="bi bi-arrow-left"></i>
            </a>


            <h2 class="titulo-genesis">Restablecer contraseña</h2>
            
            <!-- PASO 1: Ingresar Correo -->
            <div v-if="pasoRecuperacion === 1">
                <p class="subtitulo-genesis">Ingresa el correo y te enviaremos un<br>código de verificación para cambiar tu<br>contraseña</p>
                <form @submit.prevent="enviarCodigo()">
                    <label class="label-genesis">Correo:</label>
                    <div class="input-group-custom">
                        <input type="email" class="input-genesis" v-model="recuperarForm.correo" placeholder="usss@000ugb.edu.sv" required :disabled="cargando">
                    </div>
                    <button type="submit" class="btn-genesis" :disabled="cargando">
                        <span v-if="cargando" class="spinner-border spinner-border-sm me-2"></span>
                        Enviar codigo
                    </button>
                </form>
            </div>

            <!-- PASO 2: Ingresar Código (6 cajas) -->
            <div v-if="pasoRecuperacion === 2">
                <p class="subtitulo-genesis">
                    Introduce el codigo de verificacion enviado al correo electronico de <br> 
                    <strong>@{{ enmascararCorreo(recuperarForm.correo) }}</strong>
                </p>
                
                <form @submit.prevent="avanzarPaso3()">
                    <div class="codigo-container">
                        <input type="text" maxlength="1" class="codigo-box" v-model="codigoArray[0]" id="code-0" @input="moverFoco(0, $event)" required>
                        <input type="text" maxlength="1" class="codigo-box" v-model="codigoArray[1]" id="code-1" @input="moverFoco(1, $event)" required>
                        <input type="text" maxlength="1" class="codigo-box" v-model="codigoArray[2]" id="code-2" @input="moverFoco(2, $event)" required>
                        <span class="codigo-guion">—</span>
                        <input type="text" maxlength="1" class="codigo-box" v-model="codigoArray[3]" id="code-3" @input="moverFoco(3, $event)" required>
                        <input type="text" maxlength="1" class="codigo-box" v-model="codigoArray[4]" id="code-4" @input="moverFoco(4, $event)" required>
                        <input type="text" maxlength="1" class="codigo-box" v-model="codigoArray[5]" id="code-5" @input="moverFoco(5, $event)" required>
                    </div>

                    <div class="reenviar-text">
                        ¿Aun no recibes el código? <a href="#" @click.prevent="enviarCodigo(true)">Reenviar codigo</a>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn-cancelar" @click="cambiarVista('login')" :disabled="cargando">Cancelar</button>
                        <button type="submit" class="btn-verificar" :disabled="cargando || !codigoCompleto">Verificar</button>
                    </div>
                </form>
            </div>

            <!-- PASO 3: Nueva Contraseña -->
            <div v-if="pasoRecuperacion === 3">
                <!-- Botón de cerrar (X) en la esquina superior derecha -->
                <button class="close-btn" @click="cambiarVista('login')">&times;</button>

                <h2 class="titulo-genesis">Escribe una nueva contraseña:</h2>
                <p class="subtitulo-genesis" style="font-size: 15px; margin-bottom: 25px; line-height: 1.4;">
                    Ingresa una contraseña de almenos 8 caracteres con números y letras, con almenos una letra mayúscula.
                </p>
                
                <form @submit.prevent="recuperarCuenta()">
                    <label class="label-genesis">Nueva contraseña</label>
                    <div class="input-group-custom">
                        <input :type="mostrarPassword ? 'text' : 'password'" class="input-genesis" v-model="recuperarForm.nuevaContrasena" placeholder="********" required :disabled="cargando">
                        <i class="bi icon-eye" :class="mostrarPassword ? 'bi-eye-slash' : 'bi-eye'" @click="mostrarPassword = !mostrarPassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #777; font-size: 1.2rem;"></i>
                    </div>
                    
                    <label class="label-genesis">Repite la contraseña</label>
                    <div class="input-group-custom">
                        <input :type="mostrarPassword2 ? 'text' : 'password'" class="input-genesis" v-model="recuperarForm.confirmarContrasena" placeholder="********" required :disabled="cargando">
                        <i class="bi icon-eye" :class="mostrarPassword2 ? 'bi-eye-slash' : 'bi-eye'" @click="mostrarPassword2 = !mostrarPassword2" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #777; font-size: 1.2rem;"></i>
                    </div>

                    <button type="submit" class="btn-genesis" :disabled="cargando" style="background-color: #000B58; font-size: 16px; width: 171px; height: 41px; padding: 0; border-radius: 18px; margin-top: 25px;">
                        <span v-if="cargando" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Cambiar
                    </button>
                </form>
            </div>
        </div>
        <!-- Alerta flotante para Términos y Condiciones -->
        <transition name="fade">
            <div class="alerta-terminos" v-if="mostrarAlertaTerminos">
                <button class="alerta-close-btn" @click="mostrarAlertaTerminos = false">&times;</button>
                <div class="d-flex flex-column align-items-start w-100 justify-content-between h-100">
                    <div class="d-flex align-items-center gap-3 w-100">
                        <i class="bi bi-info-circle-fill" style="font-size: 28px; color: #fff;"></i>
                        <span style="font-size: 16px; font-weight: 500; text-align: left; line-height: 1.4; color: #fff;">
                            ¡Debe aceptar los términos y condiciones para continuar!
                        </span>
                    </div>
                    <button type="button" class="btn-alerta-aceptar" @click="mostrarAlertaTerminos = false">Aceptar</button>
                </div>
            </div>
        </transition>

        <!-- NOTIFICACIÓN DE REGISTRO EXITOSO (PASO 1 AZUL, PASO 2 VERDE) -->
        <transition name="fade">
            <div class="notification-overlay" v-if="mostrarRegistroNotificacion">
                <!-- Estado 1: Cargando/Validando (Azul #010C67) -->
                <div class="notification-card" v-if="registroPasoNotificacion === 'cargando'">
                    <div class="notification-header-row">
                        <div class="notification-header-left">
                            <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                            <span class="notification-title">Datos enviados correctamente</span>
                        </div>
                    </div>
                    
                    <div class="striped-divider"></div>
                    
                    <div class="notification-body-text">
                        Tus datos están siendo validados, espera un momento
                    </div>
                    
                    <div class="notification-spinner-container">
                        <svg class="custom-spinner-svg" xmlns="http://www.w3.org/2000/svg" width="78" height="78" viewBox="0 0 78 78" fill="none">
                            <path d="M38.875 1C59.7904 1 76.75 17.9596 76.75 38.875" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path opacity="0.3" d="M38.875 1C59.7904 1 76.75 17.9596 76.75 38.875C76.75 59.7904 59.7904 76.75 38.875 76.75C17.9596 76.75 1 59.7904 1 38.875C1 17.9596 17.9596 1 38.875 1Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>

                <!-- Estado 2: Validación Exitosa (Verde #10A957) -->
                <div class="notification-card success-card" v-else-if="registroPasoNotificacion === 'exito'">
                    <button class="notification-close-x" @click="cerrarNotificacionRegistro">&times;</button>
                    
                    <div class="notification-header-row">
                        <div class="notification-header-left">
                            <svg class="check-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                            <span class="notification-title">Datos enviados correctamente</span>
                        </div>
                    </div>
                    
                    <div class="notification-body-text success-text">
                        Los datos se han validado correctamente.
                    </div>
                    
                    <div class="notification-button-container">
                        <button class="btn-notification-aceptar" @click="cerrarNotificacionRegistro">Aceptar</button>
                    </div>
                </div>
            </div>
        </transition>

    </div>

    <script>
        // Configuración de AlertifyJS
        alertify.set('notifier','position', 'top-right');
        alertify.defaults.theme.ok = "btn btn-alertify-ok";
        alertify.defaults.theme.cancel = "btn btn-alertify-cancel";

        // Configurar instancia global de Axios apuntando a la API de Laravel
        const api = axios.create({
            baseURL: '/api' 
        });

        const app = Vue.createApp({
            data() {
                return {
                    vistaActual: 'login', // login, registro, recuperar
                    mostrarPassword: false,
                    mostrarPassword2: false,
                    mostrarTerminos: false,
                    mostrarAlertaTerminos: false,
                    mostrarRegistroNotificacion: false,
                    registroPasoNotificacion: 'cargando',
                    registroSuccessMensaje: '',
                    cargando: false,
                    
                    // Estados para recuperación
                    pasoRecuperacion: 1, 
                    codigoArray: ['', '', '', '', '', ''],
                    
                    loginForm: {
                        correo: '',
                        contrasena: ''
                    },
                    registroForm: {
                        nombres: '',
                        apellidos: '',
                        correo: '',
                        contrasena: '',
                        confirmar: '',
                        terminos: false
                    },
                    recuperarForm: {
                        correo: '',
                        codigo: '',
                        nuevaContrasena: '',
                        confirmarContrasena: ''
                    }
                }
            },
            computed: {
                codigoCompleto() {
                    return this.codigoArray.join('').length === 6;
                }
            },
            methods: {
                cambiarVista(vista) {
                    this.vistaActual = vista;
                    this.mostrarPassword = false;
                    this.mostrarPassword2 = false;
                    this.pasoRecuperacion = 1;
                    this.codigoArray = ['', '', '', '', '', ''];
                    this.recuperarForm.codigo = '';
                    this.recuperarForm.nuevaContrasena = '';
                    this.recuperarForm.confirmarContrasena = '';
                    this.registroForm.contrasena = '';
                    this.registroForm.confirmar = '';
                    this.registroForm.terminos = false;
                    this.mostrarAlertaTerminos = false;
                },
                enmascararCorreo(correo) {
                    if(!correo) return '';
                    const partes = correo.split('@');
                    if(partes.length !== 2) return correo;
                    return partes[0].substring(0, 2) + '**********@' + partes[1];
                },
                moverFoco(index, event) {
                    // Si escribe un caracter, mover al siguiente input
                    if (event.target.value.length === 1 && index < 5) {
                        const nextInput = document.getElementById('code-' + (index + 1));
                        if(nextInput) nextInput.focus();
                    }
                    // Si borra, mover al anterior
                    if (event.target.value.length === 0 && index > 0 && event.inputType === 'deleteContentBackward') {
                        const prevInput = document.getElementById('code-' + (index - 1));
                        if(prevInput) prevInput.focus();
                    }
                },
                async avanzarPaso3() {
                    this.recuperarForm.codigo = this.codigoArray.join('');
                    if (this.recuperarForm.codigo.length === 6) {
                        this.cargando = true;
                        try {
                            const response = await api.post('/auth/verificar-codigo', {
                                correo: this.recuperarForm.correo,
                                codigo: this.recuperarForm.codigo
                            });
                            alertify.success(response.data.mensaje || 'Código verificado con éxito.');
                            this.pasoRecuperacion = 3;
                        } catch (error) {
                            let msg = 'El código de verificación es incorrecto.';
                            if (error.response && error.response.data && error.response.data.mensaje) {
                                msg = error.response.data.mensaje;
                            }
                            alertify.error(msg);
                        } finally {
                            this.cargando = false;
                        }
                    } else {
                        alertify.warning('Por favor, ingresa el código completo de 6 dígitos.');
                    }
                },
                async iniciarSesion() {
                    this.cargando = true;
                    
                    try {
                        const response = await api.post('/auth/login', this.loginForm);
                        const { token, usuario, redireccion } = response.data;

                        // Guardar datos en localStorage
                        localStorage.setItem('token', token);
                        localStorage.setItem('usuario', JSON.stringify(usuario));

                        alertify.success('Inicio de sesión exitoso. Redirigiendo...');
                        setTimeout(() => {
                            window.location.href = redireccion;
                        }, 1000);

                    } catch (error) {
                        let msg = 'Error de conexión con el servidor.';
                        if (error.response && error.response.data && error.response.data.mensaje) {
                            msg = error.response.data.mensaje;
                            if(error.response.status === 401) {
                                alertify.warning('¡Credenciales incorrectas! ' + msg);
                            } else {
                                alertify.error('Error: ' + msg);
                            }
                        } else {
                            alertify.error(msg);
                        }
                    } finally {
                        this.cargando = false;
                    }
                },
                async registrarUsuario() {
                    if (this.registroForm.contrasena !== this.registroForm.confirmar) {
                        alertify.warning('Las contraseñas no coinciden.');
                        return;
                    }
                    if (!this.registroForm.terminos) {
                        this.mostrarAlertaTerminos = true;
                        return;
                    }

                    this.cargando = true;
                    
                    try {
                        const response = await api.post('/auth/registro', this.registroForm);
                        // Lanzar la notificación de validación (azul con spinner)
                        this.mostrarRegistroNotificacion = true;
                        this.registroPasoNotificacion = 'cargando';
                        
                        // Esperar 3 segundos
                        await new Promise(resolve => setTimeout(resolve, 3000));
                        
                        // Pasar al estado de éxito (verde con botón Aceptar)
                        this.registroPasoNotificacion = 'exito';
                        
                        // Guardar la respuesta para el éxito
                        this.registroSuccessMensaje = response.data.mensaje || 'Cuenta creada con éxito.';
                    } catch (error) {
                        let msg = 'Error al registrar la cuenta.';
                        if (error.response && error.response.data && error.response.data.mensaje) {
                            msg = error.response.data.mensaje;
                            if (error.response.status === 400) {
                                alertify.warning('Datos inválidos: ' + msg);
                            } else {
                                alertify.error('Error de registro: ' + msg);
                            }
                        } else {
                            alertify.error(msg);
                        }
                    } finally {
                        this.cargando = false;
                    }
                },
                cerrarNotificacionRegistro() {
                    this.mostrarRegistroNotificacion = false;
                    this.cambiarVista('login');
                    this.loginForm.correo = this.registroForm.correo;
                    // Resetear formulario de registro
                    this.registroForm = {
                        nombres: '',
                        apellidos: '',
                        correo: '',
                        contrasena: '',
                        confirmar: '',
                        terminos: false
                    };
                    alertify.success(this.registroSuccessMensaje || 'Cuenta creada con éxito.');
                },
                async enviarCodigo(esReenvio = false) {
                    this.cargando = true;
                    try {
                        const response = await api.post('/auth/enviar-codigo', { correo: this.recuperarForm.correo });
                        this.pasoRecuperacion = 2;
                        this.codigoArray = ['', '', '', '', '', ''];

                        // ✅ Si el SMTP está configurado → correo enviado
                        if (!response.data.codigo_dev) {
                            alertify.success(response.data.mensaje || 'Código enviado a tu correo.');
                        }

                        // 🛠️ Modo desarrollo: SMTP no configurado → mostrar código en pantalla
                        if (response.data.codigo_dev) {
                            const codigo = response.data.codigo_dev;
                            // Auto-rellenar las cajas
                            this.codigoArray = codigo.split('');
                            alertify.notify(
                                `<b>MODO DESARROLLO</b><br>SMTP no configurado.<br>Tu código es: <b style="font-size:22px;letter-spacing:6px">${codigo}</b>`,
                                'warning',
                                15
                            );
                        }
                    } catch (error) {
                        let msg = 'Error al solicitar el código.';
                        if (error.response && error.response.data && error.response.data.mensaje) {
                            msg = error.response.data.mensaje;
                            if (error.response.status === 404) {
                                alertify.warning('Correo no encontrado: ' + msg);
                            } else {
                                alertify.error('Error: ' + msg);
                            }
                        } else {
                            alertify.error(msg);
                        }
                    } finally {
                        this.cargando = false;
                    }
                },
                async recuperarCuenta() {
                    if (this.recuperarForm.nuevaContrasena !== this.recuperarForm.confirmarContrasena) {
                        alertify.warning('Las contraseñas no coinciden.');
                        return;
                    }
                    
                    const pass = this.recuperarForm.nuevaContrasena;
                    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
                    if (!regex.test(pass)) {
                        alertify.warning('La contraseña debe tener al menos 8 caracteres, incluir números, letras y al menos una mayúscula.');
                        return;
                    }

                    this.cargando = true;
                    
                    try {
                        const response = await api.post('/auth/recuperar', this.recuperarForm);
                        this.cambiarVista('login');
                        alertify.success(response.data.mensaje || 'Contraseña restablecida con éxito.');
                    } catch (error) {
                        let msg = 'Error al restablecer la contraseña.';
                        if (error.response && error.response.data && error.response.data.mensaje) {
                            msg = error.response.data.mensaje;
                            if (error.response.status === 404) {
                                alertify.warning('Cuenta no encontrada: ' + msg);
                            } else if (error.response.status === 400) {
                                alertify.warning('Código inválido: ' + msg);
                            } else {
                                alertify.error('Error: ' + msg);
                            }
                        } else {
                            alertify.error(msg);
                        }
                    } finally {
                        this.cargando = false;
                    }
                }
            },
            mounted() {
                const urlParams = new URLSearchParams(window.location.search);
                const vista = urlParams.get('vista');
                if (vista && ['login', 'registro', 'recuperar'].includes(vista)) {
                    this.vistaActual = vista;
                }
            }
        });

        app.mount('#app');
    </script>
</body>
</html>