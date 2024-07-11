<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once('dbconnection.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: userlogin.php");
    exit();
}
?>
<?php

$vendor1 = $_SESSION['vendorname'];

$sql3 = "SELECT vendoremail FROM `b_vendormaster` WHERE vendorname = '$vendor1'";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$_SESSION['vendorEmail'] = $row3['vendoremail'];

if (isset($_POST["resetbutton"])) {
    // echo "<script> alert('Press Submit button')</script>";
    echo "<script> location.href='apply.php'</script>";
}
$maxqry = "SELECT count(tripid) as maxmeId FROM `b_tripregister` group by substring(tripid,1,7)";
$result4 = mysqli_query($con, $maxqry);
$row4 = mysqli_fetch_assoc($result4);
$meId = $row4['maxmeId'];

$strmeId = $meId + 1;
if ($strmeId < 10) {
    $meId = "0000" . ($meId + 1);
} elseif ($strmeId < 100) {
    $meId = "000" . ($meId + 1);
} elseif ($strmeId < 1000) {
    $meId = "00" . ($meId + 1);
} elseif ($strmeId < 10000) {
    $meId = "0" . ($meId + 1);
}
$moderetrive = $_SESSION['modeoftravel'];
if ($moderetrive == "Flight") {
    $mode = 'F';
} else if ($moderetrive == "Train") {
    $mode = 'T';
} else if ($moderetrive == "Hotel") {
    $mode = 'H';
} else if ($moderetrive == "Cab") {
    $mode = 'C';
}

//$mode = $_SESSION['modeoftravel'];
$yrdate = date('Y');
$tripId = $mode . "-" . $yrdate . "-" . $meId;

if (isset($_POST["Submit"])) {
    $sql5 = "INSERT INTO `b_tripregister`(`tripid`,`tfrom`, `tto`,`username`,`triptype`,`reasonfortravel`,`modeoftravel`,`departuredate`,`returndate`,`remarks`,`vendoremail`) 
        VALUES ('$tripId','{$_SESSION['fromloc']}', '{$_SESSION['toloc']}','{$_SESSION['username']}','{$_SESSION['type']}','{$_SESSION['reasonfortravel']}','{$_SESSION['modeoftravel']}','{$_SESSION['depdate']}','{$_SESSION['returndate']}','{$_SESSION['remarks']}','{$_SESSION['vendorEmail']}')";
    $result = mysqli_query($con, $sql5);
    /* if ($result) {
            echo " finally Successful";
        }*/
    //echo $sql5;
    if ($_SESSION['tocheck'] == "yeschecked") {
        foreach ($_SESSION['empall'] as $value) {
            $sqlquery = "INSERT INTO `b_emp` (`tripid`,`colleague`) VALUES ('$tripId','$value')";
            $result1 = mysqli_query($con, $sqlquery);
        }
        /* if($resullllt)
        {
            echo "Successful";
        }*/
    }
    if ($_SESSION['type'] == "Round") {
        $maxqry = "SELECT count(tripid) as maxmeId FROM `b_tripregister` group by substring(tripid,1,7)";
        $result4 = mysqli_query($con, $maxqry);
        $row4 = mysqli_fetch_assoc($result4);
        $meId = $row4['maxmeId'];

        $strmeId = $meId + 1;
        if ($strmeId < 10) {
            $meId = "0000" . ($meId + 1);
        } elseif ($strmeId < 100) {
            $meId = "000" . ($meId + 1);
        } elseif ($strmeId < 1000) {
            $meId = "00" . ($meId + 1);
        } elseif ($strmeId < 10000) {
            $meId = "0" . ($meId + 1);
        }
        $moderetrive = $_SESSION['modeoftravel'];
        if ($moderetrive == "Flight") {
            $mode = 'F';
        } else if ($moderetrive == "Train") {
            $mode = 'T';
        } else if ($moderetrive == "Hotel") {
            $mode = 'H';
        } else if ($moderetrive == "Cab") {
            $mode = 'C';
        }

        //$mode = $_SESSION['modeoftravel'];
        $yrdate = date('Y');
        $tripId = $mode . "-" . $yrdate . "-" . $meId;
        $returnfromloc = $_SESSION['toloc'];
        $returntoloc = $_SESSION['fromloc'];
        $sql6 = "INSERT INTO `b_tripregister`(`tripid`,`tfrom`, `tto`,`username`,`triptype`,`reasonfortravel`,`modeoftravel`,`departuredate`,`remarks`,`vendoremail`) 
        VALUES ('$tripId','$returnfromloc', '$returntoloc','{$_SESSION['username']}','One-Way','{$_SESSION['reasonfortravel']}','{$_SESSION['modeoftravel']}','{$_SESSION['returndate']}','{$_SESSION['remarks']}','{$_SESSION['vendorEmail']}')";
        $result = mysqli_query($con, $sql6);

        foreach ($_SESSION['empall'] as $value) {
            $sqlquery = "INSERT INTO `b_emp` (`tripid`,`colleague`) VALUES ('$tripId','$value')";
            $result1 = mysqli_query($con, $sqlquery);
        }
    }
    echo "<script>location.href='register.php'</script>";
}
?>
<?php
$type = $_SESSION['type'];
$fromLocation = $_SESSION['fromloc'];
$toLocation = $_SESSION['toloc'];
$reasonForTravel = $_SESSION['reasonfortravel'];
$modeOfTravel =  $_SESSION['modeoftravel'];
$departureDate = $_SESSION['depdate'];
$returnDate = $_SESSION['returndate'];
$vendor = $_SESSION['vendorname'];
$remarks = $_SESSION['remarks'];

require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\SMTP.php';
require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\Exception.php';

// Retrieve the selected vendor from the form
$vendor = $_SESSION['vendorname'];

// Retrieve the user's email address from the database based on the user ID in the session
$userID = $_SESSION['username'];

$sql = "SELECT vendoremail,vendorname FROM `b_vendormaster` WHERE vendorname = '$vendor'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$vendorEmail = $row['vendoremail'];
$vendorname = $row['vendorname'];

$sql1 = "SELECT emp_email,emp_name FROM `b_usermaster` WHERE userid = '$userID'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$userEmail = $row1['emp_email'];
$empname = $row1['emp_name'];
$_SESSION['userEmail'] = $userEmail;
$_SESSION['empname'] = $empname;

$mail =new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // gmail SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'harshusid78@gmail.com'; // email
$mail->Password = 'vrnwpiotjcquqqvx'; // 16 character obtained from app password created
$mail->Port = 465; // SMTP port
$mail->SMTPSecure = 'ssl';

$mail->setFrom($userEmail, $empname);
$mail->addReplyTo($userEmail, $empname);
// Receiver email address and name
$mail->addAddress($vendorEmail, $vendorname);
$mail->Subject = "Flight Booking Request";
$mail->isHTML(true);
// Set the email body
$message = "Dear $vendorname,<br><br>";
$message .= "I hope this email finds you well. I am writing to urgently notify you about a flight booking that requires your immediate attention. Our employee, $empname, has filled out a flight booking form, and it is crucial that the necessary arrangements are made promptly.<br><br>";
$message .= "Please find below the flight details:<br><br>";
$message .= " Employee Name:     $empname<br>";
$message .= " From :     $fromLocation<br>";
$message .= " To :     $toLocation<br>";
$message .= " Departure Date:     $departureDate<br>";
if ($_SESSION['type'] == "Round") {
    $message .= " Return Date:     $returnDate<br>";
}
$message .= "Travel Type:     $type<br>";
$message .= " Remarks:     $remarks<br>";
if ($_SESSION['tocheck'] == "yeschecked") {
    $message .= " Other Employee:";
    foreach ($_SESSION['empall'] as $value) {
        $message .=  $value;
        $message .= ",";
    }
    $message .= "<br>";
}
$message .= "<br><br>";
$message .= "Given the urgency of this matter, we appreciate your prompt attention and cooperation. If you have any questions or need further clarification, please do not hesitate to reach out.<br><br>";
$message .= "Thank you for your immediate assistance in making the necessary arrangements for our employee's travel. We look forward to your prompt response.<br><br>";
$message .= "Best regards,<br><br>";
$message .= "$empname<br>";
//$message .= "[Your Position]\n";
$message .= "SEW-Eurodrive";
$mail->Body = $message;
// Send the email
if ($mail->send()) {
    echo "SENDED";
} else {
    echo "not sended";
    $mail->ErrorInfo;
}


$mail->setFrom($vendorEmail, $vendorname);
// Receiver email address and name
$mail->addAddress($userEmail, $empname);
$mail->Subject = "Flight Booking Request";
$mail->isHTML(true);
// Set the email body
$message = "Dear $empname,<br><br>";
$message .= "Your details Applied Successfully.";
$mail->Body = $message;
if ($mail->send()) {
    echo "SENDED";
} else {
    echo "not sended";
    $mail->ErrorInfo;
}
$mail->smtpClose();
?>