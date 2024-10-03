<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo VDVCOOP</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        @page {
            size: A4 landscape; /* Cambia la orientación a horizontal */
            margin: 1mm;
        }
        body {
            width: 280mm; /* Ajustado para A4 horizontal */
            height: 210mm; 
            background-color: white;
            display: flex;
        }
        .contpri {
            display: flex; /* Usamos flex para alinear los recibos */
            width: 100%; /* Ocupa todo el ancho del contenedor */
        }
        .recibo-container1, .recibo-container2 {
            width: 45%; /* Mantener el mismo ancho */
            border: 1px solid #aaa;
            padding: 3mm; /* Mantener el padding bajo */
            font-size: 10pt; /* Aumentar el tamaño de la fuente */
            margin: 10px; /* Elimina el margen para que estén pegados */
        }
        .card-header {
            text-align: center;
            margin-bottom: 3mm; /* Mantener una separación moderada */
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .info-box, .highlight {
            border: 1px solid #aaa;
            padding: 2mm; /* Padding reducido para mantener la cercanía */
            margin-bottom: 2mm; /* Mantener una separación moderada entre secciones */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2mm; /* Separación inferior de la tabla */
        }
        th, td {
            border: 1px solid #aaa;
            padding: 1mm; /* Mantener un padding moderado */
            text-align: left;
        }
        .total-section {
            text-align: right;
            border-top: 1px solid #aaa;
            padding-top: 3mm; /* Mantener un espacio moderado */
        }
        .float-right {
            float: right; /* Alinea el segundo recibo a la derecha */
        }
        .float-left {
            float: left; /* Alinea el segundo recibo a la izquierda */
        }
    </style>
</head>
<body>
    <div class="contpri">
        <!-- Primer Recibo -->
        <div class="recibo-container1 float-left">
            <div class="card-header">
                <img src="./img/vdvReciboHeaderv3.jpg" alt="Descripción de la imagen">
                <p>N° de Recibo: {{ $codigoRecibo }}</p>
            </div>
            <div class="info-box">
                <p><strong>Datos del Cliente:</strong></p>
                <p>Cliente: {{ $empresa->nombreEmpresa }}</p>
                <p>CUIT: {{ $empresa->cuitEmpresa }}</p>
                <p>Domicilio: {{ $empresa->direccionEmpresa }}</p>
            </div>
            <div class="highlight">
                <p><strong>Monto Recibido</strong></p>
                <p>{{ $montoEnLetras }}</p>
            </div>
            <div class="highlight">
                <p><strong>Concepto</strong></p>
                <p>{{ $concepto }}</p>
            </div>
            <div>
                <p><strong>Detalles del Pago</strong></p>
                <table>
                    <tr>
                        <th>Efectivo</th>
                        <th>CHEQUE N°</th>
                        <th>BANCO</th>
                        <th>IMPORTE</th>
                    </tr>
                    <tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                </table>
            </div>
            <div class="total-section">
                <p><strong>TOTAL</strong></p>
                <p>${{ number_format($total, 2, ',', '.') }}</p>
            </div>
        </div>
        
        <!-- Segundo Recibo (Duplicado) -->
        <div class="recibo-container2 float-right">
            <div class="card-header">
                <img src="./img/vdvReciboHeaderv3.jpg" alt="Descripción de la imagen">
                <p>N° de Recibo: {{ $codigoRecibo }} (Duplicado)</p>
            </div>
            <div class="info-box">
                <p><strong>Datos del Cliente:</strong></p>
                <p>Cliente: {{ $empresa->nombreEmpresa }}</p>
                <p>CUIT: {{ $empresa->cuitEmpresa }}</p>
                <p>Domicilio: {{ $empresa->direccionEmpresa }}</p>
            </div>
            <div class="highlight">
                <p><strong>Monto Recibido</strong></p>
                <p>{{ $montoEnLetras }}</p>
            </div>
            <div class="highlight">
                <p><strong>Concepto</strong></p>
                <p>{{ $concepto }}</p>
            </div>
            <div>
                <p><strong>Detalles del Pago</strong></p>
                <table>
                    <tr>
                        <th>Efectivo</th>
                        <th>CHEQUE N°</th>
                        <th>BANCO</th>
                        <th>IMPORTE</th>
                    </tr>
                    <tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                </table>
            </div>
            <div class="total-section">
                <p><strong>TOTAL</strong></p>
                <p>${{ number_format($total, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
