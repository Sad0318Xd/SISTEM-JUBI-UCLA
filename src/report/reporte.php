<?php
    //header("Location: index.php?controlador=VerSolicitud&metodo=VerSolicitud&exito=1");
    ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Jubilación - <?=$name . ' ' . $lastname?></title>
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
            background-size: 100px 100px;
        }
        
        .container {
            background-color: #fff;
            padding: 50px;
            position: relative;
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
        
        .letter-header {
            text-align: right;
            margin-bottom: 40px;
            font-style: italic;
        }
        
        .letter-header .location-date {
            font-size: 18px;
            margin-bottom: 7px;
        }
        
        .recipient {
            margin-bottom: 30px;
            text-transform: uppercase;
        }
        
        .recipient-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        .recipient-name {
            font-size: 18px;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }
        
        .recipient-position {
            font-size: 18px;
        }
        
        .salutation {
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 18px;
        }
        
        .letter-body {
            margin-bottom: 30px;
            font-size: 18px;
            text-align: justify;
        }
        
        .letter-body p {
            margin-bottom: 20px;
            text-indent: 40px;
        }
        
        .letter-footer {
            margin-top: 60px;
        }
        
        .closing {
            text-align: center;
            margin-bottom: 40px;
            font-weight: bold;
            font-size: 18px;
        }
        
        .signature-area {
            text-align: center;
            margin-bottom: 30px;
            padding-top: 50px;
        }
        
        .signature-line {
            display: inline-block;
            width: 300px;
            border-bottom: 1px solid #333;
            margin-bottom: 5px;
        }
        
        .sender-info {
            text-align: center;
            font-size: 16px;
            line-height: 1.8;
        }
        
        .sender-info div {
            margin-bottom: 5px;
        }
        
        .ci {
            letter-spacing: 1px;
        }
        
        .letter-divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #000, transparent);
            margin: 30px 0;
        }
        
        .document-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #8B0000;
            font-weight: bold;
        }
        
        /*.stamp {
            position: absolute;
            top: 50px;
            right: 50px;
            width: 120px;
            height: 120px;
            border: 2px solid #8B0000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(15deg);
            opacity: 0.7;
        }*/
        
        .stamp-text {
            text-align: center;
            color: #8B0000;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            padding: 10px;
        }
        
        .important-date {
            background-color: #ffebcd;
            padding: 8px;
            border-left: 3px solid #8B0000;
            margin: 18px 0;
            font-weight: bold;
            text-align: center;
        }
        
        .letter-body strong {
            font-weight: bold;
            color: #8B0000;
        }
        
        .letter-body .indent {
            display: block;
            text-indent: 40px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="watermark">UCLA</div>
        
        <div class="letter-header">
            <div class="location-date">Barquisimeto, <?= $dia?> de <?= $mes?> del <?= $ano?></div>
        </div>
        
        <div class="recipient">
            <div class="recipient-title">Ciudadano:</div>
            <div class="recipient-name">DR. LUIS EDUARDO MATHISON</div>
            <div class="recipient-position">DIRECTOR DE RECURSOS HUMANOS UCLA</div>
            <div class="recipient-position">Su despacho.</div>
        </div>
        
        <div class="salutation">Muy respetuosamente,</div>
        
        <div class="letter-body">
            <p>
                Me dirijo a usted en la oportunidad de solicitar sus buenos oficios a fin de tramitar ante el Consejo Universitario el beneficio de jubilación, de conformidad con lo previsto en el Reglamento de Jubilaciones y Pensiones del Personal Obrero de la UCLA.
            </p>
            
            <p>
                Esta solicitud la requiero que se haga efectiva a partir del día:
            </p>
            
            <div class="important-date">
                01 DE FEBRERO DEL 2024
            </div>
            
            <p>
                Agradezco su atención ante esta solicitud, no sin antes manifestarle mi gratitud a esta máxima casa de estudios por todos estos años de relación laboral.
            </p>
        </div>
        
        <div class="closing">Atentamente,</div>
        
        <div class="signature-area">
            <div class="signature-line"></div>
        </div>
        
        <div class="sender-info">
            <div class="sender-name"><?= $name . ' ' . $lastname?> </div>
            <div class="ci">C.I.N° V- <?=$ci?></div>
            <div class="position"><?=$cargo?></div>
            <div class="phone"><?=$telefono?></div>
            <div class="department"><?=$departamento?></div>
            <div class="program">Programa de Tecnología Agropecuaria - Núcleo Carora</div>
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
