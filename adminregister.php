<?php require_once 'adminmenubar.php';
require_once 'dbconnection.php';
$sql = mysqli_query($con, "SELECT * from `b_tripregister` where username='" . $_SESSION["username"] . "'");
// Handle document deletion
// echo $sql;
$document = isset($_GET['document']) ? $_GET['document'] : NULL; // Retrieve the document name from the URL parameters
$tripid = isset($_GET['id']) ? $_GET['id'] : NULL;

use PHPMailer\PHPMailer\PHPMailer;

require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\SMTP.php';
require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\Exception.php';
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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

        /* input[type="submit"]:hover {
            background-color: #2C353C;
            color: white;
            transform: scale(1.12);
            transition: ease 0.15s;
            cursor: pointer;
        } */

        a {
            color: rgb(10, 10, 210);
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
        }
    </style>
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
                <th>Selected Option</th>
                <th>Ticket</th>
                <th>Invoice</th>
                <th>Colleagues</th>
                <th>Approved Status</th>
                <th>Finance Status</th>
            </tr>

            <?php
            $sql = mysqli_query($con, "SELECT * from `b_tripregister` join `b_usermaster` ON b_tripregister.username = b_usermaster.userid  where b_usermaster.supportregion='" . $_SESSION['supportregion'] . "'");

            while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)) : {
                    $departuredate = date_create($data['departuredate']);
                    $date = date("Y-m-d"); // Get the current date as a DateTime object
                    $currentdate = date_create($date);
                    //$sql = mysqli_query($con, "SELECT * from b_tripregister join b_usermaster ON b_tripregister.username = b_usermaster.userid  where work_level >= '" . $_SESSION['worklevel'] . "' and dept='" . $_SESSION['department'] . "'");

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

                    echo "<td>";
                    if ($data['selectionupload'] != NULL) {
                        echo '<form method="post" enctype="multipart/form-data"">';
                        echo "<a href='" . $data["selectionupload"] . "' target='_blank';><i class='material-icons'>image</i>Selected Option</a>";
                        echo '<input type="hidden" name="dtrip" value=' . $data["tripid"] . '>';
                        echo '<input type="submit" value="Delete" name="deleteselectionupload" formaction="adminregister.php?document=selectionupload" />';
                        echo "</form>";
                    } else {
                        echo 'Not Uploaded';
                    }
                    echo "</td>";

                    echo "<td>";
                    if ($data['ticketupload'] != NULL) {
                        echo '<form method="post" enctype="multipart/form-data">';
                        echo "<a href='" . $data["ticketupload"] . "' target='_blank';><i class='material-icons'>image</i>Ticket</a>";
                        echo '<input type="hidden" name="dtrip" value=' . $data["tripid"] . '>';
                        if ($_SESSION['department'] == 'HR') {
                            echo '<input type="submit" value="Delete" name="deleteticketupload" formaction="adminregister.php?document=ticketupload"/>';
                        }
                        echo "</form>";
                    } else {
                        $target_fileticket = "";
                        echo '<form name="f1" method="post" enctype="multipart/form-data">
                        <input type="file" name="beingticketupload"/><br/>
                        <input type="submit" value="Upload" name="iupload" formaction="adminregister.php?document=ticketupload&id=' . $data["tripid"] . '"/>
                        </form>';
                    }
                    echo "</td>";

                    echo "<td>";
                    if ($data['invoiceupload'] != NULL) {
                        echo '<form method="post" enctype="multipart/form-data">';
                        echo "<a href='" . $data["invoiceupload"] . "' target='_blank';><i class='material-icons'>image</i>Invoice</a>";
                        echo '<input type="hidden" name="dtrip" value=' . $data["tripid"] . '>';
                        if ($_SESSION['department'] == 'HR') {
                            echo '<input type="submit" value="Delete" name="deleteinvoiceupload" formaction="adminregister.php?document=invoiceupload"/>';
                        }
                        echo "</form>";
                    } else {
                        $target_fileinvoice = "";
                        echo '<form name="f1" method="post" enctype="multipart/form-data">
                        <input type="file" name="beinginvoiceupload"/><br/>
                        <input type="submit" value="Upload" name="iupload" formaction="adminregister.php?document=invoiceupload&id=' . $data["tripid"] . '"/>
                        </form>';
                    }
                    echo "</td>";

                    $query = "SELECT colleague from `b_emp` where tripid='" . $data['tripid'] . "'";
                    $resultofup = mysqli_query($con, $query);
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
                    if ($_SESSION['department'] == 'HR') {
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='trip_id' value='" . $data["tripid"] . "'>";
                        echo "<input type='submit' name='addon' value='Edit'>";
                        echo "</form>";
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
                                echo "Rejected<br>";
                                echo "No Remarks";
                            }
                        }
                        if ($data['approvedstatus'] == NULL) {
                            echo "Pending";
                        }
                    }
                    echo "</td>";

                    echo "<td>";
                    //printing symbol
                    if ($data['financestatus'] == 1) {
                        //echo $email['emp_email'];
                        echo "<i class='fas fa-check'></i>";
                    }
                    if ($data['financestatus'] == '0') {
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>';
                    }
                    if ($data['financestatus'] == NULL) {
                        if ($_SESSION['accesstype'] == 1) {
                            echo "<form method='POST'>";
                            echo "<input type='submit' name='approvef' value='Accept'>                         ";
                            echo "<input type='hidden' name='ftrip' value=" . $data['tripid'] . ">";
                            echo "<input type='submit' name='rejectf' value='Reject'></form>";
                        } else {
                            echo "Pending";
                        }
                    }
                    echo "</td>";
                }
                echo "</tr>";
            endwhile; ?>
        </table>
    </div>
    <?php
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'harshusid78@gmail.com'; // email
    $mail->Password = 'vrnwpiotjcquqqvx'; // 16 character obtained from app password created
    $mail->Port = 465; //Set the SMTP port to 25, 587, 465
    $mail->SMTPSecure = 'ssl';
    if (isset($_POST['iupload'])) {
        $target_dir = "adminupload/";
        $fetch = "SELECT $document FROM `b_tripregister` WHERE tripid = '$tripid'";
        $result = mysqli_query($con, $fetch);
        $file = mysqli_fetch_assoc($result);

        if (isset($_FILES["being" . $document]["tmp_name"])) {
            if ($_FILES["being" . $document]["tmp_name"] == '') {
                echo "<script>alert('Please select the file first.');
                location.href='adminregister.php';</script>";
                exit();
            }
        }
        if (isset($_FILES["being" . $document]["tmp_name"]) && $file[$document] == NULL) {
            // if ($document == "invoiceupload") {
            //     $target_file = $target_fileinvoice;
            // } elseif ($document == "ticketupload") {
            //     $target_file = $target_fileticket;
            // }
            $target_file = $target_dir . uniqid() . '_' . basename($_FILES["being" . $document]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check file size
            // if ($_FILES["being" . $document]["size"] > 500000) {
            //     echo "Sorry, your file is too large.";
            //     $uploadOk = 0;
            //   }
            // Check file format
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "pdf"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & PDF files are allowed.";
                $uploadOk = 0;
            }

            $try = "SELECT $document FROM `b_tripregister` WHERE tripid = '$tripid' AND $document = '$target_file'";
            $dupplicate = mysqli_query($con, $try);
            $existingfile = mysqli_fetch_assoc($dupplicate);

            if ($existingfile) {
                echo "Sorry, a file with the same name already exists.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "<br/>Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {

                if (move_uploaded_file($_FILES["being" . $document]["tmp_name"], $target_file)) {
                    // Store the file path in the database
                    $path = $target_file;
                    $query = "UPDATE `b_tripregister` SET $document = '$path' WHERE tripid = '$tripid'";

                    if (mysqli_query($con, $query)) {
                        echo "<br/><script>alert('The file " . htmlspecialchars(basename($_FILES["being" . $document]["name"])) . " has been uploaded.');
                        location.href='adminregister.php';</script>";

                        if ($document == 'ticketupload') {
                            $sql1 = "SELECT * FROM `b_tripregister` where tripid= '$tripid'";
                            $result = mysqli_query($con, $sql1);
                            $employee = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            $username = $employee['username'];
                            $sql2 = "SELECT * FROM `b_usermaster` where userid='$username'";
                            $result2 = mysqli_query($con, $sql2);
                            $emp = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                            $empName = $emp['emp_name'];
                            $empEmail = $emp['emp_email'];
                            // Email content
                            $mail->setFrom($_SESSION['empemail'], $_SESSION['name']);
                            $mail->addAddress($empEmail, $empName);
                            $mail->Subject = 'Your Flight Ticket for Trip';
                            $mail->isHTML(true);
                            // Email body
                            $message = "Dear $empName,<br><br>";
                            $message .= "We are pleased to inform you that the flight ticket for your requested trip (ID : $tripid) has been uploaded successfully. You can find the ticket attached to this email.<br><br>";
                            $message .= "Please review the ticket details and ensure that all information is accurate. If you have any questions or require further assistance, please don't hesitate to contact the HR department.<br><br>";
                            $message .= "Thank you for using our services. We wish you a pleasant trip!<br><br>";
                            $message .= "Best regards,<br>";
                            $message .= "HR Department";
                            $mail->Body = $message;
                            // Attach the ticket file
                            $attachmentPath = $path; // Path to the uploaded ticket file
                            $mail->addAttachment($attachmentPath);
                            // Send the email
                            $mail->send();
                        } else if ($document == 'invoiceupload') {
                            $queryemployee = "SELECT * from `b_usermaster` where accesstype = '1' and status='Active' and supportregion='" . $_SESSION['supportregion'] . "'";
                            $resultofup = mysqli_query($con, $queryemployee);
                            $sql3 = "SELECT * FROM `b_tripregister` where tripid= '$tripid'";
                            $result1 = mysqli_query($con, $sql3);
                            $employee = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                            $username1 = $employee['username'];
                            $sql4 = "SELECT * FROM `b_usermaster` where userid='$username1'";
                            $result3 = mysqli_query($con, $sql4);
                            $emp1 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                            $empName1 = $emp1['emp_name'];
                            $empEmail1 = $emp1['emp_email'];
                            while ($empemail = mysqli_fetch_array($resultofup, MYSQLI_ASSOC)) : {
                                    $financeemail = $empemail['emp_email'];
                                    $financename = $empemail['emp_name'];
                                    $mail->setFrom($_SESSION['empemail'], $_SESSION['name']);
                                    $mail->addCC($_SESSION['empemail'], $_SESSION['name']);
                                    $mail->addCC($empEmail1, $empName1);
                                    $mail->addAddress($financeemail, $financename);
                                    $mail->Subject = "SEW Eurodrive - Invoice for Trip Expense!!";
                                    $mail->Body = "Dear " . $financename . ",\n\n";
                                    $mail->Body .= "I hope this email finds you well. Attached to this email, please find the invoice for the trip expense of $empName1 of TripId $tripid from the Finance. Kindly review the invoice and process the payment accordingly.\n\n";
                                    $mail->Body .= "If you require any additional information or have any queries regarding the invoice, please feel free to reach out to the HR department at,\n\n";
                                    $mail->Body .= "{$_SESSION['name']} \n";
                                    $mail->Body .= "{$_SESSION['empemail']} \n";
                                    $mail->Body .= "Thank you for your attention to this matter.\n\n";
                                    $mail->Body .= "Best regards,\n";
                                    $mail->Body .= "{$_SESSION['name']}\n";
                                    $mail->Body .= "Best regards,\n\n";
                                    $mail->Body .= "SEW-Eurodrive\n\n";
                                    $attachmentPath = $path; // Specify the path to the attached PDF file
                                    $mail->addAttachment($attachmentPath);
                                    $mail->send();
                                }
                            endwhile;
                        }
                    }
                }
            }
        }
    }

    if (isset($_POST["addon"])) {
        $_SESSION['tripid'] = $_POST['trip_id'];
        echo "<script>location.href='addemployee.php'</script>";
    }

    if (isset($_POST['ok'])) {
        $tripid = $_POST['rtrip'];
        $sql1 = "UPDATE `b_tripregister` SET rejectremark ='" . $_POST['remark'] . "' WHERE tripid = '$tripid'";
        $result1 = mysqli_query($con, $sql1);
        $_SESSION['rejectremark'] = $_POST['remark'];
    }

    if (isset($_POST['rejectf'])) {
        $tripid = $_POST['ftrip'];
        $sql1 = "UPDATE `b_tripregister` SET financestatus = 0 WHERE tripid = '$tripid'";
        $result1 = mysqli_query($con, $sql1);
        echo "<script>location.href='adminregister.php';</script>";
    }

    if (isset($_POST['approvef'])) {
        if (isset($_POST['ftrip'])) {
            $tripid = $_POST['ftrip'];
            $sql1 = "UPDATE `b_tripregister` SET financestatus = 1 WHERE tripid = '$tripid'";
            $result1 = mysqli_query($con, $sql1);
            echo "<script>location.href='adminregister.php';</script>";
        }
    }

    if (isset($_POST["delete" . $document])) {
        $tripid = $_POST["dtrip"];

        if ($document == 'selectionupload') {
            $show = "Selected option by the user";
        }
        if ($document == 'ticketupload') {
            $show = "Ticket";
        }
        if ($document == 'invoiceupload') {
            $show = "Invoice";
        }

        // JavaScript confirm dialog to ask for confirmation
        echo "<script>";
        echo "var confirmed = confirm('Confirm to delete the $show?');
        if (confirmed) {
            // User confirmed, proceed with the deletion
            location.href = 'adminregister.php?delete_confirm=true&tripid=$tripid&document=$document';
        } else {
            // User canceled, do nothing or redirect to another page
            location.href = 'adminregister.php';
        }";
        echo "</script>";
    }

    if (isset($_GET['delete_confirm']) && $_GET['delete_confirm'] === 'true') {
        // Deletion confirmed, proceed with the deletion
        $tripid = $_GET['tripid'];
        $document = $_GET['document'];

        // Delete the existing file and update the database with NULL
        $documentpathquery = "SELECT $document FROM `b_tripregister` WHERE tripid = '$tripid'";
        $documentpathresult = mysqli_query($con, $documentpathquery);
        $documentpathdata = mysqli_fetch_assoc($documentpathresult);
        $documentpath = $documentpathdata[$document];

        if ($documentpath != NULL) {
            if (unlink($documentpath)) {
                $deletequery = "UPDATE `b_tripregister` SET $document = NULL WHERE tripid = '$tripid'";
                if (mysqli_query($con, $deletequery)) {
                    echo "<script>alert('The file has been deleted successfully.');
                location.href='adminregister.php'</script>";
                } else {
                    echo "<script>alert('Error updating the database: " . mysqli_error($con) . ");
                location.href='adminregister.php';</script>";
                }
            } else {
                echo "<script>alert('Error deleting the file.');
            location.href='adminregister.php';</script>";
            }
        } else {
            echo "<script>alert('File does not exist.');
        location.href='history.php';</script>";
        }
    }

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
        echo "<script>location.href='adminregister.php';</script>";
    }
    if (isset($_POST['reject'])) {
        if (isset($_POST['ztrip'])) {
            $tripid = $_POST['ztrip'];
            $sql1 = "UPDATE `b_tripregister` SET approvedstatus = 0 WHERE tripid = '$tripid'";
            $result1 = mysqli_query($con, $sql1);
            echo "<script>location.href='adminregister.php';</script>";
        }
    }

    if (isset($_POST['ok']) && $data['approvedstatus'] == '0') {
        $remarks = $_POST['remark'];
        $tripid = $_POST['rtrip'];
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
        echo "<script>location.href='adminregister.php';</script>";
    }
    $mail->smtpClose();
    ?>

</html>