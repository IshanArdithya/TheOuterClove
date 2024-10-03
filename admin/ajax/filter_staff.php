<?php
session_start();
include_once '../../connectdb.php';

$roleFilter = isset($_GET['role']) ? $_GET['role'] : 'all';
$roleName = 'All Staff';

if ($roleFilter == 'admin') {
    $sql = "SELECT * FROM staff_users WHERE role = 'admin' ORDER BY id ASC";
    $roleName = 'Admins';
} elseif ($roleFilter == 'manager') {
    $sql = "SELECT * FROM staff_users WHERE role = 'manager' ORDER BY id ASC";
    $roleName = 'Managers';
} elseif ($roleFilter == 'staff') {
    $sql = "SELECT * FROM staff_users WHERE role = 'staff' ORDER BY id ASC";
    $roleName = 'Staff';
} else {
    $sql = "SELECT * FROM staff_users ORDER BY id ASC";
    $roleName = 'All Staff';
}

$result = mysqli_query($conn, $sql);
$output = '<h2>View ' . $roleName . '</h2>';
$output .= '<table><thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Role</th><th>Status</th><th>Action</th></tr></thead><tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr>";
        $output .= "<td>" . $row['id'] . "</td>";
        $output .= "<td>" . $row['first_name'] . "</td>";
        $output .= "<td>" . $row['last_name'] . "</td>";
        $output .= "<td>" . $row['email'] . "</td>";
        $output .= "<td>" . roleDropdown($row['role'], $row['id'], $row['first_name'] . ' ' . $row['last_name']) . "</td>";
        $output .= "<td>" . statusDropdown($row['status'], $row['id'], $row['first_name'] . ' ' . $row['last_name']) . "</td>";
        $output .= "<td>";
        $output .= "<a href='#' class='btn-danger' onclick='deleteStaff(\"" . $row['id'] . "\", \"" . $row['first_name'] . " " . $row['last_name'] . "\",\"" . $row['role'] . "\")'>Delete</a>";
        $output .= "</td>";
        $output .= "</tr>";
    }
} else {
    $output .= "<tr><td colspan='7'>No $roleFilter found</td></tr>";
}

$output .= '</tbody></table>';
echo $output;

function roleDropdown($currentRole, $userId, $fullName)
{
    $roles = ['admin', 'manager', 'staff'];
    $roleDropdown = '<div class="dropdown-wrapper">';
    $roleDropdown .= '<select class="staff-table" onchange="changeUserRole(this.value, ' . $userId . ', \'' . addslashes($fullName) . '\', this)" data-original-value="' . $currentRole . '">';
    foreach ($roles as $role) {
        $selected = ($role === $currentRole) ? 'selected' : '';
        $roleDropdown .= '<option value="' . $role . '" ' . $selected . '>' . ucfirst($role) . '</option>';
    }
    $roleDropdown .= "</select>";
    $roleDropdown .= "<span class='dropdown-arrow'>&#9662;</span>";
    $roleDropdown .= "</div>";
    return $roleDropdown;
}

function statusDropdown($currentStatus, $userId, $fullName)
{
    $allstatus = ['active', 'inactive', 'suspended'];
    $statusDropdown = '<div class="dropdown-wrapper">';
    $statusDropdown .= '<select class="staff-table" onchange="changeUserStatus(this.value, ' . $userId . ', \'' . addslashes($fullName) . '\', this)" data-original-value="' . $currentStatus . '">';
    foreach ($allstatus as $status) {
        $selected = ($status === $currentStatus) ? 'selected' : '';
        $statusDropdown .= '<option value="' . $status . '" ' . $selected . '>' . ucfirst($status) . '</option>';
    }
    $statusDropdown .= "</select>";
    $statusDropdown .= "<span class='dropdown-arrow'>&#9662;</span>";
    $statusDropdown .= "</div>";
    return $statusDropdown;
}
?>

