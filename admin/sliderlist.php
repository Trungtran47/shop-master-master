<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php
$pd = new product();
if (isset($_GET['sliderid'])) {
	$id = $_GET['sliderid'];
	$del_sl = $pd->del_slider($id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
		<?php
			if (isset($del_sl)) {
				echo $del_sl;
			}
			?> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$sllist = $pd-> show_slider();
				if($sllist){
					
					while($result = $sllist -> fetch_assoc()){
						
				?>
				<tr class="odd gradeX">
					<td><?php echo $result['sliderName']; ?></td>
					<td><img src="uploads/<?php echo $result['sliderImage'] ?>" height="40px" width="60px"/></td>

				<td>
					<a onclick="return confirm('Are you sure to Delete!');" href="?sliderid=<?php echo $result['sliderId']?>">Delete</a> 
				</td>
					</tr>
					<?php
					}
					}
					?>	
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
