<body>

<?php
include('../includes/login_nav.php');
?>


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
				<input type="pass" name="pass" placeholder="Password" required>
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
			<input type="pass" name="pass" placeholder="Password" required>
			<select name="role" required>
				<option value="" disabled selected>Select Role</option>
				<option value="user">User</option>
				<option value="admin">Admin</option>
			</select>
			<button type="submit" name="register">Register</button>
			<p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a></p>
		</form>
	</div>
</div>

<script src="script.js"></script>
</body>