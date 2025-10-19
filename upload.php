<?php
header('Content-Type: application/json');

// Rasm yuklash uchun papka
$uploadDir = '../uploads/';

// Agar papka mavjud bo'lmasa, yaratish
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $file = $_FILES['image'];
        
        // Fayl ma'lumotlari
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        
        // Fayl kengaytmasini olish
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Ruxsat etilgan kengaytmalar
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
        if (in_array($fileExt, $allowed)) {
            // Maksimal fayl hajmi (5MB)
            if ($fileSize < 5000000) {
                // Yangi fayl nomi (unique)
                $newFileName = uniqid('blog_', true) . '.' . $fileExt;
                $fileDestination = $uploadDir . $newFileName;
                
                // Faylni yuklash
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Rasm muvaffaqiyatli yuklandi',
                        'url' => 'uploads/' . $newFileName
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Faylni saqlashda xatolik'
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Fayl hajmi 5MB dan oshmasligi kerak'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Faqat JPG, JPEG, PNG, GIF, WEBP formatdagi rasmlar qabul qilinadi'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Rasm yuklanmadi yoki xatolik yuz berdi'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Noto\'g\'ri so\'rov metodi'
    ]);
}
?>