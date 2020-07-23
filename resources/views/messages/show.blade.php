@extends('layouts.app')

@section('content')
<table>
    @foreach($keys as $key)
        <tr><td>{{ $key }}</td><td>{{ $message->{$key} }}</td></tr>
    @endforeach
</table>
@endsection