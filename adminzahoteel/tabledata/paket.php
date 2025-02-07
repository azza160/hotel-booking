<?php
require "../function/function.php" ;


$paket = tampil("SELECT * FROM paket_liburan") ;
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
    <h1>table paket liburan</h1>
    <table border="1" cellpadding="5" cellspacing="0">
    <thead>
						     			<tr>
										 	<th>No</th>
							 				<th>Nama</th>
											<th>Lokasi</th>
							 				<th>Lama</th>
							 				<th>Kapasitas</th>
							 				<th>Ketersediaan</th>
											<th>Harga</th>
                                            <th>Rating</th>
							 				<th>Actions</th>
							 			</tr>
						  			</thead>
                                      <tbody>
										<?php foreach($paket as $h) : ?>
						     				<tr>
											 <td><?= $i ; ?></td>
												<?php $i++ ; ?>
							 					<td><?= $h['nama'] ;?></td>
                                                <td><?= $h['tempat'] ;?></td>
							 					<td><?= $h['lama'] ;?></td>
                                                <td><?= $h['kapasitas'] ;?></td>
                                                <td><?= $h['ketersediaan'] ;?></td>
                                                <td><?= $h['harga'] ;?> /orang</td>
							 					<td>Bintang <?= $h['rating'] ;?></td>
												<td><?= $h['deskripsi'] ;?></td>
                                        </tr>
                                        <?php endforeach ;?>
                                        </tbody>    
    </table>
</body>
</html>