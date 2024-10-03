<?php
session_start();
include_once '../connectdb.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'approveReservation') {
    $resID = intval($_POST['id']);

    $sql = "UPDATE reservations SET approval = 'Approved' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $resID);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    $stmt->close();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'declineReservation') {
    $resID = intval($_POST['id']);

    $sql = "UPDATE reservations SET approval = 'Declined' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $resID);
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
                <h2>Pending Reservations</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>No. of People</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Preferences</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT * FROM reservations WHERE approval = 'Pending'";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['people'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td>" . $row['time'] . "</td>";
                                echo "<td>" . $row["preferences"] . "</td>";
                                $description = $row["description"];
                                $truncated_description = (strlen($description) > 8) ? substr($description, 0, 5) . '...' : $description;
                                echo "<td>" . $truncated_description . "</td>";
                                echo "<td>";
                                echo "<a href='#' class='btn-secondary' onclick='viewReservation(\"" . $row['id'] . "\", \"" . $row['name'] . "\", \"" . $row['email'] . "\", \"" . $row['phone'] . "\", \"" . $row['people'] . "\", \"" . $row['date'] . "\", \"" . $row['time'] . "\", \"" . $row['preferences'] . "\", \"" . $row['description'] . "\")'>View</a>";
                                echo "<a href='#' class='btn-primary' onclick='approveReservation(\"" . $row['id'] . "\", \"" . $row['name'] . "\")'>Approve</a>";
                                echo "<a href='#' class='btn-danger' onclick='declineReservation(\"" . $row['id'] . "\", \"" . $row['name'] . "\")'>Decline</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No pending reservations found</td></tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <div class="recents">
                <h2>Recent Reservations</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>No. of People</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Preferences</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT * FROM reservations WHERE approval IN ('Approved', 'Declined') ORDER BY id DESC LIMIT 10";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['people'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td>" . $row['time'] . "</td>";
                                echo "<td>" . $row["preferences"] . "</td>";
                                $description = $row["description"];
                                $truncated_description = (strlen($description) > 8) ? substr($description, 0, 5) . '...' : $description;
                                echo "<td>" . $truncated_description . "</td>";
                                echo "<td>" . $row["approval"] . "</td>";
                                echo "<td>";
                                echo "<a href='#' class='btn-secondary' onclick='viewReservation(\"" . $row['id'] . "\", \"" . $row['name'] . "\", \"" . $row['email'] . "\", \"" . $row['phone'] . "\", \"" . $row['people'] . "\", \"" . $row['date'] . "\", \"" . $row['time'] . "\", \"" . $row['preferences'] . "\", \"" . $row['description'] . "\")'>View</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No recent reservations found</td></tr>";
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
        function viewReservation(resID, resName, resEmail, resPhone, resNoOfPeople, resDate, resTime, resPreferences, resNote) {
            Swal.fire({
                title: 'View Reservation',
                html: `<div class="view-form">
                                <div class="view-container">
                                    <label for="order_id" class="field-name">ID</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${resID}</p>
                                    </div><br>

                                    <label for="customer_id" class="field-name">Name</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${resName}</p>
                                    </div><br>

                                    <label for="customer_name" class="field-name">Email</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${resEmail}</p>
                                    </div><br>

                                    <label for="street_address" class="field-name">Phone</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${resPhone}</p>
                                    </div><br>

                                    <label for="district" class="field-name">No. of People</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${resNoOfPeople}</p>
                                    </div><br>

                                    <label for="city" class="field-name">Date & Time</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${resDate} ${resTime}</p>
                                    </div><br>

                                    <label for="city" class="field-name">Dietary Preferences</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${resPreferences}</p>
                                    </div><br>

                                    <label for="city" class="field-name">Note</label>
                                    <div class="view-info-container">
                                        <p class="current-info">${resNote}</p>
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
        function approveReservation(resID, resName) {
            Swal.fire({
                title: 'Approve Reservation?',
                text: `Do you really want to approve "${resName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'No, go back!',
                
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            'action': 'approveReservation',
                            'id': resID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Success!',
                                'Reservation Approved!',
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

<script>
        function declineReservation(resID, resName) {
            Swal.fire({
                title: 'Decline Reservation?',
                text: `Do you really want to decline "${resName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, decline it!',
                cancelButtonText: 'No, go back!',
                
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            'action': 'declineReservation',
                            'id': resID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Success!',
                                'Reservation Declined!',
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