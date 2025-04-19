<?php
require 'base.php';
include 'head.php';

$author = $_GET['name'] ?? '';

$stmt = $_db->prepare("SELECT * FROM products__1_ WHERE author = ?");

$stmt->execute([$author]);
$books = $stmt->fetchAll();
?>

<style>
    .author-books {
        max-width: 1000px;
        margin: 30px auto;
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .author-books h1 {
        color: #703d39;
    }

    .book-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .book-item {
        width: 180px;
        text-align: center;
    }

    .book-item img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .book-item a {
        text-decoration: none;
        color: #333;
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    .book-item a:hover {
        color: #703d39;
    }
</style>

<body>
    <div class="author-books">
        <h1>Books by <?= htmlspecialchars($author) ?></h1>

        <?php if (count($books) > 0): ?>
            <div class="book-grid">
                <?php foreach ($books as $book): ?>
                    <div class="book-item">
                        <a href="bookDetails.php?name=<?= urlencode($book['name']) ?>">
                            <img src="/image/<?= $book['imageSource'] ?>" alt="<?= $book['name'] ?>">
                            <?= $book['name'] ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No books found for this author.</p>
        <?php endif; ?>

        <p><a href="home.php" style="color:#703d39;">← Back to Home</a></p>
    </div>
</body>

<?php include 'foot.php'; ?>
</html>
