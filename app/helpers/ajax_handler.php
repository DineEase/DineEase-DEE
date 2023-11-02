<?php


if (isset($_POST['content'])) {
    
    $content = $_POST['content'];
    $_SESSION['content'] = $content;

    $filePath = APPROOT . '/views/customer/' . $content . '.php';

    if (file_exists($filePath)) {
        require $filePath;
    } else {
        echo 'File not found.';
    }
}
?>
