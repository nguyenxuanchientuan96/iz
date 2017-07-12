<?php require_once"../inc/lib.php"; ?>
<?php require_once("templates-part/head.php"); ?>
<?php require_once("templates-part/header.php"); ?>
<?php require_once("templates-part/menu.php"); ?>
<?php require_once("templates-part/slider-admin.php"); ?>
    <div id="content">
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
          $errors=array();
          if(empty($_POST["page_name"])){
            $errors[]="page_name";
          }else{
            $page_name=mysqli_escape_string($conn,strip_tags($_POST['page_name']));
          }
          // end-pagename
          if(isset($_POST["position"]) && filter_var($_POST["position"],FILTER_VALIDATE_INT,array('min_range'=>1))){
            $position=$_POST["position"];
          }else{
            $errors[]="position";
          }
          // end-position
          if(isset($_POST["category"]) && filter_var($_POST["category"],FILTER_VALIDATE_INT,array('min_range'=>1))){
            $cat_id=$_POST["category"];
            }else{
              $errors[]="category";
            }
          // end cat_id
          if(empty($_POST["content"])){
            $errors[]= "content";
          }else{
            $content=mysqli_escape_string($conn,$_POST["content"]);
          }
          // end content
          if(empty($errors)){
            $q="INSERT INTO pages(user_id,cat_id,page_name,content,position,post_on) 
              VALUES(1,'{$cat_id}','{$page_name}','{$content}','{$position}',NOW())
             ";
            $r=mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
            if(mysqli_affected_rows($conn)==1){
              echo "Thêm page thành công";
            }else{
              echo "Thêm thất bại";
            }
          }else{
            echo "Mời nhập đầy đủ thông tin";
          }
        }
    ?>

    <h2> Create Pages </h2>
    <form method="POST" action="" id="cat_pages">
        <fieldset>
            <legend> Add a pages</legend>
            <div>
              <label for="pages"> Pages Name<span class="required"></span>
                  <?php 
                  //nếu rỗng trong mảng thuộc text box pagename thì báo lỗi
                    if(isset($errors) && in_array('page_name',$errors)){
                        echo "<p class='warning'> Điền đầy đủ thông tin cho pagename </p>";
                    }
                  ?>
              
              </label>
              <input type="text" name="page_name" value="<?php if(isset($_POST['page_name'])) echo strip_tags($_POST['page_name']);?>"     
               size="20" maxlength="80" tabindex="1">
            </div>

            <div>
              <label for="category"> All Categories <span class="require">*</span>
                 <?php 
                  //nếu rỗng trong mảng thuộc text box pagename thì báo lỗi
                    if(isset($errors) && in_array('category',$errors)){
                        echo "<p class='warning'> Điền đầy đủ thông tin cho category </p>";
                    }
                  ?>
              </label>
              <select name="category">
                  <option value=""> Select Category</option>
                   <?php
                        $q = "SELECT cat_id, cat_name FROM categories ORDER BY position ASC";
                        $r = mysqli_query($conn, $q);
                        if(mysqli_num_rows($r) > 0) {
                            while($cats = mysqli_fetch_array($r, MYSQLI_NUM)) {
                                echo "<option value='{$cats[0]}'";
                                    if(isset($_POST['category']) && ($_POST['category'] == $cats[0])) echo "selected='selected'";
                                echo ">".$cats[1]."</option>";
                            }
                        }
                    ?>
                  
              </select>
            </div>

            <div>
              <label for="position"> Position <span class="required">* </span>
                  <?php 
                  //nếu rỗng trong mảng thuộc text box pagename thì báo lỗi
                    if(isset($errors) && in_array('position',$errors)){
                        echo "<p class='warning'> Điền đầy đủ thông tin cho position </p>";
                    }
                  ?>
              </label>
              <select name="position">
                      <?php
                    $q= "SELECT count(page_id) AS count FROM pages";
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

            <div>
              <label for="page-content"> Page Content <span class="required"> * </span> 
                  <?php 
                  //nếu rỗng trong mảng thuộc text box pagename thì báo lỗi
                    if(isset($errors) && in_array('content',$errors)){
                        echo "<p class='warning'> Điền đầy đủ thông tin cho pagename </p>";
                    }
                  ?>
              </label>
              <textarea name="content" cols="50" rows="20"></textarea>
            </div>
        </fieldset>      
        <input type="submit" name="submit" value="Add page">
    </form>
    </div><!--end content-->



<?php require_once("templates-part/footer.php"); ?>






















<!-- <fieldset>
            <legend> Add a pages</legend>
            <div>
                  <label for="pages"> Pages Name<span class="required"></span> </label>
                  <input type="text" name="page_name" value="" size="20" maxlength="80" tabindex="1">
            </div> 
            <div>
              <label for="category"> All Categories <span class="require">*</span> </label>
              <select name="category">
                  <option value=""> Select Category</option>
                         <option value=""> Select Category</option>
                                <option value=""> Select Category</option>
                                
                 
              </select>
            </div> 

            <div>
              <label for="position"> Position <span class="required">* </span> </label>
              <select name="position">
                                       

              </select>
            </div>

            <div>
              <label for="page-content"> Page Content <span class="required"> * </span> </label>
              <textarea name="content" cols="50" rows="20"></textarea>
            </div>
        </fieldset>       -->