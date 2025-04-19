<?php 
require 'base.php';
include 'head.php';

$book = getBookDetails($_GET['name']);
$success_message = '';

// Handle Add to Cart
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cart_item = [
        "name" => $book["name"],
        "price" => $book["price"],
        "imageSource" => $book["imageSource"],
        "quantity"=> 1
    ];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $cart_item;
    $success_message = "Successfully added <br>\"" . $book["name"] . " \" to your cart!</br>";
}
?>

<body>
    <div class="book_details">
        
        <div class="book-image container">
            <img src="/image/<?= $book["imageSource"]?>" alt="<?= $book["name"] ?>">
            <form method="post">
                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <div class="text">
        <h1><?= $book["name"] ?></h1>
        <h2><a href="author.php?name=<?= urlencode($book['author']) ?>"></h2>
        <?= $book["author"] ?></a></h2>
        <p><strong>Price:</strong> RM <?= $book["price"]?></p>
        <p><strong>Categories:</strong> 
        <?php 
            $genres = explode(',', $book["genre"]); // Split genres by comma
            foreach ($genres as $index => $genre) {
                $trimmedGenre = trim($genre); // Remove any spaces
                echo '<a href="home.php?category=' . urlencode($trimmedGenre) . '">' . $trimmedGenre . '</a>';
                if ($index < count($genres) - 1) {
                    echo "  "; // Adds space between genres
                }
            }
            
        ?>
        </p>
        
        <p><strong>First published date: </strong><?=$book["publishedDate"]?></p>
        <p><strong>Language: </strong><?=$book["language"]?></p>
        <p><?= $book["description"] ?></p>
        </div>

        <?php if ($success_message): ?>
            <div class="overlay">
                <div class="success-popup">
                <h2><?= $success_message ?><h2>
                <div class="popup-buttons">
                    <a href="cart.php" class="btn">View Cart</a>
                    <a href="home.php" class="btn">Continue Shopping</a>
                </div>
                </div>
                </div>
            
        <?php endif; ?>
        <a href="home.php">Back to Homepage</a>
    </div>
</body>

<?php include 'foot.php'; ?>
</html>
