<?php require_once("templates-part/head.php");  ?>
<?php $title = 'Contact Us'; require_once('templates-part/header.php');?>
<?php require_once('inc/lib.php');?>
<?php require_once("templates-part/menu.php");  ?>
<?php require_once("templates-part/slider-a.php");  ?>
<div id="content">
	<?php
		//xu ly form
	if($_SERVER['REQUEST_METHOD']== "POST"){
		$errors= array();
		//kiem tra truong nhap ten
		if(empty($_POST['name'])){
			$errors[]='name';
		}
		//kiem tra xem email co hop le k
		//bieu thuc chinh quy
		//bat nguoi dung phai nhap day du .com
		// nam trong cap dau /^ &/
		//a -> z, A- Z, 0-9, _
		if(!preg_match('/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/',$_POST['email'])){//nếu không phù hợp vs định dạng này-> báo lỗi 
		//cho phép tên email có dạng:      
		//[a-z,0-9,.,-,_] + @ + [a-z, 0-9,..] + \. [a-z, A-Z có thể dai từ 2-6 kí tự]
		//hoac if(!preg_match('/^[a-zA-Z0-9_.-]+@ $/',$_POST["email"])){
			$errors[]='email';

		}
		//kiem tra tin nhan
		if(empty($_POST['comment'])){
			$errors[]='comment';
		}

		//Kiem tra xem co loi o form hay k, neu k co thi gui email
		if(empty($errors)) {
   //          $body = "Name: {$_POST['name']} \n\n Comment:\n ". strip_tags($_POST['comment']);
			// //comment cu 70 chu thi xuong hang 1 lan
			// $body= wordwrap($body, 70);
			//  if(mail('chientuan084@ygmail.com', 'Contact form submission', $body, 'FROM: localhost@localhost')) {
			// 	echo "<p class='success'> Cảm ơn đã liên hệ với chúng tôi, comment của bạn đã được gửi đi </p>";
			// }else{
			// 	echo "<p class='warning'> Có lỗi khi gửi </p>";
			// }

			$to = 'chienthcsphucduong@gmail.com';  //khai báo địa chỉ mail người nhận
			$subject = 'Test email'; // chủ đề của mail
			// Đây là nội dung mail cần gửi. Để xuống dòng , chèn \n vào cuối dòng
			$message = "Hello World!\n\nThis is my first mail.";
			// Khai báo thông tin mail người gửi. Cách dòng bằng \r\n
			$headers = "From: localhost@localhost\r\nReply-To: localhost@localhost";
			 //Gửi mail
			$mail_sent = @mail( $to, $subject, $message, $headers );
			// Nếu thành công thì xuất dòng thông báo "Mail sent", ngược lại thì xuất  "Mail failed"
			echo $mail_sent ? "Mail sent" : "Mail failed";

		}else{
			//neu co loi do nguoi dung quen nhap
			echo "<p class='warning'> Bạn vui lòng điền đầy đủ thông tin </p>";
		}
	} //end main if




	?>

	<form id="contact" action="" method="post">
    <fieldset>
    	<legend>Contact</legend>
            <div>
                <label for="Name">Your Name: <span class="required">*</span>
                    <?php 
                        if(isset($errors) && in_array('name',$errors)) {
                            echo "<span class='warning'>Please enter your name.</span>";
                            }
                    ?>
                </label>
                <input type="text" name="name" id="name" value="<?php if(isset($_POST['name'])) {echo htmlentities($_POST['name'], ENT_COMPAT, 'UTF-8');} ?>" size="20" maxlength="80" tabindex="1" />
            </div>
        	<div>
                <label for="email">Email: <span class="required">*</span>
                <?php 
                        if(isset($errors) && in_array('email',$errors)) {
                            echo "<span class='warning'>Please enter your email.</span>";
                            }
                    ?>
                </label>
                <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) {echo htmlentities($_POST['email'], ENT_COMPAT, 'UTF-8');} ?>" size="20" maxlength="80" tabindex="2" />
            </div>
            <div>
                <label for="comment">Your Message: <span class="required">*</span>
                    <?php 
                        if(isset($errors) && in_array('comment',$errors)) {
                            echo "<span class='warning'>Please enter your message.</span>";
                            }
                    ?>
                </label>
                <div id="comment"><textarea name="comment" rows="10" cols="45" tabindex="3"><?php if(isset($_POST['comment'])) {echo htmlentities($_POST['comment'], ENT_COMPAT, 'UTF-8');} ?></textarea></div>
            </div>
    </fieldset>
    <div><input type="submit" name="submit" value="Send Email" /></div>
</form>

</div> <!-- .content -->
<?php require_once("templates-part/slider-b.php");  ?>
<?php require_once("templates-part/footer.php");  ?>