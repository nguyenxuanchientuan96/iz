<?php require_once'../inc/lib.php'; ?>
<?php require_once('templates-part/head.php');?>
<?php require_once('templates-part/header.php');?>
<?php require_once('templates-part/menu.php');?>
<?php include("templates-part/slider-admin.php"); ?>
<div id="content">
       
    <h2>Edit category: </h2>
    <?php 
    	if(isset($_GET["cid"]) && filter_var($_GET["cid"],FILTER_VALIDATE_INT, array('min_range'=>1))){
    		$cid=$_GET["cid"];
    	} else{
    		header('location: view_categories.php');
        
    	}

    	if($_SERVER["REQUEST_METHOD"]=="POST"){
            $errors=array();
            if(empty($_POST["category"])){
                $errors[]="category";
            }else{
    		  $cat_name=mysqli_real_escape_string($conn,strip_tags($_POST["category"]));
    		}
             //cat_name 
            if(isset($_POST["position"]) && filter_var($_POST["position"],FILTER_VALIDATE_INT,array("min_range"=>1))){
                $position=$_POST["position"];
    		}else{
                $errors[]="position";
            }
            // position
            if(empty($errors)){
                $q="UPDATE categories SET cat_name= '{$cat_name}', position= '{$position}' WHERE cat_id={$cid} LIMIT 1";
        		$r=mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
        		if(mysqli_affected_rows($conn) == 1) {
                    echo "<p class='success'>Edit Category thành công.</p>";
                } else {
                    echo "<p class='warning'>Edit category thất bại</p>";
                }
            }else{
                echo "Điền đầy đủ thông tin";
            }
    	}

    ?>
    <!-- form -->
    <!-- tạo ra một php để lấy thông tin catname, position -> nếu có tạo thành một lít, ngược lại tạo thành một biến message để thông báo -->
    <?php
        $q="SELECT cat_name,position FROM categories WHERE cat_id={$cid}";
        $r=mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
        if(mysqli_num_rows($r)==1){
            list($cat_name,$position) =mysqli_fetch_array($r,MYSQLI_NUM);
        }else{
            $message="Category không tồn tại";
        }
    ?>


  <form id="edit_cat" action="" method="post">
    <fieldset>
      <legend>Edit category: <?php if(isset($cat_name)){ echo $cat_name; } ?></legend>
            <div>
                <label for="category">Category Name: <span class="required">*</span>
                    <?php
                        if(isset($errors) && in_array('category', $errors)){
                            echo "Điền đầy đủ thông tin cho category";
                        }
                    ?>
                </label>
                <input type="text" name="category" id="category" value="<?php if(isset($cat_name)) echo $cat_name; ?>" size="20" maxlength="150" tabindex="1" />
            </div>
            <div>
                <label for="position">Position: <span class="required">*</span>
                    <?php
                        if(isset($errors) && in_array('position', $errors)){
                            echo "Vui lòng chọn position";
                        }
                    ?>
                </label>
                <select name="position" tabindex='2'>
                     <?php
                        $q = "SELECT count(cat_id) AS count FROM categories";
                        $r = mysqli_query($conn,$q) or die("Query {$q} \n<br/> MySQL Error: " .mysqli_error($conn));
                        if(mysqli_num_rows($r) == 1) {
                            list($num) = mysqli_fetch_array($r, MYSQLI_NUM);
                            for($i=1; $i<=$num+1; $i++) { // Tao vong for de ra option, cong them 1 gia tri cho position
                                echo "<option value='{$i}'";
                                    if(isset($position) && ($position == $i)) echo "selected='selected'";
                                echo ">".$i."</otption>";
                            }
                        }
                    ?>
                </select>
            </div>
    </fieldset>
    <p><input type="submit" name="submit" value="Edit Category" /></p>
</form>

</div><!--end content-->
<?php require_once('templates-part/footer.php');?>