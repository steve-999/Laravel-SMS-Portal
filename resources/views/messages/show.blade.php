@extends('layouts.app')

@section('content')
<table id="messages-table">
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
    @foreach($keys as $key)
        <tr><td>{{ $key }}</td><td>{{ $message->{$key} }}</td></tr>
    @endforeach
</table>
@endsection