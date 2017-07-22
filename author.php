<?php require_once("templates-part/head.php");  ?>
<?php $title = 'Author Page'; require_once('templates-part/header.php');?>
<?php require_once('inc/lib.php');?>
<?php require_once("templates-part/header.php");  ?>
<?php require_once("templates-part/menu.php");  ?>
<?php require_once("templates-part/slider-a.php");  ?>
<div id="content">
    <?php
        //phân trang cho author
       //Đặt số trang muốn hiển thị ra trình duyệt (số bài viết muốn hiển thị trên 1 trang)
       // $display=4;
       
       // // $start:bat dau trong sql
       // if(isset($_GET["s"]) && filter_var($_GET["s"],FILTER_VALIDATE_INT, array('min_range'=>1))){
       //      $start=$_GET['s'];
       // }else{
       //      $start = 0;
       // }
       // // $page: tìm số trang để phân trang
       // if(isset( $_GET["p"]) && filter_var($_GET["p"],FILTER_VALIDATE_INT, array('min_range'=>1))){
       //      $page=$_GET['p'];
       // }else{
       //      //nếu biến $p k có thì truy vấn tìm ra số page hiển thị
       //      $q="SELECT COUNT(page_id) FROM pages";
       //      $r=mysqli_query($conn, $q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
       //      list($record)= mysqli_fetch_array($r, MYSQLI_NUM);
       //      //neu du lieu tra ve $record > so trang can hien thi
            
       //       if($record > $display) {
       //          $page = ceil($record/$display);
       //      } else {
       //          $page = 1;
       //      }
       // }
       // echo "<ul class='pagination'>";
       // //neu so trang >1 thi moi can phan trang
       // if($page>1){
       //      //page hien tai dang o dau= trang bắt đầu / số bài viết muốn hiển thị + 1
       //      //tim ra page hien tai dang o dau, vi du dang o page thu 2, thi startpage =4 /4 =1 +1 =2
       //      //dang o trang thu 3: thi startpage= 8/4=2  + 1 =3
       //      $current_page= ($start/$display) + 1; //khi page= 1,start luôn =0 / 4 +1 =1 -> trang hiện tại là 1
       //      //neu khong phai o trang dau (1) thi se hien thi trang truoc(previos)
       //      if($current_page !=1){
       //          //neu trang hien tai =2 thi $start=4 - $display (4) =0 -> s =0(0 la so bat dau cua trang 1, 4 trang 2, 8 trang 3 .... ) -> mỗi lần nhấn previous sẽ về trang trước trang hiện tại
       //          echo "<li> <a href='author.php?aid={$aid}&s=".($start-$display)."&p={$page}'> Previous </a>  </li> ";
       //      }

       //      //hiển thị những phần số còn lại của trang
       //      //ví dụ trang hiện tại là 3, tổng số trang là 4, vòng lặp sẽ chạy bắt đầu từ 1,  1<4, mỗi lần sẽ + thêm 1, nếu i khác số trang hiện tại đang ở thì in ra, với s= số bài viết hiển thị * i - 1
       //      //ví dụ ở vòng lặp 2, i = 2 -> s = 4 * 2-1 = 4 (4 là bắt đầu của trang 2) -> in ra i
       //      //ngược lại nếu i = trang hiện tại đang ở thì in ra i, đồng thời tô đậm 
       //      for($i=1; $i<=$page; $i++){
       //          if($i != $current_page){
       //              echo "<li> <a href='author.php?aid={$aid}&s=".($display * ($i - 1))." &p={$page}'>{$i}</a></li>";
       //          }else{
       //              echo "<li class='current'> {$i} </li> ";
       //          }
            
       //      } //end for
       //      //neu khong phai trang cuoi thi hien thi next
       //      // next
       //      if($current_page != $page){ 
       //          echo "<li>  <a href='author.php?aid={$aid}&s=".($start+$display)."&p={$page}'> Next </a> </li>";
       //      }
       // } //end if
       // echo "</ul>";

   ?>
<?php
	if(isset($_GET["aid"]) && filter_var($_GET["aid"],FILTER_VALIDATE_INT, array('min_range'=>1))){
		$aid=$_GET["aid"];

            //Đặt số trang muốn hiển thị ra trình duyệt (số bài viết muốn hiển thị trên 1 trang)
           $display=4;
           
           // $start:bat dau trong sql
           if(isset($_GET["s"]) && filter_var($_GET["s"],FILTER_VALIDATE_INT, array('min_range'=>1))){
                $start=$_GET['s'];
           }else{
                $start = 0;
           }
           // $page: tìm số trang để phân trang
           if(isset($_GET["p"]) && filter_var($_GET["p"],FILTER_VALIDATE_INT, array('min_range'=>1))){
                $page=$_GET['p'];
           }else{
                //nếu biến $p k có thì truy vấn tìm ra số page hiển thị
                $q="SELECT COUNT(page_id) FROM pages";
                $r=mysqli_query($conn, $q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
                list($record)= mysqli_fetch_array($r, MYSQLI_NUM);
                //neu du lieu tra ve $record > so trang can hien thi
                
                 if($record > $display) {
                    $page = ceil($record/$display);
                } else {
                    $page = 1;
                }
           }


		$q = " SELECT p.page_id, p.page_name, p.content,"; 
        $q .= " DATE_FORMAT(p.post_on, '%b %d, %y') AS date, ";
        $q .= " CONCAT_WS(' ', u.first_name, u.last_name) AS name, u.user_id ";
        $q .= " FROM pages AS p";
        $q .= " INNER JOIN users AS u";
        $q .= " USING (user_id)";
        $q .= " WHERE u.user_id={$aid}";
        $q .= " ORDER BY date ASC LIMIT {$start}, {$display}";
        $r= mysqli_query($conn, $q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
        if(mysqli_num_rows($r)>0){
        	// nếu có gía trị hiển thị ra trình duyệt
        	 while($author = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                        echo "
                            <div class='post'>
                                <h2><a href='single.php?pid={$author['page_id']}'>{$author['page_name']}</a></h2>
                                <p>".the_excerpt($author['content'])." ... <a href='single.php?pid={$author['page_id']}'>Read more</a></p>
                                <p class='meta'><strong>Posted by:</strong><a href='author.php?aid={$author['user_id']}'> {$author['name']}</a> | <strong>On: </strong> {$author['date']} </p>
                            </div>
                        ";
                    } // END WHILE

                    ///////////////////////////////////////////////////////
                    // pagi
             echo "<ul class='pagination'>";
       //neu so trang >1 thi moi can phan trang
       if($page>1){
            //page hien tai dang o dau= trang bắt đầu / số bài viết muốn hiển thị + 1
            //tim ra page hien tai dang o dau, vi du dang o page thu 2, thi startpage =4 /4 =1 +1 =2
            //dang o trang thu 3: thi startpage= 8/4=2  + 1 =3
            $current_page= ($start/$display) + 1; //khi page= 1,start luôn =0 / 4 +1 =1 -> trang hiện tại là 1
            //neu khong phai o trang dau (1) thi se hien thi trang truoc(previos)
            if($current_page !=1){
                //neu trang hien tai =2 thi $start=4 - $display (4) =0 -> s =0(0 la so bat dau cua trang 1, 4 trang 2, 8 trang 3 .... ) -> mỗi lần nhấn previous sẽ về trang trước trang hiện tại
                echo "<li> <a href='author.php?aid={$aid}&s=".($start-$display)."&p={$page}'> Previous </a>  </li> ";
            }

            //hiển thị những phần số còn lại của trang
            //ví dụ trang hiện tại là 3, tổng số trang là 4, vòng lặp sẽ chạy bắt đầu từ 1,  1<4, mỗi lần sẽ + thêm 1, nếu i khác số trang hiện tại đang ở thì in ra, với s= số bài viết hiển thị * i - 1
            //ví dụ ở vòng lặp 2, i = 2 -> s = 4 * 2-1 = 4 (4 là bắt đầu của trang 2) -> in ra i
            //ngược lại nếu i = trang hiện tại đang ở thì in ra i, đồng thời tô đậm 
            for($i=1; $i<=$page; $i++){
                if($i != $current_page){
                    echo "<li> <a href='author.php?aid={$aid}&s=".($display * ($i - 1))."&p={$page}'>{$i}</a></li>";
                }else{
                    echo "<li class='current'> {$i} </li> ";
                }
            
            } //end for
            //neu khong phai trang cuoi thi hien thi next
            // next
            if($current_page != $page){ 
                echo "<li>  <a href='author.php?aid={$aid}&s=".($start+$display)."&p={$page}'> Next </a> </li>";
            }
       } //end if
       echo "</ul>";
                    // end pagi

       //////////////////////////////////


        }else{
		//néu aid không tồn tại thì báo lỗi
		echo "Bạn không tồn tại";
		}
	}else{
		header('location: index.php');
	}

?>
</div> <!-- end content -->
<?php require_once("templates-part/slider-b.php");  ?>
<?php require_once("templates-part/footer.php");  ?>