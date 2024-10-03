<?php
include_once 'auth.php';
include_once '../connectdb.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Outer Clover Restaurant</title>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-wvw1PZt5STwCrZ6xGq+GSE1a5/Sp5j+oN8t02kGGtWQdIzApkzt+ub7svD3Wt5z1hJS/VRuKhKoAO1t32k8sKw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="../css/admindashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <h2>All Feedbacks</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Overall Experience</th>
                            <th>Food Quality</th>
                            <th>Service</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT * FROM feedback ORDER BY id DESC";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['overallexperience'] . "</td>";
                                echo "<td>" . $row['foodquality'] . "</td>";
                                echo "<td>" . $row['service'] . "</td>";
                                $message = $row["message"];
                                $truncated_message = (strlen($message) > 8) ? substr($message, 0, 5) . '...' : $message;
                                echo "<td>" . $truncated_message . "</td>";
                                echo "<td>";
                                echo "<a href='#' class='btn-secondary' onclick='viewFeedback(\"" . $row['id'] . "\", \"" . $row['name'] . "\", \"" . $row['overallexperience'] . "\", \"" . $row['foodquality'] . "\", \"" . $row['service'] . "\", \"" . $row['message'] . "\")'>View</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No recent feedbacks found</td></tr>";
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
        function viewFeedback(feedbackID, feedbackName, feedbackexp, feedbackFoodQuality, feedbackService, feedbackMessage) {
            Swal.fire({
                title: 'View Feedback',
                html: `<div class="view-form">
                                <div class="view-container">
                                    <label for="order_id" class="field-name">ID</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${feedbackID}</p>
                                    </div><br>

                                    <label for="customer_id" class="field-name">Name</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${feedbackName}</p>
                                    </div><br>

                                    <label for="customer_name" class="field-name">Overall Experience</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${feedbackexp}</p>
                                    </div><br>

                                    <label for="street_address" class="field-name">Food Quality</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${feedbackFoodQuality}</p>
                                    </div><br>

                                    <label for="district" class="field-name">Service</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${feedbackService}</p>
                                    </div><br>

                                    <label for="city" class="field-name">Message</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${feedbackMessage}</p>
                                    </div><br>
                                </div>
                            </div>`,
                customClass: {
                    popup: 'swal-view-class'
                },
                focusConfirm: false
            });
        }
    </script>

</body>

</html>