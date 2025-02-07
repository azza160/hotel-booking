<?php

     $conn = mysqli_connect("localhost","root","","zahoteel") ;
    $booking_test = mysqli_query($conn,"SELECT * FROM booking") ; 
    $booking = [] ;
    while($rot = mysqli_fetch_assoc($booking_test)){
        $booking[] = $rot ;
    }
$i =1 ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>no</th>
            <th>idhotel</th>
            <th>idakamar</th>
            <th>nama</th>
            <th>tipe kamar</th>
            <th>checkin</th>
            <th>checkout</th>
            <th>jumlah penginap</th>
            <th>total biaya</th>
        </tr>
        <?php foreach($booking as $b) : ?>
        <tr>    
            <td><?= $i ;?></td>
            <?php $i++ ?>
            <td><?= $b['idhotel'] ;?></td>
            <td><?= $b['idkamar'] ;?></td>
            <td><?= $b['nama'] ;?></td>
            <td><?= $b['tipe kamar'] ;?></td>
            <td><?= $b['checkin'] ;?></td>
            <td><?= $b['checkout'] ;?></td>
            <td><?= $b['jumlah_penginap'] ;?></td>
            <td><?= $b['total_biaya'] ;?></td>
        </tr>    
        <?php endforeach ; ?>
    </table>
</body>
</html>