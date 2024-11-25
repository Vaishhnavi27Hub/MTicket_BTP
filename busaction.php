<?php
include 'connect.php';
session_start();

if ($_SESSION['log'] == '') {
    header("location:index.php");
}

include 'header.php';

$source = $_POST['source'];
$dest = $_POST['dest'];
$no = $_POST['number'];

if ($source == $dest) {
    echo "<h1><center>Selected source and destination are the same, please refill the details.</center></h1><br><br>";
    echo '<center>
            <form action="bookBUS.php">
                <button style="background-color: black; padding: 25px 70px; align=center;">
                    <span style="color:white;"><h3>Go back</h3></span>
                </button>
            </form><br><br>';
} else {
    $sql_price = "SELECT * FROM `pricebus` WHERE `source` LIKE '$source' AND `dest` LIKE '$dest'";
    $result = $connect->query($sql_price);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $final = $row["Price"] * $no;
            $busnum = $row["Bus_No."];

            echo "<br><br><br><h1><center>Total fare of bus number <b>" . $busnum . "</b> from <b>" . $source . " to " . $dest . "</b> is: ₹ <b>" . $final . "</b></center></h1><br><br>";
            echo '<center>
                    <form action="buspay.php">
                        <button style="background-color: black; padding: 25px 70px; align=center;">
                            <span style="color:white;"><h3>Checkout</h3></span>
                        </button>
                    </form><br><br>

                    <form action="bookBUS.php">
                        <button style="background-color: black; padding: 25px 70px; align=center;">
                            <span style="color:white;"><h3>Go back</h3></span>
                        </button>
                    </form><br><br>';
        }
        $_SESSION['final'] = $final;
        $_SESSION['source'] = $source;
        $_SESSION['dest'] = $dest;
        $_SESSION['busnum'] = $busnum;
        $_SESSION['NoOfpass'] = $no;
    } else {
        echo "<h1><center>No buses available from $source to $dest. Please try again later.</center></h1>";
        echo '<center>
                <form action="bookBUS.php">
                    <button style="background-color: black; padding: 25px 70px; align=center;">
                        <span style="color:white;"><h3>Go back</h3></span>
                    </button>
                </form><br><br>';
    }
}
?>
