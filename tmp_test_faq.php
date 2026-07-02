<?php
require 'koneksi/db_connection.php';

echo "connect_error=" . ($conn->connect_error ?: 'none') . PHP_EOL;
$res = $conn->query("SHOW TABLES LIKE 'faq'");
echo "faq_exists=" . ($res ? $res->num_rows : 0) . PHP_EOL;
