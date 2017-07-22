<?php $title = 'Register'; require_once('templates-part/head.php');?>
<?php require_once('templates-part/header.php');?>
<?php include('inc/lib.php');?>
<?php require_once('templates-part/menu.php');?>
<?php require_once('templates-part/slider-a.php');?>
<div id="content">
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Bat dau xu ly form
            $errors = array();
            // Mac dinh cho cac truong nhap lieu la FALSE
            $fn = $ln = $e = $p = FALSE;
            
            if(preg_match('/^[\w\'.-]{2,20}$/i', trim($_POST['first_name']))) {
                $fn = mysqli_real_escape_string($conn, trim($_POST['first_name']));
            } else {
                $errors[] = 'first name';
            }
            
            if(preg_match('/^[\w\'.-]{2,20}$/i', trim($_POST['last_name']))) {
                $ln = mysqli_real_escape_string($conn, trim($_POST['last_name']));
            } else {
                $errors[] = 'last name';
            }
            
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $e = mysqli_real_escape_string($conn, $_POST['email']);
            } else {
                $errors[] = 'email';
            }

             if(filter_var($_POST['level'], FILTER_VALIDATE_INT)) {
                $lv = mysqli_real_escape_string($conn, $_POST['level']);
            } else {
                $errors[] = 'level';
            }
            
            if(preg_match('/^[\w\'.-]{4,20}$/', trim($_POST['password1']))) {
                if($_POST['password1'] == $_POST['password2']) {
                    // Neu mat khau mot phu hop voi mat khau hai, thi luu vao csdl
                    $p = mysqli_real_escape_string($conn, trim($_POST['password1']));
                } else {
                    // Neu mat khau khong phu hop voi nhau
                    $errors[] = "password not match";
                }
            } else {
                $errors[] = 'password';
            }

            
            if($fn && $ln && $e && $p && $lv) {
                // Neu moi thu deu day du, truy van csdl
                $q = "SELECT user_id FROM users WHERE email = '{$e}'";
                $r = mysqli_query($conn, $q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn)); 
                if(mysqli_num_rows($r) == 0) {
                    // Luc nay email van con trong, cho phep nguoi dung dang ky
                    
                    // Tao ra mot chuoi Activation Key, ra key random
                    $a = md5(uniqid(rand(), true));
                    
                    // Chen gia tri vao CSDL
                    $q = "INSERT INTO users (first_name, last_name, email, pass, user_level, active, registration_date)
                        VALUES ('{$fn}', '{$ln}', '{$e}', SHA1('$p'),'{$lv}', '{$a}', NOW())";
                    $r = mysqli_query($conn, $q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn)); 
                    
                    if(mysqli_affected_rows($conn) == 1) {
                        // Neu dien thong tin thanh cong, thi gui email kich hoat cho nguoi dung
                        echo "Ban dang ki thanh cong";
                    } else {
                        $message = "<p class='warning'>Sorry, your order could not be processed due to a system error.</p>";
                    }
                    
                } else {
                    // Email da ton tai, phai dang ky bang email khac.
                    $message = "<p class='warning'>The email was already used previously. Please use another email address.</p>";
                }
            } else {
                // Neu mot trong cac truong bi thieu gia tri
                $message = "<p class='warning'>Please fill in all the required fields.</p>";
            }
        }// END main IF
    ?>
    
    <h2>Register</h2>
    <?php if(!empty($message)) echo $message; ?>
    <form action="register.php" method="post">
        <fieldset>
            <legend>Register</legend>
                <div>
                    <label for="First Name">First Name <span class="required">*</span>
                        <?php if(isset($errors) && in_array('first name', $errors)) echo "<span class='warning'>Please enter your first name</span>"; ?>
                    </label> 
                   <input type="text" name="first_name" size="20" maxlength="20" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>" tabindex='1' />
                </div>
                
                <div>
                    <label for="Last Name">Last Name <span class="required">*</span>
                    <?php if(isset($errors) && in_array('last name', $errors)) echo "<span class='warning'>Please enter your last name</span>"; ?>
                    </label> 
                   <input type="text" name="last_name" size="20" maxlength="40" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>" tabindex='2' />
                </div>
                
                <div>
                    <label for="email">Email <span class="required">*</span>
                    <?php if(isset($errors) && in_array('email', $errors)) echo "<span class='warning'>Please enter your valid email</span>"; ?>
                    </label> 
                   <input type="text" name="email" id="email" size="20" maxlength="80" value="<?php if(isset($_POST['email'])) echo htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8'); ?>" tabindex='3' />
                    <span id="available"></span>
                </div>
                
                <div>
                    <label for="password">Password <span class="required">*</span>
                    <?php if(isset($errors) && in_array('password', $errors)) echo "<span class='warning'>Please enter your password</span>"; ?>
                    </label> 
                   <input type="password" name="password1" size="20" maxlength="20" value="<?php if(isset($_POST['password1'])) echo $_POST['password1']; ?>" tabindex='4' />
                </div>
                
                <div>
                    <label for="email">Confirm Password <span class="required">*</span> 
                    <?php if(isset($errors) && in_array('password not match', $errors)) echo "<span class='warning'>Your confirmed password does not match.</span>"; ?>
                    </label> 
                   <input type="password" name="password2" size="20" maxlength="20" value="<?php if(isset($_POST['password12'])) echo $_POST['password2']; ?>" tabindex='5' />
                </div>

                 <div>
                    <label for="level">User Level <span class="required">*</span> 
                    <?php if(isset($errors) && in_array('Level errors', $errors)) echo "<span class='warning'>Level Errors.</span>"; ?>
                    </label> 
                   <input type="text" name="level" size="20" maxlength="20" value="<?php if(isset($_POST['level'])) echo $_POST['level']; ?>" tabindex='6' />
                </div>
        </fieldset>
        <p><input type="submit" name="submit" value="Register" /></p>
    </form>
</div><!--end content-->
<?php require_once('templates-part/slider-b.php');?>
<?php require_once('templates-part/footer.php');?>