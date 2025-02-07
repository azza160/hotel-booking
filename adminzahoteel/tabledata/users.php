<?php
require "../function/function.php" ;


$users = tampil("SELECT * FROM users") ;
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
    <h1>table users</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>no</th>
            <th>email</th>
            <th>username</th>
            <th>password</th>
            <th>status</th>
        </tr>
        <?php foreach($users as $h) :?>
        <tr>
            <td><?= $i ;?></td>
            <?php $i++ ;?>
            <td><?= $h['email'] ;?></td>
            <td><?= $h['username'] ;?></td>
            <td><?= $h['password'] ;?></td>
            <td><?= $h['status']?> bintang</td>
        </tr>
        <?php endforeach ; ?>
    </table>
</body>
</html>