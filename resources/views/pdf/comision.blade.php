<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Comisiones - {{ $vendedor->nombre }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
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
            font-family: 'Merriweather', serif;
            color: #1a5f7a;
            font-size: 24px;
            margin: 0;
            padding-top: 10px;
        }
        .subtitle {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }
        table {
            width: 100%; /* Asegura que la tabla ocupe todo el ancho */
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px; /* Reduce el padding para menos espacio */
            text-align: center;
            white-space: nowrap;
            font-size: 15px; /* Puedes ajustar el tamaño de fuente si lo prefieres */
        }
        th {
            background-color: #f2f2f2; /* Color de fondo de los encabezados */
            font-weight: 600;
            color: #1a5f7a;
        }
        /* Filas de la tabla en blanco */
        tr {
            background-color: #fff; /* Establece el fondo de todas las filas como blanco */
        }
        tr:nth-child(even) {
            background-color: #fff; /* Asegura que las filas pares sean blancas también */
        }
        /* Estilo para la fila de Totales */
        .totals {
            background-color: #f2f2f2; /* Mismo color que los encabezados */
            color: #1a5f7a; /* Color de texto igual al de los encabezados */
            font-weight: bold; /* Negrita para destacar */
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
            <img src="./img/vdvlogocoop.jpg" alt="Logo" class="logo">
            <h1>Informe Comisión</h1>
            <div class="subtitle">Comisión de: {{ $vendedor->nombre }} (DNI: {{ $vendedor->dni }})</div>
        </div>
        
        @if(empty($vendedoresComisionData))
            <p>No hay datos de comisión para este vendedor.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Socios con aportes</th>
                        <th>Socios sin aportes</th>
                        <th>Total Socios</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendedoresComisionData as $data)
                        <tr>
                            <td>{{ $data['nombreEmpresa'] }}</td>
                            <td>{{ $data['sociosConAportes'] }}</td>
                            <td>{{ $data['sociosSinAportes'] }}</td>
                            <td>{{ $data['totalSocios'] }}</td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot >
                    <tr class="totals">
                        <td>Cantidad total</td>
                        <td>{{ collect($vendedoresComisionData)->sum('sociosConAportes') }}</td>
                        <td>{{ collect($vendedoresComisionData)->sum('sociosSinAportes') }}</td>
                        <td>{{ collect($vendedoresComisionData)->sum('totalSocios') }}</td>

                        
                    </tr>
                    <tr class="totals">
                        <td></td>
                        <td>${{ number_format(collect($vendedoresComisionData)->sum('sociosConAportes') * $montoConAporte, 2, ',', '.') }}</td>
                        <td>${{ number_format(collect($vendedoresComisionData)->sum('sociosSinAportes') * $montoSinAporte, 2, ',', '.') }}</td>
                        <td></td>
                    </tr>
                    <tr class="totals">
                        <td>Total:</td>
                        <td></td>
                        <td></td>
                        <td>${{ number_format((collect($vendedoresComisionData)->sum('sociosConAportes') * $montoConAporte) + (collect($vendedoresComisionData)->sum('sociosSinAportes') * $montoSinAporte), 2, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        @endif
    </div>
</body>
</html>
