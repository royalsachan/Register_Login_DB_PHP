<?php

require_once '230101021_lab_12_db_set_up.php';
error_reporting(E_ALL);
ini_set('display_errors', 1); 

echo "Script started<br>";


session_start();
echo "Session started<br>";

$db = new SQLite3('/var/www/html/lab_12_visiting_card/230101021_lab_12_database.db');
if (!$db) {
    die("Failed to connect to the database: " . SQLite3::lastErrorMsg());
}

$stmt = $db->prepare('SELECT id, password FROM users WHERE username = :username');

if (!$stmt) {
    die("Failed to prepare statement: " . $db->lastErrorMsg());
}
$page = isset($_GET['page']) ? $_GET['page'] : 'login';
echo "Page: $page<br>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($page == 'login') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $stmt = $db->prepare('SELECT id, password FROM users WHERE username = :username');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $result = $stmt->execute();
        $user = $result->fetchArray(SQLITE3_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: ?page=design');
            exit;
        } else {
            $error = "Invalid username or password";
        }
    } elseif ($page == 'register') {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        
        $stmt = $db->prepare('INSERT INTO users (username, name, password, email) VALUES (:username, :name, :password, :email)');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        
        if ($stmt->execute()) {
            $_SESSION['user_id'] = $db->lastInsertRowID();
            header('Location: ?page=design');
            exit;
        } else {
            $error = "Registration failed";
        }
    } elseif ($page == 'design' && isset($_SESSION['user_id'])) {
        // Handle card design submission
        $name = $_POST['name'];
        $designation = $_POST['designation'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $organization = $_POST['organization'];
        $logo = file_get_contents($_FILES['logo']['tmp_name']);
        $format = $_POST['format'];
        $primary_color = $_POST['primary_color'];
        $secondary_color = $_POST['secondary_color'];
        $text_color = $_POST['text_color'];
        
        $stmt = $db->prepare('INSERT INTO visiting_cards (user_id, name, designation, email, mobile, organization, logo, format, primary_color, secondary_color, text_color) VALUES (:user_id, :name, :designation, :email, :mobile, :organization, :logo, :format, :primary_color, :secondary_color, :text_color)');
        $stmt->bindValue(':user_id', $_SESSION['user_id'], SQLITE3_INTEGER);
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':designation', $designation, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':mobile', $mobile, SQLITE3_TEXT);
        $stmt->bindValue(':organization', $organization, SQLITE3_TEXT);
        $stmt->bindValue(':logo', $logo, SQLITE3_BLOB);
        $stmt->bindValue(':format', $format, SQLITE3_INTEGER);
        $stmt->bindValue(':primary_color', $primary_color, SQLITE3_TEXT);
        $stmt->bindValue(':secondary_color', $secondary_color, SQLITE3_TEXT);
        $stmt->bindValue(':text_color', $text_color, SQLITE3_TEXT);
        
        if ($stmt->execute()) {
            header('Location: ?page=display');
            exit;
        } else {
            $error = "Failed to save card design";
        }
    }
}

switch ($page) {
    case 'login':
        include 'templates/login.php';
        break;
    case 'register':
        include 'templates/register.php';
        break;
    case 'design':
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?page=login');
            exit;
        }
        include 'templates/design.php';
        break;
    case 'display':
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?page=login');
            exit;
        }
        include 'templates/display.php';
        break;
    default:
        include 'templates/login.php';
}
echo "Script ended";
?>
