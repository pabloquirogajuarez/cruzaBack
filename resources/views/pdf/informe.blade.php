<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Empresa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background-color: #fff;
        }
        .container {
            max-width: 800mm; /* Ancho máximo de A4 */
            margin: 0 auto;
        }
        .header {
            border-bottom: 2px solid #1a5f7a;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .logo {
            max-width: 80px;
            float: left;
            margin-right: 20px;
        }
        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin: 0;
            padding-top: 10px;
        }
        h4 {
            color: #2c3e50;
            font-size: 18px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: center;
            white-space: nowrap;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .info p, .summary p {
            margin: 5px 0;
        }
        .summary strong {
            color: #2c3e50;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="./img/vdvlogocoop.jpg" alt="VDV COOP Logo" class="logo">
            <h1>Informe de Empresa</h1>
            <div class="subtitle">{{ ucfirst(\Carbon\Carbon::now()->locale('es')->translatedFormat('F Y')) }}</div>
        </div>

        <div class="info">
            <p><strong>Empresa:</strong> {{ $empresa->nombreEmpresa }}</p>
            
        </div>

        <h4>Socios Activos</h4>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Fecha de Alta</th>
                    <th>Aportes</th>
                    <th>Estado</th>
                    <th>Costo</th> <!-- Costo será igual a montoSocio -->
                </tr>
            </thead>
            <tbody>
                @foreach($sociosActivos as $socio)
                <tr>
                    <td>{{ $socio->nombre }}</td>
                    <td>{{ $socio->dni }}</td>
                    <td>{{ $socio->fecha_alta }}</td>
                    <td>{{ $socio->aportes }}</td>
                    <td>{{ $socio->estado }}</td>
                    <td>${{ number_format($socio->montoSocio, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <h4>Resumen de Costos</h4>
            <p><strong>Total:</strong> ${{ number_format($total, 2) }}</p>
            <p><strong>Total + IVA (21%):</strong> ${{ number_format($totalConIVA, 2) }}</p>
        </div>

    </div>
</body>
</html>


