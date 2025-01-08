<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-grey">

    <div class="vh-100 container d-flex align-items-center justify-content-center ">

        <form class="bg-success-subtle rounded w-75 d-flex flex-column p-5" action="{{ route('generateOtp') }}" method="POST">
            @csrf
            <h2 class="text-center mb-4 text-black">JUSTPAY PAYMENT INTEGRATION</h2>
            <label class="form-label text-black" for="email">Email:</label>
            <input class="form-control" type="email" name="email" required>
            <label class="form-label mt-3 text-black" for="amount">Amount:</label>
            <input class="form-control" type="number" name="amount" required>
            <button class="btn btn-primary mt-4 w-25 mx-auto" type="submit">Pay</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>