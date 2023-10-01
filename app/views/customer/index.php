<?php require APPROOT . '/views/inc/header-general.php'; ?>
<div class="container">
    <div class="navbar-template">
        <?php require APPROOT . '/views/inc/topbar.php'; ?>
    </div>
    <div class="sidebar-template">
        <?php require APPROOT . '/views/inc/sidebar-customer.php'; ?>
    </div>
    <div class="body-template">
        <?php 
            require APPROOT . '/views/customer/menu.php';
        ?>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer-general.php'; ?>