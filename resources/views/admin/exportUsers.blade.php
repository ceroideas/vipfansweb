<table>
    <thead>
    <tr>
        <th>Nombre completo</th>
        <th>Nombre de usuario</th>
        <th>Email</th>
        <th>Estatus</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td>{{ $d['name'] }}</td>
            <td>{{ $d['username'] }}</td>
            <td>{{ $d['email'] }}</td>
            <td>{{ $d['estatus'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>