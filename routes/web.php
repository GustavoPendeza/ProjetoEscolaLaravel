<?php

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

/**
 * Route Group das Views do site inicial
 */
Route::namespace('App\Http\Controllers\Site')->group(function() {
    // ROTA INDEX DA HOME DO SITE
    Route::get('/', 'HomeController')->name('site.home');

    // ROTA INDEX DAS CATEGORIAS DE ESTUDO
    Route::get('/category', 'SubjectController@index')->name('site.category');
    // ROTA SHOW MOSTRA AS MATÉRIAS DA CATEGORIA SELECIONADA
    Route::get('/category/{category}', 'SubjectController@show')->name('site.category.subject');

    // ROTA INDEX DE LOGIN
    Route::get('/login', 'LoginController@index')->name('site.login');
    // ROTA DE LOGIN
    Route::post('/login/do', 'LoginController@login')->name('site.login.do');
    // ROTA CADASTRO DE LOGIN
    Route::get('/register', 'LoginController@create')->name('site.login.create');
    // ROTA CADASTRO DE LOGIN (POST)
    Route::post('/register', 'LoginController@post')->name('site.login.create');
    // ROTA DE LOGOUT
    Route::get('/logout', 'LoginController@logout')->name('site.logout');
    // ROTA ESQUECI A SENHA
    Route::get('/forgot', 'LoginController@forgot')->name('site.forgot');
    // ROTA ESQUECI A SENHA (POST)
    Route::post('/forgot', 'LoginController@sendMail')->name('site.forgot');
    // ROTA ALTERAR SENHA
    Route::get('/forgot/{user}', 'LoginController@edit')->name('site.forgot.edit');
    // ROTA ALTERAR SENHA (POST)
    Route::patch('/forgot/{user}', 'LoginController@update')->name('site.forgot.edit');
});

/**
 * Route Group das Views de estudante
 */
Route::namespace('App\Http\Controllers\Student')->group(function() {
    // ROTA INDEX DA HOME DO ESTUDANTE
    Route::get('/student', 'HomeStudentController')->name('student.home');

    // ROTA INDEX DE MATRÍCULAS
    Route::get('/student/enrollments', 'EnrollmentStudentController@index')->name('student.enrollment');
    // ROTA DE CADASTRO DE MATRÍCULAS
    Route::get('/student/enrollment/create', 'EnrollmentStudentController@create')->name('student.enrollment.create');
    // ROTA DE CADASTRO DE MATRÍCULAS (POST)
    Route::post('/student/enrollment/create', 'EnrollmentStudentController@post')->name('student.enrollment.create');
    // ROTA DE ATUALIZAÇÃO DE MATRÍCULAS
    Route::get('/student/enrollment/edit/{enrollment}', 'EnrollmentStudentController@edit')->name('student.enrollment.edit');
    // ROTA DE ATUALIZAÇÃO DE MATRÍCULAS (PATCH)
    Route::patch('/student/enrollment/edit/{enrollment}', 'EnrollmentStudentController@update')->name('student.enrollment.edit');
    // ROTA DE EXCLUSÃO DE MATRÍCULAS
    Route::get('/student/enrollment/delete/{enrollment}', 'EnrollmentStudentController@delete')->name('student.enrollment.delete');
    // ROTA DE EXCLUSÃO DE MATRÍCULAS (DELETE)
    Route::delete('/student/enrollment/delete/{enrollment}', 'EnrollmentStudentController@destroy')->name('student.enrollment.delete');

    // ROTA DE ATUALIZAÇÃO DE PERFIL DO USUÁRIO
    Route::get('/student/user/edit/{user}', 'UserStudentController@edit')->name('student.user.edit');
    // ROTA DE ATUALIZAÇÃO DE PERFIL DO USUÁRIO (PATCH)
    Route::patch('/student/user/edit/{user}', 'UserStudentController@update')->name('student.user.edit');
});

/**
 * Route Group das Views de Admin
 */
Route::namespace('App\Http\Controllers\Admin')->group(function() {
    // ROTA INDEX DA HOME DE ADMIN
    Route::get('/admin', 'HomeAdminController')->name('admin.home');

    // ROTA INDEX DAS CATEGORIAS DE ESTUDO
    Route::get('/admin/categories', 'CategoryAdminController@index')->name('admin.category');
    // ROTA DE CADASTRO DAS CATEGORIAS DE ESTUDO
    Route::get('/admin/category/create', 'CategoryAdminController@create')->name('admin.category.create');
    // ROTA DE CADASTRO DAS CATEGORIAS DE ESTUDO (POST)
    Route::post('/admin/category/create', 'CategoryAdminController@post')->name('admin.category.create');
    // ROTA DE ATUALIZAÇÃO DE CATEGORIA DE ESTUDO
    Route::get('/admin/category/edit/{category}', 'CategoryAdminController@edit')->name('admin.category.edit');
    // ROTA DE ATUALIZAÇÃO DE CATEGORIA DE ESTUDO (PATCH)
    Route::patch('/admin/category/edit/{category}', 'CategoryAdminController@update')->name('admin.category.edit');
    // ROTA DE EXCLUSÃO DE CATEGORIA DE ESTUDO
    Route::get('/admin/category/delete/{category}', 'CategoryAdminController@delete')->name('admin.category.delete');
    // ROTA DE EXCLUSÃO DE CATEGORIA DE ESTUDO (DELETE)
    Route::delete('/admin/category/delete/{category}', 'CategoryAdminController@destroy')->name('admin.category.delete');

    // ROTA INDEX DAS MATÉRIAS
    Route::get('/admin/subjects', 'SubjectAdminController@index')->name('admin.subject');
    // ROTA DE CADASTRO DAS MATÉRIAS
    Route::get('/admin/subject/create', 'SubjectAdminController@create')->name('admin.subject.create');
    // ROTA DE CADASTRO DAS MATÉRIAS (POST)
    Route::post('/admin/subject/create', 'SubjectAdminController@post')->name('admin.subject.create');
    // ROTA DE ATUALIZAÇÃO DAS MATÉRIAS
    Route::get('/admin/subject/edit/{subject}', 'SubjectAdminController@edit')->name('admin.subject.edit');
    // ROTA DE ATUALIZAÇÃO DAS MATÉRIAS (PUT)
    Route::put('/admin/subject/edit/{subject}', 'SubjectAdminController@update')->name('admin.subject.edit');
    // ROTA DE EXCLUSÃO DAS MATÉRIAS
    Route::get('/admin/subject/delete/{subject}', 'SubjectAdminController@delete')->name('admin.subject.delete');
    // ROTA DE EXCLUSÃO DAS MATÉRIAS (DELETE)
    Route::delete('/admin/subject/delete/{subject}', 'SubjectAdminController@destroy')->name('admin.subject.delete');
    
    // ROTA INDEX DE USUÁRIOS
    Route::get('/admin/users', 'UserAdminController@index')->name('admin.user');
    // ROTA DE USUÁRIOS DESATIVADOS
    Route::get('/admin/users/disabled', 'UserAdminController@show')->name('admin.user.disabled');
    // ROTA DE CADASTRO DE USUÁRIOS
    Route::get('/admin/user/create', 'UserAdminController@create')->name('admin.user.create');
    // ROTA DE CADASTRO DE USUÁRIOS (POST)
    Route::post('/admin/user/create', 'UserAdminController@post')->name('admin.user.create');
    // ROTA DE ATUALIZAÇÃO DE USUÁRIOS
    Route::get('/admin/user/edit/{user}', 'UserAdminController@edit')->name('admin.user.edit');
    // ROTA DE ATUALIZAÇÃO DE USUÁRIOS (PATCH)
    Route::patch('/admin/user/edit/{user}', 'UserAdminController@update')->name('admin.user.edit');    
    // ROTA DE DESATIVAÇÃO DE USUÁRIOS
    Route::get('/admin/user/delete/{user}', 'UserAdminController@delete')->name('admin.user.delete');
    // ROTA DE DESATIVAÇÃO DE USUÁRIOS (DELETE)
    Route::delete('/admin/user/delete/{user}', 'UserAdminController@destroy')->name('admin.user.delete');
});