@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>
    <form method="POST" action="/home">
        @csrf
        <table>
            @foreach($keys as $key)
                <tr>
                    <td>{{ $key }}</td>
                    <td><input type="text" name="{{ $key }}" value="{{ $user->{$key} }}"></td>
                </tr>
            @endforeach
        </table> 
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
