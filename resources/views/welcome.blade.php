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
            <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>
            <div class="card-body">
                <form id="message-form" method="POST" action="/send" target="dummyframe" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label>Phone Number</label>
                <!-- <input id="phone-number" type="tel" class="form-control" name="phone_number" value="{{ old('phone_number') }}"
                            placeholder="Enter mobile phone number">  -->
                        <input id="phone-number" type="tel" class="form-control" name="phone_number" value="07771899430"
                            placeholder="Enter mobile phone number">
                        <div id="phone-number-error-message">&nbsp;</div>
                    </div>                                
                    <div class="form-group">
                        <label>Message</label>
                        <textarea id="message-body" name="message" class="form-control" rows="3" value="" 
                            placeholder="Enter message"></textarea>
                    </div>
                    <button id="send-button" type="submit" class="btn btn-success" disabled>Send</button>
                    <span id="num-chars">140</span>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript" src="{{ URL::asset('/js/msg_validation.js') }}"></script>

@endsection