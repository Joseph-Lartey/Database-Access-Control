
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="../css/dashboard.css">
	<title>Dashboard</title>

</head>
<body>

	<section id="sidebar">
		<a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
		<ul class="side-menu">
			<li><a href="../admin/dashboard.php" class="active"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li><a href="../admin/shop.php"><i class='bx bxs-store icon' ></i> Shop</a></li>
			<li><a href="../admin/profile.php"><i class='bx bxs-user icon' ></i> Profile</a></li>
			<li><a href="../admin/role.php"><i class='bx bx-history icon' ></i>Roles</a></li>
			<li><a href="../admin/orders.php"><i class='bx bx-store icon' ></i>Orders</a></li>
		</ul>
		<div class="ads">
			<div class="wrapper">
				<a href="../views/logout.php" class="btn-upgrade">Logout</a>
			</div>
		</div>
	</section>

	<section id="content">

		<nav>
			<i class='bx bx-menu toggle-sidebar' ></i>
			<form action="#">
				<div class="form-group">
					<input type="text" placeholder="Search...">
					<i class='bx bx-search icon' ></i>
				</div>
			</form>
			<a href="#" class="nav-link">
				<i class='bx bxs-bell icon' ></i>
				<span class="badge">5</span>
			</a>
			<a href="#" class="nav-link">
				<i class='bx bxs-message-square-dots icon' ></i>
				<span class="badge">8</span>
			</a>
			<div class="nav-right">
				<img src="../images/12.jpg" alt="Profile Picture" class="profile-pic">
			</div>
			

		</nav>
	
		<main>
			<h1 class="title">Dashboard</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>
			<div class="info-data">
				<div class="card">
					<div class="head">
						<div>
							<p>News Articles</p>
						</div>
						<i class='bx bx-user icon' ></i>
					</div>
					<span class="progress" data-value="40%"></span>
					<span class="label">40%</span>
				</div>
				<div class="card">
					<div class="head">
						<div>
							<p>Bookings</p>
						</div>
						<i class='bx bx-home icon' ></i>
					</div>
					<span class="progress" data-value="60%"></span>
					<span class="label">60%</span>
				</div>
			</div>
			
			<div class="data">
				<div class="content-data">
					<div class="head">
						<h3>Stats</h3>
					</div>
					<div class="chart">
						<canvas id="myChart" style="width:100%;max-width:700px"></canvas>
					</div>
				</div>

				<div class="content-data">

				</div>

				
			</div>
		</main>
	</section>

	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

	<script>
		// PHP variables passed to JavaScript
		const totalNews = <?php echo $totalNews; ?>;
		const totalBookings = <?php echo $totalBookings; ?>;

		// Data for the chart
		const xValues = ["News Articles", "Bookings"];
		const yValues = [totalNews, totalBookings];
		const barColors = ["#ff6384", "#36a2eb"];

		new Chart("myChart", {
			type: "bar",
			data: {
				labels: xValues,
				datasets: [{
					backgroundColor: barColors,
					data: yValues
				}]
			},
			options: {
				legend: {display: false},
				title: {
					display: true,
					text: "Statistics Overview"
				}
			}
		});
	</script>

</body>
</html>
