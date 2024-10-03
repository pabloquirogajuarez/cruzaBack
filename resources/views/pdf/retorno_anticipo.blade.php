<?php
// Función para convertir números a letras
function numeroALetras($numero)
{
    $unidades = ['', 'UNO', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE'];
    $decenas = ['', 'DIEZ', 'VEINTE', 'TREINTA', 'CUARENTA', 'CINCUENTA', 'SESENTA', 'SETENTA', 'OCHENTA', 'NOVENTA'];
    $centenas = ['', 'CIENTO', 'DOSCIENTOS', 'TRESCIENTOS', 'CUATROCIENTOS', 'QUINIENTOS', 'SEISCIENTOS', 'SETECIENTOS', 'OCHOCIENTOS', 'NOVECIENTOS'];

    $especiales = [
        11 => 'ONCE',
        12 => 'DOCE',
        13 => 'TRECE',
        14 => 'CATORCE',
        15 => 'QUINCE',
        16 => 'DIECISEIS',
        17 => 'DIECISIETE',
        18 => 'DIECIOCHO',
        19 => 'DIECINUEVE',
        21 => 'VEINTIUNO',
        22 => 'VEINTIDOS',
        23 => 'VEINTITRES',
        24 => 'VEINTICUATRO',
        25 => 'VEINTICINCO',
        26 => 'VEINTISEIS',
        27 => 'VEINTISIETE',
        28 => 'VEINTIOCHO',
        29 => 'VEINTINUEVE',
    ];

    if ($numero == 0) {
        return 'CERO';
    }

    $partes = explode('.', number_format($numero, 2, '.', ''));
    $entero = intval($partes[0]);

    $resultado = '';

    if ($entero >= 1000) {
        $miles = intval(floor($entero / 1000));
        $entero = $entero % 1000;
        if ($miles == 1) {
            $resultado .= 'MIL ';
        } else {
            $resultado .= numeroALetras($miles) . ' MIL ';
        }
    }

    if ($entero >= 100) {
        $resultado .= $centenas[intval(floor($entero / 100))] . ' ';
        $entero = $entero % 100;
    }

    if (isset($especiales[$entero])) {
        $resultado .= $especiales[$entero] . ' ';
        $entero = 0;
    } elseif ($entero >= 10) {
        $resultado .= $decenas[intval(floor($entero / 10))];
        $entero = $entero % 10;
        if ($entero > 0) {
            $resultado .= ' Y ' . $unidades[$entero] . ' ';
        }
    } elseif ($entero > 0) {
        $resultado .= $unidades[$entero] . ' ';
    }

    return trim($resultado);
}

// Convertir la retribución a letras
$netoEnLetras = numeroALetras($neto_a_cobrar);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retorno de anticipo - Triplicado</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 8pt;
        }
        .container-fluid {
            width: 100%;
            max-width: 210mm;
            height: 297mm;
            margin: auto;
            padding: 0;
            box-sizing: border-box;
        }
        .recibo {
            border: 1px solid #000;
            border-radius: 10px;
            padding: 2px;
            margin-bottom: 20px;
            width: 98%;
            box-sizing: border-box;
        }
        .recibo-header {
            padding: 10px;
            border-bottom: 1px solid #000;
            text-align: center; /* Centrando todo el encabezado */
        }
        .recibo-header img {
            max-height: 60px;
            float: left; /* Imagen alineada a la izquierda */
        }
        .recibo-header h5 {
            margin: 15px; /* Sin margen superior */
        }
        .recibo-body {
            padding: 2px 3px;
        }
        .recibo-body p {
            margin: 1px 0;
            line-height: 1.2;
        }
        .recibo-body ul {
            padding-left: 15px;
            margin: 0;
        }
        .recibo-body ul li {
            margin-bottom: 1px;
        }
        .firma {
            margin-top: 5px;
            text-align: right;
        }
        .firma p {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Recibo 1 -->
            <div class="w-100">
                <div class="recibo">
                    <div class="recibo-header d-flex align-items-center">
                        <!-- Logo alineado a la izquierda -->
                        <img src="./img/vdvlogocoop.jpg" alt="Logo Empresa" class="me-3">
                        
                        <!-- Texto centrado en la misma línea -->
                        <div class="info flex-grow-1 text-center">
                            <h5 class="mb-0"><strong>VDVCOOP</strong> - Cooperativa de Trabajo LTDA.</h5>
                            <p class="mb-0">Dirección: Garibaldi N° 127, Santiago del Estero</p>
                        </div>
                        
                        <!-- Mantener espacio a la derecha para asegurar que todo esté en la misma línea -->
                    </div>
                    <div class="recibo-body">
                        <div class="row mb-1">
                            <div class="col-6 text-end">
                            <p><strong>Periodo:</strong> Desde {{ \Carbon\Carbon::parse($fechaDesde)->format('d/m/Y') }} hasta {{ \Carbon\Carbon::parse($fechaHasta)->format('d/m/Y') }}</p>

                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6">
                            <p><strong>Nombre y Apellido:</strong> {{ $nombre }} <strong class="ms-3">DNI:</strong> {{ number_format($dni, 0, '', '.') }}</p>
                                <p></p>
                                <p><strong>Domicilio laboral:</strong> {{ $domicilio }}</p>
                                <p><strong>Empresa:</strong> {{ $empresa_id }}</p>
                            </div>
                        </div>       
                        <div class="row mb-1">
                            <div class="col-12">
                                <p><strong>Retribución:</strong> <span class="ms-5">${{ number_format($retribucion, 2, ',', '.') }}</span></p>
                                <p><strong>Retenciones:</strong></p>
                                <ul>
                                    <li><strong>RET. LEY 28565/04:</strong> <span class="ms-1">${{ number_format($retencion1, 2, ',', '.') }}</span> <strong class="ms-3">(Aporte Jubilatorio)</strong></li>
                                    <li><strong>RET. LEY 28565/04:</strong> <span class="ms-1">${{ number_format($retencion2, 2, ',', '.') }}</span> <strong class="ms-3">(Impuesto Integrado)</strong></li>
                                    <li><strong>RET. LEY 28565/04:</strong> <span class="ms-1">${{ number_format($retencion3, 2, ',', '.') }}</span> <strong class="ms-3">(Obra social)</strong></li>
                                    <li><strong>Otras retenciones:</strong> <span class="ms-2">${{ number_format($retencion4, 2, ',', '.') }}</span></li>
                                </ul>
                                <p><strong>- Neto a Cobrar:</strong> <span class="ms-4">${{ number_format($neto_a_cobrar, 2, ',', '.') }}</span></p>
                            </div>
                            <p><strong>Recibi conforme la suma de pesos:</strong> {{ $netoEnLetras }} PESOS</p>
                            <p><strong>En concepto de retribución por mis servicios prestados por cooperativa.</strong></p>
                        </div>
                        <div class="firma">
                            <p>Firma: ____________________</p>
                        </div>
                    </div>
                </div>
                 <!-- Recibo 1 -->
                 <div class="w-100">
                <div class="recibo">
                    <div class="recibo-header d-flex align-items-center">
                        <!-- Logo alineado a la izquierda -->
                        <img src="./img/vdvlogocoop.jpg" alt="Logo Empresa" class="me-3">
                        
                        <!-- Texto centrado en la misma línea -->
                        <div class="info flex-grow-1 text-center">
                            <h5 class="mb-0"><strong>VDVCOOP</strong> - Cooperativa de Trabajo LTDA.</h5>
                            <p class="mb-0">Dirección: Garibaldi N° 127, Santiago del Estero</p>
                        </div>
                        
                        <!-- Mantener espacio a la derecha para asegurar que todo esté en la misma línea -->
                    </div>
                    <div class="recibo-body">
                        <div class="row mb-1">
                            <div class="col-6 text-end">
                            <p><strong>Periodo:</strong> Desde {{ \Carbon\Carbon::parse($fechaDesde)->format('d/m/Y') }} hasta {{ \Carbon\Carbon::parse($fechaHasta)->format('d/m/Y') }}</p>

                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6">
                            <p><strong>Nombre y Apellido:</strong> {{ $nombre }} <strong class="ms-3">DNI:</strong> {{ number_format($dni, 0, '', '.') }}</p>
                                <p></p>
                                <p><strong>Domicilio laboral:</strong> {{ $domicilio }}</p>
                                <p><strong>Empresa:</strong> {{ $empresa_id }}</p>
                            </div>
                        </div>       
                        <div class="row mb-1">
                            <div class="col-12">
                                <p><strong>Retribución:</strong> <span class="ms-5">${{ number_format($retribucion, 2, ',', '.') }}</span></p>
                                <p><strong>Retenciones:</strong></p>
                                <ul>
                                    <li><strong>RET. LEY 28565/04:</strong> <span class="ms-1">${{ number_format($retencion1, 2, ',', '.') }}</span> <strong class="ms-3">(Aporte Jubilatorio)</strong></li>
                                    <li><strong>RET. LEY 28565/04:</strong> <span class="ms-1">${{ number_format($retencion2, 2, ',', '.') }}</span> <strong class="ms-3">(Impuesto Integrado)</strong></li>
                                    <li><strong>RET. LEY 28565/04:</strong> <span class="ms-1">${{ number_format($retencion3, 2, ',', '.') }}</span> <strong class="ms-3">(Obra social)</strong></li>
                                    <li><strong>Otras retenciones:</strong> <span class="ms-2">${{ number_format($retencion4, 2, ',', '.') }}</span></li>
                                </ul>
                                <p><strong>- Neto a Cobrar:</strong> <span class="ms-4">${{ number_format($neto_a_cobrar, 2, ',', '.') }}</span></p>
                            </div>
                            <p><strong>Recibi conforme la suma de pesos:</strong> {{ $netoEnLetras }} PESOS</p>
                            <p><strong>En concepto de retribución por mis servicios prestados por cooperativa.</strong></p>
                        </div>
                        <div class="firma">
                            <p>Firma: ____________________</p>
                        </div>
                    </div>
                </div>
                 <!-- Recibo 1 -->
                 <div class="w-100">
                <div class="recibo">
                    <div class="recibo-header d-flex align-items-center">
                        <!-- Logo alineado a la izquierda -->
                        <img src="./img/vdvlogocoop.jpg" alt="Logo Empresa" class="me-3">
                        
                        <!-- Texto centrado en la misma línea -->
                        <div class="info flex-grow-1 text-center">
                            <h5 class="mb-0"><strong>VDVCOOP</strong> - Cooperativa de Trabajo LTDA.</h5>
                            <p class="mb-0">Dirección: Garibaldi N° 127, Santiago del Estero</p>
                        </div>
                        
                        <!-- Mantener espacio a la derecha para asegurar que todo esté en la misma línea -->
                    </div>
                    <div class="recibo-body">
                        <div class="row mb-1">
                            <div class="col-6 text-end">
                            <p><strong>Periodo:</strong> Desde {{ \Carbon\Carbon::parse($fechaDesde)->format('d/m/Y') }} hasta {{ \Carbon\Carbon::parse($fechaHasta)->format('d/m/Y') }}</p>

                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-6">
                            <p><strong>Nombre y Apellido:</strong> {{ $nombre }} <strong class="ms-3">DNI:</strong> {{ number_format($dni, 0, '', '.') }}</p>
                                <p></p>
                                <p><strong>Domicilio laboral:</strong> {{ $domicilio }}</p>
                                <p><strong>Empresa:</strong> {{ $empresa_id }}</p>
                            </div>
                        </div>       
                        <div class="row mb-1">
                            <div class="col-12">
                                <p><strong>Retribución:</strong> <span class="ms-5">${{ number_format($retribucion, 2, ',', '.') }}</span></p>
                                <p><strong>Retenciones:</strong></p>
                                <ul>
                                    <li><strong>RET. LEY 28565/04:</strong> <span class="ms-1">${{ number_format($retencion1, 2, ',', '.') }}</span> <strong class="ms-3">(Aporte Jubilatorio)</strong></li>
                                    <li><strong>RET. LEY 28565/04:</strong> <span class="ms-1">${{ number_format($retencion2, 2, ',', '.') }}</span> <strong class="ms-3">(Impuesto Integrado)</strong></li>
                                    <li><strong>RET. LEY 28565/04:</strong> <span class="ms-1">${{ number_format($retencion3, 2, ',', '.') }}</span> <strong class="ms-3">(Obra social)</strong></li>
                                    <li><strong>Otras retenciones:</strong> <span class="ms-2">${{ number_format($retencion4, 2, ',', '.') }}</span></li>
                                </ul>
                                <p><strong>- Neto a Cobrar:</strong> <span class="ms-4">${{ number_format($neto_a_cobrar, 2, ',', '.') }}</span></p>
                            </div>
                            <p><strong>Recibi conforme la suma de pesos:</strong> {{ $netoEnLetras }} PESOS</p>
                            <p><strong>En concepto de retribución por mis servicios prestados por cooperativa.</strong></p>
                        </div>
                        <div class="firma">
                            <p>Firma: ____________________</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</body>
</html>
