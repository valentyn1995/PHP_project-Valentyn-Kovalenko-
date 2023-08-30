<h2>Driver Info</h2>
@if ($driverInfo)
    <p>Driver name: {{ $driverInfo['nameRacer'] }}</p>
    <p>Driver team: {{$driverInfo['team']}}</p>
    <p>Driver time: {{$driverInfo['lap_time']}}</p>
    {{-- Відображення іншої інформації про водія --}}
@else
    <p>No information available for this driver.</p>
@endif

