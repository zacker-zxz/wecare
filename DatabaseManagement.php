<?php session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminlogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Management - WeCare Admin</title>
    <link rel="stylesheet" href="hospital-theme.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .db-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .db-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .db-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="db-grid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23db-grid)"/></svg>');
            opacity: 0.3;
        }

        .db-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .db-card {
            background: var(--pure-white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-large);
            position: relative;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="db-pattern" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="7.5" cy="7.5" r="2" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23db-pattern)"/></svg>');
            opacity: 0.3;
        }

        .card-header h1 {
            color: var(--pure-white);
            margin: 0 0 0.5rem 0;
            font-size: 2rem;
            position: relative;
            z-index: 2;
        }

        .card-header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 0;
            font-size: 1rem;
            position: relative;
            z-index: 2;
        }

        .card-body {
            padding: 3rem 2rem;
        }

        .db-controls {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .control-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            color: var(--pure-white);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .control-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .control-btn.secondary {
            background: var(--pure-white);
            color: var(--primary-blue);
            border: 2px solid var(--primary-blue);
        }

        .control-btn.secondary:hover {
            background: var(--primary-blue);
            color: var(--pure-white);
        }

        .sql-dump-container {
            background: #1e1e1e;
            border-radius: 12px;
            padding: 2rem;
            position: relative;
            border: 1px solid #333;
        }

        .sql-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #333;
        }

        .sql-title {
            color: #61dafb;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }

        .sql-meta {
            color: #888;
            font-size: 0.8rem;
        }

        .sql-content {
            background: #2d2d2d;
            border-radius: 8px;
            padding: 1.5rem;
            font-family: 'Consolas', 'Monaco', 'Courier New', monospace;
            font-size: 0.85rem;
            line-height: 1.4;
            color: #f8f8f2;
            white-space: pre-wrap;
            word-wrap: break-word;
            max-height: 600px;
            overflow-y: auto;
            border: 1px solid #444;
        }

        .sql-keyword {
            color: #ff79c6;
            font-weight: bold;
        }

        .sql-string {
            color: #f1fa8c;
        }

        .sql-comment {
            color: #6272a4;
            font-style: italic;
        }

        .sql-function {
            color: #50fa7b;
        }

        .sql-number {
            color: #bd93f9;
        }

        .table-section {
            margin-bottom: 2rem;
            border: 1px solid #444;
            border-radius: 8px;
            overflow: hidden;
        }

        .table-header {
            background: #333;
            padding: 1rem;
            color: #61dafb;
            font-weight: 600;
            border-bottom: 1px solid #444;
        }

        .table-sql {
            background: #2d2d2d;
            padding: 1rem;
            font-family: 'Consolas', 'Monaco', 'Courier New', monospace;
            font-size: 0.8rem;
            line-height: 1.4;
            color: #f8f8f2;
            white-space: pre-wrap;
            word-wrap: break-word;
            border-bottom: 1px solid #444;
        }

        .table-sql:last-child {
            border-bottom: none;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            background: rgba(37, 99, 235, 0.05);
            transition: var(--transition);
            margin-bottom: 2rem;
        }

        .back-link:hover {
            background: rgba(37, 99, 235, 0.1);
            transform: translateX(-2px);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-box {
            background: #2d2d2d;
            border: 1px solid #444;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #61dafb;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #888;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .db-controls {
                flex-direction: column;
            }

            .control-btn {
                width: 100%;
                justify-content: center;
            }

            .sql-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="db-container">
        <div class="db-header">
            <div class="db-content" style="position: relative; z-index: 2;">
                <h1><i class="fas fa-database"></i> Database Management</h1>
                <p>Complete SQL dump of the appointment management system</p>
            </div>
        </div>

        <div class="db-content">
            <a href="AdminPage.php" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Admin Dashboard
            </a>

            <div class="db-card">
                <div class="card-header">
                    <h1><i class="fas fa-file-code"></i> MySQL Database Export</h1>
                    <p>Complete SQL dump in standard MySQL format</p>
                </div>

                <div class="card-body">
                    <?php
                    include 'DBconnect.php';

                    // Get database statistics
                    $tables = ['admintable', 'patient', 'doctor', 'clinic', 'booking', 'doctor_available', 'deleted_doctors'];
                    $stats = [];

                    foreach ($tables as $table) {
                        $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM $table");
                        $row = mysqli_fetch_assoc($result);
                        $stats[$table] = $row['count'];
                    }

                    echo '<div class="stats-grid">';
                    foreach ($stats as $table => $count) {
                        echo '<div class="stat-box">';
                        echo '<div class="stat-number">' . $count . '</div>';
                        echo '<div class="stat-label">' . ucfirst(str_replace('_', ' ', $table)) . '</div>';
                        echo '</div>';
                    }
                    echo '</div>';

                    echo '<div class="db-controls">';
                    echo '<button onclick="copyToClipboard()" class="control-btn"><i class="fas fa-copy"></i> Copy SQL</button>';
                    echo '<button onclick="downloadSQL()" class="control-btn secondary"><i class="fas fa-download"></i> Download SQL File</button>';
                    echo '<button onclick="window.location.reload()" class="control-btn secondary"><i class="fas fa-sync"></i> Refresh</button>';
                    echo '</div>';

                    // Generate minimal SQL dump
                    $sql_dump = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
                    $sql_dump .= "START TRANSACTION;\n";
                    $sql_dump .= "SET time_zone = \"+00:00\";\n\n";

                    // Get all tables
                    $tables_result = mysqli_query($conn, "SHOW TABLES");
                    $tables = [];

                    while ($row = mysqli_fetch_row($tables_result)) {
                        $tables[] = $row[0];
                    }

                    foreach ($tables as $table) {
                        $create_result = mysqli_query($conn, "SHOW CREATE TABLE $table");
                        $create_row = mysqli_fetch_row($create_result);
                        $sql_dump .= $create_row[1] . ";\n\n";

                        $data_result = mysqli_query($conn, "SELECT * FROM $table");
                        $num_rows = mysqli_num_rows($data_result);

                        if ($num_rows > 0) {
                            $columns_result = mysqli_query($conn, "DESCRIBE $table");
                            $columns = [];
                            while ($col_row = mysqli_fetch_assoc($columns_result)) {
                                $columns[] = $col_row['Field'];
                            }

                            while ($row = mysqli_fetch_assoc($data_result)) {
                                $values = [];
                                foreach ($columns as $column) {
                                    $value = $row[$column];
                                    if ($value === null) {
                                        $values[] = "NULL";
                                    } else {
                                        $values[] = "'" . mysqli_real_escape_string($conn, $value) . "'";
                                    }
                                }
                                $sql_dump .= "INSERT INTO `$table` (`" . implode("`, `", $columns) . "`) VALUES (" . implode(", ", $values) . ");\n";
                            }
                            $sql_dump .= "\n";
                        }
                    }

                    foreach ($tables as $table) {
                        $indexes_result = mysqli_query($conn, "SHOW INDEX FROM $table");
                        $indexes = [];

                        while ($index_row = mysqli_fetch_assoc($indexes_result)) {
                            $key_name = $index_row['Key_name'];
                            if ($key_name == 'PRIMARY') {
                                $indexes['PRIMARY'] = "ADD PRIMARY KEY (`" . $index_row['Column_name'] . "`)";
                            }
                        }

                        if (!empty($indexes)) {
                            $sql_dump .= "ALTER TABLE `$table`\n";
                            $sql_dump .= "  " . implode(",\n  ", $indexes) . ";\n\n";
                        }
                    }

                    foreach ($tables as $table) {
                        $auto_result = mysqli_query($conn, "SHOW TABLE STATUS LIKE '$table'");
                        $auto_row = mysqli_fetch_assoc($auto_result);

                        if ($auto_row['Auto_increment']) {
                            $sql_dump .= "ALTER TABLE `$table` AUTO_INCREMENT = " . $auto_row['Auto_increment'] . ";\n\n";
                        }
                    }

                    $sql_dump .= "COMMIT;\n";

                    // Display the SQL dump
                    echo '<div class="sql-dump-container">';
                    echo '<div class="sql-header">';
                    echo '<h3 class="sql-title"><i class="fas fa-code"></i> Database SQL Export</h3>';
                    echo '<div class="sql-meta">Tables: ' . count($tables) . ' | Size: ' . strlen($sql_dump) . ' chars</div>';
                    echo '</div>';
                    echo '<div class="sql-content" id="sqlContent">' . htmlspecialchars($sql_dump) . '</div>';
                    echo '</div>';
                    ?>

                    <script>
                        function copyToClipboard() {
                            const sqlContent = document.getElementById('sqlContent');
                            const textArea = document.createElement('textarea');
                            textArea.value = sqlContent.textContent;
                            document.body.appendChild(textArea);
                            textArea.select();
                            document.execCommand('copy');
                            document.body.removeChild(textArea);

                            // Show success message
                            showNotification('success', 'Copied!', 'SQL dump copied to clipboard successfully.');
                        }

                        function downloadSQL() {
                            const sqlContent = document.getElementById('sqlContent').textContent;
                            const blob = new Blob([sqlContent], { type: 'text/plain' });
                            const url = window.URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = 'appointment_database_' + new Date().toISOString().slice(0, 10) + '.sql';
                            document.body.appendChild(a);
                            a.click();
                            window.URL.revokeObjectURL(url);
                            document.body.removeChild(a);

                            showNotification('success', 'Downloaded!', 'SQL file downloaded successfully.');
                        }

                        function showNotification(type, title, message) {
                            const container = document.createElement('div');
                            container.innerHTML = `
                                <div class="notification ${type}" style="position: fixed; top: 20px; right: 20px; z-index: 10000;">
                                    <div class="notification-content">
                                        <div class="notification-icon">
                                            <i class="${type === 'success' ? 'fas fa-check-circle' : 'fas fa-info-circle'}"></i>
                                        </div>
                                        <div class="notification-text">
                                            <div class="notification-title">${title}</div>
                                            <div class="notification-message">${message}</div>
                                        </div>
                                        <button class="notification-close" onclick="this.closest('.notification').remove()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="notification-progress"></div>
                                </div>
                            `;
                            document.body.appendChild(container.firstElementChild);

                            // Auto remove after 3 seconds
                            setTimeout(() => {
                                const notification = document.querySelector('.notification');
                                if (notification) {
                                    notification.style.animation = 'notificationFadeOut 0.3s ease-out forwards';
                                    setTimeout(() => notification.remove(), 300);
                                }
                            }, 3000);
                        }

                        // Syntax highlighting for SQL keywords
                        document.addEventListener('DOMContentLoaded', function() {
                            const sqlContent = document.getElementById('sqlContent');
                            let html = sqlContent.innerHTML;

                            // SQL Keywords
                            const keywords = ['CREATE', 'TABLE', 'INSERT', 'INTO', 'VALUES', 'SELECT', 'FROM', 'WHERE', 'ALTER', 'ADD', 'PRIMARY', 'KEY', 'AUTO_INCREMENT', 'ENGINE', 'DEFAULT', 'CHARSET', 'COLLATE', 'SET', 'COMMIT', 'START', 'TRANSACTION'];
                            keywords.forEach(keyword => {
                                const regex = new RegExp(`\\b${keyword}\\b`, 'gi');
                                html = html.replace(regex, `<span class="sql-keyword">$&</span>`);
                            });

                            // Strings
                            html = html.replace(/('[^']*')/g, `<span class="sql-string">$1</span>`);

                            // Functions
                            html = html.replace(/\b(COUNT|MAX|MIN|SUM|AVG)\b/gi, `<span class="sql-function">$1</span>`);

                            // Numbers
                            html = html.replace(/\b(\d+)\b/g, `<span class="sql-number">$1</span>`);

                            sqlContent.innerHTML = html;
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</body>
</html>