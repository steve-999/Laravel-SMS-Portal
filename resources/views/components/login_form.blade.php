
<div class="container">
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
                <h3>{{ $heading }}</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/dashboard">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="email">
                    </div>                                
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" name="password" value="{{ old('password') }}" placeholder="password">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

