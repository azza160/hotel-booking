<?php
require "../function/function.php" ;


$hotel = tampil("SELECT * FROM HOTEL") ;
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
    <h1>table data hotel</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>no</th>
            <th>idhotel</th>
            <th>nama</th>
            <th>lokasi</th>
            <th>rating</th>
        </tr>
        <?php foreach($hotel as $h) :?>
        <tr>
            <td><?= $i ;?></td>
            <?php $i++ ;?>
            <td><?= $h['idhotel'] ;?></td>
            <td><?= $h['nama'] ;?></td>
            <td><?= $h['lokasi'] ;?></td>
            <td><?= $h['rating']?> bintang</td>
        </tr>
        <?php endforeach ; ?>
    </table>
</body>
</html>