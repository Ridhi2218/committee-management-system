<?php
/**
 * Complete Testing & Debugging Tool
 * Access at: http://localhost/cfees_committee/test_all.php
 */

session_start();
include 'includes/db_connect.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>CFEES - Complete System Test</title>
    <style>
        * { margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            color: white;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .section {
            background: white;
            padding: 25px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .section h2 {
            color: #165a92;
            border-bottom: 3px solid #165a92;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 4px;
            font-weight: bold;
            margin: 5px 0;
        }
        .status.pass {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status.fail {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .status.warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th {
            background: #165a92;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        tr:hover {
            background: #f0f0f0;
        }
        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 12px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .success-box {
            background: #e8f5e9;
            border-left: 4px solid #4CAF50;
            padding: 12px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .error-box {
            background: #ffebee;
            border-left: 4px solid #f44336;
            padding: 12px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            color: white;
            margin-top: 50px;
            padding: 20px;
        }
        .button {
            background: #165a92;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin: 10px 5px;
            font-size: 14px;
        }
        .button:hover {
            background: #0f3f5c;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🔍 CFEES Committee System - Complete Test Suite</h1>

    <!-- Database Connection -->
    <div class="section">
        <h2>1️⃣ Database Connection Test</h2>
        <?php
        if ($conn) {
            echo '<div class="status pass">✓ PASS - Database Connected</div>';
            echo '<div class="info-box">';
            echo '<strong>Connection Info:</strong><br>';
            echo 'Server: ' . htmlspecialchars($conn->server_info) . '<br>';
            $db_result = mysqli_query($conn, "SELECT DATABASE() as db");
            $db_row = mysqli_fetch_assoc($db_result);
            echo 'Database: ' . htmlspecialchars($db_row['db']) . '<br>';
            echo 'Character Set: utf8';
            echo '</div>';
        } else {
            echo '<div class="status fail">✗ FAIL - Connection Error</div>';
            echo '<div class="error-box">' . htmlspecialchars(mysqli_connect_error()) . '</div>';
        }
        ?>
    </div>

    <!-- Table Verification -->
    <div class="section">
        <h2>2️⃣ Database Tables Verification</h2>
        <?php
        $required_tables = ['committee', 'committee_members', 'id_emp', 'id_role', 'id_desig', 'id_group'];
        $all_tables_exist = true;

        foreach ($required_tables as $table) {
            $check = mysqli_query($conn, "SHOW TABLES LIKE '$table'");
            if (mysqli_num_rows($check) > 0) {
                echo '<div class="status pass">✓ ' . htmlspecialchars($table) . '</div>';
            } else {
                echo '<div class="status fail">✗ ' . htmlspecialchars($table) . '</div>';
                $all_tables_exist = false;
            }
        }

        if ($all_tables_exist) {
            echo '<div class="success-box">All required tables exist!</div>';
        } else {
            echo '<div class="error-box">Some tables are missing!</div>';
        }
        ?>
    </div>

    <!-- Sample Data Count -->
    <div class="section">
        <h2>3️⃣ Data Summary</h2>
        <?php
        $tables_count = [
            'committee' => 'Committees',
            'committee_members' => 'Committee Members',
            'id_emp' => 'Employees',
            'id_role' => 'Roles',
            'id_desig' => 'Designations'
        ];

        echo '<table>';
        echo '<tr><th>Table</th><th>Record Count</th></tr>';

        foreach ($tables_count as $table => $label) {
            $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM $table");
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
            echo '<tr>';
            echo '<td>' . htmlspecialchars($label) . '</td>';
            echo '<td>';
            if ($count > 0) {
                echo '<span class="status pass">' . htmlspecialchars($count) . ' records</span>';
            } else {
                echo '<span class="status warning">No records</span>';
            }
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        ?>
    </div>

    <!-- Query Testing -->
    <div class="section">
        <h2>4️⃣ Critical Query Tests</h2>
        <?php
        // Test 1: Committee Members with all joins
        $test1 = "
            SELECT 
                COUNT(*) as count
            FROM committee_members cm
            JOIN id_emp e ON cm.emp_id = e.id
            JOIN id_desig d ON e.desig_id = d.id
            LEFT JOIN id_role r ON cm.role_id = r.id
        ";

        $result = mysqli_query($conn, $test1);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo '<div class="status pass">✓ Member Query Test</div>';
            echo '<div class="info-box">Query returns: ' . htmlspecialchars($row['count']) . ' records</div>';
        } else {
            echo '<div class="status fail">✗ Member Query Test Failed</div>';
            echo '<div class="error-box">' . htmlspecialchars(mysqli_error($conn)) . '</div>';
        }

        // Test 2: Committee Details Query
        $test2 = "
            SELECT id, committee_shortname, committee_fullname
            FROM committee
            WHERE id = 1
            LIMIT 1
        ";

        $result = mysqli_query($conn, $test2);
        if ($result) {
            echo '<div class="status pass">✓ Committee Query Test</div>';
            if (mysqli_num_rows($result) > 0) {
                echo '<div class="info-box">Sample committee found</div>';
            } else {
                echo '<div class="warning">No committees in database</div>';
            }
        } else {
            echo '<div class="status fail">✗ Committee Query Test Failed</div>';
        }
        ?>
    </div>

    <!-- File System Check -->
    <div class="section">
        <h2>5️⃣ File System Check</h2>
        <?php
        $files_to_check = [
            'includes/db_connect.php' => 'Database Connection',
            'includes/header.php' => 'Header Include',
            'includes/footer.php' => 'Footer Include',
            'includes/error_handler.php' => 'Error Handler',
            'admin/view_committee.php' => 'View Committee',
            'admin/add_member.php' => 'Add Member',
            'admin/dashboard.php' => 'Admin Dashboard',
            'system_check.php' => 'System Check'
        ];

        echo '<table>';
        echo '<tr><th>File</th><th>Status</th></tr>';

        foreach ($files_to_check as $file => $label) {
            $exists = file_exists($file) ? 'pass' : 'fail';
            $status_text = file_exists($file) ? '✓ Exists' : '✗ Missing';
            echo '<tr>';
            echo '<td>' . htmlspecialchars($label) . '</td>';
            echo '<td><span class="status ' . $exists . '">' . $status_text . '</span></td>';
            echo '</tr>';
        }
        echo '</table>';
        ?>
    </div>

    <!-- Sample Data Display -->
    <div class="section">
        <h2>6️⃣ Sample Committee Members (First 10)</h2>
        <?php
        $sample_query = "
            SELECT 
                CONCAT(e.first_name,' ',IFNULL(e.middle_name,''),' ',e.last_name) AS member_name,
                d.name AS designation,
                r.role,
                e.is_deleted
            FROM committee_members cm
            JOIN id_emp e ON cm.emp_id = e.id
            JOIN id_desig d ON e.desig_id = d.id
            LEFT JOIN id_role r ON cm.role_id = r.id
            LIMIT 10
        ";

        $result = mysqli_query($conn, $sample_query);
        if ($result && mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr><th>Member Name</th><th>Designation</th><th>Role</th><th>Status</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                $status = ($row['is_deleted'] == 'yes') ? 'Deleted' : 'Active';
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['member_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['designation']) . '</td>';
                echo '<td>' . htmlspecialchars($row['role']) . '</td>';
                echo '<td><span class="status ' . ($row['is_deleted'] == 'yes' ? 'fail' : 'pass') . '">' . $status . '</span></td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '<div class="success-box">Sample data loaded successfully!</div>';
        } else {
            echo '<div class="info-box">No committee members yet. Add some to see them here.</div>';
        }
        ?>
    </div>

    <!-- Session Check -->
    <div class="section">
        <h2>7️⃣ Session & Session</h2>
        <?php
        if (isset($_SESSION['user_name'])) {
            echo '<div class="status pass">✓ Session Active</div>';
            echo '<div class="info-box">';
            echo 'Username: ' . htmlspecialchars($_SESSION['user_name']) . '<br>';
            if (isset($_SESSION['role'])) {
                echo 'Role: ' . htmlspecialchars($_SESSION['role']) . '<br>';
            }
            echo '</div>';
        } else {
            echo '<div class="status warning">⚠ No Active Session</div>';
            echo '<div class="info-box">This is normal for system testing. Login to access admin panel.</div>';
        }
        ?>
    </div>

    <!-- Diagnostics Summary -->
    <div class="section">
        <h2>📋 Diagnostic Summary</h2>
        <?php
        $all_pass = ($conn && $all_tables_exist && file_exists('includes/db_connect.php'));
        
        if ($all_pass) {
            echo '<div class="success-box" style="font-size: 16px; padding: 20px;">';
            echo '<strong>✓ All systems operational!</strong><br>';
            echo 'The application is ready to use.';
            echo '</div>';
        } else {
            echo '<div class="error-box" style="font-size: 16px; padding: 20px;">';
            echo '<strong>✗ Some issues found</strong><br>';
            echo 'Check the tests above for details.';
            echo '</div>';
        }
        ?>
    </div>

    <!-- Action Buttons -->
    <div class="footer">
        <a href="admin/dashboard.php" class="button">➜ Go to Admin Dashboard</a>
        <a href="system_check.php" class="button">📊 Detailed System Check</a>
        <a href="index.php" class="button">🏠 Go Home</a>
    </div>

</div>

<?php mysqli_close($conn); ?>

</body>
</html>
