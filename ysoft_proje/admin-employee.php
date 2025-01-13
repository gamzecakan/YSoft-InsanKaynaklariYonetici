<?php
include "connection.php";

try {
    // GET ile gelen filtreleme değerlerini al
    $proje_durumu = isset($_GET['proje_durumu']) ? $_GET['proje_durumu'] : '';
    $calisan_durumu = isset($_GET['calisan_durumu']) ? $_GET['calisan_durumu'] : '';
    $aktif = isset($_GET['aktif']) && $_GET['aktif'] !== '' ? $_GET['aktif'] : '';

    // Temel SQL sorgusu
    $sql = "SELECT * FROM calisan WHERE 1=1";

    // Filtreleme koşulları ekleme
    if (!empty($proje_durumu)) {
        $sql .= " AND proje = :proje_durumu";
    }
    if (!empty($calisan_durumu)) {
        $sql .= " AND calisan = :calisan_durumu";
    }
    if ($aktif !== '') { // Aktif/pasif durumu için kontrol
        $sql .= " AND aktif = :aktif";
    }

    // Sorguyu hazırlama ve filtre değerlerini bağlama
    $sth = $connect->prepare($sql);
    if (!empty($proje_durumu)) {
        $sth->bindParam(':proje_durumu', $proje_durumu, PDO::PARAM_STR);
    }
    if (!empty($calisan_durumu)) {
        $sth->bindParam(':calisan_durumu', $calisan_durumu, PDO::PARAM_STR);
    }
    if ($aktif !== '') {
        $sth->bindParam(':aktif', $aktif, PDO::PARAM_INT); // 1 veya 0 olmalı
    }

    // Sorguyu çalıştır
    $sth->execute();
    $calisanlar = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Hata: " . $e->getMessage());
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
    <title>YSoft | Admin Paneli</title>

    <script>
    function confirmDisable(ID) {
            // Kullanıcıdan onay al
            const confirmation = confirm("Bu çalışanı pasifleştirmek istediğinize emin misiniz?");
            if (confirmation) {
                // Onaylandıysa ilgili PHP dosyasına yönlendir
                window.location.href = "disable-employee.php?id=" + ID;
            }
        }
    </script>

    <script>
        function confirmEnable(id) {
            if (confirm("Bu çalışanı aktifleştirmek istiyor musunuz?")) {
                window.location.href = `enable-employee.php?id=${id}`;
            }
        }

    </script>

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
        <div class="row">
            <div class="col">
                <form id="filter-form" class="d-inline-flex" method="GET" action="admin-employee.php">
                    <select name="proje_durumu" class="form-select me-2">
                        <option value="">Proje Durumu</option>
                        <option value="Tamamlanmadı">Tamamlanmadı</option>
                        <option value="Tamamlandı">Tamamlandı</option>
                    </select>
                    <select name="calisan_durumu" class="form-select me-2">
                        <option value="">Çalışan Durumu</option>
                        <option value="Atandı">Atandı</option>
                        <option value="Atanmadı">Atanmadı</option>
                    </select>
                    <select name="aktif" class="form-select me-2">
                        <option value="">Durum</option>
                        <option value="1">Aktif</option>
                        <option value="0">Pasif</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary">Filtrele</button>
                </form>
            </div>
            <div class="col text-end">
                <a href="logout.php" class="btn btn-danger">Çıkış Yap</a>
            </div>
        </div>
        <div class="row mt-3">
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
            <div class="row mt-4">
                <div class="col">
                <table class="table table-bordered table-hover border-primary">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ad</th>
                        <th>Soyad</th>
                        <th>Telefon</th>
                        <th>E-Mail</th>
                        <!-- <th>Doğum Tarihi</th> -->
                        <th>Proje Durumu</th>
                        <th>Çalışan Durumu</th>
                        <th>Durum</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($calisanlar as $calisan): ?>
                <tr>
                    <td><?= htmlspecialchars($calisan['ID']) ?></td>
                    <td><?= htmlspecialchars($calisan['ad']) ?></td>
                    <td><?= htmlspecialchars($calisan['soyad']) ?></td>
                    <td><?= htmlspecialchars($calisan['telefon']) ?></td>
                    <td><?= htmlspecialchars($calisan['email']) ?></td>
                    <td><?= htmlspecialchars($calisan['proje']) ?></td>
                    <td><?= htmlspecialchars($calisan['calisan']) ?></td>
                    <td><?= $calisan['aktif'] == 1 ? 'Aktif' : 'Pasif' ?></td>

                    <td>
                        <div class="btn-group">
                            <a href="read-employee.php?id=<?= htmlspecialchars($calisan['ID']) ?>" class="btn btn-success">Detay</a>
                            <a href="update-employee.php?id=<?= htmlspecialchars($calisan['ID']) ?>" class="btn btn-warning">Güncelle</a>
                            <button class="btn btn-secondary" onclick="confirmDisable(<?= htmlspecialchars($calisan['ID']) ?>)">Pasifleştir</button>
                            <button class="btn btn-danger" onclick="confirmEnable(<?= htmlspecialchars($calisan['ID']) ?>)">Aktifleştir</button>
                            </div>
                    </td>

                </tr>
            <?php endforeach; ?>
                </tbody>
                </table>
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