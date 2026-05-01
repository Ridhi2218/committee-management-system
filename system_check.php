<?php
session_start();
include 'includes/db_connect.php';

echo "<style>";
echo "body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }";
echo ".section { background: white; padding: 20px; margin: 20px 0; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }";
echo ".success { color: green; font-weight: bold; }";
echo ".error { color: red; font-weight: bold; }";
echo ".warning { color: orange; font-weight: bold; }";
echo "table { width: 100%; border-collapse: collapse; margin-top: 10px; }";
echo "th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }";
echo "th { background: #165a92; color: white; }";
echo "tr:nth-child(even) { background: #f9f9f9; }";
echo "</style>";

echo "<h1>CFEES Committee System - Comprehensive Check</h1>";

// 1. Database Connection Check
echo "<div class='section'>";
echo "<h2>1. Database Connection</h2>";
if ($conn) {
    echo "<p class='success'>✓ Database connected successfully</p>";
    echo "<p>Database: " . htmlspecialchars($conn->server_info) . "</p>";
    
    // Check if database selected
    $db_check = mysqli_query($conn, "SELECT DATABASE()");
    $db_name = mysqli_fetch_assoc($db_check);
    echo "<p>Active Database: " . htmlspecialchars($db_name['DATABASE()']) . "</p>";
} else {
    echo "<p class='error'>✗ Database connection failed</p>";
}
echo "</div>";

// 2. Table Structure Check
echo "<div class='section'>";
echo "<h2>2. Database Tables Check</h2>";

$tables = ['committee', 'committee_members', 'id_emp', 'id_role', 'id_desig'];
$table_results = [];

foreach ($tables as $table) {
    $check = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
    if (mysqli_num_rows($check) > 0) {
        echo "<p class='success'>✓ Table '$table' exists</p>";
        
        // Get column info
        $columns = mysqli_query($conn, "SHOW COLUMNS FROM $table");
        echo "<table>";
        echo "<tr><th>Column</th><th>Type</th><th>Null</th><th>Key</th></tr>";
        while ($col = mysqli_fetch_assoc($columns)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($col['Field']) . "</td>";
            echo "<td>" . htmlspecialchars($col['Type']) . "</td>";
            echo "<td>" . htmlspecialchars($col['Null']) . "</td>";
            echo "<td>" . htmlspecialchars($col['Key']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='error'>✗ Table '$table' NOT FOUND</p>";
    }
}
echo "</div>";

// 3. Sample Data Check
echo "<div class='section'>";
echo "<h2>3. Sample Data Check</h2>";

// Check committees
$result = mysqli_query($conn, "SELECT COUNT(*) as count FROM committee");
$row = mysqli_fetch_assoc($result);
echo "<p>Committees: " . htmlspecialchars($row['count']) . " records</p>";

// Check members
$result = mysqli_query($conn, "SELECT COUNT(*) as count FROM committee_members");
$row = mysqli_fetch_assoc($result);
echo "<p>Committee Members: " . htmlspecialchars($row['count']) . " records</p>";

// Check employees
$result = mysqli_query($conn, "SELECT COUNT(*) as count FROM id_emp");
$row = mysqli_fetch_assoc($result);
echo "<p>Employees: " . htmlspecialchars($row['count']) . " records</p>";

// Check roles
$result = mysqli_query($conn, "SELECT COUNT(*) as count FROM id_role");
$row = mysqli_fetch_assoc($result);
echo "<p>Roles: " . htmlspecialchars($row['count']) . " records</p>";
echo "</div>";

// 4. Include Files Check
echo "<div class='section'>";
echo "<h2>4. Include Files Check</h2>";

$include_files = [
    'includes/db_connect.php',
    'includes/header.php',
    'includes/footer.php',
    'includes/session.php'
];

foreach ($include_files as $file) {
    if (file_exists($file)) {
        echo "<p class='success'>✓ " . htmlspecialchars($file) . " exists</p>";
    } else {
        echo "<p class='error'>✗ " . htmlspecialchars($file) . " NOT FOUND</p>";
    }
}
echo "</div>";

// 5. Key PHP Files Check
echo "<div class='section'>";
echo "<h2>5. Key PHP Files Check</h2>";

$php_files = [
    'admin/view_committee.php',
    'admin/add_member.php',
    'admin/dashboard.php',
    'admin/admin/view_committee_members.php'
];

foreach ($php_files as $file) {
    if (file_exists($file)) {
        echo "<p class='success'>✓ " . htmlspecialchars($file) . " exists</p>";
    } else {
        echo "<p class='error'>✗ " . htmlspecialchars($file) . " NOT FOUND</p>";
    }
}
echo "</div>";

// 6. Test Query: View Committee with Members
echo "<div class='section'>";
echo "<h2>6. Test Query - Committee with Members</h2>";

$testSql = "
    SELECT 
        CONCAT(e.first_name,' ',IFNULL(e.middle_name,''),' ',e.last_name) AS member_name,
        d.name AS designation,
        cr.role AS member_role,
        e.is_deleted
    FROM committee_members cm
    JOIN id_emp e ON cm.emp_id = e.id
    JOIN id_desig d ON e.desig_id = d.id
    LEFT JOIN id_role cr ON cm.role_id = cr.id
    LIMIT 5
";

$testResult = mysqli_query($conn, $testSql);
if ($testResult) {
    echo "<p class='success'>✓ Test query executed successfully</p>";
    echo "<p>Rows returned: " . mysqli_num_rows($testResult) . "</p>";
    if (mysqli_num_rows($testResult) > 0) {
        echo "<table>";
        echo "<tr><th>Member Name</th><th>Designation</th><th>Role</th><th>Status</th></tr>";
        while ($row = mysqli_fetch_assoc($testResult)) {
            $status = ($row['is_deleted'] == 'yes') ? 'Deleted' : 'Active';
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['member_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['designation']) . "</td>";
            echo "<td>" . htmlspecialchars($row['member_role']) . "</td>";
            echo "<td>" . htmlspecialchars($status) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='warning'>No test data available yet. Add some members to see results.</p>";
    }
} else {
    echo "<p class='error'>✗ Test query failed: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
}
echo "</div>";

// 7. Session Check
echo "<div class='section'>";
echo "<h2>7. Session Check</h2>";
if (isset($_SESSION['user_name'])) {
    echo "<p class='success'>✓ Session is active</p>";
    echo "<p>User: " . htmlspecialchars($_SESSION['user_name']) . "</p>";
} else {
    echo "<p class='warning'>⚠ No active session. This is normal for system check.</p>";
}
echo "</div>";

echo "<div class='section' style='text-align: center; margin-top: 40px;'>";
echo "<h3>System Check Complete</h3>";
echo "<p><a href='admin/dashboard.php' style='padding: 10px 20px; background: #165a92; color: white; text-decoration: none; border-radius: 5px;'>Go to Admin Dashboard</a></p>";
echo "</div>";

mysqli_close($conn);
?>
