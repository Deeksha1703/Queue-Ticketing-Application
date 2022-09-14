<!DOCTYPE html>
<?php
$hostname = "localhost";
$username = "tmsadmin";
$password = "]qIqF_k1)5P+<vcd";
$database = "tms";

// Displaying an error message if connection could not be established with database
$connection = new mysqli($hostname,$username,$password,$database,3306);
if(!$connection){
    die();
    echo "No Connection! Please Try Again Later!";
}
?>
<html>
    <head>
        <!-- Displaying web page header -->
        <H1 font-family: "Times New Roman"> Customer View </H1>
        <link rel="stylesheet" href="queueticketing.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <?php
    //  Creating query to allow user to allow user to take tickwt
    if(isset($_POST['taketicket'])){
        $taketicket = "INSERT INTO ticket (`NUM_status`, `counter`) VALUES('pending',null)";
        if($connection -> query($taketicket)){
            $latestnumberquery = "SELECT NUM FROM ticket ORDER BY NUM desc";
            $latestnumber = $connection -> query($latestnumberquery);
            $getnumber = mysqli_fetch_array($latestnumber);
            echo "<script> alert('Your Ticket Number is ".$getnumber['NUM']."')</script>";
            echo "<script>
                        window.history.replaceState( null, null, window.location.href );
                </script>";

        }else{
            // Displaying error message of connection could not be establisehd
            echo "<script> alert('There was an Error, Please Try Again Later!')</script>";
            echo "<script>
                        window.history.replaceState( null, null, window.location.href );
                </script>";
        }
    }
    ?>
    <body>
        <form method="post">
            <section class="main">
                <div class="main-box">
                    <div class="box-wrap">
                    <?php
                        // Displaying the number that is currently being served along with the number that was served previously
                        $currentlyservingnum_query = "SELECT NUM FROM ticket WHERE NUM_status ='pending' ORDER BY NUM asc LIMIT 1";
                        $currentlyservingnum = $connection->query($currentlyservingnum_query);
                        $lastnumquery = "SELECT NUM FROM ticket ORDER BY NUM desc LIMIT 1";
                        $lastnum = $connection->query($lastnumquery);
                        if((mysqli_num_rows($lastnum) != 0)and(mysqli_num_rows($currentlyservingnum) != 0)){
                            if(($num1 = mysqli_fetch_array($currentlyservingnum)) and ($num2 = mysqli_fetch_array($lastnum))){
                                print_r('<div>Now Serving:</div><div>'.$num1["NUM"].'</div>
                                        <div>Last Number:</div><div>'.$num2["NUM"].'</div>');
                            }
                        }else{
                            print_r('<div>Now Serving:</div><div>-</div>
                                    <div>Last Number:</div><div>-</div>');
                        }
                    ?>
                    </div>    
                    <!-- Displaying button for customer to take a ticket number -->
                    <div class="button-wrapper"><button type="submit" name="taketicket">Take a Number</button></div>
                </div>
            </section>
        </form>
        <section class="display-counters">
            <?php
            
            // Displaying the counter along with the ticket which is currently being served and the signal to display whether the counter is busy or not
            $counterquery = "SELECT counter, counter_status FROM counter";
            $counters = $connection -> query($counterquery);
            if(mysqli_num_rows($counters) > 0){
                while($singlecounter = mysqli_fetch_array($counters)){
                    $currentticketquery = "SELECT NUM,NUM_status,counter FROM ticket WHERE (NUM_status = 'serving' AND `counter` = '".$singlecounter['counter']."')";
                    $ticketserving = $connection -> query($currentticketquery);
                    if(mysqli_num_rows($ticketserving) == 1){
                        $currentticket = mysqli_fetch_array($ticketserving);
                        $currentlyserving_number = $currentticket['NUM'];
                    }else if($singlecounter['counter_status'] === "off"){
                        $currentlyserving_number = "Offline";
                    }else{
                        $currentlyserving_number = "";
                    }

                    print_r('<div class="display-counters-box '.$singlecounter["counter_status"].'">
                                <div class="signal-wrapper"><div class="signal"></div></div>
                                <div class="counter"> '.$singlecounter["counter"].' </div>
                                <div class="currently-serving">'.$currentlyserving_number.'</div>
                            </div>');
                }
            }
            ?>
        </section>
    </body>
    <!-- Auto-Refreshing the page every 4 seconds -->
    <meta http-equiv="refresh" content="4" /> 
</html>