<?php
include 'inc/header.php';
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>

<?php
// if (isset($_GET['proid']) || $_GET['proid'] != NULL) {
// 	$id = $_GET['proid'];
// }
?>

<?php
// $id = Session::get('customer_id');
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
// 	$update_cus = $cus->update_cus($_POST, $id);
// }
?>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment Method</h3>
                </div>
                <div class="clear"></div>
                <h3>Choose your method payment</h3>
                <a href="offlinepayment.php">Offline Payment</a>
                <a href="onlinepayment.php">Online Payment</a>
                <a href="cart.php">Previous</a>
            </div>

        </div>
    </div>
    <?php
    include 'inc/footer.php';
    ?>