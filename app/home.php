<?php 
$_title = 'HomePage';
require 'base.php';
include 'head.php';

//search bar
$name=req('name');
$category = $_GET['category'] ?? '';
$books = getBooksByCategory($category);

if ($name) {
    $stm = $_db->prepare('SELECT * FROM products__1_ WHERE name LIKE ?');
    $stm->execute(["%$name%"]);
    $books = $stm->fetchAll(PDO::FETCH_ASSOC);
} else {
    $books = getBooksByCategory($category);
}
?>

<body>


<div class="centered-wrapper">
  <div class="slide_container" id="slider">
    <div class="wrapper" id="sliderWrapper">
      <img src="/image/BOOK FAIR.png" alt="img1" />
      <img src="/image/WORLD BOOK DAY.png" alt="img2" />
      <img src="/image/book-scroll3.png" alt="img3" />
    </div>
    <div class="slider-nav" id="sliderNav">
      <span class="dot" data-index="0"></span>
      <span class="dot" data-index="1"></span>
      <span class="dot" data-index="2"></span>
    </div>
  </div>
</div>

<div class="feature_books">
    <div class="books-header">
    <h2>Books <?= $category ? "in " . $category :"" ?></h2> 
<form method="GET" class="book-search-form">
    <input type="text" id="liveSearchInput" name="name" placeholder="Search books..." value="<?= htmlspecialchars($name) ?>">
    <button type="submit">Search</button>
</form>
  
    
</div>
    <div class="book_list">
        <?php
            foreach ($books as $book) {
             echo '
                <div class="book">
                    <a href="bookDetails.php?name='.urlencode($book["name"]).'">
                    <img src ="/image/'.$book["imageSource"]. ' "alt="'.$book["name"].'">
                    <h4>' . $book["name"] . '</h4>
                    </a>
                    <p>RM '.$book["price"]. '</p>
                   
                </div>';
            }?>
    </div>
</div>

<?php include 'foot.php'; ?>
</body>
</html>