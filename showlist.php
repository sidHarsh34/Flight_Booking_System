<?php
require_once('dbconnection.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: userlogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Data of user </title>
    <style>
        body {
            align-items: center;
        }

        table,
        td,
        th {
            text-align: left;
            border: 1px;
            border: 1px solid grey;
            align-self: center;
            width: 400px;
        }

        button[type="submit"],
        input[type="submit"] {
            text-align: center;
            background-color: #cccccc;
            cursor: pointer;
            border-radius: 7px 7px 7px 7px;
            box-shadow: 0px 0px 2px #333333;
        }

        button[type="submit"]:hover,
        input[type="submit"]:hover {
            background-color: #2C353C;
            color: white;
            transform: scale(1.12);
            transition: ease 0.15s;
        }
    </style>
</head>

<body>
    <h2 align="center">Booking Details</h2>
    <table cellspacing="2" cellpadding="7" align="center">
        <?php
        $_SESSION['type'] = $_POST['type'];
        $_SESSION['fromloc'] = $_POST['fromlocation'];
        $_SESSION['toloc'] = $_POST['tolocation'];
        $_SESSION['reasonfortravel'] = $_POST['reasonfortravel'];
        $_SESSION['modeoftravel'] = $_POST['mode'];
        $_SESSION['depdate'] = $_POST['departuredate'];
        $_SESSION['returndate'] = $_POST['returndate'];
        $_SESSION['remarks'] = $_POST['remarks'];
        $_SESSION['vendorname'] = $_POST['vendor'];

        if ($_SESSION['fromloc'] === $_SESSION['toloc']) {
            echo "<script> alert('Both Location can not be same.')</script>";
            echo "<script> location.href='apply.php'</script>";
        }
        echo "<tr>";
        echo "<th>Username</th>";
        echo "<td>" . $_SESSION['name'] . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>From</th>";
        echo "<td>" . $_SESSION['fromloc'] . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>To</th>";
        echo "<td>" . $_SESSION['toloc'] . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>Reason of Travel</th>";
        echo "<td>" . $_SESSION['reasonfortravel'] . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>Mode of Travel</th>";
        echo "<td>" . $_SESSION['modeoftravel'] . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>Departure date</th>";
        $departuredate = date('d-m-Y', strtotime($_SESSION['depdate']));
        echo "<td>" . $departuredate . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>Return date</th>";
        echo "<td>";
        if ($_POST['type'] == "Round") {
            if ($_SESSION['returndate'] >= $_SESSION['depdate']) {
                $returndate = date('d-m-Y', strtotime($_SESSION['returndate']));
                echo $returndate;
            } else {
                echo "<script> alert('Check both dates.')</script>";
                echo "<script> location.href='apply.php'</script>";
            }
        } else {
            echo "-";
        }

        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>Vendor Name</th>";
        echo "<td>" . $_SESSION['vendorname'] . "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>Colleagues</th>";
        echo "<td>";
        if ($_POST['checkbutton'] == "yeschecked") {
            $_SESSION['tocheck'] = "yeschecked";

            if (!isset($_POST['empname'])) {
                $_SESSION['tocheck'] = "nochecked";
                echo "-";
            } else {
                $_SESSION['empall'] = $_POST["empname"];
                $value1 = implode(', ', $_SESSION['empall']);
                echo "$value1";
            }
        } else {
            $_SESSION['tocheck'] = "nochecked";
            echo "-";
        }
        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<th>Remarks</th>";
        echo "<td>" . $_SESSION['remarks'] . "</td>";
        echo "</tr>";
        ?>
    </table>
    <br>
    <br>
    <form method='POST' action="insertform.php" align="center">
        <button type="submit" name="resetbutton" value="resetbutton">Reset</button>
        <input type="submit" name="Submit" value="Submit" style="margin-left: 10px;">
    </form>
</body>

</html>