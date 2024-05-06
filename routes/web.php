<?php


use App\Events\MessageSent;
use App\Models\ris\ris_modalidades;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HL7\HL7Controller;
use App\Http\Controllers\WebSocketController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\ris\soportesController;
use App\Http\Controllers\imagen\ImagenController;
use App\Http\Controllers\ris\ris_salasController;
use App\Http\Controllers\ris\ris_sedesController;
use App\Http\Controllers\PortalpacienteController;
use App\Http\Controllers\medicos\MedicosController;
use App\Http\Controllers\ris\ris_agendasController;
use App\Http\Controllers\zip\DescargarCdController;
use App\Http\Controllers\ris\ris_estudiosController;
use App\Http\Controllers\clientes\ClientesController;
use App\Http\Controllers\estudios\estudiosController;
use App\Http\Controllers\lecturas\lecturasController;
use App\Http\Controllers\ris\ris_conveniosController;
use App\Http\Controllers\ris\ris_pacientesController;
use App\Http\Controllers\usuarios\UsuariosController;
use App\Http\Controllers\ris\ris_plantillasController;
use App\Http\Controllers\datatable\DatatableController;
use App\Http\Controllers\principal\PrincipalController;
use App\Http\Controllers\ris\ris_modalidadesController;
use App\Http\Controllers\ris\ris_motivosbloqueosController;
use App\Http\Controllers\sa_usuarios\Sa_usuariosController;
use App\Http\Controllers\ris\ris_motivoscancelacionesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|DB_CONNECTION=pgsql
DB_HOST=152.200.139.140
DB_PORT=5432
DB_DATABASE=pacsdb
DB_USERNAME=pacs
DB_PASSWORD=pacs
*/

Route::get('/', [LoginController::class, 'index'])->name('login1');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/portalpaciente', [PortalpacienteController::class, 'index'])->name('portalpaciente');
Route::post('/portalpaciente', [PortalpacienteController::class, 'store'])->name('portalpaciente.store');
Route::get('/estudiospaciente', [PortalpacienteController::class, 'estudiospaciente'])->name('estudiospaciente');
Route::Post('/portalpacientelogout', [PortalpacienteController::class, 'portalpacientelogout'])->name('portalpacientelogout');
Route::get('/datatable/estudiospacientes', [DatatableController::class, 'estudiospacientes'])->name('datatable.estudiospacientes');
Route::get('/imprimirlecturapaciente/{idestudio}', [PortalpacienteController::class, 'imprimirlecturapaciente'])->name('imprimirlecturapaciente');



Route::Post('/logout', [LogoutController::class, 'store'])->name('logout');
Route::Post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');
Route::Post('/firma', [ImagenController::class, 'firmaradiologo'])->name('firmaradiologo.store');
Route::get('/principal', [PrincipalController::class, 'index'])->name('principal');

Route::get('/sa_usuarios', [Sa_usuariosController::class, 'index'])->name('sa_usuarios.index');
Route::get('/sa_usuarios/create', [Sa_usuariosController::class, 'create'])->name('sa_usuarios.create');
Route::post('/sa_usuarios', [Sa_usuariosController::class, 'store'])->name('sa_usuarios.store');
Route::get('sa_usuarios/{usuario}/edit', [Sa_usuariosController::class, 'edit'])->name('sa_usuarios.edit');
Route::put('sa_usuarios/{usuario}', [Sa_usuariosController::class, 'update'])->name('sa_usuarios.update');

Route::put('restablecersausuario/{usuario}', [Sa_usuariosController::class, 'restablecer'])->name('sa_usuarios.restablecer');
Route::delete('sa_usuarios/{usuario}', [Sa_usuariosController::class, 'destroy'])->name('sa_usuarios.destroy');


Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('usuarios/{usuario}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
Route::put('usuarios/{usuario}', [UsuariosController::class, 'update'])->name('usuarios.update');
Route::put('restablecerusuario/{usuario}', [UsuariosController::class, 'restablecer'])->name('usuarios.restablecer');
Route::delete('usuarios/{usuario}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::put('clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
Route::delete('clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

Route::get('/medicos', [MedicosController::class, 'index'])->name('medicos.index');
Route::get('/medicos/create', [MedicosController::class, 'create'])->name('medicos.create');
Route::post('/medicos', [MedicosController::class, 'store'])->name('medicos.store');
Route::get('medicos/{medico}/edit', [MedicosController::class, 'edit'])->name('medicos.edit');
Route::put('medicos/{medico}', [MedicosController::class, 'update'])->name('medicos.update');
Route::put('restablecermedico/{medico}', [MedicosController::class, 'restablecer'])->name('medicos.restablecer');
Route::delete('medicos/{medico}', [MedicosController::class, 'destroy'])->name('medicos.destroy');



Route::get('/estudios', [estudiosController::class, 'index'])->name('estudios.index');
Route::get('/estudiosagendados', [estudiosController::class, 'estudiosagendados'])->name('estudios.estudiosagendados');
Route::get('/estudioscompletados', [estudiosController::class, 'estudioscompletados'])->name('estudios.estudioscompletados');
Route::get('/estudiosenproceso', [estudiosController::class, 'estudiosenproceso'])->name('estudios.estudiosenproceso');
Route::get('/estudiosdeturno', [estudiosController::class, 'estudiosdeturno'])->name('estudios.estudiosdeturno');
Route::get('/estudiosporvalidar', [estudiosController::class, 'estudiosporvalidar'])->name('estudios.estudiosporvalidar');

Route::get('/update_audio/{idestudio}', [estudiosController::class, 'update_audio'])->name('estudios.audio');
Route::get('/update_validado/{idestudio}', [estudiosController::class, 'update_validado'])->name('estudios.validado');

Route::get('/datatable/atencioninmediata', [DatatableController::class, 'atencioninmediata'])->name('datatable.atencioninmediata');

Route::get('/datatable/estudiosagendados', [DatatableController::class, 'estudiosagendados'])->name('datatable.estudiosagendados');
Route::get('/datatable/estudiosportranscribir', [DatatableController::class, 'estudiosportranscribir'])->name('datatable.estudiosportranscribir');
Route::get('/datatable/estudiosenproceso', [DatatableController::class, 'estudiosenproceso'])->name('datatable.estudiosenproceso');
Route::get('/datatable/estudiosporvalidar', [DatatableController::class, 'estudiosporvalidar'])->name('datatable.estudiosporvalidar');
Route::get('/datatable/estudioscompetados', [DatatableController::class, 'estudioscompetados'])->name('datatable.estudioscompetados');
Route::get('/datatable/estudioscompletadosmedico', [DatatableController::class, 'estudioscompletadosmedico'])->name('datatable.estudioscompletadosmedico');
Route::get('/datatable/estudiosclientes/{idestudio}', [DatatableController::class, 'lecturasestudiosclientes'])->name('datatable.lecturasestudiosclientes');

Route::get('/datatable/buscarpacientes', [DatatableController::class, 'buscarpacientes'])->name('datatable.buscarpacientes');


Route::get('/lecturas/{idestudio}', [lecturasController::class, 'index'])->name('lectura.index');
Route::post('/lectura', [lecturasController::class, 'store'])->name('lectura.store');
Route::get('/lectura', [lecturasController::class, 'update'])->name('lectura.update');
Route::delete('/lectura/{idlectura}', [lecturasController::class, 'destroy'])->name('lectura.destroy');

Route::get('/imprimirlectura/{idestudio}', [lecturasController::class, 'imprimirlectura'])->name('imprimirlectura');


Route::get('/cargarsoportes', [soportesController::class, "index"]);
Route::post('/cargarsoportes', [soportesController::class, "store"])->name('cargarsoportes.store');

Route::get('/descargar_cd', [DescargarCdController::class, "downloadZip"]);
Route::get('/hl72', [HL7Controller::class, 'envioMWL2'])->name('hl7.envioMWL2');
//Route::get('/visor', [PrincipalController::class, 'visor'])->name('visor');

/***** RIS *****/


Route::get('/sedes', [ris_sedesController::class, 'index'])->name('rissedes.index');
Route::get('/sedes/create', [ris_sedesController::class, 'create'])->name('rissedes.create');
Route::post('/sedes', [ris_sedesController::class, 'store'])->name('rissedes.store');
Route::get('sedes/{sede}/edit', [ris_sedesController::class, 'edit'])->name('rissedes.edit');
Route::put('sedes/{sede}', [ris_sedesController::class, 'update'])->name('rissedes.update');
Route::delete('sedes/{sede}', [ris_sedesController::class, 'destroy'])->name('rissedes.destroy');


Route::get('/convenios', [ris_conveniosController::class, 'index'])->name('risconvenios.index');
Route::get('/convenios/create', [ris_conveniosController::class, 'create'])->name('risconvenios.create');
//Route::post('/convenios', [ris_conveniosController::class, 'store'])->name('risconvenios.store');
//Route::get('convenios/{convenio}/edit', [ris_conveniosController::class, 'edit'])->name('risconvenios.edit');
//Route::put('convenios/{convenio}', [ris_conveniosController::class, 'update'])->name('risconvenios.update');


Route::get('/estudios', [ris_estudiosController::class, 'index'])->name('risestudios.index');
Route::get('/estudios/create', [ris_estudiosController::class, 'create'])->name('risestudios.create');
//Route::post('/estudios', [ris_estudiosController::class, 'store'])->name('risestudios.store');
//Route::get('estudios/{estudio}/edit', [ris_estudiosController::class, 'edit'])->name('risestudios.edit');
//Route::put('estudios/{estudio}', [ris_estudiosController::class, 'update'])->name('risestudios.update');


Route::get('/salas', [ris_salasController::class, 'index'])->name('rissalas.index');
Route::get('/salas/create', [ris_salasController::class, 'create'])->name('rissalas.create');
Route::post('/salas', [ris_salasController::class, 'store'])->name('rissalas.store');
Route::get('salas/{sala}/edit', [ris_salasController::class, 'edit'])->name('rissalas.edit');
Route::put('salas/{sala}', [ris_salasController::class, 'update'])->name('rissalas.update');
Route::delete('salas/{sala}', [ris_salasController::class, 'destroy'])->name('rissalas.destroy');


Route::get('/modalidades', [ris_modalidadesController::class, 'index'])->name('rismodalidades.index');
Route::get('/modalidades/create', [ris_modalidadesController::class, 'create'])->name('rismodalidades.create');
Route::post('/modalidades', [ris_modalidadesController::class, 'store'])->name('rismodalidades.store');
Route::get('modalidades/{modalidad}/edit', [ris_modalidadesController::class, 'edit'])->name('rismodalidades.edit');
Route::put('modalidades/{modalidad}', [ris_modalidadesController::class, 'update'])->name('rismodalidades.update');
Route::delete('modalidades/{modalidad}', [ris_modalidadesController::class, 'destroy'])->name('rismodalidades.destroy');


Route::get('/motivoscancelaciones', [ris_motivoscancelacionesController::class, 'index'])->name('rismotivoscancelaciones.index');
Route::get('/motivoscancelaciones/create', [ris_motivoscancelacionesController::class, 'create'])->name('rismotivoscancelaciones.create');
Route::post('/motivoscancelaciones', [ris_motivoscancelacionesController::class, 'store'])->name('rismotivoscancelaciones.store');
Route::get('motivoscancelaciones/{motivocancelacion}/edit', [ris_motivoscancelacionesController::class, 'edit'])->name('rismotivoscancelaciones.edit');
Route::put('motivoscancelaciones/{motivocancelacion}', [ris_motivoscancelacionesController::class, 'update'])->name('rismotivoscancelaciones.update');
Route::delete('motivoscancelaciones/{motivocancelacion}', [ris_motivoscancelacionesController::class, 'destroy'])->name('rismotivoscancelaciones.destroy');


Route::get('/motivosbloqueos', [ris_motivosbloqueosController::class, 'index'])->name('rismotivosbloqueos.index');
Route::get('/motivosbloqueos/create', [ris_motivosbloqueosController::class, 'create'])->name('rismotivosbloqueos.create');
Route::post('/motivosbloqueos', [ris_motivosbloqueosController::class, 'store'])->name('rismotivosbloqueos.store');
Route::get('motivosbloqueos/{motivobloqueo}/edit', [ris_motivosbloqueosController::class, 'edit'])->name('rismotivosbloqueos.edit');
Route::put('motivosbloqueos/{motivobloqueo}', [ris_motivosbloqueosController::class, 'update'])->name('rismotivosbloqueos.update');
Route::delete('motivosbloqueos/{motivobloqueo}', [ris_motivosbloqueosController::class, 'destroy'])->name('rismotivosbloqueos.destroy');


Route::get('/plantillas', [ris_plantillasController::class, 'index'])->name('risplantillas.index');
Route::get('/plantillas/create', [ris_plantillasController::class, 'create'])->name('risplantillas.create');
Route::post('/plantillas', [ris_plantillasController::class, 'store'])->name('risplantillas.store');
Route::get('plantillas/{plantilla}/edit', [ris_plantillasController::class, 'edit'])->name('risplantillas.edit');
Route::put('plantillas/{plantilla}', [ris_plantillasController::class, 'update'])->name('risplantillas.update');
Route::delete('plantillas/{plantilla}', [ris_plantillasController::class, 'destroy'])->name('risplantillas.destroy');
Route::get('plantillascargar/{idplantilla}', [ris_plantillasController::class, 'plantillascargar'])->name('risplantillas.plantillascargar');


Route::get('/crearagendas', [ris_agendasController::class, 'index'])->name('risagendas.index');
Route::get('/crearagendas/create', [ris_agendasController::class, 'create'])->name('risagendas.create');
Route::post('/crearagendas', [ris_agendasController::class, 'store'])->name('risagendas.store');
Route::get('crearagendas/{agenda}/edit', [ris_agendasController::class, 'edit'])->name('risagendas.edit');
Route::put('crearagendas/{agenda}', [ris_agendasController::class, 'update'])->name('risagendas.update');
Route::delete('crearagendas/{agenda}', [ris_agendasController::class, 'destroy'])->name('risagendas.destroy');


Route::get('/asignarcita', [ris_agendasController::class, 'asignarcita'])->name('risagendas.asignarcita');




Route::get('/pacientes', [ris_pacientesController::class, 'index'])->name('rispacientes.index');
Route::get('/pacientes/create', [ris_pacientesController::class, 'create'])->name('rispacientes.create');
Route::post('/pacientes', [ris_pacientesController::class, 'store'])->name('rispacientes.store');
Route::get('pacientes/{paciente}/edit', [ris_pacientesController::class, 'edit'])->name('rispacientes.edit');
Route::put('pacientes/{paciente}', [ris_pacientesController::class, 'update'])->name('rispacientes.update');
Route::delete('pacientes/{paciente}', [ris_pacientesController::class, 'destroy'])->name('rispacientes.destroy');


Route::get('/atencioninmediata', [ris_pacientesController::class, 'atencionimediata'])->name('atencionimediata.index');
Route::post('/atencioninmediatapaciente', [ris_pacientesController::class, 'atencioninmediatapaciente'])->name('atencioninmediata.paciente');
Route::get('/buscarpacientes', [ris_pacientesController::class, 'buscarpacientes'])->name('buscarpacientes.index');

Route::post('/guardarsoportes', [ris_pacientesController::class, 'guardarsoportes'])->name('guardarsoportes.store');

Route::get('/verificar-archivo/{admision}/{archivo}', [ris_pacientesController::class, 'verificarsoporte']);

/*
rutas 

Route::get('/cargaragenda/{idcliente}/{idsede}/{idsala}', [ris_agendasController::class, 'cargaragenda'])->name('risagendas.cargaragenda');
Route::get('/estudio/imprimir/{idestudio}', [lecturasController::class, 'index'])->name('imprimirlectura.index');
Route::get('/enviosocket', [HL7Controller::class, 'enviosocket'])->name('hl7.socket');
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');

Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::put('clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
Route::delete('clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::put('clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
Route::delete('clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

*/








//Route::put('/lectura/{lectura}',[lecturasController::class,'update'])->name('lectura.update');

//Route::delete('/lectura/{lectura}',[lecturasController::class,'destroy'])->name('lectura.destroy');
//Route::post('/datatable/estudiosclientes',[DatatableController::class,'estudiosclientes'])->name('datatable.estudiosclientes');
