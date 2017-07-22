<?php require_once("templates-part/head.php");  ?>
<?php $title = 'Contact Us'; require_once('templates-part/header.php');?>
<?php require_once('inc/lib.php');?>
<?php require_once("templates-part/menu.php");  ?>
<?php require_once("templates-part/slider-a.php");  ?>
<div id="content">
    <?php 
        // Xu ly form
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Tao bien de bao loi neu co
            $errors = array();
            
            // Chong spam cho contact form
            $clean = array_map('clean_email', $_POST);
            // Kiem tra truong nhap ten
            if(empty($clean['name'])) {
                $errors[] = 'name';
            }
            
            // Kiem tra xem email co hop le
            if(!preg_match('/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/', $clean['email'])) {
                $errors[] = 'email';
            }
            
            // Kiem tra noi dung tin nhan
            if(empty($clean['comment'])) {
                $errors[] = 'comment';
            }
            
                // Validate captcha question
            if(isset($_POST['captcha']) && trim($_POST['captcha']) != $_SESSION['q']['answer']) {
                $errors[] = "wrong";
            }
            
            // HOney Pot trap
            if(!empty($_POST['url'])) {
                redirect_to('thankyou.html');
            }
            
            // KIem tra xem co loi o form hay khong, neu khong co, gui email
            if(empty($errors)) {
                $body = "Name: {$clean['name']} \n\n Comment:\n ". strip_tags($clean['comment']);
                $body = wordwrap($body, 70);
                 if(mail('chientuan084@gmail.com', 'Contact form submission', $body, 'FROM: localhost@localhost')) { 
                    echo "<p class='success'>Thank you for contacting me. I will get back to you ASAP</p>";
                    $_POST = array();
                }else {
                    echo "<p class='warning'>Sorry, your email could not be sent.</p>";
                }
                
            } else {
                // Neu co loi trong bien errors, do nguoi dung quen nhap vao truong
                echo "<p class='warning'>Please fill out all the required fields.</p>";
            }
        } // END Main submit if
    ?>
    
<form id="contact" action="" method="post">
    <fieldset>
    	<legend>Contact</legend>
            <div>
                <label for="Name">Your Name: <span class="required">*</span>
                    <?php if(isset($errors) && in_array('name',$errors)) { echo "<span class='warning'>Please enter your name.</span>";}?>
                </label>
                <input type="text" name="name" id="name" value="<?php if(isset($_POST['name'])) {echo htmlentities($_POST['name'], ENT_COMPAT, 'UTF-8');} ?>" size="20" maxlength="80" tabindex="1" />
            </div>
        	<div>
                <label for="email">Email: <span class="required">*</span>
                <?php if(isset($errors) && in_array('email',$errors)) {echo "<span class='warning'>Please enter your email.</span>";} ?>
                </label>
                <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) {echo htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8');} ?>" size="20" maxlength="80" tabindex="2" />
            </div>
            <div>
                <label for="comment">Your Message: <span class="required">*</span>
                    <?php if(isset($errors) && in_array('comment',$errors)) {echo "<span class='warning'>Please enter your message.</span>";} ?>
                </label>
                <div id="comment"><textarea name="comment" rows="10" cols="45" tabindex="3"><?php if(isset($_POST['comment'])) {echo htmlentities($_POST['comment'], ENT_COMPAT, 'UTF-8');} ?></textarea></div>
            </div>
            
            <div>
            <label for="captcha">Phiền bạn điền vào giá trị số cho câu hỏi sau: <?php echo captcha(); ?><span class="required">*</span>
                <?php if(isset($errors) && in_array('wrong',$errors)) {echo "<span class='warning'>Please give a correct answer.</span>";}?></label>
                <input type="text" name="captcha" id="captcha" value="" size="20" maxlength="5" tabindex="4" />
            </div>
        
            <div class='website'>
            <label for="website"> Nếu bạn nhìn thấy trường này, thì ĐỪNG điền gì vào hết</label>
            <input type="text" name="url" id="url" value="" size="20" maxlength="20" />
        </div>
    </fieldset>
    <div><input type="submit" name="submit" value="Send Email" tabindex="3" /></div>
</form>
</div><!--end content-->
<?php require_once("templates-part/slider-b.php");  ?>
<?php require_once("templates-part/footer.php");  ?>