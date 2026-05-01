<?php
include 'includes/db_connect.php';

echo "Checking existing committees:\n";
$result = $conn->query("SELECT id, committee_shortname FROM committee ORDER BY id DESC LIMIT 10");
while($row = $result->fetch_assoc()) {
    echo "ID: " . $row['id'] . " - " . $row['committee_shortname'] . "\n";
}

echo "\nChecking committee_members table structure:\n";
$result = $conn->query("DESCRIBE committee_members");
while($row = $result->fetch_assoc()) {
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
?>
