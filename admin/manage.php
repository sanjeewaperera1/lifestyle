<?php    
	ob_start();
    session_start();
    include realpath(__DIR__.'/../').'/_init.php';
    if (!is_loggedin()) {
      redirect(root_url() . '/index.php?redirect_to=' . url());
    }


?>
<!DOCTYPE html>
<html>
<head>
  
  <title>Pos System Actiovation</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>      
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
 <div class="container">

<?php
    //print_r()
    $user_model = registry()->get('loader')->model('user');
    $manages_model = registry()->get('loader')->model('manages');
    $key =  $user_model->getUser(1);
    $get_key =  $manages_model->getManage(); 
    $current_key = $get_key['current_key'];
    $ownemail = $key['email'];
    $encryption =$current_key;
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering); 
    $options = 0; 
    $decryption_iv = '1234567891011121'; 
    $decryption_key = "GeeksforGeeks"; 
    $decryption=openssl_decrypt ($encryption, $ciphering,  
    $decryption_key, $options, $decryption_iv); 
    $keyeyyy = explode("guess",$decryption);
    $date1 = date('Y-m-d');
    $diff = abs(strtotime($keyeyyy[0]) - strtotime($date1));
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    //echo $days; die();
    if(($days < 1 && $months != 1) || $current_key== "" || $keyeyyy[1] != $ownemail){ ?>

    <div class="modal fade" id="myModal" role="dialog" data-keyboard="false" data-backdrop="static"> <div class="modal-dialog"> <div class="modal-content" style="
    background: #333333;
    color: aliceblue;
"> <div class="modal-header"> <h4 class="modal-title" style="margin-bottom: 0; line-height: 1.5; font-family: fantasy; font-size: large;">Please enter a key to activate system</h4> </div><div class="modal-body"> <div class="row"><div class="col-md-2" style=" display: inline-block; "> <i class="fa fa-key fa-3x" aria-hidden="true"></i> </div><div class="col-md-8" style=" display: inline-block; "> <input type="text" class="form-control required" placeholder="ENTER KEY" id="key" name="key" maxlength="128"> </div></div><div class="row"><h4 id="msg-err" style=" font-family: fantasy; color: red; margin-top: 7px; text-align: center; "></h4> <h4 id="msg-success" style="font-family: fantasy;color: green;margin-top: 7px;text-align: center;"></h4> <h4 id="msg-redirect" style="font-family: fantasy;color: green;margin-top: 7px;text-align: center;"></h4> <div></div></div><div class="modal-footer"> <button type="button" class="btn btn-primary save-key">Save</button> </div></div></div></div>

    <?php }elseif($days < 7 && $months == 0){


    ?>
    <div class="modal fade" id="myModal" role="dialog" data-keyboard="false" data-backdrop="static"> <div class="modal-dialog"> <div class="modal-content" style="
    background: #333333;
    color: aliceblue;
"> <div class="modal-header"> <h4 class="modal-title" style="margin-bottom: 0; line-height: 1.5; font-family: fantasy; font-size: large;">Notification</h4> </div><div class="modal-body"><div class="row"> <h4 id="ntice" style="font-family: fantasy; margin-top: 7px;text-align: center;">You have <?php echo $days ?> days remaining to renew activation key!</h4> <h4 id="ntice" style="font-family: fantasy; margin-top: 7px; color: red;text-align: center;">Give us call for a new activation key @ 0779464692</h4></div><div class="row"> <div class="col-md-2" style=" display: inline-block; "> <i class="fa fa-key fa-3x" aria-hidden="true"></i> </div><div class="col-md-8" style=" display: inline-block; "> <input type="text" class="form-control required" placeholder="ENTER NEW KEY" id="key" name="key" maxlength="128"> </div> </div><h4 id="msg-err" style=" font-family: fantasy; color: red; margin-top: 7px; text-align: center; "></h4> <h4 id="msg-success" style="font-family: fantasy;color: green;margin-top: 7px;text-align: center;"></h4> <h4 id="msg-redirect" style="font-family: fantasy;color: green;margin-top: 7px;text-align: center;"></h4></div><div class="modal-footer"> <button type="button" class="btn btn-primary save-key">Save</button><button type="button" class="btn btn-default" onclick="redirect()">Close</button> </div></div></div>   

    <?php }else{
      redirect(root_url() . '/admin/dashboard.php');

      
    }


?>

</div>

</body>
</html>


  <script>


  	function redirect(){


  		window.location.href="dashboard.php?redir";
  	}
    
    $('#myModal').modal('show');
    $('#myModal').modal({backdrop: 'static', keyboard: false});


$('body').on('click','.save-key', function(){
    $('#msg-err').text("");
    $('#msg-success').text("");
    $('#msg-redirect').text("");

    var id = $('#key').val();
    $.ajax({

       type:'POST',
       url:'./ajax.php',
        data: {"id":id},       
        success: function(data){
            
        var response  = JSON.parse(data);           
            if(response.msg == "unsuccess") {
             
             $('#msg-err').text("This activation key is Invalid!");
             
            }else{
             
             $('#msg-success').text("Thanks for successful activation.");
             $('#msg-redirect').text("Please wait while we redirecting you on Dashboard");   
            setTimeout(function(){      window.location.href="dashboard.php?redir";  }, 3000);
             
                
             
             
            }
            
       }
        
    });  
    
});
</script>