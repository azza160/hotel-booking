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
    session_start() ;
    require "../adminzahoteel/function/function.php" ;

    if(regist($_SESSION) > 0){
        $text = "Selamat anda berhasil bergabung bersama kami" ;
        echo "
            <script>
                Swal.fire({
                    title: 'Succes',
                    text: '$text',
                    icon: 'succes'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            </script> " ;
    }
    else{
        $text = "Username atau email yang anda masukan sudah terdaftar" ;
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


?>