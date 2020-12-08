<?php include("_init.php"); 
$manages_model = registry()->get('loader')->model('manages');

if($_GET['action_type']== 'reg'){

	$manages_model->update_admin($_POST['username'],$_POST['password'],$_POST['email']);

		echo json_encode(array('status'=>'success'));
}
