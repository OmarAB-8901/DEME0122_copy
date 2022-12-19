<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });;
use App\Exports\EventsExport;

Auth::routes();


Route::get('/andon/oee/{idmachine}', 'AndonOEEController@index')->name('andonoee');
Route::get('/andon/oee/{param1}/{param2}/{param3}', 'AndonOEEController@consultaoee')->name('andonsoee');
Route::get('/andon/event/{idmachine}', 'AndonEventController@index')->name('andonevent');
Route::get('/andon/score/{idmachine}', 'AndonScorecardController@index')->name('andonscore');


Route::get      ('/button/andon/{param1}',                                      'AndonController@index')->name('andomb');
Route::get      ('/button/andon/orgchart/{param1}/{param2}/{param3}',           'AndonController@ConsultaOrgCharts')->name('org_chart');
Route::get      ('/button/andon/coninfoandon/{param1}/{param2}/{param3}',       'AndonController@ConsultaInfoAndon')->name('con_info_andon');
Route::get      ('/button/andon/coninfoestacion/{param1}/{param2}/{param3}',    'AndonController@ConsultaEstaciones')->name('con_info_estacion');
Route::get      ('/button/andon/setdefectos/{param1}/{param2}/{param3}/{param4}', 'AndonController@SetDefectos')->name('set_defectos');
                 // /button/andon/setdefectos/1/2/3/4

Route::group(['middleware'=>['auth']],function(){

    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => ['User']], function () {
       
        
        Route::get('/trends/{idvariable}', 'TrendsController@index')->name('trends');
        Route::get('/trends/{id}/monitoreo', 'TrendsController@monitoreo');
        Route::get('/oee/{idmachine}', 'OeeController@index')->name('oee');
        // Route::get('/andon/{idmachine}', 'OeeController@andon')->name('andon');
        Route::get('/events/{idmachine}', 'EventsController@index')->name('events');
        Route::get('/events/{idevent}/editm', 'EventsController@editm');
        Route::put('/events/{idmachine}', 'EventsController@update')->name('e_edit');
        Route::get('/trends/{idvariable}/{caso}/{date}/datos', 'TrendsController@datos');
        Route::get('/trends/{caso}/{date}/{idvar}/{nomvar}/export', 'TrendsController@export')->name('excelT');
        Route::get('/andon/{idmachine}/{caso}/{date}/{casoS}/datos', 'OeeController@datosandon');
        Route::get('/oee/{idmachine}/{caso}/{date}/{casoS}/{partid}/{lotid}/{idshift}/datos', 'OeeController@datos');
        Route::get('/oee/{idmachine}/{caso}/{date}/{casoS}/{partid}/{lotid}/{idshift}/{nomvar}/export', 'OeeController@export');
        Route::get('/Events/{idmachine}/{caso}/{date}/datos', 'EventsController@datos');
        Route::get('/events/{caso}/{date}/{idmachine}/{nomvar}/export', 'EventsController@export')->name('excelA');
        


    });

    Route::group(['middleware' => ['Admin']], function () {
        
        
        Route::get  ('/machine',                'MachineController@index')->name('machine');
        Route::post ('/machine/registrar',      'MachineController@store')->name('m_registrar');
        Route::put  ('/machine/actualizar',     'MachineController@update')->name('m_edit');
        Route::put  ('/machine/desactivar',     'MachineController@desactivar')->name('m_desactivar');
        Route::put  ('/machine/activar',        'MachineController@activar')->name('m_activar');

        Route::get  ('/variable',                   'VariableController@index')->name('variable');
        Route::post ('/variable/registrar',         'VariableController@store')->name('v_registrar');
        Route::put  ('/variable/actualizar',        'VariableController@update')->name('v_edit');
        Route::put  ('/variable/desactivar/',       'VariableController@desactivar')->name('v_desactivar');
        Route::put  ('/variable/activar',           'VariableController@activar')->name('v_activar');
    

        Route::get  ('/typeevent',                  'TypeEventController@index')->name('typeevent');
        Route::post ('/typeevent/registrar',        'TypeEventController@store')->name('t_registrar');
        Route::put  ('/typeevent/actualizar',       'TypeEventController@update')->name('t_edit');
        Route::put  ('/typeevent/desactivar',       'TypeEventController@desactivar')->name('t_desactivar');
        Route::put  ('/typeevent/activar',          'TypeEventController@activar')->name('t_activar');

        Route::get  ('/models',                     'ModelsController@index')->name('models');
        Route::post ('/models/registrar',           'ModelsController@store')->name('mod_registrar');
        Route::put  ('/models/actualizar',          'ModelsController@update')->name('mod_edit');
        Route::put  ('/models/desactivar',          'ModelsController@desactivar')->name('mod_desactivar');
        Route::put  ('/models/activar',             'ModelsController@activar')->name('mod_activar');
        Route::put  ('/models/habsensor/desactivar','ModelsController@HabSensor_desactivar')->name('mods_desactivar');
        Route::put  ('/models/habsensor/activar',   'ModelsController@HabSensor_activar')->name('mods_activar');

        Route::get  ('/areas',                     'AreasController@index')->name('areas');
        Route::post ('/areas/registrar',           'AreasController@store')->name('ar_registrar');
        Route::put  ('/areas/actualizar',          'AreasController@update')->name('ar_edit');
        Route::put  ('/areas/desactivar',          'AreasController@desactivar')->name('ar_desactivar');
        Route::put  ('/areas/activar',             'AreasController@activar')->name('ar_activar');

        Route::get  ('/roles',                       'RolesController@index')->name('roles');
        Route::post ('/roles/registrar',             'RolesController@store')->name('r_registrar');
        Route::put  ('/roles/actualizar',            'RolesController@update')->name('r_edit');
        
        Route::get  ('/user',                       'UserController@index')->name('user');
        Route::post ('/user/registrar',             'UserController@store')->name('u_registrar');
        Route::put  ('/user/actualizar',            'UserController@update')->name('u_edit');
        Route::put  ('/user/desactivar',            'UserController@desactivar')->name('u_desactivar');
        Route::put  ('/user/activar',               'UserController@activar')->name('u_activar');

        Route::get  ('/groups',                     'GroupController@index')->name('group');
        Route::post ('/groups/registrar',           'GroupController@store')->name('g_registrar');
        Route::put  ('/groups/actualizar',          'GroupController@update')->name('g_edit');
        Route::put  ('/groups/desactivar',          'GroupController@desactivar')->name('g_desactivar');
        Route::put  ('/groups/activar',             'GroupController@activar')->name('g_activar');

        Route::get  ('/shift',                      'ShiftController@index')->name('shift');
        Route::post ('/shift/registrar',            'ShiftController@store')->name('s_registrar');
        Route::put  ('/shift/actualizar',           'ShiftController@update')->name('s_edit');
        Route::put  ('/shift/desactivar',           'ShiftController@desactivar')->name('s_desactivar');
        Route::put  ('/shift/activar',              'ShiftController@activar')->name('s_activar');

        Route::get  ('/scraps',                     'ScrapsController@index')->name('scrap');
        Route::post ('/scraps/registrar',           'ScrapsController@store')->name('sc_registrar');
        Route::put  ('/scraps/actualizar',          'ScrapsController@update')->name('sc_edit');
        Route::put  ('/scraps/desactivar',          'ScrapsController@desactivar')->name('sc_desactivar');
        Route::put  ('/scraps/activar',             'ScrapsController@activar')->name('sc_activar');

    });

    Route::group(['middleware' => ['Calidad']], function () {
        Route::get  ('/calidad',                     'CalidadController@index')->name('calidad');
    });
    Route::group(['middleware' => ['Plan']], function () {
        Route::get  ('/planes',                     'PlanesController@index')->name('planes');
        Route::post ('/planes/registrar',           'PlanesController@store')->name('pl_registrar');
        Route::put  ('/planes/actualizar',          'PlanesController@update')->name('pl_edit');
        Route::put  ('/planes/desactivar',          'PlanesController@desactivar')->name('pl_desactivar');
        Route::put  ('/planes/activar',             'PlanesController@activar')->name('pl_activar');
        
    });

     
});