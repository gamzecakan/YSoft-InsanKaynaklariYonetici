<?php
include "connection.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    try {
        $sql = "UPDATE calisan SET aktif = 1 WHERE ID = :id";
        $sth = $connect->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);
        $sth->execute();

        if ($sth->rowCount()) {
            // İşlem başarılı
            echo "<script>
                    alert('Çalışan başarıyla aktifleştirildi.');
                    window.location.href = 'admin-employee.php';
                  </script>";
        } else {
            // Çalışan zaten aktif
            echo "<script>
                    alert('Çalışan zaten aktif veya bulunamadı.');
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
