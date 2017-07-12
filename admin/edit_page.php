<?php require_once '../inc/lib.php'; ?>
<?php require_once('templates-part/head.php'); ?>
<?php require_once('templates-part/header.php');?>
<?php require_once('templates-part/slider-admin.php');?>
<div id="content">
<?php

	if(isset($_GET["pid"]) && filter_var($_GET["pid"],FILTER_VALIDATE_INT,array('min_range'=>1))){
		$pid=$_GET["pid"];
	}else{
		header('location:view_pages.php');
	}

?>	

    <?php 
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $errors=array();
            if(empty($_POST["page_name"])){
                $errors[]="page_name";
            }else{
                $page_name=mysqli_real_escape_string($conn,strip_tags($_POST["page_name"]));
            }
            // page_name
            if(isset($_POST["category"]) && filter_var($_POST["category"],FILTER_VALIDATE_INT,array('min_range'=>1) )){
                $cat_id=$_POST["category"];
            }else{
                $errors[]="category";
            }
            // category
            if(isset($_POST["position"]) && filter_var($_POST["position"],FILTER_VALIDATE_INT,array('min_range'=>1))){
                $position=$_POST["position"];
            }else{
                $errors[]="position";
            }
            // position
            if(empty($_POST["content"])){
                $errors[]="content";
            }else{
                $content=mysqli_real_escape_string($conn,$_POST["content"]);
            }
            // position
            if(empty($errors)){
                $q="UPDATE pages SET page_name='{$page_name}',cat_id='{$cat_id}',user_id=1,position='{$position}',content='{$content}',post_on= NOW() WHERE page_id={$pid} LIMIT 1";
                $r=mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
                if(mysqli_affected_rows($conn)==1){
                    echo "Edit page thành công";
                }else{
                 echo "Edit page thất bại";
                }
            }else{
                echo "Điền đầy đủ thông tin cho các mục";
            }
        }

    ?>

    <?php
        $q="SELECT * FROM pages WHERE page_id={$pid}";
        $r=mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
        if(mysqli_num_rows($r)==1){
            $page=mysqli_fetch_array($r,MYSQLI_ASSOC);
        }else{
            $message="Page name không tồn tại";
        }
    ?>
    <h2> Edit page: <?php if(isset($row["page_name"])) echo $row['page_name']; ?> </h2>
    <?php if(!empty($message)) echo '{$message}';?>
    <form id="edit_page" action="" method="post">
         <fieldset>
            <legend>Add a Page</legend>
                <div>
                    <label for="page">Page Name: <span class="required">*</span>
                        <?php if(isset($errors) && in_array('page_name', $errors)) {echo "<p class='warning'>Please fill in the page name</p>";}?>
                    </label>
                    <input type="text" name="page_name" id="page_name" value="<?php if(isset($page['page_name'])) echo $page['page_name']; ?>" size="20" maxlength="80" tabindex="1" />
                </div>
                


                <div>
                    <label for="category">All categories: <span class="required">*</span>
                        <?php if(isset($errors) && in_array('category', $errors)) { echo "<p class='warning'>Please pick a category</p>"; }?>
                    </label>
                    
                    <select name="category">
                        <option>Select Category</option>
                        <?php
                            $q = "SELECT cat_id, cat_name FROM categories ORDER BY position ASC";
                            $r = mysqli_query($conn, $q);
                            if(mysqli_num_rows($r) > 0) {
                                while($cats = mysqli_fetch_array($r, MYSQLI_NUM)) {
                                    echo "<option value='{$cats[0]}'";
                                        if(isset($page['$cat_id']) && ($page['cat_id'] == $cats[0])) echo "selected='selected'";
                                    echo ">".$cats[1]."</option>";
                                }
                            }
                        ?>
                    </select>
                    
                </div>
                <div>
                    <label for="position">Position: <span class="required">*</span>
                        <?php if(isset($errors) && in_array('position', $errors)) { echo "<p class='warning'>Please pick a position</p>";}?>
                    </label>
                    <select name="position">
                        <?php
                            $q = "SELECT count(page_id) AS count FROM pages";
                            $r = mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
                            if(mysqli_num_rows($r) == 1) {
                                list($num) = mysqli_fetch_array($r, MYSQLI_NUM);
                                for($i=1; $i<=$num+1; $i++) { // Tao vong for de ra option, cong them 1 gia tri cho position
                                    echo "<option value='{$i}'";
                                        if(isset($page['position']) && $page['position'] == $i) echo "selected='selected'";
                                    echo ">".$i."</otption>";
                                }
                            }
                        ?>
                    </select>
                </div>                
                <div>
                    <label for="page-content">Page Content: <span class="required">*</span>
                        <?php if(isset($errors) && in_array('content', $errors)) {echo "<p class='warning'>Please fill in the content</p>";}?>
                    </label>
                    <textarea name="content" cols="50" rows="20"><?php if(isset($page['content'])) echo htmlentities($page['content'], ENT_COMPAT, 'UTF-8'); ?></textarea>
                </div>
        </fieldset>
        <p><input type="submit" name="submit" value="Save Changes" /></p>
    </form>
    
</div><!--end content-->

<?php require_once('templates-part/footer.php'); ?>