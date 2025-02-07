<?php

     $conn = mysqli_connect("localhost","root","","zahoteel") ;
    $booking_test = mysqli_query($conn,"SELECT * FROM pesanpaketliburan") ; 
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
    <h1>table Riwayat pemesanan paket</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>no</th>
            <th>idpaket</th>
            <th>nama paket</th>
            <th>nama pemesan</th>
            <th>jumlah orang</th>
            <th>tanggal berangkat</th>
            <th>tanggal selesai</th>
            <th>total biaya</th>
        </tr>
        <?php foreach($booking as $b) : ?>
        <tr>    
            <td><?= $i ;?></td>
            <?php $i++ ?>
            <td><?= $b['idpaket'] ;?></td>
            <td><?= $b['nama paket'] ;?></td>
            <td><?= $b['nama pemesan'] ;?></td>
            <td><?= $b['jumlah orang'] ;?></td>
            <td><?= $b['tanggal keberangkatan'] ;?></td>
            <td><?= $b['tanggal selesai'] ;?></td>
            <td><?= $b['total biaya'] ;?></td>
        </tr>    
        <?php endforeach ; ?>
    </table>
</body>
</html>