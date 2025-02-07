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
    $idkamar = $_GET['idkamar'] ;
    $idhotel = $_GET['idhotel'] ;

    //ambil data dari database sesuai dengan id yang diberikan
    $kamar = tampil("SELECT * FROM kamar WHERE id = $idkamar")[0] ;


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

    <title>Booking kamar</title>
</head>
<body>
    <div class="container">
        <div class="login__content">
            

            <form action="../booking.php" class="login__form" method="post">
                <input type="hidden" name="harga" value="<?= $kamar['harga'] ; ?>">
                <input type="hidden" name="idkamar" value="<?= $kamar['id'] ; ?>">
                <input type="hidden" name="kapasitas" value="<?= $kamar['kapasitas'] ; ?>">
                <input type="hidden" name="idhotel" value="<?= $idhotel ;?>">
                <div>
                    <h1 class="login__title">
                        <span>Halaman</span> Booking
                    </h1>
                    <p class="login__description">
                        Isi data dibawah untuk melakukan pemesanan kamar
                    </p>
                </div>
                
                <div>
                    <div class="login__inputs">
                        <div>
                            <label for="" class="login__label">Nama</label>
                            <input type="text" placeholder="Masukkan nama Anda" required name="nama" class="login__input">
                        </div>

                        <div>
                            <label for="" class="login__label">Tipe Kamar</label>

                            <div class="login__box">
                                <input type="text" placeholder="Masukkan tipe kamar" required class="login__input" id="input-kamar" name="tipe" value="<?= $kamar['tipe'] ;?>">
                            </div>
                        </div>

                        <div>
                            <label for="" class="login__label">Jumlah Penginap</label>
                            <input type="number" placeholder="Masukkan jumlah orang" required class="login__input" name="jumlah">
                        </div>

                        <div>
                            <label for="" class="login__label">Check-in</label>
                            <input type="date" required class="login__input" name="checkin">
                        </div>

                        <div>
                            <label for="" class="login__label">Check-out</label>
                            <input type="date" required class="login__input" name="checkout">
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
