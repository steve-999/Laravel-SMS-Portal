@extends('layouts.app')

@section('content')
    <h1>Messages</h1>
    @if(count($messages))
        <div id="messages-container">
            <table id="messages-table">
                <tr>
                    <th>&nbsp;</th>
                    @foreach($keys as $key)
                        <th>{{ $key }}</th>
                    @endforeach
                    <th>&nbsp;</th>
                </tr>
                @foreach($messages as $msg) 
                    <tr>
                        <td>{{ $loop->index }}</td>
                        @foreach($keys as $key) 
                            <td>{{ $msg->{$key} }}</td>
                        @endforeach
                        <td><a href="/messages/{{ $msg->msg_id }}">view</a></td>
                    </tr>
                @endforeach
            </table>
        </div>  
    @else
        <p>No messages have been sent.</p>
    @endif
@endsection


