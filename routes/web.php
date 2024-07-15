<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtaController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\ReuniaoController;
use App\Http\Controllers\DecisorioController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ObjetivoController;

Route::resource('objetivos', ObjetivoController::class);
Route::resource('reuniao', ReuniaoController::class);
Route::resource('decisorio', DecisorioController::class);
Route::resource('departamento', DepartamentoController::class);
Route::resource('colaborador', ColaboradorController::class);
Route::resource('ata', AtaController::class);
Route::get('/reuniao/{id}/participantes', [ReuniaoController::class, 'showParticipantes'])->name('reuniao.participantes');
Route::post('/reuniao/{id}/participantes', [ReuniaoController::class, 'updateParticipantes'])->name('reuniao.participantes.update');
Route::post('/reuniao/{id}/update-participantes', [ReuniaoController::class, 'updateParticipantes'])->name('reuniao.participantes.update');

Route::get('/', function () {
    return redirect()->route('reuniao.index');
});
