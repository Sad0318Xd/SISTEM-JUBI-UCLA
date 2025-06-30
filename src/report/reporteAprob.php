<?php
    ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorando de Jubilación</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Times New Roman', Times, serif;
        }
        
        body {
            background-color: white;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            background-color: #fff;
            padding: 50px;
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 120px;
            color: rgba(0, 0, 0, 0.05);
            z-index: 1;
            font-weight: bold;
            pointer-events: none;
            text-transform: uppercase;
            opacity: 0.3;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .university-name {
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
        }
        
        .secretary-name {
            font-size: 15px;
            margin-bottom: 1px;
        }
        
        .document-title {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .addressed-to {
            margin-bottom: 15px;
        }
        
        .addressed-to-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .subject {
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .body-text {
            margin-bottom: 18px;
            text-align: justify;
        }
        
        .body-text p {
            margin-bottom: 5px;
        }
        
        .approval-info {
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        table, th, td {
            border: 1px solid #333;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
        }
        
        .footer {
            margin-top: 20px;
        }
        
        .signature {
            text-align: center;
            margin-top: 50px;
        }
        
        .signature-line {
            display: inline-block;
            width: 300px;
            border-bottom: 1px solid #333;
            margin-bottom: 5px;
        }
        
        .signature-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .signature-position {
            font-style: italic;
        }
        
        .cc {
            margin-top: 30px;
            font-style: italic;
        }
        
        .important-text {
            font-weight: bold;
        }
        
        .uppercase {
            text-transform: uppercase;
        }
        
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            
            .container {
                box-shadow: none;
                border: none;
                padding: 30px;
                max-width: 100%;
                margin: 0;
            }
            
            .watermark {
                display: none;
            }
        }
        li {
            list-style: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="watermark">UCLA</div>
        
        <div class="header">
            <div class="university-name uppercase">república bolivariana de venezuela</div>
            <div class="university-name uppercase">universidad centroccidental</div>
            <div class="university-name uppercase">"lisandro alvarado"</div>
            <div class="secretary-name">secretaría del consejo universitario</div>
            <div class="document-title uppercase">memorando</div>
        </div>
        
        <div class="addressed-to">
            <div class="addressed-to-title">Dirigido a:</div>
            <div>Prof. Edgar Alvarado</div>
            <div>Vicerrectorado Administrativo</div>
        </div>
        
        <div class="subject">
            <div>Motivo: <span class="important-text">Jubilación (Personal Obrero)</span></div>
        </div>
        
        <div class="body-text">
            <p>
                El Consejo Universitario en su Sesión N° 3401, ORDINARIA de fecha 21/02/2024 APROBÓ la <span class="important-text">JUBILACIÓN</span> sujeta a las condiciones legales vigentes en esta materia para la fecha de la jubilación del funcionario abajo mencionado:
            </p>
            
            <table>
                <tr>
                    <th>Nombre, Cédula de Identidad, Cargo y Unidad de Adscripción</th>
                    <th>A partir del</th>
                    <th>Tiempo de servicio</th>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li class="important-text uppercase"><?= $name . ' ' . $lastname?></li> 
                            <li>C.I. V-<?=$ci?></li>
                            <li><?=$cargo?></li>
                            <li><?=$departamento?></li>
                            <li>Programa de Línea Carona</li>

                        </ul>
                    </td>
                    <td><?=$fecha_modi?></td>
                    <td>UCLA: <?= $añosServicio->y ?> años, <?= $añosServicio->m ?> meses, <?= $añosServicio->d ?> días.</td>
                </tr>
                    
            </table>
            
            <p>
                Cumple con lo establecido en el Artículo 2º del Reglamento de Jubilaciones y Pensiones del Personal Obrero de la UCLA. Queda pendiente el informe emitido por la Dirección de Recursos Humanos, en atención a lo previsto en la Resolución N° 034-2007 (Solvencia Académica-Administrativa) y a una actualización.
            </p>
        </div>
        
        <div class="footer">
            <div class="signature">
                <div class="signature-line"></div>
                <div class="signature-name">Prof. Edgar Rodríguez León</div>
                <div class="signature-position">Secretario (E) Consejo Universitario de la Universidad Centroccidental</div>
                <div>Designado conforme consta en Gaceta Universitaria de los Universitarios N° 147 y de acuerdo con lo aprobado en los Consejos</div>
                <div>Universitarios, en sus Sesiones Extraordinarias Nros 2416 y 2417.</div>
            </div>
            
            <div class="cc">
                <div>Cc. DDSD</div>
                <div>Decanatos</div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    $htmlContent = ob_get_clean();

    require_once __DIR__ . '/../../librarys/dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    $options = $dompdf->getOptions();
    $options->set(array(
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
        'isFontSubsettingEnabled' => true,
        'defaultFont' => 'Helvetica'
    ));
    $dompdf->loadHtml($htmlContent);
    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $reportname = 'Solicitud_' . $name . '_' . $lastname . '_' . $ci . '.pdf';
    $dompdf->stream("$reportname", array("Attachment" => true));

    

?>
