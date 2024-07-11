<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\SMTP.php';
require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\Exception.php';

require_once 'dbconnection.php';
require_once 'usermenubar.php';
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <style>
        .container {
            overflow-x: auto;
        }

        table {
            padding: 0.3%;
            text-align: center;
            white-space: nowrap;
        }

        .approved {
            background-color: lightgreen;
        }

        .rejected {
            background-color: lightcoral;
        }

        .pending {
            background-color: lightyellow;
        }

        input[type="submit"] {
            text-align: center;
            background-color: #dddddd;
            cursor: pointer;
            border-radius: 4px 4px 4px 4px;
            box-shadow: 2px 2px 2px #777777;
        }

        a {
            color: rgb(10, 10, 210);
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <div class="container">
        <table border="3px" cellpadding='7' cellspacing='2'>
            <tr>
                <th>Trip ID</th>
                <th>Username</th>
                <th>From</th>
                <th>To</th>
                <th>Departure Date</th>
                <th>Travel Mode</th>
                <th>Vendor Name</th>
                <th>Options</th>
                <th>Ticket</th>
                <th>Invoice</th>
                <th>Colleagues</th>
                <th>Approved Status</th>
                <th>Finance Status</th>
            </tr>
            <?php
            $sql2 = mysqli_query($con, "SELECT * from `b_usermaster` where emp_email='" . $_SESSION['directreportingto'] . "'");

            $employeenames = array();
            $sql = mysqli_query($con, "SELECT * from `b_tripregister` join `b_usermaster` ON b_tripregister.username = b_usermaster.userid  where work_level >= '" . $_SESSION['worklevel'] . "' and supportregion='" . $_SESSION['supportregion'] . "' and b_usermaster.userid!='" . $_SESSION['username'] . "'");

            while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)) : {
                    $departuredate = date_create($data['departuredate']);
                    $date = date("Y-m-d"); // Get the current date as a DateTime object
                    $currentdate = date_create($date);
                    if ($data['approvedstatus'] != NULL || $data['financestatus'] != NULL) {
                        if ($data['approvedstatus'] == '0' || $data['financestatus'] == '0') {
                            echo "<tr class='rejected'>";
                        } else if ($data['approvedstatus'] == 1 || $data['financestatus'] == 1) {
                            if ($data['approvedstatus'] == 1 && $data['financestatus'] == 1) {
                                if ($departuredate < $currentdate) {
                                    echo "<tr>";
                                } else {
                                    echo "<tr class='approved'>";
                                }
                            } else {
                                echo "<tr class='pending'>";
                            }
                        }
                    } else {
                        echo "<tr class='pending'>";
                    }
                    echo "<td>" . $data["tripid"] . "</td>";
                    echo "<td title= '" . $data['username'] . "'>" . $data["emp_name"] . "</td>";
                    echo "<td>" . $data["tfrom"] . "</td>";
                    echo "<td>" . $data["tto"] . "</td>";
                    echo "<td>" . date_create($data['departuredate'])->format('d-m-Y') . "</td>";
                    echo "<td>" . $data["modeoftravel"] . "</td>";
                    echo "<td>" . $data["vendoremail"] . "</td>";

                    echo '<td>';
                    if ($data['selectionupload'] != NULL) {
                        $imageFileType = strtolower(pathinfo($data['selectionupload'], PATHINFO_EXTENSION));
                        if ($imageFileType == 'jpg' || $imageFileType == 'png' || $imageFileType == 'jpeg') {
                            echo '<a href="' . $data["selectionupload"] . '" target="_blank";><i class="material-icons">image</i>Selected Option</a>';
                        }

                        if ($imageFileType == 'pdf') {
                            echo '<a href="' . $data["selectionupload"] . '" target="_blank";><svg xmlns="http://www.w3.org/2000/svg" width="26" height="36" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/><i class="bi bi-filetype-pdf"></i></svg>Selected Option</a>';
                        }
                    } else {
                        echo 'Not Uploaded';
                    }
                    echo '</td>';

                    echo '<td>';
                    if ($data['ticketupload'] != NULL) {
                        $imageFileType = strtolower(pathinfo($data['ticketupload'], PATHINFO_EXTENSION));
                        if ($imageFileType == 'jpg' || $imageFileType == 'png' || $imageFileType == 'jpeg') {
                            echo '<a href="' . $data["ticketupload"] . '" target="_blank";><i class="material-icons">image</i>Ticket</a>';
                        }

                        if ($imageFileType == 'pdf') {
                            echo '<a href="' . $data["ticketupload"] . '" target="_blank";><svg xmlns="http://www.w3.org/2000/svg" width="26" height="36" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/><i class="bi bi-filetype-pdf"></i></svg>Ticket</a>';
                        }
                    } else {
                        echo 'Not Uploaded';
                    }
                    echo '</td>';

                    echo '<td>';
                    if ($data['invoiceupload'] != NULL) {
                        $imageFileType = strtolower(pathinfo($data['invoiceupload'], PATHINFO_EXTENSION));
                        if ($imageFileType == 'jpg' || $imageFileType == 'png' || $imageFileType == 'jpeg') {
                            echo '<a href="' . $data["invoiceupload"] . '" target="_blank";><i class="material-icons">image</i>Invoice</a>';
                        }

                        if ($imageFileType == 'pdf') {
                            echo '<a href="' . $data["invoiceupload"] . '" target="_blank";><svg xmlns="http://www.w3.org/2000/svg" width="26" height="36" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/><i class="bi bi-filetype-pdf"></i></svg>Invoice</a>';
                        }
                    } else {
                        echo 'Not Uploaded';
                    }
                    echo '</td>';

                    $sqlquery = "SELECT colleague from `b_emp` where tripid='" . $data['tripid'] . "'";
                    $resultofup = mysqli_query($con, $sqlquery);
                    $employeenames = array();
                    while ($names = mysqli_fetch_array($resultofup, MYSQLI_ASSOC)) : {
                            $employeenames[] = $names['colleague'];
                        }
                    endwhile;

                    echo "<td>";
                    if (!empty($employeenames)) {

                        $value1 = implode(', ', $employeenames);
                        echo "$value1";
                        unset($employeenames);
                    } else {
                        echo "No Colleagues";
                    }
                    echo "</td>";

                    echo "<td>";
                    if ($_SESSION['empemail'] == $data['directreportingto']) {

                        //printing symbol
                        if ($data['approvedstatus'] == 1) {
                            //echo $email['emp_email'];
                            echo "<i class='fas fa-check'></i>";
                        }
                        if ($data['approvedstatus'] == '0') {
                            if ($data['rejectremark'] != NULL) {
                                echo $data['rejectremark'];
                            } else {
                                echo "<form method='POST'><textarea name='remark'></textarea><br/>";
                                echo "<input type='hidden' name='rtrip' value=" . $data['tripid'] . ">";
                                echo "<input type='submit' name='ok' value='Submit'></form>";
                            }
                        }
                        if ($data['approvedstatus'] == NULL) {
                            echo "<form method='POST' onsubmit='return confirmTrip();'>";
                            echo "<input type='submit' name='approve' value='Approve' onClick='setAction(\"approve\");'>                         ";
                            echo "<input type='hidden' name='ztrip' value=" . $data['tripid'] . ">";
                            echo "<input type='submit' name='reject' value='Reject' onClick='setAction(\"reject\");'></form>";

                            echo "<script>";
                            echo "function setAction(action) {";
                            echo "    document.getElementById('actionInput').value = action;";
                            echo "}";

                            echo "function confirmTrip() {";
                            echo "    var action = document.getElementById('actionInput').value;";
                            echo "    var message = 'Are you sure you want to ' + (action === 'approve' ? 'approve' : 'reject') + ' this trip?';";
                            echo "    return confirm(message);";
                            echo "}";
                            echo "</script>";

                            // Add this line to include the hidden input field
                            echo "<input type='hidden' id='actionInput' name='actionInput' value=''>";
                        }
                    } else {
                        if ($data['approvedstatus'] == 1) {
                            echo "<i class='fas fa-check'></i>";
                        }
                        if ($data['approvedstatus'] == '0') {
                            if ($data['rejectremark'] != NULL) {
                                echo $data['rejectremark'];
                            } else {
                                echo "No Remarks";
                            }
                        }
                        if ($data['approvedstatus'] == NULL) {
                            echo 'Pending';
                        }
                    }
                    echo "</td>";

                    echo "<td>";
                    if ($data['financestatus'] == 1) {
                        echo "<i class='fas fa-check'></i>";
                    }
                    if ($data['financestatus'] == '0') {
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>';
                    }
                    if ($data['financestatus'] == NULL) {
                        echo 'Pending';
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            endwhile;
            ?>
        </table>
    </div>
    <?php
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug  = 0;
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com'; // gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'sidharsh349@gmail.com'; // email
    $mail->Password = 'lqtugznbmhkpudpg'; // 16 character obtained from app password created
    $mail->Port = 465; // SMTP port
    $mail->SMTPSecure = 'ssl';
    if (isset($_POST['approve'])) {
        if (isset($_POST['ztrip'])) {
            $tripid = $_POST['ztrip'];
            $sql1 = "UPDATE `b_tripregister` SET approvedstatus = 1 WHERE tripid = '$tripid'";
            $result1 = mysqli_query($con, $sql1);

            $sql2 = "SELECT * from `b_tripregister` where tripid='$tripid'";
            $result2 = mysqli_query($con, $sql2);
            $vendor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

            $username = $vendor2['username'];
            $departureDate = $vendor2['departuredate'];
            $returnDate = $vendor2['returndate'];
            $fromLocation = $vendor2['tfrom'];
            $toLocation = $vendor2['tto'];
            $triptype = $vendor2['triptype'];
            $reasonForTravel = $vendor2['reasonfortravel'];
            $vendorEmail = $vendor2['vendoremail'];

            $sql3 = "SELECT * from `b_vendormaster` where vendoremail='$vendorEmail' and supportregion='" . $_SESSION['supportregion'] . "'";
            $result3 = mysqli_query($con, $sql3);
            $vendordetails = mysqli_fetch_array($result3, MYSQLI_ASSOC);
            $vendorName = $vendordetails['vendorname'];

            $queryuser = "SELECT * from `b_usermaster` where userid='$username'";
            $resultqueryofuser = mysqli_query($con, $queryuser);
            $userdetails = mysqli_fetch_array($resultqueryofuser, MYSQLI_ASSOC);
            $mail->setFrom($_SESSION['empemail'], $_SESSION['name']);
            $employeename = $userdetails['emp_name'];
            $employeeemail = $userdetails['emp_email'];
            $mail->addAddress($vendorEmail, $vendorName);
            $mail->addCC($employeeemail, $employeename);
            $mail->Subject = "Approved Trip Request - Vendor Notification";
            $mail->Body = "Dear " . $vendorName . ",\n\n";
            $mail->Body .= "I hope this email finds you well. I am pleased to inform you that the trip requested by $username has been approved by the HR department of " . $_SESSION['department'] . ". We are pleased to grant permission for your upcoming trip as per the provided details:\n\n";
            $mail->Body .= "Trip Details:\n";
            $mail->Body .= "Trip Request ID: $tripid\n";
            $mail->Body .= "User Name: $username\n";
            $mail->Body .= "Departure Date: $departureDate\n";
            if ($triptype == "Round") {
                $mail->Body .= "Return Date: $returnDate\n";
            }
            $mail->Body .= "From : $fromLocation\n";
            $mail->Body .= "To : $toLocation\n";
            $mail->Body .= "Purpose: $reasonForTravel\n\n";
            $mail->Body .= "Please make the necessary arrangements as per the attached itinerary and ensure compliance with our vendor agreement. Any specific requirements or preferences will be communicated directly by the user.\n\n";
            $mail->Body .= "For any updates or changes related to this trip, kindly notify us promptly.\n\n";
            $mail->Body .= "Thank you for your cooperation.\n\n";
            $mail->Body .= "Best regards,\n";
            $mail->Body .= "{$_SESSION['name']}\n";
            $mail->Body .= "SEW-Eurodrive\n\n";
            $attachmentPath = $vendor2["selectionupload"]; // Specify the path to the attached PDF file
            $mail->addAttachment($attachmentPath);
            $mail->send();
        }
        echo "<script>location.href='records.php';</script>";
    }
    if (isset($_POST['reject'])) {
        if (isset($_POST['ztrip'])) {
            $tripid = $_POST['ztrip'];
            $sql1 = "UPDATE `b_tripregister` SET approvedstatus = 0 WHERE tripid = '$tripid'";
            $result1 = mysqli_query($con, $sql1);
            echo "<script>location.href='records.php';</script>";
        }
    }

    if (isset($_POST['ok'])) {
        $remarks = $_POST['remark'];
        $tripid = $_POST['rtrip'];

        $sql1 = "UPDATE `b_tripregister` SET rejectremark ='" . $_POST['remark'] . "' WHERE tripid = '$tripid'";
        $result1 = mysqli_query($con, $sql1);
        $_SESSION['rejectremark'] = $_POST['remark'];

        $sql2 = "SELECT * from `b_tripregister` where tripid='$tripid'";
        $result2 = mysqli_query($con, $sql2);
        $vendor2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $username = $vendor2['username'];
        $departureDate = $vendor2['departuredate'];
        $returnDate = $vendor2['returndate'];
        $fromLocation = $vendor2['tfrom'];
        $toLocation = $vendor2['tto'];
        $triptype = $vendor2['triptype'];
        $reasonForTravel = $vendor2['reasonfortravel'];
        $queryemployee = "SELECT * from `b_usermaster` where  userid='" . $_SESSION['username'] . "'";
        $resultofup = mysqli_query($con, $queryemployee);
        $empemail1 = mysqli_fetch_array($resultofup, MYSQLI_ASSOC);
        $_SESSION['empemail'] = $empemail1['emp_email'];
        $_SESSION['name'] = $empemail1['emp_name'];
        $queryuser = "SELECT * from `b_usermaster` where userid='$username'";
        $resultqueryofuser = mysqli_query($con, $queryuser);
        $userdetails = mysqli_fetch_array($resultqueryofuser, MYSQLI_ASSOC);
        $mail->setFrom($_SESSION['empemail'], $_SESSION['name']);
        $employeename = $userdetails['emp_name'];
        $employeeemail = $userdetails['emp_email'];
        $mail->addAddress($employeeemail, $employeename);
        $mail->Subject = "Flight Booking Request - Rejected";
        $mail->Body = "Dear " . $_SESSION['name'] . ",\n\n";
        $mail->Body .= "I hope this email finds you well. We regret to inform you that your trip request has been rejected by the HR department. After careful consideration, we have determined that the trip does not meet the necessary requirements or align with the company's policies.\n\n";
        $mail->Body .= "Reason for Rejection: $remarks\n\n";
        $mail->Body .= "We understand that this decision may cause inconvenience, but we assure you that it is in the best interest of the company. If you have any questions or need further clarification, please contact the HR department at {$_SESSION['empemail']}.\n\n";
        $mail->Body .= "Thank you for your understanding.\n\n";
        $mail->Body .= "Best regards,\n";
        $mail->Body .= "{$_SESSION['name']}\n";
        $mail->Body .= "SEW-Eurodrive\n\n";
        $mail->send();
        echo "<script>location.href='records.php';</script>";
    }
    $mail->smtpClose();
    ?>
</body>

</html>