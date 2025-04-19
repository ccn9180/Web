<?php 
$_title = 'Shopping CArt';
require 'base.php';
include 'head.php';


// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle item quantity increase
if (post('increase_item') !== null) {
    $index = post('increase_item');
    if (isset($_SESSION['cart'][$index])) {
        $_SESSION['cart'][$index]['quantity']++;
    }
}

// Handle item quantity decrease
if (post('decrease_item') !== null) {
    $index = post('decrease_item');
    if (isset($_SESSION['cart'][$index])) {
        if ($_SESSION['cart'][$index]['quantity'] > 1) {
            $_SESSION['cart'][$index]['quantity']--;
        } else {
            unset($_SESSION['cart'][$index]); // Remove if quantity is 1 and minus is clicked
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex
        }
    }
}


// Handle remove item from cart
if (post('remove_item') !== null) {
    $index = post('remove_item');
    $itemName = req('name');
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex
    temp('cart_message',"$itemName has been delected!");
   
}

// Calculate total price
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price']*$item['quantity'];
}
?>


<body>
    <div class="cart-container">
        <div class="cart-header">
            <h1>Your Shopping Cart</h1>
        </div>

        <?php if (empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added any items to your cart yet.</p>
            </div>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach ($_SESSION['cart'] as $index => $item): 
                    ?>
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="/image/<?= ($item['imageSource']) ?>" alt="<?= ($item['name']) ?>">
                        </div>
                        <div class="item-details">
                            <div class="item-name"><?= ($item['name']) ?></div>
                            <div class="item-price">RM <?= number_format($item['price'], 2) ?></div>
                            <div class="item-quantity">
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="decrease_item" value="<?= $index ?>">
                                <button type="submit">-</button>
                            </form>
                            <span><?= $item['quantity'] ?></span>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="increase_item" value="<?= $index ?>">
                                <button type="submit">+</button>
                            </form>
                        </div>
                        <div class="item-subtotal">
                            Subtotal: RM <?= number_format($item['price'] * $item['quantity'], 2) ?>
                        </div>
                        
                    
                    <form method="post">
                        <input type="hidden" name="remove_item" value="<?= $index ?>">
                        <button data-post="submit" class="remove-btn">Remove</button>
                    </form>
                    </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="cart-summary">
                <h2>Order Summary</h2>
                <div class="total-price">
                    Total: RM <?= number_format($total, 2) ?>
                </div>
                <button class="checkout-btn" onclick="window.location.href='checkout.php'">
                    Proceed to Checkout
                </button>
            </div>
        <?php endif; ?>
        
        <a href="home.php" class="continue-shopping">Continue Shopping</a>
    </div>
</body>
</html>

<?php include 'foot.php'; ?>