<?php

session_start(); // Oturum işleminin başlaması için

if (isset($_POST["usrnm"], $_POST["email"], $_POST["password"])) { // Alanlar doluysa veri girişi yapıldıysa
    if ($_POST["usrnm"] == "admin" && $_POST["email"] == "admin@example.com" && $_POST["password"] == "admin123") {
        $_SESSION["user"] = $_POST["usrnm"]; // Giriş bilgimiz session'ın user değerine atandı
        header("location:admin-employee.php"); // Girilen bilgiler sonucu dashboarda gidiyor
        exit();
    } else {
        echo "<script>alert('Yetkili girişi için kullanıcı adı, e-mail veya şifre hatalıdır.')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> bu da olur icon için -->
    <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="owl/owl.carousel.min.css">
    <link rel="stylesheet" href="owl/owl.theme.default.min.css">
    <!--owl carousel indirdik blog kartları arasında kaydırma olsun diye bunu slider da yapabilrdim şimdilik boyle olsun-->
    <link rel="icon" href="images/ysoft_logo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
    <title>YSoft | Giriş Yap</title>
</head>

<body>
    <section id="menu">
        <div id="logo"><a href="index.php"><img src="images/YSOFT.png" alt=""></a></div>
    
        <nav>
            <a href="index.php"><i class="fas fa-home icon"></i>Anasayfa</a>
            <a href="index.php#about"><i class="fas fa-info icon"></i>Hakkımızda</a>
            <a href="index.php#mission"><i class="fas fa-dice icon"></i>Misyon&Vizyon</a>
            <a href="index.php#project"><i class="fas fa-code-branch icon"></i>Projelerimiz</a>
            <a href="user-employee.php"><i class="fas fa-users icon"></i>Ekibimiz</a>
            <a href="index.php#contact"><i class="fas fa-link icon"></i>İletişim</a>
            <a href="login.php"><i class="fas fa-door-open icon"></i>Giriş Yap</a>
        </nav>
    </section>

    <section id="body">
    <div class="login-container">
        <div class="logo">
            <img src="images/YSOFT.png" alt="Logo">
        </div>
        <h1><hr>Yetkili Girişi <hr></h1>
        <form action="login.php" method="post">
            <div class="form-group">
                <i class="fa fa-user icon"></i>
                <label for="username"></label>
                <input type="text" id="username" name="usrnm" placeholder="Kullanıcı adınızı giriniz..." required>
            </div>

            <div class="form-group">
                <i class="fa fa-envelope icon"></i>
                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="E-Mail adresinizi giriniz..." required>
            </div>

            <div class="form-group">
                <i class="fa fa-key icon"></i>
                <label for="password"></label>
                <input type="password" id="password" name="password" minlength="8" placeholder="Şifrenizi giriniz..." required>
            </div>
            
            <button type="submit" class="login-button">Giriş Yap</button>
        </form><br>
    </div>
</section>


<section id="footer">
    <footer>
        <div id="footer">&copy; 2024 | YSoft
            <p>Tüm Hakları Saklıdır</p>
        </div>
        <div class="social_footer">
            <ul>
                <li><a href="#"><i class="fab fa-instagram account"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin account"></i></a></li>
                <li><a href="#"><i class="fab fa-github account"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus-g account"></i></a></li>
                <li><a href="#"><i class="fab fa-whatsapp account"></i></a></li>
            </ul>
        </div>
    </footer>
</section>

</body>

</html>

