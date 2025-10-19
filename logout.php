<?php
// ============================================
// logout.php
// Admin chiqish sahifasi
// ============================================

session_start();
session_destroy();
header('Location: login.php');
exit();
?>