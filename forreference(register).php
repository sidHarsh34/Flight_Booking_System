<?php require_once 'usermenubar.php';
require_once 'dbconnection.php';
$sql = mysqli_query($con, "SELECT * from `b_tripregister` where username='" . $_SESSION["username"] . "'");
$document = isset($_GET['document']) ? $_GET['document'] : NULL; // Retrieve the document name from the URL parameters
$tripid = isset($_GET['id']) ? $_GET['id'] : NULL;
?>
<?php

 use PHPMailer\PHPMailer\PHPMailer;
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
                <th>Departure Date</th>
                <th>From</th>
                <th>To</th>
                <th>Travel Mode</th>
                <th>Vendor Name</th>
                <th>Selected Option</th>
                <th>Ticket</th>
                <th>Invoice</th>
                <th>Approved Status</th>
                <th>Finance Status</th>
            </tr>
            <?php
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
                    echo "<td>" . date_create($data['departuredate'])->format('d-m-Y') . "</td>";
                    echo "<td>" . $data["tfrom"] . "</td>";
                    echo "<td>" . $data["tto"] . "</td>";
                    echo "<td>" . $data["modeoftravel"] . "</td>";
                    echo "<td>" . $data["vendoremail"] . "</td>";

                    echo "<td>";
                    if ($data['selectionupload'] != NULL) {
                        $imageFileType = strtolower(pathinfo($data['selectionupload'], PATHINFO_EXTENSION));
                        if ($imageFileType == 'jpg' || $imageFileType == 'png' || $imageFileType == 'jpeg') {
                            echo '<form method="post" enctype="multipart/form-data" onsubmit="return confirm(`Are you sure you want to delete your selection?`);">';
                            echo '<a href="' . $data["selectionupload"] . '" target="_blank";><i class="material-icons">image</i>Selected Option</a>';
                            echo '<input type="hidden" name="sid" value=' . $data["tripid"] . '>';
                            echo '<input type="submit" value="Delete" name="deletes"/>';
                            echo "</form>";
                        } elseif ($imageFileType == 'pdf') {
                            echo '<form method="post" enctype="multipart/form-data" onsubmit="return confirm(`Are you sure you want to delete your selection?`);">';
                            echo '<a href="' . $data["selectionupload"] . '" target="_blank";><svg xmlns="http://www.w3.org/2000/svg" width="26" height="36" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/><i class="bi bi-filetype-pdf"></i></svg>Selected Option</a>';
                            echo '<input type="hidden" name="sid" value=' . $data["tripid"] . '>';
                            echo '<input type="submit" value="Delete" name="deletes"/>';
                            echo "</form>";
                        }
                    } else {
                        $target_file = "";
                        echo '<form name="f1" method="post" enctype="multipart/form-data">
                        <input type="file" name="filetoupload"/><br/>
                        <input type="submit" value="Upload" name="upload" formaction="register.php?document=selectionupload&id=' . $data["tripid"] . '"/>
                        <input type="hidden" name="path" value="' . $target_file . '"/>
                        </form>';
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

                    echo '<td>';
                    if ($approvedstatus == 1) {
                        echo "<i class='fas fa-check'></i>";
                    }
                    if ($approvedstatus == '0') {
                        if ($remark != NULL) {
                            echo $remark;
                        } else {
                            echo "No Remarks";
                        }
                    }
                    if ($approvedstatus == NULL) {
                        echo 'Pending';
                    }
                    echo '</td>';

                    echo '<td>';
                    if ($data['financestatus'] == 1) {
                        echo "<i class='fas fa-check'></i>";
                    }
                    if ($data['financestatus'] == '0') {
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>';
                    }
                    if ($approvedstatus == NULL) {
                        echo 'Pending';
                    }
                    echo '</td>';

                    echo "</tr>";
                }
            endwhile;
            ?>
        </table>
    </div>
    <?php
    if (isset($_POST["deletes"])) {
        // Delete the existing file and update the database with NULL
        // Retrieve the document path from the database
        $id = $_POST["sid"];
        $documentpathquery = "SELECT selectionupload FROM `b_tripregister` WHERE tripid = '$id'";
        $documentpathresult = mysqli_query($con, $documentpathquery);
        $documentpathdata = mysqli_fetch_assoc($documentpathresult);
        $documentpath = $documentpathdata['selectionupload'];

        if ($documentpath != NULL) {
            if (unlink($documentpath)) {
                $deletequery = "UPDATE `b_tripregister` SET selectionupload=NULL WHERE tripid = '$id'";
                if (mysqli_query($con, $deletequery)) {
                    $data['selectionupload'] = NULL; // Update the document variable
                    echo "<script>alert('The file has been deleted successfully.');
                    location.href='register.php'</script>";
                } else {
                    echo "<script>alert('Error updating the database: '" . mysqli_error($con) . ");                   
                    location.href='register.php';</script>";
                }
            } else {
                echo "<script>alert('Error deleting the file.');
                location.href='register.php';</script>";
            }
        } else {
            echo "<script>alert('File does not exist.');
            location.href='register.php';</script>";
        }
    }

    if (isset($_POST['upload'])) {
        $target_dir = "userupload/";
        $fetch = "SELECT $document FROM `b_tripregister` WHERE tripid = '$tripid'";
        $result = mysqli_query($con, $fetch);
        $file = mysqli_fetch_assoc($result);

        if (isset($_FILES["filetoupload"]["tmp_name"])) {
            if ($_FILES["filetoupload"]["tmp_name"] == '') {
                echo "<script>alert('Please select the file first');
                location.href='register.php';</script>";
                exit();
            }
        }
        if (isset($_FILES["filetoupload"]["tmp_name"]) && $file[$document] == NULL) {
            $target_file = $target_dir . uniqid() . '_' . basename($_FILES["filetoupload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check file size
            // if ($_FILES["filetoupload"]["size"] > 500000) {
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

            $try = "SELECT $document FROM b_tripregister WHERE tripid = '$tripid' AND $document = '$target_file'";
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

                if (move_uploaded_file($_FILES["filetoupload"]["tmp_name"], $target_file)) {
                    // Store the file path in the database

                    $path = $target_file;
                    $query = "UPDATE `b_tripregister` SET $document = '$path' WHERE tripid = '$tripid'";
                    if (mysqli_query($con, $query)) {
                        echo "<br/><script>alert('The file " . htmlspecialchars(basename($_FILES["filetoupload"]["name"])) . " has been uploaded.');
                            location.href='register.php';</script>";
                        	//Activating mail functionality
							
					if ($document == 'selectionupload')
					 {
                        require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
                        require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\SMTP.php';
                        require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\Exception.php';
                        $mail = new PHPMailer(true);
							$mail->isSMTP();
							$mail->SMTPDebug  = 0;  
							$mail->Host = 'smtp.gmail.com'; // gmail SMTP server
							$mail->SMTPAuth = true;
							$mail->Username = 'harshusid78@gmail.com'; // email
							$mail->Password = 'vrnwpiotjcquqqvx'; // 16 character obtained from app password created
							$mail->Port = 465; // SMTP port
							$mail->SMTPSecure = 'ssl';
						$queryemployee = "SELECT * from b_usermaster where  emp_email='" . $_SESSION['direct_reportingto'] . "' and supportregion='" . $_SESSION['support_region'] . "'";
						$resultofup = mysqli_query($con, $queryemployee);
						if (mysqli_num_rows($resultofup) > 0) 
						{
							$empemail1 = mysqli_fetch_array($resultofup, MYSQLI_ASSOC);
							$queryuser = "SELECT * from b_usermaster where userid='" . $_SESSION['username'] . "'";
							$resultqueryofuser = mysqli_query($con, $queryuser);
							$userdetails = mysqli_fetch_array($resultqueryofuser, MYSQLI_ASSOC);
							$employeename = $userdetails['emp_name'];
							$employeeemail = $userdetails['emp_email'];
							$mail->setFrom($employeeemail,'HARSH');
							$tripid = $_SESSION['tripid'];
							$email1 = $empemail1['emp_email'];
							$name1 = $empemail1['emp_name'];
							$mail->addAddress('harshusid78@gmail.com', 'Harsh Sid');
							$mail->Subject = "Flight Booking Options-Trip Id :$tripid";
							$mail->Body = "Dear " . $name1 . ",\n\n";
							$mail->Body .= "I hope this email finds you well. Our employee $employeename, has recently requested a flight booking for Trip ID $tripid. We have received the flight options from the vendor and would appreciate your input in selecting the best option for the trip.\n\n";
							$mail->Body .= "Please find attached a PDF document containing the flight options and related information. Kindly review the options and provide your preference by replying to this email with the option  that you consider most suitable.\n\n";
							$mail->Body .= "Your feedback is valuable in ensuring a smooth and satisfactory travel experience for our employee. We kindly request you to provide your response within 3 days to allow us to finalize the flight booking.\n\n";
							$mail->Body .= "If you have any questions or need further clarification, please do not hesitate to reach out. Your prompt attention to this matter is greatly appreciated.\n\n";
							$mail->Body .= "Thank you for your cooperation.\n\n";
							$mail->Body .= "Best regards,\n\n";
							$mail->Body .= "$employeename,\n\n";
							$mail->Body .= "SEW-Eurodrive\n\n";
							$mail->Body .= "Note: This email is generated automatically. Please refer to the attached PDF for detailed flight options and information.";
							$mail->Body .= "\n";
							$attachmentPath = $path; // Specify the path to the attached PDF file
							$mail->addAttachment($attachmentPath);
							if($mail->send())
                                {
                                    echo "<script> alert('SENDED') </script>";
                                }
                                else
                                {
                                    echo "<script> alert('not sended')</script>";
                                    $mail->ErrorInfo;
                                }
                            $mail->smtpClose();
							
						}
					} 
					else if ($document == 'invoiceupload')
					{
                        require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
                        require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\SMTP.php';
                        require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\Exception.php';
                        $mail = new PHPMailer(true);
							$mail->isSMTP();
							$mail->SMTPDebug  = 0;  
							$mail->Host = 'smtp.gmail.com'; // gmail SMTP server
							$mail->SMTPAuth = true;
							$mail->Username = 'harshusid78@gmail.com'; // email
							$mail->Password = 'vrnwpiotjcquqqvx'; // 16 character obtained from app password created
							$mail->Port = 465; // SMTP port
							$mail->SMTPSecure = 'ssl';
						$queryemployee = "SELECT * from b_usermaster where accesstype = '1' and status='Active' and supportregion='" . $_SESSION['support_region'] . "'";
						$resultofup = mysqli_query($con, $queryemployee);
						$queryhr = "SELECT emp_name,emp_email from b_usermaster where work_level='3' and dept='HR' and supportregion='" . $_SESSION['support_region'] . "'";
						$resultofup1 = mysqli_query($con, $queryhr);
						if (mysqli_num_rows($resultofup) > 0 && mysqli_num_rows($resultofup1) > 0) 
						{   
							while($empemail = mysqli_fetch_array($resultofup, MYSQLI_ASSOC)): {
							$financeemail = $empemail['emp_email'];
							$financename = $empemail['emp_name'];
							$hremailfetch = mysqli_fetch_array($resultofup1, MYSQLI_ASSOC);
							$hremail = $hremailfetch['emp_email'];
							$hrname = $hremailfetch['emp_name'];
							$mail->setFrom($hremail, $hrname);
							$tripid = $_SESSION['tripid'];
							$usernameoftrip = $_SESSION['name'];
							$mail->addAddress('harshusid78@gmail.com', $financename);
							$mail->Subject = "SEW Eurodrive - Invoice for Trip Expense!!";
							$mail->Body = "Dear " . $financename . ",\n\n";
							$mail->Body .= "I hope this email finds you well. Attached to this email, please find the invoice for the trip expense of $usernameoftrip  from the Finance. Kindly review the invoice and process the payment accordingly.\n\n";
							$mail->Body .= "If you require any additional information or have any queries regarding the invoice, please feel free to reach out to the HR department at,\n\n";
							$mail->Body .= "$hrname \n";
							$mail->Body .= "$hremail \n"; 
							$mail->Body .= "Thank you for your attention to this matter.\n\n";
							$mail->Body .= "Best regards,\n";
							$mail->Body .= "$hrname\n";
							$mail->Body .= "Best regards,\n\n";
							$mail->Body .= "SEW-Eurodrive\n\n";
							$attachmentPath = $path; // Specify the path to the attached PDF file
							$mail->addAttachment($attachmentPath);
						    $mail->send();
                            $mail->smtpClose();
							}
                        endwhile;
						}
					}
                    else if ($document == 'ticketupload')
                    {
                        require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
                        require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\SMTP.php';
                        require 'C:\xampp\htdocs\sewflightbooking\Finalpages\PHPMailer-master\PHPMailer-master\src\Exception.php';
                        $mail = new PHPMailer(true);
							$mail->isSMTP();
							$mail->SMTPDebug  = 0;  
							$mail->Host = 'smtp.gmail.com'; // gmail SMTP server
							$mail->SMTPAuth = true;
							$mail->Username = 'harshusid78@gmail.com'; // email
							$mail->Password = 'vrnwpiotjcquqqvx'; // 16 character obtained from app password created
							$mail->Port = 465; // SMTP port
							$mail->SMTPSecure = 'ssl';
                        $empEmail=$_SESSION['userEmail'];
                        $empName=$_SESSION['empname'];
                            // Email content
                            $mail->setFrom($hremail, $hrname);
                            $mail->addAddress('sidharsh349@gmail.com', $empName);
                            $mail->Subject = 'Your Flight Ticket for Trip';
                            $mail->isHTML(true);

                            // Email body
                            $message = "Dear $empName,<br><br>";
                            $message .= "We are pleased to inform you that the flight ticket for your requested trip has been uploaded successfully. You can find the ticket attached to this email.<br><br>";
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
                            $mail->smtpClose();

                    }
                    
					else 
					{
						echo "<br/>" . mysqli_error($con);
					}
				}
				 else 
				 {
					echo "Sorry, there was an error uploading your file.";
				}
                }
            }
        }
    }
    ?>
</body>

</html>