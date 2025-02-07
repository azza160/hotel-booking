<?php
require "../function/function.php" ;


$kamar = tampil("SELECT * FROM kamar") ;
$i = 1

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>table kamar hotel</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>no</th>
            <th>idhotel</th>
            <th>tipe</th>
            <th>biaya</th>
            <th>ketersediaan</th>
            <th>rating</th>
            <th>kapasitas</th>
        </tr>
        <?php foreach($kamar as $h) :?>
        <tr>
            <td><?= $i ;?></td>
            <?php $i++ ;?>
            <td><?= $h['idhotel'] ;?></td>
            <td><?= $h['tipe'] ;?></td>
            <td>Rp.<?= number_format($h['harga']) ;?></td>
            <td><?= $h['ketersediaan'] ;?></td>
            <td><?= $h['rating']?> bintang</td>
            <td><?= $h['kapasitas'] ;?> orang</td>
        </tr>
        <?php endforeach ; ?>
    </table>
</body>
</html>