<?php

use App\Http\Controllers\NegocioController;
use App\Http\Livewire\Aplicaciones\Aplicaciones;
use App\Http\Livewire\Configuracion\AplicacionesDatos;
use App\Http\Livewire\Configuracion\EmpresaDatos;
use App\Http\Livewire\Configuracion\NegociosDatos;
use App\Http\Livewire\Configuracion\PerfilesAplicacionesDatos;
use App\Http\Livewire\Configuracion\PerfilesDatos;
use App\Http\Livewire\Configuracion\SucursalesDatos;
use App\Models\Negocio;
use App\Models\Sucursal;
use App\Models\User;
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


// Route::get('/pruebas', function () {

// 	// $user = User::find(1);
// 	// $user->sucursales()->attach(array(1, 2));
// 	// $user->sucursales()->detach(array(1, 2));
// 	// $user->sucursales()->sync(array(1, 2));

// 	$user = user::find(1);
//     return $user->aplicaciones();
//     // return $empresa;


// });

// Route::get('/rellenar_tabla_empresa_sucursales_negocios', function () {

// 	$user = new User();
//     $user->name = 'Roque Gómez';
// 	$user->email = 'roquegomez@derkayvargas.com.ar';
// 	$user->password = bcrypt('321321');
// 	$user->telefono = '362 4782505';
// 	$user->save();


// 	$empresa = new Empresa();
// 	$empresa->empresa = 'Derka y Vargas S. A.';
// 	$empresa->save();

// 	$negocio = new Negocio();
// 	$negocio->negocio = "Convencional";
// 	$negocio->save();

// 	$negocio = new Negocio();
// 	$negocio->negocio = "TPA";
// 	$negocio->save();

//     $sucursal = new Sucursal();
//     $sucursal->empresa_id = 1;
//     $sucursal->negocio_id = 1;
//     $sucursal->sucursal = "Sáenz Peña";
//     $sucursal->save();

//     $sucursal = new Sucursal();
//     $sucursal->empresa_id = 1;
//     $sucursal->negocio_id = 1;
//     $sucursal->sucursal = "Resistencia";
//     $sucursal->save();

//     $sucursal = new Sucursal();
//     $sucursal->empresa_id = 1;
//     $sucursal->negocio_id = 1;
//     $sucursal->sucursal = "Charata";
//     $sucursal->save();

//     $sucursal = new Sucursal();
//     $sucursal->empresa_id = 1;
//     $sucursal->negocio_id = 1;
//     $sucursal->sucursal = "Villa Angela";
//     $sucursal->save();

//     $sucursal = new Sucursal();
//     $sucursal->empresa_id = 1;
//     $sucursal->negocio_id = 2;
//     $sucursal->sucursal = "Sáenz Peña";
//     $sucursal->save();

//     $sucursal = new Sucursal();
//     $sucursal->empresa_id = 1;
//     $sucursal->negocio_id = 2;
//     $sucursal->sucursal = "Resistencia";
//     $sucursal->save();

//     $sucursal = new Sucursal();
//     $sucursal->empresa_id = 1;
//     $sucursal->negocio_id = 2;
//     $sucursal->sucursal = "Charata";
//     $sucursal->save();

//     $sucursal = new Sucursal();
//     $sucursal->empresa_id = 1;
//     $sucursal->negocio_id = 2;
//     $sucursal->sucursal = "Villa Angela";
//     $sucursal->save();

// 	return $sucursal;
// });

// Route::get('/prueba', Prueba::class);

// Route::get('/', function () {
//     return view('auth.welcome');
// });
//
//

Route::group(['middleware' => 'auth'], function(){
	// Route::get('/', Aplicaciones::class)->name('aplicaciones');
	Route::get('/empresa', EmpresaDatos::class)->name('empresa');
	Route::get('/negocios', NegociosDatos::class)->name('negocios');
	Route::get('/sucursales', SucursalesDatos::class)->name('sucursales');
	Route::get('/perfiles', PerfilesDatos::class)->name('perfiles');
	Route::get('/perfiles/{perfil_nombre}/aplicaciones', PerfilesAplicacionesDatos::class)->name('perfiles.aplicaciones');
    Route::get('/aplicaciones', AplicacionesDatos::class)->name('aplicaciones');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
