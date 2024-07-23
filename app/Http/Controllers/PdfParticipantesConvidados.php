<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\Reuniao;

class PdfParticipantesConvidados extends Controller
{
    public function generateParticipanteConvidadoPDF($id)
    {
        $reuniao = Reuniao::with('participantes.colaborador', 'convidados')->findOrFail($id);

        $data = [
            'reuniao' => $reuniao,
            'participantes' => $reuniao->participantes,
            'convidados' => $reuniao->convidados
        ];

        // Instanciar Dompdf
        $dompdf = new Dompdf();

        // Carregar a view e passar os dados
        $html = view('pdf.reuniaoConvidado', $data)->render();

        // Carregar o conteúdo HTML no Dompdf
        $dompdf->loadHtml($html);

        // (Opcional) Definir o tamanho e orientação do papel
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar o PDF
        $dompdf->render();

        // Enviar o PDF como resposta
        return $dompdf->stream('lista_presenca.pdf', ["Attachment" => false]);
    }
}
