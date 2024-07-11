<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url("Background.jpg");
            background-size: 1530px 750px;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: white;
        }

        p {
            color: white;
            position: relative;
            right: 95px;
            font-size: 60;
        }

        i {
            background-color: #5a666f;
            padding-left: 10px;
            border: white;
            border-style: none;
            border-radius: 7px;
        }

        .container {
            text-align: center;
            background-color: #2C353C;
            border-radius: 7px 7px 7px 7px;
            border-width: 25px;
            margin: auto;
            margin-top: 8%;
            max-width: 25%;
            padding: 30px;
            box-shadow: 0px 0px 13px #888;
            opacity: 0.8;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            position: relative;
        }

        input[type="submit"] {
            background-color: #808080;
            color: white;
            border-radius: 5px;
            height: 35px;
            width: 35%;
            cursor: pointer;

        }

        input[type="submit"]:hover {
            background-color: #2C353C;
            transform: scale(1.13);
            transition: ease 0.3s;
        }

        input[type="text"] {
            border-style: none;
            border-top-right-radius: 7px;
            border-bottom-right-radius: 7px;
            height: 35px;
            width: 250px;
            padding-left: 5px;
            margin-left: 6px;
        }

        input[type="password"] {
            border-style: none;
            border-top-right-radius: 7px;
            border-bottom-right-radius: 7px;
            height: 35px;
            width: 250px;
            padding-left: 5px;
            margin-left: 6px;
        }

        .image-container img {
            max-width: 120px;
            max-height: 80px;
            position: absolute;
            top: 17%;
            left: 50%;
            text-align: center;
            transform: translate(-50%, -50%);
            z-index: 1;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <div class="image-container">
        <img src="SEW-Logo.png" alt="Sew Eurodrive">
    </div>
    <div class="container">
        <form method="post">
            <h1>Booking</h1>
            <p><b>Login:</b></p>
            <i class="fas fa-user">
                <input type="text" name="username" placeholder="Username"></i><br><br>
            <i class="fas fa-lock">
                <input type="password" name="password" placeholder="Password"></i><br><br>
            <input type="submit" value="Login" name="login">
        </form>
    </div>
</body>

<?php
session_start();
require_once "dbconnection.php";
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pwd = $_POST['password'];

    if ($user == "" || $pwd == "") {
        echo "<script> alert('Fields must be filled')</script>";
        echo "<script>location.href='userlogin.php'</script>";
    } else {
        $sql = "SELECT * FROM b_usermaster WHERE userid = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "' ";
        $result = mysqli_query($con, $sql);
        $check = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) > 0) {
            // echo "<script>alert('You have logged in successfully')</script>";

            $_SESSION['username'] = $user; // Set the session variable
            $_SESSION['name'] = $check['emp_name'];
            $_SESSION['department'] = $check['dept'];
            $_SESSION['worklevel'] = $check['work_level'];
            $_SESSION['supportregion'] = $check['supportregion'];
            $_SESSION['directreportingto'] = $check['directreportingto'];
            $_SESSION['empemail'] = $check['emp_email'];

            if ($check['status'] == 'InActive') {
                echo '<script>alert("You\'re not an Active Employee of the Company.");</script>';
                exit();
            }

            if ($check['work_level'] > 4 || $check['work_level'] == NULL) {
                echo '<script>alert("You don\'t have access to this site");</script>';
                exit();
            }
            header("Location: userhome.php"); // Redirect to the userhome.php or any other appropriate page
            exit();
        } else {
            echo "<script> alert('Username and Password combination is incorrect.')</script>";
        }
    }
}

mysqli_close($con);
?>