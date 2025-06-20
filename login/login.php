<?php
include('../Includes/login_nav.php');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="../Includes/style.css">

<?php
session_start();

$errors = [
    'login' => $_SESSION['login_error'] ??'',
    'register' => $_SESSION['register_error']??''
];
$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($errors){
    return !empty($errors) ? "<p class='error-message'>$errors</p>" : '';
}

function isActiveForm ($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}
?>


<!-- Display body section. -->
<div class="container-fluid">
	<div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
		<form action="login_register.php" method="post">
			<h2>Login</h2>
			<?= showError($errors['login']); ?>
				<input type="text" name="email" placeholder="Email" required>
				<input type="password" name="pass" placeholder="Password" required>
			<button type="submit" name="login">Login</button>
			<p>Don't have an account? <a href="#" onclick="showForm('register-form')">Register</a></p>
		</form>
	</div>
	<div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
		<form action="login_register.php" method="post">
			<h2>Register</h2>
			<?= showError($errors['register']); ?>
			<input type="text" name="first_name" placeholder="First Name" required>
			<input type="text" name="last_name" placeholder="Last Name" required>
			<input type="text" name="email" placeholder="Email" required>
			<input type="password" name="pass" placeholder="Password" required>
			<select name="role" required>
				<option value="" disabled selected>Select Role</option>
				<option value="user">User</option>
				<option value="admin" disabled>Admin-Please contact us via email</option>
			</select>
			<button type="submit" name="register">Register</button>
			<p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a></p>
		</form>
	</div>
</div>

<script src="../Includes/script.js"></script>



<?php
include('../Includes/footer.php');
?>

