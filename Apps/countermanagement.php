<!DOCTYPE html
Author: Deeksha Sridhar
Last Modified: 14/09/20222
>
<?php
$hostname = "localhost";
$username = "tmsadmin";
$password = "]qIqF_k1)5P+<vcd";
$database = "tms";


$connection = new mysqli($hostname,$username,$password,$database);

// Displaying error message if connection could not be established with database
if(!$connection){
    die();
    echo "No Connection! Please Try Again Later!";
}
?>
<html>
    <head>
        <!-- Displaying web page header -->
        <H1 font-family: "Times New Roman"> Counter Management</H1>
        <link rel="stylesheet" href="queueticketing.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <br>
        <br>
        <br>
        <br>
        <br>
        
        <section class="counter">
            <?php
            $countersquery = "SELECT counter, counter_status FROM `counter`";
            $allcounter = $connection -> query($countersquery);
            while($singlecounter = mysqli_fetch_array($allcounter)){
            if($singlecounter['counter_status'] == "off"){
                $counterstatus = "go-online";
                $goonline = "Go Online";
            }else{
                $counterstatus = "go-offline";
                $goonline = "Go Offline";
            }
            // Displaying the Go Online/Offline, Complete Current and Call Next buttons
            print_r('<div class="individual-counter">
                    <form method="post">
                        <input type="hidden" name="counter" value = "'.$singlecounter["counter"].'">
                        <div class="counter-number">'.$singlecounter["counter"].'</div>
                        <div class="counterbutton-wrapper '.$counterstatus.'">
                            <button type="submit" name="onlineoffline">'.$goonline.'</button>
                           <button type="submit" name="completecurr">Complete Current</button>
                            <button type="submit" name="nextnumber">Call Next</button>
                        </div> 
                    </form> 
                    </div>
                </div>');
            }
            ?>
        </section>
    </body>
<?php

    // Creating query to call the next customer
    if(isset($_POST['nextnumber'])){
        $currentlyservingnum_query = "SELECT NUM FROM ticket WHERE NUM_status ='pending' ORDER BY NUM asc LIMIT 1";
        $previousservingnumquery = "SELECT NUM FROM ticket WHERE (NUM_status ='serving' AND `counter`='".$_POST['counter']."') ORDER BY NUM asc LIMIT 1";
        $donepreviousnum = $connection -> query($previousservingnumquery);
        if(mysqli_num_rows($donepreviousnum) == 1){
            $thepreviousnum = mysqli_fetch_array($donepreviousnum);
            $donenumquery = "UPDATE ticket SET NUM_status = 'complete' WHERE NUM = '".$thepreviousnum['NUM']."'";
            $connection -> query($donenumquery);
        }
        // If a number is currently being served, update the counter status to busy
        $currentlyservingnum = $connection->query($currentlyservingnum_query);
        if(mysqli_num_rows($currentlyservingnum) != 0){
            $theservingnum = mysqli_fetch_array($currentlyservingnum);
            $counterbusy = "UPDATE `counter` SET counter_status = 'busy' WHERE `counter`='".$_POST['counter']."'";

            // Creating query to update the ticket which is currently being served and update the counter status
            $callnextquery = "UPDATE ticket SET NUM_status = 'serving',`counter`='".$_POST['counter']."' WHERE NUM = '".$theservingnum['NUM']."'";
            if(($connection -> query($callnextquery)) and ($connection -> query($counterbusy))){
                echo "<script> alert('The Next Number has been called to ".$_POST['counter']."')</script>";
                echo "<script>
                            window.history.replaceState( null, null, window.location.href );
                    </script>";
            }else{
                // Displaying error message if query could not be created
                echo "<script> alert('There was an Error, Please Try Again Later!')</script>";
                echo "<script>
                            window.history.replaceState( null, null, window.location.href );
                    </script>";
            }
        }else{
            // Displaying popup if there are no tickets left in the waiting queue
            echo "<script> alert('There are no more tickets in the waiting queue')</script>";
            echo "<script>
                        window.history.replaceState( null, null, window.location.href );
                </script>";
        }
    }

    // Creating query to mark the current ticket as complete
    if(isset($_POST['completecurr'])){
        $previousservingnumquery = "SELECT NUM FROM ticket WHERE (NUM_status ='serving' AND `counter`='".$_POST['counter']."') ORDER BY NUM asc LIMIT 1";
        $donepreviousnum = $connection -> query($previousservingnumquery);
        if(mysqli_num_rows($donepreviousnum) == 1){
            $thepreviousnum = mysqli_fetch_array($donepreviousnum);
            $donenumquery = "UPDATE ticket SET NUM_status = 'complete' WHERE NUM = '".$thepreviousnum['NUM']."'";
            $counteronline = "UPDATE `counter` SET counter_status = 'on' WHERE `counter`='".$_POST['counter']."'";

            if (($connection -> query($counteronline)) and ($connection -> query($donenumquery))){
                echo "<script> alert(' ".$_POST['counter']." is available now')</script>";
                echo "<script>
                            window.history.replaceState( null, null, window.location.href );
                    </script>";
            }else{
                // Displaying error message when query could not be created
                echo "<script> alert('There was an Error, Please Try Again!')</script>";
                echo "<script>
                            window.history.replaceState( null, null, window.location.href );
                    </script>";
            }
        }else{
            // Displaying pop up that the counter is available
            echo "<script> alert(' ".$_POST['counter']." is available')</script>";
            echo "<script>
                        window.history.replaceState( null, null, window.location.href );
                </script>";
        }
    }

    // Creating query to make the counter go online/offline
    if(isset($_POST['onlineoffline'])){
        $thecounterstatquery = "SELECT counter_status FROM `counter` WHERE `counter`= '".$_POST['counter']."'";
        $thecounterstat = $connection -> query($thecounterstatquery);
        $counterstatus = mysqli_fetch_array($thecounterstat);

        if($counterstatus['counter_status'] == "on"){
            $counteroffline = "UPDATE `counter` SET counter_status = 'off' WHERE `counter`='".$_POST['counter']."'";
            $connection -> query($counteroffline);
            // Displaying popup that the counter is offline
            echo "<script> alert(' ".$_POST['counter']." is now offline')</script>";
            echo "<script>
                        window.history.replaceState( null, null, window.location.href );
                </script>";
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=\"countermanagement.php\">";

        }else if($counterstatus['counter_status'] == "off"){
            $counteronline = "UPDATE `counter` SET counter_status = 'on' WHERE `counter`='".$_POST['counter']."'";
            $connection -> query($counteronline);
            // Displaying popup that the counter is online
            echo "<script> alert(' ".$_POST['counter']." is now online')</script>";
            echo "<script>
                        window.history.replaceState( null, null, window.location.href );
                </script>";
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=\"countermanagement.php\">";
        }else if($counterstatus['counter_status'] == "busy"){
            // Displaying popup that the counter is busy
            echo "<script> alert(' ".$_POST['counter']." is still busy')</script>";
            echo "<script>
                        window.history.replaceState( null, null, window.location.href );
                </script>";
        }
    }
?>

</html>