<?php
include 'core/init.php';
logged_in_redirect();

if(empty($_POST) === false){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(empty($username) === true || empty($password) === true){
        $errors[] = 'You need to enter a username and password.';
    }else if(user_exists($username) === false){
        $errors[] = 'We cant find that username. Have you registered?';
    }else if(user_active($username) === false){
        $errors[] = 'You have not activated your account!';
    }else{

	if(strlen($password)>32){
	    $errors[] = "Password too long!";
	}

        $login = login($username, $password);
        if($login === false){
            $errors[] = 'That username/password is incorrect.';
        }else{
            $_SESSION['user_id'] = $login;
            header('location: index.php');
            exit();
        }
    }

}else{
    $errors[] = "No Data Received";
}

include 'includes/overall/header.php';
echo output_errors($errors);
include 'includes/overall/footer.php';
?>

