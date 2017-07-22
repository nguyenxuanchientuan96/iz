<div id="navigation">
		<ul>
	        <li><a href='../index.php'>Home</a></li>
			<li><a href='#'>About</a></li>
			<li><a href='#'>Services</a></li>
			<li><a href='#'>Contact us</a></li>
		</ul>
        
        <p class="greeting">Xin chào <?php echo (isset($_SESSION['first_name'])) ? $_SESSION['first_name'] : "bạn hiền!"; ?></p>
	</div><!-- end navigation-->