<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/profile.css">

	<title>Profile</title>

</head>
<body>

	<section id="sidebar">
		<a href="../admin/admin.php" class="brand"><i class='bx bxs-smile icon'></i> QuickShop</a>
		<ul class="side-menu">
			<li><a href="../views/shop.php"><i class='bx bxs-store icon'></i> Shop</a></li>
			<li><a href="../views/cart.php"><i class='bx bxs-cart icon'></i> Cart</a></li>
			<li><a href="../views/profile.php" class="active"><i class='bx bxs-user icon'></i> Profile</a></li>
			<li><a href="../views/history.php" ><i class='bx bx-history icon'></i> History</a></li>
		</ul>
		<div class="ads">
			<div class="wrapper">
				<a href="../login/logout.php" class="btn-upgrade">Logout</a>
			</div>
		</div>
	</section>

	<section id="content">
        <nav>
			<i class='bx bx-menu toggle-sidebar'></i>
			<form action="#">
				<div class="form-group">
					<input type="text" placeholder="Search products...">
					<i class='bx bx-search icon'></i>
				</div>
			</form>
			<div class="nav-right">
				<img src="../path-to-your-image/image.png" alt="Profile Picture" class="profile-pic">
			</div>
		</nav>
	
		<main>
			<h1 class="title">Profile</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Add news</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>

			<div class="outer-profile">
                <div id="profile-page">
                    <div class="profile-info">
                        <div class="profile-image-container">
                            <img src="../images/12.jpg" alt="Profile Picture" class="profile-image">
                        </div>
                        <div class="user-details">
                            <p><strong>Name:</strong> John Doe</p>
                            <p><strong>Email:</strong> johndoe@example.com</p>
                            <p><strong>Date of Birth:</strong> January 1, 1990</p>
                            <p><strong>Phone Number:</strong> 059977320</p>
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button class="Edit" id="Edit">Edit Username</button>
                        <button class="Editemail" id="Editemail">Change Email</button>
                        <button class="ChangePassword" id="ChangePassword">Change Password</button>
                        <button class="AddImage" id="AddImage">Add Image</button>
                    </div>
                </div>
            </div>

            <!-- Modals -->
            <div id="editUsernameModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form action="#">
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
                    <form action="#">
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
                    <form action="#">
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
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <label for="image">Choose Image:</label>
                        <input type="file" id="image" name="image">
                        <button type="submit">Upload</button>
                    </form>
                </div>
            </div>

		</main>
	</section>

    <!-- Scripts -->
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

        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('msg');
            if (message) {
                Swal.fire("Notice", message, "info");
            }
        });
    </script>

	<script src="../public/js/admin.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</body>
</html>
