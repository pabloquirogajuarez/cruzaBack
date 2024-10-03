<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>DNI</th>
            <th>Domicilio</th>
            <th>Provincia</th>
            <th>Localidad</th>
            <th>Fecha de Nacimiento</th>
            <th>Teléfono 1</th>
            <th>Teléfono 2</th>
            <th>Función</th>
            <th>Estado</th>
            <th>A Cargo De</th>
            <th>Aportes</th>
            <th>Clave Fiscal</th>
            <th>Fecha Baja AFIP</th>
            <th>Documentación</th>
            <th>Fecha Alta</th>
            <th>Fecha Baja</th>
            <th>Motivo</th>
            <th>Lugar Prestamos Servicio</th>
            <th>Observaciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($socios as $socio)
        <tr>
            <td>{{ $socio->nombre }}</td>
            <td>{{ $socio->email }}</td>
            <td>{{ $socio->dni }}</td>
            <td>{{ $socio->domicilio }}</td>
            <td>{{ $socio->provincia }}</td>
            <td>{{ $socio->localidad }}</td>
            <td>{{ $socio->fechanacimiento }}</td>
            <td>{{ $socio->telefono1 }}</td>
            <td>{{ $socio->telefono2 }}</td>
            <td>{{ $socio->funcion }}</td>
            <td>{{ $socio->estado }}</td>
            <td>{{ $socio->a_cargo_de }}</td>
            <td>{{ $socio->aportes }}</td>
            <td>{{ $socio->clave_fiscal }}</td>
            <td>{{ $socio->fecha_baja_afip }}</td>
            <td>{{ $socio->documentacion }}</td>
            <td>{{ $socio->fecha_alta }}</td>
            <td>{{ $socio->fecha_baja }}</td>
            <td>{{ $socio->motivo }}</td>
            <td>{{ $socio->lugar_prestamos_servicio }}</td>
            <td>{{ $socio->observaciones }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
