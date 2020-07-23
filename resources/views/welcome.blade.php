@extends('layouts.app')


@section('content')

<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="card message-form-card">
            <div class="card-header">
                <h3>Send SMS message</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/send" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input id="phone-number" type="tel" class="form-control" name="phone_number" value="{{ old('phone_number') }}" 
                            placeholder="Enter phone number">
                        <div id="phone-number-error-message">&nbsp;</div>
                    </div>                                
                    <div class="form-group">
                        <label>Message</label>
                        <textarea id="message-body" name="message" class="form-control" rows="3" value="{{ old('message') }}" 
                            placeholder="Enter message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Send</button>
                    <span id="num-chars">140</span>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>    
<script type="text/javascript" src="{{ URL::asset('/js/msg_validation.js') }}"></script>

@endsection