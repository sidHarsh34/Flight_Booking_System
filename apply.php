<?php include 'dbconnection.php';
require_once 'usermenubar.php';
?>

<!DOCTYPE html>
<html>
<script type="text/javascript" src="multiselect-dropdwon.js"></script>

<head>
    <title>
        Flight Booking form
    </title>
    <style>
        body {
            align-items: center;
        }

        .left {
            margin-left: 90px;
        }

        .left1 {
            margin-left: 180px;
        }

        .left2 {
            margin-left: 40px;
        }

        .left3 {
            margin-left: 100px;
        }

        input[type="radio"],
        input[type="date"] {
            margin-top: 10px;
            font-size: 15px;
            font-family: 'Times New Roman', Times, serif;
            background-color: #e6ffff;
            border-radius: 7px 7px 7px 7px;
        }

        input[type="checkbox"] {
            margin-top: 10px;
            font-size: 15px;
            font-family: 'Times New Roman', Times, serif;
        }

        select {
            margin-top: 10px;
            font-size: 15px;
            font-family: 'Times New Roman', Times, serif;
            background-color: #e6ffff;
            border-radius: 7px 7px 7px 7px;
        }

        textarea {
            margin-top: 10px;
            font-size: 15px;
            font-family: 'Times New Roman', Times, serif;
            width: 400px;
            height: 50px;
            background-color: #e6ffff;
            border-radius: 7px 7px 7px 7px;
        }

        label {
            font-size: 18px;
            font-family: 'Times New Roman', Times, serif;
        }

        .container {
            background-color: #cceeff;
            border-radius: 7px 7px 7px 7px;
            border-width: 25px;
            margin: auto;
            margin-top: 3%;
            width: 530px;
            padding: 30px;
            box-shadow: 0px 0px 10px #888;
            max-height: 100%;
            display: flex;
        }

        select[name="empname[]"] {
            margin-top: 10px;
            font-size: 15px;
            font-family: 'Times New Roman', Times, serif;
            border-radius: 10px;
            width: 500px;
            height: 100px;
        }

        .container button[type="submit"] {
            width: 15%;
            margin-left: 200px;
            text-align: center;
            background-color: #dddddd;
            cursor: pointer;
            border-radius: 4px 4px 4px 4px;
            box-shadow: 2px 2px 2px #777777;
        
        }

        .container button[type="submit"]:hover {
            background-color: #2C353C;
            color: white;
            transform: scale(1.12);
            transition: ease 0.15s;
            cursor: pointer;
        }

        /* .container button[type="button"] {
            width: 10%;
            background-color: #cccccc;
            cursor: pointer;
            border-radius: 7px 7px 7px 7px;
            box-shadow: 0px 0px 2px #333333;
        }

        .container button[type="button"]:hover {
            background-color: #ff5050;
        } */
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

</head>

<body>

    <?php
    $sql = "select * from `b_location`";
    $all_location = mysqli_query($con, $sql);
    ?>

    <div class="container" method="POST">
        <form method="POST" action="showlist.php">
            <h2 style="text-align: center;">Book a Flight</h2>
            <hr>
            <b><label for="type">Trip Type</label><br></b>
            <input type="radio" name="type" value="One Way" id="oneway" checked>One Way Trip
            <input type="radio" name="type" value="Round" class="left2" id="round">Round Trip
            <br><br>
            <b><label for="from">From Location</label></b>
            <b><label for="to" class="left1">To Location</label></b><br>
            <select required name="fromlocation">
                <?php
                while ($location = mysqli_fetch_array($all_location, MYSQLI_ASSOC)) :;
                ?>
                    <option value="<?php echo $location["location"]; ?>">
                        <?php echo $location["location"]; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <select class="left" required name="tolocation">
                <?php
                mysqli_data_seek($all_location, 0); // Reset the query result pointer
                while ($location1 = mysqli_fetch_array($all_location, MYSQLI_ASSOC)) :;
                ?>
                    <option value="<?php echo $location1["location"]; ?>">
                        <?php echo $location1["location"]; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <br><br>
            <b><label> Reason For Travel</label></b>
            <br>
            <textarea required name="reasonfortravel" rows="5" columns="45" placeholder="Mention your reasons to travel"></textarea>
            <br><br>
            <b><label>Mode of Travel</label></b>
            <br>
            <input type="checkbox" name="mode" value="Flight" checked="checked">Flight Booking
            <input type="checkbox" name="mode" value="Train">Train Booking
            <input type="checkbox" name="mode" value="Hotel">Hotel Booking
            <input type="checkbox" name="mode" value="Cab">Cab Booking
            <br><br>
            <br>
            <b><label for="departureDate">Departure Date</label></b>
            <br>
            <input type="date" required id="departuredate" value="departuredate" name="departuredate" onchange="validatedepdate()">
            <script>
                function validatedepdate() {
                    var inputDate = new Date(document.getElementById("departuredate").value);
                    var today = new Date();

                    if (inputDate < today) {
                        alert("Please select a valid date.");
                        document.getElementById("departuredate").value = "";
                    }
                }
            </script>
            <br><br>
            <div id="returnDateContainer" style="display: none;">
                <b><label for="returnDate">Return Date</label></b>
                <br>
                <input type="date" id="returndate" name="returndate" value="returndate" onchange="validateDate()">
                <script>
                    function validateDate() {
                        var inputDate = new Date(document.getElementById("returndate").value);
                        var today = new Date();

                        if (inputDate < today) {
                            alert("Please select a valid date.");
                            document.getElementById("returndate").value = "";
                        }
                    }
                </script>
            </div>
            <br>

            <?php
            $sql6 = "select * from `b_usermaster` where userid='" . $_SESSION['username'] . "'";
            $user_location_result = mysqli_query($con, $sql6);
            $user_location_row = mysqli_fetch_array($user_location_result);
            $user_location = $user_location_row['supportregion'];

            $sql7 = "select * from `b_vendormaster` where supportregion='$user_location'";
            $vendor_name = mysqli_query($con, $sql7);
            ?>

            <b><label>Choose a Vendor</label></b><br>
            <select name="vendor" id="vendor">
                <?php
                while ($ven_name = mysqli_fetch_array($vendor_name, MYSQLI_ASSOC)) :;
                ?>
                    <option value="<?php echo $ven_name["vendorname"]; ?>">
                        <?php echo $ven_name["vendorname"]; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <br><br>

            <label style="font-size:18px;">Would you like to add colleagues to this trip?</label>
            <input type="radio" name="checkbutton" value="yeschecked" id="yes">Yes
            <input type="radio" name="checkbutton" checked value="nochecked" id="no">No
            <div id="additionalEmployees" style="display: none;">
                <?php
                $sql3 = "SELECT * from `b_usermaster` where status='Active' and work_level between 0 and 4";
                $all_name = mysqli_query($con, $sql3);
                ?>
                <select name="empname[]" multiple="multiple">
                    <?php
                    while ($names = mysqli_fetch_array($all_name, MYSQLI_ASSOC)) :;
                    ?>
                        <option value="<?php echo $names["emp_name"]; ?>">
                            <?php echo $names["emp_name"]; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <br><br>
            <script>
                const roundTripRadio = document.getElementById("round");
                const oneWayTripRadio = document.getElementById("oneway");
                const returnDateContainer = document.getElementById("returnDateContainer");
                const yesCheck = document.getElementById("yes");
                const noCheck = document.getElementById("no");
                const additionalEmployees = document.getElementById("additionalEmployees");

                roundTripRadio.addEventListener("change", function() {
                    if (this.checked) {
                        returnDateContainer.style.display = "block";
                    } else {
                        returnDateContainer.style.display = "none";
                    }
                });

                oneWayTripRadio.addEventListener("change", function() {
                    if (this.checked) {
                        returnDateContainer.style.display = "none";
                    } else {
                        returnDateContainer.style.display = "block";
                    }
                });

                yesCheck.addEventListener("change", function() {
                    if (this.checked) {
                        additionalEmployees.style.display = "block";
                    } else {
                        additionalEmployees.style.display = "none";
                    }
                });

                noCheck.addEventListener("change", function() {
                    if (this.checked) {
                        additionalEmployees.style.display = "none";
                    } else {
                        additionalEmployees.style.display = "block";
                    }
                });
            </script>
            <script>
                // Initialize Select2 for the multiple select dropdown
                $(document).ready(function() {
                    $('select[name="empname[]"]').select2({
                        multiple: true,
                        placeholder: "Select employees",
                        multiselect: true,
                        allowClear: true
                    });
                });
            </script>
            <b><label>Remarks</label></b><br>
            <textarea name="remarks" rows="5" columns="45" placeholder="Any additional remarks or special requests"></textarea>
            <br><br>
            <button type="submit" name="submitbutton" id="book">Next</button>
        </form>
    </div>

</body>

</html>