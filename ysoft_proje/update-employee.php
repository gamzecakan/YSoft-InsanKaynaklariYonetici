<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    try {
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
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    try {
        $sql = "UPDATE calisan 
                SET ad = ?, soyad = ?, telefon = ?, email = ?, dogum_tarihi = ?, 
                    adres = ?, baslangic_tarih = ?, cikis_tarih = ?, tazminat = ?, 
                    cinsiyet = ?, proje = ?, calisan = ? 
                WHERE id = ?";
        
        $dizi = [
            $_POST["ad"], $_POST["soyad"], $_POST["telefon"], $_POST["email"], $_POST["dogum_tarihi"],
            $_POST["adres"], $_POST["baslangic_tarih"], $_POST["cikis_tarih"], $_POST["tazminat"], 
            $_POST["cinsiyet"], $_POST["proje"], $_POST["calisan"], $_POST["id"]
        ];

        $sth = $connect->prepare($sql);
        if ($sth->execute($dizi)) {
            echo "Veri başarıyla güncellendi!";
            header("Location: admin-employee.php");
            exit;
        } else {
            throw new Exception("Veri güncellenirken hata oluştu.");
        }
    } catch (Exception $e) {
        echo "Hata: " . $e->getMessage();
    }
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
    <title>YSoft | Çalışan Güncelle</title>
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
    <div class="container">
            <form method="POST" action="update-employee.php" class="row mt-4 g-3">
                <input type="hidden" name="id" value="<?= $calisan['ID'] ?>">
                
                <div class="col-6">
                    <label for="ad" class="form-label">Ad:</label>
                    <input type="text" name="ad" id="ad" class="form-control" value="<?= $calisan['ad'] ?>" required>
                </div>

                <div class="col-6">
                    <label for="soyad" class="form-label">Soyad:</label>
                    <input type="text" name="soyad" id="soyad" class="form-control" value="<?= $calisan['soyad'] ?>" required>
                </div>

                <div class="col-6">
                    <label for="telefon" class="form-label">Telefon:</label>
                    <input type="text" name="telefon" id="telefon" class="form-control" value="<?= $calisan['telefon'] ?>" required>
                </div>

                <div class="col-6">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $calisan['email'] ?>" required>
                </div>

                <div class="col-6">
                    <label for="dogum_tarihi" class="form-label">Doğum Tarihi:</label>
                    <input type="date" name="dogum_tarihi" id="dogum_tarihi" class="form-control" value="<?= $calisan['dogum_tarihi'] ?>" required>
                </div>

                <div class="col-6">
                    <label for="adres" class="form-label">Adres:</label>
                    <textarea name="adres" id="adres" class="form-control" required><?= $calisan['adres'] ?></textarea>
                </div>

                <div class="col-6">
                    <label for="baslangic_tarih" class="form-label">Başlangıç Tarihi:</label>
                    <input type="date" name="baslangic_tarih" id="baslangic_tarih" class="form-control" value="<?= $calisan['baslangic_tarih'] ?>" required>
                </div>

                <div class="col-6">
                    <label for="cikis_tarih" class="form-label">Çıkış Tarihi:</label>
                    <input type="date" name="cikis_tarih" id="cikis_tarih" class="form-control" value="<?= $calisan['cikis_tarih'] ?>">
                </div>

                <div class="col-6">
                    <label for="tazminat" class="form-label">Tazminat:</label>
                    <input type="number" step="0.01" name="tazminat" id="tazminat" class="form-control" value="<?= $calisan['tazminat'] ?>">
                </div>

                <div class="col-6">
                    <label for="cinsiyet" class="form-label">Cinsiyet:</label>
                    <select name="cinsiyet" id="cinsiyet" class="form-control" required>
                        <option value="Erkek" <?= $calisan['cinsiyet'] === 'Erkek' ? 'selected' : '' ?>>Erkek</option>
                        <option value="Kadın" <?= $calisan['cinsiyet'] === 'Kadın' ? 'selected' : '' ?>>Kadın</option>
                    </select>
                </div>

                <div class="col-6">
                    <label for="proje" class="form-label">Proje Durumu:</label>
                    <select name="proje" id="proje" class="form-control" required>
                        <option value="Tamamlanmadı" <?= $calisan['proje'] === 'Tamamlanmadı' ? 'selected' : '' ?>>Tamamlanmadı</option>
                        <option value="Tamamlandı" <?= $calisan['proje'] === 'Tamamlandı' ? 'selected' : '' ?>>Tamamlandı</option>
                    </select>
                </div>

                <div class="col-6">
                    <label for="calisan" class="form-label">Çalışan Durumu:</label>
                    <select name="calisan" id="calisan" class="form-control" required>
                        <option value="Atandı" <?= $calisan['calisan'] === 'Atandı' ? 'selected' : '' ?>>Atandı</option>
                        <option value="Atanmadı" <?= $calisan['calisan'] === 'Atanmadı' ? 'selected' : '' ?>>Atanmadı</option>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        
                <!-- <div class="col-6">Durum : <br>
                    <label for="durum" class="form-label">
                        Aktif <input type="radio" id="aktif" name="cdurum" value="A">
                    </label>
                    <label for="cinsiyetE" class="form-label">
                        Pasif <input type="radio" id="pasif" name="cdurum" value="P">
                    </label>
                </div> -->
               
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