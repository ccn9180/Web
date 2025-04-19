
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?? 'Untitled' ?></title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/homePage.css">
    <link rel="stylesheet" href="/css/bookDetails.css">
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/aboutUs.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
</head>
<body>

<nav>
    
    <div class="nav_content">
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="aboutUs.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        
    </ul>
    </div>

    
    <div class="user_content">
    <ul>
        <li><a href="profile.php"><img src="/image/bxs-user-circle.svg"></a></li>
    </ul>
    </div>   

    <div class="cart">
        <ul>
            <li><a href="cart.php"><img src="/image/reshot-icon-shopping-cart-TSH5WN4J9B.svg"></a></li>
        </ul>
    </div>
</nav>

<!-- Genre Navigation -->

<div class="genre-nav">
<button class="nav-left-btn" onclick="scrollNav(-100)">&#10094;</button>
    <ul>
    <?php 
        $uniqueGenres=getUniqueGenres();
        foreach ($uniqueGenres as $genre): 
        ?>
            <li><a href="home.php?category=<?= urlencode($genre) ?>"><?= $genre ?></a></li>
        <?php endforeach; ?>
    
       
    </ul>
    <button class="nav-right-btn" onclick="scrollNav(100)">&#10095;</button>
</div>
<script src="/js/app.js"></script>
</body>
</html>