<header>	
	<div class = "container-fluid">
		<nav class="navbar navbar-fixed-top" role="navigation">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>    
			  <a class="navbar-brand" href="index.php"><img src=images/logo.png alt="logo">
			  </a>
			</div>
			<div class="navbar-collapse collapse">
			  <ul class="nav navbar-nav navbar-left">
				  <li class="active"><a href="index.php">Home</a></li>
					<li><a href="edit-account-details.php">My Account</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Orders <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="order.php">Place Order</a></li>
							<li><a href="#">Tracking</a></li>
							<li><a href="#">History</a></li>
						</ul>
					</li>
					<?php
					//Verify User Permission to View Special Navigation Items
					require_once 'php/permissions.php';

					if(isset($_SESSION['role']))
					{
						//Check Permission to Create Staff Account
						if(checkPermission($_SESSION['role'], 'create-staff-account.php') === true)
						{
							echo '
								<li><a href="create-staff-account.php">Create Staff Account</a></li>
							';
						}
						//Check Permission to place Phone Order
						if(checkPermission($_SESSION['role'], 'phone-order.php') === true)
						{
							echo '
								<li><a href="phone-order.php">Phone Order</a></li>
							';
						}
						//Check Permission to View Order
						if(checkPermission($_SESSION['role'], 'view-order.php') === true)
						{
							echo '
								<li><a href="view-order.php">View Order</a></li>
							';
							}
						}
					?>
			  </ul>
			  <ul class="nav navbar-right">
				<?php
				if (isset($_SESSION['login']))   {

					echo '
						<li><a href="php/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						<li><a href="edit-account-details.php">Hello ', $_SESSION['firstname'], '!</a></li>
					';
				} else {
					echo '
						<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
						<li><a href="create-account.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
					';
				}
				?>
			</ul>
			</div>
		</nav>
	</div>
</header>
