<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
class product
{
    private $db, $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = 'uploads/' . $unique_image;


        if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" 
        || $price == "" || $type == "" || $file_name == "") {
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, catId, brandId, product_desc, price, type, image) VALUES ('$productName','$category','$brand','$product_desc','$price','$type','$unique_image')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Insert Product Success</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Insert Product Not Success</span>";
                return $alert;
            }
        }
    }

    public function insertSlider($data, $files){
        $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);

        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = 'uploads/' . $unique_image;

        if ($sliderName == "") {
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                // if ($file_size > 20480) {
                //     $alert = '<span class="error">Img Size should be less than 2MB!</span>';
                //     return $alert;
                // } else
                if (in_array($file_ext, $permited) === false) {
                    $alert = '<span class="error">You can upload only:-' . implode('.', $permited) . '</span>';
                    return $alert;
                }
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "INSERT INTO tbl_slider(sliderName, sliderImage) VALUES ('$sliderName','$unique_image')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='success'>Insert Product Success</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Insert Product Not Success</span>";
                    return $alert;
                }
            }
            
        }
    }

    public function show_product()
    {
        $query = "select tbl_product.*,tbl_category.catName,tbl_brand.brandName from tbl_product inner join tbl_category on tbl_product.catId = tbl_category.catId inner join tbl_brand on tbl_product.brandId = tbl_brand.brandId order by productId asc";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_slider(){
        $query = "select * from tbl_slider order by sliderId asc";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_slider_page(){
        $query = "select * from tbl_slider order by sliderId asc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproductbyId($id)
    {
        $query = "select * from tbl_product where productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_slider_by_id($id)
    {
        $query = "select * from tbl_slider where sliderId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $files, $id)
    {

        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);

        $permited = array('jpg', 'png', 'jpeg', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = 'uploads/' . $unique_image;

        if ($productName == "" || $brand == "" || $category == "" || $product_desc == "" || $price == "" || $type == "") {
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                // if ($file_size > 20480) {
                //     $alert = '<span class="error">Img Size should be less than 2MB!</span>';
                //     return $alert;
                // } else
                if (in_array($file_ext, $permited) === false) {
                    $alert = '<span class="error">You can upload only:-' . implode('.', $permited) . '</span>';
                    return $alert;
                }
                move_uploaded_file($file_temp,$uploaded_image);
                $query = "UPDATE tbl_product SET productName='$productName',catId='$category',brandId='$brand',
            product_desc='$product_desc',type='$type',price=' $price' ,image='$unique_image' WHERE productId='$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Update Product Success</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update Product Not Success</span>";
                return $alert;
            }
            } else {
                $query = "UPDATE tbl_product SET productName='$productName',catId='$category',brandId='$brand',
            product_desc='$product_desc',type='$type',price=' $price' WHERE productId='$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Update Product Success</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update Product Not Success</span>";
                return $alert;
            }
            }
            
        }
    }

    public function del_product($id)
    {
        $query = "DELETE FROM tbl_product WHERE productId='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Delete Product Success</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete Product Not Success</span>";
            return $alert;
        }
    }

    public function del_slider($id)
    {
        $query = "DELETE FROM tbl_slider WHERE sliderId='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Delete Slider Success</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Delete Slider Not Success</span>";
            return $alert;
        }
    }

    // End Backend
    public function getproduct_feathered(){
        $query = "select * from tbl_product where type = '0' LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function search_product($tukhoa){
        $tukhoa = $this->fm->validation($tukhoa);
        $query = "SELECT * from tbl_product where productName LIKE '%$tukhoa%'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getproduct_new(){
        if(!isset($_GET['trang'])){
            $trang = 1;
        } else {
            $trang = $_GET['trang'];
        }
        $tung_trang = ($trang - 1) * 4;
        $query = "SELECT * from tbl_product order by productId desc LIMIT $tung_trang,4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getproduct_all(){
        $query = "SELECT * from tbl_product";
        $result = $this->db->select($query);
        return $result;
    }

    public function getproduct_details($id){
        $query = "select tbl_product.*,tbl_category.catName,tbl_brand.brandName from tbl_product inner join tbl_category on tbl_product.catId = tbl_category.catId inner join tbl_brand on tbl_product.brandId = tbl_brand.brandId where tbl_product.productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastestIphone(){
        $query = "select * from tbl_product where brandId = '2' order by productId desc Limit 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastestSamsung(){
        $query = "select * from tbl_product where brandId = '3' order by productId desc Limit 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastestOppo(){
        $query = "select * from tbl_product where brandId = '4' order by productId desc Limit 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function getLastestVivo(){
        $query = "select * from tbl_product where brandId = '8' order by productId desc Limit 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_compare($customer_id){
        $query = "Select * from tbl_compare where customer_id = '$customer_id' order by id desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function insertCompare($productId, $customer_id){
        $productId = $this->fm->validation($productId);
        $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

        $query_compare = "select * from tbl_compare where productId = '$productId' and customer_id = '$customer_id'";
        $check_compare =  $this->db->select($query_compare); 
        if($check_compare){
            $msg = '<span style="color: red;">Product Already Added</span>';
            return $msg;
        } else{

        $query = "SELECT * from tbl_product where productId = '$productId'";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result['image'];
        $productName = $result['productName'];
        $price = $result['price'];
       
            $query_insert = "INSERT INTO tbl_compare(productId, productName, image ,price ,customer_id) VALUES ('$productId','$productName','$image','$price','$customer_id')";
            $insert_compare = $this->db->insert($query_insert);
            if ($insert_compare) {
                $alert = "<span class='success'>Add Compare Success</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Add Compare Not Success</span>";
                return $alert;
            }
        }  
    }
}
?>