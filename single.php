<!-- in ra tên page lên title khi kích vào từng page -->
<?php
	require_once"inc/lib.php";
?>
	<?php 
		if(isset($_GET["pid"]) && filter_var($_GET["pid"],FILTER_VALIDATE_INT, array('min_range'=>1))){
		$pid=$_GET["pid"];
		//cắt từ trái sang 400 kí tự
		$q  = " SELECT p.page_name, p.page_id, p.content content,";
		$q .= " DATE_FORMAT(p.post_on, '%b, %d, %y') AS date,";
		$q .= " CONCAT_WS(' ',u.first_name,u.last_name) AS name, u.user_id";
		$q .= " FROM pages AS p";
		$q .= " INNER JOIN users AS u";
		$q .= " USING (user_id)";
		$q .= " WHERE p.page_id={$pid}";
		$q .= " ORDER BY date ASC LIMIT 1";
		$r= mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn)); 
			//neu co noi dung (>0)
		$posts= array(); //tao mot array trong de su dung cho sau nay phan noi dung
		if(mysqli_num_rows($r) >0){
			$pages=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$title= $pages['page_name'];
			$posts[]=array('page_name' => $pages['page_name'],
						 	'content' => $pages['content'], 
						 	'author' => $pages['name'], 
						 	'post_on' => $pages['date'],
								// lấy tên tgia để sau sử dụng trong content
							'aid' => $pages['user_id']);
				//in ra nội dung trong content, có cách từ bên trái 400 kí tự nhưng vs hàm substr và strrpos thì tầm 398 kí tự vì nó lấy khoảng trắng '' trước kí tự thứ 400
				
		}else {
			echo "Không có post trong category";
		}
	} else{
		header('location:index.php');
	}


	 ?>
<?php require_once("templates-part/head.php");  ?>
<?php require_once("templates-part/header.php");  ?>
<?php require_once("templates-part/menu.php");  ?>
<?php require_once("templates-part/slider-a.php");  ?>
<div id="content">

 <?php 
 	//lấy content ra tương ứng vs bên slidebar a
	// if(isset($_GET["pid"]) && filter_var($_GET["pid"],FILTER_VALIDATE_INT, array('min_range'=>1))){
	// 	$pid=$_GET["pid"];
	// 	//cắt từ trái sang 400 kí tự
	// 	$q  = " SELECT p.page_name, p.page_id, p.content content,";
	// 	$q .= " DATE_FORMAT(p.post_on, '%b, %d, %y') AS date,";
	// 	$q .= " CONCAT_WS(' ',u.first_name,u.last_name) AS name, u.user_id";
	// 	$q .= " FROM pages AS p";
	// 	$q .= " INNER JOIN users AS u";
	// 	$q .= " USING (user_id)";
	// 	$q .= " WHERE p.page_id={$pid}";
	// 	$q .= " ORDER BY date ASC LIMIT 1";
	// 	$r= mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
			//neu co noi dung (>0)
		// if(mysqli_num_rows($r) >0){
		// 	$pages=mysqli_fetch_array($r,MYSQLI_ASSOC);
				//in ra nội dung trong content, có cách từ bên trái 400 kí tự nhưng vs hàm substr và strrpos thì tầm 398 kí tự vì nó lấy khoảng trắng '' trước kí tự thứ 400
		foreach ($posts as $post ) {
			//binhf thuowngf
				// echo "
				// 	<div class='post'>
				// 		<h2>  {$pages['page_name']}; </h2>
						
				// 		<p> {$pages['content']} </p>
						
				// 		<p class='meta'> <strong> Posted by: </strong> {$pages['name']} | <strong> On: {$pages['date']} </strong> </p>
				// 	</div>
				// 	";
				//khi đưa tên lên trên title
			// echo "
			// 		<div class='post'>
			// 			<h2>  {$post['page_name']}; </h2>
						
			// 			 <p> {$post['content']} </p>
						
			// 			<p class='meta'> <strong> Posted by: </strong> <a href='author.php?aid={$post['aid']}'> {$post['author']} </a> | <strong> On: {$post['post_on']} </strong> </p>
			// 		</div>
			// 		";

			echo "
					<div class='post'>
			 			<h2>  {$post['page_name']}; </h2>
						
			 			<p>".the_content($post['content'])."</p>
						
						<p class='meta'> <strong> Posted by: </strong> <a href='author.php?aid={$post['aid']}'> {$post['author']} </a> | <strong> On: {$post['post_on']} </strong> </p>
			 		</div>
			 		";
		}	
	// 	}else {
	// 		echo "Không có post trong category";
	// 	}
	// } else{
	// 	header('location:index.php');
	// }

?>
   
<?php include("templates-part/comment_form.php"); ?>  

    </div><!--end content-->
<?php require_once("templates-part/slider-b.php");  ?>
<?php require_once("templates-part/footer.php");  ?>