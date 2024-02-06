@if (count($errors) > 0)
    <div style="background-color:lightcoral">
        <ul style="list-style: none">
            @foreach ($errors->all() as $error)
                <li style="color: rgb(134, 0, 0);">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif (session('success'))
    <div style="background-color: lightgreen;">
        <p style="color: green;">{{ session('success') }}</p>
    </div>
@endif
