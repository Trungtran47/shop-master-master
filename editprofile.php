<?php
include 'inc/header.php';
?>

<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('Location:login.php');
    }
?>

<?php
// if (isset($_GET['proid']) || $_GET['proid'] != NULL) {
// 	$id = $_GET['proid'];
// }
?>

<?php
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
	$update_cus = $cus->update_cus($_POST, $id);
}
?>

<div class="main">
	<div class="content">
		<div class="section group">
            <div class="content_top">
            <div class="heading">
                <h3>Profile Customers</h3>
            </div>
            <?php if(isset($update_cus)) echo $update_cus ?>
            <div class="clear"></div>
            </div>
            <form action="" method="post">
            <table class="tblone">
            <?php
            $id = Session::get('customer_id');
            $get_info_cus = $cus->show_info_cus($id);
            if($get_info_cus){
                while($result = $get_info_cus->fetch_assoc()){
            ?>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><input type="text" name="city" value="<?php echo $result['city'] ?>"></td>
                </tr>
                <!-- <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><input type="text" name="name" value="<?php echo $result['country'] ?>"></td>
                </tr> -->
                <tr>
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="submit" value="Save" name="save" class="grey"></td>
                </tr>
                <?php 
                    }
                }
                ?>
            </table>
            </form>
		</div>
	</div>
	<?php
	include 'inc/footer.php';
	?>