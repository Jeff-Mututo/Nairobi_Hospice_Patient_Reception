<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nairobi Hospice | Welcome</title>

    <!-- Scripts -->
    @vite('resources/css/welcome.css')
</head>
<body>
    @if (Route::has('login'))
        <div class="navigationBar">
            @auth
                <a class="navigationItem" href="{{ url('/checkUserType') }}">Dashboard</a>
            @else
                <a class="navigationItem" href="{{ route('login') }}">Log in</a>

                <!--@if (Route::has('register'))
                    <a class="navigationItem" href="{{ route('register') }}">Register</a>
                @endif-->
            @endauth
        </div>
    @endif

    <div class="mainContent">
        <div class="textContent">
            <h1 class="welcomeHeading">Nairobi Hospice Patient Management</h1>
            <hr class="horiLine">
            <p class="welcomeText">
                Providing Palliative Care Services to patients facing life limiting illnesses.<br>
                This system allows staff to manage patients including: search, symptom/diagnosis management and more.
            </p>
        </div>

        <div class="imageContent">
            <img src="{{ asset('images/welcomeImage.svg') }}" alt="Patient Management Illustration">
        </div>
    </div>
    
</body>
</html>