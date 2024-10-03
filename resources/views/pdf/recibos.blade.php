<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo VDVCOOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            font-family: Arial, sans-serif;
        }
        body {
            padding: 10px;
            margin: 0;
            background-color: #fff; /* Fondo blanco para ahorrar tinta */
        }
        .recibo-container {
            background-color: #fff;
            padding: 15px;
            border: 2px solid #aaa; /* Borde gris claro */
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: none; /* Sin sombra para ahorrar tinta */
            width: 100%;
            page-break-after: always;
        }
        .recibo-wrapper {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .card-header, .card-body {
            padding: 10px;
        }
        .text-muted {
            color: #555 !important; /* Gris más suave */
        }
        .text-primary {
            color: #007bff !important; /* Mantener azul para elementos importantes */
        }
        .total-section {
            border-top: 2px solid #007bff;
            padding-top: 10px;
        }
        .divider {
            margin-top: 10px;
            border-bottom: 1px dashed #aaa; /* Borde gris claro */
            padding-bottom: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 0.8rem;
            color: #555; /* Gris más suave */
        }
        .info-box {
            background-color: #f9f9f9; /* Fondo gris muy claro */
            border: 2px solid #aaa; /* Borde gris claro */
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .info-box h6 {
            margin-bottom: 5px;
        }
        .table-bordered th, .table-bordered td {
            border: 2px solid #aaa; /* Borde gris claro */
        }
        .table-bordered th {
            background-color: #e9ecef; /* Fondo gris muy claro */
            color: #333; /* Texto gris oscuro */
        }
        .highlight {
            background-color: #f0f8ff; /* Fondo muy claro para ahorrar tinta */
            border-left: 4px solid #007bff; /* Borde azul para resaltar */
            padding: 10px;
            margin-bottom: 10px;
        }
        .highlight h6 {
            margin: 0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="recibo-wrapper">
        <!-- Primer Recibo -->
        <div class="recibo-container">
            <div class="card-header text-center">
                <img src="./img/vdvReciboHeaderv3.jpg" alt="Descripción de la imagen" class="img-fluid" style="max-width: 85%;">
                <p class="h6 mt-2">N° de Recibo: {{ $codigoRecibo }}</p>
            </div>
            <div class="card-body">
                <div class="info-box">
                    <h6 class="text-muted">Datos del Cliente:</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="h5">Cliente: {{ $empresa->nombreEmpresa }}</p>
                            <p class="h5">CUIT: {{ $empresa->cuitEmpresa }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="h5">Domicilio: {{ $empresa->direccionEmpresa }}</p>
                            <p class="h5">Fecha: {{ \Carbon\Carbon::now()->setTimezone('America/Argentina/Buenos_Aires')->format('d/m/Y - H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="highlight">
                    <h6 class="text-primary">Monto Recibido</h6>
                    <p class="h4 text-uppercase">{{ $montoEnLetras }}</p>
                </div>

                <div class="highlight">
                    <h6 class="text-muted">Concepto</h6>
                    <p class="h5">{{ $concepto }}</p>
                </div>

                <div class="mb-2">
                    <h6 class="text-muted mb-2">Detalles del Pago</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>CHEQUE N°</th>
                                <th>BANCO</th>
                                <th>IMPORTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-end total-section">
                    <h6 class="text-muted mb-1">TOTAL</h6>
                    <p class="h4">${{ number_format($total, 2, ',', '.') }}</p>
                </div>
            </div>
            <div class="divider"></div>
            <div class="footer">
                Documento generado el {{ \Carbon\Carbon::now()->setTimezone('America/Argentina/Buenos_Aires')->format('d/m/Y - H:i') }} - VDV COOP
            </div>
        </div>

        <!-- Segundo Recibo -->
        <div class="recibo-container">
            
            <div class="card-header text-center">
                <p>Duplicado</p>
                <img src="./img/vdvReciboHeaderv3.jpg" alt="Descripción de la imagen" class="img-fluid" style="max-width: 85%;">
                <p class="h6 mt-2">N° de Recibo: {{ $codigoRecibo }}</p>
            </div>
            <div class="card-body">
                <div class="info-box">
                    <h6 class="text-muted">Datos del Cliente:</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="h5">Cliente: {{ $empresa->nombreEmpresa }}</p>
                            <p class="h5">CUIT: {{ $empresa->cuitEmpresa }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="h5">Domicilio: {{ $empresa->direccionEmpresa }}</p>
                            <p class="h5">Fecha: {{ \Carbon\Carbon::now()->setTimezone('America/Argentina/Buenos_Aires')->format('d/m/Y - H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="highlight">
                    <h6 class="text-primary">Monto Recibido</h6>
                    <p class="h4 text-uppercase">{{ $montoEnLetras }}</p>
                </div>

                <div class="highlight">
                    <h6 class="text-muted">Concepto</h6>
                    <p class="h5">{{ $concepto }}</p>
                </div>

                <div class="mb-2">
                    <h6 class="text-muted mb-2">Detalles del Pago</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>CHEQUE N°</th>
                                <th>BANCO</th>
                                <th>IMPORTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-end total-section">
                    <h6 class="text-muted mb-1">TOTAL</h6>
                    <p class="h4">${{ number_format($total, 2, ',', '.') }}</p>
                </div>
            </div>
            <div class="divider"></div>
            <div class="footer">
                Documento generado el {{ \Carbon\Carbon::now()->setTimezone('America/Argentina/Buenos_Aires')->format('d/m/Y - H:i') }} - VDV COOP
            </div>
        </div>
    </div>
</body>
</html>
