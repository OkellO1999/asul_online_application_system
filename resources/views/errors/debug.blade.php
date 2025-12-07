<!DOCTYPE html>
<html>
<head>
    <title>Debug Errors</title>
</head>
<body>
    <h1>Last Error</h1>
    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
