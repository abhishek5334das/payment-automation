<!DOCTYPE html>
<html>
<head>
    <title>Payment Automation</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Payment Page</h1>

    <!-- Payment Form -->
    <form id="payment-form">
        <input type="email" name="email" id="email" placeholder="Enter email" required>
        <input type="number" name="amount" id="amount" placeholder="Enter amount" required>
        <button type="button" id="send-otp">Send OTP</button>
    </form>

    <!-- OTP Section -->
    <div id="otp-section" style="display: none;">
        <input type="text" id="otp" placeholder="Enter OTP">
        <button type="button" id="verify-otp">Verify OTP</button>
    </div>

    <div id="message"></div>

    <script>
        $(document).ready(function () {
            // Send OTP
            $('#send-otp').click(function () {
                $.post('{{ route('otp.send') }}', {
                    email: $('#email').val(),
                    amount: $('#amount').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function (data) {
                    $('#otp-section').show();
                    $('#message').text(data.message);
                });
            });

            // Verify OTP
            $('#verify-otp').click(function () {
                $.post('{{ route('otp.verify') }}', {
                    otp: $('#otp').val(),
                    email: $('#email').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function (data) {
                    $('#message').text(data.message);
                }).fail(function (xhr) {
                    $('#message').text(xhr.responseJSON.message);
                });
            });
        });
    </script>
</body>
</html>
