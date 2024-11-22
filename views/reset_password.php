<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset_password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Reset Password</title>
</head>

<body>
    <div class="email-card">
        <h1>RESET PASSWORD</h1>
        <p>Please enter and confirm your new password below</p>

        <!-- Password Reset Form -->
        <form action="../actions/forgot_password.php" method="POST" class="email-form">
            <div class="email-card-inputs">
                <input type="password" placeholder="New Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="confirm_password" required>
            </div>

            <!-- Hidden Input Fields -->
            <input type="hidden" name="message" value="New Password">
            <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">

            <button type="submit">CONFIRM</button>
        </form>
    </div>

    <script src="../javascript/verify_otp.js" defer></script>
</body>

</html>
