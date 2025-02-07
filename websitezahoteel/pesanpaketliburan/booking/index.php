<!-- kode html untuk menyimpan beberapa link library yang digunakan -->
<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            *{
                font-family : 'poppins' ;
            }
        </style>
	</head>
	<body>
	
	</body>
	</html>

<!-- end kode html -->



<?php
    require "../../../adminzahoteel/function/function.php" ;

    //ambil data dari variabel get
    $idpaket = $_GET['idpaket'] ;
    

    //ambil data dari database sesuai dengan id yang diberikan
    $paket = tampil("SELECT * FROM paket_liburan WHERE id = $idpaket")[0] ;





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Beautiful glass login form - Bedimcode</title>
</head>
<body>
    <div class="container">
        <div class="login__content">
            

            <form action="../pesan.php" class="login__form" method="post">
                <input type="hidden" name="harga" value="<?= $paket['harga'] ; ?>">
                <input type="hidden" name="idpaket" value="<?= $paket['id'] ; ?>">
                <input type="hidden" name="lama" value="<?= $paket['lama'] ; ?>">
                <input type="hidden" name="kapasitas" value="<?= $paket['kapasitas'] ; ?>">
                <div>
                    <h1 class="login__title">
                        <span>Halaman pemesanan </span>Paket liburan
                    </h1>
                    <p class="login__description">
                        Isi data dibawah untuk melakukan pemesanan
                    </p>
                </div>
                
                <div>
                    <div class="login__inputs">
                        <div>
                            <label for="" class="login__label">Nama Paket</label>
                            <input type="text"  required name="namapaket" value="<?= $paket['nama'] ;?>" class="login__input">
                        </div>

                        <div>
                            <label for="" class="login__label">Nama</label>

                            <div class="login__box">
                                <input type="text" placeholder="Masukkan nama anda" required class="login__input" name="nama">
                            </div>
                        </div>

                        <div>
                            <label for="" class="login__label">Jumlah Orang</label>
                            <input type="number" placeholder="Masukkan jumlah orang" required class="login__input" name="jumlah">
                        </div>

                        <div>
                            <label for="" class="login__label">Tanggal Keberangkatan</label>
                            <input type="date" required class="login__input" name="tanggal_keberangkatan">
                        </div>
                    </div>
                </div>

                <div class="buttons_container">
                    <div class="login__buttons">
                        <button class="login__button" type="submit" name="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
</body>
</html>
