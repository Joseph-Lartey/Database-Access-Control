<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/verify_otp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>OTP Verification</title>
</head>

<body>
    <div class="otp-card">
        <h1>OTP VERIFICATION</h1>
        <p>A code has been sent to your email address</p>

        <!-- OTP Form -->
        <form action="../actions/verify_otp.php" method="POST" class="otp-form">
            <div class="otp-card-inputs">
                <?php for ($i = 0; $i < 6; $i++): ?>
                    <input type="text" name="OTP[]" maxlength="1" oninput="moveToNext(this)" <?php echo $i === 0 ? 'autofocus' : ''; ?>>
                <?php endfor; ?>
            </div>

            <!-- Hidden Inputs -->
            <input type="hidden" name="message" value="<?php echo isset($_GET['msg']) ? $_GET['msg'] : ''; ?>">

            <p>Didn't get the OTP?
                <a href="../actions/forgot_password.php?<?php echo isset($_SESSION['email']) ? 'email=' . urlencode($_SESSION['email']) : ''; ?>
                    &message1=<?php echo isset($_GET['msg']) ? urlencode($_GET['msg']) : ''; ?>
                    &message2=resend_otp" id="resend">
                    Resend
                </a>
            </p>

            <button type="submit">VERIFY</button>
        </form>
    </div>

    <script src="../javascript/verify_otp.js" defer></script>
</body>

</html>