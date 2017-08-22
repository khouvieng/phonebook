<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "user";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../../index.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ໜ້າເບີສຳຫຼັບຜູ້ນໍາໃຊ້</title>
<style type="text/css">
@import url("../../webfonts/boonbaan/stylesheet.css");

body {
	background-image: linear-gradient(to top, #c1dfc4 0%, #deecdd 900%);
}
.font-header_user {
	font-family: boonbaan;
	font-size: 24px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-footer_user {
	font-family: boonbaan;
	font-size: 19px;
	font-weight: normal;
	color: #000;
}
</style>
</head>

<body>
<p><center>
  <p><img src="../../img/005.png" width="99" height="96" /></p>
</center>
</p>
<div align="center">
  <h3 class="font-header_user">ກອງພັນໃຫຍ່ 693 <br />
  ໜ້າເບີໂທຣສຳຫຼັບພະນັກງານຜູ້ນໍາໃຊ້ທົ່ວໄປ</h3>
</div>
<table width="327" height="163" border="1" align="center">
  <tbody>
    <tr>
      <td align="center" bgcolor="#F4C230" class="font-user" style="color: #FFFFFF; font-family: boonbaan; font-size: 20px;">ຂໍ້ມູນເບີໂທຣ</td>
      <td align="center" bgcolor="#F4C230" class="font-user" style="color: #FFFFFF; font-family: boonbaan; font-size: 20px;">ອອກຈາກລະບົບ</td>
    </tr>
    <tr>
      <td align="center"><a href="../tel/show.php"><img src="../../img/001.png" width="128" height="126" alt=""/></a></td>
      <td align="center"><a href="<?php echo $logoutAction ?>"><img src="../../img/004.png" width="128" height="126" alt=""/></a></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center">__________________________________________________________________________________________________________________</p>
<p align="center" class="font-footer_user">Copyright © 2017 PB (<a href="http://mod.gov.la/">MOD.GOV.LA</a>). ກະຊວງ ປ້ອງກັນປະເທດ Powered By :<a href="https://web.facebook.com/khouvieng.KHAMCHANVONG" target="_blank"> ຄູວຽງ ຄໍາຈັນວົງ </a><br />
  ຄຸ້ມຄອງໂດຍ: ກົມວິທະຍາສາດ-ປະຫວັດສາດ ການທະຫານ ກະຊວງປ້ອງກັນປະເທດ<br />
  ບ.ໂພນເຄັງ, ຖະໜົນ ໄກສອນ ພົມວິຫານ<br />
ໂທຣ&amp;ແຟກ : (856-21) 911012</p>
</body>
</html>