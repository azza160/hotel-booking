<!-- kode html untuk menyimpan beberapa link library yang digunakan -->
<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet">
        <style>
            *{
                margin : 0 ;
                padding : 0 ;
                box-sizing : border-box ;
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
    require "../../adminzahoteel/function/function.php" ;

    //ambil data dari variabel get
    $konfirmasi = $_GET['konfirmasi'] ;
    if($konfirmasi == 'iya'){
        $idpemesanan = pesanpaketliburan($_SESSION) ;
        //masukan data ke databse booking
        if($idpemesanan > 0){

            $tanggal_hari_ini = date('Y-m-d'); // Format YYYY-MM-DD

            //mengirimkan email konfirmasi
            $username = $_SESSION['username'] ;
            $emailpengirim = "hotelza7@gmail.com";
            $namapengirim = "zahotel";
            $emailpenerima = $_SESSION['email'];
            $subject = "Bukti pemesanan";
    
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
        $biayaformat = number_format($_SESSION['biaya']) ;
        $pesan = '<div class="container" style="width: 600px ; box-sizing: border-box ; background: white ; height: 600px ; padding: 30px ; border: 1px solid black ; border-radius: 5px ;">' ;
        // header
        $pesan .= '<div class="header" style=" box-sizing: border-box ; display: flex ; justify-content: space-between ; align-items: center ; padding-bottom: 20px ;  border-bottom: 2px solid black ; margin-bottom: 30px ;">' ;
        $pesan .= '<div class="left" style="margin-right: 235px ;">' ;
        $pesan .= '<h2>Zahoteel</h2>' ;
        $pesan .= '<p>+62 0838-6165-2293</p>' ;
        $pesan .= '</div>' ;
        $pesan .= '<div class="right">' ;
        $pesan .= '<p><span>Tanggal : </span><span>'.$tanggal_hari_ini.'</span></p>' ;
        $pesan .= '<p><span>nama  : </span><span>'.$_SESSION["nama"].'</span></p>' ;
        $pesan .= '<p><span>nomor pemesanan : </span><span>'.$idpemesanan.'</span></p>' ;
        $pesan .= '</div>' ;
        $pesan .= '</div>' ;
        //body
        $pesan .= '<div class="body" style="padding-bottom: 30px ; margin-bottom: 20px ; border-bottom: 2px solid black ;">' ;
        $pesan .= '<p><span>Idpaket liburan <span style="margin: 30px">:</span></span><span>'.$_SESSION["idpaket"].'</span></p>' ;
        $pesan .= '<p><span>Namapaket liburan  <span style="margin: 30px">:</span></span><span>'.$_SESSION["namapaket"].'</span></p>' ;
        $pesan .= '<p><span>Nama pemesan <span style="margin: 30px">:</span></span><span>'.$_SESSION["nama"].'</span></p>' ;
        $pesan .= '<p><span>Tanggal keberangkatan <span style="margin: 30px">:</span></span><span>'.$_SESSION["tanggal_keberangkatan"].'</span></p>' ;
        $pesan .= '<p><span>Tanggal selesai <span style="margin: 30px">:</span></span><span>'.$_SESSION["tanggal_selesai"].'</span></p>' ;
        $pesan .= '<p><span>Jumlah orang <span style="margin: 30px">:</span></span><span>'.$_SESSION["jumlah"].'</span></p>' ;
        $pesan .= '<p><span>Total biaya <span style="margin: 30px">:</span></span>Rp.<span>'.$biayaformat.'</span></p>' ;
        $pesan .= '</div>' ;
        //footer
        $pesan .= '<div>' ;
        $pesan .= ' <p style="font-size: 1.5rem ; text-align: center">Terimakasih memesan paket liburan di website kami</p>' ;
        $pesan .= '</div>' ;
        $pesan .= '</div>' ;

        $mail->Body = $pesan;
        $mail->isHTML(true);
        
        unset($_SESSION['idpaket']);
        unset($_SESSION['namapaket']);
        unset($_SESSION['nama']);
        unset($_SESSION['jumlah']);
        unset($_SESSION['tanggal_keberangkatan']);
        unset($_SESSION['tanggal_selesai']);
        unset($_SESSION['biaya']);
        unset($_SESSION['kapasitas']);

        if ($mail->send()) {

            echo "
                <script>
                    Swal.fire({
                        title: 'Sukses',
                        html: 'pemesanan paket liburan berhasil<br>Silahlakan liat bukti pemesanan yang sudah dikirimkan ke email anda',
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
        else{
            unset($_SESSION['idpaket']);
            unset($_SESSION['namapaket']);
            unset($_SESSION['nama']);
            unset($_SESSION['jumlah']);
            unset($_SESSION['tanggal_keberangkatan']);
            unset($_SESSION['tanggal_selesai']);
            unset($_SESSION['biaya']);
            unset($_SESSION['kapasitas']);
            
            echo"
            <script>
                Swal.fire({
                title: 'Gagal',
                text: 'Proses gagal',
                icon: 'warning'
                }).then(() => {
                    window.location.href = '../../websitezahoteel/index.php';
                });
        
            </script> ";  
        }
    }
    else{
        unset($_SESSION['idpaket']);
        unset($_SESSION['namapaket']);
        unset($_SESSION['nama']);
        unset($_SESSION['jumlah']);
        unset($_SESSION['tanggal_keberangkatan']);
        unset($_SESSION['tanggal_selesai']);
        unset($_SESSION['biaya']);
        unset($_SESSION['kapasitas']);
        
        echo"
        <script>
            Swal.fire({
            title: 'Gagal',
            text: 'Proses Pemesanan dibatalkan',
            icon: 'warning'
            }).then(() => {
                window.location.href = '../../websitezahoteel/index.php';
            });
    
        </script> ";         
    }


?>