<table>
    <thead>
    <tr>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Metodo</th>
        <th>Referencia de pago</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td>{{ $d['user'] }}</td>
            <td>{{ $d['date'] }}</td>
            <td>{{ $d['payment'] }}</td>
            <td>{{ $d['reference'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>