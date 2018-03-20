<?php 
// If no session send home:
if (!isset($_SESSION["user_id"])) {
  header("Location: index.php");
}

// Get current user info:
$query = "SELECT * FROM users WHERE id = ${_SESSION['user_id']}";
$user = fetch_record($query);

// Get all messages and any respective comments:
$msg_query = "SELECT messages.id AS message_id, messages.message AS message, messages.created_at AS created_at, users.first_name AS first_name, users.last_name AS last_name FROM messages LEFT JOIN users ON messages.user_id = users.id;";

$messages = fetch_all($msg_query);
?>