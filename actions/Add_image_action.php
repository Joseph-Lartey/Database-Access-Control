<?php
include('../settings/connection.php'); // Include the connection file
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $file_name = $_FILES["image"]["name"];
        $file_tmp = $_FILES["image"]["tmp_name"];
        $file_size = $_FILES["image"]["size"];
        $file_type = $_FILES["image"]["type"];
        
        $max_file_size = 5 * 1024 * 1024; 
        if ($file_size > $max_file_size) {
            header("Location: ../views/profile.php?msg=" . urlencode("File size exceeds the maximum limit (5MB)."));
            exit();
        } elseif (!in_array($file_type, ["image/jpeg", "image/png", "image/gif"])) {
            header("Location: ../views/profile.php?msg=" . urlencode("Only JPEG, PNG, and GIF files are allowed."));
            exit();
        } else {
            $file_name = uniqid() . "_" . $file_name; // Generate a unique file name
            
            $upload_path = "../uploads/";
            if (move_uploaded_file($file_tmp, $upload_path . $file_name)) {
                try {
                    $stmt = $pdo->prepare("UPDATE Users SET ProfileImage = ? WHERE UserID = ?");
                    $user_id = $_SESSION['userID']; // Retrieve the logged-in user's ID
                    $stmt->execute([$file_name, $user_id]);

                    if ($stmt->rowCount() > 0) {
                        header("Location: ../views/profile.php?msg=" . urlencode("Image uploaded successfully."));
                        exit();
                    } else {
                        header("Location: ../views/profile.php?msg=" . urlencode("Failed to update profile image."));
                        exit();
                    }
                } catch (PDOException $e) {
                    header("Location: ../views/profile.php?msg=" . urlencode("Database error: " . $e->getMessage()));
                    exit();
                }
            } else {
                header("Location: ../views/profile.php?msg=" . urlencode("Failed to move the uploaded file."));
                exit();
            }
        }
    } else {
        header("Location: ../views/profile.php?msg=" . urlencode("No file uploaded or an error occurred during file upload."));
        exit();
    }
} else {
    header("Location: ../views/profile.php?msg=" . urlencode("Invalid request method."));
    exit();
}
