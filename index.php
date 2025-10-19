.card-img-top {
            filter: grayscale(50%) brightness(80%);
            transition: filter 0.3s;
            height: 250px;
            object-fit: cover;
        }<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bekhruz DEV - Full Stack dasturchi. Zamonaviy va responsiv veb-saytlar yarataman.">
    <title>Bekhruz DEV - Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Share+Tech+Mono&display=swap');

        body {
            font-family: 'Share Tech Mono', monospace;
            background: #0a0a23;
            color: #0ff;
            overflow-x: hidden;
        }

        .hero-section {
            min-height: 100vh;
            background: linear-gradient(rgba(10, 10, 35, 0.85), rgba(10, 10, 35, 0.85)), url(https://inspay.uz/uploads/background.png);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #0ff;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 50% 50%, rgba(0, 255, 255, 0.1) 0%, transparent 50%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }

        .hero-section .container {
            position: relative;
            z-index: 1;
        }

        .hero-section h1 {
            font-size: 4rem;
            font-weight: 700;
            background: linear-gradient(135deg, #0ff 0%, #00ff88 50%, #0ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: none;
            animation: glow 2s ease-in-out infinite alternate;
            margin-bottom: 1rem;
        }

        @keyframes glow {
            from {
                filter: drop-shadow(0 0 10px #0ff) drop-shadow(0 0 20px #0ff);
            }
            to {
                filter: drop-shadow(0 0 20px #0ff) drop-shadow(0 0 30px #00ff88);
            }
        }

        .hero-section .lead {
            font-size: 1.5rem;
            color: #0ff;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
            margin-bottom: 2rem;
        }
      
        .navbar-toggler {
            background-color: #00ffff !important;
        }

        .navbar {
            transition: background-color 0.3s;
            background: rgba(10, 10, 35, 0.8);
            backdrop-filter: blur(5px);
        }

        .navbar.scrolled {
            background: rgba(10, 10, 35, 0.95);
            box-shadow: 0 0 10px #0ff;
        }

        .navbar-brand, .nav-link {
            color: #0ff !important;
            text-shadow: 0 0 5px #0ff;
            font-family: 'Orbitron', sans-serif;
        }

        .nav-link:hover {
            color: #ff0 !important;
            text-shadow: 0 0 10px #ff0;
        }

        .project-card, .blog-card {
            background: rgba(20, 20, 50, 0.8);
            border: 1px solid #0ff;
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }

        .project-card:hover, .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 0 20px #0ff;
        }

        .card-img-top {
            filter: grayscale(50%) brightness(80%);
            transition: filter 0.3s;
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .project-card:hover .card-img-top, .blog-card:hover .card-img-top {
            filter: grayscale(0%) brightness(100%);
        }

        .filter-btn {
            margin: 5px;
            border: 1px solid #0ff;
            color: #0ff;
            background: transparent;
            transition: all 0.3s;
        }

        .filter-btn:hover, .filter-btn.active {
            background: #0ff;
            color: #0a0a23;
            box-shadow: 0 0 10px #0ff;
        }

        .social-icons a {
            font-size: 1.8rem;
            margin: 0 15px;
            color: #0ff;
            text-shadow: 0 0 5px #0ff;
            transition: all 0.3s;
            display: inline-block;
        }

        .social-icons a:hover {
            color: #ff0;
            text-shadow: 0 0 10px #ff0;
            transform: scale(1.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #0ff 0%, #00ff88 100%);
            border: none;
            color: #0a0a23;
            font-weight: bold;
            transition: all 0.3s;
            padding: 12px 40px;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #00ff88 0%, #0ff 100%);
            transition: left 0.3s;
        }

        .btn-primary:hover::before {
            left: 0;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 255, 255, 0.5);
        }

        .btn-primary span {
            position: relative;
            z-index: 1;
        }

        .form-control {
            background: rgba(20, 20, 50, 0.8);
            border: 1px solid #0ff;
            color: #ffffff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
            opacity: 1;
        }

        .form-control:focus {
            background: rgba(20, 20, 50, 0.9);
            border-color: #ff0;
            box-shadow: 0 0 10px #ff0;
            color: #ffffff;
        }

        footer {
            background: #0a0a23;
            border-top: 1px solid #0ff;
            text-shadow: 0 0 5px #0ff;
        }

        .glitch {
            position: relative;
            animation: glitch 2s infinite;
        }

        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(2px, -2px); }
            60% { transform: translate(-2px, -2px); }
            80% { transform: translate(2px, 2px); }
            100% { transform: translate(0); }
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(0, 255, 255, 0.1);
            border: 2px solid #0ff;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .social-link::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: #0ff;
            transition: all 0.4s ease;
            transform: translate(-50%, -50%);
        }

        .social-link:hover::before {
            width: 100%;
            height: 100%;
        }

        .social-link:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 10px 25px rgba(0, 255, 255, 0.4);
            border-color: #00ff88;
        }

        .social-link i {
            color: #0ff;
            transition: all 0.3s;
            position: relative;
            z-index: 1;
            font-size: 1.5rem;
        }

        .social-link:hover i {
            color: #0a0a23;
            transform: scale(1.2);
        }

        .blog-meta {
            font-size: 0.85rem;
            color: #0ff;
            opacity: 0.8;
        }

        .blog-card .card-img-top {
            height: 220px;
            object-fit: cover;
            object-position: center;
        }

        .project-card .card-body,
        .blog-card .card-body {
            color: #ffffff;
        }

        .project-card .card-title,
        .blog-card .card-title,
        .project-card .card-text,
        .blog-card .card-text {
            color: #ffffff;
        }

        .form-label {
            color: #ffffff;
        }

        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            z-index: 1050;
            display: none;
            animation: fadeIn 0.3s;
        }

        .modal-backdrop.show {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .blog-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.7);
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            background: rgba(20, 20, 50, 0.95);
            border: 2px solid #0ff;
            border-radius: 15px;
            z-index: 1051;
            display: none;
            overflow-y: auto;
            box-shadow: 0 0 50px rgba(0, 255, 255, 0.5);
            animation: modalZoom 0.3s forwards;
        }

        .blog-modal.show {
            display: block;
        }

        @keyframes modalZoom {
            to { transform: translate(-50%, -50%) scale(1); }
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #0ff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            color: #0ff;
            margin: 0;
            font-size: 1.5rem;
        }

        .modal-close {
            background: transparent;
            border: 2px solid #0ff;
            color: #0ff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close:hover {
            background: #0ff;
            color: #0a0a23;
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 20px;
        }

        .modal-body img {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #0ff;
            background: rgba(0, 0, 0, 0.3);
        }

        .modal-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            color: #0ff;
            font-size: 0.9rem;
        }

        .modal-content-text {
            color: #ffffff;
            line-height: 1.8;
            font-size: 1rem;
        }

        .modal-category {
            display: inline-block;
            padding: 5px 15px;
            background: rgba(0, 255, 255, 0.2);
            border: 1px solid #0ff;
            border-radius: 20px;
            color: #0ff;
            font-size: 0.85rem;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold glitch" href="#">Bekhruz DEV</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#bosh-sahifa">Bosh sahifa</a></li>
                    <li class="nav-item"><a class="nav-link" href="#men-haqimda">Men haqimda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#loyhalar">Loyihalar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#bloglar">Bloglar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#boglanish">Bog'lanish</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="bosh-sahifa" class="hero-section d-flex align-items-center" data-aos="fade-up">
        <div class="container text-center">
            <h1 class="display-4 fw-bold glitch" data-aos="zoom-in" data-aos-delay="200">Bekhruz DEV</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="400">Full Stack Dasturchi | Zamonaviy Veb Yechimlar</p>
            <div class="mt-4" data-aos="fade-up" data-aos-delay="600">
                <a href="https://t.me/uzbek_coder_uzb" target="_blank" class="social-link mx-2" data-aos="flip-left" data-aos-delay="700">
                    <i class="fab fa-telegram"></i>
                </a>
                <a href="https://instagram.com/khamro_qu1ov" target="_blank" class="social-link mx-2" data-aos="flip-left" data-aos-delay="800">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://linkedin.com/in/uzbekcoder" target="_blank" class="social-link mx-2" data-aos="flip-left" data-aos-delay="900">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="https://github.com/Bekhruzjaaaan" target="_blank" class="social-link mx-2" data-aos="flip-left" data-aos-delay="1000">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <a href="#boglanish" class="btn btn-primary btn-lg mt-4" data-aos="zoom-in" data-aos-delay="1100">Bog'lanish</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="men-haqimda" class="py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center mb-5 glitch">Men Haqimda</h2>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="https://bkhz.uz/img/human.jpg" class="img-fluid rounded" alt="Bekhruz">
                </div>
                <div class="col-lg-6">
                    <p class="lead">
                        Salom! Men Bekhruz, responsiv va foydalanuvchiga qulay veb-ilovalarni yaratishga ixtisoslashgan Full Stack dasturchiman.
                        HTML, CSS, JavaScript, Bootstrap va zamonaviy frameworklar bilan ishlayman.
                    </p>
                    <p>Toza kod va innovatsion yechimlarga e'tibor berib, biznesingiz g'oyalarini hayotga tatbiq etaman.</p>
                    <a href="#boglanish" class="btn btn-primary">Bog'lanish</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="loyhalar" class="py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center mb-5 glitch">Mening Loyihalarim</h2>
            <div class="text-center mb-4">
                <button class="btn filter-btn active" data-filter="all">Hammasi</button>
                <button class="btn filter-btn" data-filter="web">Veb</button>
                <button class="btn filter-btn" data-filter="mobile">Mobil</button>
            </div>
            <div class="row" id="project-container">
                <div class="col-md-4 mb-4 project-item" data-category="web">
                    <div class="card project-card">
                        <img src="https://bkhz.uz/img/inpay.png" class="card-img-top" alt="inPAY">
                        <div class="card-body">
                            <h5 class="card-title">inPAY.uz</h5>
                            <p class="card-text">inPAY — foydalanuvchilarga tezkor va xavfsiz onlayn to'lovlar platformasi.</p>
                            <a href="https://inspay.uz" target="_blank" class="btn btn-primary">Loyihani Ko'rish</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 project-item" data-category="web">
                    <div class="card project-card">
                        <img src="https://bkhz.uz/img/tezkor.png" class="card-img-top" alt="Tezkor">
                        <div class="card-body">
                            <h5 class="card-title">Tezkor Yetkazish</h5>
                            <p class="card-text">Tezkor yetkazish bilan Uyingizgacha yetkazamiz!</p>
                            <a href="https://t.me/tezkoryetkazbot" target="_blank" class="btn btn-primary">Loyihani Ko'rish</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 project-item" data-category="mobile">
                    <div class="card project-card">
                        <img src="https://bkhz.uz/img/neo.png" class="card-img-top" alt="NEO ID">
                        <div class="card-body">
                            <h5 class="card-title">NEO ID</h5>
                            <p class="card-text">NEO ID BOT – foydalanuvchilarning onlayn identifikatsiya va autentifikatsiya tizimi.</p>
                            <a href="https://t.me/neo_idbot" target="_blank" class="btn btn-primary">Loyihani Ko'rish</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="bloglar" class="py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center mb-5 glitch">Mening Bloglarim</h2>
            <div class="row" id="blog-container">
                <div class="col-12 text-center">
                    <p class="lead">Yuklanmoqda...</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="boglanish" class="py-5" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center mb-5 glitch">Bog'lanish</h2>
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <form id="contactForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Ism</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ismingiz" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Emailingiz" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Xabar</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Xabaringiz" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Xabar Yuborish</button>
                    </form>
                    <div class="text-center mt-4 social-icons">
                        <a href="https://t.me/bekhruzdev" target="_blank" title="Telegram"><i class="fab fa-telegram"></i></a>
                        <a href="https://instagram.com/bekhruzdev" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://linkedin.com/in/bekhruzdev" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="https://github.com/bekhruzdev" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-white text-center py-3">
        <div class="container">
            <p>&copy; 2025 Bekhruz DEV. Barcha huquqlar himoyalangan.</p>
        </div>
    </footer>

    <!-- Blog Modal -->
    <div class="modal-backdrop" id="modalBackdrop" onclick="closeBlogModal()"></div>
    <div class="blog-modal" id="blogModal">
        <div class="modal-header">
            <h3 id="modalTitle"></h3>
            <button class="modal-close" onclick="closeBlogModal()">×</button>
        </div>
        <div class="modal-body">
            <img id="modalImage" src="" alt="">
            <span class="modal-category" id="modalCategory"></span>
            <div class="modal-meta">
                <span><i class="fas fa-calendar"></i> <span id="modalDate"></span></span>
            </div>
            <div class="modal-content-text" id="modalContent"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        // AOS Animation
        AOS.init({ duration: 1000, once: true });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });

        // Project Filter
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.dataset.filter;
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                document.querySelectorAll('.project-item').forEach(item => {
                    item.style.display = (filter === 'all' || item.dataset.category === filter) ? 'block' : 'none';
                });
            });
        });

        // Load Blogs
        function loadBlogs() {
            fetch('api/blogs.php')
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('blog-container');
                    if (data.length === 0) {
                        container.innerHTML = '<div class="col-12 text-center"><p class="lead">Hozircha bloglar yo\'q.</p></div>';
                        return;
                    }
                    
                    container.innerHTML = data.map(blog => `
                        <div class="col-md-4 mb-4" data-aos="fade-up">
                            <div class="card blog-card">
                                <img src="${blog.image}" class="card-img-top" alt="${blog.title}">
                                <div class="card-body">
                                    <div class="blog-meta mb-2">
                                        <i class="fas fa-calendar"></i> ${blog.date} | 
                                        <i class="fas fa-tag"></i> ${blog.category}
                                    </div>
                                    <h5 class="card-title">${blog.title}</h5>
                                    <p class="card-text blog-excerpt">${blog.excerpt}</p>
                                    <button class="btn btn-primary" onclick="viewBlog(${blog.id})">
                                        Batafsil <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `).join('');
                    AOS.refresh();
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('blog-container').innerHTML = 
                        '<div class="col-12 text-center"><p class="lead">Xatolik yuz berdi.</p></div>';
                });
        }

        function viewBlog(id) {
            fetch(`api/blogs.php?id=${id}`)
                .then(response => response.json())
                .then(blog => {
                    document.getElementById('modalTitle').textContent = blog.title;
                    document.getElementById('modalImage').src = blog.image;
                    document.getElementById('modalImage').alt = blog.title;
                    document.getElementById('modalCategory').textContent = blog.category;
                    document.getElementById('modalDate').textContent = blog.date;
                    document.getElementById('modalContent').innerHTML = blog.content.replace(/\n/g, '<br>');
                    
                    document.getElementById('modalBackdrop').classList.add('show');
                    document.getElementById('blogModal').classList.add('show');
                    document.body.style.overflow = 'hidden';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Blog yuklanmadi. Iltimos, qaytadan urinib ko\'ring.');
                });
        }

        function closeBlogModal() {
            document.getElementById('modalBackdrop').classList.remove('show');
            document.getElementById('blogModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeBlogModal();
            }
        });

        // Contact Form
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('api/contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) this.reset();
            })
            .catch(error => {
                alert('Xatolik yuz berdi. Iltimos, qaytadan urinib ko\'ring.');
            });
        });

        // Load blogs on page load
        window.addEventListener('load', loadBlogs);
    </script>
</body>
</html>
