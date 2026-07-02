<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    $_SESSION['error_message'] = 'ID FAQ tidak valid untuk dihapus.';
    echo "<script>window.location.href='dashboard.php?page=faq';</script>";
    exit;
}

$stmt = $conn->prepare("DELETE FROM `faq` WHERE `id` = ?");
if ($stmt) {
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'FAQ berhasil dihapus!';
    } else {
        $_SESSION['error_message'] = 'Gagal menghapus FAQ: ' . $stmt->error;
    }
    $stmt->close();
} else {
    $_SESSION['error_message'] = 'Terjadi kesalahan sistem: ' . $conn->error;
}

echo "<script>window.location.href='dashboard.php?page=faq';</script>";
exit;
