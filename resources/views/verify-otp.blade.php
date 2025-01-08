<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="vh-100 container d-flex align-items-center justify-content-center ">
        <form class="bg-info-subtle rounded w-75 d-flex flex-column p-5" action="{{ route('verifyOtp') }}" method="POST">
            @csrf
            <h2 class="text-center mb-4 text-black">JUSTPAY OTP VERIFICATION</h2>
            <label for="email" class="form-label text-black">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ session('email') }}" readonly>
            <label for="otp" class="form-label mt-3 text-black">Enter OTP:</label>
            <input type="text" class="form-control" name="otp" required>
            <button class="btn btn-primary mt-4 w-25 mx-auto" type="submit">Verify OTP</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>