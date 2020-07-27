@extends('layouts.app')

@section('content')
<div id="login-card" class="card">
    <div class="card-header"><h3>Dashboard</h3></div>
    <div class="card-body">
        <form id="dashboard-form" method="POST" action="/home">
            @csrf
            @foreach($keys as $key)
            <div class="form-group">
                <label for="{{ $key }}" class="dashboard-field-capitalize">{{ $key }}</label>
                <input class="form-control" type="text" name="{{ $key }}" value="{{ $user->{$key} }}">
            </div>
            @endforeach
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <button id="dashboard-update-button" type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection
