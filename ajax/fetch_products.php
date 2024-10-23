<?php
// fetch_products.php

// Database connection
require '../connectdb.php'; // Include your database connection file

$category = isset($_POST['category']) ? $_POST['category'] : 'all';
$sql = "SELECT * FROM products"; // Adjust your table name if necessary

if ($category !== 'all') {
    $sql .= " WHERE product_category = ?";
}

// Prepare statement
$stmt = $conn->prepare($sql);
if ($category !== 'all') {
    $stmt->bind_param('s', $category); // 's' indicates the type is string
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="product">
            <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['product_title']); ?>">
            <div class="product-info">
                <h4 class="product-title"><?php echo htmlspecialchars($row['product_title']); ?></h4>
                <p class="product-description"><?php echo htmlspecialchars($row['product_description']); ?></p>
                <p class="product-price">Rs.<?php echo htmlspecialchars($row['product_price']); ?></p>
                <form id="add-to-cart-form-<?php echo $row['product_id']; ?>" class="add-to-cart-form" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <button class="product-btn" type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>No products available</p>";
}
$stmt->close();
$conn->close();
?>
