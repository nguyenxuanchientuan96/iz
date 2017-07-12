 <div id="content-container">
        <div id="section-navigation">
         <ul class="navi">
            <?php 

             // Xac dinh cat_id de to dam link
              if(isset($_GET['cid']) && filter_var($_GET['cid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
                  $cid = $_GET['cid'];
                  $pid = NULL;
              } elseif(isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
                  $pid = $_GET['pid'];
                  $cid = NULL;
              } else {
                  $cid = NULL;
                  $pid = NULL;
              }
              //truy vấn tên category, id từ category
              $q="SELECT cat_name,cat_id FROM categories ";
              $r=mysqli_query($conn,$q) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn)); 
                while($cats = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                    echo "<li><a href='index.php?cid={$cats['cat_id']}'";
                          if($cats['cat_id'] == $cid) echo "class='selected'"; 
                      echo ">".$cats['cat_name']. "</a>";
            
            // Cau lenh truy xuat pages
            $q1 = "SELECT page_name, page_id FROM pages WHERE cat_id={$cats['cat_id']} ORDER BY position ASC";
            $r1 = mysqli_query($conn, $q1) or die("Query {$q} \n<br/>MySQL Error:".mysqli_error($conn));
                echo "<ul class='pages'>";
            
            // Lay pages tu csdl
            while($pages = mysqli_fetch_array($r1, MYSQLI_ASSOC)) { 
                echo "<li><a href='single.php?pid={$pages['page_id']}'";
                    if($pages['page_id'] == $pid) echo "class='selected'";
                echo ">".$pages['page_name']."</a></li>";
                
            } // End WHILE pages
                echo "</ul>";
            echo "</li>";
        } // End WHILE cats
            ?> 
         </ul>
    </div><!--end section-navigation-->