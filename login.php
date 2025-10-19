<?php
// ============================================
// login.php
// Admin login sahifasi
// ============================================

session_start();

// Agar admin allaqachon login qilgan bo'lsa
if (isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.php');
    exit();
}

$error = '';

// Login forma yuborilganda
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once 'config/database.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (empty($username) || empty($password)) {
        $error = 'Barcha maydonlarni to\'ldiring';
    } else {
        $query = "SELECT * FROM admins WHERE username = :username LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $admin = $stmt->fetch();
        
        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: admin.php');
            exit();
        } else {
            $error = 'Login yoki parol noto\'g\'ri';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Bekhruz DEV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');
        
        body {
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(135deg, #0a0a23, #1a1a4d);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0ff;
        }
        
        .login-container {
            background: rgba(20, 20, 50, 0.9);
            border: 2px solid #0ff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.5);
            max-width: 400px;
            width: 100%;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h2 {
            color: #0ff;
            text-shadow: 0 0 10px #0ff;
            margin-bottom: 10px;
        }
        
        .login-header i {
            font-size: 3rem;
            color: #0ff;
            margin-bottom: 15px;
        }
        
        .form-control {
            background: rgba(10, 10, 35, 0.8);
            border: 1px solid #0ff;
            color: #0ff;
            padding: 12px;
        }
        
        .form-control:focus {
            background: rgba(10, 10, 35, 0.9);
            border-color: #ff0;
            box-shadow: 0 0 10px #ff0;
            color: #0ff;
        }
        
        .form-control::placeholder {
            color: rgba(0, 255, 255, 0.5);
        }
        
        .form-label {
            color: #0ff;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        .btn-login {
            background: #0ff;
            border: none;
            color: #0a0a23;
            font-weight: bold;
            padding: 12px;
            width: 100%;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background: #ff0;
            color: #0a0a23;
            box-shadow: 0 0 20px #ff0;
            transform: translateY(-2px);
        }
        
        .alert {
            background: rgba(255, 0, 0, 0.2);
            border: 1px solid #f00;
            color: #f00;
            border-radius: 8px;
        }
        
        .input-group-text {
            background: rgba(0, 255, 255, 0.2);
            border: 1px solid #0ff;
            color: #0ff;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <i class="fas fa-user-shield"></i>
            <h2>Admin Panel</h2>
            <p>Bekhruz DEV</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">
                    <i class="fas fa-user"></i> Username
                </label>
                <input type="text" class="form-control" id="username" name="username" 
                       placeholder="Username kiriting" required autofocus>
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label">
                    <i class="fas fa-lock"></i> Parol
                </label>
                <input type="password" class="form-control" id="password" name="password" 
                       placeholder="Parol kiriting" required>
            </div>
            
            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt"></i> Kirish
            </button>
        </form>
        
        <div class="text-center mt-3" style="font-size: 0.85rem; opacity: 0.7;">
            <p>Default: username: <strong>admin</strong>, password: <strong>admin123</strong></p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>