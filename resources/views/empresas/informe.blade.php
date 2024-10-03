

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Clientes</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f4f8;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 20px;
        }
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 20px;
        }
        .report-header img {
            width: 150px;
            height: auto;
        }
        .report-title {
            text-align: right;
        }
        .report-title h1 {
            color: #2c3e50;
            margin: 0;
            font-size: 28px;
        }
        .report-date {
            color: #7f8c8d;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #34495e;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f0f0f0;
            transition: background-color 0.3s ease;
        }
        .right-align {
            text-align: right;
        }
        .empty-table {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
            font-style: italic;
        }
        @media (max-width: 600px) {
            .report-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .report-title {
                text-align: left;
                margin-top: 15px;
            }
            th, td {
                padding: 8px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="report-header">
            <img src="./images/logo.jpg"/>
            <div class="report-title">
                <h1>Informe de Clientes</h1>
                <div class="report-date">{{ date('d/m/Y') }}</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                <th>Nombre</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Función</th>
                    <th class="right-align">Costo</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sociosActivos as $socio)
                    <tr>
                    <td>{{ $socio->nombre }}</td>
                    <td>{{ $socio->dni }}</td>
                    <td>{{ $socio->email }}</td>
                    <td>{{ $socio->funcion }}</td>
                    <td class="right-align">{{ $costoPorSocio }}</td>
               
                @empty
                <tr>
                    <td colspan="4" class="empty-table">No hay socios activos</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <h3>Total</h3>
        <p>Total: {{ $total }}</p>
        <p>Total + IVA (21%): {{ $totalConIVA }}</p>
    </div>
</body>
</html>
