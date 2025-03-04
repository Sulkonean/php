<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace with secure authentication method (e.g., database check)
    if ($username === 'admin' && $password === 'password123') {
        $_SESSION['logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid login credentials';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        .login-container {
            display: flex;
            width: 800px;
            height: 500px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .illustration {
            flex: 1;
            background-color: #2e6ccf;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .illustration img {
            width: 70%;
        }
        .login-form {
            flex: 1;
            padding: 40px;
            background-color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #2e6ccf;
        }
        img.logo {
            width: 50px;
            margin-bottom: 20px;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }
        button {
            padding: 10px;
            background-color: #2e6ccf;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }
        button:hover {
            background-color: #245bb5;
        }
        a {
            text-decoration: none;
            color: #2e6ccf;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="illustration">
            <img src="img/image.png" alt="Illustration">
        </div>
        <div class="login-form">
            <h2>Login to Admin</h2>
            <img src="img/logo.jpg" alt="Logo" class="logo">
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit">Login</button>
                <a href="#">Forgot password?</a>
            </form>
            <?php if (isset($error)) echo '<p style="color:red;">' . $error . '</p>'; ?>
        </div>
    </div>
</body>
</html>