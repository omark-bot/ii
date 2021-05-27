<?php
// K //
date_default_timezone_set("Asia/Baghdad");
  if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
  }
  define('MADELINE_BRANCH', 'deprecated');
  include 'madeline.php';
  $settings['app_info']['api_id'] = 579315;
  $settings['app_info']['api_hash'] = '4ace69ed2f78cec268dc7483fd3d3424';
  $MadelineProto = new \danog\MadelineProto\API('BROK.madeline', $settings);
  $MadelineProto->start();
function bot($method, $datas = []) {
	$token = file_get_contents("token");
	$url = "https://api.telegram.org/bot$token/" . $method;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$res = curl_exec($ch);
	curl_close($ch);
	return json_decode($res, true);
}
$type = file_get_contents('type');
if($type == 'new'){
  $updates = $MadelineProto->channels->createChannel(['broadcast' => true, 'megagroup' => false, 'title' => "- SOFE .", 'about'=>"- SOFE => @WVWWWQ .", ]);
  $ch = $updates['updates'][1];
}
    $x = 0;
while(1){
    $users = explode("\n",file_get_contents("users"));
    foreach($users as $user){
        if($user != ""){
            try{
            	$MadelineProto->messages->getPeerDialogs(['peers' => [$user]]);
                          $x++;
                          file_put_contents('loops',$x);
                          file_put_contents('username',$user);
            } catch (\danog\MadelineProto\Exception | \danog\MadelineProto\RPCErrorException $e) {
                    try{
                      $MadelineProto->channels->updateUsername(['channel' =>$ch, 'username' => $user, ]);
                        $phone = file_get_contents('phone');
                        $end_time = date("m/d h:i:s");
bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' => "- Hi Bro, Updated Done .\n- UsreName => @$user .\n- Number of Clicks => $x .\n- Updated on => New Channel .\n- Time => $end_time .\n- Phone => $phone .\n- BY => @WVWWWQ ."]);
file_put_contents("run","no");
$data = str_replace("\n".$user,"", file_get_contents("users"));
                        file_put_contents("users", $data);
                        exit;
                    }catch(Exception $e){
                            bot('sendMessage', ['chat_id' => file_get_contents("ID"), 'text' =>  "- @$user => ".$e->getMessage()
]);
file_put_contents("run","no");
exit;
                        }

  
                    }
	        }
        }
    }