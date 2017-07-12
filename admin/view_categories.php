<?php require_once'../inc/lib.php'; ?>
<?php require_once('templates-part/head.php');?>
<?php require_once('templates-part/header.php'); ?>
<?php require_once('templates-part/menu.php');?>
<?php require_once("templates-part/slider-admin.php"); ?>
   <!-- delete category -->
<?php
   
    if(isset($_POST["delete"])){
        $id=$_POST["delete"];
        $sql="DELETE FROM categories WHERE cat_id={$id}";
        $rs=mysqli_query($conn,$sql);
        if($rs){
            echo "Xóa thành công";
        }
        else{
            echo "Thất bại trong việc xóa Category";
        }
    }
?>



<!-- end delete -->
   <div id="content">
    <h2>Manage Categories</h2>
    <table>
        <thead>
            <tr>
                <th><a href="view_categories.php?sort=cat">Categories</a></th>
                <th><a href="view_categories.php?sort=pos">Position</th>
                <th><a href="view_categories.php?sort=by">Posted by</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //nếu tồn tại sort, và sort bằng các gía tri này-> sắp xếp theo catname/positio/name, mặc định là position , theo biến order_by được tạo ra
                if(isset($_GET['sort'])) {
                switch ($_GET['sort']) {
                    case 'cat':
                    $order_by = 'cat_name';
                    break;
                    
                    case 'pos':
                    $order_by = 'position';
                    break;
                    
                    case 'by':
                    $order_by = 'name';
                    break;
                    
                    default:
                    $order_by = 'position';
                    break;
                } // End Switch
            } else {
                $order_by = 'position';
            }
            //lấy thông tin từ categories: cat_id, Cat_name, position, user_id và lấy first name, last name bên phía user
            // concat_ws để nối trong mysql
            //CANCAT_WS("trống","1","2") 1,2 là 2 gía trị nối với nhau
                  // chung order_by, tăng dần:ASC
            
                //!important: gĩưa dấu = và chữ có cách
                $q  = " SELECT c.cat_id,c.cat_name,c.position,c.user_id, CONCAT_WS(' ',first_name,last_name) AS name";
                $q .= " FROM categories AS c";
                $q .= " JOIN users AS u";  
                $q .= " USING(user_id)";
                $q .= " ORDER BY {$order_by} ASC";
                $r=mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
                while ($row=mysqli_fetch_array($r,MYSQLI_ASSOC)) :
                ?>
                    <tr> 
                        <td> <?php echo $row["cat_name"]; ?> </td>
                        <td> <?php echo $row["position"]; ?> </td>
                        <td> <?php echo $row["name"]; ?> </td>
                        <td> <a href='edit_category.php?cid=<?php echo $row["cat_id"];?>'> Edit </a> </td>
                        <td> 
                            <form method="POST">
                                <input type="hidden" name="delete" value="<?php echo $row["cat_id"];  ?>">
                                <button type="submit" onclick="return confirm('bạn có chắc chắn muốn xóa không??')"> Xóa</button>
                            </form>


                        </td>

                    </tr>

                 <?php endwhile ?>














              
                 
            
            
        </tbody>
    </table>
</div><!--end content-->

  



<?php require_once('templates-part/footer.php');?>


