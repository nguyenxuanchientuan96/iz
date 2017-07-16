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


//tom tat
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

	//function captcha(đặt một array câu hỏi va tl, xong random làm captcha)
	function captcha(){
		$qna= array(
			1 => array('question' => 'Mot cong mot', 'answer'=>2),
			2 => array('question' => 'Hai cong hai', 'answer'=>4),
			3 => array('question' => 'Ba cong ba', 'answer'=>6),
			4 => array('question' => 'Bon cong bon', 'answer'=>8),
			5 => array('question' => 'Nam cong nam', 'answer'=>10)

			);
		//array_rand sẽ lấy bất kì một key nào (1,2,3,4,5,...)
		$rand_key=array_rand($qna);//lay ngau nhien mot trong cac cai tren
		$_SESSION['q']= $qna[$rand_key]; //so sanh gia tri nguoi dung nhap vao vs cai dang ton tai trong SESSION
		return $question= $qna[$rand_key]['question']; //return lai array, lay question
	}//end function captcha
	
    
?>