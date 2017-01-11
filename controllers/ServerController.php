<?php
namespace app\controllers;
use app\models\User;
use yii\rest\ActiveController;

class ServerController extends ActiveController
{
    public $modelClass = 'app\models\Server';

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
	  


	public function actionGetserver()
	{

		$id = $_POST["userid"];  
	    if($id)
	    {
	    	$servers = Server::findAll();
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



}



