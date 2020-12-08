  <?php 

include realpath(__DIR__.'/../').'/_init.php';


$user_model = registry()->get('loader')->model('user');
$manages_model = registry()->get('loader')->model('manages');
$key =  $user_model->getUser(1);
$ownemail = $key['email'];
$encryption =$_POST['id'];
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$decryption_iv = '1234567891011121'; 
$decryption_key = "GeeksforGeeks"; 
$decryption=openssl_decrypt ($encryption, $ciphering,  
$decryption_key, $options, $decryption_iv); 


$keyeyyy = explode("guess",$decryption);

if(count($keyeyyy) ==2){

if($keyeyyy[1]== $ownemail){

    $date1 = date('Y-m-d h:i:s');
    $diff = abs(strtotime($keyeyyy[0]) - strtotime($date1));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

if($months == 1 || $days > 0){
    
    $manages_model->manageUpdate($encryption);    
    echo json_encode(array('msg'=> 'success'), 200);
  
  
}else{
  
  
    $msg = "This is a simple message.";
    echo json_encode(array('msg'=> 'unsuccess'), 200);            
  
}


}else{

    $msg = "This is a simple message.";
    echo json_encode(array('msg'=> 'unsuccess'), 200);            

}

}else{
    $msg = "This is a simple message.";
    echo json_encode(array('msg'=> 'unsuccess'), 200);            

}
            
            
           
       

//    public function registration() {   

//         $email =  $_POST['email'];
//         $password =  Hash::make($_POST['password']);
//         $name = $_POST['name'];

//         $affected = DB::table('users')
//         ->where('email','owner@pos.codehas.com')
//         ->update(['name'=>$name,'email' => $email,'password'=>$password,'status'=>1] );

//         if($affected){

          

//              return redirect()->route('login'); 

//         }else{

//              return redirect()->route('login'); 

//         }                           
             
//    }   

?>