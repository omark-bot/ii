<?php
//  //
require('conf.php');
if (!file_exists("token")) {
$token =  readline("- Enter Token : ");
file_put_contents("token", $token);
if (!file_exists("ID")) {
$id = readline("- Enter iD : ");
file_put_contents("ID", $id);
}
}
$TT = file_get_contents("token");
$II = file_get_contents("ID");
$tg = new Telegram($TT);
$lastupdid = 1;
while(true){
$upd = $tg->vtcor("getUpdates", ["offset" => $lastupdid]);
 if(isset($upd['result'][0])){
  $text = $upd['result'][0]['message']['text'];
  $chat_id = $upd['result'][0]['message']['chat']['id'];
$from_id = $upd['result'][0]['message']['from']['id'];
$username = $upd['result'][0]['message']['from']['username'];
$sudo = $II;
if($from_id == $sudo){ 
 if($text == "/start" ){
    $tg->vtcor('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"- اهلا عزيزي .
- يمكنك استخدام الاوامر ادناه للتحكم بلتشيكر .
- - - - -
- BY => @WVWWWQ .",
    'inline_keyboard'=>true,
 'reply_markup'=>json_encode([
      'keyboard'=>[
        [['text'=>'- تثبيت ع معرف .'],['text'=>'- حذف معرف .']],
             [['text'=>'- معلومات التشيكر .'],['text'=>'- عرض لستة المعرفات .']],
             [['text'=>'- تثبيت بقناة جديدة .'],['text'=>'- تثبيت بقناة قديمة .']],
             [['text'=>'- تثبيت بحساب .'],['text'=>'- تثبيت ببوت فاذر .']],
             [['text'=>'- اضافة لستة .'],['text'=>'- حذف كل المعرفات .']],
             [['text'=>'- تشغيل التشيكر .'],['text'=>'- اطفاء التشيكر .']],
             [['text'=>'- تسجيل .']]
      ]	
		]),'resize_keyboard'=>true
	]);
}
if($text == '- تثبيت بقناة قديمة .'){ 
  file_put_contents('type','old');
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- تم وضع التثبيت بقناة قديمة .
-  ارسل معرف القناة القديمه مثل الاسفل .
/old @WVWWWQ", 
]); 
} 
if($text == '- تثبيت بقناة جديدة .'){ 
  file_put_contents('type','new');
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- تم وضع التثبيت بقناة جديدة .", 
]); 
} 
if($text == '- تثبيت بحساب .'){ 
  file_put_contents('type','ac');
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- تم وضع التثبيت بحساب .", 
]); 
} 
if($text == '- تثبيت ببوت فاذر .'){ 
  file_put_contents('type','bo');
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- تم وضع التثبيت ببوت فاذر .", 
]); 
} 
if($text == '- تثبيت ع معرف .'){ 
  $tg->vtcor('sendmessage',[ 
  'chat_id'=>$chat_id,  
  'text'=>"- حسنا ارسل المعرف الان مثل الاسفل .
/Pin @WVWWWQ", 
  ]); 
  } 
  if ($text == "- اضافة لستة .") {
    $tg->vtcor('sendMessage', ['chat_id' => $chat_id, 'text' => "- حسنا ارسل اللستة الان مثل الاسفل .
/add @WVWWWQ\nWVWWWQ"]);
  }
if(preg_match('/\/add .*/', $text)){
$users = explode ("\n",file_get_contents("users"));
$text = str_replace('/add @', '', $text);
if(!in_array($text,$users)){
          $tg->vtcor('sendMessage', ['chat_id' => $chat_id, 'text' => "- تم الاضافة الى اللستة ."]);
          file_put_contents("users", trim("\n$text",""),FILE_APPEND);
      }
}
if($text == '- حذف معرف .'){ 
$tg->vtcor('sendmessage',[ 
'chat_id'=>$chat_id,  
'text'=>"- حسنا ارسل المعرف الان مثل الاسفل .
/UnPin @WVWWWQ", 
]); 
} 
if (preg_match("/\/UnPin @(.*)/", $text)) {
  $user = explode("@", $text) [1];
  $data = str_replace("\n" . $user, "", file_get_contents("users"));
    file_put_contents("users", $data);
    $tg->vtcor('sendMessage', ['chat_id' => $chat_id, 'text' => "- تم حذف المعرف => @$user ."]);
  }
  $se = explode("\n", file_get_contents('users'));
$u = "";
if ($text == "- عرض لستة المعرفات .") {
  for($i=0; $i<count($se); $i++){
$n1 = $i + 1;
$u .= $n1." => @".$se[$i]."\n";
}
  $tg->vtcor('sendMessage', ['chat_id' => $chat_id, 'text' => "- معرفات اللستة . \n$u" ]);
}
if ($text == "- حذف كل المعرفات .") {
  file_put_contents("users", "");
  $tg->vtcor('sendMessage', ['chat_id' => $chat_id, 'text' => "- تم حذف كل المعرفات ."]);
}
$BRoKyes = file_get_contents("run");
if($BRoKyes == 'yes'){
    $BRoKSta = "قيد التشغيل";
}elseif($BRoKyes == 'no'){
    $BRoKSta = "تم الاطفاء";
}
$brokold = file_get_contents("oldchannel");
$type = file_get_contents('type');
if($type == 'old'){
  $broktype = "قناة قديمة";
}elseif($type == 'new'){
  $broktype = "قناة جديدة";
}
elseif($type == 'ac'){
  $broktype = "حساب";
}
elseif($type == 'bo'){
  $broktype = "بوت فاذر";
}
$phone = file_get_contents('phone');
$loops = file_get_contents('loops');
$username = file_get_contents('username');
if($text  == "- معلومات التشيكر ."){ 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"- معلومات التشيكر .
- حالة التشيكر => $BRoKSta .
- القناة القديمة => @$brokold .
- التثبيت في => $broktype .
- الرقم => $phone .
- الضغطات => $loops . 
- المعرف => @$username . 
- - - - - -
- BY => @WVWWWQ .
", 
]); 
}
if(preg_match('/Pin @/', $text )) { 
$ex = explode('/Pin @',$text)[1]; 
file_put_contents("users",$ex); 
$tg->vtcor('sendMessage',[ 
'chat_id'=>$chat_id, 
'text'=>"- تم التثبيت على => @$ex .", 
]); 
} 
if(preg_match('/old @/', $text )) { 
  $brok = explode('/old @',$text)[1]; 
  file_put_contents("oldchannel",$brok); 
  $tg->vtcor('sendMessage',[ 
  'chat_id'=>$chat_id, 
  'text'=>"- تم وضع القناة القديمة => @$brok .", 
  ]); 
  } 
  $type = file_get_contents('type');
if($text == '- تشغيل التشيكر .'){
file_put_contents("run","yes");
if($type == 'old'){
shell_exec('screen -S checker -X kill'); 
shell_exec('screen -dmS checker php checker.php'); 
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"- تم شغيل التشيكر في قناة قديمة .",
]);
}
if($type == 'new'){
  shell_exec('screen -S new -X kill'); 
shell_exec('screen -dmS new php new.php'); 
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"- تم تشغيل التشيكر في قناة جديدة .",
]);
}
if($type == 'ac'){
  shell_exec('screen -S ac -X kill'); 
shell_exec('screen -dmS ac php ac.php'); 
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"- تم تشغيل التشيكر في حساب .",
]);
}
if($type == 'bo'){
  shell_exec('screen -S bo -X kill'); 
shell_exec('screen -dmS bo php bo.php'); 
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"- تم تشغيل التشيكر في بوت فاذر .",
]);
}
}
if($text == '- اطفاء التشيكر .'){
  file_put_contents('run','no');
  if($type == 'old'){
    shell_exec('screen -S checker -X kill'); 
    $tg->vtcor('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"- تم ايقاف التشيكر .",
    ]);
    }
    if($type == 'new'){
      shell_exec('screen -S new -X kill'); 
    $tg->vtcor('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"- تم ايقاف التشيكر .",
    ]);
    }
    if($type == 'ac'){
      shell_exec('screen -S ac -X kill'); 
    $tg->vtcor('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"- تم ايقاف التشيكر .",
    ]);
    }
    if($type == 'bo'){
      shell_exec('screen -S bo -X kill'); 
    $tg->vtcor('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"- تم ايقاف التشيكر .",
    ]);
    }
}
if($text == '- تسجيل .'){
	system('rm -rf *m*');
file_put_contents("step","");
if(file_get_contents("step") == ""){
$tg->vtcor('sendmessage',[
'chat_id'=>$chat_id, 
'text'=>"- حسنا ارسل رقم الهاتف الان .
- مثل => +964**********",
]);
file_put_contents("step","2");
  system('php g.php');

}
}
}
$lastupdid = $upd['result'][0]['update_id'] + 1; 
}
}