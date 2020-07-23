@extends('layouts.app')

@section('content')

    @component('components.login_form')
        @slot('heading')
            Signup
        @endslot    
    @endcomponent

@endsection