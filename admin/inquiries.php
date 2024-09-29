<?php
include_once '../connectdb.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'completeInquiry') {
    $inquiryID = intval($_POST['id']);

    $sql = "UPDATE contact SET status = 'Completed' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $inquiryID);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    $stmt->close();
    exit;
}

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
                <h2>Pending Inquiries</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT * FROM contact WHERE status = 'Pending'";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['subject'] . "</td>";
                                $message = $row["message"];
                                $truncated_message = (strlen($message) > 15) ? substr($message, 0, 12) . '...' : $message;
                                echo "<td>" . $truncated_message . "</td>";
                                echo "<td>";
                                echo "<a href='#' class='btn-secondary' onclick='viewInquiry(\"" . $row['id'] . "\", \"" . $row['name'] . "\", \"" . $row['email'] . "\", \"" . $row['phone'] . "\", \"" . $row['subject'] . "\", \"" . $row['message'] . "\")'>View</a>";
                                echo "<a href='#' class='btn-primary' onclick='completeInquiry(\"" . $row['id'] . "\", \"" . $row['name'] . "\")'>Mark as Completed</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No pending Inquiries found</td></tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <div class="recents">
                <h2>Completed Inquiries</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT * FROM contact WHERE status = 'Completed' ORDER BY id DESC LIMIT 10";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['subject'] . "</td>";
                                $message = $row["message"];
                                $truncated_message = (strlen($message) > 15) ? substr($message, 0, 12) . '...' : $message;
                                echo "<td>" . $truncated_message . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>";
                                echo "<a href='#' class='btn-secondary' onclick='viewInquiry(\"" . $row['id'] . "\", \"" . $row['name'] . "\", \"" . $row['email'] . "\", \"" . $row['phone'] . "\", \"" . $row['subject'] . "\", \"" . $row['message'] . "\")'>View</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No recent inquiries found</td></tr>";
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
        function viewInquiry(inquiryID, inquiryName, inquiryEmail, inquiryPhone, inquirySubject, inquiryMessage) {
            Swal.fire({
                title: 'View Inquiry',
                html: `<div class="view-form">
                                <div class="view-container">
                                    <label for="order_id" class="field-name">ID</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${inquiryID}</p>
                                    </div><br>

                                    <label for="customer_id" class="field-name">Name</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${inquiryName}</p>
                                    </div><br>

                                    <label for="customer_name" class="field-name">Email</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${inquiryEmail}</p>
                                    </div><br>

                                    <label for="street_address" class="field-name">Phone</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${inquiryPhone}</p>
                                    </div><br>

                                    <label for="district" class="field-name">Subject</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${inquirySubject}</p>
                                    </div><br>

                                    <label for="city" class="field-name">Message</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${inquiryMessage}</p>
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

    <script>
        function completeInquiry(inquiryID, inquiryName) {
            Swal.fire({
                title: 'Mark as Completed?',
                text: `Do you really want to mark "${inquiryName}" as completed?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            'action': 'completeInquiry',
                            'id': inquiryID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Success!',
                                'Inquiry Successfully Marked as Completed.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error',
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

</body>

</html>