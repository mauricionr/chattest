<?php
    ob_start();
    
    include "php/credentials.php";

    mysql_connect("localhost", $credentials["login"]["id"],
            $credentials["login"]["pass"]) or die(mysql_error());
    mysql_select_db("chattest_users") or die(mysql_error());

    if(isset($_COOKIE['ID_my_site'])) {
        $username = $_COOKIE['ID_my_site']; 
        $pass = $_COOKIE['Key_my_site'];
        $check = mysql_query("SELECT * FROM all_users WHERE " .
            "name = '$username'")or die(mysql_error());

        while($info = mysql_fetch_array( $check )) {
            if ($pass == $info['pass']) {
                header("Location: php/chattest_app.php");
                die();
            }
        }
    }
else {
?>

<!DOCTYPE html>

<div>
	<h2>Chattest</h2>
	<h5>Mirror, mirror on the wall, who is the Chattest one of all?</h5>
	<h4>
            Enter your chat name or <a href="php/signup.php">create an account</a>!
	</h4>
</div>
<form class="in-block" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
	<table border="0">
		<tr>
			<td>Username:</td><td>
			<input type="text" name="username" maxlength="40">
			</td>
		</tr>
		<tr>
			<td>Password:</td><td> 
			<input type="password" name="pass" maxlength="50"> 
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right"> 
			<input type="submit" name="submit" value="Chat"></td>
		</tr>
	</table>
</form>
<?php 
    }

    if (isset($_POST['submit'])) {
        if(!$_POST['username']) {
            die('Please enter your username.');
        }
        if(!$_POST['pass']) {
            die('Please enter your password.');
        }
        if (!get_magic_quotes_gpc()) {
            $_POST['email'] = addslashes($_POST['email']);
        }

        $check = mysql_query("SELECT * FROM all_users WHERE " . 
            "name = '".$_POST['username']."'") or die(mysql_error());
        $check2 = mysql_num_rows($check);

        if ($check2 == 0) {
            die('Sorry, user <strong>' . $_POST['username'] .
                '</strong> does not exist.');
        }

        while($info = mysql_fetch_array($check)) {
            $_POST['pass'] = stripslashes($_POST['pass']);
            $info['pass'] = stripslashes($info['pass']);
            $_POST['pass'] = md5($_POST['pass']);

            if ($_POST['pass'] != $info['pass']) {
                die('Incorrect password for user <strong>' .
                    $_POST['username'] . '</strong>.');
            }
            else {
                $_POST['username'] = stripslashes($_POST['username']);
                $hour = time() + 3600;
                setcookie(ID_my_site, $_POST['username'], $hour, '/');
                setcookie(Key_my_site, $_POST['pass'], $hour, '/');
                header("Location: php/chattest_app.php");
                die();
            }
        }
    }
?>