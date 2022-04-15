<?php include 'include/header.php' ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = $fm->validation($_POST['name']);
	$email = $fm->validation($_POST['email']);
	$body = $fm->validation($_POST['body']);

	$name = mysqli_real_escape_string($db->link, $name);
	$email = mysqli_real_escape_string($db->link, $email);
	$body = mysqli_real_escape_string($db->link, $body);

	$error = "";
	if (empty($name)) {
		$error = "Name must not be empty!";
	} elseif (empty($email)) {
		$error = "Email field must not be empty!";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error = "Invalid Email Address!";
	} elseif (empty($body)) {
		$error = "Message field must not be empty!";
	} else {
		$query         = "INSERT INTO tbl_contact (name, email, body) VALUES ('$name', '$email', '$body')";
		$inserted_rows = $db->insert($query);
		if ($inserted_rows) {
			$msg = "Message send succcessfully.";
		} else {
			$error = "Message not sent!";
		}
	}
}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<h2>Contact us</h2>
			<?php
			if (isset($error)) {
				echo "<span style='color:red'>$error</span>";
			}
			if (isset($msg)) {
				echo "<span style='color:green'>$msg</span>";
			}
			?>
			<form action="" method="post">
				<table>
					<tr>
						<td>Your Name:</td>
						<td>
							<input type="text" name="name" placeholder="Enter name" required="1" />
						</td>
					</tr>
					<tr>
						<td>Your Email Address:</td>
						<td>
							<input type="email" name="email" placeholder="Enter Email Address" required="1" />
						</td>
					</tr>
					<tr>
						<td>Your Message:</td>
						<td>
							<textarea name="body"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="Send" />
						</td>
					</tr>
				</table>
				<form>
		</div>
	</div>

	<?php include 'include/sidebar.php'; ?>
	<?php include 'include/footer.php'; ?>