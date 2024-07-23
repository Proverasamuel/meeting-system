<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtaController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\ReuniaoController;
use App\Http\Controllers\DecisorioController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ObjetivoController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ConvidadoController;
use App\Http\Controllers\PdfParticipantesConvidados;



Route::resource('objetivos', ObjetivoController::class);
Route::resource('reuniao', ReuniaoController::class);
Route::resource('decisorio', DecisorioController::class);
Route::resource('departamento', DepartamentoController::class);
Route::resource('colaborador', ColaboradorController::class);
Route::resource('ata', AtaController::class);
Route::get('/reuniao/{id}/participantes', [ReuniaoController::class, 'showParticipantes'])->name('reuniao.participantes');
Route::post('/reuniao/{id}/participantes', [ReuniaoController::class, 'updateParticipantes'])->name('reuniao.participantes.update');
Route::post('/reuniao/{id}/update-participantes', [ReuniaoController::class, 'updateParticipantes'])->name('reuniao.participantes.update');


Route::resource('convidados', ConvidadoController::class);
Route::post('/reuniao/{reuniao}/convidados', [ConvidadoController::class, 'store'])->name('convidados.store');

Route::get('/generate-pdf/{id}', [PdfController::class, 'generatePDF'])->name('generate-pdf');
Route::get('/generate-participantes-pdf/{id}', [PdfParticipantesConvidados::class, 'generateParticipanteConvidadoPDF'])->name('generate-participantes-pdf');
Route::get('/', function () {
    return redirect()->route('reuniao.index');
});
