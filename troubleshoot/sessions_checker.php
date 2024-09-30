<?php
session_start();

if (isset($_POST['destroy_session']) && isset($_POST['session_name'])) {
    $session_name = $_POST['session_name'];
    if (isset($_SESSION[$session_name])) {
        unset($_SESSION[$session_name]);
        header("Location: sessions_checker.php");
        exit();
    }
}

echo "<h2>Sessions</h2>";
echo "<ul>";
foreach ($_SESSION as $key => $value) {
    echo "<li><strong>$key:</strong>";
    if (is_array($value)) {
        echo "<ul>";
        foreach ($value as $subKey => $subValue) {
            echo "<li>$subKey: $subValue</li>";
        }
        echo "</ul>";
    } else {
        echo " $value</li>";
    }
}
echo "</ul>";


echo "<form method='post'>";
echo "<label for='session_name'>Select session to destroy:</label>";
echo "<select name='session_name' id='session_name'>";
foreach ($_SESSION as $key => $value) {
    echo "<option value='$key'>$key</option>";
}
echo "</select>";
echo "<button type='submit' name='destroy_session'>Destroy Session</button>";
echo "</form>";

?>
