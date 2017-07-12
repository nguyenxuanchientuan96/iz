<?php
	require_once"inc/lib.php";
?>
<?php require_once("templates-part/head.php");  ?>
<?php require_once("templates-part/header.php");  ?>
<?php require_once("templates-part/menu.php");  ?>
<?php require_once("templates-part/slider-a.php");  ?>
<div id="content">

 <?php 
 	//lấy content ra tương ứng vs bên slidebar a
	if(isset($_GET["cid"]) && filter_var($_GET["cid"],FILTER_VALIDATE_INT, array('min_range'=>1))){
		$cid=$_GET["cid"];
		//cắt từ trái sang 400 kí tự
		$q  = " SELECT p.page_name, p.page_id, p.content,";
		$q .= " DATE_FORMAT(p.post_on, '%b, %d, %y') AS date,";
		$q .= " CONCAT_WS(' ',u.first_name,u.last_name) AS name, u.user_id";
		$q .= " FROM pages AS p";
		$q .= " INNER JOIN users AS u";
		$q .= " USING (user_id)";
		$q .= " WHERE p.cat_id={$cid}";
		$q .= " ORDER BY date ASC LIMIT 0,10";
		$r= mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
			//neu co noi dung (>0)
		if(mysqli_num_rows($r) >0){
			while($pages=mysqli_fetch_array($r,MYSQLI_ASSOC)){
				//in ra nội dung trong content, có cách từ bên trái 400 kí tự nhưng vs hàm substr và strrpos thì tầm 398 kí tự vì nó lấy khoảng trắng '' trước kí tự thứ 400 ( <p> ".substr($pages['content'], 0 , strrpos($pages['content'],' '))."))
				echo "
					<div class='post'>
						<h2> <a href='single.php?pid={$pages['page_id']}'> {$pages['page_name']}; </a> </h2>
						
						// <p> ".substr($pages['content'], 0 , strrpos($pages['content'],' '))."
						<p> ".the_excerpt($pages['content'])."
						... <a href='single.php?pid={$pages['page_id']}'> Read more </a></p>
						
						<p class='meta'> <strong> Posted by: </strong> {$pages['name']} | <strong> On: {$pages['date']} </strong> </p>
					</div>
					";
			}
		}else {
			echo "Không có post trong category";
		}
	} 

?>
   
        <h2>Welcome To izCMS</h2>
        <div>
            <p>
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
            </p>
            
            <p>
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
            </p>
            
            <p>
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus
            </p>
        </div>

    </div><!--end content-->
<?php require_once("templates-part/slider-b.php");  ?>
<?php require_once("templates-part/footer.php");  ?>