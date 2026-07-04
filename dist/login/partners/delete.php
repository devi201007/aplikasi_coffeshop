<?php
declare(strict_types=1);

if (!defined('DASHBOARD_ACCESS')) {
    header('Location: ../dashboard.php');
    exit;
}

$id = 0;
if (isset($_POST['id']) && $_POST['id'] !== '') {
    $id = (int) $_POST['id'];
} elseif (isset($_GET['id']) && $_GET['id'] !== '') {
    $id = (int) $_GET['id'];
}

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM `partners` WHERE `id` = ?");
    if ($stmt) {
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Partner berhasil dihapus!';
        } else {
            $_SESSION['error_message'] = 'Gagal menghapus partner: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['error_message'] = 'Terjadi kesalahan sistem: ' . $conn->error;
    }
}

header('Location: dashboard.php?page=partners');
exit;
