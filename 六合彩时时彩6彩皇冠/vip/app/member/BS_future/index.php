<?
session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");          
header("Cache-Control: no-cache, must-revalidate");      
header("Pragma: no-cache");
header("Content-type: text/html; charset=utf-8");
include "../include/address.mem.php";
require ("../include/config.inc.php");
require ("../include/define_function_list.inc.php");
require ("../include/curl_http.php");
include "../include/login_session.php";
$uid=$_REQUEST['uid'];
$langx=$_SESSION['langx'];
$rtype=ltrim(strtolower($_REQUEST['rtype']));
$g_date=$_REQUEST['g_date'];
$league_id=$_REQUEST['league_id'];
require ("../include/traditional.$langx.inc.php");
if ($rtype==""){
	$rtype="r";
}
$sql = "select Status from web_member_data where Oid='$uid' and Status=0";
$result = mysql_db_query($dbname,$sql);
$row = mysql_fetch_array($result);
$cou=mysql_num_rows($result);
if($cou==0){
	echo "<script>window.open('".BROWSER_IP."/tpl/logout_warn.html','_top')</script>";
	exit;
}
if($g_date==''){
   $date='ALL';
}else{
   $date='$g_date';
}
mysql_close();
?>
<!--<script>if (top.game_alert.indexOf('BSFU')==-1){alert("<?=$mem_msg?>"); top.game_alert+='BSFU,'}</script>-->
<script> 
var show_ior = '100';
</script>

<html>
<head>
<title>下注分割畫面</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script> 
var keepGameData=new Array();
var gidData=new Array();
parent.gamecount=0;
//判斷賠率是否變動
//包td
 
function checkRatio(rec,index){
 //alert(flash_ior_set);
	//return true;
	if (flash_ior_set =='Y'){
 
		if (""+keepGameData[rec]=="undefined"||keepGameData[rec]==""){
			keepGameData[rec]=new Array();
			keepGameData[rec][index]=GameFT[rec][index];
		}
		//判斷gid是否相同
		if (gidData[rec]!=GameFT[rec][0]||""+GameFT[rec][0]=="undefined"){
			keepGameData[rec]=new Array();
			gidData[rec]=new Array();
			keepGameData[rec][index]=GameFT[rec][index];
			gidData[rec][0]=GameFT[rec][0];
		}
 
		if (""+keepGameData[rec][index]=="undefined" ||keepGameData[rec][index]==""){
			keepGameData[rec][index]=GameFT[rec][index];
		}
		//alert("aaa==>"+keepGameData[rec][index]+"bbb==>"+GameFT[rec][index]);
		if (keepGameData[rec][index]!=GameFT[rec][index]&& keepGameData[rec][index] !=""&&GameFT[rec][index]!=""){
	    	//keepGameData[rec][index]=GameFT[rec][index];
	    	keepGameData[rec][index] = "";
	    	//keepGameData[rec]="";
			return " bgcolor=yellow ";
		}
		return true;
	}
}
//包font
function checkRatio_font(rec,index){
//alert(flash_ior_set);
	//return true;
	//alert(GameFT.length+"----"+keepGameData.length)
 
	if (flash_ior_set =='Y'){
		if (""+keepGameData[rec]=="undefined"||keepGameData[rec]==""){
			keepGameData[rec]=new Array();
			keepGameData[rec][index]=GameFT[rec][index];
		}
		//判斷gid是否相同
		if (gidData[rec]!=GameFT[rec][0]||""+GameFT[rec][0]=="undefined"){
			keepGameData[rec]=new Array();
			gidData[rec]=new Array();
			keepGameData[rec][index]=GameFT[rec][index];
			gidData[rec][0]=GameFT[rec][0];
		}
		if (""+keepGameData[rec][index]=="undefined"||keepGameData[rec][index] ==""){
			keepGameData[rec][index]=GameFT[rec][index];
		}
 
		//alert("ccc==>"+keepGameData[rec][index]+"ddd==>"+GameFT[rec][index]);
		if (keepGameData[rec][index]!=GameFT[rec][index] && keepGameData[rec][index] !=""&&GameFT[rec][index]!="") {
	    	//keepGameData[rec][index]=GameFT[rec][index];
	    	keepGameData[rec][index] = "";
	    	//keepGameData[rec]="";
			return '  style=\"background-color : yellow\" ';
		}
		return true;
	}
}
function gethighlight(){
	return " style=\"color:red\" style=\"font-weight:bolder\" ";
}
//滑鼠移動帶出索引
//function showMsg(msg, type) {
//	var showHelpMsg = body_browse.document.getElementById("showHelpMsg");
////	var showHelpMsg = parent.body_browse.document.getElementById('showHelpMsg');
//	var helpMsg = body_browse.document.getElementById('helpMsg').innerHTML;
//	var tmpHTML = "";
//	if(type == 1) {
//		tmpHTML = helpMsg;
//		tmpHTML = tmpHTML.replace("*SHOWMSG*", msg);
//		showHelpMsg.innerHTML = tmpHTML;
//		showHelpMsg.style.display = "block";
//		showHelpMsg.style.top = body_browse.document.body.scrollTop+body_browse.event.clientY-10;
//		showHelpMsg.style.left = body_browse.document.body.scrollLeft+body_browse.event.clientX+10;
//	} else showHelpMsg.style.display = "none";
//}
 
//====== 加入現場轉播功能 2009-04-09
// 開啟轉播
function OpenLive(eventid, gtype){
	if (top.liveid == undefined) {
		parent.self.location = "";
		return;
	}
	window.open("../live/live.php?langx="+top.langx+"&uid="+top.uid+"&liveid="+top.liveid+"&eventid="+eventid+"&gtype="+gtype,"Live","width=780,height=585,top=0,left=0,status=no,toolbar=no,scrollbars=no,resizable=no,personalbar=no");
}
 
function VideoFun(eventid, hot, play, gtype) {
	var tmpStr = "";
	if (play == "Y") {
		tmpStr+= "<img lowsrc=\"/images/member/video_1.gif\" onClick=\"parent.OpenLive('"+eventid+"','"+gtype+"')\" style=\"cursor:hand\">";
	} else {
		tmpStr+= "<img lowsrc=\"/images/member/video_2.gif\">";
	}
	return tmpStr;
}
 
function MM_ShowLoveI(gid,getDateTime,getLid,team_h,team_c){
	var txtout="";
	if(!top.swShowLoveI){
		if(!chkRepeat(gid)){	
			txtout = "<span id='sp_"+MM_imgId(getDateTime,gid)+"'><img id='"+MM_imgId(getDateTime,gid)+"' lowsrc=\"/images/member/icon_X2.gif\" vspace=\"0\" style=\"cursor:hand;display:none;\" title=\""+top.str_ShowMyFavorite+"\" onClick=\"addShowLoveI('"+gid+"','"+getDateTime+"','"+getLid+"','"+team_h+"','"+team_c+"'); \"></span>";
		}else{
			txtout = "<span id='sp_"+MM_imgId(getDateTime,gid)+"'><img lowsrc=\"/images/member/love_small.gif\" style=\"cursor:hand\" title=\""+top.str_delShowLoveI+"\" onClick=\"chkDelshowLoveI('"+getDateTime+"','"+gid+"'); \"></span>";
		}
	}else{
		txtout = "<img lowsrc=\"/images/member/love_small.gif\" style=\"cursor:hand\" title=\""+top.str_delShowLoveI+"\" onClick=\"chkDelshowLoveI('"+getDateTime+"','"+gid+"'); \">";
	}
	return txtout;
}
 
function chkRepeat(gid){
	var getGtype =getGtypeShowLoveI();
	var sw =false;
	for (var i=0 ; i < top.ShowLoveIarray[getGtype].length ; i++){
		if(top.ShowLoveIarray[getGtype][i][0]==gid)
			sw =true;
	}
	return sw;
}
 
function MM_IdentificationDisplay(time,gid){
	var getGtype = getGtypeShowLoveI();
	var txt_array = top.ShowLoveIOKarray[getGtype];
	if(top.swShowLoveI){
		var tmp = time.split("<br>")[0];
		if(txt_array.length==0)return true;
		if(txt_array.indexOf(tmp+gid +",",0)== -1)
			return true;
	}
}
function getGtypeShowLoveI(){
	var Gtype;
	var getGtype =sel_gtype;
	
	if(getGtype =="FU"||getGtype=="FT"){
		Gtype ="FT";
	}else if(getGtype =="OM"||getGtype=="OP"){
		Gtype ="OP";
	}else if(getGtype =="BU"||getGtype=="BK"){
		Gtype ="BK";
	}else if(getGtype =="BSFU"||getGtype=="BS"){
		Gtype ="BS";
	}else if(getGtype =="VU"||getGtype=="VB"){
		Gtype ="VB";
	}else if(getGtype =="TU"||getGtype=="TN"){
		Gtype ="TN";
	}else {
		Gtype ="FT";
	}
	//alert("in==>"+parent.sel_gtype+",out==>"+Gtype);
	return Gtype;
}
function MM_imgId(time,gid){	
	var tmp = time.split("<br>")[0];
	//alert(tmp+gid);
	return tmp+gid;
}
 
</script>
<script>
 
/**
 * 選擇多盤口時 轉換成該選擇賠率
 * @param odd_type 	選擇盤口
 * @param iorH		主賠率
 * @param iorC		客賠率
 * @param show		顯示位數
 * @return		回傳陣列 0-->H  ,1-->C
 */
function  get_other_ioratio(odd_type, iorH, iorC , showior){
	var out=new Array();
	if(iorH!="" ||iorC!=""){
		out =chg_ior(odd_type,iorH,iorC,showior);
	}else{
		out[0]=iorH;
		out[1]=iorC;
	}
	return out;
}
/**
 * 轉換賠率
 * @param odd_f
 * @param H_ratio
 * @param C_ratio
 * @param showior
 * @return
 */
function chg_ior(odd_f,iorH,iorC,showior){
	var ior=new Array();
	if(iorH < 3) iorH *=1000;
	if(iorC < 3) iorC *=1000;
	iorH=parseFloat(iorH);
	iorC=parseFloat(iorC);
	switch(odd_f){
	case "H":	//香港變盤(輸水盤)
		ior = get_HK_ior(iorH,iorC);
		break;
	case "M":	//馬來盤
		ior = get_MA_ior(iorH,iorC);
		break;
	case "I" :	//印尼盤
		ior = get_IND_ior(iorH,iorC);
		break;
	case "E":	//歐洲盤
		ior = get_EU_ior(iorH,iorC);
		break;
	default:	//香港盤
		ior[0]=iorH ;
		ior[1]=iorC ;
	}
	ior[0]/=1000;
	ior[1]/=1000;
	
	ior[0]=printf(Decimal_point(ior[0],showior),iorpoints);
	ior[1]=printf(Decimal_point(ior[1],showior),iorpoints);
	//alert("odd_f="+odd_f+",iorH="+iorH+",iorC="+iorC+",ouH="+ior[0]+",ouC="+ior[1]);
	return ior;
}
 
/**
 * 換算成輸水盤賠率
 * @param H_ratio
 * @param C_ratio
 * @return
 */
function get_HK_ior( H_ratio, C_ratio){
	var out_ior=new Array();
	var line,lowRatio,nowRatio,highRatio;
	var nowType="";
	if (H_ratio <= 1000 && C_ratio <= 1000){
		out_ior[0]=H_ratio;
		out_ior[1]=C_ratio;
		return out_ior;
	}
	line=2000 - ( H_ratio + C_ratio );
	if (H_ratio > C_ratio){ 
		lowRatio=C_ratio;
		nowType = "C";
	}else{
		lowRatio = H_ratio;
		nowType = "H";
	}
	if (((2000 - line) - lowRatio) > 1000){
		//對盤馬來盤
		nowRatio = (lowRatio + line) * (-1);
	}else{
		//對盤香港盤
		nowRatio=(2000 - line) - lowRatio;	
	}
	if (nowRatio < 0){
		highRatio = Math.floor(Math.abs(1000 / nowRatio) * 1000) ;
	}else{
		highRatio = (2000 - line - nowRatio) ;
	}
	if (nowType == "H"){
		out_ior[0]=lowRatio;
		out_ior[1]=highRatio;
	}else{
		out_ior[0]=highRatio;
		out_ior[1]=lowRatio;
	}
	return out_ior;
}
/**
 * 換算成馬來盤賠率
 * @param H_ratio
 * @param C_ratio
 * @return
 */
function get_MA_ior( H_ratio, C_ratio){
	var out_ior=new Array();
	var line,lowRatio,highRatio;
	var nowType="";
	if ((H_ratio <= 1000 && C_ratio <= 1000)){
		out_ior[0]=H_ratio;
		out_ior[1]=C_ratio;
		return out_ior;
	}
	line=2000 - ( H_ratio + C_ratio );
	if (H_ratio > C_ratio){ 
		lowRatio = C_ratio;
		nowType = "C";
	}else{
		lowRatio = H_ratio;
		nowType = "H";
	}
	highRatio = (lowRatio + line) * (-1);
	if (nowType == "H"){
		out_ior[0]=lowRatio;
		out_ior[1]=highRatio;
	}else{
		out_ior[0]=highRatio;
		out_ior[1]=lowRatio;
	}
	return out_ior;
}
/**
 * 換算成印尼盤賠率
 * @param H_ratio
 * @param C_ratio
 * @return
 */
function get_IND_ior( H_ratio, C_ratio){
	var out_ior=new Array();
	out_ior = get_HK_ior(H_ratio,C_ratio);
	H_ratio=out_ior[0];
	C_ratio=out_ior[1];
	H_ratio /= 1000;
	C_ratio /= 1000;
	if(H_ratio < 1){
		H_ratio=(-1) / H_ratio;
	}
	if(C_ratio < 1){
		C_ratio=(-1) / C_ratio;
	}
	out_ior[0]=H_ratio*1000;
	out_ior[1]=C_ratio*1000;
	return out_ior;
}
/**
 * 換算成歐洲盤賠率
 * @param H_ratio
 * @param C_ratio
 * @return
 */
function get_EU_ior(H_ratio, C_ratio){
	var out_ior=new Array();
	out_ior = get_HK_ior(H_ratio,C_ratio);
	H_ratio=out_ior[0];
	C_ratio=out_ior[1];       
	out_ior[0]=H_ratio+1000;
	out_ior[1]=C_ratio+1000;
	return out_ior;
}
/*
去正負號做小數第幾位捨去
進來的值是小數值
*/
function Decimal_point(tmpior,show){
	var sign="";
	sign =((tmpior < 0)?"Y":"N");
	tmpior = (Math.floor(Math.abs(tmpior) * show + 1 / show )) / show;
	return (tmpior * ((sign =="Y")? -1:1)) ;
}
 
 
/*
 公用 FUNC
*/
function printf(vals,points){ //小數點位數
	vals=""+vals;
	var cmd=new Array();
	cmd=vals.split(".");
	if (cmd.length>1){
		for (ii=0;ii<(points-cmd[1].length);ii++)vals=vals+"0";
	}else{
		vals=vals+".";
		for (ii=0;ii<points;ii++)vals=vals+"0";
	}
	return vals;
}</script>
<?
switch($rtype){
case 'r':
?>
<script> 
function ShowGameList(){
	if(loading == 'Y') return;
	obj_msg = body_browse.document.getElementById('real_msg');
	obj_msg.innerHTML = '<marquee scrolldelay=\"120\">'+msg+'</marquee>';
	//只有 讓分/走地 才有更新時間
	hr_info = body_browse.document.getElementById('hr_info');
	if(retime)
		hr_info.innerHTML = retime+str_renew;
	else
		hr_info.innerHTML = str_renew;
//	if(body_browse.ReloadTimeID)
//		clearInterval(body_browse.ReloadTimeID);
//	if (retime_flag == 'Y')
//		body_browse.ReloadTimeID = setInterval("body_browse.reload_var()",retime*1000);
	//只有 讓分/走地 才有更新時間 End
	game_table = body_browse.document.getElementById('game_table');
	//alert(keepGameData.length+"---"+gamount)
	if (parent.gamecount!=gamount){
		keepGameData=new Array();
	}
	if(top.odd_f_type==""||""+top.odd_f_type=="undefined") top.odd_f_type="H";
	ShowData_OU(game_table,GameFT,gamount,top.odd_f_type);
	parent.gamecount=gamount;
	show_page();
}
function show_page(){
	pg_str='';
	obj_pg = body_browse.document.getElementById('pg_txt');
	if(eval("parent."+sel_gtype+"_lid_ary")=='ALL'&&!top.swShowLoveI){
		for(var i=0;i<t_page;i++){
		  	if (pg!=i)
		  		pg_str=pg_str+"<a href=# onclick='chg_pg("+i+");'>"+(i+1)+"</a>&nbsp;&nbsp;&nbsp;&nbsp;";
		  	else
		  		pg_str=pg_str+(i+1)+"&nbsp;&nbsp;&nbsp;&nbsp;";
		}
	}
	obj_pg.innerHTML = pg_str;
}
//------單式顯示------
function ShowData_OU(obj_table,GameData,data_amount,odd_f_type){
	var R_ior =Array();
	var OU_ior =Array();
	var HR_ior =Array();
	var HOU_ior =Array();
	
	var nowLeague = '';
	var nowDate = '';
	with(obj_table){
		//alert(parent.BS_lid_type);
		//清除table資料
		while(rows.length > 2)
			deleteRow(rows.length-1);
		//開始顯示開放中賽程資料
 
		for(i=0; i<data_amount; i++){
			if(MM_IdentificationDisplay(GameData[i][1],GameData[i][3]))continue;
			R_ior  = get_other_ioratio(odd_f_type, GameData[i] [9], GameData[i][10] , show_ior);
			OU_ior = get_other_ioratio(odd_f_type, GameData[i][13], GameData[i][14] , show_ior);
			HR_ior = get_other_ioratio(odd_f_type, GameData[i][25], GameData[i][26] , show_ior);
			HOU_ior= get_other_ioratio(odd_f_type, GameData[i][29], GameData[i][30] , show_ior);
			
			if ((GameData[i][17]*1) <= 0){
				GameData[i][17]='';
	                        if ((GameData[i][15]*1) <= 0 || (GameData[i][16]*1) <= 0 ) {
	                                GameData[i][15]='';
	                                GameData[i][16]='';
	                        }
	                }else{
	                        if ((GameData[i][15]*1) <= 0 || (GameData[i][16]*1) <= 0 ) {
	                        	GameData[i][17]='';
	                                GameData[i][15]='';
	                                GameData[i][16]='';
	                        }
	                }
			if(("-"+eval('parent.'+sel_gtype+'_lname_ary')).indexOf(("-"+GameData[i][2]+"-"),0)==-1&&eval('parent.'+sel_gtype+'_lname_ary')!='ALL') continue;
			if(GameData[i][9]<=0 || GameData[i][10]<=0)GameData[i][8]='';
			//判斷聯盟是否相同不同加一列顯示聯盟
			gdate = GameData[i][1].substr(0,5);
			if(nowLeague != GameData[i][2] || nowDate != gdate){
				nowLeague = GameData[i][2];
				nowDate = gdate;
				nowTR = insertRow();
				with(nowTR){
					nowTD = insertCell();
					nowTD.colSpan = 9;
					nowTD.className = 'b_hline';
					nowTD.innerHTML = GameData[i][2];
					//nowTD.innerHTML = "<table border=\"0\"  width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td class=\"b_h_txt\">"+GameData[i][2]+"</td>"+
					//	"<td class=\"b_h_but\"><input type=\"button\" name=\"ReloadLeague"+i+"\" value=\""+top.str_renew+"\" title=\""+top.str_renew+"\" onClick=\"javascript:reload_var();\" ></td></tr></table>";
				}
			}
 
			nowTR = insertRow();
			nowTR.id ="TR_"+MM_imgId(GameData[i][1],GameData[i][3]);
			nowTR.onmouseover =function(){body_browse.mouseEnter_pointer(this.id);}
			nowTR.onmouseout =function(){body_browse.mouseOut_pointer(this.id);}
			nowTR.className = 'b_cen';
			with(nowTR){
			    //滾球字眼
			    GameData[i][1]=GameData[i][1].replace("Running Ball",top.str_RB);
				//日期時間
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = GameData[i][1]+'<BR>';
				//隊伍
				nowTD = nowTR.insertCell();
				nowTD.rowSpan = 2;
				nowTD.align = 'left';
				nowTD.innerHTML = GameData[i][5]+'&nbsp;&nbsp;<BR>'+GameData[i][6];
				tmp_data=((GameData[i][5].replace("<font color=#FF0000>","")).replace("</font>","")).replace("<font style=background-color:#FFFF99>","");
				//tmp_data=(GameData[i][5].replace("<font style=background-color:#FFFF99>","")).replace("</font>","");
 
				//獨贏主隊
				nowTD = insertCell();
				if ((GameData[i][15]*1) > 0){
					nowTD.innerHTML = '<a href=\"../BS_order/BS_order_m.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=H&gnum='+GameData[i][3]+'\" target=\"mem_order\" title=\"'+tmp_data+'\"><font '+checkRatio_font(i,15)+'>'+GameData[i][15]+'</A></font>&nbsp;';
				}else{
					nowTD.innerHTML = '&nbsp;';
				}
				
				//讓球主隊
				nowTD = insertCell();
				tmpStr = '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">';
				if(GameData[i][7] == 'H') //強隊是主隊
					tmpStr += '<tr><td '+checkRatio(i,8)+' align=\"center\" width=\"68%\">'+GameData[i][8]+'</td>';
				else  //強隊是客隊
					tmpStr += '<tr><td align=\"center\" width=\"68%\">&nbsp;</td>';
				tmpStr += '<td '+checkRatio(i,9)+'><a href=\"../BS_order/BS_order_r.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=H&gnum='+GameData[i][3]+'&strong='+GameData[i][7]+'\" target=\"mem_order\" title=\"'+tmp_data+'\">'+R_ior[0]+'</a></td>'+
				          '</tr></table>';
				nowTD.innerHTML = tmpStr;
				//大小盤主隊
				nowTD = insertCell();
				nowTD.align = 'right';
				if(GameData[i][14]){
					if(langx=="zh-tw"){
						title_str="大";
					}
					if(langx=="zh-cn"){
						title_str="大";
					}
					if(langx=="en-us"||langx=="th-tis"){
						title_str="Over";
					}
					nowTD.innerHTML = '<font '+checkRatio_font(i,11)+'>'+GameData[i][11]+'</font>&nbsp;&nbsp;'+
						'<A href=\"../BS_order/BS_order_ou.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=C&gnum='+GameData[i][4]+'\" target=\"mem_order\" title=\"'+title_str+'\">&nbsp;&nbsp;<font '+checkRatio_font(i,14)+'>'+OU_ior[1]+'</A></font>&nbsp;';
				}else{
					nowTD.innerHTML ='';
				}
				//單雙主隊
				nowTD = insertCell();
				nowTD.align = 'right';
				if(GameData[i][20]){
					if(langx=="zh-tw"){
						title_str="單";
					}
					if(langx=="zh-cn"){
						title_str="单";
					}
					if(langx=="en-us"||langx=="th-tis"){
						title_str="Odd";
					}
					nowTD.innerHTML = '<font '+checkRatio_font(i,18)+'>'+GameData[i][18]+'</font>&nbsp;&nbsp;'+
						'<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=ODD\" target=\"mem_order\" title=\"'+title_str+'\">&nbsp;&nbsp;<font '+checkRatio_font(i,20)+'>'+GameData[i][20]+'</A></font>&nbsp;';
				}else{
					nowTD.innerHTML ='';
				}
				
				//上半獨贏主隊
				nowTD = insertCell();
				nowTD.className = 'b_1st';
				if ((GameData[i][31]*1) > 0){
					nowTD.innerHTML = '<a href=\"../BS_order/BS_order_hm.php?gid='+GameData[i][22]+'&uid='+uid+'&type=H&gnum='+GameData[i][3]+'&odd_f_type='+odd_f_type+'\" target=\"mem_order\" title=\"'+tmp_data+'\"><font '+checkRatio_font(i,31)+'>'+GameData[i][31]+'</A></font>&nbsp;';
				}else{
					nowTD.innerHTML = '&nbsp;';
				}
 
				//上半讓球H
				nowTD = insertCell();
 
				nowTD.className = 'b_1st';
				tmpStr = '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">';
				if(GameData[i][23] == "H"){ //強隊是主隊
					tmpStr += '<tr><td '+checkRatio(i,24)+' align=\"center\" width=\"68%\">'+GameData[i][24]+'</td>';
				}else{  //強隊是客隊
					tmpStr += '<tr><td align=\"center\" width=\"68%\">&nbsp;</td>';
				}
				tmpStr += '<td '+checkRatio(i,25)+'><a href=\"../BS_order/BS_order_hr.php?gid='+GameData[i][22]+'&uid='+uid+'&type=H&gnum='+GameData[i][3]+'&strong='+GameData[i][7]+'&odd_f_type='+odd_f_type+'\" target=\"mem_order\" title=\"'+tmp_data+'\">'+HR_ior[0]+'</a></td>'+
					  '</tr></table>';
				nowTD.innerHTML = tmpStr;
 
				//大小盤主隊
				nowTD = insertCell();
				nowTD.className = 'b_1st';
				nowTD.align = "right";
				if(GameData[i][30]){
					if(langx=="zh-tw"){
						title_str="大";
					}
					if(langx=="zh-cn"){
						title_str="大";
					}
					if(langx=="en-us"||langx=="th-tis"){
						title_str="Over";
					}
					nowTD.innerHTML = '<font '+checkRatio_font(i,27)+'>'+GameData[i][27]+'</font>&nbsp;&nbsp;'+
							'<A href=\"../BS_order/BS_order_hou.php?gid='+GameData[i][22]+'&uid='+uid+'&type=C&gnum='+GameData[i][4]+'&odd_f_type='+odd_f_type+'\" target=\"mem_order\" title=\"'+title_str+'\">&nbsp;&nbsp;<font '+checkRatio_font(i,30)+'>'+HOU_ior[1]+'</A></font>&nbsp;';
				}else{
					nowTD.innerHTML = "";
				}
				
				
			}//主隊TR結束
 
			nowTR = insertRow();
			nowTR.id ="TR1_"+MM_imgId(GameData[i][1],GameData[i][3]);
			nowTR.onmouseover =function(){body_browse.mouseEnter_pointer(this.id);}
			nowTR.onmouseout =function(){body_browse.mouseOut_pointer(this.id);}
			nowTR.className = 'b_cen';
			with(nowTR){
				tmp_data=((GameData[i][6].replace("<font color=#FF0000>","")).replace("</font>","")).replace("<font style=background-color:#FFFF99>","");
 
				//獨贏客隊
				nowTD = insertCell();
				if ((GameData[i][16]*1) > 0){
					nowTD.innerHTML = '<a href=\"../BS_order/BS_order_m.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=C&gnum='+GameData[i][4]+'\" target=\"mem_order\" title=\"'+tmp_data+'\"><font '+checkRatio_font(i,16)+'>'+GameData[i][16]+'</A></font>&nbsp;';
				}else{
					nowTD.innerHTML = '&nbsp;';
				}
				
				//讓球客隊
				nowTD = insertCell();
				tmpStr = '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">';
				if(GameData[i][7] == 'C') //強隊是客隊
					tmpStr += '<tr><td '+checkRatio(i,8)+' align=\"center\" width=\"68%\">'+GameData[i][8]+'</td>';
				else  //強隊是主隊
					tmpStr += '<tr><td align=\"center\" width=\"68%\">&nbsp;</td>';
				tmpStr += '<td '+checkRatio(i,10)+'><a href=\"../BS_order/BS_order_r.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=C&gnum='+GameData[i][4]+'&strong='+GameData[i][7]+'\" target=\"mem_order\" title=\"'+tmp_data+'\">'+R_ior[1]+'</a></td>'+
				          '</tr></table>';
				nowTD.innerHTML = tmpStr;
				//大小盤客隊
				nowTD = insertCell();
				nowTD.align = 'right';
				if(GameData[i][13]){
					if(langx=="zh-tw"){
						title_str="小";
					}
					if(langx=="zh-cn"){
						title_str="小";
					}
					if(langx=="en-us"||langx=="th-tis"){
						title_str="Under";
					}
					nowTD.innerHTML = '<font '+checkRatio_font(i,12)+'>'+GameData[i][12]+'</font>&nbsp;&nbsp;'+
						'<A href=\"../BS_order/BS_order_ou.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=H&gnum='+GameData[i][3]+'\" target=\"mem_order\" title=\"'+title_str+'\">&nbsp;&nbsp;<font '+checkRatio_font(i,13)+'>'+OU_ior[0]+'</A></font>&nbsp;';
				}else{
					nowTD.innerHTML ='';
				}
				//單雙客隊
				nowTD = insertCell();
				nowTD.align = 'right';
				if(GameData[i][21]){
					if(langx=="zh-tw"){
						title_str="雙";
					}
					if(langx=="zh-cn"){
						title_str="双";
					}
					if(langx=="en-us"||langx=="th-tis"){
						title_str="Even";
					}
					nowTD.innerHTML = '<font '+checkRatio_font(i,19)+'>'+GameData[i][19]+'</font>&nbsp;&nbsp;'+
						'<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=EVEN\" target=\"mem_order\" title=\"'+title_str+'\">&nbsp;&nbsp;<font '+checkRatio_font(i,21)+'>'+GameData[i][21]+'</A></font>&nbsp;';
				}else{
					nowTD.innerHTML ='';
				}
				
				//上半獨贏客隊
				nowTD = insertCell();
				nowTD.className = 'b_1st';
				if ((GameData[i][32]*1) > 0){
					nowTD.innerHTML = '<a href=\"../BS_order/BS_order_hm.php?gid='+GameData[i][22]+'&uid='+uid+'&type=C&gnum='+GameData[i][4]+'&odd_f_type='+odd_f_type+'\" target=\"mem_order\"title=\"'+tmp_data+'\"><font '+checkRatio_font(i,32)+'>'+GameData[i][32]+'</A></font>&nbsp;';
				}else{
					nowTD.innerHTML = '&nbsp;';
				}
 
				//1st讓球客隊
				nowTD = insertCell();
				nowTD.className = 'b_1st';
				tmpStr = '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">';
				if(GameData[i][23] == "C"){ //強隊是客隊
					tmpStr += '<tr><td '+checkRatio(i,24)+' align=\"center\" width=\"68%\">'+GameData[i][24]+'</td>';
				}else{  //強隊是主隊
					tmpStr += '<tr><td align=\"center\" width=\"68%\">&nbsp;</td>';
				}
				tmpStr += '<td '+checkRatio(i,26)+'><a href=\"../BS_order/BS_order_hr.php?gid='+GameData[i][22]+'&uid='+uid+'&type=C&gnum='+GameData[i][4]+'&strong='+GameData[i][7]+'&odd_f_type='+odd_f_type+'\" target=\"mem_order\" title=\"'+tmp_data+'\">'+HR_ior[1]+'</a></td>'+
				       '</tr></table>';
				nowTD.innerHTML = tmpStr;
 
				//1st大小盤客隊
				nowTD = insertCell();
				nowTD.className = 'b_1st';
				nowTD.align = "right";
				if(GameData[i][29]){
				     if(langx=="zh-tw"){
						title_str="小";
					}
					if(langx=="zh-cn"){
						title_str="小";
					}
					if(langx=="en-us"||langx=="th-tis"){
						title_str="Under";
					}
				     nowTD.innerHTML = '<font '+checkRatio_font(i,28)+'>'+GameData[i][28]+'</font>&nbsp;&nbsp;'+
						       '<A href=\"../BS_order/BS_order_hou.php?gid='+GameData[i][22]+'&uid='+uid+'&type=H&gnum='+GameData[i][3]+'&odd_f_type='+odd_f_type+'\" target=\"mem_order\" title=\"'+title_str+'\">&nbsp;&nbsp;<font '+checkRatio_font(i,29)+'>'+HOU_ior[0]+'</A></font>&nbsp;';
				}else{
				     nowTD.innerHTML ="";
				}
				
				
				
			}//客隊TR結束
 
			nowTR = insertRow();
			nowTR.id ="TR2_"+MM_imgId(GameData[i][1],GameData[i][3]);
			nowTR.onmouseover =function(){body_browse.mouseEnter_pointer(this.id);}
			nowTR.onmouseout =function(){body_browse.mouseOut_pointer(this.id);}
			nowTR.className = 'b_cen';
			with(nowTR){
				/*
				nowTD = insertCell();
				nowTD.align = 'left';
				nowTD.innerHTML = str_even;
				//獨贏和局
				nowTD = insertCell();
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_m.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=N&gnum='+GameData[i][4]+'\" target=\"mem_order\">'+GameData[i][17]+'</A>';
				*/
 
				nowTD = insertCell();
				nowTD.align = 'left';
				//nowTD.innerHTML = str_even;
				//====== 加入現場轉播功能 2009-04-09, VideoFun 放在 flash_ior_mem.js
				tmpStr = "<table width='100%'><tr><td align='left'>"+str_even+"</td>";
				tmpStr+= "<td class='hot_td'>";
				tmpStr+= "<table><tr align='right' height='17'><td>";
				tmpStr+=MM_ShowLoveI(GameData[i][3],GameData[i][1],GameData[i][2],GameData[i][5],GameData[i][6]);
				tmpStr+= "</td><td>";
				if (top.casino == "SI2") {
					if (GameData[i][35] != "" && GameData[i][35] != "null" && GameData[i][35] != undefined) {	//判斷是否有轉播
						tmpStr+= VideoFun(GameData[i][35], GameData[i][36], GameData[i][37], "BS");
					}
				}
				tmpStr+= "</td></tr></table>";
				tmpStr+= "</td>";
				tmpStr+= "</tr></table>";
				nowTD.innerHTML = tmpStr;
 
 
				nowTD = insertCell();
				nowTD.align = 'center';
				nowTD.colSpan = 4;
				if(game_more=='0'||GameData[i][34]=='0') nowTD.innerHTML ='';
				else nowTD.innerHTML ='<A href=\"javascript:\" onClick=\"show_more(\''+GameData[i][0]+'\');\">'+str_more+'<font class=\'total_color\'>('+GameData[i][34]+')</font>'+'</A>' ;
					
					
				nowTD = insertCell();
				nowTD.className = 'b_1st';
				nowTD.align = 'left';
				//獨贏和局
				if ((GameData[i][31]*1) > 0&&(GameData[i][32]*1) > 0&&(GameData[i][33]*1) > 0){
					nowTD.innerHTML = '<A href=\"../BS_order/BS_order_hm.php?gid='+GameData[i][22]+'&uid='+uid+'&type=N&gnum='+GameData[i][4]+'&odd_f_type='+odd_f_type+'\" target=\"mem_order\"   title=\"'+str_even+'\"><font '+checkRatio_font(i,33)+'>'+GameData[i][33]+'</A></font>&nbsp;';
				}else{
					nowTD.innerHTML = '&nbsp;';
				}
				nowTD = insertCell();
				nowTD.className = 'b_1st';
				nowTD.colSpan = 2;	
			}//和局TR結束
 
			nowTR = insertRow();
			with(nowTR){
				nowTD = insertCell();
				nowTD.colSpan = 9;
				nowTD.height = 1;
			}//分隔線TR
		}
	}//with(obj_table);
}//顯示單式結束
 
 
function ShowData_Other(show_team,show_pd,show_t,GameData,odd_f_type){
	var nowLeague = '';
	var nowDate = '';
	
	show_team.style.display='none';
	show_pd.style.display='none';
	show_t.style.display='none';
	
	with(show_team){
		//清除table資料
		while(rows.length >= 1)
		deleteRow(rows.length-1);
 
		if (GameData[34]!='0')show_team.style.display='block';
 
		nowTR = insertRow();
		nowTR.className = 'b_cen';
		with(nowTR){
			nowTD = insertCell();
			nowTD.align = 'left';
			nowTD.innerHTML = GameData[5]+'&nbsp;&nbsp;<font color="#ff8000">VS.</font>&nbsp;&nbsp;'+GameData[6];
		}
		nowTR = insertRow();
		with(nowTR){
			nowTD = insertCell();
			nowTD.colSpan = 18;
			nowTD.height = 1;
		}//分隔線TR
	}	
	
	with(show_pd){//波膽
		//清除table資料
		while(rows.length > 1)
		deleteRow(rows.length-1);
		//開始顯示開放中賽程資料
		var ar=0;
		flag = false;
		 for(j=19; j<=45; j++){
			if(GameData[j] == '0'){
				ar++;
				GameData[j]="";
			}
			if (GameData[j]=="")ar++;
		}
		if (ar!=27)show_pd.style.display='block'
 
 
		nowTR = insertRow();
		nowTR.className = 'b_cen';
		with(nowTR){
			//波膽
 
			nowTD = insertCell(); //H1C0
			if(GameData[19]=='') nowTD.innerHTML='&nbsp;';
			else nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH1\" target=\"mem_order\">'+GameData[19]+'</A>';
			nowTD = insertCell(); //H2C0
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH2\" target=\"mem_order\">'+GameData[20]+'</A>';
			nowTD = insertCell(); //H2C1
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH3\" target=\"mem_order\">'+GameData[21]+'</A>';
			nowTD = insertCell(); //H3C0
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH4\" target=\"mem_order\">'+GameData[22]+'</A>';
			nowTD = insertCell(); //H3C1
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH5\" target=\"mem_order\">'+GameData[23]+'</A>';
			nowTD = insertCell(); //H3C2
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH6\" target=\"mem_order\">'+GameData[24]+'</A>';
			nowTD = insertCell(); //H4C0
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH7\" target=\"mem_order\">'+GameData[25]+'</A>';
			nowTD = insertCell(); //H4C1
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH8\" target=\"mem_order\">'+GameData[26]+'</A>';
			nowTD = insertCell(); //H4C2
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH9\" target=\"mem_order\">'+GameData[27]+'</A>';
 
		}//主隊TR結束
 
		nowTR = insertRow();
		nowTR.className = 'b_cen';
		with(nowTR){
			//波膽
			nowTD = insertCell(); //H0C1
			if(GameData[28]=='') nowTD.innerHTML='&nbsp;';
			else nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC1\" target=\"mem_order\">'+GameData[28]+'</A>';
			nowTD = insertCell(); //H0C2
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC2\" target=\"mem_order\">'+GameData[29]+'</A>';
			nowTD = insertCell(); //H1C2
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC3\" target=\"mem_order\">'+GameData[30]+'</A>';
			nowTD = insertCell(); //H0C3
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC4\" target=\"mem_order\">'+GameData[31]+'</A>';
			nowTD = insertCell(); //H1C3
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC5\" target=\"mem_order\">'+GameData[32]+'</A>';
			nowTD = insertCell(); //H2C3
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC6\" target=\"mem_order\">'+GameData[33]+'</A>';
			nowTD = insertCell(); //H0C4
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC7\" target=\"mem_order\">'+GameData[34]+'</A>';
			nowTD = insertCell(); //H1C4
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC8\" target=\"mem_order\">'+GameData[35]+'</A>';
			nowTD = insertCell(); //H2C4
			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC9\" target=\"mem_order\">'+GameData[36]+'</A>';
 
		}//客隊TR結束
		nowTR = insertRow();
		with(nowTR){
			nowTD = insertCell();
			nowTD.colSpan = 18;
			nowTD.height = 1;
		}//分隔線TR
	}
 
 
	with(show_t){
		//清除table資料
		while(rows.length > 1)
		deleteRow(rows.length-1);
		//開始顯示總入球賽程資料
		//判斷是否單雙或總入球都有賠率
		
		var ar=0;
		for(j=37; j<=46; j++){
			if(GameData[j] == '0'){
				//ar++;
				GameData[j]="";
			}
			if (GameData[j]=="")ar++;
		}
		if (ar!=10)show_t.style.display='block';
 
		//判斷聯盟是否相同不同加一列顯示聯盟
		nowTR = insertRow();
		nowTR.className = 'b_cen';
		with(nowTR){
			//0~1
			nowTD = insertCell();
			if(GameData[37]=='') nowTD.innerHTML='&nbsp;';
			else nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=1~2\" target=\"mem_order\">'+GameData[37]+'</A>';
			//2~3
			nowTD = insertCell();
			nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=3~4\" target=\"mem_order\">'+GameData[38]+'</A>';
			//4~6
			nowTD = insertCell();
			nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=5~6\" target=\"mem_order\">'+GameData[39]+'</A>';
			//0~1
			nowTD = insertCell();
			nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=7~8\" target=\"mem_order\">'+GameData[40]+'</A>';
			//2~3
			nowTD = insertCell();
			nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=9~10\" target=\"mem_order\">'+GameData[41]+'</A>';
			//4~6
			nowTD = insertCell();
			nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=11~12\" target=\"mem_order\">'+GameData[42]+'</A>';
			//0~1
			nowTD = insertCell();
			nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=13~14\" target=\"mem_order\">'+GameData[43]+'</A>';
			//2~3
			nowTD = insertCell();
			nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=15~16\" target=\"mem_order\">'+GameData[44]+'</A>';
			//4~6
			nowTD = insertCell();
			nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=17~18\" target=\"mem_order\">'+GameData[45]+'</A>';
			//0~1
			nowTD = insertCell();
			nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=T19\" target=\"mem_order\">'+GameData[46]+'</A>';
 
		}
	}//with(obj_table);
 
//	with(show_f){
//		//清除table資料
//		while(rows.length > 1)
//		deleteRow(rows.length-1);
//		//開始顯示開放中賽程資料
//		//判斷是否半全場都有賠率
//
//		//判斷聯盟是否相同不同加一列顯示聯盟
//		nowTR = insertRow();
//		nowTR.className = 'b_cen';
//		with(nowTR){
//			//半全場
//			nowTD = insertCell(); //H0C1
//			nowTD.align = 'center';
//			if(GameData[50]=='') nowTD.innerHTML='&nbsp;';
//			else nowTD.innerHTML = '<a href=\"../BS_order/BS_order_f.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=FHH\" target=\"mem_order\"><B>'+GameData[50]+'</A>';
//			nowTD = insertCell(); //H0C2
//			nowTD.align = 'center';
//			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_f.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=FHN\" target=\"mem_order\"><B>'+GameData[51]+'</A>';
//			nowTD = insertCell(); //H1C2
//			nowTD.align = 'center';
//			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_f.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=FHC\" target=\"mem_order\"><B>'+GameData[52]+'</A>';
//			nowTD = insertCell(); //H0C3
//			nowTD.align = 'center';
//			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_f.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=FNH\" target=\"mem_order\"><B>'+GameData[53]+'</A>';
//			nowTD = insertCell(); //H1C3
//			nowTD.align = 'center';
//			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_f.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=FNN\" target=\"mem_order\"><B>'+GameData[54]+'</A>';
//			nowTD = insertCell(); //H2C3
//			nowTD.align = 'center';
//			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_f.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=FNC\" target=\"mem_order\"><B>'+GameData[55]+'</A>';
//			nowTD = insertCell(); //H0C4
//			nowTD.align = 'center';
//			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_f.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=FCH\" target=\"mem_order\"><B>'+GameData[56]+'</A>';
//			nowTD = insertCell(); //H1C4
//			nowTD.align = 'center';
//			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_f.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=FCN\" target=\"mem_order\"><B>'+GameData[57]+'</A>';
//			nowTD = insertCell(); //H2C4
//			nowTD.align = 'center';
//			nowTD.innerHTML = '<a href=\"../BS_order/BS_order_f.php?gid='+GameData[18]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=FCC\" target=\"mem_order\"><B>'+GameData[58]+'</A>';
//		}//主隊TR結束
//
//		nowTR = insertRow();
//		with(nowTR){
//			nowTD = insertCell();
//			nowTD.colSpan = 18;
//			nowTD.height = 1;
//		}//分隔線TR
//  	}//with(obj_table);
}//顯示單式結束
 
</script>
<?
break;
case 'hr':
?>
<script> 
function ShowGameList(){
	if(loading == 'Y') {return;}
	obj_msg = body_browse.document.getElementById("real_msg");
	obj_msg.innerHTML = '<marquee scrolldelay=\"120\">'+msg+'</marquee>';
	//只有 讓分/走地 才有更新時間
	hr_info = body_browse.document.getElementById('hr_info');
	if(retime){
		hr_info.innerHTML = retime+str_renew;
	}else{
		hr_info.innerHTML = str_renew;
	}
//	if(body_browse.ReloadTimeID){
//		clearInterval(body_browse.ReloadTimeID);
//	}
//	if (retime_flag == 'Y'){
//		body_browse.ReloadTimeID = setInterval("body_browse.reload_var()",retime*1000);
//	}
	//只有 讓分/走地 才有更新時間 End
	game_table = body_browse.document.getElementById("game_table");
	//alert(keepGameData.length+"---"+gamount)
	if (parent.gamecount!=gamount){
		keepGameData=new Array();
	}	
	if(top.odd_f_type==""||""+top.odd_f_type=="undefined") top.odd_f_type="H";
	ShowData_OU(game_table,GameFT,gamount,top.odd_f_type);
	parent.gamecount=gamount;		
	show_page();
}
function show_page(){
	pg_str='';
	obj_pg = body_browse.document.getElementById('pg_txt');
	if(eval("parent."+sel_gtype+"_lid_ary")=='ALL'&&!top.swShowLoveI){
		for(var i=0;i<t_page;i++){
		  	if (pg!=i)
		  		pg_str=pg_str+"<a href=# onclick='chg_pg("+i+");'>"+(i+1)+"</a>&nbsp;&nbsp;&nbsp;&nbsp;";
		  	else
		  		pg_str=pg_str+(i+1)+"&nbsp;&nbsp;&nbsp;&nbsp;";
		}
	}
	obj_pg.innerHTML = pg_str;
}
//------單式顯示------
function ShowData_OU(obj_table,GameData,data_amount,odd_f_type){
	var R_ior =Array();
	var OU_ior =Array();
		
	var nowLeague = "";
	var nowDate = "";
 
	with(obj_table){
		//清除table資料
		while(rows.length > 1) {deleteRow(rows.length-1);}
 
		//開始顯示開放中賽程資料
		for(i=0; i<data_amount; i++){
			if(MM_IdentificationDisplay(GameData[i][1],GameData[i][3]))continue;
			R_ior  = get_other_ioratio(odd_f_type, GameData[i] [9], GameData[i][10] , show_ior);
			OU_ior = get_other_ioratio(odd_f_type, GameData[i][13], GameData[i][14] , show_ior);
			if ((GameData[i][17]*1) <= 0){
				GameData[i][17]='';
	                        if ((GameData[i][15]*1) <= 0 || (GameData[i][16]*1) <= 0 ) {
	                                GameData[i][15]='';
	                                GameData[i][16]='';
	                        }
	                }else{
	                        if ((GameData[i][15]*1) <= 0 || (GameData[i][16]*1) <= 0 ) {
	                        	GameData[i][17]='';
	                                GameData[i][15]='';
	                                GameData[i][16]='';
	                        }
	                }				
                        if(("-"+eval('parent.'+sel_gtype+'_lname_ary')).indexOf(("-"+GameData[i][2]+"-"),0)==-1&&eval('parent.'+sel_gtype+'_lname_ary')!='ALL') continue;
			if(GameData[i][9]<=0 || GameData[i][10]<=0) {GameData[i][8]="";}
//			if(sel_league!=GameData[i][2] && sel_league) {continue;}
 
			//判斷聯盟是否相同不同加一列顯示聯盟
			gdate = GameData[i][1].substr(0,5);
			if(nowLeague != GameData[i][2] || nowDate != gdate){
				nowLeague = GameData[i][2];
				nowDate = gdate;
				nowTR = insertRow();
				with(nowTR){
					nowTD = insertCell();
					nowTD.colSpan = 5;
					nowTD.className = 'b_hline';
					nowTD.innerHTML = GameData[i][2];
					//nowTD.innerHTML = "<table border=\"0\"  width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td class=\"b_h_txt\">"+GameData[i][2]+"</td>"+
					//	"<td class=\"b_h_but\"><input type=\"button\" name=\"ReloadLeague"+i+"\" value=\""+top.str_renew+"\" title=\""+top.str_renew+"\" onClick=\"javascript:reload_var();\" ></td></tr></table>";
				}
			}
 
			nowTR = insertRow();
			nowTR.id ="TR_"+MM_imgId(GameData[i][1],GameData[i][3]);
			nowTR.onmouseover =function(){body_browse.mouseEnter_pointer(this.id);}
			nowTR.onmouseout =function(){body_browse.mouseOut_pointer(this.id);}
			nowTR.className = "b_cen";
			with(nowTR){
			    //滾球字眼
			    GameData[i][1]=GameData[i][1].replace("Running Ball",top.str_RB);
				//日期時間
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = GameData[i][1]+"<BR>";
 
				//隊伍
				nowTD = nowTR.insertCell();
				nowTD.rowSpan = 2;
				nowTD.align = "left";
				nowTD.innerHTML = GameData[i][5]+"&nbsp;&nbsp;<BR>"+GameData[i][6];
				if(langx=="zh-tw"){
					tmp_data=((GameData[i][5].replace("<font color=gray> - [上半]</font>","")).replace("<font color=#FF0000>","")).replace("</font>","");
				}
				if(langx=="zh-cn"){
					tmp_data=((GameData[i][5].replace("<font color=gray> - [奻圉]</font>","")).replace("<font color=#FF0000>","")).replace("</font>","");
				}
				if(langx=="en-us"||langx=="th-tis"){
					tmp_data=((GameData[i][5].replace("<font color=gray> - [1st Half]</font>","")).replace("<font color=#FF0000>","")).replace("</font>","");
				}
				//獨贏主隊
				nowTD = insertCell();
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_hm.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=H&gnum='+GameData[i][3]+'\" target=\"mem_order\" title=\"'+tmp_data+'\"><font '+checkRatio_font(i,15)+'>'+GameData[i][15]+'</A></font>';
				//讓球主隊
				nowTD = insertCell();
 
				tmpStr = '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">';
				if(GameData[i][7] == "H"){ //強隊是主隊
					tmpStr += '<tr><td '+checkRatio(i,8)+' align=\"center\" width=\"68%\">'+GameData[i][8]+'</td>';
				}else{  //強隊是客隊
					tmpStr += '<tr><td align=\"center\" width=\"68%\">&nbsp;</td>';
				}
				tmpStr += '<td '+checkRatio(i,9)+'><a href=\"../BS_order/BS_order_hr.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=H&gnum='+GameData[i][3]+'&strong='+GameData[i][7]+'\" target=\"mem_order\" title=\"'+tmp_data+'\">'+R_ior[0]+'</a></td>'+
					  '</tr></table>';
				nowTD.innerHTML = tmpStr;
 
				//大小盤主隊
				nowTD = insertCell();
				nowTD.align = "right";
				if(GameData[i][14]){
					if(langx=="zh-tw"){
						title_str="大";
					}
					if(langx=="zh-cn"){
						title_str="大";
					}
					if(langx=="en-us"||langx=="th-tis"){
						title_str="Over";
					}
					nowTD.innerHTML = '<font '+checkRatio_font(i,11)+'>'+GameData[i][11]+'</font>&nbsp;&nbsp;'+
							'<A href=\"../BS_order/BS_order_hou.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=C&gnum='+GameData[i][4]+'\" target=\"mem_order\" title=\"'+title_str+'\">&nbsp;&nbsp;<font '+checkRatio_font(i,14)+'>'+OU_ior[1]+'</A></font>&nbsp;';
				}else{
					nowTD.innerHTML = "";
				}
			}//主隊TR結束
 
			nowTR = insertRow();
			nowTR.id ="TR1_"+MM_imgId(GameData[i][1],GameData[i][3]);
			nowTR.onmouseover =function(){body_browse.mouseEnter_pointer(this.id);}
			nowTR.onmouseout =function(){body_browse.mouseOut_pointer(this.id);}
			nowTR.className = "b_cen";
			with(nowTR){
				if(langx=="zh-tw"){
					tmp_data=((GameData[i][6].replace("<font color=gray> - [上半]</font>","")).replace("<font color=#FF0000>","")).replace("</font>","");
				}
				if(langx=="zh-cn"){
					tmp_data=((GameData[i][6].replace("<font color=gray> - [奻圉]</font>","")).replace("<font color=#FF0000>","")).replace("</font>","");
				}
				if(langx=="en-us"||langx=="th-tis"){
					tmp_data=((GameData[i][6].replace("<font color=gray> - [1st Half]</font>","")).replace("<font color=#FF0000>","")).replace("</font>","");
				}
				//獨贏客隊
				nowTD = insertCell();
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_hm.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=C&gnum='+GameData[i][4]+'\" target=\"mem_order\" title=\"'+tmp_data+'\"><font '+checkRatio_font(i,16)+'>'+GameData[i][16]+'</A></font>';
 
				//讓球客隊
				nowTD = insertCell();
				tmpStr = '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">';
				if(GameData[i][7] == "C"){ //強隊是客隊
					tmpStr += '<tr><td '+checkRatio(i,8)+' align=\"center\" width=\"68%\">'+GameData[i][8]+'</td>';
				}else{  //強隊是主隊
					tmpStr += '<tr><td align=\"center\" width=\"68%\">&nbsp;</td>';
				}
				tmpStr += '<td '+checkRatio(i,10)+'><a href=\"../BS_order/BS_order_hr.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=C&gnum='+GameData[i][4]+'&strong='+GameData[i][7]+'\" target=\"mem_order\" title=\"'+tmp_data+'\">'+R_ior[1]+'</a></td>'+
				       '</tr></table>';
				nowTD.innerHTML = tmpStr;
 
				//大小盤客隊
				nowTD = insertCell();
				nowTD.align = "right";
				if(GameData[i][13]){
					if(langx=="zh-tw"){
						title_str="小";
					}
					if(langx=="zh-cn"){
						title_str="小";
					}
					if(langx=="en-us"||langx=="th-tis"){
						title_str="Under";
					}
				     nowTD.innerHTML = '<font '+checkRatio_font(i,12)+'>'+GameData[i][12]+'</font>&nbsp;&nbsp;'+
						       '<A href=\"../BS_order/BS_order_hou.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=H&gnum='+GameData[i][3]+'\" target=\"mem_order\" title=\"'+title_str+'\">&nbsp;&nbsp;<font '+checkRatio_font(i,13)+'>'+OU_ior[0]+'</A></font>&nbsp;';
				}else{
				     nowTD.innerHTML ="";
				}
			}//客隊TR結束
 
			nowTR = insertRow();
			nowTR.id ="TR2_"+MM_imgId(GameData[i][1],GameData[i][3]);
			nowTR.onmouseover =function(){body_browse.mouseEnter_pointer(this.id);}
			nowTR.onmouseout =function(){body_browse.mouseOut_pointer(this.id);}
			nowTR.className = "b_cen";
			with(nowTR){
				nowTD = insertCell();
				nowTD.align = "left";
				//nowTD.innerHTML = str_even;
				tmpStr = "<table width='100%'><tr><td align='left'>"+str_even+"</td>";				
				tmpStr+= "<td class='hot_td'>";
				tmpStr+=MM_ShowLoveI(GameData[i][3],GameData[i][1],GameData[i][2],GameData[i][5],GameData[i][6]);
				tmpStr+= "</td>";
				tmpStr+= "</tr></table>";
				nowTD.innerHTML = tmpStr;
 
				//獨贏和局
				nowTD = insertCell();
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_hm.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=N&gnum='+GameData[i][4]+'\" target=\"mem_order\" title=\"'+str_even+'\"><font '+checkRatio_font(i,17)+'>'+GameData[i][17]+'</A></font>';
				nowTD = insertCell();
				nowTD.colSpan = 2;
				nowTD.innerHTML = "&nbsp";
 
			}//和局TR結束
 
			nowTR = insertRow();
			with(nowTR){
				nowTD = insertCell();
				nowTD.colSpan = 5;
				nowTD.height = 1;
			}//分隔線TR

		}
	}//with(obj_table);
}//顯示單式結束
</script>
<?
break;
case 'pd':
?>
<script> 
function ShowGameList(){
	if(loading == 'Y') return;
	obj_msg = body_browse.document.getElementById('real_msg');
	obj_msg.innerHTML = '<marquee scrolldelay=\"120\">'+msg+'</marquee>';
	game_table = body_browse.document.getElementById('game_table');
	//alert(keepGameData.length+"---"+gamount)
	if (parent.gamecount!=gamount){
		keepGameData=new Array();
	}	
	if(top.odd_f_type==""||""+top.odd_f_type=="undefined") top.odd_f_type="H";
	ShowData_PD(game_table,GameFT,gamount,top.odd_f_type);
	parent.gamecount=gamount;			
	show_page();
}  
function show_page(){
	pg_str='';
	obj_pg = body_browse.document.getElementById('pg_txt');
	if(eval("parent."+sel_gtype+"_lid_ary")=='ALL'&&!top.swShowLoveI){
		for(var i=0;i< t_page ; i++){	
		  	if (pg!=i)
		  		pg_str=pg_str+"<a href=# onclick='chg_pg("+i+");'>"+(i+1)+"</a>&nbsp;&nbsp;&nbsp;&nbsp;";
		  	else
		  		pg_str=pg_str+(i+1)+"&nbsp;&nbsp;&nbsp;&nbsp;";
		}
	}
	obj_pg.innerHTML = pg_str;
}
//------波膽顯示------ 
function ShowData_PD(obj_table,GameData,data_amount,odd_f_type){
  	var nowLeague = '';
	var nowDate = '';
 
	with(obj_table){
		//清除table資料
		while(rows.length > 1)
			deleteRow(rows.length-1);
		//開始顯示開放中賽程資料
		for(i=0; i<data_amount; i++){
			if(MM_IdentificationDisplay(GameData[i][1],GameData[i][3]))continue;
			//if(eval('top.'+top.sel_gtype+'_lname_ary').indexOf(GameData[i][2]+"-",0)==-1&&eval('top.'+top.sel_gtype+'_lname_ary')!='ALL') continue;
			if(("-"+eval('parent.'+sel_gtype+'_lname_ary')).indexOf(("-"+GameData[i][2].replace(/&#/g,"+-")+"-"),0)==-1&&eval('parent.'+sel_gtype+'_lname_ary')!='ALL') continue;
			var ar=0;
			flag = false;
			for(j=8; j<=25; j++)
				if(GameData[i][j] == '0'||GameData[i][j]==""){ ar++; 
					GameData[i][j]="";
				}
			if(ar=='18') continue			
			//判斷聯盟是否相同不同加一列顯示聯盟
			gdate = GameData[i][1].substr(0,5);
			if(nowLeague != GameData[i][2] || nowDate != gdate){
				nowLeague = GameData[i][2];
				nowDate = gdate;
				nowTR = insertRow();
				with(nowTR){
					nowTD = insertCell();
					nowTD.colSpan = 18;
					nowTD.className = 'b_hline';
					nowTD.innerHTML = GameData[i][2];
					//nowTD.innerHTML = "<table border=\"0\"  width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td class=\"b_h_txt\">"+GameData[i][2]+"</td>"+
					//	"<td class=\"b_h_but\"><input type=\"button\" name=\"ReloadLeague"+i+"\" value=\""+top.str_renew+"\" title=\""+top.str_renew+"\" onClick=\"javascript:reload_var();\" ></td></tr></table>";
				}
			}
			
			nowTR = insertRow();
			nowTR.className = 'b_cen';
			with(nowTR){
			    //滾球字眼
			    GameData[i][1]=GameData[i][1].replace("Running Ball","");
				//日期時間
				nowTD = insertCell();
				nowTD.rowSpan = 2;
				nowTD.innerHTML = GameData[i][1];
				//隊伍--主隊名
				nowTD = nowTR.insertCell();
				nowTD.align = 'left';
				nowTD.innerHTML = GameData[i][5];
				//波膽
				nowTD = insertCell(); //H1C0
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH1\" target=\"mem_order\" title="+1"><font '+checkRatio_font(i,8)+'>'+GameData[i][8]+'</A></font>';
				nowTD = insertCell(); //H2C0                                                                      
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH2\" target=\"mem_order\" title="+2"><font '+checkRatio_font(i,9)+'>'+GameData[i][9]+'</A></font>';
				nowTD = insertCell(); //H2C1                                                                      
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH3\" target=\"mem_order\" title="+3"><font '+checkRatio_font(i,10)+'>'+GameData[i][10]+'</A></font>';
				nowTD = insertCell(); //H3C0                                                                      
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH4\" target=\"mem_order\" title="+4"><font '+checkRatio_font(i,11)+'>'+GameData[i][11]+'</A></font>';
				nowTD = insertCell(); //H3C1                                                                      
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH5\" target=\"mem_order\" title="+5"><font '+checkRatio_font(i,12)+'>'+GameData[i][12]+'</A></font>';
				nowTD = insertCell(); //H3C2                                                                      
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH6\" target=\"mem_order\" title="+6"><font '+checkRatio_font(i,13)+'>'+GameData[i][13]+'</A></font>';
				nowTD = insertCell(); //H4C0                                                                      
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH7\" target=\"mem_order\" title="+7"><font '+checkRatio_font(i,14)+'>'+GameData[i][14]+'</A></font>';
				nowTD = insertCell(); //H4C1                                                                      
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH8\" target=\"mem_order\" title="+8"><font '+checkRatio_font(i,15)+'>'+GameData[i][15]+'</A></font>';
				nowTD = insertCell(); //H4C2                                                                      
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDH9\" target=\"mem_order\" title="+9up"><font '+checkRatio_font(i,16)+'>'+GameData[i][16]+'</A></font>';
			}//主隊TR結束
    
			nowTR = insertRow();
			nowTR.className = 'b_cen';
			with(nowTR){
				//隊伍--客隊名
				nowTD = nowTR.insertCell();
				nowTD.align = 'left';
				nowTD.innerHTML = GameData[i][6];
				//波膽
				nowTD = insertCell(); //H0C1
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC1\" target=\"mem_order\" title="-1"><font '+checkRatio_font(i,17)+'>'+GameData[i][17]+'</A></font>';
				nowTD = insertCell(); //H0C2                                                                          
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC2\" target=\"mem_order\" title="-2"><font '+checkRatio_font(i,18)+'>'+GameData[i][18]+'</A></font>';
				nowTD = insertCell(); //H1C2                                                                          
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC3\" target=\"mem_order\" title="-3"><font '+checkRatio_font(i,19)+'>'+GameData[i][19]+'</A></font>';
				nowTD = insertCell(); //H0C3                                                                          
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC4\" target=\"mem_order\" title="-4"><font '+checkRatio_font(i,20)+'>'+GameData[i][20]+'</A></font>';
				nowTD = insertCell(); //H1C3                                                                          
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC5\" target=\"mem_order\" title="-5"><font '+checkRatio_font(i,21)+'>'+GameData[i][21]+'</A></font>';
				nowTD = insertCell(); //H2C3                                                                          
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC6\" target=\"mem_order\" title="-6"><font '+checkRatio_font(i,22)+'>'+GameData[i][22]+'</A></font>';
				nowTD = insertCell(); //H0C4                                                                          
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC7\" target=\"mem_order\" title="-7"><font '+checkRatio_font(i,23)+'>'+GameData[i][23]+'</A></font>';
				nowTD = insertCell(); //H1C4                                                                          
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC8\" target=\"mem_order\" title="-8"><font '+checkRatio_font(i,24)+'>'+GameData[i][24]+'</A></font>';
				nowTD = insertCell(); //H2C4                                                                          
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_pd.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=PDC9\" target=\"mem_order\" title="-9up"><font '+checkRatio_font(i,25)+'>'+GameData[i][25]+'</A></font>';
			}//客隊TR結束
			
			nowTR = insertRow();
			with(nowTR){
				nowTD = insertCell();
				nowTD.colSpan = 18;
				nowTD.height = 1;
			}//分隔線TR
		}
	}//with(obj_table);
}//顯示波膽結束
</script>
<?
break;
case 't':
?>
<script> 
function ShowGameList(){
	if(loading == 'Y') return;
	obj_msg = body_browse.document.getElementById('real_msg');
	obj_msg.innerHTML = '<marquee scrolldelay=\"120\">'+msg+'</marquee>';
	game_table = body_browse.document.getElementById('game_table');
	//alert(keepGameData.length+"---"+gamount)
	if (parent.gamecount!=gamount){
		keepGameData=new Array();
	}	
	if(top.odd_f_type==""||""+top.odd_f_type=="undefined") top.odd_f_type="H";
	ShowData_EO(game_table,GameFT,gamount,top.odd_f_type);
	parent.gamecount=gamount;			
	show_page();
}
function show_page(){
	pg_str='';
	obj_pg = body_browse.document.getElementById('pg_txt');
	if(eval("parent."+sel_gtype+"_lid_ary")=='ALL'&&!top.swShowLoveI){
		for(var i=0;i < parent.t_page; i++){
		  	if (pg!=i)
		  		pg_str=pg_str+"<a href=# onclick='chg_pg("+i+");'>"+(i+1)+"</a>&nbsp;&nbsp;&nbsp;&nbsp;";
		  	else
		  		pg_str=pg_str+(i+1)+"&nbsp;&nbsp;&nbsp;&nbsp;";
		}
	}
	obj_pg.innerHTML = pg_str;
}
 //------總入球顯示------
function ShowData_EO(obj_table,GameData,data_amount,odd_f_type){
	var nowLeague = '';
	var nowDate = '';
 
	with(obj_table){
		//清除table資料
		while(rows.length > 1)
			deleteRow(rows.length-1);
		//開始顯示總入球賽程資料
		for(i=0; i<data_amount; i++){
			if(MM_IdentificationDisplay(GameData[i][1],GameData[i][3]))continue;
			//if(eval('top.'+top.sel_gtype+'_lname_ary').indexOf(GameData[i][2]+"-",0)==-1&&eval('top.'+top.sel_gtype+'_lname_ary')!='ALL') continue;
			if(("-"+eval('parent.'+sel_gtype+'_lname_ary')).indexOf(("-"+GameData[i][2].replace(/&#/g,"+-")+"-"),0)==-1&&eval('parent.'+sel_gtype+'_lname_ary')!='ALL') continue;
			//判斷是否單雙或總入球都有賠率
			//if(!(GameData[i][8]&&GameData[i][9]) && (!GameData[i][10]&&!GameData[i][11]&&!GameData[i][12]&&!GameData[i][13]))
			if ((GameData[i][22]*1) <= 0) {
				GameData[i][22]='';
				if ((GameData[i][20]*1) <= 0 || (GameData[i][21]*1) <= 0) {
					GameData[i][20]='';
					GameData[i][21]='';
				}
			}
			if((!GameData[i][10]&&!GameData[i][11]&&!GameData[i][12]&&!GameData[i][13]&&!GameData[i][14]&&!GameData[i][15]&&!GameData[i][16]&&!GameData[i][17]&&!GameData[i][18]&&!GameData[i][19]) && (!GameData[i][20]&&!GameData[i][21]&&!GameData[i][22]))
			continue;
//			if ((GameData[i][20]*1) <= 0 || (GameData[i][21]*1) <= 0 || (GameData[i][22]*1) <= 0) {
//				GameData[i][20]='&nbsp;';
//				GameData[i][21]='&nbsp;';
//				GameData[i][22]='&nbsp;';
//			}
			//判斷聯盟是否相同不同加一列顯示聯盟
			gdate = GameData[i][1].substr(0,5);
			if(nowLeague != GameData[i][2] || nowDate != gdate){
				nowLeague = GameData[i][2];
				nowDate = gdate;
				nowTR = insertRow();
				with(nowTR){
					nowTD = insertCell();
					nowTD.colSpan = 13;
					nowTD.className = 'b_hline';
					nowTD.innerHTML = GameData[i][2];
					//nowTD.innerHTML = "<table border=\"0\"  width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td class=\"b_h_txt\">"+GameData[i][2]+"</td>"+
					//	"<td class=\"b_h_but\"><input type=\"button\" name=\"ReloadLeague"+i+"\" value=\""+top.str_renew+"\" title=\""+top.str_renew+"\" onClick=\"javascript:reload_var();\" ></td></tr></table>";
				}
			}
 
			//日期時間
			nowTR = insertRow();
			nowTR.className = 'b_cen';
			with(nowTR){
			    //滾球字眼
			    GameData[i][1]=GameData[i][1].replace("Running Ball","");
				//日期時間			
    			nowTD = insertCell();
    			nowTD.rowSpan = 3;
    			nowTD.innerHTML = GameData[i][1]+'<BR>';
				//隊伍
				nowTR.className = 'b_cen';
				nowTD = nowTR.insertCell();
				nowTD.rowSpan = 2;
				nowTD.align = 'left';
				nowTD.innerHTML = GameData[i][5]+'<BR>'+GameData[i][6];
				tmp_data=(GameData[i][5].replace("<font color=#FF0000>","")).replace("</font>","");;				
				/*
				//單數
				nowTD = insertCell();
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=ODD\" target=\"mem_order\">'+GameData[i][8]+'</A>';
				//雙數
				nowTD = insertCell();
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=EVEN\" target=\"mem_order\">'+GameData[i][9]+'</A>';
				*/
 
				//獨贏主隊
				nowTD = insertCell();
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_m.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=H&gnum='+GameData[i][3]+'\" target=\"mem_order\"  title=\"'+tmp_data+'\"><font '+checkRatio_font(i,20)+'>'+GameData[i][20]+'</A></font>';
				
				//0~1
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=1~2\" target=\"mem_order\" title="1~2"><font '+checkRatio_font(i,10)+'>'+GameData[i][10]+'</A></font>';
				//2~3
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=3~4\" target=\"mem_order\" title="3~4"><font '+checkRatio_font(i,11)+'>'+GameData[i][11]+'</A></font>';
				//4~6
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=5~6\" target=\"mem_order\" title="5~6"><font '+checkRatio_font(i,12)+'>'+GameData[i][12]+'</A></font>';
				//0~1
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=7~8\" target=\"mem_order\" title="7~8"><font '+checkRatio_font(i,13)+'>'+GameData[i][13]+'</A></font>';
				//2~3
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=9~10\" target=\"mem_order\" title="9~10"><font '+checkRatio_font(i,14)+'>'+GameData[i][14]+'</A></font>';
				//4~6
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=11~12\" target=\"mem_order\" title="11~12"><font '+checkRatio_font(i,15)+'>'+GameData[i][15]+'</A></font>';
				//0~1
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=13~14\" target=\"mem_order\" title="13~14"><font '+checkRatio_font(i,16)+'>'+GameData[i][16]+'</A></font>';
				//2~3
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=15~16\" target=\"mem_order\" title="15~16"><font '+checkRatio_font(i,17)+'>'+GameData[i][17]+'</A></font>';
				//4~6
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=17~18\" target=\"mem_order\" title="17~18"><font '+checkRatio_font(i,18)+'>'+GameData[i][18]+'</A></font>';						
				//OVER
				nowTD = insertCell();
				nowTD.rowSpan = 3;
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_t.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&rtype=T19\" target=\"mem_order\" title="19up"><font '+checkRatio_font(i,19)+'>'+GameData[i][19]+'</A></font>';
			}
			nowTR = insertRow();
			nowTR.className = 'b_cen';
			with(nowTR){
				nowTD = insertCell();
				tmp_data=(GameData[i][5].replace("<font color=#FF0000>","")).replace("</font>","");;				
				nowTD.innerHTML = '<a href=\"../BS_order/BS_order_m.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=C&gnum='+GameData[i][3]+'\" target=\"mem_order\" title=\"'+tmp_data+'\"><font '+checkRatio_font(i,21)+'>'+GameData[i][21]+'</A></font>';
			}
			nowTR = insertRow();
			nowTR.className = 'b_cen';
			with(nowTR){
				nowTD = insertCell();
				nowTD.align = 'left';
				nowTD.innerHTML = str_even;
				//獨贏和局
				nowTD = insertCell();
				nowTD.innerHTML = '<A href=\"../BS_order/BS_order_m.php?gid='+GameData[i][0]+'&uid='+uid+'&odd_f_type='+odd_f_type+'&type=N&gnum='+GameData[i][4]+'\" target=\"mem_order\" title=\"'+str_even+'\"><font '+checkRatio_font(i,22)+'>'+GameData[i][22]+'</A></font>';
				//nowTD = insertCell();
				//nowTD.colSpan = 2;
			}//和局TR結束
			nowTR = insertRow();
			with(nowTR){
				nowTD = insertCell();
				nowTD.colSpan = 13;
				nowTD.height = 1;
			}//分隔線TR
 
		}
	}//with(obj_table);
}//顯示總入球結束
</script>
<?
break;
case 'p':
?>
<script> 
function ShowGameList(){
	if(loading == 'Y') return;
	obj_msg = body_browse.document.getElementById('real_msg');
	obj_msg.innerHTML = '<marquee scrolldelay=\"120\">'+msg+'</marquee>';
	game_table = body_browse.document.getElementById('game_table');
	//alert(keepGameData.length+"---"+gamount)
	if (parent.gamecount!=gamount){
		keepGameData=new Array();
	}	
	ShowData_P(game_table,GameFT,gamount);
	parent.gamecount=gamount;		
}  
//------標準過關顯示------ 
function ShowData_P(obj_div,GameData,data_amount){
	var nowLeague = '';
	var nowDate = '';
	var showDate = '';
	var firstFlag = 1;
 
	gcount = 0;
	gc = 0;
	//清除div資料
	obj_div.innerHTML = "";
	//開始顯示標準過關賽程資料
	for(i=0; i<data_amount; i++){
		if(MM_IdentificationDisplay(GameData[i][1],GameData[i][3]))continue;
		if(("-"+eval('parent.'+sel_gtype+'_lname_ary')).indexOf(("-"+GameData[i][2]+"-"),0)==-1&&eval('parent.'+sel_gtype+'_lname_ary')!='ALL') {gc++;continue;}
		//判斷是否獨贏三個賠率都有值,否則不顯示
		//if(GameData[i][8]=='' || GameData[i][9]=='' || GameData[i][10]==''){
		if(GameData[i][8]=='' || GameData[i][9]=='' ){
			gc++;
			continue;
		}
		//判斷聯盟是否相同不同加一列顯示聯盟
		//滾球字眼過關只秀時間
		GameData[i][1]=GameData[i][1].replace("<br><font color=red>Running Ball</font>","");		
		gdate = GameData[i][1].substr(0,5);
		if(nowLeague != GameData[i][2] || nowDate != gdate){
			if(nowDate != gdate){
				if(!firstFlag){
					nowTR = obj_table.insertRow();
					nowTR .bgColor = '#FFFFFF';
					nowTR.align = 'center';
					nowTR.height = 30;
					nowTD = nowTR.insertCell();
					nowTD.colSpan = 6;
					if(gcount > 1){
						nowTD.innerHTML = '<INPUT TYPE=\"HIDDEN\" NAME=\"teamcount\" VALUE=\"'+gcount+'\">'+
//						                  '<INPUT TYPE=\"HIDDEN\" NAME=\"active\" VALUE=\"1\">'+
						                  '<INPUT TYPE=\"HIDDEN\" NAME=\"uid\" VALUE=\"'+uid+'\">'+
						                  '<input type=SUBMIT id=\"TEAM'+showDate+'\" value=\"'+str_submit+'\" class=\"yes\">&nbsp;&nbsp;&nbsp;';
					}
					nowTD.innerHTML += '<input type=BUTTON name=\"cancel2\" value=\"'+str_reset+'\" class=\"no\" onClick=\"parent.ShowGameList();\">';
				}//if(!firstFlag)
				firstFlag = 0;
				nowDate = gdate;
				showDate = gdate.substr(0,2)+''+gdate.substr(3,2);
				gcount = 0;
				obj_div.innerHTML += 	'<TABLE ID=\"gtable'+showDate+'\" width=\"526\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" class=\"game\">'+
							'<TR><TD><FORM ID=\"form'+showDate+'\" NAME=\"form'+showDate+'\" ACTION=\"/app/member/BS_order/BS_order_p.php\" METHOD=POST onSubmit=\"return ChkSelect(\''+showDate+'\'); reload_var();\" target=\"mem_order\"></TD></TR>'+
							'</TABLE></FORM>';
				obj_table = body_browse.document.getElementById('gtable'+showDate);
			}//if(nowDate != gdate)
 
			nowLeague = GameData[i][2];
			nowTR = obj_table.insertRow();
			nowTD = nowTR.insertCell();
			nowTD.className = 'b_hline';
			nowTD.colSpan = 8;
			nowTD.innerHTML = GameData[i][2]+'&nbsp;&nbsp;'+nowDate;
						//nowTD.innerHTML = "<table border=\"0\"  width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td class=\"b_h_txt\">"+GameData[i][2]+"&nbsp;&nbsp;"+nowDate+"</td>"+
						//	  "<td class=\"b_h_but\"><input type=\"button\" name=\"ReloadLeague"+i+"\" value=\""+top.str_renew+"\" title=\""+top.str_renew+"\" onClick=\"javascript:reload_var();\" ></td></tr></table>";
		}//if(nowLeague != GameData[i][2] || nowDate != gdate)
 
		gcount++;
		nowTR = obj_table.insertRow();
		nowTR.className = 'b_cen';
		with(nowTR){
			//日期時間(過關只秀時間)
			nowTD = insertCell();
			nowTD.align = 'center';
			nowTD.width = 40;
			nowTD.innerHTML = '<INPUT type=\"HIDDEN\" NAME=\"game_id'+gcount+'\" VALUE=\"'+GameData[i][0]+'\">'+GameData[i][1].slice(-6,15);
			//隊伍主隊
			nowTD = nowTR.insertCell();
			nowTD.width = 156;
			nowTD.innerHTML = GameData[i][5];
			//主隊獨贏賠率
			nowTD = insertCell();
			nowTD.className = 'b_radio';
			nowTD.width = 55;
			tmp_data=(GameData[i][5].replace("<font color=#FF0000>","")).replace("</font>","");;				
 
			nowTD.innerHTML = '<input type=\"radio\" name=\"game'+gcount+'\" value=\"PH\" class=\"za_dot\" title=\"'+tmp_data+'\">&nbsp;<b><font '+checkRatio_font(i,8)+' color=\"#006600\">'+GameData[i][8]+'</font></b>';
			//和局賠率
			nowTD = insertCell();
			nowTD.className = 'b_pradio';
			nowTD.width = 57;
			if (!GameData[i][10]==''){
				nowTD.innerHTML = '<input type=\"radio\" name=\"game'+gcount+'\" value=\"PN\" class=\"za_dot\" title=\"'+str_even+'\">&nbsp;<b><font '+checkRatio_font(i,10)+' color=\"#CC0000\">'+GameData[i][10]+'</font></b>';
			}else{	
				nowTD.innerHTML ='<b>VS.</b>';
			}
			//客隊獨贏賠率
			nowTD = insertCell();
			nowTD.className = 'b_radio';
			nowTD.width = 55;
			tmp_data=(GameData[i][6].replace("<font color=#FF0000>","")).replace("</font>","");;				
 
			nowTD.innerHTML = '<input type=\"radio\" name=\"game'+gcount+'\" value=\"PC\" class=\"za_dot\" title=\"'+tmp_data+'\">&nbsp;<b><font '+checkRatio_font(i,9)+' color=\"#006600\">'+GameData[i][9]+'</font></b>';
			//隊伍客隊
			nowTD = insertCell();
			nowTD.width = 160;
			nowTD.innerHTML = GameData[i][6];
		}//with(nowTR)
	}//dada_amount迴圈結束
	//判斷賽事數量兩場以上就顯示確認按鈕
	if((data_amount-gc)!=0){
		nowTR = obj_table.insertRow();
		nowTR .bgColor = '#FFFFFF';
		nowTR.align = 'center';
		nowTR.height = 30;
		nowTD = nowTR.insertCell();
		nowTD.colSpan = 6;
		if(gcount > 1){
			nowTD.innerHTML = '<INPUT TYPE=\"HIDDEN\" NAME=\"teamcount\" VALUE=\"'+gcount+'\">'+
//			                  '<INPUT TYPE=\"HIDDEN\" NAME=\"active\" VALUE=\"1\">'+
			                  '<INPUT TYPE=\"HIDDEN\" NAME=\"uid\" VALUE=\"'+uid+'\">'+
			                  '<input type=SUBMIT id=\"TEAM'+showDate+'\" value=\"'+str_submit+'\" class=\"yes\">&nbsp;&nbsp;&nbsp;';
		}
		nowTD.innerHTML += '<input type=BUTTON name=\"cancel2\" value=\"'+str_reset+'\" class=\"no\" onClick=\"parent.ShowGameList();\">';
	}
}//標準過關結束
</script>
<?
break;
case 'pr':
?>
<script> 
function ShowGameList() {
	if(loading == 'Y') return;
	obj_msg = body_browse.document.getElementById('real_msg');
	obj_msg.innerHTML = '<marquee scrolldelay=\"120\">'+msg+'</marquee>';
	game_table = body_browse.document.getElementById('game_table');
	//alert(keepGameData.length+"---"+gamount)
	if (parent.gamecount!=gamount){
		keepGameData=new Array();
	}
	ShowData_PR(game_table,GameFT,gamount);
	parent.gamecount=gamount;
}
 
//------讓球過關顯示------
function ShowData_PR(obj_div,GameData,data_amount)
{
   /*------------------------------------------------
   * 最後修改日期 --- 2005/7/19						*
   * 修改者   --- anson								*
   * 修改部份 --- function ShowData_PR ()			*
   -------------------------------------------------*/
 
/* GameFT Array		gid, gdate, league, gnum_h, gnum_c, team_h, team_c, strong, 讓球球頭, PRH賠率, PRC賠率, 大小球頭, POUH賠率, POUC賠率
					 0	   1	  2		  3		  4		  5		  6		  7			8		9		 10		  11,12		13			14
*/
	var nowLeague = '';
	var nowDate = '';
	var firstFlag = 1;
 
	gcount = 0;
	gc = 0;
	//清除div資料
	obj_div.innerHTML = "";
 
	//開始顯示讓球過關賽程資料
	for(i=0; i<data_amount; i++){
		if(MM_IdentificationDisplay(GameData[i][1],GameData[i][3]))continue;
		//if(eval('top.'+top.sel_gtype+'_lname_ary').indexOf(GameData[i][2]+"-",0)==-1&&eval('top.'+top.sel_gtype+'_lname_ary')!='ALL') continue;
		if(("-"+eval('parent.'+sel_gtype+'_lname_ary')).indexOf(("-"+GameData[i][2].replace(/&#/g,"+-")+"-"),0)==-1&&eval('parent.'+sel_gtype+'_lname_ary')!='ALL') {gc++;continue;}
		//判斷是否讓球兩個賠率都有值,否則不顯示
		if((GameData[i][9]=='' || GameData[i][10]=='') && (GameData[i][12]=="" || GameData[i][13]== "")){
			gc++;
			continue;
		}
 
		//判斷聯盟是否相同不同加一列顯示聯盟
		//滾球字眼過關只秀時間
		GameData[i][1]=GameData[i][1].replace("<br><font color=red>Running Ball</font>","");		
		gdate = GameData[i][1].substr(0,5);
		if(nowLeague != GameData[i][2] || nowDate != gdate){
			if(nowDate != gdate){
				if(!firstFlag){
					nowTR = obj_table.insertRow();
					nowTR.bgColor = '#FFFFFF';
					nowTR.align = 'center';
					nowTR.height = 30;
					nowTD = nowTR.insertCell();
					nowTD.colSpan = 5;
 
					if(gcount > 1){
						nowTD.innerHTML = '<INPUT TYPE=\"HIDDEN\" NAME=\"teamcount\" VALUE=\"'+gcount+'\">'+
//										  '<INPUT TYPE=\"HIDDEN\" NAME=\"active\" VALUE=\"1\">'+
										  '<INPUT TYPE=\"HIDDEN\" NAME=\"uid\" VALUE=\"'+uid+'\">'+
										  '<input type=SUBMIT id=\"TEAM'+showDate+'\" value=\"'+str_submit+'\" class=\"yes\">&nbsp;&nbsp;&nbsp;';
					}
 
					nowTD.innerHTML += '<input type=BUTTON name=\"cancel2\" value=\"'+str_reset+'\" class=\"no\" onClick=\"parent.ShowGameList();\">';
				}//if(!firstFlag)
				firstFlag = 0;
				nowDate = gdate;
				showDate = gdate.substr(0,2)+''+gdate.substr(3,2);
				gcount = 0;
				obj_div.innerHTML += '<TABLE ID=\"gtable'+showDate+'\" width=\"526\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" class=\"game\">'+
									 '<TR><TD><FORM ID=\"form'+showDate+'\" NAME=\"form'+showDate+'\" ACTION=\"/app/member/BS_order/BS_order_pr.php\" METHOD=POST onSubmit=\"return ChkSelect(\''+showDate+'\'); reload_var();\" target=\"mem_order\"></TD></TR>'+
									 '</TABLE></FORM>';
				obj_table = body_browse.document.getElementById('gtable'+showDate);
			}//if(nowDate != gdate)
 
			nowLeague = GameData[i][2];
			nowTR = obj_table.insertRow();
			nowTD = nowTR.insertCell();
			nowTD.className = 'b_hline';
			nowTD.colSpan = 5;
			nowTD.innerHTML = GameData[i][2]+'&nbsp;&nbsp;'+nowDate;
						//nowTD.innerHTML = "<table border=\"0\"  width=\"100%\" cellspacing=\"0\" cellpadding=\"0\"><tr><td class=\"b_h_txt\">"+GameData[i][2]+"&nbsp;&nbsp;"+nowDate+"</td>"+
						//	  "<td class=\"b_h_but\"><input type=\"button\" name=\"ReloadLeague"+i+"\" value=\""+top.str_renew+"\" title=\""+top.str_renew+"\" onClick=\"javascript:reload_var();\" ></td></tr></table>";
		}//if(nowLeague != GameData[i][2] || nowDate != gdate)
 
		gcount++;
		nowTR = obj_table.insertRow();
		nowTR.className = 'b_cen';
		with(nowTR){
			var tmp_team = "";
			//日期時間(過關只秀時間)
			nowTD = insertCell();
			nowTD.width = 40;
			nowTD.innerHTML = '<INPUT type=\"HIDDEN\" NAME=\"game_id'+gcount+'\" VALUE=\"'+GameData[i][0]+'\">'+GameData[i][1].slice(-6,15);
			//場次
			nowTD = insertCell();
			nowTD.width = 40;
			nowTD.innerHTML = GameData[i][3]+"<BR>"+GameData[i][4];
			// 主客隊名
			nowTD = insertCell();
			nowTD.width = 176;
			nowTD.align = "left";
			nowTD.innerHTML = GameData[i][5]+"<BR>"+GameData[i][6];
 
			//==== 讓球
			nowTD = insertCell();
			nowTD.align = "right";
			nowTD.width = 115;
			if (GameData[i][9] != "" && GameData[i][10] != ""){
				//強隊讓球賠率
				tmp_data=(GameData[i][5].replace("<font color=#FF0000>","")).replace("</font>","");;
 
				if(GameData[i][7] == 'H') {tmp_team = "<font "+checkRatio_font(i,8)+" color='#000000'>"+GameData[i][8]+"</font>&nbsp;&nbsp;";}
				tmp_team += "<font "+checkRatio_font(i,9)+" color='#CC0000'><B>"+GameData[i][9]+"</B></font>&nbsp;<input type='radio' name='game"+gcount+"' value='PRH' class='za_dot' title=\""+tmp_data+"\">&nbsp;<BR>";
				//強隊是客隊
				tmp_data=(GameData[i][6].replace("<font color=#FF0000>","")).replace("</font>","");;
 
				if(GameData[i][7] == 'C') {tmp_team += "<font "+checkRatio_font(i,8)+" color='#000000'>"+GameData[i][8]+"</font>&nbsp;&nbsp;";}
				tmp_team += "<font "+checkRatio_font(i,10)+" color='#CC0000'><B>"+GameData[i][10]+"</B></font>&nbsp;<input type='radio' name='game"+gcount+"' value='PRC' class='za_dot' title=\""+tmp_data+"\">&nbsp;";
				nowTD.innerHTML = tmp_team;
			}
 
			//==== 大小球
			nowTD = insertCell();
			nowTD.align = "right";
			nowTD.width = 115;
			if (GameData[i][13] != "" && GameData[i][14] != ""){
				tmp_team  = "<font "+checkRatio_font(i,11)+" color='#000000'>"+GameData[i][11]+"</font>&nbsp;&nbsp;";	//大
				tmp_data=(GameData[i][5].replace("<font color=#FF0000>","")).replace("</font>","");;
				if(langx=="zh-tw"){
						title_str="大";
					}
					if(langx=="zh-cn"){
						title_str="大";
					}
					if(langx=="en-us"||langx=="th-tis"){
						title_str="Over";
					}
				tmp_team += "<font "+checkRatio_font(i,13)+" color='#CC0000'><B>"+GameData[i][13]+"</B></font>&nbsp;<input type='radio' name='game"+gcount+"' value='POUC' class='za_dot' title=\""+title_str+"\">&nbsp;";
				tmp_team += "<BR>";
				if(langx=="zh-tw"){
						title_str="小";
					}
					if(langx=="zh-cn"){
						title_str="小";
					}
					if(langx=="en-us"||langx=="th-tis"){
						title_str="Under";
					}
				tmp_team += "<font "+checkRatio_font(i,12)+" color='#000000'>"+GameData[i][12]+"</font>&nbsp;&nbsp;";	//小
				tmp_data=(GameData[i][6].replace("<font color=#FF0000>","")).replace("</font>","");;
 
				tmp_team += "<font "+checkRatio_font(i,14)+" color='#CC0000'><B>"+GameData[i][14]+"</B></font>&nbsp;<input type='radio' name='game"+gcount+"' value='POUH' class='za_dot' title=\""+title_str+"\">&nbsp;";
				nowTD.innerHTML = tmp_team;
			}
		}
	}//with(nowTR)
 
	//判斷賽事數量兩場以上就顯示確認按鈕
	if((data_amount-gc)!=0){
		nowTR = obj_table.insertRow();
		nowTR .bgColor = '#FFFFFF';
		nowTR.align = 'center';
		nowTR.height = 30;
		nowTD = nowTR.insertCell();
		nowTD.colSpan = 5;
		if(gcount > 1){
			nowTD.innerHTML = '<INPUT TYPE=\"HIDDEN\" NAME=\"teamcount\" VALUE=\"'+gcount+'\">'+
//							  '<INPUT TYPE=\"HIDDEN\" NAME=\"active\" VALUE=\"1\">'+
							  '<INPUT TYPE=\"HIDDEN\" NAME=\"uid\" VALUE=\"'+uid+'\">'+
							  '<input type=SUBMIT id=\"TEAM'+showDate+'\" value=\"'+str_submit+'\" class=\"yes\">&nbsp;&nbsp;&nbsp;';
		}
		nowTD.innerHTML += '<input type=BUTTON name=\"cancel2\" value=\"'+str_reset+'\" class=\"no\" onClick=\"parent.ShowGameList();\">';
	}
}//讓球過關結束
</script>
<?
break;
}
?>
<!--SCRIPT language=javaScript src="/js/BS_mem_showgame_r.js" type=text/javascript></SCRIPT-->
<SCRIPT LANGUAGE="JAVASCRIPT"> 
<!--
//if(self == top) location='http://122.152.134.9/app/member/';
 
var username='';
var maxcredit='';
var code='';
 
var sel_league='';
var uid=''; //user's session ID
var loading = 'Y'; //是否正在讀取瀏覽頁面
var loading_var = 'Y'; //是否正在讀取變數值頁面
var ShowType = ''; //目前顯示頁面
var ltype = 1; //目前顯示line
var retime_flag = 'N'; //自動更新旗標
var retime = 0; //自動更新時間
var pg=0;
var str_even = '和局';
var str_renew = '秒自動更新';
var str_submit = '確認';
var str_reset = '重設';
 
var num_page = 20; //設定20筆賽程一頁
var now_page = 1; //目前顯示頁面
var pages = 1; //總頁數
var msg = ''; //即時資訊
var gamount = 0; //目前顯示一般賽程數
var GameFT = new Array(512); //最多設定顯示512筆開放賽程
for(var i=0; i<512; i++){
 	GameFT[i] = new Array(34); //為各賽程宣告 34 個欄位
}
var sel_gtype='BSFU';
var iorpoints=3;
// -->
</SCRIPT>
</head>
<frameset rows="0,*" frameborder="NO" border="0" framespacing="0">
	<frame name="body_var" scrolling="NO" noresize src="body_var.php?uid=<?=$uid?>&rtype=<?=$rtype?>&langx=<?=$langx?>&g_date=<?=$date?>&mtype=3&league_id=<?=$league_id?>">
	<frame name="body_browse" src="body_browse.php?uid=<?=$uid?>&rtype=<?=$rtype?>&langx=<?=$langx?>&g_date=<?=$date?>&mtype=3">
</frameset>
<noframes><body bgcolor="#FFFFFF">
 
</body></noframes>
</html>

