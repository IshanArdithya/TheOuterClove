<?php
include '../connectdb.php';

$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM products WHERE product_title LIKE ? OR product_description LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = '%' . $searchQuery . '%';
$stmt->bind_param('ss', $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="product">
            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['product_title']; ?>">
            <div class="product-info">
                <h4 class="product-title"><?php echo $row['product_title']; ?></h4>
                <p class="product-description"><?php echo $row['product_description']; ?></p>
                <p class="product-price">Rs.<?php echo $row['product_price']; ?></p>
                <form id="add-to-cart-form-<?php echo $row['product_id']; ?>" class="add-to-cart-form" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <button class="product-btn" type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>No products match your search</p>";
}
?>
