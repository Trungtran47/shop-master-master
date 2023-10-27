<?php
include 'inc/header.php';
?>

<?php
if (isset($_GET['proid']) || $_GET['proid'] != NULL) {
	$id = $_GET['proid'];
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$AddtoCart = $ct->add_to_cart($id, $quantity);
}
?>


<?php
$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compare'])) {
	$productId = $_POST['productId'];
	$insertCompare = $product->insertCompare($productId, $customer_id);
}
?>



<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$product_details = $product->getproduct_details($id);
			if ($product_details) {
				while ($result_details = $product_details->fetch_assoc()) {

			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="">
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result_details['productName'] ?></h2>
							<p><?php echo $fm->textShorten($result_details['product_desc'], 150) ?></p>
							<div class="price">
								<p>Price: <span>$<?php echo $result_details['price'] . " " . "VND" ?></span></p>
								<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
								<p>Brand:<span><?php echo $result_details['brandName'] ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>
								<?php if (isset($AddtoCart)) {
									echo $AddtoCart;
								} ?>
							</div>
							<div class="add-cart">
								<form action="" method="POST">
									<!-- <a href="?wlist=<?php echo $result_details['productId'] ?>" class="buysubmit">Save to Wishlist</a> -->
									<!-- <a href="?compare=<?php echo $result_details['productId'] ?>" class="buysubmit">Compare Product</a> -->
									<input type="hidden" class="buysubmit" name="productId" value="<?php echo $result_details['productId'] ?>" />
									
									<?php
									$login_check = Session::get('customer_login');
									if ($login_check == true) {
										echo '<input type="submit" class="buysubmit" name="compare" value="Compare Product" />';
									} else {
										echo '';
									}
									?> 
									<?php
									if (isset($insertCompare)) {
										echo $insertCompare;
									}
									?>
								</form>
							</div>
						</div>

						<div class="product-desc">
							<h2>Product Details</h2>
							<?php echo $fm->textShorten($result_details['product_desc'], 150) ?>
						</div>

					</div>
			<?php
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<?php
				$get_category = $cat->show_category_fontend();
				if ($get_category) {
					while ($result_cat = $get_category->fetch_assoc()) {
				?>
						<ul>
							<li><a href="productbycat.php?catid=<?php echo $result_cat['catId']; ?>"><?php echo $result_cat['catName']; ?></a></li>
						</ul>
				<?php
					}
				}
				?>
			</div>

		</div>
	</div>
	<?php
	include 'inc/footer.php';
	?>