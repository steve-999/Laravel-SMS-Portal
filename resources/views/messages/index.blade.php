@extends('layouts.app')

@section('content')
    <h2 style="text-align: center; margin-bottom: 30px;">Messages</h2>
    @if(count($messages))
        <div class="container" id="messages-container">
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
                            <td>{{ $msg[$key] }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>  
    @else
        <p>No messages have been sent.</p>
    @endif
@endsection


