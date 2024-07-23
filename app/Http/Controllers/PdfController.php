<?php
namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\Reuniao;

class PdfController extends Controller
{
    public function generatePDF($id)
    {
        $reuniao = Reuniao::with('participantes.colaborador')->findOrFail($id);

        $data = [
            'reuniao' => $reuniao,
        ];

        // Instanciar Dompdf
        $dompdf = new Dompdf();

        // Carregar a view e passar os dados
        $html = view('pdf.reuniao', $data)->render();

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
