<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    try {
        // Çalışan verisini sorgulama
        $sql = "SELECT * FROM calisan WHERE id = ?";
        $sth = $connect->prepare($sql);
        $sth->execute([$_GET["id"]]);
        $calisan = $sth->fetch(PDO::FETCH_ASSOC);

        if (!$calisan) {
            echo "Çalışan bulunamadı.";
            exit;
        }
    } catch (Exception $e) {
        echo "Hata: " . $e->getMessage();
        exit;
    }
} else {
    echo "Geçersiz istek.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="owl/owl.carousel.min.css">
    <link rel="stylesheet" href="owl/owl.theme.default.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="icon" href="images/ysoft_logo.png">
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="dashboard.css"> -->
    <title>YSoft | Çalışan Detay</title>
</head>
<body>

    <section id="menu">
        <div id="logo"><a href="index.php"><img src="images/YSOFT.png" alt=""></a></div>

        <nav>
            <a href="index.php"><i class="fas fa-home icon"></i>Anasayfa</a>
            <a href="index.php#about"><i class="fas fa-info icon"></i>Hakkımızda</a>
            <a href="index.php#mission"><i class="fas fa-dice icon"></i>Misyon&Vizyon</a>
            <a href="index.php#project"><i class="fas fa-code-branch icon"></i>Projelerimiz</a>
            <a href="admin-employee.php"><i class="fas fa-users icon"></i>Ekibimiz</a>
            <a href="index.php#contact"><i class="fas fa-link icon"></i>İletişim</a>
            <a href="login.php"><i class="fas fa-door-open icon"></i>Giriş Yap</a>
        </nav>
    </section>

    <header>
        <div class="container">
            <!-- <div class="row">
                <div class="col">
                    <h1 class="display-1 text-center">Tasarım Kodlama</h1>
                </div>
            </div> -->
            <div class="row">
                <div class="col">
                    <div class="btn-group">
                        <a href="admin-employee.php" class="btn btn-outline-primary">Çalışanlar</a>
                        <a href="create-employee.php" class="btn btn-outline-primary">Çalışan Ekle</a>
                    </div>
                </div>
            </div>
        </div>
    
    </header>

    <main>
    <div class="container mt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <?= htmlspecialchars($calisan['ad'] . ' ' . $calisan['soyad']) ?> Detayları
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Telefon:</strong> <?= htmlspecialchars($calisan['telefon']) ?></li>
                        <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($calisan['email']) ?></li>
                        <li class="list-group-item"><strong>Doğum Tarihi:</strong> <?= htmlspecialchars($calisan['dogum_tarihi']) ?></li>
                        <li class="list-group-item"><strong>Adres:</strong> <?= htmlspecialchars($calisan['adres']) ?></li>
                        <li class="list-group-item"><strong>Başlangıç Tarihi:</strong> <?= htmlspecialchars($calisan['baslangic_tarih']) ?></li>
                        <li class="list-group-item"><strong>Çıkış Tarihi:</strong> <?= htmlspecialchars($calisan['cikis_tarih'] ?? 'Halen Çalışıyor') ?></li>
                        <li class="list-group-item"><strong>Tazminat:</strong> <?= htmlspecialchars($calisan['tazminat'] ?? 'Belirtilmedi') ?></li>
                        <li class="list-group-item"><strong>Cinsiyet:</strong> <?= htmlspecialchars($calisan['cinsiyet']) ?></li>
                        <li class="list-group-item"><strong>Proje Durumu:</strong> <?= htmlspecialchars($calisan['proje']) ?></li>
                        <li class="list-group-item"><strong>Çalışan Durumu:</strong> <?= htmlspecialchars($calisan['calisan']) ?></li>
                    </ul>
                </div>
                <div class="card-footer text-end">
                    <a href="update-employee.php?id=<?= htmlspecialchars($calisan['ID']) ?>" class="btn btn-warning">Düzenle</a>
                    <a href="admin-employee.php" class="btn btn-secondary">Geri Dön</a>
                </div>
            </div>
        </div>
    </main>

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