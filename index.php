<?php
// Define application constants
define('APP_NAME', 'Simple PHP Deploy App');
define('APP_VERSION', '1.0.0');

// Get current server information
$server_info = [
    'Server Software' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
    'PHP Version' => phpversion() ?? 'N/A',
    'Server Protocol' => $_SERVER['SERVER_PROTOCOL'] ?? 'N/A',
    'Server Address' => $_SERVER['SERVER_ADDR'] ?? 'N/A',
    'Remote Address' => $_SERVER['REMOTE_ADDR'] ?? 'N/A',
];

// Get current date and time
$current_time = date('Y-m-d H:i:s T');

// Get a selection of environment variables (for deployment context)
$env_vars = [
    'DOCUMENT_ROOT' => $_SERVER['DOCUMENT_ROOT'] ?? 'N/A',
    'REQUEST_URI' => $_SERVER['REQUEST_URI'] ?? 'N/A',
    'SCRIPT_FILENAME' => $_SERVER['SCRIPT_FILENAME'] ?? 'N/A',
    'HTTP_HOST' => $_SERVER['HTTP_HOST'] ?? 'N/A',
];

// Start generating the HTML output
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0 auto;
            padding: 20px;
            max-width: 800px;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo APP_NAME; ?></h1>
        <p>Version: <strong><?php echo APP_VERSION; ?></strong></p>
        <p>This is a simple, single-file PHP application for testing deployment [1, 2]. It requires no external connections.</p>

        <h2>Status</h2>
        <table>
            <tr>
                <th>Item</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Current Time</td>
                <td><?php echo htmlspecialchars($current_time); ?></td>
            </tr>
        </table>

        <h2>Server Information</h2>
        <table>
            <?php foreach ($server_info as $key => $value): ?>
                <tr>
                    <th><?php echo htmlspecialchars($key); ?></th>
                    <td><?php echo htmlspecialchars($value); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Environment & Request Variables</h2>
        <table>
            <?php foreach ($env_vars as $key => $value): ?>
                <tr>
                    <th><?php echo htmlspecialchars($key); ?></th>
                    <td><?php echo htmlspecialchars($value); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
