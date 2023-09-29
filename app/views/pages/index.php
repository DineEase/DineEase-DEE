<?php require APPROOT . '/views/inc/header.php'; ?>
<h1><?php echo $data['title'] ?> </h1>
<?php
if (isset($_SESSION['user_id'])) {
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
}
?>


 

<?php require APPROOT . '/views/inc/footer.php'; ?>