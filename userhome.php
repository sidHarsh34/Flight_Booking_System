<?php require_once "usermenubar.php" ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>

        <style>
            .maincontainer {
            background-color: #2c353c;
            width: 100%;
            max-height: 40%;
            display: flex;
        }

        .slidecontent {
            background: url(slidebg.jpg);
            /* background-color: rgb(181, 255, 238); */
            height: 30%;
            padding: 1%;
            margin-left: 2%;
            /* animation-name: trial;
            animation-duration: 3s;
            animation-iteration-count: infinite;
            position: relative; */
            flex: 1;
        }

        /* @keyframes trial {} */

        .content {
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            font-size: 300%;
        }

        .wlcmmessage {
            /* float: right; */
            color: rgb(255, 255, 255);
            font-size: 120%;
            flex: 1;
            padding: 0.7%;
        }
        </style>
    </head>
    <body>
    <div class="maincontainer">
        <div class="slidecontent">
            <p class="content">We Drive tomorrow's<br>businesses. <br> We Drive the world.</p>
        </div>
        <!-- <div class="slidecontent">
                    <p class="content">Each an expert.<br>Together a team <br> like no other</p>
                </div>
                <div class="slidecontent">
            <p class="content">Our workplace<br>empowers us. <br> To outdo ourselves.</p>
        </div>
        <div class="slidecontent">
            <p class="content">Beacause no other<br>place <br> is SEW India.</p>
        </div> -->

        <div class="wlcmmessage">
            <p> Hello <?php echo $_SESSION['name'];?>! <br/>
                Welcome to Sew Eurodrives, dedicated flight booking platform! We are delighted to have you on board.<br />
                Designed exclusively for our valued employees, this portal offers you a world of possibilities for your
                business travel needs. With a user-friendly interface and a vast array of flight options,
                we aim to make your journey as seamless and efficient as possible. Whether you're jetting off to a
                client meeting or attending a conference, trust us to take care of your travel
                arrangements. Enjoy the convenience and reliability of booking flights with Sew Eurodrives. Happy travels!
            </p>
        </div>
    </div>
</body>

</html>