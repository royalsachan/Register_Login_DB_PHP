<?php
$db = new SQLite3('/var/www/html/lab_12_visiting_card/230101021_lab_12_database.db');

// Create users table
$result = $db->exec('CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE,
    name TEXT,
    password TEXT,
    email TEXT
)');

if ($result === false) {
    echo "Error creating users table: " . $db->lastErrorMsg() . "\n";
} else {
    echo "Users table created successfully\n";
}

// Create visiting_cards table
$result = $db->exec('CREATE TABLE IF NOT EXISTS visiting_cards (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    name TEXT,
    designation TEXT,
    email TEXT,
    mobile TEXT,
    organization TEXT,
    logo BLOB,
    format INTEGER,
    primary_color TEXT,
    secondary_color TEXT,
    text_color TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
)');

if ($result === false) {
    echo "Error creating visiting_cards table: " . $db->lastErrorMsg() . "\n";
} else {
    echo "Visiting_cards table created successfully\n";
}

$db->close();
echo "Database setup complete.\n";
?>
