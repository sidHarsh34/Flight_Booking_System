<?php
session_start(); //session starting
require_once "dbconnection.php";
if (!isset($_SESSION['username'])) {
    header("Location: adminlogin.php");
    exit();
}
if (isset($_GET['logout']) && $_GET['logout'] == true) {
    session_unset();
    session_destroy();
    header("Location: adminlogin.php");
    exit();
}
?>
<!-- HTML code -->
<!DOCTYPE html>
<html>

<head>
    <title>Homepage</title>
    <style>
        .brandlogo {
            width: 10%;
            height: 7%;
            padding: 0.2%;
            margin-left: 2%;
            vertical-align: middle;
            position: relative;
        }

        .headercontainer {
            background-color: #2c353c;
            width: 100%;
            height: 70%;
            display: flex;
            align-items: center;
        }

        .websitename {
            margin-left: 76%;
            float: right;
            color: rgb(255, 255, 255);
        }

        .username {
            display: flex;
            justify-content: flex-end;
            color: black;
            white-space: nowrap;
            margin-top: -1.48%;
            margin-right: 1%;
        }

        ul {
            list-style-type: none;
            margin: 0;
            overflow: hidden;
            background-color: white;
        }

        li {
            float: left;
            border-right: 1px solid gray;
            border-radius: 4px;
        }

        li:first-child {
            border-left: 1px solid gray;
            border-radius: 4px;
        }

        li.active a:hover {
            background-color: rgb(190, 235, 245);
        }

        li a {
            display: block;
            text-align: center;
            padding: 14px 36px;
            text-decoration: none;
            color: black;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;

        }

        li a:hover {
            background-color: rgb(163, 158, 158);
            border-radius: 4px;
        }

        .active {
            background-color: rgb(190, 235, 245);
            border-radius: 4px;
            /* border-top-left-radius: 10px;
            border-bottom-right-radius: 10px; */
        }

        hr {
            margin-top: -0.0001%;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="headercontainer">
        <img src="SEW-Logo.png" alt="Sew Eurodrives" class="brandlogo">
        <div class="websitename">
            <h1>Booking</h1>
        </div>
    </div>
    <!-- Menubar -->
    <div>
        <ul>
            <?php
            $currentPage = basename($_SERVER['PHP_SELF']);

            if ($currentPage === 'adminhome.php') {
                echo '<li class="active"><a href="adminhome.php">Home</a></li>';
            } else {
                echo '<li><a href="adminhome.php">Home</a></li>';
            }

            if ($currentPage === 'adminregister.php' || $currentPage === 'addemployee.php' || $currentPage === 'document.php') {
                echo '<li class="active"><a href="adminregister.php">Register</a></li>';
            } else {
                echo '<li><a href="adminregister.php">Register</a></li>';
            }
            ?>
            <li><a href="adminhome.php?logout=true">Logout</a></li>
        </ul>
        <div class="username">
            Hello, <?php echo $_SESSION['name']; ?>
        </div>
    </div>
    <hr />
</body>

</html>