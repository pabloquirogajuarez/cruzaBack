<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Cobro Empresas - Septiembre 2024</title>
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
            padding: auto; /* Ajusta el padding para reducir espacio */
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
    background-color: #f2f2f2;
    font-weight: 600;
    color: #1a5f7a;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
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
            <h1>Listado de Cobro Empresas</h1>
            <div class="subtitle">{{ ucfirst(\Carbon\Carbon::now()->locale('es')->translatedFormat('F Y')) }}</div>
        </div>
        
        <div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Fecha de Cobro</th>
                        <th>Prórroga del Cobro</th>
                        <th>N° Socios</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empresa as $index => $empresa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $empresa->nombreEmpresa }}</td>
                        <td>{{ $empresa->fechaCobro }}</td> <!-- Fecha de cobro -->
                        <td>{{ $empresa->fechaProrroga }}</td> <!-- Prórroga -->
                        <td>{{ $empresa->socios_count }}</td>
                        <td>{{ number_format($empresa->montoTotal, 2, ',', '.') }} $</td>
                        <td>{{ $empresa->estadoEmpresa }}</td>
                        <td>{{ $empresa->observaciones }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            Documento generado el {{ date('d/m/Y') }} - VDV COOP
        </div>
    </div>
</body>
</html>
