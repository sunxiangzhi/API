<?php 

	//接受请求响应数据
	$pdo = new PDO('mysql:host=localhost;dbname=zhihu;charset=utf8','root','');

	$stmt = $pdo->query('select * from api');

	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);




	//定义标准化产出数据格式函数
	function resp($data,$status,$message){

		$res = [
			'message'=>$message,//此次api请求的描述
			'status'=>$status,//服务器响应状态码
			'data'=>$data,

		];

		return json_encode($res,JSON_UNESCAPED_UNICODE);

	};

	echo resp($data,200,'ok');

 ?>