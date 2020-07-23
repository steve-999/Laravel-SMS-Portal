@extends('layouts.app')

@section('content')
    <h2>Messages</h2>
    @if(count($messages))
        <div id="messages-container">
            <table border="1">
                <tr>
                    <th>&nbsp;</th>
                    @foreach($keys as $key)
                        <th>{{ $key }}</th>
                    @endforeach
                </tr>
                @foreach($messages as $msg) 
                    <tr>
                        <td>{{ $loop->index }}</td>
                        @foreach($keys as $key) 
                            @if($key == 'msg_id')
                                <td><a href="/messages/{{ $msg->{$key} }}">{{ $msg->{$key} }}</a></td>
                            @else
                                <td>{{ $msg->{$key} }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>  
    @else
        <p>No messages have been sent.</p>
    @endif
@endsection


