<?php
session_start();
include_once '../../connectdb.php';

$currentUserId = $_SESSION['staff']['id'];

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
$output = '<h2>' . $roleName . '</h2>';
$output .= '<table><thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Role</th><th>Status</th><th>Action</th></tr></thead><tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr>";
        $output .= "<td>" . $row['staff_user_id'] . "</td>";
        $output .= "<td>" . $row['first_name'] . "</td>";
        $output .= "<td>" . $row['last_name'] . "</td>";
        $output .= "<td>" . $row['email'] . "</td>";
        $output .= "<td>" . roleDropdown($row['role'], $row['staff_user_id'], $row['first_name'] . ' ' . $row['last_name'], $currentUserId) . "</td>";
        $output .= "<td>" . statusDropdown($row['status'], $row['staff_user_id'], $row['first_name'] . ' ' . $row['last_name'], $currentUserId) . "</td>";
        $output .= "<td>";
        if ($row['staff_user_id'] == $currentUserId) {
            $output .= "<button class='btn-danger' disabled>Delete</button>";
        } else {
            $output .= "<a href='#' class='btn-danger' onclick='deleteStaff(\"" . $row['staff_user_id'] . "\", \"" . $row['first_name'] . " " . $row['last_name'] . "\", \"" . $row['role'] . "\")'>Delete</a>";
        }
        $output .= "</td>";
        $output .= "</tr>";
    }
} else {
    $output .= "<tr><td colspan='7'>No $roleFilter found</td></tr>";
}

$output .= '</tbody></table>';
echo $output;

function roleDropdown($currentRole, $userId, $fullName, $currentUserId)
{
    $roles = ['admin', 'manager', 'staff'];
    $roleDropdown = '<div class="dropdown-wrapper">';

    if ($userId == $currentUserId) {
        $roleDropdown .= '<select class="staff-table" disabled>';
        $roleDropdown .= "<option value='$currentRole' selected>" . ucfirst($currentRole) . "</option>";
        $roleDropdown .= "</select>";
    } else {
        $roleDropdown .= '<select class="staff-table" onchange="changeUserRole(this.value, ' . $userId . ', \'' . addslashes($fullName) . '\', this)" data-original-value="' . $currentRole . '">';
        foreach ($roles as $role) {
            $roleDropdown .= "<option value='$role' " . ($currentRole === $role ? 'selected' : '') . ">" . ucfirst($role) . "</option>";
        }
        $roleDropdown .= "</select>";
        $roleDropdown .= "<span class='dropdown-arrow'>&#9662;</span>";
    }

    $roleDropdown .= "</div>";
    return $roleDropdown;
}


function statusDropdown($currentStatus, $userId, $fullName, $currentUserId)
{
    $allstatus = ['active', 'inactive', 'suspended'];
    $statusDropdown = '<div class="dropdown-wrapper">';

    if ($userId == $currentUserId) {
        $statusDropdown .= '<select class="staff-table" disabled>';
        $statusDropdown .= "<option value='$currentStatus' selected>" . ucfirst($currentStatus) . "</option>";
        $statusDropdown .= "</select>";
    } else {
        $statusDropdown .= '<select class="staff-table" onchange="changeUserStatus(this.value, ' . $userId . ', \'' . addslashes($fullName) . '\', this)" data-original-value="' . $currentStatus . '">';
        foreach ($allstatus as $status) {
            $statusDropdown .= "<option value='$status' " . ($currentStatus === $status ? 'selected' : '') . ">" . ucfirst($status) . "</option>";
        }
        $statusDropdown .= "</select>";
        $statusDropdown .= "<span class='dropdown-arrow'>&#9662;</span>";
    }

    $statusDropdown .= "</div>";
    return $statusDropdown;
}

?>