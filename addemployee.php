<?php require_once 'dbconnection.php';
require_once 'adminmenubar.php';

$query1 = "SELECT colleague FROM `b_emp` WHERE tripid='" . $_SESSION['tripid'] . "'";
$query2 = "SELECT emp_name FROM `b_usermaster` WHERE work_level BETWEEN 0 AND 7 AND status='Active' ";
$query3 = "SELECT b_usermaster.emp_name FROM `b_usermaster` JOIN `b_tripregister` ON b_tripregister.username = b_usermaster.userid WHERE b_tripregister.tripid='" . $_SESSION['tripid'] . "'";

$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
$username = $row3['emp_name'];

$result1 = mysqli_query($con, $query1);
$colleagues = array();
while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
    $colleagues[] = $row1['colleague'];
}

$query4 = $query2 . " AND emp_name NOT IN ('" . implode("','", $colleagues) . "') AND emp_name != '$username'";
$result5 = mysqli_query($con, $query4);
?>
<html>

<head>
    <style>
        select[name="empname[]"] {
            margin-top: 10px;
            font-size: 15px;
            font-family: 'Times New Roman', Times, serif;
            border-radius: 10px;
            width: 350px;
            height: 100px;
        }

        input[type="submit"] {
            text-align: center;
            background-color: #dddddd;
            cursor: pointer;
            border-radius: 4px 4px 4px 4px;
            box-shadow: 2px 2px 2px #777777;
        }

        input[type="submit"]:hover {
            background-color: #2C353C;
            color: white;
            transform: scale(1.12);
            transition: ease 0.15s;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td,
        table th {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #dddddd;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>

<body>
    <?php
    // Display added employees in a table
    $addedEmployeesQuery = "SELECT * FROM `b_emp` JOIN `b_usermaster` ON b_usermaster.emp_name = b_emp.colleague WHERE tripid='" . $_SESSION['tripid'] . "'";
    $addedEmployeesResult = mysqli_query($con, $addedEmployeesQuery);
    ?>

    <h2>Colleagues:</h2>
    <table>
        <tr>
            <th>Employee Name</th>
            <th></th>
        </tr>
        <?php while ($addedEmployee = mysqli_fetch_array($addedEmployeesResult, MYSQLI_ASSOC)) : ?>
            <tr>
                <td>
                    <div title="<?php echo $addedEmployee['userid']; ?>"><?php echo $addedEmployee['colleague']; ?></div>
                </td>
                <td>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to remove this employee?');">
                        <input type="hidden" name="removeEmployee" value="<?php echo $addedEmployee['colleague']; ?>">
                        <input type="submit" name="removeSubmit" value="Remove">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <form method='POST'>
        <center>
            <h2>Select Other Employees:</h2>
            <select name="empname[]" multiple="multiple">
                <?php while ($names = mysqli_fetch_array($result5, MYSQLI_ASSOC)) :; ?>
                    <option value="<?php echo $names["emp_name"]; ?>">
                        <?php echo $names["emp_name"]; ?>
                    </option>
                <?php endwhile; ?>
            </select>
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
            <br>
            <br>
            <input type="submit" name="asubmit" value="Done">
        </center>
    </form>

    <?php
    // Remove employee when remove button is clicked
    if (isset($_POST["removeSubmit"])) {
        $removeEmployee = $_POST['removeEmployee'];
        $removeQuery = "DELETE FROM `b_emp` WHERE tripid='" . $_SESSION['tripid'] . "' AND colleague='$removeEmployee'";
        $removeResult = mysqli_query($con, $removeQuery);

        if ($removeResult) {
            echo "<script>alert('Employee removed successfully');</script>";
            echo "<script>location.href='adminregister.php'</script>";
            exit();
        } else {
            echo "<script>alert('Error: Failed to remove employee');</script>";
        }
    }


    if (isset($_POST["asubmit"])) {
        // Check if the trip ID is set and not empty
        if (isset($_SESSION['tripid']) && !empty($_SESSION['tripid']) && isset($_POST['empname'])) {
            $addemp = $_POST['empname'];

            foreach ($addemp as $value) {
                $sqlquery1 = "INSERT INTO `b_emp` (`tripid`, `colleague`) VALUES ('{$_SESSION['tripid']}', '$value')";
                $result2 = mysqli_query($con, $sqlquery1);
            }

            if ($result2) {
                echo "<script>alert('Employees Added Successfully');</script>";
                echo "<script>location.href='adminregister.php'</script>";
                exit();
            } else {
                echo "<script>alert('Error: Failed to add colleagues');</script>";
            }
        } else {
            echo "<script>alert('Error: Failed to add colleagues');</script>";
        }
    }
    ?>
</body>

</html>