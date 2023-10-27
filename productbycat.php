<?php
include 'inc/header.php';
?>

<?php
if (isset($_GET['catid']) || $_GET['catid'] != NULL) {
    $id = $_GET['catid'];
}

?>

<div class="main">
	<div class="content">
		<div class="content_top">
		<?php 
			$get_name_id = $cat->get_name_cat($id);
			if($get_name_id){
				while($result = $get_name_id->fetch_assoc()){
			?>
			<div class="heading">
				<h3>Category : <?php echo $result['catName'] ?></h3>
			</div>
			<?php
			}
		}
			?>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php 
			$get_product_by_id = $cat->get_product_by_cat($id);
			if($get_product_by_id){
				while($result = $get_product_by_id->fetch_assoc()){
			?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
				<h2><?php echo $result['productName'] ?></h2>
				<p><?php echo $fm->textShorten($result['product_desc'],20) ?></p>
				<p><span class="price"><?php echo $result['price'] ?></span></p>
				<div class="button"><span><a href="preview.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
			</div>
			<?php
			}
		} else {
			echo 'Danh muc khong co san pham nao';
		}
			?>
		</div>
	</div>
</div>
<?php
include 'inc/footer.php';
?>