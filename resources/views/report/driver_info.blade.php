@extends('admin.admin_layout')
@section('content')
<h2>Driver Info</h2>
@if ($driverInfo)
    <p>Driver name: {{$driverInfo['name'] }}</p>
    <p>Driver team: {{$driverInfo['team']}}</p>
    <p>Driver time: {{$driverInfo['lap_time']}}</p>
@else
    <p>No information available for this driver.</p>
@endif

@endsection