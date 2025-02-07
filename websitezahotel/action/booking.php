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


    if(isset($_POST['submit'])){

        //ambil data dari variabel post
        $kapasitas = $_POST['kapasitas'] ;
        $jumlah_penginap = $_POST['jumlah'] ;
        $checkin = $_POST['checkin'] ;
        $checkout = $_POST['checkout'] ;
        $harga = $_POST['harga'] ;
        $idkamar = $_POST['idkamar'] ;
        $idhotel = $_POST['idhotel'] ;




        //hitung total haro
        $totalhari = intval((strtotime($checkout) - strtotime($checkin)) / (60 * 60 * 24)) ;

        //cek apakah jumlah penginap sesuai dengan kapasitas kamar
        if($jumlah_penginap > $kapasitas){
            $url = "booking/index.php?idkamar=$idkamar&idhotel=$idhotel";
            echo"     
                <script>
                    Swal.fire({
                        title: 'Gagal',
                        html: 'Jumlah penginap lebih banyak dari kapasitas kamar',
                        icon: 'warning'
                    }).then(() => {
                    window.location.href = '$url';
                    });
               </script> ";
            die ;                 
        }
        
        //hitung total biaya
        $biaya = $totalhari * intval($harga) ;
        $biayaformat = number_format($biaya) ;

        //masukan data yang diperlukan ke dalam variabel session
        $_SESSION['idhotel'] = $_POST['idhotel'] ;
        $_SESSION['idkamar'] = $_POST['idkamar'] ;
        $_SESSION['nama_penginap'] = $_POST['nama'] ;
        $_SESSION['jumlah_penginap'] = $_POST['jumlah'] ;
        $_SESSION['checkin'] = $_POST['checkin'] ;
        $_SESSION['checkout'] = $_POST['checkout'] ;
        $_SESSION['tipe'] = $_POST['tipe'] ;
        $_SESSION['biaya'] = $biaya ;

        //mengirimkan email konfirmasi
        $username = $_SESSION['username'] ;
        $emailpengirim = "hotelza7@gmail.com";
        $namapengirim = "zahotel";
        $emailpenerima = $_SESSION['email'];
        $subject = "Konfirmasi pembayaran";
    
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

        // Isi email dengan konfirmasi
        $pesan = '<div style="background-color: hsl(197, 100%, 36%); padding: 20px; font-family: Poppins; border-radius: 10px; display: flex; justify-content: center; align-items: center; height: 300px; width:500px ;">';
        $pesan .= '<div style="background-color: #ffffff; padding: 10px; padding-block : 20px ;  border-radius: 10px ;">';
        $pesan .= '<p style="font-size: 15px ; font-family: Poppins ; color: hsl(225, 8%, 42%) ; text-align: center ; margin-bottom: 10px ;">Konfirmasi Pembayaran</p>' ;
        $pesan.='<p style="font-size: 14px ; font-family: Poppins ; color: #666 ; margin-bottom: 20px">Hallo <span style="color: hsl(197, 100%, 36%) ;">'.$username.'</span>,</p>' ;
        $pesan .= '<p style="color: #666; font-family: Poppins; font-size: 14px;">Terima kasih sudah melakukan proses pemesanan kamar hotel di website kami.Konfimasi apakah anda sudah melakukan pembayaran.</p>';
        $pesan .= '<p style="color: #666; font-family: Poppins; font-size: 14px ; margin-bottom : 15px ;">Total biaya anda adalah: Rp.<span style="color: hsl(225, 8%, 42%) ; margin-bottom: 20px ">' . $biayaformat . '</span></p>';
        $pesan .= '<a href="http://localhost/zahoteel/websitezahotel/action/confirm.php?konfirmasi=iya" style="background-color: hsl(120, 60%, 70%) ; color: white ; padding: 10px 20px ; border: none ; border-radius: 5px ;cursor: pointer ; margin-right: 20px ; text-decoration: none ;">Iya</a>' ;
        $pesan .=  '<a href="http://localhost/zahoteel/websitezahotel/action/confirm.php?konfirmasi=tidak" style="background: linear-gradient(to right, #FF0000, #FF5555); color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none ;">Tidak</a>' ;
        $pesan .= '<p style="color: #666; font-family: Poppins; font-size: 14px; margin-bottom: -20px ; margin-top: 25px ">Terimakasih.</p>' ;
        $pesan .= '<p style="color: hsl(225,8%,42%) ; font-family: Poppins; font-size: 14px;">Zahoteel</p>' ;
        $pesan .= '</div>';
        $pesan .= '</div>';

        $mail->Body = $pesan;
        $mail->isHTML(true);
        

        if ($mail->send()) {
        
            echo "
                <script>
                    Swal.fire({
                        title: 'Sukses',
                        text: 'konfirmasi pembayaran sudah dikirimkan ke email anda',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = '../../websitezahoteel/index.php';
                    });
            </script> 
            ";
            
        } else {
            echo 'Gagal mengirim email. Error: ' . $mail->ErrorInfo;
        }
    }

    
        
        

        
    



?>