<?php include'../inc/lib.php'; ?>
<?php include('templates-part/head.php');?>
<?php include('templates-part/header.php'); ?>
<?php include('templates-part/menu.php');?>
<?php include("templates-part/slider-admin.php"); ?>
<?php
   
    if(isset($_POST["delete"])){
        $id=$_POST["delete"];
        $sql="DELETE FROM pages WHERE page_id={$id}";
        $rs=mysqli_query($conn,$sql);
        if($rs){
            echo "Xóa thành công";
        }
        else{
            echo "Thất bại trong việc xóa pages";
        }
    }
?>


<div id="content">

<h2>Manage Pages</h2>
<table>
	<thead>
		<tr>
			<th><a href="view_pages.php?sort=page_name">Pages</a></th>
			<th><a href="view_pages.php?sort=post_on">Posted on</a></th>
			<th><a href="view_pages.php?sort=post_by">Posted by</a></th>
            <th>Content</th>
            <th>Edit</th>
            <th>Delete</th>
		</tr>
	</thead>
	<tbody>
        <?php
            if(isset($_GET['sort'])){
                switch ($_GET['sort']) {
                    case 'page_name':
                        $order_by= "page_name";
                        break;
                    
                    case 'post_on':
                        $order_by= "post_on";
                        break;

                    case 'post_by':
                        $order_by= "name";
                        break;

                    default:
                        $order_by= "page_name";
                        break;
                }
            }else{
                $order_by="page_name";
            }

        ?>
        <?php
        //giữa dấu = " , gĩưa dấu " và chữ có khoảng cách 
            $q  = " SELECT p.user_id,p.page_id,p.page_name,DATE_FORMAT(p.post_on, '%b %d %Y') AS date,p.content,CONCAT_WS(' ',first_name,last_name) AS name";
            $q .= " FROM pages AS p";
            $q .= " JOIN users AS u";
            $q .= " USING (user_id)";
            $q .= " ORDER BY {$order_by} ASC";
            $r= mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
            while($row=mysqli_fetch_array($r,MYSQLI_ASSOC)):
            ?>
                <tr>
                    <td> <?php echo $row["page_name"]; ?> </td>
                    <td> <?php echo $row["date"]; ?> </td>
                    <td> <?php echo $row["name"]; ?> </td>
              		<td> <?php echo the_excerpt($row["content"]); ?></td>
                    <td><a class='edit' href='edit_page.php?pid=<?php echo $row['page_id'] ?>'>Edit</a></td>
                    <td> 
                        <form method="POST">
                            <input type="hidden" name="delete" value="<?php echo $row["page_id"];  ?>">
                            <button type="submit" onclick="return confirm('bạn có chắc chắn muốn xóa không??')"> Xóa</button>
                        </form>


                    </td>
                </tr>
            <?php endwhile ?>
            
          
	</tbody>
</table>
</div><!--end content-->
<?php require_once('templates-part/footer.php'); ?>