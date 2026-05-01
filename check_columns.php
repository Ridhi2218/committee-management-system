<?php
include 'includes/db_connect.php';

echo "<h2>id_emp table columns:</h2>";
$result = mysqli_query($conn, "DESCRIBE id_emp");
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['Field'] . " - " . $row['Type'] . "<br>";
}

echo "<h2>committee_members table columns:</h2>";
$result = mysqli_query($conn, "DESCRIBE committee_members");
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['Field'] . " - " . $row['Type'] . "<br>";
}
?>
