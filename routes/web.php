<?php

use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store'])
->name('register.store');

Route::get('/register', [App\Http\Controllers\RegisterController::class, 'create'])
->middleware('guest')
->name('register.index');

Route::post('/registerAdmin', [App\Http\Controllers\RegisterAdminController::class, 'store'])
->name('admin.registerAdminStore');

Route::get('/registerAdmin', [App\Http\Controllers\RegisterAdminController::class, 'create'])
->middleware('guest')
->name('admin.registerAdmin');

//Ruta del login
Route::get('/login', [App\Http\Controllers\SessionsController::class, 'create'])
->middleware('guest')
->name('login.index');

Route::post('/login', [App\Http\Controllers\SessionsController::class, 'store'])
->name('login.store');

Route::get('/logout', [App\Http\Controllers\SessionsController::class, 'destroy'])
->middleware('auth')
->name('login.destroy');


Route::get('/auth', function () {
    return view('index');
})->middleware('auth.user')
->name('auth.user');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])
->middleware('auth.admin')
->name('admin.index');

Route::get('/docente', [App\Http\Controllers\UserController::class, 'index'])
->middleware('auth.user')
->name('user.index');

Route::get('/auth', function () {
    return view('index');
})->middleware('auth.user')
->name('auth.user');

//Rutas de los ambientes
Route::get('/ambientes/index', [App\Http\Controllers\AmbienteController::class, 'index'])
    ->name('admin.ambientes.index');

Route::post('/ambientes/store', [App\Http\Controllers\AmbienteController::class, 'store'])
    ->name('admin.ambientes.store');

Route::get('/ambientes/create', [App\Http\Controllers\AmbienteController::class, 'create'])
    ->name('admin.ambientes.create');

Route::delete('/ambientes/{ambienteId}/delete', [App\Http\Controllers\AmbienteController::class, 'delete'])
    ->name('admin.ambientes.delete');

Route::post('/ambientes/{ambienteId}/update', [App\Http\Controllers\AmbienteController::class, 'update'])
    ->name('admin.ambientes.update');

// Route::get('/grupos', [App\Http\Controllers\SolicitudController::class, 'getGrupos']);

//Delete para aulas reservadas
Route::delete('/ambientesR/{ambienteId}/deleteReservadas', [App\Http\Controllers\AmbienteController::class, 'deleteReservadas'])
->name('admin.ambienteR.delete');

//Rutas de las ubicaciones


//Rutas de las Solicitude de Reserva
Route::get('/solicitudesR/index', [App\Http\Controllers\SolicitudController::class, 'index'])
    ->name('admin.solicitudesR.index');

Route::get('/solicitudesR/create', [App\Http\Controllers\SolicitudController::class, 'create'])
    ->name('admin.solicitudesR.create');


//Materias de docentes
Route::get('/docentesmaterias', [App\Http\Controllers\DocmateriaController::class, 'index2'])
->name('admin.docMaterias.index');

Route::post('/docentesmaterias/store', [App\Http\Controllers\DocmateriaController::class, 'store'])
->name('admin.docentesmaterias.store');

Route::post('/docentesmaterias/{docmateriaId}/update', [App\Http\Controllers\DocmateriaController::class, 'update'])
->name('admin.docentesmaterias.update');

Route::delete('/docentesmaterias/{docmateriaId}/delete', [App\Http\Controllers\DocmateriaController::class, 'delete'])
->name('admin.docentesmaterias.delete');

 //Grupos
Route::get('/grupos', [App\Http\Controllers\GrupoController::class, 'index'])
->name('admin.grupos.index');

Route::post('/grupos/store', [App\Http\Controllers\GrupoController::class, 'store'])
->name('admin.grupos.store');

Route::post('/grupos/{grupoId}/update', [App\Http\Controllers\GrupoController::class, 'update'])
->name('admin.grupos.update');

Route::delete('/grupos/{grupoId}/delete', [App\Http\Controllers\GrupoController::class, 'delete'])
->name('admin.grupos.delete');

//usuarios
Route::get('/usuarios/index', [App\Http\Controllers\UsuariosRController::class, 'index'])
->name('admin.usuarios.index');

Route::get('/usuarios/create', [App\Http\Controllers\UsuariosRController::class, 'create'])
->name('admin.usuarios.create');

Route::post('/usuarios/store', [App\Http\Controllers\UsuariosRController::class, 'store'])
->name('admin.usuarios.store');

Route::delete('/usuarios/{user}', [App\Http\Controllers\UsuariosRController::class, 'destroy'])
->name('admin.usuarios.delete');

Route::get('/usuarios/{user}/edit', [App\Http\Controllers\UsuariosRController::class, 'edit'])
->name('admin.usuarios.edit');

Route::put('/usuarios/{user}', [App\Http\Controllers\UsuariosRController::class, 'update'])
->name('admin.usuarios.update');

//Solicitudes
Route::resource('solicitudes', SolicitudController::class, [
    'names' => [
        'index' => 'solicitudes',
        'create' => 'solicitudes.create'
    ]
])->middleware('auth.user');

Route::get('solicitudes', [SolicitudController::class, 'index'])
->name('admin.solicitudes.index');

Route::get('solicitudes', [SolicitudController::class, 'create'])
->name('admin.solicitudes.create');


//Notificaciones
Route::resource('notificaciones', NotificacionController::class, [
    'names' => [
        'index' => 'notificaciones',
        'store' => 'notificaciones.store'
    ]
])->middleware('auth.user');


Route::get('notificaciones', [NotificacionController::class, 'index'])
->name('admin.notificaciones.index');

Route::get('notidicaciones', [NotificacionController::class, 'store'])
->name('admin.notificaciones.create');
