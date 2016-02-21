<?php
include 'core/init.php'; 
logged_in_redirect();
include 'includes/overall/header.php'; 

if(empty($_POST)===false){
    $required_fields = array('username', 'password', 'password_again', 'first_name', 'email');
    foreach($_POST as $key=>$value){
	if(empty($value) && in_array($key, $required_fields) === true){
	    $errors[] = "Fields marked with * are important!!!";
	    break 1;
	}
    }

    if(empty($errors)===true){
	if(user_exists($_POST['username'])===true){
	    $errors[] = "Sorry, the username '".$_POST['username']."' is already taken!";
	}
	if(preg_match("/\\s/", $_POST['username'])==true){
	    $errors[] = "Your username must not contain spaces";
	}
	if(strlen($_POST['password'])<6){
	    $errors[] = "Your password must be atleast 6 characters!";
	}
	if($_POST['password']!==$_POST['password_again']){
	    $errors[] = "The passwords do not match!";
	}
	if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)===false){
	    $errors[] = "Invalid E-mail address!";
	}
	if(email_exists($_POST['email']) === true){
	    $errors[] = "The email '".$_POST['email']."' is already in use.";
	}
    }
}

?>
    
<h1>Register</h1>

<?php
if(isset($_GET['success']) && empty($_GET['success'])){
    echo "Welcome aboard! Please check and confirm yout e-mail.";
}else{
    if(empty($_POST)===false && empty($errors)===true){
	$register_data = array(
	    'username' => $_POST['username'],
	    'password' => $_POST['password'],
	    'first_name' => $_POST['first_name'],
	    'last_name' => $_POST['last_name'],
	    'email' => $_POST['email']
	);
	register_user($register_data);
	header('Location: register.php?success');
        exit();
    }
    else if(empty($errors)===false){
        echo output_errors($errors);
    }

?>

	<form action="" method="POST">
		<ul>
		    <li>
			Username*:<br> <input type="text" name="username">
		    </li>
		    <li>
			Password*:<br> <input type="password" name="password">
		    </li>
		    <li>
			Password again*:<br> <input type="password" name="password_again">
		    </li>
		    <li>
			First Name*:<br> <input type="text" name="first_name">
		    </li>
		    <li>
			Last Name:<br> <input type="text" name="last_name">
		    </li>
		    <li>
			E-mail*:<br> <input type="text" name="email">
		    </li>
		    <li>
			<input type="submit" value="Register">
		    </li>
		</ul>
	</form>

        
<?php
} 
include 'includes/overall/footer.php'; 
?>
