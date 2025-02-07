<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--=============== REMIXICONS ===============-->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

        <!--=============== CSS ===============-->
        <link rel="stylesheet" href="assets/css/styles.css">

        <title>Registrasi Zahoteel</title>
    </head>
    <body>
        <div class="container">
            <div class="login__content">
                <img src="assets/img/bg-login.png" alt="login image" class="login__img">

                <form action="send.php" method="post" class="login__form">
                    <input type="hidden" name="status" value="user">
                    <div>
                        <h1 class="login__title">
                            <span>Registrasi</span> 
                        </h1>
                        <p class="login__description">
                            bergabung dengan kami untuk mengeksplor tempat-tempat indah di dunia.
                        </p>
                    </div>
                    
                    <div>
                        <div class="login__inputs">
                            <div>
                                <label for="" class="login__label">Email</label>
                                <input type="email" placeholder="Masukan alamat email anda" name="email" required class="login__input">
                            </div>

                            <div>
                                <label for="" class="login__label">Usename</label>
                                <input type="text" placeholder="Masukan username anda" name="username" required class="login__input">
                            </div>
    
                            <div>
                                <label for="" class="login__label">Password</label>
                                <div class="login__box">
                                    <input type="password" name="password" placeholder="masukan password anda" required class="login__input" id="input-pass">
                                    <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                                </div>
                            </div>



                        </div>
                    </div>

                    <div>
                        <div class="login__buttons">
                            <button class="login__button"><a href="login.php" style="color: white ; text-decoration: none ;">Log In</a></button>
                            <button class="login__button login__button-ghost" type="submit" name="registrasi">Registrasi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!--=============== MAIN JS ===============-->
        <script src="assets/js/main.js"></script>
    </body>
</html>