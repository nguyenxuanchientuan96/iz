<div id="footer">
    <ul class="footer-links">
       <?php 
       
        if(isset($_SESSION['user_level'])) {
            // Neu co SESSION
            switch($_SESSION['user_level']) {
                case 0: // Registered users access
                echo "
                    <li><a href='edit_profile.php'>User Profile</a></li>
                    <li><a href='change_password.php'>Change Password</a></li>
                    <li><a href='#'>Personal Message</a></li>
                    <li><a href='logout.php'>Log Out</a></li>
                ";
                break;
                
                case 2: // Admin access
                echo "
                    <li><a href='edit_profile.php'>User Profile</a></li>
                    <li><a href='change_password.php'>Change Password</a></li>
                    <li><a href='#'>Personal Message</a></li>
                    <li><a href='admin/admin.php'>Admin CP</a></li>
                    <li><a href='logout.php'>Log Out</a></li>
                ";
                break;
                
                default:
                echo "
                    <li><a href='register.php'>Register</a></li>
                    <li><a href='login.php'>Login</a></li>
                ";
                break;
                
            }
            
        } else {
            // Neu khong co $_SESSION
            echo "
                    <li><a href='register.php'>Home</a></li>
                    <li><a href='register.php'>Register</a></li>
                    <li><a href='login.php'>Login</a></li>
                ";
        }
       ?>
    </ul>
</div><!--end footer-->
</div> <!-- end content-container-->
</div> <!--end container-->
</body>
</html>