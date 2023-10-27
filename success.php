<?php
include 'inc/header.php';
?> 

<?php
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
            <div class="section group" style="text-align: center;">
               <h2 style="color: green;">Success Order</h2>
               <?php 
               $customer_id = Session::get('customer_id');
               $get_mount = $ct->get_all_mount($customer_id); 
               if($get_mount){ 
                $amount = 0;
                while($result = $get_mount->fetch_assoc()){
                    $price = $result['price'];
                    $amount += $price;
                }
               }    
               ?>
               <p>Total Price You Have Bought From The Website : 
                <?php
                $vat = $amount * 0.1;
                $total = $vat + $amount;
                echo $total;
                ?> VNĐ</p>
               <p>We will contact as soon as possiable. Please see your order details here <a href="orderdetails.php">Click here</a></p>
            </div>
        </div>
    </div>    
</form>
<?php
include 'inc/footer.php';
?>


