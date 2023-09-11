@extends('layouts.layout')
@section('content')
<h2>List of drivers</h2>
<table>
    <thead>
        <tr>
            <th>Code</th>
            <th>Driver Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sortedReportDataWithName as $code => $driverData)
            <tr>
                <td><a href="{{ route('report.drivers', ['driver_id' => $code]) }}">{{ $code }}</a></td>
                <td>{{ $driverData['nameRacer'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>    
@endsection