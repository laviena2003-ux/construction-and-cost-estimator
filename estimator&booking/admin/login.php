<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Login</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #fff9f0; /* soft white */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: rgb(161, 138, 54); /* mustard yellow */
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            width: 350px;
            text-align: center;
        }

        h1 {
            color: #fff;
            margin-bottom: 25px;
            font-size: 2rem;
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px 0;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            margin-top: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #fff;
            color: #b27c00;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #ffe08a;
        }

        p {
            margin-top: 15px;
            font-weight: bold;
        }

        /* Back Button */
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #fff;
            color: #b27c00;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: #ffe08a;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="adminUN" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="adminPW" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnAdminLogin" value="Login"></td>
                </tr>
            </table>
        </form>

        <a href="../index.php" class="btn-back">⬅ Back</a>

        <?php
        if (isset($_POST['btnAdminLogin'])) {
            // Hardcoded username/password
            $adminUsername = "admin";
            $adminPassword = "admin123";

            if ($_POST['adminUN'] === $adminUsername && $_POST['adminPW'] === $adminPassword) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $adminUsername;
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<p style='color:red;'>Incorrect username or password.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
