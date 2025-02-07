<?php
    
    //koneksikan ke database
        $conn = mysqli_connect("localhost","root","","zahoteel") ;

?>


<?php

    //function tampil data 

        function tampil($query){
            //koneksikan database
                global $conn ;
            
            //ambil data dari database
                $result = mysqli_query($conn,$query) ;
            
            //masukan data dari database ke variabel array
                $rows = [] ;
                    while($row = mysqli_fetch_assoc($result)){
                        $rows[] = $row ;
                    }
            
            //mengembalikan variabel array yang berisi data dari database
                return $rows ;
        }

?>

<?php
    
    //function tambah data hotel

        function tambah($data){
            //koneksikan ke database
            global $conn ;

            //ambil data dari parameter lalu simpan kedalam variabel
                $nama = htmlspecialchars($data['nama']) ;
                $lokasi = htmlspecialchars($data['lokasi']) ;
                $deskripsi = htmlspecialchars($data['deskripsi']) ;
                $rating = htmlspecialchars($data['rating']) ;
                $gambar = upload() ;
                    if($gambar == false){
                        return false ;
                    }
                $banner = uploadbanner() ;
                    if($banner == false){
                        return false ;
                    }    
                $query = "
                    INSERT INTO hotel 
                    VALUES('','$nama','$lokasi','$deskripsi','$gambar',$rating,'$banner')
                " ;
                mysqli_query($conn,$query) ;
            return mysqli_affected_rows($conn) ;
        }

?>

<?php
    
    //function upload gambar

        function upload(){
            $namafile = $_FILES['foto']['name'] ;
            $tmp = $_FILES['foto']['tmp_name'] ;
            $size = $_FILES['foto']['size'] ;
            $error = $_FILES['foto']['error'] ;

            //cek apakah file sudah diupload atau belum
                if($error === 4){
                    echo"
                        <script>
                            alert('gambar belum dipload') ;
                        </script>               
                    " ;
                    return false ;
                }
        
            //cek yang diupload adalah gambar atau bukan
                $ekstensivalid = ['jpg','png','jpeg'] ;
                $ekstensi = explode('.',$namafile) ;
                $ekstensi = strtolower(end($ekstensi)) ;
                    if(!in_array($ekstensi,$ekstensivalid)){
                        echo"
                            <script>
                                alert('yang anda masukan bukan file gambar') ;
                            </script>               
                        " ;
                    return false ;
                    }

            //cek batas ukuran gambar
                if($size > 5000000){
                    echo"
                        <script>
                            alert('file yang diupload ukurannya terlalu besar!') ;
                        </script>               
                    " ;
                    return false ;
                }
        
            //lolos pengecekan
                $namafile = uniqid() ;
                $namafile = $namafile.".".$ekstensi ;    
                move_uploaded_file($tmp,"img/image/".$namafile) ;
            return $namafile ;   
        }

?>


<?php
    
    //function upload banner gambar

        function uploadbanner(){
            $namafile = $_FILES['banner']['name'] ;
            $tmp = $_FILES['banner']['tmp_name'] ;
            $size = $_FILES['banner']['size'] ;
            $error = $_FILES['banner']['error'] ;

            //cek apakah file sudah diupload atau belum
                if($error === 4){
                    echo"
                        <script>
                            alert('gambar belum dipload') ;
                        </script>               
                    " ;
                    return false ;
                }
        
            //cek yang diupload adalah gambar atau bukan
                $ekstensivalid = ['jpg','png','jpeg'] ;
                $ekstensi = explode('.',$namafile) ;
                $ekstensi = strtolower(end($ekstensi)) ;
                    if(!in_array($ekstensi,$ekstensivalid)){
                        echo"
                            <script>
                                alert('yang anda masukan bukan file gambar') ;
                            </script>               
                        " ;
                    return false ;
                    }

            //cek batas ukuran gambar
                if($size > 5000000){
                    echo"
                        <script>
                            alert('file yang diupload ukurannya terlalu besar!') ;
                        </script>               
                    " ;
                    return false ;
                }
        
            //lolos pengecekan
                $namafile = uniqid() ;
                $namafile = $namafile.".".$ekstensi ;    
                move_uploaded_file($tmp,"img/image/".$namafile) ;
            return $namafile ;   
        }

?>



<?php 

    //function hapus data hotel

    function hapus($id){
        global $conn ;
        mysqli_query($conn,"DELETE FROM kamar WHERE idhotel = $id") ;
        mysqli_query($conn,"DELETE FROM hotel WHERE idhotel = $id") ;
        return mysqli_affected_rows($conn) ;
    }


?>


<?php 

    //function edit atau ubah data hotel
    function ubah($data){
        global $conn ;
        $idhotel = $data['idhotel'] ;
        $nama = htmlspecialchars($data['nama']) ;
        $lokasi = htmlspecialchars($data['lokasi']) ;
        $deskripsi = htmlspecialchars($data['deskripsi']) ;
        $rating = htmlspecialchars($data['rating']) ;
        $error = $_FILES['foto']['error'] ;
        $error2 = $_FILES['banner']['error'] ;
        if($error === 4){
            $foto = $data['fotolama'] ;
        }

        else{
            $foto = upload() ;
        }

        if($error2 === 4){
            $banner = $data['bannerlama'] ;
        }

        else{
            $banner = uploadbanner() ;
        }



        $query = "
            UPDATE hotel SET
            nama = '$nama',
            lokasi = '$lokasi',
            deskripsi = '$deskripsi',
            foto = '$foto',
            rating = $rating,
            banner = '$banner'
            WHERE idhotel = $idhotel
        " ;

        mysqli_query($conn,$query) ;
        return mysqli_affected_rows($conn) ;
    }

?>


<?php

    //function cari data hotel
    function cari($c){
        $query = "SELECT * FROM hotel WHERE nama LIKE '%$c%' OR
        lokasi LIKE '%$c%'
     " ;
        return tampil($query) ;
    }



?>


<?php
    
    //function tambah data kamar

        function tambahkamar($data){
            //koneksikan ke database
            global $conn ;

            //ambil data dari parameter lalu simpan kedalam variabel
                $idhotel = htmlspecialchars($data['idhotel']) ;
                $tipe = htmlspecialchars($data['tipe']) ;
                $harga = htmlspecialchars($data['harga']) ;
                $ketersediaan = htmlspecialchars($data['ketersediaan']) ;
                $rating = htmlspecialchars($data['rating']) ;
                $fasilitas = htmlspecialchars($data['fasilitas']) ;
                $kapasitas = htmlspecialchars($data['kapasitas']) ;
                $gambar = upload() ;
                    if($gambar == false){
                        return false ;
                    }
                $query = "
                    INSERT INTO kamar 
                    VALUES('',$idhotel,'$tipe',$harga,'$ketersediaan',$rating,'$fasilitas','$gambar',$kapasitas)
                " ;
                mysqli_query($conn,$query) ;
            return mysqli_affected_rows($conn) ;
        }

?>


<?php 

    //function hapus data kamar
    function hapuskamar($id){
        global $conn ;
        mysqli_query($conn,"DELETE FROM kamar WHERE id = $id") ;
        echo mysqli_error($conn) ;
        return mysqli_affected_rows($conn) ;
    }


?>


<?php 

    //function edit atau ubah data hotel
    function ubahkamar($data){
        global $conn ;
        $id = $data['id'] ;
        $idhotel = htmlspecialchars($data['idhotel']) ;
        $tipe = htmlspecialchars($data['tipe']) ;
        $harga = htmlspecialchars($data['harga']) ;
        $ketersediaan = htmlspecialchars($data['ketersediaan']) ;
        $rating = htmlspecialchars($data['rating']) ;
        $fasilitas = htmlspecialchars($data['fasilitas']) ;
        $kapasitas = htmlspecialchars($data['kapasitas']) ;
        $error = $_FILES['foto']['error'] ;
        if($error === 4){
            $foto = $data['fotolama'] ;
        }

        else{
            $foto = upload() ;
        }


        $query = "
            UPDATE kamar SET
            idhotel = $idhotel,
            tipe = '$tipe',
            harga = $harga,
            ketersediaan = '$ketersediaan',
            rating = $rating,
            fasilitas = '$fasilitas',
            foto = '$foto',
            kapasitas = $kapasitas
            WHERE id = $id
        " ;

        mysqli_query($conn,$query) ;
        return mysqli_affected_rows($conn) ;
    
    }

?>

<?php

    //function cari data kamar
    function carikamar($c){
        $query = "SELECT * FROM kamar WHERE tipe LIKE '%$c%' 
     " ;
        return tampil($query) ;
    }



?>

<?php

//function untuk memfilter data kamar sesuai dengan apa yang user inputkan 
    function filter($tipe,$jumlah,$idhotel){
        //koneksikan ke data base
        global $conn ;

        //query untuk mendapatkan data kamar
        $query = "SELECT * FROM kamar WHERE idhotel = $idhotel AND tipe = '$tipe' AND kapasitas = $jumlah" ;
        mysqli_query($conn,$query) ;

        //mengembalikan hasil query dalam bentuk array dengan menggunakan function tampil
    return tampil($query) ;
    }

?>


<?php

//function registrasi

function regist($data){
    //koneksikan ke database
    global $conn ;

    //ambil data dari parameter lalu simpan kedalam variabel
    $email = htmlspecialchars(strtolower(filter_var($data["email_regist"], FILTER_SANITIZE_EMAIL))) ;
    $username = htmlspecialchars(strtolower(stripslashes($data["username_regist"]))) ;
    $password = htmlspecialchars(mysqli_real_escape_string($conn,$data["password_regist"])) ;
    $status = $data['status_regist'] ;


    //cek apakah username dan email yang dimasukan sudah ada didatabase atau belum
    $result = mysqli_query($conn,"SELECT username FROM users WHERE username = '$username' OR email = '$email'") ;
    if(mysqli_fetch_assoc($result)){
        echo"           
        <script>
            alert('username yang anda masukan sudah dipakai oleh pengguna lain!') ;
        </script>" ;
    return false ;    
    }


    //enkripsi password 
    $password = password_hash($password,PASSWORD_DEFAULT) ;

    //memasukan data yang sudah benar kedalam database
    mysqli_query($conn,"INSERT INTO users VALUES('','$email','$username','$password','$status') ") ;

return mysqli_affected_rows($conn) ;
}

?>

<?php
    
    //function booking

        function booking($data){
            // koneksikan ke database
            global $conn;

            // ambil data dari parameter lalu simpan ke dalam variabel
            $idhotel = $data['idhotel'];
            $idkamar = $data['idkamar'];
            $nama = $data['nama_penginap'];
            $jumlah = $data['jumlah_penginap'];
            $checkin = $data['checkin'];
            $checkout = $data['checkout'];
            $tipe = $data['tipe'];
            $biaya = $data['biaya'];

            mysqli_query($conn,"UPDATE kamar SET ketersediaan = 'tidak tersedia' WHERE id = $idkamar") ;
            $query = "
                INSERT INTO booking 
                VALUES('', $idhotel, '$idkamar', '$nama', '$tipe', '$checkin', '$checkout', $jumlah, $biaya)
            ";
            mysqli_query($conn, $query);
            
            $lastId = mysqli_insert_id($conn);

            return $lastId;
        }
?>

<?php


function tambahadmin($data){
    //koneksikan ke database
    global $conn ;

    //ambil data dari parameter lalu simpan kedalam variabel
    $email = htmlspecialchars(strtolower(filter_var($data["email"], FILTER_SANITIZE_EMAIL))) ;
    $username = htmlspecialchars(strtolower(stripslashes($data["username"]))) ;
    $password = htmlspecialchars(mysqli_real_escape_string($conn,$data["password"])) ;
    $status = $data['status'] ;

    
    //cek apakah username dan email yang dimasukan sudah ada didatabase atau belum
    $result = mysqli_query($conn,"SELECT username FROM users WHERE username = '$username' AND email = '$email' ") ;
    if(mysqli_fetch_assoc($result)){
        echo"           
        <script>
            alert('username yang anda masukan sudah dipakai oleh pengguna lain!') ;
        </script>" ;
    return false ;    
    }

    //memasukan data yang sudah benar kedalam database
    mysqli_query($conn,"INSERT INTO users VALUES('','$email','$username','$password','$status') ") ;
    return mysqli_affected_rows($conn) ;

}

?>


<?php 

    //function hapus data users
    function hapususers($id){
        global $conn ;
        mysqli_query($conn,"DELETE FROM users WHERE id = $id") ;
        echo mysqli_error($conn) ;
        return mysqli_affected_rows($conn) ;
    }


?>

<?php 

    //function hapus data riwayat
    function hapusriwayat($id){
        global $conn ;
        mysqli_query($conn,"DELETE FROM booking WHERE id = $id") ;
        echo mysqli_error($conn) ;
        return mysqli_affected_rows($conn) ;
    }


?>


<?php 

    //function hapus data riwayat
    function hapuspaket($id){
        global $conn ;
        mysqli_query($conn,"DELETE FROM paket_liburan WHERE id = $id") ;
        echo mysqli_error($conn) ;
        return mysqli_affected_rows($conn) ;
    }

?>


<?php 

    //function edit atau ubah data paket
    function ubahpaket($data){
        global $conn ;
        $id = $data['id'] ;
        $nama = htmlspecialchars($data['nama']) ;
        $lama = htmlspecialchars($data['lama']) ;
        $kapasitas = htmlspecialchars($data['kapasitas']) ;
        $ketersediaan = htmlspecialchars($data['ketersediaan']) ;
        $tempat = htmlspecialchars($data['tempat']) ;
        $rating = htmlspecialchars($data['rating']) ;
        $harga = htmlspecialchars($data['harga']) ;
        $deskripsi = htmlspecialchars($data['deskripsi']) ;
        $error = $_FILES['foto']['error'] ;
        if($error === 4){
            $foto = $data['fotolama'] ;
        }

        else{
            $foto = upload() ;
        }


        $query = "
            UPDATE paket_liburan SET
            nama = '$nama',
            lama = $lama,
            kapasitas = $kapasitas,
            ketersediaan = '$ketersediaan',
            tempat = '$tempat',
            harga = $harga,
            rating = $rating,
            foto = '$foto',
            deskripsi = '$deskripsi'
            WHERE id = $id
        " ;

        mysqli_query($conn,$query) ;
        echo mysqli_error($conn) ;
        return mysqli_affected_rows($conn) ;
    
    }

?>

<?php
    
    //function tambah data paket

        function tambahpaket($data){
            //koneksikan ke database
            global $conn ;

            //ambil data dari parameter lalu simpan kedalam variabel
            $nama = htmlspecialchars($data['nama']) ;
            $lama = htmlspecialchars($data['lama']) ;
            $kapasitas = htmlspecialchars($data['kapasitas']) ;
            $ketersediaan = htmlspecialchars($data['ketersediaan']) ;
            $tempat = htmlspecialchars($data['tempat']) ;
            $rating = htmlspecialchars($data['rating']) ;
            $harga = htmlspecialchars($data['harga']) ;
            $deskripsi = htmlspecialchars($data['deskripsi']) ;
                $gambar = upload() ;
                    if($gambar == false){
                        return false ;
                    }
                $query = "
                    INSERT INTO paket_liburan 
                    VALUES('','$nama',$lama,$kapasitas,'$ketersediaan','$tempat',$harga,$rating,'$gambar','$deskripsi')
                " ;
                mysqli_query($conn,$query) ;

            return mysqli_affected_rows($conn) ;
        }

?>


<?php
    
    function tambahgallery($data)
    {
        // Koneksikan ke database
        global $conn;
    
        // Ambil data dari parameter lalu simpan kedalam variabel
        if(isset($_POST['idhotel'])){
            $idhotel = $_POST['idhotel'] ;
        }
        else{
            $idhotel = 1 ;
        }
            $idhotel = intval($idhotel) ;
        $gambar = upload();
        if ($gambar == false) {
            return false;
        }
    
        $query = "INSERT INTO gallery VALUES('', $idhotel, '$gambar')";
        mysqli_query($conn, $query);
        echo mysqli_error($conn) ;
        return mysqli_affected_rows($conn);
    }
?>


<?php 

    //function edit atau ubah data gallery
    function ubahgallery($data){
        global $conn ;
        $id = $data['id'] ;
        if(isset($_POST['idhotel'])){
            $idhotel = $_POST['idhotel'] ;
        }
        else{
            $idhotel = 1 ;
        }
        $idhotel = intval($idhotel) ;
        $error = $_FILES['foto']['error'] ;
        if($error === 4){
            $foto = $data['fotolama'] ;
        }

        else{
            $foto = upload() ;
        }


        $query = "
            UPDATE gallery SET
            idhotel = $idhotel,
            foto = '$foto'
            WHERE id = $id
        " ;

        mysqli_query($conn,$query) ;
        return mysqli_affected_rows($conn) ;
    
    }

?>

<?php 

    //function hapus data riwayat
    function hapusgallery($id){
        global $conn ;
        mysqli_query($conn,"DELETE FROM gallery WHERE id = $id") ;
        echo mysqli_error($conn) ;
        return mysqli_affected_rows($conn) ;
    }

?>


<?php
    
    //function tambah data fasilitas

        function tambahfasilitas($data){
            //koneksikan ke database
            global $conn ;

            //ambil data dari parameter lalu simpan kedalam variabel
            $idhotel = htmlspecialchars($data['idhotel']) ;
            $nama = htmlspecialchars($data['nama']) ;
            $deskripsi = htmlspecialchars($data['deskripsi']) ;
            $waktu = htmlspecialchars($data['waktu']) ;
            $rating = htmlspecialchars($data['rating']) ;
                $gambar = upload() ;
                    if($gambar == false){
                        return false ;
                    }
                $query = "
                    INSERT INTO fasilitas_hotel 
                    VALUES('',$idhotel,'$nama','$deskripsi',$waktu,$rating,'$gambar')
                " ;
                mysqli_query($conn,$query) ;

            return mysqli_affected_rows($conn) ;
        }

?>



<?php 

    //function edit atau ubah fasilitas
    function ubahfasilitas($data){
        global $conn ;
        $id = $data['id'] ;
        $idhotel = htmlspecialchars($data['idhotel']) ;
        $nama = htmlspecialchars($data['nama']) ;
        $deskripsi = htmlspecialchars($data['deskripsi']) ;
        $waktu = htmlspecialchars($data['waktu']) ;
        $rating = htmlspecialchars($data['rating']) ;
        $error = $_FILES['foto']['error'] ;
        if($error === 4){
            $foto = $data['fotolama'] ;
        }

        else{
            $foto = upload() ;
        }


        $query = "
            UPDATE fasilitas_hotel SET
            idhotel = $idhotel,
            waktu = '$nama',
            deskripsi = '$deskripsi',
            waktu = $waktu,
            rating = $rating,
            foto = '$foto'
            WHERE id = $id
        " ;

        mysqli_query($conn,$query) ;
        return mysqli_affected_rows($conn) ;
    
    }

?>

<?php 

    //function hapus data riwayat
    function hapusfasilitas($id){
        global $conn ;
        mysqli_query($conn,"DELETE FROM fasilitas_hotel WHERE id = $id") ;
        echo mysqli_error($conn) ;
        return mysqli_affected_rows($conn) ;
    }

?>


<?php

function tambahTanggal($tanggal_awal, $nilai_integer) {
    // Ubah tanggal awal menjadi objek DateTime
    $tanggal_obj = new DateTime($tanggal_awal);

    // Tambahkan nilai integer ke tanggal awal
    $tanggal_obj->modify("+" . $nilai_integer . " days");

    // Format tanggal akhir sesuai kebutuhan (misalnya: 'Y-m-d' untuk format YYYY-MM-DD)
    $tanggal_akhir = $tanggal_obj->format('Y-m-d');

    return $tanggal_akhir;
}


?>

<?php

function pesanpaketliburan($data){
    //koneksikan ke database
    global $conn ;

    //ambil data dari variable session lalu masukan ke dalam variabel 
    $id = $data['idpaket'] ;
    $namapaket = htmlspecialchars($data['namapaket']) ;
    $nama = htmlspecialchars($data['nama']) ;
    $jumlah = htmlspecialchars($data['jumlah']) ;
    $tanggal_awal = htmlspecialchars($data['tanggal_keberangkatan']) ;
    $tanggal_akhir = htmlspecialchars($data['tanggal_selesai']) ;
    $kapasitas = htmlspecialchars($data['kapasitas']) ;      
    $biaya = htmlspecialchars($data['biaya']) ;  
    


    //update kapasitas paket liburan
    $kapasitas = intval($kapasitas) - intval($jumlah) ; 

    $query = "
        UPDATE paket_liburan SET
        kapasitas = $kapasitas
        WHERE id = $id
    " ;

    mysqli_query($conn,$query) ;

    //cek ketersediaan paket liburan
    if($kapasitas == 0){
        $ketersediaan = 'tidak tersedia' ;
        $query = "
            UPDATE paket_liburan SET
            ketersediaan = '$ketersediaan'
            WHERE id = $id
        " ;

    mysqli_query($conn,$query) ;       
    }

    //masukan data ke database pesanpaketliburan
        $query = "
            INSERT INTO pesanpaketliburan 
            VALUES('',$id,'$namapaket','$nama',$jumlah,$biaya,'$tanggal_awal','$tanggal_akhir')
        " ;

    mysqli_query($conn,$query) ;
    $lastId = mysqli_insert_id($conn);


    return $lastId;
}


?>

<?php 

    //function hapus data riwayat pemesanan paket
    function hapusriwayatpaket($id){
        global $conn ;
        mysqli_query($conn,"DELETE FROM pesanpaketliburan WHERE id = $id") ;
        echo mysqli_error($conn) ;
        return mysqli_affected_rows($conn) ;
    }

?>
