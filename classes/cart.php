<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class cart
{
    private $db, $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_to_cart($id, $quantity)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sId= session_id();

        $query = "select * from tbl_product where productId = '$id'";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result['image'];
        $productName = $result['productName'];
        $price = $result['price'];

        $query_cart = "select * from tbl_cart where productId = '$id' and sId = '$sId'";
        $check_cart =  $this->db->select($query_cart); 
        if($check_cart){
            $msg = '<span style="color: red;">Product Already Added</span>';
            return $msg;
        } else{
            $query_insert = "INSERT INTO tbl_cart(productId, sId, productName, quantity, image ,price) VALUES ('$id','$sId','$productName','$quantity','$image','$price')";
            $insert_cart = $this->db->insert($query_insert);
            if ($result) {
                header('Location:cart.php');
            }
        } 
    }
    public function get_product_cart(){
        $sId = session_id();
        $query = "select * from tbl_cart where sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function check_order($customer_id){
        $query = "select * from tbl_order where customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_quantity_cart($cartId, $quantity){
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "UPDATE tbl_cart SET quantity='$quantity' WHERE cartId='$cartId'";
        $result = $this->db->update($query);
        if($result){
            header('Location:cart.php');
        } else {
            $msg = '<span style="color: red;">Product Quantity Update Not Successfully</span>';
            return $msg;
        }
    }
    public function del_product_cart($cartId){
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "DELETE FROM tbl_cart WHERE cartId ='$cartId'";
        $result = $this->db->delete($query);
    }

    public function del_all_data_cart(){
        $sId = session_id();
        $query = "delete from tbl_cart where sId = '$sId'";
        $result = $this->db->delete($query);
        return $result;
    }
    public function del_all_data_compare($customer_id){
        $query = "delete from tbl_compare where customer_id = '$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }
    public function insert_order($customer_id){
        $sId = session_id();
        $query = "select * from tbl_cart where sId = '$sId'";
        $get_product = $this->db->select($query);
        if($get_product){
            while($result = $get_product->fetch_assoc()){
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'] * $quantity;
                $image = $result['image'];
                $customer_id = $customer_id;
                $query_order = "INSERT INTO tbl_order(productId, productName, quantity, image ,price ,customer_id) VALUES ('$productId','$productName','$quantity','$image','$price','$customer_id')";
                $insert_order = $this->db->insert($query_order);
            }
        }
    }
    public function get_all_mount($customer_id){
        $query = "SELECT price from tbl_order where customer_id = '$customer_id'";
        $get_price =  $this->db->select($query);
        return $get_price;
    }
    public function get_cart_ordered($customer_id){
        $query = "SELECT * from tbl_order where customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_inbox_cart(){
        $query = "SELECT * from tbl_order order by date_order";
        $result = $this->db->select($query);
        return $result;
    }
    public function shifted($id,$time,$price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET status='1' WHERE id='$id' and date_order='$time' and price='$price'";
        $result = $this->db->update($query);
        if($result){
            $msg = '<span style="color: red;">Update Successfully</span>';
            return $msg;
        } else {
            $msg = '<span style="color: red;">Update Not Successfully</span>';
            return $msg;
        }
    }
    public function del_shifted($id,$time,$price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "DELETE from tbl_order WHERE id='$id' and date_order='$time' and price='$price'";
        $result = $this->db->delete($query);
        if($result){
            $msg = '<span style="color: red;">Delete Successfully</span>';
            return $msg;
        } else {
            $msg = '<span style="color: red;">Delete Not Successfully</span>';
            return $msg;
        }
    }
    public function shifted_confirm($id,$time,$price){
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET status='2' WHERE customer_id='$id' and date_order='$time' and price='$price'";
        $result = $this->db->update($query);
        if($result){
            $msg = '<span style="color: red;">Chance Successfully</span>';
            return $msg;
        } else {
            $msg = '<span style="color: red;">Chance Not Successfully</span>';
            return $msg;
        }
    }
}
?>