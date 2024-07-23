<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Presença</title>
    <style>
        body {
            width: 700px;
            height: 930px;
            margin: auto;
            font-size: 10px;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        .logo {
            width: 80%;
        }
    </style>
</head>

<body>
    <div>
        <table>
            <tr>
                <td rowspan="1" style="text-align: center;">
                    <img src="images.jpeg" alt="MULTITEL Logo" class="logo">
                </td>
                <td colspan="12" style="text-align: center;">
                    <h2>LISTA DE PRESENÇA</h2>
                </td>
            </tr>
            <tr>
                <th colspan="6" style="text-align: right;">Processo de Qualidade, Riscos e Sustentabilidade</th>
                <th colspan="2" style="text-align: right;">Codigo:</th>
                <td colspan="3" style="text-align: right;">MOD.QRS.03.02</td>
                <th colspan="1" style="text-align: right;">Revisão:</th>
                <td colspan="1" style="text-align: right;">01</td>
            </tr>
        </table>

        <h2 style="text-indent: 10%; margin-top: 30px; margin-bottom: 0px;">DETALHES DO ENCONTRO</h2>
        <table style="border: 1px solid #000; margin-top: 0;">
            <tr style="height: 120px;">
                <th style="background-color: #9da1a43c; width: 20%;">Objectivo do Encontro</th>
                <td colspan="6">{{ $reuniao->titulo }}</td>
            </tr>
            <tr style="height: 15px;">
                <th style="background-color: #9da1a43c; width: 20%;">Local:</th>
                <td colspan="3">{{ $reuniao->local }}</td>
                <th style="background-color: #9da1a43c; width: 100px;">Data:</th>
                <td colspan="2">{{ $reuniao->data }}</td>
            </tr>
            <tr style="height: 15px;">
                <th style="background-color: #9da1a43c; width: 20%;">Período:</th>
                <td colspan="3">{{ $reuniao->hora_inicio }} - {{ $reuniao->hora_fim }}</td>
                <th style="background-color: #9da1a43c; width: 100px;">Hora:</th>
                <td colspan="2">{{ $reuniao->hora_inicio }}</td>
            </tr>
            <tr style="height: 15px;">
                <th style="background-color: #9da1a43c; width: 20%;">Responsável:</th>
                <td colspan="3">{{ $reuniao->responsavel }}</td>
                <th style="background-color: #9da1a43c; width: 100px;">Nº:</th>
                <td colspan="2">{{ $reuniao->id }}</td>
            </tr>
        </table>

        <h2 style="text-indent: 10%; margin-top: 30px; margin-bottom: 0px;">REGISTO DE PRESENÇAS</h2>
        <div style="padding: 10px; margin-bottom: 20px; text-align: center; margin-top: 0;">
            <table>
                <tr>
                    <th style="background-color: #0076c0; color: #fff; width: 25%;">NOME</th>
                    <th style="background-color: #0076c0; color: #fff; width: 25%;">FUNÇÃO</th>
                    <th style="background-color: #0076c0; color: #fff; width: 25%;">DEPARTAMENTO</th>
                    <th style="background-color: #0076c0; color: #fff; width: 25%;">ASSINATURA</th>
                </tr>
                @foreach ($participantes as $participante)
                <tr>
                    <td>{{ $participante->colaborador->name }}</td>
                    <td>{{ $participante->colaborador->funcao }}</td>
                    <td>{{ $participante->colaborador->departamento }}</td>
                    <td>@if($participante->presente) Presente @else Ausente @endif</td>
                </tr>
                @endforeach
                @foreach ($convidados as $convidado)
                <tr>
                    <td>{{ $convidado->nome }}</td>
                    <td>{{ $convidado->funcao }}</td>
                    <td>{{ $convidado->area }}</td>
                    <td>Convidado</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div style="text-align: center;">
            <p style="color: #0076c0;">MOD.QRS.03.02 - Lista de Presença</p>
            <p style="color: #0076c0;">Rua Cristiano dos Santos, nº 5, Bairro Miramar, Distrito Urbano do Sambizanga, Luanda - Angola</p>
        </div>
    </div>
</body>

</html>
