<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Bekhruz DEV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Share+Tech+Mono&display=swap');

        body {
            font-family: 'Share Tech Mono', monospace;
            background: #0a0a23;
            color: #0ff;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: rgba(10, 10, 35, 0.95);
            border-right: 2px solid #0ff;
            padding: 20px;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar h3 {
            color: #0ff;
            text-shadow: 0 0 10px #0ff;
            margin-bottom: 30px;
            font-family: 'Orbitron', sans-serif;
        }

        .sidebar .nav-link {
            color: #0ff;
            padding: 12px 15px;
            margin: 5px 0;
            border: 1px solid transparent;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(0, 255, 255, 0.2);
            border-color: #0ff;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .card {
            background: rgba(20, 20, 50, 0.8);
            border: 1px solid #0ff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.2);
            margin-bottom: 20px;
        }

        .card-header {
            background: rgba(0, 255, 255, 0.1);
            border-bottom: 1px solid #0ff;
            color: #0ff;
            font-weight: bold;
        }

        .table {
            color: #0ff;
        }

        .table thead {
            border-bottom: 2px solid #0ff;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(0, 255, 255, 0.2);
        }

        .table tbody tr:hover {
            background: rgba(0, 255, 255, 0.1);
        }

        .btn-primary {
            background: #0ff;
            border: none;
            color: #0a0a23;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: #ff0;
            color: #0a0a23;
            box-shadow: 0 0 15px #ff0;
        }

        .btn-danger {
            background: #f00;
            border: none;
            color: #fff;
        }

        .btn-warning {
            background: #ff0;
            border: none;
            color: #0a0a23;
            font-weight: bold;
        }

        .form-control, .form-select {
            background: rgba(20, 20, 50, 0.8);
            border: 1px solid #0ff;
            color: #0ff;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(20, 20, 50, 0.9);
            border-color: #ff0;
            box-shadow: 0 0 10px #ff0;
            color: #0ff;
        }

        .form-label {
            color: #0ff;
            font-weight: bold;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.1), rgba(0, 255, 255, 0.2));
            border: 2px solid #0ff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        }

        .stat-card h3 {
            color: #0ff;
            font-size: 2.5rem;
            margin: 10px 0;
        }

        .stat-card p {
            color: #0ff;
            margin: 0;
            opacity: 0.8;
        }

        .modal-content {
            background: rgba(10, 10, 35, 0.95);
            border: 2px solid #0ff;
            color: #0ff;
        }

        .modal-header {
            border-bottom: 1px solid #0ff;
        }

        .modal-footer {
            border-top: 1px solid #0ff;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            border: 2px solid #0ff;
            border-radius: 5px;
            display: none;
        }

        .upload-area {
            border: 2px dashed #0ff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: rgba(0, 255, 255, 0.05);
        }

        .upload-area:hover {
            background: rgba(0, 255, 255, 0.1);
            border-color: #ff0;
        }

        .upload-area i {
            font-size: 3rem;
            color: #0ff;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3><i class="fas fa-user-shield"></i> Admin Panel</h3>
        <nav class="nav flex-column">
            <a class="nav-link active" href="#" onclick="showSection('dashboard')">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a class="nav-link" href="#" onclick="showSection('blogs')">
                <i class="fas fa-blog"></i> Bloglar
            </a>
            <a class="nav-link" href="#" onclick="showSection('messages')">
                <i class="fas fa-envelope"></i> Xabarlar
                <span class="badge bg-danger" id="unreadCount">0</span>
            </a>
            <a class="nav-link" href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Chiqish
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Dashboard Section -->
        <div id="dashboard" class="content-section active">
            <h2 class="mb-4"><i class="fas fa-chart-line"></i> Dashboard</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card">
                        <i class="fas fa-blog fa-2x"></i>
                        <h3 id="totalBlogs">0</h3>
                        <p>Jami Bloglar</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <i class="fas fa-envelope fa-2x"></i>
                        <h3 id="totalMessages">0</h3>
                        <p>Jami Xabarlar</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <i class="fas fa-envelope-open fa-2x"></i>
                        <h3 id="unreadMessages">0</h3>
                        <p>O'qilmagan Xabarlar</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blogs Section -->
        <div id="blogs" class="content-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-blog"></i> Bloglarni Boshqarish</h2>
                <button class="btn btn-primary" onclick="openBlogModal()">
                    <i class="fas fa-plus"></i> Yangi Blog
                </button>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Rasm</th>
                                    <th>Sarlavha</th>
                                    <th>Kategoriya</th>
                                    <th>Sana</th>
                                    <th>Amallar</th>
                                </tr>
                            </thead>
                            <tbody id="blogTableBody">
                                <tr>
                                    <td colspan="6" class="text-center">Yuklanmoqda...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages Section -->
        <div id="messages" class="content-section">
            <h2 class="mb-4"><i class="fas fa-envelope"></i> Xabarlar</h2>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ism</th>
                                    <th>Email</th>
                                    <th>Xabar</th>
                                    <th>Sana</th>
                                    <th>Holat</th>
                                    <th>Amallar</th>
                                </tr>
                            </thead>
                            <tbody id="messageTableBody">
                                <tr>
                                    <td colspan="7" class="text-center">Yuklanmoqda...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Modal -->
    <div class="modal fade" id="blogModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blogModalTitle">Yangi Blog Qo'shish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="blogForm" enctype="multipart/form-data">
                        <input type="hidden" id="blogId">
                        <div class="mb-3">
                            <label for="blogTitle" class="form-label">Sarlavha</label>
                            <input type="text" class="form-control" id="blogTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="blogContent" class="form-label">Matn</label>
                            <textarea class="form-control" id="blogContent" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rasm</label>
                            <div class="upload-area" onclick="document.getElementById('blogImageFile').click()">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Rasm yuklash uchun bosing</p>
                                <small>yoki havolani kiriting</small>
                            </div>
                            <input type="file" id="blogImageFile" accept="image/*" style="display: none;" onchange="previewImage(this)">
                            <input type="url" class="form-control mt-2" id="blogImageUrl" placeholder="yoki rasm havolasini kiriting">
                            <img id="imagePreview" class="image-preview" src="" alt="Preview">
                        </div>
                        <div class="mb-3">
                            <label for="blogCategory" class="form-label">Kategoriya</label>
                            <select class="form-select" id="blogCategory" required>
                                <option value="texnologiya">Texnologiya</option>
                                <option value="dasturlash">Dasturlash</option>
                                <option value="dizayn">Dizayn</option>
                                <option value="umumiy">Umumiy</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="button" class="btn btn-primary" onclick="saveBlog()">Saqlash</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Message View Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-envelope-open"></i> Xabar Tafsilotlari</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Ism:</label>
                        <p class="ps-3" id="msgName"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-envelope"></i> Email:</label>
                        <p class="ps-3" id="msgEmail"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-calendar"></i> Sana:</label>
                        <p class="ps-3" id="msgDate"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-comment"></i> Xabar:</label>
                        <div class="p-3" style="background: rgba(0, 255, 255, 0.05); border-left: 3px solid #0ff; border-radius: 5px;">
                            <p id="msgContent" style="margin: 0; white-space: pre-wrap;"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Yopish
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let blogModal;
        let messageModal;

        document.addEventListener('DOMContentLoaded', function() {
            blogModal = new bootstrap.Modal(document.getElementById('blogModal'));
            messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
            loadDashboard();
            loadBlogs();
            loadMessages();
        });

        // Show section
        function showSection(sectionId) {
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');
            
            document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                link.classList.remove('active');
            });
            event.target.closest('.nav-link').classList.add('active');
        }

        // Load Dashboard
        function loadDashboard() {
            fetch('api/blogs.php')
                .then(r => r.json())
                .then(data => {
                    document.getElementById('totalBlogs').textContent = data.length;
                });

            fetch('api/contact.php')
                .then(r => r.json())
                .then(data => {
                    document.getElementById('totalMessages').textContent = data.length;
                    const unread = data.filter(m => m.is_read == 0).length;
                    document.getElementById('unreadMessages').textContent = unread;
                    document.getElementById('unreadCount').textContent = unread;
                });
        }

        // Preview Image
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Load Blogs
        function loadBlogs() {
            fetch('api/blogs.php')
                .then(r => r.json())
                .then(data => {
                    const tbody = document.getElementById('blogTableBody');
                    if (data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="6" class="text-center">Bloglar yo\'q</td></tr>';
                        return;
                    }
                    tbody.innerHTML = data.map(blog => `
                        <tr>
                            <td>${blog.id}</td>
                            <td><img src="${blog.image}" alt="Blog" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; border: 1px solid #0ff;"></td>
                            <td>${blog.title}</td>
                            <td><span class="badge bg-info">${blog.category}</span></td>
                            <td>${blog.date}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick="editBlog(${blog.id})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteBlog(${blog.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `).join('');
                });
        }

        // Load Messages
        function loadMessages() {
            fetch('api/contact.php')
                .then(r => r.json())
                .then(data => {
                    const tbody = document.getElementById('messageTableBody');
                    if (data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="7" class="text-center">Xabarlar yo\'q</td></tr>';
                        return;
                    }
                    tbody.innerHTML = data.map(msg => `
                        <tr>
                            <td>${msg.id}</td>
                            <td>${msg.name}</td>
                            <td>${msg.email}</td>
                            <td>${msg.message.substring(0, 50)}...</td>
                            <td>${msg.date}</td>
                            <td>${msg.is_read == 1 ? '<span class="badge bg-success">O\'qilgan</span>' : '<span class="badge bg-warning">Yangi</span>'}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="viewMessage(${msg.id})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteMessage(${msg.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `).join('');
                });
        }

        // Open Blog Modal
        function openBlogModal(id = null) {
            document.getElementById('blogForm').reset();
            document.getElementById('blogId').value = '';
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('blogModalTitle').textContent = 'Yangi Blog Qo\'shish';
            blogModal.show();
        }

        // Edit Blog
        function editBlog(id) {
            fetch(`api/blogs.php?id=${id}`)
                .then(r => r.json())
                .then(blog => {
                    document.getElementById('blogId').value = blog.id;
                    document.getElementById('blogTitle').value = blog.title;
                    document.getElementById('blogContent').value = blog.content;
                    document.getElementById('blogImageUrl').value = blog.image;
                    document.getElementById('blogCategory').value = blog.category;
                    document.getElementById('imagePreview').src = blog.image;
                    document.getElementById('imagePreview').style.display = 'block';
                    document.getElementById('blogModalTitle').textContent = 'Blogni Tahrirlash';
                    blogModal.show();
                });
        }

        // Save Blog
        async function saveBlog() {
            const id = document.getElementById('blogId').value;
            const imageFile = document.getElementById('blogImageFile').files[0];
            const imageUrl = document.getElementById('blogImageUrl').value;
            
            let finalImageUrl = imageUrl;
            
            // Agar fayl yuklangan bo'lsa
            if (imageFile) {
                const formData = new FormData();
                formData.append('image', imageFile);
                
                try {
                    const uploadResponse = await fetch('api/upload.php', {
                        method: 'POST',
                        body: formData
                    });
                    const uploadResult = await uploadResponse.json();
                    
                    if (uploadResult.success) {
                        finalImageUrl = uploadResult.url;
                    } else {
                        alert('Rasm yuklashda xatolik: ' + uploadResult.message);
                        return;
                    }
                } catch (error) {
                    alert('Rasm yuklashda xatolik!');
                    return;
                }
            }
            
            const data = {
                title: document.getElementById('blogTitle').value,
                content: document.getElementById('blogContent').value,
                image: finalImageUrl,
                category: document.getElementById('blogCategory').value
            };

            const method = id ? 'PUT' : 'POST';
            if (id) data.id = id;

            fetch('api/blogs.php', {
                method: method,
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            })
            .then(r => r.json())
            .then(result => {
                alert(result.message);
                if (result.success) {
                    blogModal.hide();
                    loadBlogs();
                    loadDashboard();
                }
            });
        }

        // Delete Blog
        function deleteBlog(id) {
            if (!confirm('Blogni o\'chirmoqchimisiz?')) return;
            
            fetch('api/blogs.php', {
                method: 'DELETE',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id: id})
            })
            .then(r => r.json())
            .then(result => {
                alert(result.message);
                if (result.success) {
                    loadBlogs();
                    loadDashboard();
                }
            });
        }

        // View Message
        function viewMessage(id) {
            // Xabarni o'qilgan deb belgilash
            fetch('api/contact.php', {
                method: 'PUT',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id: id, is_read: 1})
            })
            .then(r => r.json())
            .then(() => {
                // Xabar tafsilotlarini olish
                fetch(`api/contact.php?id=${id}`)
                    .then(r => r.json())
                    .then(msg => {
                        document.getElementById('msgName').textContent = msg.name;
                        document.getElementById('msgEmail').textContent = msg.email;
                        document.getElementById('msgDate').textContent = msg.date;
                        document.getElementById('msgContent').textContent = msg.message;
                        messageModal.show();
                        // Ma'lumotlarni yangilash
                        loadMessages();
                        loadDashboard();
                    });
            });
        }

        // Delete Message
        function deleteMessage(id) {
            if (!confirm('Xabarni o\'chirmoqchimisiz?')) return;
            
            fetch('api/contact.php', {
                method: 'DELETE',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id: id})
            })
            .then(r => r.json())
            .then(result => {
                alert(result.message);
                if (result.success) {
                    loadMessages();
                    loadDashboard();
                }
            });
        }
    </script>
</body>
</html>