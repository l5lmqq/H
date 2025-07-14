<?php
$API_KEY = "8185742350:AAGmzwmO7Diojr6pYjWCzMDxE_riRJkr4g4";
$API_USER = json_decode(file_get_contents("https://api.telegram.org/bot$API_KEY/getme"))->result->username;
$SET = array($API_KEY, $API_ID, $API_USER);
$API_ID = explode(":",$API_KEY)[0]; 
$GET = array("API_KEY", "API_ID,", "API_USER") ;

$define = array_combine($GET, $SET);

foreach ($define as $BeRo => $P) {
    define($BeRo, $P);
}

echo file_get_contents("https://api.telegram.org/bot" . API_KEY . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME']);
error_reporting(0);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    } 
}
$VipBero = json_decode(file_get_contents("VipBero.json"),true);

// الخزن
function SETJSON($Input){
	
  if($Input != NULL || $Input != ""){
  file_put_contents("VipBero.json",json_encode($Input,32|128|265));
  }
  
}
$update = json_decode(file_get_contents('php://input'));
$message= $update->message;
$text = $message->text;
$chat_id= $message->chat->id;
$message_id = $update->message->message_id;
$from_id = $update->message->from->id;
$name = $message->from->first_name;
if($update->callback_query){
$data = $update->callback_query->data;
$chat_id = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$name = $update->callback_query->message->chat->first_name;
$from_id = $update->callback_query->from->id;
}

$AdMin = 726154978;
$start_msg = "
🔖| اهلا بك عزيزي المطور الاساسي
" ;

if($from_id == $AdMin) {
if($text == "/start") {
	$VipBero["meAT"][$chat_id]= null;
		SETJSON($VipBero) ; 
	bot('sendmessage', [
                'chat_id' => $chat_id,
                "text" => $start_msg, 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode([
    'inline_keyboard' => [
        [['text' => '- اضف اشتراك 💸', 'callback_data' => 'addShtrak' ], ['text' => '- حذف اشتراك 📌', 'callback_data' => 'delShtrak' ]], 
        [['text' => '- الاشتراكات 💠', 'callback_data' => 'shtraks' ], ['text' => '- حذف كل المشتركين ⚠️', 'callback_data' => 'delall' ]], 
    ]
])
            ]); return false ;
	} 
	
	if($data == "backcell") {
		$VipBero["meAT"][$chat_id]= null;
		SETJSON($VipBero) ; 
		bot('editMessagetext', [
                'chat_id' => $chat_id,
                'message_id' => $message_id ,
                'chat_id' => $chat_id,
                "text" => $start_msg, 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode([
    'inline_keyboard' => [
        [['text' => '- اضف اشتراك 💸', 'callback_data' => 'addShtrak' ], ['text' => '- حذف اشتراك 📌', 'callback_data' => 'delShtrak' ]], 
        [['text' => '- الاشتراكات 💠', 'callback_data' => 'shtraks' ], ['text' => '- حذف كل المشتركين ⚠️', 'callback_data' => 'delall' ]], 
    ]
])
            ]) ; return false ;
            
		} 
		
		if($data == "delall") {
		$VipBero["meAT"][$chat_id]= null;
		SETJSON($VipBero) ; 
		bot('editMessagetext', [
                'chat_id' => $chat_id,
                'message_id' => $message_id ,
                'chat_id' => $chat_id,
                "text" => "❓| هل انت متأكد من حذف جميع الاشتراكات" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode([
    'inline_keyboard' => [
        [['text' => '- نعم ⏺️', 'callback_data' => 'delal' ], ['text' => '- لا 📌', 'callback_data' => 'backcell' ]], 
        [['text' => '🔘| رجوع', 'callback_data' => 'backcell' ]],
    ]
])
            ]) ; return false ;
            
		} 
		
		if($data == "delal") {
		$VipBero["shtrak"]= null;
		$VipBero["time"] = null ;
		SETJSON($VipBero) ; 
		bot('editMessagetext', [
                'chat_id' => $chat_id,
                'message_id' => $message_id ,
                'chat_id' => $chat_id,
                "text" => "♻️| تم حذف جميع الاشتراكات وبدهم من جديد" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode([
    'inline_keyboard' => [
        [['text' => '🔘| رجوع', 'callback_data' => 'backcell' ]],
    ]
])
            ]) ; return false ;
            
		} 
	
	if($data == "shtraks") {
		$co = 0;
		$VipBero["shtrak"] = array_unique($VipBero["shtrak"]);
		foreach ( $VipBero["shtrak"] as $mshtrk) {
			if($mshtrk != null) {
				if (strtotime($VipBero["time"][$mshtrk]) >= time()) {
				$co +=1;
				$MSG = "المشتركين اامدفوعين في البوت" ;
				$ms = $ms. "\n [$mshtrk](tg://user?id=$mshtrk)" ;
				} else {
					$msg2 = "- ⚠️| المنتهي صلاحيه اشتراكهم" ;
					$ms2 = $ms2. "\n [$mshtrk](tg://user?id=$mshtrk)" ;
					} 
				} else {
					$MSG = "لايوجد مشتركين مدفوعين" ; 
					} 
			} 
			if($MSG == null) { $MSG =" لايوجد مشتركين مدفوعين";} 
		bot('editMessagetext', [
                'chat_id' => $chat_id,
                'message_id' => $message_id ,
                "text" => "⏺️| $MSG\n$ms\n\n$msg2\n$ms2" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode([
    'inline_keyboard' => [
        [['text' => '🔘| رجوع', 'callback_data' => 'backcell' ]],
    ]
])
            ]); 
            $VipBero["meAT"][$chat_id]= null;
		SETJSON($VipBero) ; 
		} 
	
	if($data == "addShtrak") {
		bot('editMessagetext', [
                'chat_id' => $chat_id,
                'message_id' => $message_id ,
                "text" => "⏺️| ارسل ايدي الشخص الان" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode([
    'inline_keyboard' => [
        [['text' => '🔘| رجوع', 'callback_data' => 'backcell' ]],
    ]
])
            ]); 
            $VipBero["meAT"][$chat_id]= "addShtrak";
		SETJSON($VipBero) ; 
		} 
		
		if($data == "delShtrak") {
		bot('editMessagetext', [
                'chat_id' => $chat_id,
                'message_id' => $message_id ,
                "text" => "⏺️| ارسل ايدي الشخص الان" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode([
    'inline_keyboard' => [
        [['text' => '🔘| رجوع', 'callback_data' => 'backcell' ]],
    ]
])
            ]); 
            $VipBero["meAT"][$chat_id]= $data ;
		SETJSON($VipBero) ; 
		} 
		if($text and $VipBero["meAT"][$chat_id] == "delShtrak") {
			if(is_numeric($text)) {
        $K['inline_keyboard'][] = [['text' => '🔘| رجوع', 'callback_data' => "backcell" ]];

				bot('sendmessage', [
                'chat_id' => $chat_id,
                "text" => "▶️| العضو [$text](tg://user?id=$text) تم حذف اشتراكه" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode($K), 
            ]); 
            $date = date('Y-m-d');
$fg = date('Y-m-d', strtotime($date . " - 1 days"));
            $VipBero["time"][$text] = $fg;
            $VipBero["meAT"][$chat_id]= null;
            SETJSON($VipBero) ; 
				} 
			} 
		
		$data_=explode("|", $data) ;
		
		if($text and $VipBero["meAT"][$chat_id] == "addShtrak") {
			if(is_numeric($text)) {
				$VipBero["meAT"][$chat_id]= null;
				SETJSON($VipBero) ; 
				$K = ['inline_keyboard' => []];
        for($i=1;$i<30;$i++){
            $K['inline_keyboard'][] = [['text' => $i. " يوم" , 'callback_data' => "addday|$text|$i" ]];
        }
        $K['inline_keyboard'][] = [['text' => '🔶| نضام شهري', 'callback_data' => "month|$text" ]];
        $K['inline_keyboard'][] = [['text' => '🔘| رجوع', 'callback_data' => "backcell" ]];

				bot('sendmessage', [
                'chat_id' => $chat_id,
                "text" => "▶️| اختر الان الاشهر او الايام لمده الاشتراك لـ [$text](tg://user?id=$text)" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode($K), 
            ]); 
				} 
			} 

if($data_[0] == "month") {
	$text = $data_[1];
	$K = ['inline_keyboard' => []];
        for($i=1;$i<13;$i++){
            $K['inline_keyboard'][] = [['text' => $i. " شهر" , 'callback_data' => "addmonth|$text|$i" ]];
        }
        $K['inline_keyboard'][] = [['text' => '🔶| نضام اليومي', 'callback_data' => "days|$data_[1]" ]];
        $K['inline_keyboard'][] = [['text' => '🔘| رجوع', 'callback_data' => "backcell" ]];

				bot('editMessagetext', [
                'chat_id' => $chat_id,
                'message_id' => $message_id,
                "text" => "▶️| اختر الان الاشهر لتاريخ اشتراك [$data_[1]](tg://user?id=$data_[1])" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode($K), 
            ]); 
	} 
	
	if($data_[0] == "days") {
		$text = $data_[1];
	$K = ['inline_keyboard' => []];
        for($i=1;$i<30;$i++){
            $K['inline_keyboard'][] = [['text' => $i. " يوم" , 'callback_data' => "addday|$text|$i" ]];
        }
        $K['inline_keyboard'][] = [['text' => '🔶| نضام شهري', 'callback_data' => "month|$text" ]];
        $K['inline_keyboard'][] = [['text' => '🔘| رجوع', 'callback_data' => "backcell" ]];

				bot('editMessagetext', [
                'chat_id' => $chat_id,
                'message_id' => $message_id,
                "text" => "▶️| اختر الان الاشهر او الايام لمده الاشتراك لـ [$text](tg://user?id=$text)" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode($K), 
            ]); 
	} 
	
	date_default_timezone_set('Asia/Baghdad');
 
	if($data_[0] == "addday" || $data_[0] == "addmonth" ) {
		if($data_[0] == "addmonth") { $nm = "اشهر" ; $y = true;} else { $nm = "ايام" ; $y = false;} 
		$text = $data_[1];
		$K['inline_keyboard'][] = [['text' => 'ℹ️| تعيين نوع الاشتراك', 'callback_data' => "set|$text" ]];
        $K['inline_keyboard'][] = [['text' => '🔘| رجوع', 'callback_data' => "backcell" ]];
if($y == true) {
	$date = date('Y-m-d');
$time = date('Y-m-d', strtotime($date . " + $data_[2] months"));
			$VipBero["shtrak"][]= $text ;
$VipBero["time"][$text]= $time ;
		SETJSON($VipBero) ; 
		} else {
			$date = date('Y-m-d');
$time = date('Y-m-d', strtotime($date . " + $data_[2] days"));
			$VipBero["shtrak"][]= $text ;
			
			$VipBero["time"][$text]= $time ;
		SETJSON($VipBero) ; 
			} 
		
				bot('editMessagetext', [
                'chat_id' => $chat_id,
                'message_id' => $message_id,
                "text" => "▶️| تم اضافه الاشتراك المدفوع الي [$text](tg://user?id=$text) \n 🧾| المده $data_[2] : $nm" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode($K), 
            ]); 
	} 
	
	if($data_[0] == "set") {
		$text = $data_[1];
        $K['inline_keyboard'][] = [['text' => '🔘| رجوع', 'callback_data' => "backcell" ]];

				bot('editMessagetext', [
                'chat_id' => $chat_id,
                'message_id' => $message_id,
                "text" => "▶️| ارسل الان نوع الاشتراك مثلا *اشتراك بوت زخرفه* لـ [$text](tg://user?id=$text)" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
                'reply_markup' => json_encode($K), 
            ]); 
            $VipBero["meAT"][$chat_id]= $data_[0];
            $VipBero["to"][$chat_id]= $text ;
		SETJSON($VipBero) ; 
	} 

if($text and $VipBero["meAT"][$chat_id] == "set") {
	if(!$data) {
	
		
	bot('sendmessage', [
                'chat_id' => $chat_id,
                "text" => "
⏺️| تم حفظ نوع الاشتراك
▶️| الي [". $VipBero["to"][$chat_id]. "](tg://user?id=". $VipBero["to"][$chat_id]. ") 
ℹ️| النوع : $text 
" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
            ]); 
            $VipBero["meAT"][$chat_id]= null ;
            
            $VipBero["type"][$VipBero["to"][$chat_id]]= $text ;
            
            $VipBero["to"][$chat_id]= null ;
            SETJSON($VipBero) ;  
           } 
	} 
	
	return false ;
}


    
if($update) {
	
	if(in_array($from_id, $VipBero["shtrak"])) {
		if (strtotime($VipBero["time"][$from_id]) >= time()) {
			if($VipBero["type"][$from_id] !=null) { $SD = "▪️| نوع اشتراكك :". $VipBero["type"][$from_id] ;} 
		bot('sendmessage', [
                'chat_id' => $chat_id,
                "text" => "
⏺️| مرحبا بك عزيزي 
💠| انت من المشتركين المدفوعين في البوت
$SD
⚠️| تاريخ انتهاء الاشتراك : *". $VipBero["time"][$from_id]. "*
" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
            ]); 
           } else {
           	$VipBero["msg_id"][$from_id]= $message_id - 1;
	SETJSON($VipBero) ;  
	bot('deleteMessage', [
                'chat_id' => $chat_id,
                'message_id' => $VipBero["msg_id"][$from_id], 
            ]);  
           	bot('sendmessage', [
                'chat_id' => $chat_id,
                "text" => "
⏺️| الاشتراك المدفوعه لديك انتهت صلاحيته
⚠️| الرجاء تجديد الاشتراك لاستخدام البوت
" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
            ]); return false ;
          } 
		} else {
			bot('sendmessage', [
                'chat_id' => $chat_id,
                "text" => "
🔰| مرحبا بك عزيزي هذا بوت مدفوع
💠| يمكنك الاشتراك في البوت والاستمتاع في مميزات البوت
" , 
                "parse_mode" => "markdown", 
                'reply_to_message_id' => $message_id, 
            ]); return false ;
			} 
	}
	