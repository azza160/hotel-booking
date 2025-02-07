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
	</head>
	<body>
	
	</body>
	</html>

<!-- end kode html -->


<?php
session_start() ;
// Memverifikasi kode yang dimasukkan oleh pengguna
if(isset($_POST['enter'])){
    $inputCode = $_POST['kode'];

    // Mendapatkan kode verifikasi dari sesi atau database sesuai kebutuhan
    $verificationCode = $_SESSION['verification_code'];

    if ($inputCode == $verificationCode) {
        echo "

            <script>
                document.location.href='registrasi.php' ;
            </script>
        
        ";
        // Lakukan tindakan setelah verifikasi sukses
    } else {
        $text = 'proses gagal kode yang anda masukan tidak valid!' ;
        unset($_SESSION['email_regist']);
        unset($_SESSION['username_regist']);
        unset($_SESSION['password_regist']);
        unset($_SESSION['status_regist']);
        echo "
            <script>
                Swal.fire({
                    title: 'Gagal',
                    text: '$text',
                    icon: 'error'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            </script> " ;
    }
}



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

        <title>Verifikasi Zahoteel</title>
    </head>
    <body>
        <div class="container">
            <div class="login__content">
                <img src="assets/img/bg-login.png" alt="login image" class="login__img">

                <form action="" method="post" class="login__form">

                    <div>
                        <h1 class="login__title">
                            <span>Verifikasi Code</span> 
                        </h1>
                        <p class="login__description">
                            Verifikasi Code untuk melanjutkan proses registrasi.
                        </p>
                    </div>
                    
                    <div>
                        <div class="login__inputs">
                            <div>
                                <label for="" class="login__label">Kode</label>
                                <input type="number" placeholder="Masukan kode verifikasi" name="kode" required class="login__input">
                            </div>
                        </div>
                    </div>

                    <div>
                         <button class="login__button login__button-ghost" type="submit" name="enter">Enter</button>
                    </div>
                </form>
            </div>
        </div>


        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>
    </body>
</html>