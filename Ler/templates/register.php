<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//TODO making it dynamically load boostrap if we're not using the routing sample
if (!isset($container)) {
    require(__DIR__ . "/../bootstrap.php");
}

if(	   isset($_POST['email']) 
	&& isset($_POST['password'])
	&& isset($_POST['confirm'])
	&& isset($_POST['username'])
	){
	$pass = $_POST['password'];
	$confirm = $_POST['confirm'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	//details are validated in the class method of register
	$users = $container->getUsers();
	Utils::flash(($users->register($username, $email, $pass, $confirm)['message']));
}
?>
<form name="regform" id="myForm" method="POST"
      onsubmit="return verifyPasswords(this)">
    <label for="user">Username: </label>
    <input type="text" id="user" name="username" placeholder="Enter Username"/>
    <label for="email">Email: </label>
    <input type="email" id="email" name="email" placeholder="Enter Email"/>
    <label for="pass">Password: </label>
    <input type="password" id="pass" name="password" placeholder="Enter password"/>
    <label for="conf">Confirm Password: </label>
    <input type="password" id="conf" name="confirm"/>
    <input type="submit" value="Register"/>
</form>
<script>
function verifyPasswords(form){
    if(form.password.value.length == 0 || form.confirm.value.length == 0){
        alert("You must enter both a password and confirmation password");
        return false;
    }
    if(form.password.value != form.confirm.value){
        alert("Uhh you made a typo");
        return false;
    }
    return true;
}
findFormsOnLoad();
</script>
