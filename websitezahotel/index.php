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
  require "../adminzahoteel/function/function.php" ;
  session_start() ;
  //ambil data dari variabel get lalu simpan kedalam variabel
  $idhotel = $_GET['id'] ;

  //ambil data hotel sesuai dengan id yang dikirimkan melalui variabel get
  $hotel = tampil("SELECT * FROM hotel WHERE idhotel = $idhotel") ;
  $hotel = $hotel[0] ;
  $gallery = tampil("SELECT * FROM gallery WHERE idhotel = $idhotel ") ;
  $fasilitas = tampil("SELECT * FROM fasilitas_hotel WHERE idhotel = $idhotel") ;
    
  //jika telah login  data kamar yang ditampilkan hanya yang tersedia saja di hotel tersebut 
  if(isset($_SESSION['login'])){

      //ambil data kamar sesuai dengan id yang dikirimkan melalui variabel get
      $kamar = tampil("SELECT * FROM kamar WHERE idhotel = $idhotel AND ketersediaan ='tersedia' ") ;

  }
  else{
    //jika belum,maka akan ditampilan semua data kamar pada hotel tersebut

        //ambil data kamar sesuai dengan id yang dikirimkan melalui variabel get
        $kamar = tampil("SELECT * FROM kamar WHERE idhotel = $idhotel ") ; 
  }


  //jika user menekan tombol filter
  if(isset($_POST['filter'])){
      $tipe = $_POST['tipe'] ;
      $jumlah = $_POST['jumlah'] ;
      $kamar = filter($tipe,$jumlah,$idhotel) ;
  }

  //jika user menekan tombol booking
  if(isset($_GET['booking'])){
        
    //ambil data kamar dari variabel post id
    $idkamar = $_GET['idkamar'] ;
    $idhotel = $_GET['id'] ;

    //cek apakah user sudah login atau belum
    if(isset($_SESSION['login'])){
      header("Location: action/booking/index.php?idkamar=$idkamar&idhotel=$idhotel");
      exit;
    }

    else{
        $url = 'index.php?id=' . $idhotel;
        echo"     
            <script>
                Swal.fire({
                    title: 'Gagal',
                    text: 'Anda belum login.Harap login terlebih dahulu',
                    icon: 'warning'
                }).then(() => {
                window.location.href = '$url';
                });
           </script> ";                     
    }

}


  

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zahoteel</title>


  <!-- favicon -->
  <link rel="icon" href="favicon.ico" >

  <!-- custom css link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="./assets/css/style.css">

  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
  rel="stylesheet">

  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body id="top">

  <!-- HEADER -->

  <header class="header" data-header>

    <div class="overlay" data-overlay></div>

    <div class="header-top">
      <div class="container">

        <a href="tel:+01123456790" class="helpline-box">

          <div class="icon-box">
            <ion-icon name="call-outline"></ion-icon>
          </div>

          <div class="wrapper">
            <p class="helpline-title">info lebih lanjut :</p>
            <p class="helpline-number">+62 (0838) 6165 2293</p>
          </div>

        </a>

        <a href="#" class="logo">
          <i class="fa-solid fa-hotel"></i>
          <p>ZAHOTEEL</p>
        </a>

        <div class="header-btn-group">

 
        <button class="search-btn" aria-label="Search" id="profile-icon">
            <?php if(isset($_SESSION['login'])) : ?>
              <?php if(isset($_SESSION['admin'])) : ?>
                <a href="../adminzahoteel/index.php" style="color: white ;"><ion-icon name="person"></ion-icon></a>
              <?php else :?>
                <button class="btn btn-primary"><a href="../registrasi/logout.php" style="color: white ;">Log out</a></button>
              <?php endif ; ?>
            <?php else : ?>  
              <a href="../registrasi/login.php" style="color: white ;"><ion-icon name="person-outline"></ion-icon></a>
            <?php endif ; ?>  
          </button>
          <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
            <ion-icon name="menu-outline"></ion-icon>
          </button>

        </div>

      </div>
    </div>

    <div class="header-bottom">
      <div class="container">

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

        <nav class="navbar" data-navbar>

          <div class="navbar-top">

            <a href="#" class="logo">
              <i class="fa-solid fa-hotel"></i>
              <p>ZAHOTEEL</p>
            </a>

            <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </div>

          <ul class="navbar-list">

            <li>
              <a href="#home" class="navbar-link" data-nav-link>beranda</a>
            </li>

            <li>
              <a href="#home" class="navbar-link" data-nav-link>tentang kami</a>
            </li>

            <li>
              <a href="#kamar" class="navbar-link" data-nav-link>kamar</a>
            </li>

            <li>
              <a href="#fasilitas" class="navbar-link" data-nav-link>Fasilitas</a>
            </li>

            <li>
              <a href="#gallery" class="navbar-link" data-nav-link>gallery</a>
            </li>

            <li>
              <a href="../websitezahoteel/index.php" class="navbar-link" data-nav-link>zahoteel</a>
            </li>

            <li>
              <a href="#contact" class="navbar-link" data-nav-link>Contact kami</a>
            </li>

          </ul>

        </nav>

        <button class="btn btn-primary">Book Now</button>

      </div>
    </div>

  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home" style="background-image: url('../adminzahoteel/img/image/<?= $hotel['banner'] ;?>');">

        <div class="container">

          <h2 class="h1 hero-title">Welcome to <?= $hotel['nama'] ; ?></h2>

          <p class="hero-text">
            <?= $hotel['deskripsi'] ;?>
          </p>

          <div class="btn-group">
            <button class="btn btn-primary"><a href="#kamar" style="color: white ;">Learn more</a></button>

            <button class="btn btn-secondary"><a href="#kamar" style="color : white ;">Book now</a></button>
          </div>

        </div>
      </section>





      <!-- 
        - #TOUR SEARCH
      -->

     <!-- 
        - #TOUR SEARCH
      -->

      <section class="tour-search">
        <div class="container">

          <form action="" method="post" class="tour-search-form">

            <div class="input-wrapper">
              <label for="destination" class="input-label">Tipe kamar*</label>

              <input type="text" name="tipe" id="destination" required placeholder="mmasukan tipe kamar..."
                class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="jumlah" class="input-label">Jumlah orang*</label>
              <input type="number" name="jumlah" id="jumlah" required placeholder="jumlah orang..." class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="checkin" class="input-label">Tanggal Checkin*</label>

              <input type="date" name="checkin" id="checkin" required class="input-field">
            </div>

            <div class="input-wrapper">
              <label for="checkout" class="input-label">Tanggal Checkout*</label>

              <input type="date" name="checkout" id="checkout" required class="input-field">
            </div>
            
            <button type="submit" name="filter" class="btn btn-secondary">cari sekarang</button>

          </form>

        </div>
      </section>





  <!-- room -->

    <section class="room" id="kamar">

      <div class="container">

        <p class="section-subtitle">Kamar</p>
        <h2 class="h2 section-title">Kamar kamar di <?= $hotel['nama'] ;?></h2>
        <p class="section-text">
          Kamar kamar yang ada di <?= $hotel['nama']?>.Pastikan anda menginap di hotel kami saat anda berkunjung ke <?= $hotel['lokasi'] ; ?>.
        </p>

        <div class="swiper room-slider">
    
          <div class="swiper-wrapper">
            <?php foreach($kamar as $k) : ?>
            <div class="swiper-slide slide">
              <div class="image">
                <span class="price" style="text-transform: uppercase ;">Rp.<?= $k['harga'] ;?>/malam</span>
                <img src="../adminzahoteel/img/image/<?= $k['foto'] ;?>" alt="">
                <div class="capacity">
                  <ion-icon name="people"></ion-icon>
                  <span><?= $k['kapasitas'] ;?></span>
                </div>
              </div>
              
              <div class="content">
                <h3><?= $k['tipe'] ;?></h3>
                <p><?= $k['fasilitas'] ;?></p>
                <div class="stars">
                  <?php for($i = 1 ; $i <= $k['rating'];$i++) : ?>
                    <i class="fas fa-star"></i>
                  <?php endfor ; ?>
                </div>
                <a href="?idkamar=<?= $k['id'] ; ?>&booking=true&id=<?= $idhotel ;?>" class="btn">book now</a>
             </div>
            </div>
            
            <?php endforeach ; ?>
                  </div>
          <div class="swiper-pagination"></div>
                <div class="swiper-button-next">
                  <i class="fa-solid fa-arrow-right"></i> 
                </div>
                <div class="swiper-button-prev">
                <i class="fa-solid fa-arrow-left"></i>
                </div>
        </div>
        <div class="btn-page">
          <button class="btn btn-primary"><a href="" style="color: white ;">Show all</a></button>
        </div>
      </div>
    </section>    


      <!-- end room -->

             <!-- services -->

             <section class="services">
<div class="container">

  <div class="box-container">
  
      <div class="box">
          <img src="assets/images/service1.png" alt="">
          <h3>swimming pool</h3>
      </div>
  
      <div class="box">
          <img src="assets/images/service2.png" alt="">
          <h3>food & drink</h3>
      </div>
  
      <div class="box">
          <img src="assets/images/service3.png" alt="">
          <h3>restaurant</h3>
      </div>
  
      <div class="box">
          <img src="assets/images/service4.png" alt="">
          <h3>fitness</h3>
      </div>
  
      <div class="box">
          <img src="assets/images/service5.png" alt="">
          <h3>beauty spa</h3>
      </div>
  
  
  </div>
</div>

</section>

<!-- end -->

    
      <!-- 
        - #PACKAGE
      -->

      <section class="package" id="fasilitas">
        <div class="container">

          <p class="section-subtitle">Fasilitas</p>

          <h2 class="h2 section-title">Fasilitas hotel kami</h2>

          <p class="section-text">
            Memastikan client merasa nyaman,dan merasakan sensasi menginap yang luar biasa
          </p>

          <ul class="package-list">
            
          <?php foreach($fasilitas as $f) :?>
            <li>
              <div class="package-card">

                <figure class="card-banner">
                  <img src="../adminzahoteel/img/image/<?= $f['foto'] ;?>" alt="Experience The Great Holiday On Beach" loading="lazy">
                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title"><?= $f['nama'] ;?></h3>

                  <p class="card-text">
                  <?= $f['deskripsi'] ;?>
                  </p>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <div class="meta-box">
                        <ion-icon name="time"></ion-icon>

                        <p class="text"><?= $f['waktu'] ;?> jam</p>
                      </div>
                    </li>

                    <li class="card-meta-item">
                      <div class="meta-box">
                        <ion-icon name="location"></ion-icon>

                        <p class="text"><?= $hotel['lokasi'] ;?></p>
                      </div>
                    </li>

                  </ul>

                </div>

                <div class="card-price">

                  <div class="wrapper">

                    <p class="reviews">(25 reviews)</p>

                    <div class="card-rating">
                      <?php for($z= 1 ; $z <= $f['rating'] ; $z++) :?>
                      <ion-icon name="star"></ion-icon>
                      <?php endfor ; ?>
                    </div>

                  </div>
                  <button class="btn btn-secondary">Kunjungi</button>

                </div>

              </div>
            </li>
            <?php endforeach ;?>

          </ul>

          <button class="btn btn-primary"><a href="#fasilitas" style="color: white ;">fasilitas kami</a></button>

        </div>
      </section>





      <!-- 
        - #GALLERY
      -->

      <section class="gallery" id="gallery">
        <div class="container">

          <p class="section-subtitle">Photo Gallery</p>

          <h2 class="h2 section-title">Photo's From Travellers</h2>

          <p class="section-text">
          Foto foto dari para client yang sudah menggunakan jasa kami. 
          </p>

          <ul class="gallery-list">
            
            <?php foreach($gallery as $g) : ?>
            <li class="gallery-item">
              <figure class="gallery-image">
                <img src="../adminzahoteel/img/image/<?= $g['foto'] ;?>">
              </figure>
            </li>
            <?php endforeach ; ?>

          </ul>

        </div>
      </section>





      <!-- 
        - #CTA
      -->

      <section class="cta" id="contact">
        <div class="container">

          <div class="cta-content">
            <p class="section-subtitle">Call To Action</p>

            <h2 class="h2 section-title">Ready For Unforgatable Travel. Remember Us!</h2>

            <p class="section-text">
            butuh informasi lebih jauh mengenai jasa yang kami berikan.contact kami melalui no telepon dan sosial media.Pihak kami akan memberikan informasi yang jelas dan rinci.
            </p>
          </div>

          <button class="btn btn-secondary">Contact Us !</button>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand">

        <h2 style="margin-bottom: 10px ;">Zahoteel</h2>

          <p class="footer-text">
          Terimakasi sudah mengunjungi website kami.jangan lupa jika anda butuh sesuatu mengenai informasi hotel hotel dan paket liburan di seluruh dunia kami akan selalu ada.
          </p>

        </div>

        <div class="footer-contact">

          <h4 class="contact-title">Contact Us</h4>

          <p class="contact-text">
            Feel free to contact and reach us !!
          </p>

          <ul>

            <li class="contact-item">
              <ion-icon name="call-outline"></ion-icon>

              <a href="tel:+01123456790" class="contact-link">+62 0838 6165 2293</a>
            </li>

            <li class="contact-item">
              <ion-icon name="mail-outline"></ion-icon>

              <a href="" class="contact-link">Zahoteel.com</a>
            </li>

            <li class="contact-item">
              <ion-icon name="location-outline"></ion-icon>

              <address>Simpang Batu Hampa</address>
            </li>

          </ul>

        </div>

        <div class="footer-form">

          <p class="form-text">
          Iuti sosial media dan youtube kami!
          </p>

          <form action="" class="form-wrapper">
            <input type="email" name="email" class="input-field" placeholder="Enter Your Email" >

            <button type="submit" class="btn btn-secondary">Subscribe</button>
          </form>

        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          &copy; 2023 <a href="">Zahoteel</a>. All rights reserved
        </p>

        <ul class="footer-bottom-list">

          <li>
            <a href="#" class="footer-bottom-link">Privacy Policy</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link">Term & Condition</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link">FAQ</a>
          </li>

        </ul>

      </div>
    </div>

  </footer>





  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>  
  <script src="./assets/js/scripttt.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>