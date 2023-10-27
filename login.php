<?php
include 'inc/header.php';
?>
<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){

		$insertCustomer = $cus -> insert_customer($_POST);
	}
?>

<?php
    $login_check = Session::get('customer_login');
    if($login_check){
        header('Location:order.php');
    }
?> 

<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){

		$loginCustomer = $cus -> login_customer($_POST);
	}
?>

<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Existing Customers</h3>
			<?php
			if(isset($loginCustomer)){
				echo $loginCustomer;
			}
			?>
			<p>Sign in with the form below.</p>
			<form action="" method="POST">
				<input type="text" name="email" class="field" placeholder="Email">
				<input type="password" name="password" class="field" placeholder="Password">
			
			<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
			<div class="buttons">
				<div><input type="submit" name="login" value="Sign In"></div>
			</div>
			</form>
		</div>
		<div class="register_account">
			<h3>Register New Account</h3>
			<?php
			if(isset($insertCustomer)){
				echo $insertCustomer;
			}
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" placeholder="Name" name="name" >
								</div>

								<div>
									<input type="text" placeholder="City" name="city">
								</div>

								<div>
									<input type="text" placeholder="Zip-Code" name="zipcode">
								</div>
								<div>
									<input type="text" placeholder="E-Mail" name="email" >
								</div>
							</td>
							<td>
								<div>
									<input type="text" placeholder="Address" name="address" >
								</div>
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">Select a Country</option>
										<option value="HCM">VietNam</option>
										<option value="HN">Russia</option>
										<option value="ĐN">USA</option>
									</select>
								</div>

								<div>
									<input type="text" placeholder="Phone" name="phone">
								</div>

								<div>
									<input type="text" placeholder="Password" name="password">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="search">
					<div><input type="submit" name="submit" value="Create Account"></div>
				</div>
				<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php
include 'inc/footer.php';
?>