<?php require_once"../inc/lib.php"; ?>
<?php require_once("templates-part/head.php"); ?>
<?php require_once("templates-part/header.php"); ?>
<?php require_once("templates-part/menu.php"); ?>
<?php require_once("templates-part/slider-admin.php"); ?>
<div id="content">
<?php
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		//tạo array để khắc phục lỗi: nếu k nhập nó vẫn cố thêm một trường trống vào db
                $errors=array();
                //nếu để trống -> báo lỗi ngược lại tạo một biến lấy dữ liệu
		if(empty($_POST["category"])){
                $errors[]="category";  
			// echo "Không được để trống";
		}else{
                        //mysqli_escape_string:chống tân công kiểu drop/delete -> escapte hết dấu ngoặc đơn ra
			//chống script nhập vào-> loại bỏ hết html ng dùng nhập vào <> -> thường chuyển đến một trang khác mà ng dùng k biết
                $cat_name=mysqli_escape_string($conn,strip_tags($_POST["category"]));
		}
		//nếu tồn tại position-> tạo biến lấy dữ liệu, ngược lại -> báo không tồn tại
                //và check xem position đó có phải là kiểu gì, ở đây là số-> tất cả những gì không phải số -> loại
                //hàm filter_var(kiểm tra gía trị trong position, kiểu kiểm tra là int, với gía trị bé nhất min_range=1)
	       if(isset($_POST["position"]) && filter_var($_POST["position"],FILTER_VALIDATE_INT,array('min_range'=>1)) ){
			$position=$_POST["position"];
                
		}else{
                $errors[]="position";
			// echo "Không tồn tại position";
		}
		//sql
                //bên trên: nếu trống thì thông báo lỗi
                //giờ làm if để nói: nếu dữ liệu nhập vào k trống thì thực hiện,
                                // ngược lại, báo điền đầy đủ thông 
		if(empty($errors)){
                $q="INSERT INTO categories(user_id,cat_name,position) VALUES (1,'{$cat_name}','{$position}')";
        		//nếu $r k xảy ra -> die, ngược lại nếu xảy ra thì làm tiếp
        		$r=mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
        		//nếu bên trong bảng có gía trị -> thêm thành công, ngược lại thất bại
        		if(mysqli_affected_rows($conn) == 1){
        			echo "Thêm category thành công !!!";
        		}else{
        			echo "Không thể thêm category !!!";
                }

        }else{
             echo "Điền đầy đủ thông tin vào form!!!";
        }


    }

?>

<h2> Create a category </h2>
        <form id="add_cat" action="" method="POST">
        	<fieldset>
        		<legend> ADD Category</legend>
        			<div>
        				<label for="category"> Category Name: <span class="require">*</span>
                                                <!-- nếu tồn tại lỗi(không nhập thông tin) và lỗi đó nằm trong category -> báo lỗi ở category -->
                                                <?php
                                                      if(isset($errors) && in_array("category", $errors)){
                                                           echo "Bạn chưa nhập đầy đủ thông tin ở category";
                                                      }

                                                ?>

                                        </label>
        				<!-- nhớ những gì đã nhập -->
        				<input type="text" name="category" id="category" value="<?php if(isset($_POST['category'])) echo strip_tags($_POST["category"]); ?>" size="20" maxlength="80" tabindex="1">
        			</div>
        			<div>
        				<label for="position"> Position: <span class="require">* </span>
                                        <!-- nếu tồn tại lỗi(không nhập thông tin) và lỗi đó nằm trong position -> báo lỗi ở position -->
                                                <?php 
                                                       if(isset($errors) && in_array("position", $errors)){
                                                            echo "Bạn chưa chọn position"; 
                                                       }
                                                ?>
                                        </label>
        				<select name="position" tabindex="2">
        					<!-- sinh ra position tự động theo trong db -->
                                                <?php
                                                        $q= "SELECT count(cat_id) AS count FROM categories";
                                                        $r=mysqli_query($conn,$q) or die("Query {$q} \n<br/> mysqli_error:".mysqli_error($conn));
                                                        //neu = 1 thi moi tao option
                                                        if(mysqli_num_rows($r)==1){

                                                                list($num)=mysqli_fetch_array($r,MYSQLI_NUM); //tra ve dang so
                                                                        
                                                                for($i=1;$i<=$num+1;$i++){
                                                                        echo "<option value='{$i}'";
                                                                                if (isset($_POST['position']) && $_POST['position'] == $i) echo "selected=='selected'";
                                                                                
                                                                                

                                                                        echo ">" .$i. "</option>";
                                                                }
                                                        }
                                                ?>
        				</select>
        			</div>
        	</fieldset>
        	<p> <input type="submit" name="submit" value="Add Category"/> </p>
        </form> 

</div><!--end content-->

<?php require_once("templates-part/footer.php"); ?>





























<!-- 
Form
<h2> Create a category </h2>
        <form id="add_cat" action="" method="POST">
        	<fieldset>
        		<legend> ADD Category</legend>
        			<div>
        				<label for="category"> Category Name: <span class="require">*</span></label>
        				
        				<input type="text" name="category" id="category" value="" size="20" maxlength="80" tabindex="1">
        			</div>
        			<div>
        				<label for="position"> Position: <span class="require">* </span></label>
        				<select name="position" tabindex="2">
        					<option value="#"> 1 </option>
        					<option value="#"> 1 </option>
        					<option value="#"> 1 </option>
        					<option value="#"> 1 </option>
        				</select>
        			</div>
        	</fieldset>
        	<p> <input type="submit" name="submit" value="Add Category"/> </p>
        </form> -->