<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$uploadDir = __DIR__ . '/../../../uploads/menu/';

if ($id <= 0) {
    $_SESSION['error_message'] = 'ID menu tidak valid untuk dihapus.';
    echo "<script>window.location.href='dashboard.php?page=menu';</script>";
    exit;
}

// Ambil nama gambar sebelum dihapus, agar file ikut dibersihkan
$gambarNama = null;
$stmtSelect = $conn->prepare("SELECT `gambar` FROM `menu` WHERE `id` = ? LIMIT 1");
if ($stmtSelect) {
    $stmtSelect->bind_param('i', $id);
    $stmtSelect->execute();
    $res = $stmtSelect->get_result();
    $row = $res ? $res->fetch_assoc() : null;
    $gambarNama = $row['gambar'] ?? null;
    $stmtSelect->close();
}

// Lakukan penghapusan menu
$stmt = $conn->prepare("DELETE FROM `menu` WHERE `id` = ?");
if ($stmt) {
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        if (!empty($gambarNama) && file_exists($uploadDir . $gambarNama)) {
            unlink($uploadDir . $gambarNama);
        }
        $_SESSION['success_message'] = 'Menu berhasil dihapus!';
    } else {
        $_SESSION['error_message'] = 'Gagal menghapus menu: ' . $stmt->error;
    }
    $stmt->close();
} else {
    $_SESSION['error_message'] = 'Terjadi kesalahan sistem: ' . $conn->error;
}

// Gunakan javascript redirect karena ini script proses yang di-include
echo "<script>window.location.href='dashboard.php?page=menu';</script>";
exit;
