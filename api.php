<?php 
include_once "Controller/config.php";
$url = trim($_POST['smallurl']);
if($url)
{
	$returndata = duanwangzhi();	
	$times = $returndata[0];
	$tbname='short_url_tb';
	if($times>1495814400000)
	{
		$tbname= 'short_url_'.date('Ymd', substr($times, 0, 10)).'_tb';
	}
	$sql = "insert into ".$tbname." (su_url,su_key,su_time) values('$url','$returndata[1]','$returndata[0]')";

	$a =  $connection->query($sql);
    mysqli_close($connection); 
	if (!$a)
	{
		$s = array(
			'code'=>'1002',
			'src'=>'添加失败',
			'url'=>'',
            'key'=>$returndata[1],
		);
		echo json_encode($s);exit;
	}
	else
	{
		$s = array(
			'code'=>'1001',
			'src'=>'添加成功',
			'url'=>'http://00o.cn/'.$returndata[1],
		);
		echo json_encode($s);exit;
	}
}
function getMillisecond() {
	return time().substr (microtime(),2,3);
}
function duanwangzhi()
{	
	$timenum2=getMillisecond();
	if(strlen($timenum2)<13)
	{
		return duanwangzhi();
	}
        $timenum=$timenum2;
	$k ='wjgW5EaRedTYmU1tIcOsbPqfLx4KJQ2khHn9vGFz3Drlu76SAZ0XoCyVpB8NiM';
	$knum = strlen($k);
	$arr = array(0,0,0,0,0,0,0);
	for($i=0;$i<count($arr);$i++)
	{
		$num = pow($knum,(count($arr)-$i-1));
		$arr[$i] = intval($timenum/$num);
		$timenum = $timenum-($arr[$i]*$num);
	}
	$tempstr = '';
	foreach	($arr as $ks=>$v)
	{
		$tempstr .= substr($k,($v),1);
	}
	$returndata[]=$timenum2;
	$returndata[]=$tempstr;
	return $returndata;
}

 ?>