<?php
	$conn=mysqli_connect("localhost","root","","izcms");
	if($conn){
		mysqli_set_charset($conn,"utf8");
	}
	else{
		die("Có lỗi xảy ra khi kết nối với database".mysqli_error($conn));
	}
?>
<?php 
	// tạo function khoảng cách
//Hàm htmlentities() sẽ chuyển các kí tự thích hợp thành các kí tự HTML entiies.
function the_content($text){
	$sanitized = htmlentities($text, ENT_COMPAT, 'UTF-8');
	return str_replace(array("\r\n", "\n"),array("<p>", "</p>"),$sanitized);
}
?>


<?php 



	function the_excerpt($text){
		//nếu lớn hơn 400 kí tự thì mới cắt
		//nếu lớn hơn 400 kí tự tạo ra một hàm $cutString để cắt $text với điểm bắt đầu là 0, kết thúc là 400
		//tạo ra một hàm $words nữa để đưa đoạn cần cắt k bị mất chữ, dùng hàm strrpos
		$sanitized = htmlentities($text, ENT_COMPAT, 'UTF-8');//để k bị tấn công bới các thẻ <Script> </script>
		if(strlen($sanitized)>400){
			$cutString= substr($sanitized, 0, 400);
			$words= substr($sanitized, 0, strrpos($cutString, ' '));
			return $words;
		} else {
			return $sanitized;
		}
		// return substr($excerpt, 0 , strrpos($excerpt,' '));
	}
?>