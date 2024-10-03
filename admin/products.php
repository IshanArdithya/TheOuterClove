<?php
include_once 'auth.php';
include_once '../connectdb.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'deleteProduct') {
    $productId = intval($_POST['id']);

    $sql = "SELECT image_path FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $stmt->bind_result($imagePath);
    $stmt->fetch();
    $stmt->close();

    if ($imagePath) {
        if (file_exists('../' . $imagePath)) {
            unlink('../' . $imagePath);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Image path not found']);
    }

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    $stmt->close();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['action']) && $_GET['action'] === 'updateProduct') {
    if (!empty(trim($_GET['id']))) {
        $product_id = trim($_GET['id']);
        $updated_name = trim($_GET['name']);
        $updated_price = trim($_GET['price']);
        $updated_description = trim($_GET['description']);

        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $stmt = $conn->prepare("UPDATE products SET product_title = ?, product_price = ?, product_description = ? WHERE id = ?");
            $stmt->bind_param('sdsi', $updated_name, $updated_price, $updated_description, $product_id);
            if ($stmt->execute()) {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire('Updated!', 'The product successfully updated.', 'success').then(() => { 
                        window.location.href = 'products.php';
                    });
                });
                </script>";
            } else {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire('Oops...', 'Failed to update the product!', 'error').then(() => { 
                        window.location.href = 'products.php';
                    });
                });
                </script>";
            }
            $stmt->close();
        } else {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire('Oops...', 'Product not found!', 'error').then(() => { 
                    window.location.href = 'products.php';
                });
            });
            </script>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Outer Clover Restaurant</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="../css/admindashboard.css">


</head>

<body>
    <?php
    include 'components/header.php';
    ?>
    <div class="container">

        <div>
        </div>
        <main>
            <div class="recents">
                <h2>Add Product</h2>
                <form id="addproducts-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="form-container">
                        <div class="form-inputs">
                            <label for="addproduct_title">Product Name:</label>
                            <input type="text" id="addproduct_title" name="product_title" minlength="3" maxlength="35"
                                required>

                            <label for="addproduct_description">Product Description:</label>
                            <textarea id="addproduct_description" name="product_description" minlength="5"
                                maxlength="75" required></textarea>

                            <label for="addproduct_price">Product Price:</label>
                            <input type="number" id="addproduct_price" name="product_price" step="0.01" required>

                            <label for="addproduct_image">Product Image:</label>

                            <!-- hidden default 'choose file' and add a custom label -->

                            <div class="file-input-container">
                                <input type="file" id="addproduct_image" name="product_image" accept="image/*" required
                                    hidden>
                                <label for="addproduct_image" class="custom-file-upload">Choose Image</label>
                                <span id="file-name">No file chosen</span>
                            </div>

                            <button type="submit" name="addproduct_submit">Add Product</button>
                        </div>

                        <div class="image-preview" id="image-preview">
                            <p>No image selected</p>
                        </div>
                    </div>
                </form>
            </div>

            <div class="recents">
                <h2>All Products</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT * FROM products ORDER BY id";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td><img src='../" . $row['image_path'] . "' alt='Product Image' class='productimg'></td>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['product_title'] . "</td>";
                                $product_description = $row["product_description"];
                                $truncated_product_description = (strlen($product_description) > 8) ? substr($product_description, 0, 30) . '...' : $product_description;
                                echo "<td>" . $truncated_product_description . "</td>";
                                echo "<td>" . $row['product_price'] . "</td>";
                                ;
                                echo "<td>";
                                echo "<a href='#' class='btn-secondary' onclick='updateProduct(\"" . $row['id'] . "\", \"" . $row['product_title'] . "\", \"" . $row['product_description'] . "\", \"" . $row['product_price'] . "\", \"" . $row['image_path'] . "\")'>Update</a>";
                                echo "<a href='#' class='btn-danger' onclick='deleteProduct(\"" . $row['id'] . "\", \"" . $row['product_title'] . "\")'>Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No products found</td></tr>";
                        }

                        ?>

                    </tbody>
                </table>
            </div>

        </main>
        <div>

        </div>
    </div>

    <script>
        document.getElementById('addproduct_image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('image-preview');
            const fileName = document.getElementById('file-name');
            previewContainer.innerHTML = '';

            if (file) {
                fileName.textContent = file.name;
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.alt = 'Product Image Preview';
                    // img.style.maxWidth = '100%';
                    // img.style.maxHeight = '150px';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else {
                fileName.textContent = "No image chosen";
                previewContainer.innerHTML = '<p>No image selected</p>';
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addproduct_submit'])) {

        $productTitle = $_POST['product_title'];
        $productDescription = $_POST['product_description'];
        $productPrice = $_POST['product_price'];

        $targetDir = "images/products/";
        $targetFile = '../' . $targetDir . basename($_FILES["product_image"]["name"]);
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile);

        $targetFilePath = $targetDir . basename($_FILES["product_image"]["name"]);
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile);

        $sql = "INSERT INTO products (product_title, product_description, product_price, image_path)
            VALUES ('$productTitle', '$productDescription', '$productPrice', '$targetFilePath')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                    Swal.fire({
                    title: 'Success',
                    text: 'Product successfully added!',
                    icon: 'success'
                    }).then(function() {
                        window.location = window.location.href;
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.fire({
                    title: 'Error',
                    text: 'Failed to add product!',
                    icon: 'error'
                    }).then(function() {
                        window.location = window.location.href;
                    });
                </script>";
        }
    }
    ?>

    <script>
        function deleteProduct(productId, productTitle) {
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you really want to delete "${productTitle}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            'action': 'deleteProduct',
                            'id': productId
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'Product has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was an error deleting the product: ' + data.error,
                                    'error'
                                ).then(() => {
                                    location.reload();
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error!',
                                'There was an error with the request.',
                                'error'
                            ).then(() => {
                                location.reload();
                            });
                        });
                }
            });
        }
    </script>

    <script>
        function updateProduct(productId, productTitle, productDescription, productPrice, productImagePath) {
            Swal.fire({
                title: 'Update Product',
                html: `<div id="addproducts-form" class="addproducts-form">
                <div class="form-container">
                    <div class="form-inputs">   
                        <label for="product_id">Product ID:</label>
                        <input type="text" id="product_id" name="product_id" value="${productId}" readonly>

                        <label for="name">Product Name:</label>
                        <input type="text" id="name" name="product_title" value="${productTitle}" minlength="3" maxlength="35" required>

                        <label for="description">Product Description:</label>
                        <textarea id="description" name="product_description" minlength="5" maxlength="75" required>${productDescription}</textarea>

                        <label for="price">Product Price:</label>
                        <input type="number" id="price" name="product_price" value="${productPrice}" step="0.01" required>
                    </div>

                    <div class="image-preview" id="update-product-image">
                        <img src="../${productImagePath}">
                    </div>
                </div>
            </div>`,
                customClass: {
                    popup: 'swal-class'
                },
                preConfirm: () => {
                    const name = Swal.getPopup().querySelector('#name').value;
                    const description = Swal.getPopup().querySelector('#description').value;
                    const price = Swal.getPopup().querySelector('#price').value;

                    if (!name || !description || !price) {
                        Swal.showValidationMessage('Please complete all fields');
                        return false;
                    }

                    return {
                        name: name,
                        description: description,
                        price: price
                    };
                },
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Change',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const { name, description, price } = result.value;
                    window.location.href = "<?= $_SERVER['PHP_SELF'] ?>?action=updateProduct&id=" + encodeURIComponent(productId) +
                        "&name=" + encodeURIComponent(name) +
                        "&price=" + encodeURIComponent(price) +
                        "&description=" + encodeURIComponent(description);
                }
            })
        }
    </script>


</body>

</html>