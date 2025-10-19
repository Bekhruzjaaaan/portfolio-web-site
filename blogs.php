<?php
// ============================================
// api/blogs.php
// Bloglar uchun API
// ============================================

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

// GET - Bloglarni olish
if ($method === 'GET') {
    
    // Bitta blogni olish
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $query = "SELECT * FROM blogs WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $blog = $stmt->fetch();
        if ($blog) {
            $blog['date'] = date('d.m.Y', strtotime($blog['created_at']));
            $blog['excerpt'] = mb_substr($blog['content'], 0, 100) . '...';
            echo json_encode($blog);
        } else {
            echo json_encode(['success' => false, 'message' => 'Blog topilmadi']);
        }
    } 
    // Barcha bloglarni olish
    else {
        $query = "SELECT * FROM blogs ORDER BY created_at DESC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        $blogs = [];
        while ($row = $stmt->fetch()) {
            $row['date'] = date('d.m.Y', strtotime($row['created_at']));
            $row['excerpt'] = mb_substr($row['content'], 0, 100) . '...';
            $blogs[] = $row;
        }
        
        echo json_encode($blogs);
    }
}

// POST - Yangi blog qo'shish
elseif ($method === 'POST') {
    session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        echo json_encode(['success' => false, 'message' => 'Ruxsat yo\'q']);
        exit();
    }
    
    $data = json_decode(file_get_contents("php://input"));
    
    if (empty($data->title) || empty($data->content) || empty($data->image) || empty($data->category)) {
        echo json_encode(['success' => false, 'message' => 'Barcha maydonlarni to\'ldiring']);
        exit();
    }
    
    $query = "INSERT INTO blogs (title, content, image, category) VALUES (:title, :content, :image, :category)";
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':title', $data->title);
    $stmt->bindParam(':content', $data->content);
    $stmt->bindParam(':image', $data->image);
    $stmt->bindParam(':category', $data->category);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'Blog muvaffaqiyatli qo\'shildi',
            'id' => $db->lastInsertId()
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Xatolik yuz berdi']);
    }
}

// PUT - Blogni yangilash
elseif ($method === 'PUT') {
    session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        echo json_encode(['success' => false, 'message' => 'Ruxsat yo\'q']);
        exit();
    }
    
    $data = json_decode(file_get_contents("php://input"));
    
    if (empty($data->id)) {
        echo json_encode(['success' => false, 'message' => 'Blog ID kerak']);
        exit();
    }
    
    $query = "UPDATE blogs SET title = :title, content = :content, image = :image, category = :category WHERE id = :id";
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(':id', $data->id);
    $stmt->bindParam(':title', $data->title);
    $stmt->bindParam(':content', $data->content);
    $stmt->bindParam(':image', $data->image);
    $stmt->bindParam(':category', $data->category);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Blog yangilandi']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Xatolik yuz berdi']);
    }
}

// DELETE - Blogni o'chirish
elseif ($method === 'DELETE') {
    session_start();
    if (!isset($_SESSION['admin_logged_in'])) {
        echo json_encode(['success' => false, 'message' => 'Ruxsat yo\'q']);
        exit();
    }
    
    $data = json_decode(file_get_contents("php://input"));
    
    if (empty($data->id)) {
        echo json_encode(['success' => false, 'message' => 'Blog ID kerak']);
        exit();
    }
    
    $query = "DELETE FROM blogs WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $data->id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Blog o\'chirildi']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Xatolik yuz berdi']);
    }
}

else {
    echo json_encode(['success' => false, 'message' => 'Noto\'g\'ri so\'rov']);
}
?>