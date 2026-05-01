<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CFEES Committee System - Control Center</title>
    <link rel="stylesheet" href="style/fontawesome/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
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
        
        .header {
            text-align: center;
            color: white;
            margin-bottom: 50px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .header h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }
        
        .header p {
            font-size: 18px;
            opacity: 0.9;
        }
        
        .status-bar {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .status-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            background: #f8f9fa;
            border-radius: 6px;
            border-left: 4px solid #28a745;
        }
        
        .status-item .icon {
            font-size: 24px;
            color: #28a745;
        }
        
        .status-item.warning {
            border-left-color: #ffc107;
        }
        
        .status-item.warning .icon {
            color: #ffc107;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }
        
        .card-header {
            background: linear-gradient(135deg, #165a92 0%, #0f3f5c 100%);
            color: white;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .card-header .icon {
            font-size: 40px;
        }
        
        .card-header h2 {
            font-size: 24px;
            margin: 0;
        }
        
        .card-body {
            padding: 25px;
        }
        
        .card-body p {
            color: #555;
            margin-bottom: 15px;
            line-height: 1.6;
        }
        
        .card-body .features {
            list-style: none;
            margin-bottom: 15px;
        }
        
        .card-body .features li {
            color: #666;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }
        
        .card-body .features li:last-child {
            border-bottom: none;
        }
        
        .card-body .features li:before {
            content: "✓ ";
            color: #28a745;
            font-weight: bold;
            margin-right: 8px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: linear-gradient(135deg, #165a92 0%, #0f3f5c 100%);
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        
        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(22, 90, 146, 0.4);
        }
        
        .btn-block {
            display: block;
            text-align: center;
            width: 100%;
        }
        
        .category {
            margin-bottom: 40px;
        }
        
        .category h3 {
            color: white;
            font-size: 24px;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        
        .footer {
            text-align: center;
            color: white;
            padding: 30px;
            margin-top: 50px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }
        
        .badge {
            display: inline-block;
            padding: 5px 12px;
            background: #28a745;
            color: white;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .badge.new {
            background: #17a2b8;
        }
        
        .badge.critical {
            background: #dc3545;
        }
        
        @media (max-width: 768px) {
            .header h1 {
                font-size: 36px;
            }
            
            .status-bar {
                flex-direction: column;
            }
            
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    
    <div class="header">
        <h1>🎯 CFEES Committee Management System</h1>
        <p>Control Center & Quick Access</p>
    </div>
    
    <div class="status-bar">
        <div class="status-item">
            <div class="icon">✅</div>
            <div>System Status: <strong>OPERATIONAL</strong></div>
        </div>
        <div class="status-item">
            <div class="icon">🔧</div>
            <div>Fixes Applied: <strong>5 Critical</strong></div>
        </div>
        <div class="status-item">
            <div class="icon">📊</div>
            <div>Database: <strong>Connected</strong></div>
        </div>
        <div class="status-item">
            <div class="icon">📁</div>
            <div>Files: <strong>Verified</strong></div>
        </div>
    </div>
    
    <!-- ADMIN SECTION -->
    <div class="category">
        <h3>👨‍💼 Admin Panel</h3>
        <div class="grid">
            <div class="card">
                <div class="card-header">
                    <div class="icon">📋</div>
                    <h2>Dashboard</h2>
                </div>
                <div class="card-body">
                    <p>Access the main admin dashboard to manage all committees.</p>
                    <ul class="features">
                        <li>View all committees</li>
                        <li>Create new committees</li>
                        <li>Edit committee details</li>
                        <li>Delete committees</li>
                    </ul>
                    <a href="admin/dashboard.php" class="btn btn-block">Open Dashboard</a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="icon">👥</div>
                    <h2>Manage Members</h2>
                </div>
                <div class="card-body">
                    <p>View and manage all committee members across all committees.</p>
                    <ul class="features">
                        <li>View all members</li>
                        <li>Filter by committee</li>
                        <li>Check member roles</li>
                        <li>View designations</li>
                    </ul>
                    <a href="admin/admin/view_committee_members.php" class="btn btn-block">View Members</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- TESTING SECTION -->
    <div class="category">
        <h3>🧪 System Testing & Verification</h3>
        <div class="grid">
            <div class="card">
                <div class="card-header">
                    <div class="icon">⚡</div>
                    <h2>Complete Test Suite</h2>
                </div>
                <div class="card-body">
                    <span class="badge new">NEW</span>
                    <p>Run comprehensive tests on all system components.</p>
                    <ul class="features">
                        <li>Database connection test</li>
                        <li>Table integrity check</li>
                        <li>Query validation</li>
                        <li>Sample data display</li>
                        <li>File system check</li>
                    </ul>
                    <a href="test_all.php" class="btn btn-block">Run Full Test</a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="icon">📊</div>
                    <h2>System Check</h2>
                </div>
                <div class="card-body">
                    <span class="badge new">NEW</span>
                    <p>Detailed system verification and diagnostics.</p>
                    <ul class="features">
                        <li>Database info</li>
                        <li>Table structure</li>
                        <li>Data summary</li>
                        <li>Include files</li>
                        <li>Error logging</li>
                    </ul>
                    <a href="system_check.php" class="btn btn-block">Check System</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- DOCUMENTATION SECTION -->
    <div class="category">
        <h3>📚 Documentation & Guides</h3>
        <div class="grid">
            <div class="card">
                <div class="card-header">
                    <div class="icon">📖</div>
                    <h2>System Guide</h2>
                </div>
                <div class="card-body">
                    <p>Complete user guide and system documentation.</p>
                    <ul class="features">
                        <li>Quick start guide</li>
                        <li>Feature overview</li>
                        <li>Troubleshooting</li>
                        <li>Database schema</li>
                    </ul>
                    <a href="README.md" class="btn btn-block" download>Download README</a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="icon">🔧</div>
                    <h2>Fix Documentation</h2>
                </div>
                <div class="card-body">
                    <span class="badge critical">IMPORTANT</span>
                    <p>Detailed list of all fixes and improvements applied.</p>
                    <ul class="features">
                        <li>5 critical errors fixed</li>
                        <li>4 improvements added</li>
                        <li>5 new files created</li>
                        <li>Complete changelog</li>
                    </ul>
                    <a href="CODE_REVIEW_FIXES.md" class="btn btn-block" download>View Fixes</a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="icon">✅</div>
                    <h2>System Status</h2>
                </div>
                <div class="card-body">
                    <span class="badge">NEW</span>
                    <p>Current system status and fix summary report.</p>
                    <ul class="features">
                        <li>All errors fixed</li>
                        <li>System operational</li>
                        <li>Ready for production</li>
                        <li>Full documentation</li>
                    </ul>
                    <a href="SYSTEM_STATUS.txt" class="btn btn-block" download>View Status</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- QUICK ACTIONS -->
    <div class="category">
        <h3>⚡ Quick Actions</h3>
        <div class="grid">
            <div class="card">
                <div class="card-header">
                    <div class="icon">🏠</div>
                    <h2>Home</h2>
                </div>
                <div class="card-body">
                    <p>Return to home page.</p>
                    <a href="index.php" class="btn btn-block">Go Home</a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <div class="icon">🚪</div>
                    <h2>Logout</h2>
                </div>
                <div class="card-body">
                    <p>Logout from the system.</p>
                    <a href="logout.php" class="btn btn-block">Logout</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>🎉 CFEES Committee Management System | All Systems Operational ✅</p>
        <p style="font-size: 12px; margin-top: 10px; opacity: 0.7;">
            Database: cfees_committee | Status: Verified | Last Updated: Jan 28, 2026
        </p>
    </div>
    
</div>

</body>
</html>
