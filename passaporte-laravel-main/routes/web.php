<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usuario;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InscricaoController;

Route::get('/', [EventoController::class, 'index'])->name('home');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('logar', [AuthController::class, 'login'])->name('logar');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('cadastro', [Usuario::class, 'cadastrar'])->name('usuario.cadastro');
Route::post('salvar', [Usuario::class, 'salvar'])->name('usuario.salvar');
Route::get('evento/criar', [EventoController::class, 'criar'])->name('evento.criar');
Route::post('evento/salvar', [EventoController::class, 'salvar'])->name('evento.salvar');
Route::get('evento/inscrever/{id}', [EventoController::class, 'inscrever'])->name('evento.inscrever');
Route::post('/evento/{id}/inscrever', [InscricaoController::class, 'inscrever'])->name('inscricao.salvar');
Route::middleware(['organizador'])->group(function () {
    Route::get('/evento/criar', [EventoController::class, 'criar'])->name('evento.criar');
    Route::post('/evento/salvar', [EventoController::class, 'salvar'])->name('evento.salvar');
});
Route::middleware(['organizador'])->group(function () {
    Route::get('/evento/criar', [EventoController::class, 'criar'])->name('evento.criar');
    Route::post('/evento/salvar', [EventoController::class, 'salvar'])->name('evento.salvar');
    Route::get('/meus-eventos', [EventoController::class, 'meusEventos'])->name('evento.meus');
});
Route::middleware(['organizador'])->group(function () {
    Route::get('/evento/criar', [EventoController::class, 'criar'])->name('evento.criar');
    Route::post('/evento/salvar', [EventoController::class, 'salvar'])->name('evento.salvar');
    Route::get('/meus-eventos', [EventoController::class, 'meusEventos'])->name('evento.meus');
    
    Route::get('/evento/{id}/editar', [EventoController::class, 'editar'])->name('evento.editar');
    Route::put('/evento/{id}/atualizar', [EventoController::class, 'atualizar'])->name('evento.atualizar');
    Route::delete('/evento/{id}/excluir', [EventoController::class, 'excluir'])->name('evento.excluir');
});
Route::get('/meus-ingressos', [App\Http\Controllers\EventoController::class, 'meusIngressos'])->name('inscricao.meus');
Route::get('/', [App\Http\Controllers\EventoController::class, 'index'])->name('home');
Route::get('/evento/{id}', [App\Http\Controllers\EventoController::class, 'detalhes'])->name('evento.detalhes');
Route::delete('/meus-ingressos/{id}/cancelar', [App\Http\Controllers\EventoController::class, 'cancelarInscricao'])->name('inscricao.cancelar');