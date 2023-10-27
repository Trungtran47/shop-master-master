<?php
include 'inc/header.php';
?>

<?php
$customer_id = Session::get('customer_id');
if ($customer_id == false) {
    echo "<script type='text/javascript'>window.location.href = 'login.php'</script>";
}
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insert_order = $ct->insert_order($customer_id);
    $delCart = $ct->del_all_data_cart();
    header('Location:success.php');
}
?>
<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="content_top">
                    <div class="heading">
                        <h3>Offline Payment Method</h3>
                    </div>
                    <div class="clear"></div>
                </div>
                <div style="width: 50%; float: left;">
                    <div class="cartpage">
                        <?php
                        if (isset($update_quantity_cart)) {
                            echo $update_quantity_cart;
                        }
                        ?>
                        <?php
                        if (isset($delcart)) {
                            echo $delcart;
                        }
                        ?>
                        <table class="tblone">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="15%">Product Name</th>
                                <th width="15%">Price</th>
                                <th width="25%">Quantity</th>
                                <th width="20%">Total Price</th>
                            </tr>
                            <tr>

                                <?php
                                $get_product_cart = $ct->get_product_cart();
                                if ($get_product_cart) {
                                    $subtotal = 0;
                                    $qty = 0;
                                    $i = 0;
                                    while ($result = $get_product_cart->fetch_assoc()) {
                                        $i++;

                                ?>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $result['productName'] ?></td>

                                        <td><?php echo $result['price'] ?></td>
                                        <td>
                                            <?php echo $result['quantity'] ?>
                                        </td>
                                        <td>
                                            <?php
                                            $total = $result['price'] * $result['quantity'];
                                            echo $total; ?>
                                        </td>

                            </tr>
                    <?php
                                        $subtotal += $total;
                                        $qty = $qty + $result['quantity'];
                                    }
                                }
                    ?>
                        </table>
                        <?php
                        $check_cart = $ct->get_product_cart();
                        if ($check_cart) {

                        ?>
                            <table style="float:right;text-align:left;" width="40%">
                                <tr>
                                    <th>Sub Total : </th>
                                    <td><?php
                                        echo $subtotal;
                                        Session::set('sum', $subtotal);
                                        Session::set('qty', $qty); ?></td>
                                </tr>
                                <tr>
                                    <th>VAT : </th>
                                    <td>10% (<?php echo $vat = $subtotal * 0.1; ?>)</td>
                                </tr>
                                <tr>
                                    <th>Grand Total :</th>
                                    <td><?php
                                        $vat = $subtotal * 0.1;
                                        $gtotal = $subtotal + $vat;
                                        echo $gtotal; ?></td>
                                </tr>
                            </table>
                        <?php
                        } else {
                            echo 'Your cart is empty ! Please shopping now';
                        } ?>
                    </div>
                </div>
                <div style="width: 50%; float: right;">
                    <div class="cartpage">
                        <table class="tblone">
                            <?php
                            $id = Session::get('customer_id');
                            $get_info_cus = $cus->show_info_cus($id);
                            if ($get_info_cus) {
                                while ($result = $get_info_cus->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td><?php echo $result['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>:</td>
                                        <td><?php echo $result['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>:</td>
                                        <td><?php echo $result['address'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>:</td>
                                        <td><?php echo $result['city'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td>:</td>
                                        <td><?php echo $result['country'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Zipcode</td>
                                        <td>:</td>
                                        <td><?php echo $result['zipcode'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td><?php echo $result['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <center style="margin-top: 20px;"><a href="?orderid=order" style="cursor: pointer; ;background-color: red; color: white; font-size: 25px; font-weight: bold; padding: 10px 30px;">Order Now</a></center>
        </div>
    </div>
</form>

<?php
include 'inc/footer.php';
?>