<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\PasanteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

// Redirigir todas las rutas de dashboard a la vista base de Vue
Route::get('/dashboard/{any?}', function () {
    return view('app');
})->where('any', '.*');

// Rutas de API
Route::prefix('api')->group(function () {
    // Autenticación
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/registro', [AuthController::class, 'registro']);
        Route::post('/enviar-codigo', [AuthController::class, 'enviarCodigo']);
        Route::post('/verificar-codigo', [AuthController::class, 'verificarCodigo']);
        Route::post('/recuperar', [AuthController::class, 'recuperar']);
    });

    // CVs
    Route::post('/cv/guardar', [CvController::class, 'guardar']);
    Route::get('/cv/{usuarioId}', [CvController::class, 'obtener']);
    Route::delete('/cv/{cvId}', [CvController::class, 'eliminar']);

    // Pasante
    Route::get('/pasante/perfil', [PasanteController::class, 'getPerfil']);
    Route::get('/pasante/informes', [PasanteController::class, 'getInformes']);
    Route::post('/pasante/informe/subir', [PasanteController::class, 'subirInforme']);
    Route::post('/pasante/informe/actualizar/{id}', [PasanteController::class, 'actualizarInforme']);
    Route::delete('/pasante/informe/eliminar/{id}', [PasanteController::class, 'eliminarInforme']);
    Route::get('/pasante/mis-cvs', [PasanteController::class, 'getMisCvs']);
    Route::get('/pasante/mi-supervisor', [PasanteController::class, 'getMiSupervisor']);
    Route::get('/pasante/solicitar-supervisor', [PasanteController::class, 'solicitarSupervisor']);
    Route::get('/pasante/vacantes', [PasanteController::class, 'getVacantes']);
    Route::post('/pasante/vacante/aplicar/{id}', [PasanteController::class, 'aplicarVacante']);
    Route::get('/pasante/postulaciones', [PasanteController::class, 'getPostulaciones']);
    
    // PDF de informes
    Route::get('/informes/{id}/pdf', [PasanteController::class, 'verPdf']);
});

