<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $password = $_POST["password"]; // NOTE: In real apps, hash passwords!

    // Create user array
    $newUser = [
        "username" => $username,
        "password" => $password, // Store hashed passwords in production!
        "timestamp" => date("Y-m-d H:i:s")
    ];

    // File to store data
    $file = "users.json";

    // Get existing data (if file exists)
    $users = [];
    if (file_exists($file)) {
        $users = json_decode(file_get_contents($file), true);
    }

    // Add new user
    $users[] = $newUser;

    // Save back to JSON file
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

    // Respond to user
    echo "Login data saved! Check users.json.";
}
?>