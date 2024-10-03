
<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
//use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\VendedorController;


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



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//empresa
Route::get('/searchEmpresa', [EmpresaController::class, 'buscarEmpresas'])->name('searchEmpresa'); //buscador de empresas
Route::get('/filtrarEmpresas', [EmpresaController::class, 'filtrarEmpresas']); //filtro de activas o inactivas
Route::get('empresas/show', [EmpresaController::class, 'show'])->name('empresas.show');
Route::get('/empresas/{empresa}/generar-informe', [EmpresaController::class, 'generarInforme'])->name('empresas.generar-informe');
Route::post('empresas/{empresa}/generar-recibo', [EmpresaController::class, 'generarRecibo'])->name('empresas.generar-recibo');
Route::get('empresa/pdf/cobro', [EmpresaController::class, 'generarcobro'])->name('pdf.cobro');


//vendedor
//Route::resource('vendedores', VendedorController::class);
// MANTENER ESTE ORDEN XD
Route::get('/vendedores', [VendedorController::class, 'index'])->name('vendedores.index');
Route::get('vendedores/create', [VendedorController::class, 'create'])->name('vendedores.create');
Route::get('/vendedores/buscar', [VendedorController::class, 'buscar'])->name('vendedores.buscar');
Route::get('/vendedores/filtrar', [VendedorController::class, 'filtrarPorEstado'])->name('vendedores.filtrar');
Route::get('/vendedores/{id}', [VendedorController::class, 'show'])->name('vendedores.show');
Route::post('/vendedores', [VendedorController::class, 'store'])->name('vendedores.store');
Route::get('/vendedores/{id}/edit', [VendedorController::class, 'edit'])->name('vendedores.edit');
Route::put('/vendedores/{id}', [VendedorController::class, 'update'])->name('vendedores.update');
Route::delete('/vendedores/{id}', [VendedorController::class, 'destroy'])->name('vendedores.destroy');







//socio
Route::get('/socios', [SocioController::class, 'index'])->name('socios.index');
Route::get('socios/create', [SocioController::class, 'create'])->name('socios.create');
Route::get('/searchSocio', [SocioController::class, 'sociosSearch'])->name('socios.search');
Route::get('/socios/buscar', [SocioController::class, 'buscarSocios'])->name('socios.buscar');
Route::get('/filtrarSocios', [SocioController::class, 'filtrarPorEstado'])->name('socios.filtrar');

Route::post('/socios/{id}/bonificacion-pdf', [SocioController::class, 'generarBonificacionPdf'])->name('socios.bonificacionPdf');
Route::post('/socios/retorno-anticipo-pdf/{id}', [SocioController::class, 'retornoAnticipoPdf'])->name('socios.retornoAnticipoPdf');

Route::get('/socios/activos', [SocioController::class, 'listarSociosActivosexcel'])->name('socios.activos');
Route::get('/socios/inactivos', [SocioController::class, 'listarSociosInactivosexcel'])->name('socios.inactivos');
Route::get('/exportar-socios/{estado}', [SocioController::class, 'exportar'])->name('exportar.socios');






//recibos
Route::get('/recibos', [ReciboController::class, 'index'])->name('recibos.index');
Route::get('/recibos/{codigo}', [ReciboController::class, 'show'])->name('recibos.show');







//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    //Route::resource('blogs', BlogController::class);
    Route::resource('empresas', EmpresaController::class);
    Route::resource('socios', SocioController::class);
});
