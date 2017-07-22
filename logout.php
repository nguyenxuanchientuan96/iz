<?php $title = 'Log_out'; require_once('templates-part/head.php');?>
<?php require_once('templates-part/header.php');?>
<?php include('inc/lib.php');?>
<?php require_once('templates-part/menu.php');?>
<?php require_once('templates-part/slider-a.php');?>
<div id="content">
    <?php 
        if(!isset($_SESSION['first_name'])) {
            // Neu nguoi dung chua dang nhap va khong co thong tin trong he thong
            redirect_to();
        } else {
            // Neu co thong tin nguoi dung, va da dang nhap, se logout nguoi dung.
            $_SESSION = array(); // Xoa het array cua SESSIOM
            session_destroy(); // Destroy session da tao
            setcookie(session_name(),'', time()-36000); // Xoa cookie cua trinh duyet
        } 
        echo "<h2>You are now logged out.</h2>";
    ?>
</div><!--end content-->
<?php require_once('templates-part/sidebar-b.php');?>
<?php require_once('templates-part/footer.php'); ?>

