﻿<?
header("Expires: Mon, 26 Jul 1970 05:00:00 GMT");          
header("Cache-Control: no-cache, must-revalidate");      
header("Pragma: no-cache");
header("Content-type: text/html; charset=utf-8");
require ("../include/config.inc.php");
$agents=$_REQUEST['agents'];
if ($agents==''){
	$agent='ddm999';
}else{
	$agent=$agents;
}

$sql = "select * from web_agents_data where UserName='$agent'";
$result = mysql_db_query($dbname,$sql);
$row = mysql_fetch_array($result);

$world=$row['World'];
$corprator=$row['Corprator'];
$super=$row['Super'];
$admin=$row['Admin'];
$sports=$row['Sports'];
$lottery=$row['Lottery'];

$FT_Turn_R_A=$row['FT_Turn_R_A'];
$FT_Turn_R_B=$row['FT_Turn_R_B'];
$FT_Turn_R_C=$row['FT_Turn_R_C'];
$FT_Turn_R_D=$row['FT_Turn_R_D'];
$FT_R_Bet=$row['FT_R_Bet'];
$FT_R_Scene=$row['FT_R_Scene'];
$FT_Turn_OU_A=$row['FT_Turn_OU_A'];
$FT_Turn_OU_B=$row['FT_Turn_OU_B'];
$FT_Turn_OU_C=$row['FT_Turn_OU_C'];
$FT_Turn_OU_D=$row['FT_Turn_OU_D'];
$FT_OU_Bet=$row['FT_OU_Bet'];
$FT_OU_Scene=$row['FT_OU_Scene'];
$FT_Turn_VR_A=$row['FT_Turn_VR_A'];
$FT_Turn_VR_B=$row['FT_Turn_VR_B'];
$FT_Turn_VR_C=$row['FT_Turn_VR_C'];
$FT_Turn_VR_D=$row['FT_Turn_VR_D'];
$FT_VR_Bet=$row['FT_VR_Bet'];
$FT_VR_Scene=$row['FT_VR_Scene'];
$FT_Turn_VOU_A=$row['FT_Turn_VOU_A'];
$FT_Turn_VOU_B=$row['FT_Turn_VOU_B'];
$FT_Turn_VOU_C=$row['FT_Turn_VOU_C'];
$FT_Turn_VOU_D=$row['FT_Turn_VOU_D'];
$FT_VOU_Bet=$row['FT_VOU_Bet'];
$FT_VOU_Scene=$row['FT_VOU_Scene'];
$FT_Turn_RE_A=$row['FT_Turn_RE_A'];
$FT_Turn_RE_B=$row['FT_Turn_RE_B'];
$FT_Turn_RE_C=$row['FT_Turn_RE_C'];
$FT_Turn_RE_D=$row['FT_Turn_RE_D'];
$FT_RE_Bet=$row['FT_RE_Bet'];
$FT_RE_Scene=$row['FT_RE_Scene'];
$FT_Turn_ROU_A=$row['FT_Turn_ROU_A'];
$FT_Turn_ROU_B=$row['FT_Turn_ROU_B'];
$FT_Turn_ROU_C=$row['FT_Turn_ROU_C'];
$FT_Turn_ROU_D=$row['FT_Turn_ROU_D'];
$FT_ROU_Bet=$row['FT_ROU_Bet'];
$FT_ROU_Scene=$row['FT_ROU_Scene'];
$FT_Turn_VRE_A=$row['FT_Turn_VRE_A'];
$FT_Turn_VRE_B=$row['FT_Turn_VRE_B'];
$FT_Turn_VRE_C=$row['FT_Turn_VRE_C'];
$FT_Turn_VRE_D=$row['FT_Turn_VRE_D'];
$FT_VRE_Bet=$row['FT_VRE_Bet'];
$FT_VRE_Scene=$row['FT_VRE_Scene'];
$FT_Turn_VROU_A=$row['FT_Turn_VROU_A'];
$FT_Turn_VROU_B=$row['FT_Turn_VROU_B'];
$FT_Turn_VROU_C=$row['FT_Turn_VROU_C'];
$FT_Turn_VROU_D=$row['FT_Turn_VROU_D'];
$FT_VROU_Bet=$row['FT_VROU_Bet'];
$FT_VROU_Scene=$row['FT_VROU_Scene'];
$FT_Turn_EO_A=$row['FT_Turn_EO_A'];
$FT_Turn_EO_B=$row['FT_Turn_EO_B'];
$FT_Turn_EO_C=$row['FT_Turn_EO_C'];
$FT_Turn_EO_D=$row['FT_Turn_EO_D'];
$FT_EO_Bet=$row['FT_EO_Bet'];
$FT_EO_Scene=$row['FT_EO_Scene'];
$FT_Turn_RM=$row['FT_Turn_RM'];
$FT_RM_Bet=$row['FT_RM_Bet'];
$FT_RM_Scene=$row['FT_RM_Scene'];
$FT_Turn_M=$row['FT_Turn_M'];
$FT_M_Bet=$row['FT_M_Bet'];
$FT_M_Scene=$row['FT_M_Scene'];
$FT_Turn_PD=$row['FT_Turn_PD'];
$FT_PD_Bet=$row['FT_PD_Bet'];
$FT_PD_Scene=$row['FT_PD_Scene'];
$FT_Turn_T=$row['FT_Turn_T'];
$FT_T_Bet=$row['FT_T_Bet'];
$FT_T_Scene=$row['FT_T_Scene'];
$FT_Turn_F=$row['FT_Turn_F'];
$FT_F_Bet=$row['FT_F_Bet'];
$FT_F_Scene=$row['FT_F_Scene'];
$FT_Turn_PR=$row['FT_Turn_PR'];
$FT_PR_Bet=$row['FT_PR_Bet'];
$FT_PR_Scene=$row['FT_PR_Scene'];

$BK_Turn_R_A=$row['BK_Turn_R_A'];
$BK_Turn_R_B=$row['BK_Turn_R_B'];
$BK_Turn_R_C=$row['BK_Turn_R_C'];
$BK_Turn_R_D=$row['BK_Turn_R_D'];
$BK_R_Bet=$row['BK_R_Bet'];
$BK_R_Scene=$row['BK_R_Scene'];
$BK_Turn_OU_A=$row['BK_Turn_OU_A'];
$BK_Turn_OU_B=$row['BK_Turn_OU_B'];
$BK_Turn_OU_C=$row['BK_Turn_OU_C'];
$BK_Turn_OU_D=$row['BK_Turn_OU_D'];
$BK_OU_Bet=$row['BK_OU_Bet'];
$BK_OU_Scene=$row['BK_OU_Scene'];
$BK_Turn_VR_A=$row['BK_Turn_VR_A'];
$BK_Turn_VR_B=$row['BK_Turn_VR_B'];
$BK_Turn_VR_C=$row['BK_Turn_VR_C'];
$BK_Turn_VR_D=$row['BK_Turn_VR_D'];
$BK_VR_Bet=$row['BK_VR_Bet'];
$BK_VR_Scene=$row['BK_VR_Scene'];
$BK_Turn_VOU_A=$row['BK_Turn_VOU_A'];
$BK_Turn_VOU_B=$row['BK_Turn_VOU_B'];
$BK_Turn_VOU_C=$row['BK_Turn_VOU_C'];
$BK_Turn_VOU_D=$row['BK_Turn_VOU_D'];
$BK_VOU_Bet=$row['BK_VOU_Bet'];
$BK_VOU_Scene=$row['BK_VOU_Scene'];

$BK_Turn_RE_A=$row['BK_Turn_RE_A'];
$BK_Turn_RE_B=$row['BK_Turn_RE_B'];
$BK_Turn_RE_C=$row['BK_Turn_RE_C'];
$BK_Turn_RE_D=$row['BK_Turn_RE_D'];
$BK_RE_Bet=$row['BK_RE_Bet'];
$BK_RE_Scene=$row['BK_RE_Scene'];
$BK_Turn_ROU_A=$row['BK_Turn_ROU_A'];
$BK_Turn_ROU_B=$row['BK_Turn_ROU_B'];
$BK_Turn_ROU_C=$row['BK_Turn_ROU_C'];
$BK_Turn_ROU_D=$row['BK_Turn_ROU_D'];
$BK_ROU_Bet=$row['BK_ROU_Bet'];
$BK_ROU_Scene=$row['BK_ROU_Scene'];
$BK_Turn_VRE_A=$row['BK_Turn_VRE_A'];
$BK_Turn_VRE_B=$row['BK_Turn_VRE_B'];
$BK_Turn_VRE_C=$row['BK_Turn_VRE_C'];
$BK_Turn_VRE_D=$row['BK_Turn_VRE_D'];
$BK_VRE_Bet=$row['BK_VRE_Bet'];
$BK_VRE_Scene=$row['BK_VRE_Scene'];
$BK_Turn_VROU_A=$row['BK_Turn_VROU_A'];
$BK_Turn_VROU_B=$row['BK_Turn_VROU_B'];
$BK_Turn_VROU_C=$row['BK_Turn_VROU_C'];
$BK_Turn_VROU_D=$row['BK_Turn_VROU_D'];
$BK_VROU_Bet=$row['BK_VROU_Bet'];
$BK_VROU_Scene=$row['BK_VROU_Scene'];
$BK_Turn_EO_A=$row['BK_Turn_EO_A'];
$BK_Turn_EO_B=$row['BK_Turn_EO_B'];
$BK_Turn_EO_C=$row['BK_Turn_EO_C'];
$BK_Turn_EO_D=$row['BK_Turn_EO_D'];
$BK_EO_Bet=$row['BK_EO_Bet'];
$BK_EO_Scene=$row['BK_EO_Scene'];
$BK_Turn_PR=$row['BK_Turn_PR'];
$BK_PR_Bet=$row['BK_PR_Bet'];
$BK_PR_Scene=$row['BK_PR_Scene'];

$BS_Turn_R_A=$row['BS_Turn_R_A'];
$BS_Turn_R_B=$row['BS_Turn_R_B'];
$BS_Turn_R_C=$row['BS_Turn_R_C'];
$BS_Turn_R_D=$row['BS_Turn_R_D'];
$BS_R_Bet=$row['BS_R_Bet'];
$BS_R_Scene=$row['BS_R_Scene'];
$BS_Turn_OU_A=$row['BS_Turn_OU_A'];
$BS_Turn_OU_B=$row['BS_Turn_OU_B'];
$BS_Turn_OU_C=$row['BS_Turn_OU_C'];
$BS_Turn_OU_D=$row['BS_Turn_OU_D'];
$BS_OU_Bet=$row['BS_OU_Bet'];
$BS_OU_Scene=$row['BS_OU_Scene'];
$BS_Turn_VR_A=$row['BS_Turn_VR_A'];
$BS_Turn_VR_B=$row['BS_Turn_VR_B'];
$BS_Turn_VR_C=$row['BS_Turn_VR_C'];
$BS_Turn_VR_D=$row['BS_Turn_VR_D'];
$BS_VR_Bet=$row['BS_VR_Bet'];
$BS_VR_Scene=$row['BS_VR_Scene'];
$BS_Turn_VOU_A=$row['BS_Turn_VOU_A'];
$BS_Turn_VOU_B=$row['BS_Turn_VOU_B'];
$BS_Turn_VOU_C=$row['BS_Turn_VOU_C'];
$BS_Turn_VOU_D=$row['BS_Turn_VOU_D'];
$BS_VOU_Bet=$row['BS_VOU_Bet'];
$BS_VOU_Scene=$row['BS_VOU_Scene'];
$BS_Turn_RE_A=$row['BS_Turn_RE_A'];
$BS_Turn_RE_B=$row['BS_Turn_RE_B'];
$BS_Turn_RE_C=$row['BS_Turn_RE_C'];
$BS_Turn_RE_D=$row['BS_Turn_RE_D'];
$BS_RE_Bet=$row['BS_RE_Bet'];
$BS_RE_Scene=$row['BS_RE_Scene'];
$BS_Turn_ROU_A=$row['BS_Turn_ROU_A'];
$BS_Turn_ROU_B=$row['BS_Turn_ROU_B'];
$BS_Turn_ROU_C=$row['BS_Turn_ROU_C'];
$BS_Turn_ROU_D=$row['BS_Turn_ROU_D'];
$BS_ROU_Bet=$row['BS_ROU_Bet'];
$BS_ROU_Scene=$row['BS_ROU_Scene'];
$BS_Turn_VRE_A=$row['BS_Turn_VRE_A'];
$BS_Turn_VRE_B=$row['BS_Turn_VRE_B'];
$BS_Turn_VRE_C=$row['BS_Turn_VRE_C'];
$BS_Turn_VRE_D=$row['BS_Turn_VRE_D'];
$BS_VRE_Bet=$row['BS_VRE_Bet'];
$BS_VRE_Scene=$row['BS_VRE_Scene'];
$BS_Turn_VROU_A=$row['BS_Turn_VROU_A'];
$BS_Turn_VROU_B=$row['BS_Turn_VROU_B'];
$BS_Turn_VROU_C=$row['BS_Turn_VROU_C'];
$BS_Turn_VROU_D=$row['BS_Turn_VROU_D'];
$BS_VROU_Bet=$row['BS_VROU_Bet'];
$BS_VROU_Scene=$row['BS_VROU_Scene'];
$BS_Turn_EO_A=$row['BS_Turn_EO_A'];
$BS_Turn_EO_B=$row['BS_Turn_EO_B'];
$BS_Turn_EO_C=$row['BS_Turn_EO_C'];
$BS_Turn_EO_D=$row['BS_Turn_EO_D'];
$BS_EO_Bet=$row['BS_EO_Bet'];
$BS_EO_Scene=$row['BS_EO_Scene'];
$BS_Turn_1X2_A=$row['BS_Turn_1X2_A'];
$BS_Turn_1X2_B=$row['BS_Turn_1X2_B'];
$BS_Turn_1X2_C=$row['BS_Turn_1X2_C'];
$BS_Turn_1X2_D=$row['BS_Turn_1X2_D'];
$BS_1X2_Bet=$row['BS_1X2_Bet'];
$BS_1X2_Scene=$row['BS_1X2_Scene'];
$BS_Turn_M=$row['BS_Turn_M'];
$BS_M_Bet=$row['BS_M_Bet'];
$BS_M_Scene=$row['BS_M_Scene'];
$BS_Turn_PD=$row['BS_Turn_PD'];
$BS_PD_Bet=$row['BS_PD_Bet'];
$BS_PD_Scene=$row['BS_PD_Scene'];
$BS_Turn_T=$row['BS_Turn_T'];
$BS_T_Bet=$row['BS_T_Bet'];	
$BS_T_Scene=$row['BS_T_Scene'];
$BS_Turn_P=$row['BS_Turn_P'];
$BS_P_Bet=$row['BS_P_Bet'];
$BS_P_Scene=$row['BS_P_Scene'];
$BS_Turn_PR=$row['BS_Turn_PR'];
$BS_PR_Bet=$row['BS_PR_Bet'];
$BS_PR_Scene=$row['BS_PR_Scene'];

$TN_Turn_R_A=$row['TN_Turn_R_A'];
$TN_Turn_R_B=$row['TN_Turn_R_B'];
$TN_Turn_R_C=$row['TN_Turn_R_C'];
$TN_Turn_R_D=$row['TN_Turn_R_D'];
$TN_R_Bet=$row['TN_R_Bet'];
$TN_R_Scene=$row['TN_R_Scene'];
$TN_Turn_OU_A=$row['TN_Turn_OU_A'];
$TN_Turn_OU_B=$row['TN_Turn_OU_B'];
$TN_Turn_OU_C=$row['TN_Turn_OU_C'];
$TN_Turn_OU_D=$row['TN_Turn_OU_D'];
$TN_OU_Bet=$row['TN_OU_Bet'];
$TN_OU_Scene=$row['TN_OU_Scene'];
$TN_Turn_RE_A=$row['TN_Turn_RE_A'];
$TN_Turn_RE_B=$row['TN_Turn_RE_B'];
$TN_Turn_RE_C=$row['TN_Turn_RE_C'];
$TN_Turn_RE_D=$row['TN_Turn_RE_D'];
$TN_RE_Bet=$row['TN_RE_Bet'];
$TN_RE_Scene=$row['TN_RE_Scene'];
$TN_Turn_ROU_A=$row['TN_Turn_ROU_A'];
$TN_Turn_ROU_B=$row['TN_Turn_ROU_B'];
$TN_Turn_ROU_C=$row['TN_Turn_ROU_C'];
$TN_Turn_ROU_D=$row['TN_Turn_ROU_D'];
$TN_ROU_Bet=$row['TN_ROU_Bet'];
$TN_ROU_Scene=$row['TN_ROU_Scene'];
$TN_Turn_EO_A=$row['TN_Turn_EO_A'];
$TN_Turn_EO_B=$row['TN_Turn_EO_B'];
$TN_Turn_EO_C=$row['TN_Turn_EO_C'];
$TN_Turn_EO_D=$row['TN_Turn_EO_D'];
$TN_EO_Bet=$row['TN_EO_Bet'];
$TN_EO_Scene=$row['TN_EO_Scene'];
$TN_Turn_M=$row['TN_Turn_M'];
$TN_M_Bet=$row['TN_M_Bet'];
$TN_M_Scene=$row['TN_M_Scene'];
$TN_Turn_PD=$row['TN_Turn_PD'];
$TN_PD_Scene=$row['TN_PD_Scene'];
$TN_PD_Bet=$row['TN_PD_Bet'];
$TN_Turn_P=$row['TN_Turn_P'];
$TN_P_Scene=$row['TN_P_Scene'];
$TN_P_Bet=$row['TN_P_Bet'];
$TN_Turn_PR=$row['TN_Turn_PR'];
$TN_PR_Bet=$row['TN_PR_Bet'];
$TN_PR_Scene=$row['TN_PR_Scene'];

$VB_Turn_R_A=$row['VB_Turn_R_A'];
$VB_Turn_R_B=$row['VB_Turn_R_B'];
$VB_Turn_R_C=$row['VB_Turn_R_C'];
$VB_Turn_R_D=$row['VB_Turn_R_D'];
$VB_R_Bet=$row['VB_R_Bet'];
$VB_R_Scene=$row['VB_R_Scene'];
$VB_Turn_OU_A=$row['VB_Turn_OU_A'];
$VB_Turn_OU_B=$row['VB_Turn_OU_B'];
$VB_Turn_OU_C=$row['VB_Turn_OU_C'];
$VB_Turn_OU_D=$row['VB_Turn_OU_D'];
$VB_OU_Bet=$row['VB_OU_Bet'];
$VB_OU_Scene=$row['VB_OU_Scene'];
$VB_Turn_RE_A=$row['VB_Turn_RE_A'];
$VB_Turn_RE_B=$row['VB_Turn_RE_B'];
$VB_Turn_RE_C=$row['VB_Turn_RE_C'];
$VB_Turn_RE_D=$row['VB_Turn_RE_D'];
$VB_RE_Bet=$row['VB_RE_Bet'];
$VB_RE_Scene=$row['VB_RE_Scene'];
$VB_Turn_ROU_A=$row['VB_Turn_ROU_A'];
$VB_Turn_ROU_B=$row['VB_Turn_ROU_B'];
$VB_Turn_ROU_C=$row['VB_Turn_ROU_C'];
$VB_Turn_ROU_D=$row['VB_Turn_ROU_D'];
$VB_ROU_Bet=$row['VB_ROU_Bet'];
$VB_ROU_Scene=$row['VB_ROU_Scene'];
$VB_Turn_EO_A=$row['VB_Turn_EO_A'];
$VB_Turn_EO_B=$row['VB_Turn_EO_B'];
$VB_Turn_EO_C=$row['VB_Turn_EO_C'];
$VB_Turn_EO_D=$row['VB_Turn_EO_D'];
$VB_EO_Bet=$row['VB_EO_Bet'];
$VB_EO_Scene=$row['VB_EO_Scene'];
$VB_Turn_M=$row['VB_Turn_M'];
$VB_M_Bet=$row['VB_M_Bet'];
$VB_M_Scene=$row['VB_M_Scene'];
$VB_Turn_PD=$row['VB_Turn_PD'];
$VB_PD_Bet=$row['VB_PD_Bet'];
$VB_PD_Scene=$row['VB_PD_Scene'];
$VB_Turn_P=$row['VB_Turn_P'];
$VB_P_Bet=$row['VB_P_Bet'];
$VB_P_Scene=$row['VB_P_Scene'];
$VB_Turn_PR=$row['VB_Turn_PR'];
$VB_PR_Bet=$row['VB_PR_Bet'];
$VB_PR_Scene=$row['VB_PR_Scene'];

$OP_Turn_R_A=$row['OP_Turn_R_A'];
$OP_Turn_R_B=$row['OP_Turn_R_B'];
$OP_Turn_R_C=$row['OP_Turn_R_C'];
$OP_Turn_R_D=$row['OP_Turn_R_D'];
$OP_R_Bet=$row['OP_R_Bet'];
$OP_R_Scene=$row['OP_R_Scene'];
$OP_Turn_OU_A=$row['OP_Turn_OU_A'];
$OP_Turn_OU_B=$row['OP_Turn_OU_B'];
$OP_Turn_OU_C=$row['OP_Turn_OU_C'];
$OP_Turn_OU_D=$row['OP_Turn_OU_D'];
$OP_OU_Bet=$row['OP_OU_Bet'];
$OP_OU_Scene=$row['OP_OU_Scene'];
$OP_Turn_VR_A=$row['OP_Turn_VR_A'];
$OP_Turn_VR_B=$row['OP_Turn_VR_B'];
$OP_Turn_VR_C=$row['OP_Turn_VR_C'];
$OP_Turn_VR_D=$row['OP_Turn_VR_D'];
$OP_VR_Bet=$row['OP_VR_Bet'];
$OP_VR_Scene=$row['OP_VR_Scene'];
$OP_Turn_VOU_A=$row['OP_Turn_VOU_A'];
$OP_Turn_VOU_B=$row['OP_Turn_VOU_B'];
$OP_Turn_VOU_C=$row['OP_Turn_VOU_C'];
$OP_Turn_VOU_D=$row['OP_Turn_VOU_D'];
$OP_VOU_Bet=$row['OP_VOU_Bet'];
$OP_VOU_Scene=$row['OP_VOU_Scene'];
$OP_Turn_RE_A=$row['OP_Turn_RE_A'];
$OP_Turn_RE_B=$row['OP_Turn_RE_B'];
$OP_Turn_RE_C=$row['OP_Turn_RE_C'];
$OP_Turn_RE_D=$row['OP_Turn_RE_D'];
$OP_RE_Bet=$row['OP_RE_Bet'];
$OP_RE_Scene=$row['OP_RE_Scene'];
$OP_Turn_ROU_A=$row['OP_Turn_ROU_A'];
$OP_Turn_ROU_B=$row['OP_Turn_ROU_B'];
$OP_Turn_ROU_C=$row['OP_Turn_ROU_C'];
$OP_Turn_ROU_D=$row['OP_Turn_ROU_D'];
$OP_ROU_Bet=$row['OP_ROU_Bet'];
$OP_ROU_Scene=$row['OP_ROU_Scene'];
$OP_Turn_VRE_A=$row['OP_Turn_VRE_A'];
$OP_Turn_VRE_B=$row['OP_Turn_VRE_B'];
$OP_Turn_VRE_C=$row['OP_Turn_VRE_C'];
$OP_Turn_VRE_D=$row['OP_Turn_VRE_D'];
$OP_VRE_Bet=$row['OP_VRE_Bet'];
$OP_VRE_Scene=$row['OP_VRE_Scene'];
$OP_Turn_VROU_A=$row['OP_Turn_VROU_A'];
$OP_Turn_VROU_B=$row['OP_Turn_VROU_B'];
$OP_Turn_VROU_C=$row['OP_Turn_VROU_C'];
$OP_Turn_VROU_D=$row['OP_Turn_VROU_D'];
$OP_VROU_Bet=$row['OP_VROU_Bet'];
$OP_VROU_Scene=$row['OP_VROU_Scene'];
$OP_Turn_EO_A=$row['OP_Turn_EO_A'];
$OP_Turn_EO_B=$row['OP_Turn_EO_B'];
$OP_Turn_EO_C=$row['OP_Turn_EO_C'];
$OP_Turn_EO_D=$row['OP_Turn_EO_D'];
$OP_EO_Bet=$row['OP_EO_Bet'];
$OP_EO_Scene=$row['OP_EO_Scene'];
$OP_Turn_M=$row['OP_Turn_M'];
$OP_M_Bet=$row['OP_M_Bet'];
$OP_M_Scene=$row['OP_M_Scene'];
$OP_Turn_PD=$row['OP_Turn_PD'];
$OP_PD_Bet=$row['OP_PD_Bet'];
$OP_PD_Scene=$row['OP_PD_Scene'];
$OP_Turn_T=$row['OP_Turn_T'];
$OP_T_Bet=$row['OP_T_Bet'];
$OP_T_Scene=$row['OP_T_Scene'];
$OP_Turn_F=$row['OP_Turn_F'];
$OP_F_Bet=$row['OP_F_Bet'];
$OP_F_Scene=$row['OP_F_Scene'];
$OP_Turn_P=$row['OP_Turn_P'];
$OP_P_Bet=$row['OP_P_Bet'];
$OP_P_Scene=$row['OP_P_Scene'];
$OP_Turn_PR=$row['OP_Turn_PR'];
$OP_PR_Bet=$row['OP_PR_Bet'];
$OP_PR_Scene=$row['OP_PR_Scene'];

$FU_Turn_OU_A=$row['FU_Turn_OU_A'];
$FU_Turn_OU_B=$row['FU_Turn_OU_B'];
$FU_Turn_OU_C=$row['FU_Turn_OU_C'];
$FU_Turn_OU_D=$row['FU_Turn_OU_D'];
$FU_OU_Bet=$row['FU_OU_Bet'];
$FU_OU_Scene=$row['FU_OU_Scene'];
$FU_Turn_EO_A=$row['FU_Turn_EO_A'];
$FU_Turn_EO_B=$row['FU_Turn_EO_B'];
$FU_Turn_EO_C=$row['FU_Turn_EO_C'];
$FU_Turn_EO_D=$row['FU_Turn_EO_D'];
$FU_EO_Bet=$row['FU_EO_Bet'];
$FU_EO_Scene=$row['FU_EO_Scene'];
$FU_Turn_PD=$row['FU_Turn_PD'];
$FU_PD_Bet=$row['FU_PD_Bet'];
$FU_PD_Scene=$row['FU_PD_Scene'];

$FS_Turn_FS=$row['FS_Turn_FS'];
$FS_FS_Bet=$row['FS_FS_Bet'];
$FS_FS_Scene=$row['FS_FS_Scene'];

$SIX_Turn_SCA_A=$row['SIX_Turn_SCA_A'];
$SIX_Turn_SCA_B=$row['SIX_Turn_SCA_B'];
$SIX_Turn_SCA_C=$row['SIX_Turn_SCA_C'];
$SIX_Turn_SCA_D=$row['SIX_Turn_SCA_D'];
$SIX_SCA_Bet=$row['SIX_SCA_Bet'];
$SIX_SCA_Scene=$row['SIX_SCA_Scene'];

$SIX_Turn_SCB_A=$row['SIX_Turn_SCB_A'];
$SIX_Turn_SCB_B=$row['SIX_Turn_SCB_B'];
$SIX_Turn_SCB_C=$row['SIX_Turn_SCB_C'];
$SIX_Turn_SCB_D=$row['SIX_Turn_SCB_D'];
$SIX_SCB_Bet=$row['SIX_SCB_Bet'];
$SIX_SCB_Scene=$row['SIX_SCB_Scene'];

$SIX_Turn_SCA_AOUEO_A=$row['SIX_Turn_SCA_AOUEO_A'];
$SIX_Turn_SCA_AOUEO_B=$row['SIX_Turn_SCA_AOUEO_B'];
$SIX_Turn_SCA_AOUEO_C=$row['SIX_Turn_SCA_AOUEO_C'];
$SIX_Turn_SCA_AOUEO_D=$row['SIX_Turn_SCA_AOUEO_D'];
$SIX_SCA_AOUEO_Bet=$row['SIX_SCA_AOUEO_Bet'];
$SIX_SCA_AOUEO_Scene=$row['SIX_SCA_AOUEO_Scene'];

$SIX_Turn_SCA_BOUEO_A=$row['SIX_Turn_SCA_BOUEO_A'];
$SIX_Turn_SCA_BOUEO_B=$row['SIX_Turn_SCA_BOUEO_B'];
$SIX_Turn_SCA_BOUEO_C=$row['SIX_Turn_SCA_BOUEO_C'];
$SIX_Turn_SCA_BOUEO_D=$row['SIX_Turn_SCA_BOUEO_D'];
$SIX_SCA_BOUEO_Bet=$row['SIX_SCA_BOUEO_Bet'];
$SIX_SCA_BOUEO_Scene=$row['SIX_SCA_BOUEO_Scene'];

$SIX_Turn_SCA_RBG_A=$row['SIX_Turn_SCA_RBG_A'];
$SIX_Turn_SCA_RBG_B=$row['SIX_Turn_SCA_RBG_B'];
$SIX_Turn_SCA_RBG_C=$row['SIX_Turn_SCA_RBG_C'];
$SIX_Turn_SCA_RBG_D=$row['SIX_Turn_SCA_RBG_D'];
$SIX_SCA_RBG_Bet=$row['SIX_SCA_RBG_Bet'];
$SIX_SCA_RBG_Scene=$row['SIX_SCA_RBG_Scene'];


$SIX_Turn_AC_A=$row['SIX_Turn_AC_A'];
$SIX_Turn_AC_B=$row['SIX_Turn_AC_B'];
$SIX_Turn_AC_C=$row['SIX_Turn_AC_C'];
$SIX_Turn_AC_D=$row['SIX_Turn_AC_D'];
$SIX_AC_Bet=$row['SIX_AC_Bet'];
$SIX_AC_Scene=$row['SIX_AC_Scene'];

$SIX_Turn_AC_TOUEO_A=$row['SIX_Turn_AC_TOUEO_A'];
$SIX_Turn_AC_TOUEO_B=$row['SIX_Turn_AC_TOUEO_B'];
$SIX_Turn_AC_TOUEO_C=$row['SIX_Turn_AC_TOUEO_C'];
$SIX_Turn_AC_TOUEO_D=$row['SIX_Turn_AC_TOUEO_D'];
$SIX_AC_TOUEO_Bet=$row['SIX_AC_TOUEO_Bet'];
$SIX_AC_TOUEO_Scene=$row['SIX_AC_TOUEO_Scene'];

$SIX_Turn_AC6_AOUEO_A=$row['SIX_Turn_AC6_AOUEO_A'];
$SIX_Turn_AC6_AOUEO_B=$row['SIX_Turn_AC6_AOUEO_B'];
$SIX_Turn_AC6_AOUEO_C=$row['SIX_Turn_AC6_AOUEO_C'];
$SIX_Turn_AC6_AOUEO_D=$row['SIX_Turn_AC6_AOUEO_D'];
$SIX_AC6_AOUEO_Bet=$row['SIX_AC6_AOUEO_Bet'];
$SIX_AC6_AOUEO_Scene=$row['SIX_AC6_AOUEO_Scene'];

$SIX_Turn_AC6_BOUEO_A=$row['SIX_Turn_AC6_BOUEO_A'];
$SIX_Turn_AC6_BOUEO_B=$row['SIX_Turn_AC6_BOUEO_B'];
$SIX_Turn_AC6_BOUEO_C=$row['SIX_Turn_AC6_BOUEO_C'];
$SIX_Turn_AC6_BOUEO_D=$row['SIX_Turn_AC6_BOUEO_D'];
$SIX_AC6_BOUEO_Bet=$row['SIX_AC6_BOUEO_Bet'];
$SIX_AC6_BOUEO_Scene=$row['SIX_AC6_BOUEO_Scene'];

$SIX_Turn_AC6_RBG_A=$row['SIX_Turn_AC6_RBG_A'];
$SIX_Turn_AC6_RBG_B=$row['SIX_Turn_AC6_RBG_B'];
$SIX_Turn_AC6_RBG_C=$row['SIX_Turn_AC6_RBG_C'];
$SIX_Turn_AC6_RBG_D=$row['SIX_Turn_AC6_RBG_D'];
$SIX_AC6_RBG_Bet=$row['SIX_AC6_RBG_Bet'];
$SIX_AC6_RBG_Scene=$row['SIX_AC6_RBG_Scene'];

$SIX_Turn_SX_A=$row['SIX_Turn_SX_A'];
$SIX_Turn_SX_B=$row['SIX_Turn_SX_B'];
$SIX_Turn_SX_C=$row['SIX_Turn_SX_C'];
$SIX_Turn_SX_D=$row['SIX_Turn_SX_D'];
$SIX_SX_Bet=$row['SIX_SX_Bet'];
$SIX_SX_Scene=$row['SIX_SX_Scene'];

$SIX_Turn_HW_A=$row['SIX_Turn_HW_A'];
$SIX_Turn_HW_B=$row['SIX_Turn_HW_B'];
$SIX_Turn_HW_C=$row['SIX_Turn_HW_C'];
$SIX_Turn_HW_D=$row['SIX_Turn_HW_D'];
$SIX_HW_Bet=$row['SIX_HW_Bet'];
$SIX_HW_Scene=$row['SIX_HW_Scene'];

$SIX_Turn_MT_A=$row['SIX_Turn_MT_A'];
$SIX_Turn_MT_B=$row['SIX_Turn_MT_B'];
$SIX_Turn_MT_C=$row['SIX_Turn_MT_C'];
$SIX_Turn_MT_D=$row['SIX_Turn_MT_D'];
$SIX_MT_Bet=$row['SIX_MT_Bet'];
$SIX_MT_Scene=$row['SIX_MT_Scene'];

$SIX_Turn_M_A=$row['SIX_Turn_M_A'];
$SIX_Turn_M_B=$row['SIX_Turn_M_B'];
$SIX_Turn_M_C=$row['SIX_Turn_M_C'];
$SIX_Turn_M_D=$row['SIX_Turn_M_D'];
$SIX_M_Bet=$row['SIX_M_Bet'];
$SIX_M_Scene=$row['SIX_M_Scene'];

$SIX_Turn_EC_A=$row['SIX_Turn_EC_A'];
$SIX_Turn_EC_B=$row['SIX_Turn_EC_B'];
$SIX_Turn_EC_C=$row['SIX_Turn_EC_C'];
$SIX_Turn_EC_D=$row['SIX_Turn_EC_D'];
$SIX_EC_Bet=$row['SIX_EC_Bet'];
$SIX_EC_Scene=$row['SIX_EC_Scene'];

$keys=$_REQUEST['keys'];
if ($keys=='add'){
	$AddDate=date('Y-m-d H:i:s');//新增日期
	$alias=$_REQUEST['alias'];//名称
	$phone=$_REQUEST['phone']; //手机
	$username=$_REQUEST['username'];//帐号
	$password=$_REQUEST['password'];//密码
	$notes=$_REQUEST['notes'];//备注
	$address=$_REQUEST['address'];//QQ//Email
	$type='C';
	$ip_addr=getenv("REMOTE_ADDR");

$msql = "select * from web_member_data where UserName='$username'";
$mresult = mysql_db_query($dbname,$msql);
$mcou = mysql_num_rows($mresult);
if ($mcou>0){
		echo "<script languag='JavaScript'>alert('帐户已经有人使用，请重新注册！');self.location='index.php';</script>";
		exit();
}else{
	
$sql="insert into web_member_data set ";
$sql.="UserName='".$username."',";
$sql.="PassWord='".$password."',";
$sql.="Credit='0',";
$sql.="Money='0',";
$sql.="Alias='".$alias."',";
$sql.="Sports='".$sports."',";
$sql.="Lottery='".$lottery."',";
$sql.="AddDate='".$AddDate."',";
$sql.="Status='0',";
$sql.="CurType='RMB',";
$sql.="Pay_Type='1',";
$sql.="Opentype='C',";
$sql.="Agents='".$agent."',";
$sql.="World='".$world."',";
$sql.="Corprator='".$corprator."',";
$sql.="Super='".$super."',";
$sql.="Admin='".$admin."',";
$sql.="Phone='".$phone."',";
$sql.="Notes='".$notes."',";
$sql.="Address='".$address."',";
$sql.="LoginIP='".$ip_addr."',";
$sql.="Reg='1',";
$a="FT_Turn_R_$type";
$sql.="FT_Turn_R='".$$a."',";
$sql.="FT_R_Bet='".$FT_R_Bet."',";
$sql.="FT_R_Scene='".$FT_R_Scene."',";
$a="FT_Turn_OU_$type";
$sql.="FT_Turn_OU='".$$a."',";
$sql.="FT_OU_Bet='".$FT_OU_Bet."',";
$sql.="FT_OU_Scene='".$FT_OU_Scene."',";
$a="FT_Turn_VR_$type";
$sql.="FT_Turn_VR='".$$a."',";
$sql.="FT_VR_Bet='".$FT_VR_Bet."',";
$sql.="FT_VR_Scene='".$FT_VR_Scene."',";
$a="FT_Turn_VOU_$type";
$sql.="FT_Turn_VOU='".$$a."',";
$sql.="FT_VOU_Bet='".$FT_VOU_Bet."',";
$sql.="FT_VOU_Scene='".$FT_VOU_Scene."',";
$a="FT_Turn_RE_$type";
$sql.="FT_Turn_RE='".$$a."',";
$sql.="FT_RE_Bet='".$FT_RE_Bet."',";
$sql.="FT_RE_Scene='".$FT_RE_Scene."',";
$a="FT_Turn_ROU_$type";
$sql.="FT_Turn_ROU='".$$a."',";
$sql.="FT_ROU_Bet='".$FT_ROU_Bet."',";
$sql.="FT_ROU_Scene='".$FT_ROU_Scene."',";
$a="FT_Turn_VRE_$type";
$sql.="FT_Turn_VRE='".$$a."',";
$sql.="FT_VRE_Bet='".$FT_VRE_Bet."',";
$sql.="FT_VRE_Scene='".$FT_VRE_Scene."',";
$a="FT_Turn_VROU_$type";
$sql.="FT_Turn_VROU='".$$a."',";
$sql.="FT_VROU_Bet='".$FT_VROU_Bet."',";
$sql.="FT_VROU_Scene='".$FT_VROU_Scene."',";
$a="FT_Turn_EO_$type";
$sql.="FT_Turn_EO='".$$a."',";
$sql.="FT_EO_Bet='".$FT_EO_Bet."',";
$sql.="FT_EO_Scene='".$FT_EO_Scene."',";
$sql.="FT_Turn_RM='".$FT_Turn_RM."',";
$sql.="FT_RM_Bet='".$FT_RM_Bet."',";
$sql.="FT_RM_Scene='".$FT_RM_Scene."',";
$sql.="FT_Turn_M='".$FT_Turn_M."',";
$sql.="FT_M_Bet='".$FT_M_Bet."',";
$sql.="FT_M_Scene='".$FT_M_Scene."',";
$sql.="FT_Turn_PD='".$FT_Turn_PD."',";
$sql.="FT_PD_Bet='".$FT_PD_Bet."',";
$sql.="FT_PD_Scene='".$FT_PD_Scene."',";
$sql.="FT_Turn_T='".$FT_Turn_T."',";
$sql.="FT_T_Bet='".$FT_T_Bet."',";
$sql.="FT_T_Scene='".$FT_T_Scene."',";
$sql.="FT_Turn_F='".$FT_Turn_F."',";
$sql.="FT_F_Bet='".$FT_F_Bet."',";
$sql.="FT_F_Scene='".$FT_F_Scene."',";
$sql.="FT_Turn_PR='".$FT_Turn_PR."',";
$sql.="FT_PR_Bet='".$FT_PR_Bet."',";
$sql.="FT_PR_Scene='".$FT_PR_Scene."',";

$a="BK_Turn_R_$type";
$sql.="BK_Turn_R='".$$a."',";
$sql.="BK_R_Bet='".$BK_R_Bet."',";
$sql.="BK_R_Scene='".$BK_R_Scene."',";
$a="BK_Turn_OU_$type";
$sql.="BK_Turn_OU='".$$a."',";
$sql.="BK_OU_Bet='".$BK_OU_Bet."',";
$sql.="BK_OU_Scene='".$BK_OU_Scene."',";
$a="BK_Turn_VR_$type";
$sql.="BK_Turn_VR='".$$a."',";
$sql.="BK_VR_Bet='".$BK_VR_Bet."',";
$sql.="BK_VR_Scene='".$BK_VR_Scene."',";
$a="BK_Turn_VOU_$type";
$sql.="BK_Turn_VOU='".$$a."',";
$sql.="BK_VOU_Bet='".$BK_VOU_Bet."',";
$sql.="BK_VOU_Scene='".$BK_VOU_Scene."',";
$a="BK_Turn_RE_$type";
$sql.="BK_Turn_RE='".$$a."',";
$sql.="BK_RE_Bet='".$BK_RE_Bet."',";
$sql.="BK_RE_Scene='".$BK_RE_Scene."',";
$a="BK_Turn_ROU_$type";
$sql.="BK_Turn_ROU='".$$a."',";
$sql.="BK_ROU_Bet='".$BK_ROU_Bet."',";
$sql.="BK_ROU_Scene='".$BK_ROU_Scene."',";
$a="BK_Turn_VRE_$type";
$sql.="BK_Turn_VRE='".$$a."',";
$sql.="BK_VRE_Bet='".$BK_VRE_Bet."',";
$sql.="BK_VRE_Scene='".$BK_VRE_Scene."',";
$a="BK_Turn_VROU_$type";
$sql.="BK_Turn_VROU='".$$a."',";
$sql.="BK_VROU_Bet='".$BK_VROU_Bet."',";
$sql.="BK_VROU_Scene='".$BK_VROU_Scene."',";
$a="BK_Turn_EO_$type";
$sql.="BK_Turn_EO='".$$a."',";
$sql.="BK_EO_Bet='".$BK_EO_Bet."',";
$sql.="BK_EO_Scene='".$BK_EO_Scene."',";
$sql.="BK_Turn_PR='".$BK_Turn_PR."',";
$sql.="BK_PR_Bet='".$BK_PR_Bet."',";
$sql.="BK_PR_Scene='".$BK_PR_Scene."',";

$a="BS_Turn_R_$type";
$sql.="BS_Turn_R='".$$a."',";
$sql.="BS_R_Bet='".$BS_R_Bet."',";
$sql.="BS_R_Scene='".$BS_R_Scene."',";
$a="BS_Turn_OU_$type";
$sql.="BS_Turn_OU='".$$a."',";
$sql.="BS_OU_Scene='".$BS_OU_Scene."',";
$sql.="BS_OU_Bet='".$BS_OU_Bet."',";
$a="BS_Turn_VR_$type";
$sql.="BS_Turn_VR='".$$a."',";
$sql.="BS_VR_Bet='".$BS_VR_Bet."',";
$sql.="BS_VR_Scene='".$BS_VR_Scene."',";
$a="BS_Turn_VOU_$type";
$sql.="BS_Turn_VOU='".$$a."',";
$sql.="BS_VOU_Scene='".$BS_VOU_Scene."',";
$sql.="BS_VOU_Bet='".$BS_VOU_Bet."',";
$a="BS_Turn_RE_$type";
$sql.="BS_Turn_RE='".$$a."',";
$sql.="BS_RE_Bet='".$BS_RE_Bet."',";
$sql.="BS_RE_Scene='".$BS_RE_Scene."',";
$a="BS_Turn_ROU_$type";
$sql.="BS_Turn_ROU='".$$a."',";
$sql.="BS_ROU_Bet='".$BS_ROU_Bet."',";
$sql.="BS_ROU_Scene='".$BS_ROU_Scene."',";
$a="BS_Turn_VRE_$type";
$sql.="BS_Turn_VRE='".$$a."',";
$sql.="BS_VRE_Bet='".$BS_VRE_Bet."',";
$sql.="BS_VRE_Scene='".$BS_VRE_Scene."',";
$a="BS_Turn_VROU_$type";
$sql.="BS_Turn_VROU='".$$a."',";
$sql.="BS_VROU_Bet='".$BS_VROU_Bet."',";
$sql.="BS_VROU_Scene='".$BS_VROU_Scene."',";
$a="BS_Turn_EO_$type";
$sql.="BS_Turn_EO='".$$a."',";
$sql.="BS_EO_Bet='".$BS_EO_Bet."',";
$sql.="BS_EO_Scene='".$BS_EO_Scene."',";
$a="BS_Turn_1X2_$type";
$sql.="BS_Turn_1X2='".$$a."',";
$sql.="BS_1X2_Bet='".$BS_1X2_Bet."',";
$sql.="BS_1X2_Scene='".$BS_1X2_Scene."',";
$sql.="BS_Turn_M='".$BS_Turn_M."',";
$sql.="BS_M_Bet='".$BS_M_Bet."',";
$sql.="BS_M_Scene='".$BS_M_Scene."',";
$sql.="BS_Turn_PD='".$BS_Turn_PD."',";
$sql.="BS_PD_Bet='".$BS_PD_Bet."',";
$sql.="BS_PD_Scene='".$BS_PD_Scene."',";
$sql.="BS_Turn_T='".$BS_Turn_T."',";
$sql.="BS_T_Bet='".$BS_T_Bet."',";	
$sql.="BS_T_Scene='".$BS_T_Scene."',";
$sql.="BS_Turn_P='".$BS_Turn_P."',";
$sql.="BS_P_Bet='".$BS_P_Bet."',";
$sql.="BS_P_Scene='".$BS_P_Scene."',";
$sql.="BS_Turn_PR='".$BS_Turn_PR."',";
$sql.="BS_PR_Bet='".$BS_PR_Bet."',";
$sql.="BS_PR_Scene='".$BS_PR_Scene."',";

$a="TN_Turn_R_$type";
$sql.="TN_Turn_R='".$$a."',";
$sql.="TN_R_Bet='".$TN_R_Bet."',";
$sql.="TN_R_Scene='".$TN_R_Scene."',";
$a="TN_Turn_OU_$type";
$sql.="TN_Turn_OU='".$$a."',";
$sql.="TN_OU_Bet='".$TN_OU_Bet."',";
$sql.="TN_OU_Scene='".$TN_OU_Scene."',";
$a="TN_Turn_RE_$type";
$sql.="TN_Turn_RE='".$$a."',";
$sql.="TN_RE_Bet='".$TN_RE_Bet."',";
$sql.="TN_RE_Scene='".$TN_RE_Scene."',";
$a="TN_Turn_ROU_$type";
$sql.="TN_Turn_ROU='".$$a."',";
$sql.="TN_ROU_Bet='".$TN_ROU_Bet."',";
$sql.="TN_ROU_Scene='".$TN_ROU_Scene."',";
$a="TN_Turn_EO_$type";
$sql.="TN_Turn_EO='".$$a."',";
$sql.="TN_EO_Bet='".$TN_EO_Bet."',";
$sql.="TN_EO_Scene='".$TN_EO_Scene."',";
$sql.="TN_Turn_M='".$TN_Turn_M."',";
$sql.="TN_M_Bet='".$TN_M_Bet."',";
$sql.="TN_M_Scene='".$TN_M_Scene."',";
$sql.="TN_Turn_PD='".$TN_Turn_PD."',";
$sql.="TN_PD_Bet='".$TN_PD_Bet."',";
$sql.="TN_PD_Scene='".$TN_PD_Scene."',";
$sql.="TN_Turn_P='".$TN_Turn_P."',";
$sql.="TN_P_Bet='".$TN_P_Bet."',";
$sql.="TN_P_Scene='".$TN_P_Scene."',";
$sql.="TN_Turn_PR='".$TN_Turn_PR."',";
$sql.="TN_PR_Bet='".$TN_PR_Bet."',";
$sql.="TN_PR_Scene='".$TN_PR_Scene."',";

$a="VB_Turn_R_$type";
$sql.="VB_Turn_R='".$$a."',";
$sql.="VB_R_Bet='".$VB_R_Bet."',";
$sql.="VB_R_Scene='".$VB_R_Scene."',";
$a="VB_Turn_OU_$type";
$sql.="VB_Turn_OU='".$$a."',";
$sql.="VB_OU_Bet='".$VB_OU_Bet."',";
$sql.="VB_OU_Scene='".$VB_OU_Scene."',";
$a="VB_Turn_RE_$type";
$sql.="VB_Turn_RE='".$$a."',";
$sql.="VB_RE_Bet='".$VB_RE_Bet."',";
$sql.="VB_RE_Scene='".$VB_RE_Scene."',";
$a="VB_Turn_ROU_$type";
$sql.="VB_Turn_ROU='".$$a."',";
$sql.="VB_ROU_Bet='".$VB_ROU_Bet."',";
$sql.="VB_ROU_Scene='".$VB_ROU_Scene."',";
$a="VB_Turn_EO_$type";
$sql.="VB_Turn_EO='".$$a."',";
$sql.="VB_EO_Bet='".$VB_EO_Bet."',";
$sql.="VB_EO_Scene='".$VB_EO_Scene."',";
$sql.="VB_Turn_M='".$VB_Turn_M."',";
$sql.="VB_M_Bet='".$VB_M_Bet."',";
$sql.="VB_M_Scene='".$VB_M_Scene."',";
$sql.="VB_Turn_PD='".$VB_Turn_PD."',";
$sql.="VB_PD_Bet='".$VB_PD_Bet."',";
$sql.="VB_PD_Scene='".$VB_PD_Scene."',";
$sql.="VB_Turn_P='".$VB_Turn_P."',";
$sql.="VB_P_Bet='".$VB_P_Bet."',";
$sql.="VB_P_Scene='".$VB_P_Scene."',";
$sql.="VB_Turn_PR='".$VB_Turn_PR."',";
$sql.="VB_PR_Bet='".$VB_PR_Bet."',";
$sql.="VB_PR_Scene='".$VB_PR_Scene."',";

$a="OP_Turn_R_$type";
$sql.="OP_Turn_R='".$$a."',";
$sql.="OP_R_Bet='".$OP_R_Bet."',";
$sql.="OP_R_Scene='".$OP_R_Scene."',";
$a="OP_Turn_OU_$type";
$sql.="OP_Turn_OU='".$$a."',";
$sql.="OP_OU_Bet='".$OP_OU_Bet."',";
$sql.="OP_OU_Scene='".$OP_OU_Scene."',";
$a="OP_Turn_VR_$type";
$sql.="OP_Turn_VR='".$$a."',";
$sql.="OP_VR_Bet='".$OP_VR_Bet."',";
$sql.="OP_VR_Scene='".$OP_VR_Scene."',";
$a="OP_Turn_VOU_$type";
$sql.="OP_Turn_VOU='".$$a."',";
$sql.="OP_VOU_Bet='".$OP_VOU_Bet."',";
$sql.="OP_VOU_Scene='".$OP_VOU_Scene."',";
$a="OP_Turn_RE_$type";
$sql.="OP_Turn_RE='".$$a."',";
$sql.="OP_RE_Bet='".$OP_RE_Bet."',";
$sql.="OP_RE_Scene='".$OP_RE_Scene."',";
$a="OP_Turn_ROU_$type";
$sql.="OP_Turn_ROU='".$$a."',";
$sql.="OP_ROU_Bet='".$OP_ROU_Bet."',";
$sql.="OP_ROU_Scene='".$OP_ROU_Scene."',";
$a="OP_Turn_VRE_$type";
$sql.="OP_Turn_VRE='".$$a."',";
$sql.="OP_VRE_Bet='".$OP_VRE_Bet."',";
$sql.="OP_VRE_Scene='".$OP_VRE_Scene."',";
$a="OP_Turn_VROU_$type";
$sql.="OP_Turn_VROU='".$$a."',";
$sql.="OP_VROU_Bet='".$OP_VROU_Bet."',";
$sql.="OP_VROU_Scene='".$OP_VROU_Scene."',";
$a="OP_Turn_EO_$type";
$sql.="OP_Turn_EO='".$$a."',";
$sql.="OP_EO_Bet='".$OP_EO_Bet."',";
$sql.="OP_EO_Scene='".$OP_EO_Scene."',";
$sql.="OP_Turn_M='".$OP_Turn_M."',";
$sql.="OP_M_Bet='".$OP_M_Bet."',";
$sql.="OP_M_Scene='".$OP_M_Scene."',";
$sql.="OP_Turn_PD='".$OP_Turn_PD."',";
$sql.="OP_PD_Bet='".$OP_PD_Bet."',";
$sql.="OP_PD_Scene='".$OP_PD_Scene."',";
$sql.="OP_Turn_T='".$OP_Turn_T."',";
$sql.="OP_T_Bet='".$OP_T_Bet."',";
$sql.="OP_T_Scene='".$OP_T_Scene."',";
$sql.="OP_Turn_F='".$OP_Turn_F."',";
$sql.="OP_F_Bet='".$OP_F_Bet."',";
$sql.="OP_F_Scene='".$OP_F_Scene."',";
$sql.="OP_Turn_P='".$OP_Turn_P."',";
$sql.="OP_P_Bet='".$OP_P_Bet."',";
$sql.="OP_P_Scene='".$OP_P_Scene."',";
$sql.="OP_Turn_PR='".$OP_Turn_PR."',";
$sql.="OP_PR_Bet='".$OP_PR_Bet."',";
$sql.="OP_PR_Scene='".$OP_PR_Scene."',";

$a="FU_Turn_OU_$type";
$sql.="FU_Turn_OU='".$$a."',";
$sql.="FU_OU_Bet='".$FU_OU_Bet."',";
$sql.="FU_OU_Scene='".$FU_OU_Scene."',";
$a="FU_Turn_EO_$type";
$sql.="FU_Turn_EO='".$$a."',";
$sql.="FU_EO_Bet='".$FU_EO_Bet."',";
$sql.="FU_EO_Scene='".$FU_EO_Scene."',";
$sql.="FU_Turn_PD='".$FU_Turn_PD."',";
$sql.="FU_PD_Bet='".$FU_PD_Bet."',";
$sql.="FU_PD_Scene='".$FU_PD_Scene."',";

$sql.="FS_Turn_FS='".$FS_Turn_FS."',";
$sql.="FS_FS_Bet='".$FS_FS_Bet."',";
$sql.="FS_FS_Scene='".$FS_FS_Scene."',";

$a="SIX_Turn_SCA_$type";
$sql.="SIX_Turn_SCA='".$$a."',";
$sql.="SIX_SCA_Bet='".$SIX_SCA_Bet."',";
$sql.="SIX_SCA_Scene='".$SIX_SCA_Scene."',";

$a="SIX_Turn_SCB_$type";
$sql.="SIX_Turn_SCB='".$$a."',";
$sql.="SIX_SCB_Bet='".$SIX_SCB_Bet."',";
$sql.="SIX_SCB_Scene='".$SIX_SCB_Scene."',";

$a="SIX_Turn_SCA_AOUEO_$type";
$sql.="SIX_Turn_SCA_AOUEO='".$$a."',";
$sql.="SIX_SCA_AOUEO_Bet='".$SIX_SCA_AOUEO_Bet."',";
$sql.="SIX_SCA_AOUEO_Scene='".$SIX_SCA_AOUEO_Scene."',";

$a="SIX_Turn_SCA_BOUEO_$type";
$sql.="SIX_Turn_SCA_BOUEO='".$$a."',";
$sql.="SIX_SCA_BOUEO_Bet='".$SIX_SCA_BOUEO_Bet."',";
$sql.="SIX_SCA_BOUEO_Scene='".$SIX_SCA_BOUEO_Scene."',";

$a="SIX_Turn_SCA_RBG_$type";
$sql.="SIX_Turn_SCA_RBG='".$$a."',";
$sql.="SIX_SCA_RBG_Bet='".$SIX_SCA_RBG_Bet."',";
$sql.="SIX_SCA_RBG_Scene='".$SIX_SCA_RBG_Scene."',";

$a="SIX_Turn_AC_$type";
$sql.="SIX_Turn_AC='".$$a."',";
$sql.="SIX_AC_Bet='".$SIX_AC_Bet."',";
$sql.="SIX_AC_Scene='".$SIX_AC_Scene."',";

$a="SIX_Turn_AC_TOUEO_$type";
$sql.="SIX_Turn_AC_TOUEO='".$$a."',";
$sql.="SIX_AC_TOUEO_Bet='".$SIX_AC_TOUEO_Bet."',";
$sql.="SIX_AC_TOUEO_Scene='".$SIX_AC_TOUEO_Scene."',";

$a="SIX_Turn_AC6_AOUEO_$type";
$sql.="SIX_Turn_AC6_AOUEO='".$$a."',";
$sql.="SIX_AC6_AOUEO_Bet='".$SIX_AC6_AOUEO_Bet."',";
$sql.="SIX_AC6_AOUEO_Scene='".$SIX_AC6_AOUEO_Scene."',";

$a="SIX_Turn_AC6_BOUEO_$type";
$sql.="SIX_Turn_AC6_BOUEO='".$$a."',";
$sql.="SIX_AC6_BOUEO_Bet='".$SIX_AC6_BOUEO_Bet."',";
$sql.="SIX_AC6_BOUEO_Scene='".$SIX_AC6_BOUEO_Scene."',";

$a="SIX_Turn_AC6_RBG_$type";
$sql.="SIX_Turn_AC6_RBG='".$$a."',";
$sql.="SIX_AC6_RBG_Bet='".$SIX_AC6_RBG_Bet."',";
$sql.="SIX_AC6_RBG_Scene='".$SIX_AC6_RBG_Scene."',";

$a="SIX_Turn_SX_$type";
$sql.="SIX_Turn_SX='".$$a."',";
$sql.="SIX_SX_Bet='".$SIX_SX_Bet."',";
$sql.="SIX_SX_Scene='".$SIX_SX_Scene."',";

$a="SIX_Turn_HW_$type";
$sql.="SIX_Turn_HW='".$$a."',";
$sql.="SIX_HW_Bet='".$SIX_HW_Bet."',";
$sql.="SIX_HW_Scene='".$SIX_HW_Scene."',";

$a="SIX_Turn_MT_$type";
$sql.="SIX_Turn_MT='".$$a."',";
$sql.="SIX_MT_Bet='".$SIX_MT_Bet."',";
$sql.="SIX_MT_Scene='".$SIX_MT_Scene."',";

$a="SIX_Turn_M_$type";
$sql.="SIX_Turn_M='".$$a."',";
$sql.="SIX_M_Bet='".$SIX_M_Bet."',";
$sql.="SIX_M_Scene='".$SIX_M_Scene."',";

$a="SIX_Turn_EC_$type";
$sql.="SIX_Turn_EC='".$$a."',";
$sql.="SIX_EC_Bet='".$SIX_EC_Bet."',";
$sql.="SIX_EC_Scene='".$SIX_EC_Scene."'";
//echo $sql;
//exit;
mysql_db_query($dbname,$sql) or die ("操作失败!!!");
$mysql="update web_agents_data set Count=Count+1 where UserName='$agent'";
mysql_db_query($dbname,$mysql) or die ("操作失败!!");
}
}
?>
<?
if ($keys=='add'){
?>
<script languag='JavaScript'>alert('恭喜注册已成功！\n帐号：<?=$username?>\n密码：<?=$password?>\n名称：<?=$alias?>\n手机号码：<?=$phone?>\n备注：<?=$notes?>');self.location='http://www.hg0088vip.com';</script>
<?
}
?>
