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
                font-family: 'poppins';
            }
        </style>
	</head>
	<body>
	
	</body>
	</html>

<!-- end kode html -->









<?php
require "../adminzahoteel/function/function.php" ;
session_start() ;


    //cek apakah cokie sudah ada atau belum
        if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){

            $no = $_COOKIE['id'] ;
            $key = $_COOKIE['key'] ;

            $result = mysqli_query($conn,"SELECT username FROM users WHERE id = $no") ;
            $usernames = mysqli_fetch_assoc($result) ;
            if($key === hash("ripemd160",$usernames['username'])){
                $_SESSION['login'] = true  ;
            }
   
        }

    //cek apakah session sudah ada atau belum  
        if(isset($_SESSION['login'])){
            header("Location: ../websitezahoteel/index.php") ;
        }


    //cek apakah user sudah menekan tombol kirim atau belum
    if(isset($_POST['submit'])){
        
        //ambil data dari varial global $_POST lalu simpan kedalam variabel
        $username = $_POST['username'] ;
        $password = $_POST['password'] ;

        //cek apakah username yang dimasukan sudah betul
        $result = mysqli_query($conn,"SELECT * FROM users WHERE username = '$username' ") ;
            if(mysqli_num_rows($result) === 0){
                $text = "username atau password yang anda masukan salah" ;
                echo"
                    <script>
                        Swal.fire({
                        title: 'Gagal',
                        text: '$text',
                        icon: 'error'
                    }).then(() => {
                        window.location.href = 'login.php';
                    });
                </script>" ; 
            die ;    
            }

        //cek apakah yang login adalah admin atau user
        $row = mysqli_fetch_assoc($result) ;
            $status = $row['status'] ;
            if($status == 'admin'){
            //anda login sebagai admin

                //cek apakah password admin yang dimasukan betul atau tidak
                if($password != $row['password']){
                    $text = "password yang anda masukan salah" ;
                    echo"
                        <script>
                            Swal.fire({
                            title: 'Gagal',
                            text: '$text',
                            icon: 'error'
                            }).then(() => {
                                window.location.href = 'login.php';
                            });
                        </script> " ;
                die ;    
                }

                    //set session untuk admin
                     $_SESSION['admin'] = true ;
            
                }

            else{
            //anda login sebagai user

                //cek apakah password yang dimasukan sudah betul
                if(!password_verify($password,$row['password'])){
                    $text = "password yang anda masukan salah" ;
                    echo"
                        <script>
                            Swal.fire({
                            title: 'Gagal',
                            text: '$text',
                            icon: 'error'
                            }).then(() => {
                                window.location.href = 'login.php';
                            });
                        </script>                      
                    " ;
                die ;    
                }
            }

        
        
        //data yang masukan sudah benar

        //cek apakah user menclick remember me atau tidak
            if(isset($_POST['remember'])){
                setcookie('id',$row['id'],time()+60) ;
                $user = hash("ripemd160",$username) ;
                setcookie('key',$user,time()+60) ;
            }

        //set session
            $_SESSION['username'] = $row['username'] ;
            $_SESSION['email'] = $row['email'] ;
            $_SESSION['login'] = true ;
            $text = "Login berhasil" ;
            echo"
                <script>
                    Swal.fire({
                    title: 'Succes',
                    text: '$text',
                    icon: 'succes'
                    }).then(() => {
                        window.location.href = '../websitezahoteel/index.php';
                    });
                </script>            
            ";

   
            


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

        <title>Login Zahoteel</title>
    </head>
    <body>
        <div class="container">
            <div class="login__content">
                <img src="assets/img/bg-login.png" alt="login image" class="login__img">

                <form action="" method="post" class="login__form">
                    <div>
                        <h1 class="login__title">
                            <span>Selamat</span> Datang
                        </h1>
                        <p class="login__description">
                            Login untuk bergabung bersama kami
                        </p>
                    </div>
                    
                    <div>
                        <div class="login__inputs">
                            <div>
                                <label for="" class="login__label">Username</label>
                                <input type="text" placeholder="Masukan username anda" name="username" required class="login__input">
                            </div>
    
                            <div>
                                <label for="" class="login__label">Password</label>
    
                                <div class="login__box">
                                    <input type="password" placeholder="Masukan password anda" name="password" required class="login__input" id="input-pass">
                                    <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                                </div>
                            </div>
                        </div>

                        <div class="login__check">
                            <input type="checkbox" class="login__check-input" name="remember">
                            <label for="" class="login__check-label">Remember me</label>
                        </div>
                    </div>

                    <div>
                        <div class="login__buttons">
                            <button class="login__button" type="submit" name="submit">Log In</button>
                            <button class="login__button login__button-ghost"><a href="index.php" style="color: rgb(74, 63, 228) ; text-decoration: none ; bacgkround: transparant ;">Registrasi</a></button>
                        </div>

                        <a href="#" class="login__forgot">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>


        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>
    </body>
</html>