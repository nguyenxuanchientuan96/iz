
<?php $title = 'Login'; require_once('templates-part/head.php');?>
<?php require_once('templates-part/header.php');?>
<?php include('inc/lib.php');?>
<?php require_once('templates-part/menu.php');?>
<?php require_once('templates-part/slider-a.php');?>
<?php
	 if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Bat dau xu ly form. Tao bien $errors
        $errors = array();
        
        // Validate email
        if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $e = mysqli_real_escape_string($conn, $_POST['email']); 
        } else {
            $errors[] = 'email';
        }
        
        // Validate password
        if(isset($_POST['password']) && preg_match('/^[\w]{4,20}$/', $_POST['password'])) {
            $p = mysqli_real_escape_string($conn, $_POST['password']);
        } else {
            $errors[] = 'password';
        }
        if(empty($errors)) {
            // Bat dau truy van CSDL de lay thong tin nguoi dung
            $q = "SELECT * FROM users WHERE (email = '{$e}' AND pass = SHA1('$p')) LIMIT 1";
            $r = mysqli_query($conn, $q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn)); 
            if(mysqli_num_rows($r) == 1) {
                
                // Neu tim thay thong tin nguoi dung trong CSDL, se chuyen huong nguoi dung ve trang thich hop.
                list($user_id, $first_name, $user_level) = mysqli_fetch_array($r, MYSQLI_NUM);
              
                $_SESSION['user_id'] = $user_id;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['user_level'] = $user_level;
                
                                
               redirect_to('admin/view_pages.php');
           		
            } else {
                $message = "<p class='error'>The email or password do not match those on file. Or you have not activated your account.</p>";
            }
        } else {
            $message = "<p class='erorr'>Please fill in all the required fields.</p>";
        }
    }
    //  end if main
?>
<div id="content">
	<h2>Login</h2>
   <?php if(!empty($message)) echo $message; ?>
    <form id="login" action="" method="post">
        <fieldset>
        	<legend>Login</legend>
            	<div>
                    <label for="email">Email:
                        <?php if(isset($errors) && in_array('email',$errors)) echo "<span class='warning'>Please enter your email.</span>";?>
                    </label>
                    <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) {echo htmlentities($_POST['email']);} ?>" size="20" maxlength="80" tabindex="1" />
                </div>
                <div>
                    <label for="pass">Password:
                        <?php if(isset($errors) && in_array('password',$errors)) echo "<span class='warning'>Please enter your password.</span>";?>
                    </label>
             <input type="password" name="password" id="pass" value="" size="20" maxlength="20" tabindex="2" />
                </div>
        </fieldset>
        <div><input type="submit" name="submit" value="Login" /></div>
    </form>
    <p><a href="retrieve_password.php">Forgot password?</a></p>


</div> <!-- content -->
<?php require_once('templates-part/slider-b.php');?>
<?php require_once('templates-part/footer.php');?>
