<form method="POST" action="/register/reg">
    @csrf
    @include('partial.errorChecking')

    {{-- @if ($errors->has('email'))
        <span>
            <strong>{{ $errors->first('email') }}</strong>
        </span><br>
    @endif

    @if ($errors->has('password'))
        <span>
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif --}}

    <div>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    </div>
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
    </div>
    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>
    <div>
        <button type="submit">Register</button>
    </div>
</form>
