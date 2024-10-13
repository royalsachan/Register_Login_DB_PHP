!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../230101021_lab_12_styles.css">
</head>
<body>
    <h2>Register</h2>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    <form action="?page=register" method="post">
        <input type="text" name="username" required placeholder="Username">
        <input type="text" name="name" required placeholder="Full Name">
        <input type="password" name="password" required placeholder="Password">
        <input type="email" name="email" required placeholder="Email">
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="?page=login">Login</a></p>
</body>
</html>
