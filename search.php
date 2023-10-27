<?php
include 'inc/header.php';
?>

<!-- <?php
if (isset($_GET['catid']) || $_GET['catid'] != NULL) {
    $id = $_GET['catid'];
}
?> -->

<?php
if ($_SERVER['REQUEST_METHOD']) {
	$tukhoa = $_POST['tukhoa'];
	$search_product = $product->search_product($tukhoa);
}
?>

<div class="main">
	<div class="content">
		<div class="content_top">
		
			<div class="heading">
				<h3>Từ khóa : <?php echo $tukhoa ?></h3>
			</div>

			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php 
			if($search_product){
				while($result = $search_product->fetch_assoc()){
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
			echo 'Khong co san pham nao';
		}
			?>
		</div>
	</div>
</div>
<?php
include 'inc/footer.php';
?>