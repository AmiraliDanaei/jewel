<!-- resources/views/emails/login-code.blade.php -->

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>کد ورود شما</title>
</head>
<body style="direction: rtl; font-family: Tahoma, Arial, sans-serif; text-align: right;">
    <h2>سلام!</h2>

    <p>کد ورود شما به سایت:</p>

    <p style="font-size: 24px; font-weight: bold; letter-spacing: 4px;">
        {{ $code }}
    </p>

    <p>این کد تا ۱۰ دقیقه معتبر است.</p>

    <p>اگر شما این درخواست را ارسال نکرده‌اید، این ایمیل را نادیده بگیرید.</p>

    <hr>
    <p style="font-size: 12px; color: #777;">
        ارسال شده از طرف {{ config('mail.from.name') }}
    </p>
</body>
</html>
