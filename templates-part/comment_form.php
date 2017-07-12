<?php
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		  $errors = array();          
        // Validate name
        if(!empty($_POST['name'])) {
            $name = mysqli_real_escape_string($conn,strip_tags($_POST['name']));
        } else {
            $errors[] = "name";
        }
    
        // Validate email
        if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email= mysqli_real_escape_string($conn,strip_tags($_POST['email']));
        } else {
            $errors[] = "email";
        }
    
        // Validate comment
        if(!empty($_POST['comment'])) {
            $comment = mysqli_real_escape_string($conn,$_POST['comment']);
        } else {
            $errors[] = "comment";
        }

		//validate captcha question 
		//captcha câu hỏi: 4+1 =?
		//nếu k bằng 5-> errors
		if(isset($_POST["captcha"]) && trim($_POST["captcha"]) !=5 ){
			$errors[]="captcha";
		}

		if(empty($errors)) {
        // Neu ko co errors xay ra, them comment vao csdl
            $q = "INSERT INTO comments (page_id,author, email, comment, comment_date) VALUES ({$pid},'{$name}','{$email}','{$comment}', NOW())";
            $r = mysqli_query($conn,$q);
            if(mysqli_affected_rows($conn) == 1) {
                // Success
                echo "Thank you for your comment";
                
            } else { // NO match was made
                echo "có lỗi";
            }
        } else {
        // Neu co errors xay ra, do nguoi dung quen dien form, bao errors.
       echo "điền đầy đủ thông tin";
        }
	}	

?>
<!-- hien thi comment tu csdl -->
<?php
    $q="SELECT author, comment, DATE_FORMAT(comment_date,'%b %d, %y') AS date FROM comments WHERE page_id={$pid}";
    $r= mysqli_query($conn, $q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
    if(mysqli_num_rows($r) >0){
        //neu co comment de hien thi ra trinh duyet
        echo "<ol id='disscuss'>";
        while(list($author, $comment,$date) =mysqli_fetch_array($r,MYSQLI_NUM)){
            echo "<li>
                <p class='author'> {$author} </p>
                <p class='comment-sec'> {$comment} </p>
                <p class='date'> {$date} </p> 

            ";
        }//end while
        echo "</ol>";
    }//end if
    else{
        //neu k co comment
        echo "Hãy là người đầu tiên comment";
    }

?>

<form id="comment-form" action="" method="post">
    <fieldset>
    	<legend>Leave a comment</legend>
            <div>
            <label for="name">Name: <span class="required">*</span>
            <?php if(isset($errors) && in_array('name',$errors)) { echo "<span class='warning'>Please enter your name.</span>";}?>
            </label>
            <input type="text" name="name" id="name" value="<?php if(isset($_POST['name'])) {echo htmlentities($_POST['name'], ENT_COMPAT, 'UTF-8');} ?>" size="20" maxlength="80" tabindex="1" />
        </div>
        <div>
            <label for="email">Email: <span class="required">*</span>
                <?php if(isset($errors) && in_array('email',$errors)) echo "<span class='warning'>Please enter your email.</span>";?>
            </label>
            <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) {echo htmlentities($_POST['email']);} ?>" size="20" maxlength="80" tabindex="2" />
            </div>
        <div>
            <label for="comment">Your Comment: <span class="required">*</span>
                <?php if(isset($errors) && in_array('comment',$errors)) { echo "<span class='warning'>Please enter your message.</span>"; } ?>
            </label>
            <div id="comment"><textarea name="comment" rows="10" cols="50" tabindex="3"><?php if(isset($_POST['comment'])) {echo htmlentities($_POST['comment'], ENT_COMPAT, 'UTF-8');} ?></textarea></div>
        </div>
        
        
        
        <div>
        <label for="captcha">Answer question: four plus one <span class="required">*</span>
        	

        </label>
            <input type="text" name="captcha" id="captcha" value="" size="20" maxlength="10" tabindex="4" />
        </div>
    </fieldset>
    <div><input type="submit" name="submit" value="Post Comment" /></div>
</form>