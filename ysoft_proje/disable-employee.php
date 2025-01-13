<?php
include "connection.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    try {
        $sql = "UPDATE calisan SET aktif = 0 WHERE ID = :id";
        $sth = $connect->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();

        if ($sth->rowCount()) {
            // İşlem başarılıysa bir alert mesajı göster ve kullanıcıyı geri yönlendir
            echo "<script>
                    alert('Çalışan başarıyla pasifleştirildi.');
                    window.location.href = 'admin-employee.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Çalışan bulunamadı veya zaten pasif.');
                    window.location.href = 'admin-employee.php';
                  </script>";
        }
    } catch (Exception $e) {
        die("Hata: " . $e->getMessage());
    }
} else {
    echo "<script>
            alert('Geçersiz istek.');
            window.location.href = 'admin-employee.php';
          </script>";
}
?>
