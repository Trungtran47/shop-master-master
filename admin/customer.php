<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/customer.php');
?>
<?php
if (isset($_GET['customerid']) || $_GET['customerid'] != NULL) {
    $id = $_GET['customerid'];
}
$cs = new customer();
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $catName = $_POST['catName'];

//     $updateCat = $cat->update_category($catName, $id);
// }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Info_Customer</h2>
        <div class="block copyblock">
           
            <?php
            $show_info_cus = $cs->show_info_cus($id);
            if ($show_info_cus) {
                while ($result = $show_info_cus->fetch_assoc()) {


            ?>
                    <form action="" method="post">
                        <table class="form">
                            <tr>
                                <td>Name</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['name'] ?>" name="catName" placeholder="Sửa tên danh mục sản phẩm" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['phone'] ?>" name="catName" placeholder="Sửa tên danh mục sản phẩm" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['city'] ?>" name="catName" placeholder="Sửa tên danh mục sản phẩm" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['country'] ?>" name="catName" placeholder="Sửa tên danh mục sản phẩm" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Zipcode</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['zipcode'] ?>" name="catName" placeholder="Sửa tên danh mục sản phẩm" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>
                                    <input type="text" readonly value="<?php echo $result['email'] ?>" name="catName" placeholder="Sửa tên danh mục sản phẩm" class="medium" />
                                </td>
                            </tr>
                        </table>
                    </form>

            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>