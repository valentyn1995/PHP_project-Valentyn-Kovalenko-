@extends('layouts.layout')
@section('content')
<h2>Common statistic</h2>
<table>
    <thead>
        <tr>
            <th>Driver Name</th>
            <th>Team</th>
            <th>Lap Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reportData as $driverData)
            <tr>
                <td>{{ $driverData['nameRacer'] }}</td>
                <td>{{ $driverData['team'] }}</td>
                <td>{{ $driverData['lap_time'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection