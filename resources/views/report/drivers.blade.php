@extends('admin.admin_layout')
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
                <td><a href="{{ route('report.drivers', ['driver_id' => $driverData['drivers_code']]) }}">{{ $driverData['drivers_code'] }}</a></td>
                <td>{{ $driverData['name'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>    
@endsection