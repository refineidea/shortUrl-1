<?php
include_once "Controller/config.php";
error_reporting(0);
$agent=$_SERVER["HTTP_USER_AGENT"];
$android   =   'Android';
$ios       =   'iPhone';
$wx        =   'MicroMessenger';
$pos    =   strpos($agent,$android);
$poss   =   strpos($agent,$ios); 
$wxw    =   strpos($agent,$wx);
$shortUrl=  '';
if($wxw===false)
{
	if($_GET['s'])
	{

		$url = $_GET['s'];
		if(strlen($url)!=7)
		{
			echo '错误参数！';exit;
		}
		$times = nu($url);
		$tbname='short_url_tb';
		if($times>1495814400000)
		{
			$tbname= 'short_url_'.date('Ymd', substr($times, 0, 10)).'_tb';
		}
		$query = "select su_url,su_id from ".$tbname." where su_time = $times and su_key = '$url' limit 1";
		$c = $connection->query($query);
		$iskey = mysqli_fetch_array($c);
		if(!$iskey)
		{
			echo 'error';exit;
		}
		$isid = $iskey['su_id'];
		$isurl = $iskey['su_url'];
		$sql    = "update ".$tbname." set su_clicknum=su_clicknum+1"." where su_id = '$isid'";
		$connection->query($sql);
        mysqli_close($connection);
        $shortUrl   =   $isurl;
		//header("Location: $isurl");
	}
	else
	{
		echo '参数错误';exit;
	}
}
else
{
	if($pos === false)
	{      
		if($poss === false)
		{
			if($_GET['s'])
			{
				$url = $_GET['s'];
				if(strlen($url)!=7)
				{
					echo '错误参数！';exit;
				}
				$times = nu($url);
				$tbname='short_url_tb';
				if($times>1495814400000)//1495814400000    1495728000000
				{
					$tbname= 'short_url_'.date('Ymd', substr($times, 0, 10)).'_tb';
				}
				$query = "select su_url,su_id from ".$tbname." where su_time = $times and su_key = '$url' limit 1";
				$c = $connection->query($query);
				$iskey = mysqli_fetch_array($c);
				if(!$iskey)
				{
					echo 'error';exit;
				}
				$isid = $iskey['su_id'];
				$isurl = $iskey['su_url'];


				$sql    = "update ".$tbname." set su_clicknum=su_clicknum+1"." where su_id = '$isid'";
				$connection->query($sql);
                mysqli_close($connection); 
				//header("Location: $isurl");
                $shortUrl   =   $isurl;
			}
			else
			{
				echo '参数错误';exit;
			}
		}
		else
		{
			//echo '<div class="mark">
//					<div class="ios"></div>
//				</div>';
		}
	}
	else
	{
		//echo '<div class="mark">
//			<div class="android"></div>
//		</div>';
	}
}


function nu($l)
{
	$k ='wjgW5EaRedTYmU1tIcOsbPqfLx4KJQ2khHn9vGFz3Drlu76SAZ0XoCyVpB8NiM';
	$knum = strlen($k);
	$f1 = substr($l,0,-1);
	$f = substr($l,6);
	$e1 = substr($f1,0,-1);
	$e = substr($f1,5);
	$d1 = substr($e1,0,-1);
	$d = substr($e1,4);
	$c1 = substr($d1,0,-1);
	$c = substr($d1,3);
	$b1 = substr($c1,0,-1);
	$b = substr($c1,2);
	$a1 = substr($b1,1);
	$a = substr($b1,0,-1);
	if($a=='x')
	{
		$f1 = strpos($k, $a)+1;
		$f2 = strpos($k, $a1)+1;
		$f3 = strpos($k, $b)+1;
		$f4 = strpos($k, $c)+1;
		$f5 = strpos($k, $d)+1;
		$f6 = strpos($k, $e)+1;
		$f7 = strpos($k, $f)+1;
	}
	else
	{
		$f1 = strpos($k, $a);
		$f2 = strpos($k, $a1);
		$f3 = strpos($k, $b);
		$f4 = strpos($k, $c);
		$f5 = strpos($k, $d);
		$f6 = strpos($k, $e);
		$f7 = strpos($k, $f);
	}

	$arr = array($f1,$f2,$f3,$f4,$f5,$f6,$f7);
	//print_r($arr);
	$isnum = '';
	for($i=0;$i<count($arr);$i++)
	{
		$num =  pow($knum,(count($arr)-$i-1));
		$z[$i] = $num * $arr[$i];
		if($i!=0)
		{
			$isnum +=$z[$i];
		}
	}
	$num2 =  pow($knum,(count($arr)-1));
	$p = $isnum+($arr[0]*$num2);
	return $p;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">     
	<meta content="yes" name="apple-mobile-web-app-capable">     
	<meta content="black" name="apple-mobile-web-app-status-bar-style">     
	<meta content="telephone=no" name="format-detection">
	<script type="text/javascript" src="/jquery-1.11.0.min.js"></script>
	<!--<link rel="stylesheet" href="/index/css/style.css">-->
	<title>生成文案</title>
    <style>
html, body {
    background-color:#f2523f ;
    background-size:cover;
    background-repeat:no-repeat;
    background-position:0% -10%;
}
</style>
	
	
</head>


<body>
	<script>

    $(function(){
    var ua = navigator.userAgent.toLowerCase(); 
    if(ua.match(/MicroMessenger/i) == "micromessenger") {
        if (ua.match(/iphone/i) == "iphone" || ua.match(/ipad/i) == "ipad") {
            $(".safari_top").css("display", "block");
            $("#go_tip").attr("src", "https://img.alicdn.com/imgextra/i1/379137982/TB2GMpLq3RkpuFjy1zeXXc.6FXa_!!379137982.png");
        }else{
            $(".safari_top").css("display", "block");
            $("#go_tip").attr("src", "https://img.alicdn.com/imgextra/i3/379137982/TB2rcSMuohnpuFjSZFEXXX0PFXa_!!379137982.png");
        }
    }else{
            window.location.href =  '<?php echo $isurl;?>';
    } 
    });

</script> 

<img id="go_tip" style="width:100%" />
</body>
</html>
	

