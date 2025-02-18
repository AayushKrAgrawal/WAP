<?php
session_start();
include('../includes/db_connect.php');

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit();
}

// Handle role update
if (isset($_GET['update_role']) && isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    $newRole = ($_GET['update_role'] == 'user') ? 'admin' : 'user'; // Toggle between 'user' and 'admin'

    $sql = "UPDATE users SET role = :role WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':role', $newRole, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    if ($stmt->execute()) {
        header("Location: manage_users.php"); // Refresh the page after updating
    } else {
        echo "Error updating role: " . $stmt->errorInfo()[2];
    }
}

// Handle user deletion
if (isset($_GET['delete_user']) && isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    try {
        // Start a transaction
        $conn->beginTransaction();

        // Step 1: Delete related cart entries first
        $sql = "DELETE FROM cart WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Step 2: Delete related order_items entries
        $sql = "DELETE oi FROM order_items oi
                INNER JOIN orders o ON oi.order_id = o.order_id
                WHERE o.user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Step 3: Delete related orders entries
        $sql = "DELETE FROM orders WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        
        // Step 4: Now delete the user
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();
        header("Location: manage_users.php"); // Refresh the page after deleting

    } catch (PDOException $e) {
        // Rollback if something goes wrong
        $conn->rollBack();
        echo "Cannot delete user due to related data: " . $e->getMessage();
    }
}

// Fetch all users
$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .table-container {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 16px;
            text-align: left;
        }
        th {
            background-color: #4f6d7a;
            color: #ffffff;
        }
        tr:nth-child(even) {
            background-color: #f4f7fb;
        }
        .action-btn {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .update-role {
            background-color: #4caf50;
            color: white;
        }
        .update-role:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .delete-btn:hover {
            background-color: #d32f2f;
        }
        .page-container {
            background: linear-gradient(45deg, #2f80ed, #56ccf2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .content-wrapper {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            max-width: 1200px;
            width: 100%;
        }
        .heading {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .table-container {
            overflow-x: auto;
        }
        .back-btn {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }
        .back-btn:hover {
            background-color: #45a049;
        }

        /* Custom Pop-up Styles */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .popup {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 300px;
        }
        .popup button {
            margin-top: 10px;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .popup button.cancel {
            background-color: #f44336;
        }
    </style>
</head>
<body>

    <!-- Main Content -->
    <div class="page-container">
        <div class="content-wrapper">
            <!-- Back to Dashboard Button -->
            <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>

            <h1 class="heading">Manage Users</h1>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($users) > 0) {
                            foreach ($users as $row) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                                echo "<td>
                                        <a href='#' onclick='confirmRoleChange(" . $row['user_id'] . ", \"" . ($row['role'] == 'user' ? 'user' : 'admin') . "\")' class='action-btn update-role'>
                                            " . ($row['role'] == 'user' ? 'Make Admin' : 'Make User') . "
                                        </a> | 
                                        <a href='#' onclick='confirmDelete(" . $row['user_id'] . ")' class='action-btn delete-btn'>
                                            Delete
                                        </a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Confirmation Popup -->
    <div id="popup-overlay" class="popup-overlay">
        <div class="popup">
            <p id="popup-message">Are you sure you want to perform this action?</p>
            <button id="popup-confirm" onclick="confirmAction()">Yes</button>
            <button class="cancel" onclick="closePopup()">No</button>
        </div>
    </div>

    <script>
        let userIdToDelete;
        let actionType;

        function confirmDelete(userId) {
            userIdToDelete = userId;
            actionType = 'delete';
            document.getElementById("popup-message").textContent = "Are you sure you want to delete this user?";
            document.getElementById("popup-overlay").style.display = "flex";
        }

        function confirmRoleChange(userId, newRole) {
            userIdToDelete = userId;
            actionType = 'roleChange';
            document.getElementById("popup-message").textContent = `Are you sure you want to change this user's role to ${newRole}?`;
            document.getElementById("popup-overlay").style.display = "flex";
        }

        function confirmAction() {
            if (actionType === 'delete') {
                window.location.href = '?delete_user=true&user_id=' + userIdToDelete;
            } else if (actionType === 'roleChange') {
                const newRole = actionType === 'roleChange' ? 'admin' : 'user';
                window.location.href = '?update_role=' + newRole + '&user_id=' + userIdToDelete;
            }
            closePopup();
        }

        function closePopup() {
            document.getElementById("popup-overlay").style.display = "none";
        }
    </script>

</body>
</html>
