@php($no = $page + 1)
@foreach ($data as $d)
    <tr>
        <td>{{ $no }}</td>
        <td>{{ $d['username'] }}</td>
        <td>{{ $d['detail'] }}</td>
        <td>{{ $d['total'] }}</td>
        <td>Aktif</td>
    </tr>
    @php($no++)
@endforeach