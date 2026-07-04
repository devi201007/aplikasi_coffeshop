<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    $_SESSION['error_message'] = 'ID berita tidak valid untuk dihapus.';
    echo "<script>window.location.href='dashboard.php?page=berita';</script>";
    exit;
}

// Lakukan penghapusan berita
$stmt = $conn->prepare("DELETE FROM `berita` WHERE `id` = ?");
if ($stmt) {
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Berita berhasil dihapus!';
    } else {
        $_SESSION['error_message'] = 'Gagal menghapus berita: ' . $stmt->error;
    }
    $stmt->close();
} else {
    $_SESSION['error_message'] = 'Terjadi kesalahan sistem: ' . $conn->error;
}

// Gunakan output buffer / javascript redirect karena ini script proses yang di-include
echo "<script>window.location.href='dashboard.php?page=berita';</script>";
exit;
