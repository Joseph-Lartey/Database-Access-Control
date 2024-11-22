<?php
include "../action/getuserDetails.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<link rel="stylesheet" href="../css/profile.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon-16x16.png">
    <link rel="manifest" href="../assets/images/site.webmanifest">
	<title>AdminSite</title>

</head>
<body>

	<section id="sidebar">
		<a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i> Lartey Studios</a>
		<ul class="side-menu">
			<li><a href="../admin/admin.php" ><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
			<li><a href="../admin/adminnews.php" ><i class='bx bxs-news icon' ></i> News</a></li>
			<li><a href="../admin/bookings.php"><i class='bx bxs-book icon' ></i> Bookings</a></li>
			<li><a href="../admin/profile.php" class="active"><i class='bx bxs-user icon' ></i> Profile</a></li>
            <li><a href="../admin/users.php"><i class='bx bxs-user-account icon' ></i> Users</a></li>


		</ul>
		<div class="ads">
			<div class="wrapper">
				<a href="../login/logout.php" class="btn-upgrade">Logout</a>
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
			<span class="divider"></span>
			<div class="profile">
            <?php echo getUserProfileImage(); ?>
            <ul class="profile-link">
					<li><a href="#"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
					<li><a href="#"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
				</ul>
			</div>
		</nav>
	
		<main>
			<h1 class="title">News</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Add news</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>

            
      
            
            <div class="outer-profile">

                <div id="profile-page">
                    <div class="profile-info">
                    <div class="profile-image-container">
                        <?php echo getUserProfileImage(); ?>
                    </div>
                
                        <div class="user-details">
                            <?php echo getUserProfileDetails(); ?>

                            <!-- <p><strong>Name:</strong> John Doe</p>
                            <p><strong>Email:</strong> johndoe@example.com</p>
                            <p><strong>Date of Birth:</strong> January 1, 1990</p>
                            <p><strong>Phone Number :</strong> 059977320</p> -->
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button class="Edit" id="Edit">Edit Username</button>
                        <button class="Editemail" id="Editemail">Change Email</button>
                        <button class = "ChangePassword" id="ChangePassword">Change Password</button>
                        <button class="AddImage" id="AddImage">Add Image</button>
                    </div>
                </div>
            </div>

            <div id="editUsernameModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form action="../action/editUsername_action.php" method="POST">
                        <label for="Firstname">Firstname:</label>
                        <input type="text" id="Firstname" name="Firstname">
                        <label for="username">Lastname:</label>
                        <input type="text" id="username" name="username">
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>

            <div id="editEmailModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form action="../action/editEmail_action.php" method="POST">
                        <label for="oldEmail">Old Email:</label>
                        <input type="email" id="oldEmail" name="old_email">
                        <label for="newEmail">New Email:</label>
                        <input type="email" id="newEmail" name="new_email">
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>


            <div id="changePasswordModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form action="../action/ChangePassword_action.php" method="POST">
                        <label for="currentPassword">Current Password:</label>
                        <input type="password" id="currentPassword" name="currentPassword" required>
                        <label for="newPassword">New Password:</label>
                        <input type="password" id="newPassword" name="newPassword" required>
                        <label for="confirmPassword">Confirm Password:</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required>
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>

            <div id="addImageModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form action="../action/Add_image_action.php" method="POST" enctype="multipart/form-data">
                        <label for="image">Choose Image:</label>
                        <input type="file" id="image" name="image">
                        <button type="submit">Upload</button>
                    </form>
                </div>
            </div>

		</main>
	</section>

    <script>
        

        let editUsernameModal = document.getElementById("editUsernameModal");
        let editEmailModal = document.getElementById("editEmailModal");
        let changePasswordModal = document.getElementById("changePasswordModal");
        let addImageModal = document.getElementById("addImageModal");

        let editUsernameBtn = document.getElementById("Edit");
        let editEmailBtn = document.getElementById("Editemail");
        let changePasswordBtn = document.getElementById("ChangePassword");
        let addImageBtn = document.getElementById("AddImage");

        let closeBtns = document.querySelectorAll(".close");

        function openModal(modal) {
            modal.style.display = "block";
        }

        function closeModal(modal) {
            modal.style.display = "none";
        }

        editUsernameBtn.addEventListener("click", () => openModal(editUsernameModal));
        editEmailBtn.addEventListener("click", () => openModal(editEmailModal));
        changePasswordBtn.addEventListener("click", () => openModal(changePasswordModal));
        addImageBtn.addEventListener("click", () => openModal(addImageModal));

        closeBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                closeModal(editUsernameModal);
                closeModal(editEmailModal);
                closeModal(changePasswordModal);
                closeModal(addImageModal);
            });
        });
    </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const urlParams = new URLSearchParams(window.location.search);
                const message = urlParams.get('msg');
                if (message) {
                    Swal.fire("Notice", message, "info");
                }
            });
        </script>

	<!-- Scripts -->
	<script src="../public/js/admin.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

	<script>
		// Static data for the chart
		const xValues = ["User", "Rooms"];
		const yValues = [150, 200];
		const barColors = ["red", "green"];

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
