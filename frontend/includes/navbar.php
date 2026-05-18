<?php
$currentPage = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
?>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">BLOGGER</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav gap-2 ms-auto">

                <li class="nav-item">
                    <a class="nav-link link-primary <?php if ($currentPage == '') echo 'active'; ?>" href="/">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-primary 
                    
                    <?php
                    if (
                        $currentPage == 'blogs' ||
                        str_starts_with($currentPage, 'blog/')
                    ) {
                        echo 'active';
                    }
                    ?>
                    
                    " href="/blogs">
                        Blogs
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-primary <?php if ($currentPage == 'about') echo 'active'; ?>" href="/about">
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-primary <?php if ($currentPage == 'contact') echo 'active'; ?>" href="/contact">
                        Contact
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>