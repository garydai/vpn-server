<?php
namespace app\controllers;
use app\models\User;
use app\models\Server;
use app\models\Report;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function actions()  
	{  
	    $actions = parent::actions();  
	  
	    // 注销系统自带的实现方法  
	    unset($actions['create']);  
	      
	    //unset($actions['create']);  
	    //unset($actions['update']);  
	    //unset($actions['delete']);  
	  
	  return $actions;  
	}  
	  
	//覆盖父类的actionIndex方法,并进行重写  
	public function actionCreate()  
	{  
	    
	    $id = $_POST["userid"];  
	    if($id)
	    {
	    	$user = User::findOne(['username'=>$id]);
	     	if($user)
	    	{
	    		return $user;
	    	}
	    	else 
	    	{
	    		$u = new User();
	    		$u->username = $id;
	    		$u->attribute = 'Cleartext-Password';
	    		$u->op = ':=';
	    		$u->value = 'gagatechang';
	    		date_default_timezone_set('Asia/Shanghai');
    			$u->dsttime = date('2020-m-d H:i:s');
	    		$u->save();
	    		return  array('statusCode' => 200);
	    		//return 1;
	    	}
	    }
	    else 
	    {
	    	return array("error" => "no userid");
	    }
	    return array("id"=>$id);
	     
	}  

	public function actionGetuser()
	{

		$id = $_POST["userid"];  
	    if($id)
	    {
	    	$user = User::findOne(['username'=>$id]);
	     	if($user)
	    	{
	    		return  array('statusCode' => 200, 'data'=>$user);
	    	}
	    }
	    else 
	    {
	    	return array("error" => "no userid");
	    }
	    return array("error"=>'no user in db'); 

	}
	public function actionAdduser()
	{  
     	$id = $_POST["userid"];  
	    if($id)
	    {
	    	$user = User::findOne(['username'=>$id]);
	     	if($user)
	    	{
	    		return  array('statusCode' => 200,  'data' => array('user'=>$user));
	    		
	    	}
	    	else 
	    	{
	    		$u = new User();
	    		$u->username = $id;
	    		$u->attribute = 'Cleartext-Password';
	    		$u->op = ':=';
	    		$u->value = 'gagatechang';
	    		date_default_timezone_set('Asia/Shanghai');
    			$u->dsttime = date('2020-m-d H:i:s');
	    		$u->save();
	    		$sql="INSERT INTO radcheck (username, attribute, op, value, dsttime) VALUES('{$id}', 'Cleartext-Password', ':=', 'gagatechang', '{$u->dsttime}')";
	    		$connect1 = \Yii::$app->db2;
	    		$command = $connect1->createCommand($sql);
	    		$command->execute(); 
	    		return  array('statusCode' => 200);
	    		//return 1;
	    	}
	    }
	    else 
	    {
	    	return array("error" => "no userid");
	    }
	    return array("id"=>$id); 
    }  
    public function actionGetserver()
    {
    	$id = $_POST["userid"];  
	    if($id)
	    {
	    	$user = User::findOne(['username'=>$id]);
	     	if($user)
	    	{
	    		$servers = Server::find()->all();
	    		if($servers)
	    			return  array('statusCode' => 200,  'data' => array('server'=>$servers, 'user'=>$user));
	    		else 
	    			return array("error" => "no server in db");
	    	}
	    	else 
	    	{
	    		return array("error" => "no user in db");
	    	}
	    }


    }
    public function actionReport()
	{  
     	$id = $_POST["userid"];  
	    if($id)
	    {
	  
	  		$r = new Report();
	    	$r->username = $id;
	    	date_default_timezone_set('Asia/Shanghai');
    		$r->createtime = date('Y-m-d H:i:s');
	    	$r->save();
	    	return  array('statusCode' => 200);
	    		//return 1;
	    	
	    }
	    else 
	    {
	    	return array("error" => "no userid");
	    }
	   
    }  



}



