<?php
// ============================================
// api/contact.php
// Kontakt xabarlari uchun API
// ============================================

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

// POST - Yangi xabar qo'shish
if ($method === 'POST') {
    
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    // Validatsiya
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode([
            'success' => false, 
            'message' => 'Barcha maydonlarni to\'ldiring'
        ]);
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false, 
            'message' => 'Email noto\'g\'ri formatda'
        ]);
        exit();
    }
    
    // Ma'lumotlarni saqlash
    $query = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'Xabaringiz muvaffaqiyatli yuborildi! Tez orada javob beramiz.'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Xatolik yuz berdi. Iltimos, qaytadan urinib ko\'ring.'
        ]);
    }
}

// GET - Xabarlarni olish (faqat admin uchun)
elseif ($method === 'GET') {
    session_start();
    
    if (!isset($_SESSION['admin_logged_in'])) {
        echo json_encode(['success' => false, 'message' => 'Ruxsat yo\'q']);
        exit();
    }
    
    // Bitta xabarni olish
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $query = "SELECT * FROM messages WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $message = $stmt->fetch();
        if ($message) {
            $message['date'] = date('d.m.Y H:i', strtotime($message['created_at']));
            echo json_encode($message);
        } else {
            echo json_encode(['success' => false, 'message' => 'Xabar topilmadi']);
        }
    } 
    // Barcha xabarlarni olish
    else {
        $query = "SELECT * FROM messages ORDER BY created_at DESC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $messages = [];
        while ($row = $stmt->fetch()) {
            $row['date'] = date('d.m.Y H:i', strtotime($row['created_at']));
            $messages[] = $row;
        }
        
        echo json_encode($messages);
    }
}

else {
    echo json_encode(['success' => false, 'message' => 'Noto\'g\'ri so\'rov']);
}
?>