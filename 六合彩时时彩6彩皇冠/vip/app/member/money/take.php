<?
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");      
header("Pragma: no-cache");
header("Content-type: text/html; charset=utf-8");
include "../include/address.mem.php";
require ("../include/config.inc.php");
require ("../include/define_function_list.inc.php");

$uid=$_REQUEST["uid"];
$langx=$_REQUEST["langx"];
$user=$_REQUEST["user"];
$phone=$_REQUEST["Phone"];
$contact=$_REQUEST["Contact"];
$notes=$_REQUEST["Notes"];
$money=$_REQUEST["Money"];
$bank_account=$_REQUEST["Bank_Account"];
$bank_Address=$_REQUEST["Bank_Address"];
$bank=$_REQUEST["Bank"];
$key=$_REQUEST["Key"];
$adddate=date("Y-m-d");
$date=date("Y-m-d H:i:s");
if ($user==''){
    $sql = "select * from web_member_data where Oid='$uid' and Status=0";
}else{
	$sql = "select * from web_member_data where UserName='$user'";
}
$result = mysql_db_query($dbname,$sql);
$row=mysql_fetch_array($result);
$username=$row['UserName'];
$curtype=$row['CurType'];
$agents=$row['Agents'];
$world=$row['World'];
$corprator =$row['Corprator']; 
$super=$row['Super']; 
$admin=$row['Admin'];
if ($money>$row['Money']){
	echo "<Script language=javascript>alert('提款失败!原因:提款金额大于账户资金.');window.open('http://hg0088vip.com','_top')</script>";
}else{
if ($key=="Y"){
	$sql="insert into web_sys800_data set Gold='$money',AddDate='$adddate',Type='T',UserName='$username',Agents='$agents',World='$world',Corprator='$corprator',Super='$super',Admin='$admin',CurType='$curtype',Date='$date',Contact='$contact',Notes='$notes',Bank_Account='$bank_account',Bank_Address='$bank_Address',Bank='$bank'";
	mysql_db_query($dbname,$sql) or die ("操作失败!!!");
	$mysql="update web_member_data set Money=Money-$money,Credit=Credit-$money where Username='$username'";
	mysql_db_query($dbname,$mysql);
	echo "<Script language=javascript>alert('提款成功~~请联系客服查收您的订单信息');window.open('http://hg0088vip.com','_top')</script>";
}
}
?>
