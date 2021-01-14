<?php
function send($action, $params, $posts = false){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $getData = http_build_query($params);
    $postData = "clientSecretKey=b76a317bc3a3dd8dcce56bced1d5789a0b56694908301d48685d1e65023004ef";            ////Replace the caps CLIENT_SECRET_KEY with your video id.
    if ($posts) {
		$postData .= "&". $posts;
	}
    curl_setopt($curl, CURLOPT_POST, true); 
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    $url = "http://api.vdocipher.com/v2/$action/?$getData";
    curl_setopt($curl, CURLOPT_URL,$url);
    $html = curl_exec($curl);
    curl_close($curl);
    return $html;
}

function vdo_play($id){
	$posts = false;
    
	// Uncomment this section to add annotation
	
	/*
	$annoData = "[".
	  "{'type':'image', 'url':'http://localhost/in5minutes/images/logo.png', 'alpha':'0.8', 'x':'100','y':'200'},".
	  "{'type':'text', 'text':'static text', 'alpha':'0.5' , 'x':'10', 'y':'100', 'co    lor':'0xFF0000', 'size':'12'}".
	  "]";
    $posts = "annotate=". urlencode($annoData);
	*/
        $email_id ='';
        $name = '';
        $ipaddr = '';
         $CI=& get_instance();
  if($CI->session->userdata('in5minutes')){
      $userdata = $CI->session->userdata('in5minutes');
      $all_userdata = $CI->session->all_userdata();
      $session_id = $all_userdata['session_id'];
      $email_id = $userdata['emailid'];
      $name =   $userdata['first_name'];
      $mobile_number =  $userdata['mobile'];
      $ipaddr = $userdata['in5minutescheck']['ip_address'];
      $old_mobile = '';
      if($userdata['mobile_cnt']>0){
            $old_mobile = $userdata['old_mobile'];
        }
      
  } 
   $annoData = "[".
           "{'type':'rtext', 'text':'".$ipaddr."', 'alpha':'0.8', 'color':'0xFF0000', 'size':'12','interval':'5000'},".
           "{'type':'rtext', 'text':'".$session_id."', 'alpha':'0.8', 'color':'0xFF0000', 'size':'12','interval':'5000'},".
	   "{'type':'rtext', 'text':'".$email_id."', 'alpha':'0.8', 'color':'0xFF0000', 'size':'12','interval':'5000'},".
	   "{'type':'rtext', 'text':'".$mobile_number."', 'alpha':'0.8', 'color':'0xFF0000', 'size':'12','interval':'5000'},".
	   "{'type':'rtext', 'text':'".$old_mobile."', 'alpha':'0.8', 'color':'0xFF0000', 'size':'12','interval':'5000'}".
	  "]";
   
   $posts = "annotate=". urlencode($annoData);
  
    $OTP = send("otp", array(
        'video'=>$id
    ), $posts);
    
    
    if(isset($OTP) )
    {
     $OTP = json_decode($OTP)->otp; }else { return false;}
	echo <<<EOF
<div id="vdo$OTP" style="height:500px;max-width:100%;">
</div>

	<script>
	(function(v,i,d,e,o){v[o]=v[o]||{}; v[o].add = v[o].add || function V(a){ (v[o].d=v[o].d||[]).push(a);};
	if(!v[o].l) { v[o].l=1*new Date(); a=i.createElement(d), m=i.getElementsByTagName(d)[0];
	a.async=1; a.src=e; m.parentNode.insertBefore(a,m);}
	})(window,document,'script','//de122v0opjemw.cloudfront.net/vdo.js','vdo');
	vdo.add({
		o: "$OTP",
	});
</script>
EOF;
}