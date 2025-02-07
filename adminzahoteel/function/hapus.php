
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family : poppins ;
        }
    </style>
</head>
<body>
 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>


<?php

require "function.php";

// ambil data dari variabel GET
$idhotel = $_GET['id'];

// jalankan function hapus
if (hapus($idhotel) > 0) {
    echo "
    <script>
        Swal.fire({
            title: 'Sukses',
            text: 'Data berhasil dihapus',
            icon: 'success'
        }).then(() => {
            window.location.href = '../index.php';
        });
    </script>";
} else {
    echo "
    <script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data tidak berhasil dihapus',
            icon: 'error'
        }).then(() => {
            window.location.href = '../index.php';
        });
    </script>";
}

?>