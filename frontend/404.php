<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Blog Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f4f7f6;
            color: #333;
        }

        /* Navbar Customization */
        .navbar { background-color: #ffffff !important; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .navbar-brand { color: #6366f1 !important; font-weight: 700; font-size: 1.5rem; }
        .nav-link { color: #555 !important; font-weight: 500; }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            padding: 80px 0;
            margin-bottom: 50px;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        
        /* Sidebar Widgets */
        .widget-title {
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #6366f1;
            display: inline-block;
        }
        .category-link {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            color: #555;
            text-decoration: none;
            border-bottom: 1px solid #eee;
            transition: 0.3s;
        }
        .category-link:hover { color: #6366f1; padding-left: 5px; }

        .recent-post-item {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            text-decoration: none;
            color: inherit;
        }
        .recent-post-img {
            width: 70px; height: 70px; border-radius: 8px; object-fit: cover;
        }
        .recent-post-title { font-size: 0.9rem; font-weight: 600; margin: 0; }
        .recent-post-date { font-size: 0.75rem; color: #888; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">BLOGGER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Articles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white ms-lg-3 px-4" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12 text-center h-{75}">
                <h2>404 Error!</h2>
                <p>Sorry Something went wrong!</p>
                <a class="btn btn-info" href="/frontend/index.php">Back To Homepage</a>
            </div>
        </div>
    </div>

    <footer class="py-4 bg-white border-top text-center mt-5">
        <p class="text-muted mb-0">© 2024 ModernBlog | Designed with ❤️</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
</body>
</html>