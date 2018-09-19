<?php 

	error_reporting('E_ALL & ~e_notice');

	//业务逻辑异常
	try{

		if(empty($_POST['username'])){
			throw new Exception('缺少username必填参数');
		}

		if(empty($_POST['password'])){
			throw new Exception('缺少password必填参数');
		}

	}catch(Exception $e){
		echo resp([],401,$e->getMessage());
		exit;
	}

	//处理服务器未知异常
	try{
		$pdo = new PDO('mysql:host=localhost;dbname=zhihu;charset=utf8','root','');

		$stmt = $pdo->query('select * from api');

		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

	}catch(Exception $e){

		echo resp($data,401,$e->getMessage());
		exit;

	}


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