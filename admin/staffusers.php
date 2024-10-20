<?php
include_once 'auth.php';
include_once '../connectdb.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'deleteStaff') {
    $userId = intval($_POST['id']);

    $sql = "DELETE FROM staff_users WHERE staff_user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
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
            <div class="staff-filter">
                <h3>Filter By Role</h3>
                <span class="staff-filter-label filter-active" onclick="filterTable('all', this)">All</span>
                <span class="staff-filter-label" onclick="filterTable('admin', this)">Admin</span>
                <span class="staff-filter-label" onclick="filterTable('manager', this)">Manager</span>
                <span class="staff-filter-label" onclick="filterTable('staff', this)">Staff</span>
            </div>


            <?php
            $roleFilter = isset($_GET['role']) ? $_GET['role'] : 'all';
            $roleName = 'All Staff';

            if ($roleFilter == 'admin') {
                $sql = "SELECT * FROM staff_users WHERE role = 'admin' ORDER BY staff_user_id ASC";
                $roleName = 'Admins';
            } elseif ($roleFilter == 'manager') {
                $sql = "SELECT * FROM staff_users WHERE role = 'manager' ORDER BY staff_user_id ASC";
                $roleName = 'Managers';
            } elseif ($roleFilter == 'staff') {
                $sql = "SELECT * FROM staff_users WHERE role = 'staff' ORDER BY staff_user_id ASC";
                $roleName = 'Staff';
            } else {
                $sql = "SELECT * FROM staff_users ORDER BY staff_user_id ASC";
                $roleName = 'All Staff';
            }
            $result = mysqli_query($conn, $sql);
            ?>

            <div class="recents" id="staffTableContainer">
                <div class="staff-table">
                    <h2>View <?php echo $roleName; ?></h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="staffTableBody">
                            <!-- filter_staff.php -->
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
        <div>

        </div>
    </div>

    <script>
        function filterTable(role = 'all', element) {
            const labels = document.querySelectorAll('.staff-filter-label');
            labels.forEach(label => {
                label.style.opacity = label === element ? 1 : 0.5;
                label.classList.remove('filter-active');
            });
            element.style.opacity = 1;
            element.classList.add('filter-active');

            fetch(`ajax/filter_staff.php?role=${role}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('staffTableContainer').innerHTML = data;
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        filterTable('all', document.querySelector('.staff-filter-label.filter-active'));

        function changeUserRole(newRole, userId, fullName, dropdownElement) {
            const previousRole = dropdownElement.getAttribute('data-original-value') || dropdownElement.value;

            Swal.fire({
                title: 'Are you sure?',
                text: `Do you really want to change the user '${fullName}' role to "${newRole.charAt(0).toUpperCase() + newRole.slice(1)}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('ajax/change_user_role.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            'action': 'changeUserRole',
                            'role': newRole,
                            'id': userId
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Success!', 'User role updated!', 'success');
                                dropdownElement.setAttribute('data-original-value', newRole);
                            } else {
                                Swal.fire('Error!', 'There was an error updating the role.', 'error');
                                dropdownElement.value = previousRole;
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error!', 'There was an error with the request.', 'error');
                            dropdownElement.value = previousRole;
                        });
                } else {
                    dropdownElement.value = previousRole;
                }
            });
        }

        function changeUserStatus(newStatus, userId, fullName, dropdownElement) {
            const previousStatus = dropdownElement.getAttribute('data-original-value') || dropdownElement.value;

            Swal.fire({
                title: 'Are you sure?',
                text: `Do you really want to change the user '${fullName}' status to "${newStatus.charAt(0).toUpperCase() + newStatus.slice(1)}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('ajax/change_user_status.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            'action': 'changeUserStatus',
                            'status': newStatus,
                            'id': userId
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Success!', 'User status updated!', 'success');
                                dropdownElement.setAttribute('data-original-value', newStatus);
                            } else {
                                Swal.fire('Error!', 'There was an error updating the status.', 'error');
                                dropdownElement.value = previousStatus;
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error!', 'There was an error with the request.', 'error');
                            dropdownElement.value = previousStatus;
                        });
                } else {
                    dropdownElement.value = previousStatus;
                }
            });
        }

        function deleteStaff(userId, full_name, role) {
            const capitalRole = role.charAt(0).toUpperCase() + role.slice(1);

            Swal.fire({
                title: 'Delete User?',
                text: `Do you really want to delete User: "${full_name} [${capitalRole}]"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete user!',
                cancelButtonText: 'No, go back!',
                didOpen: () => {
                    const confirmButton = Swal.getConfirmButton();
                    let countdown = 3;
                    confirmButton.disabled = true;
                    confirmButton.textContent = `Yes, delete user! (${countdown})`;

                    const interval = setInterval(() => {
                        countdown--;
                        confirmButton.textContent = `Yes, delete user! (${countdown})`;

                        if (countdown === 0) {
                            clearInterval(interval);
                            confirmButton.textContent = 'Yes, delete user!';
                            confirmButton.disabled = false;
                        }
                    }, 1000);
                }

            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            'action': 'deleteStaff',
                            'id': userId
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Success!',
                                    'User account deleted!',
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

    </script>


</body>

</html>