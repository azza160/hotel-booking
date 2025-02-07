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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start() ;
require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/SMTP.php";

// Fungsi untuk menghasilkan kode acak
function generateCode($length = 6) {
    $characters = '0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

if(isset($_POST['registrasi'])){
    $username = $_POST['username'] ;
    $emailpengirim = "hotelza7@gmail.com";
    $namapengirim = "zahotel";
    $emailpenerima = $_POST['email'];
    $subject = "Registrasi zahotel";

    // Menghasilkan kode acak
    $kode = generateCode();

    $mail = new PHPMailer;
    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = $emailpengirim;
    $mail->Password = 'rggsscsrypcnkxry';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPDebug = 2;

    $mail->setFrom($emailpengirim, $namapengirim);
    $mail->addAddress($emailpenerima);
    $mail->isHTML(true);

    $mail->Subject = $subject;

    // Isi email dengan kode verifikasi
    $pesan = '<div style="background-color: hsl(197, 100%, 36%); padding: 20px; font-family: Poppins; border-radius: 10px; display: flex; justify-content: center; align-items: center; height: 300px; width:500px ;">';
    $pesan .= '<div style="background-color: #ffffff; padding: 10px; padding-block : 20px ;  border-radius: 10px ;">';
    $pesan .= '<p style="font-size: 15px ; font-family: Poppins ; color: hsl(225, 8%, 42%) ; text-align: center ; margin-bottom: 10px ;">Konfirmasi kode verificaton</p>' ;
    $pesan.='<p style="font-size: 14px ; font-family: Poppins ; color: #666 ; margin-bottom: 20px">Hallo <span style="color: hsl(197, 100%, 36%) ;">'.$username.'</span>,</p>' ;
    $pesan .= '<p style="color: #666; font-family: Poppins; font-size: 14px;">Terima kasih sudah melakukan proses registrasi di website kami.masukan kode verifikasi dibawah untuk melanjutkan proses registrasi</p>';
    $pesan .= '<p style="color: #666; font-family: Poppins; font-size: 14px ; margin-bottom : 15px ;">Kode verifikasi Anda: <span style="color: hsl(225, 8%, 42%) ;">' . $kode . '</span></p>';
    $pesan .= '<p style="color: #666; font-family: Poppins; font-size: 14px; margin-bottom: -10px">Terimakasih.</p>' ;
    $pesan .= '<p style="color: hsl(225,8%,42%) ; font-family: Poppins; font-size: 14px;">Zahoteel</p>' ;
    $pesan .= '</div>';
    $pesan .= '</div>';

    $mail->Body = $pesan;
    $mail->isHTML(true);

    if ($mail->send()) {
        // Mengirim kode ke email pengguna
        $text = 'Kode verifikasi berhasil dikirim ke ' . $emailpenerima;

        //ambil data dari variabel post lalu simpan kedalam variabel session
        $_SESSION['username_regist'] = $_POST['username'] ;
        $_SESSION['password_regist'] = $_POST['password'] ;
        $_SESSION['email_regist'] = $_POST['email'] ;
        $_SESSION['status_regist'] = $_POST['status'] ;

        // Simpan kode verifikasi ke sesi atau database sesuai kebutuhan
        $_SESSION['verification_code'] = $kode;
		echo "
            <script>
                Swal.fire({
                    title: 'Sukses',
                    text: '$text',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'confirm.php';
                });
        </script> 
        ";
        
    } else {
        echo 'Gagal mengirim email. Error: ' . $mail->ErrorInfo;
    }
}


?>
