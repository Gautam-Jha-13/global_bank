<?php
// Check if form is submitted
if(isset($_POST["submit"])) {
    // Define allowed file type
    $allowed_type = 'pdf';
    
    // Define maximum file size (in bytes)
    $max_size = 50 * 1024 * 1024; // 50 MB
    
    // Define upload directory
    $upload_dir = "uploads/";
    
    // Get uploaded file details
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    // Check file type and size
    if($file_type === $allowed_type && $file_size <= $max_size) {
        // Generate unique filename to prevent overwriting existing files
        $new_filename = uniqid() . '.pdf';
        
        // Move uploaded file to upload directory
        if(move_uploaded_file($file_tmp, $upload_dir . $new_filename)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Invalid file type or size. Only PDF files are allowed, and maximum file size is " . ($max_size / 1024 / 1024) . " MB.";
    }
}
?>
