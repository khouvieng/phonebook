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
$MM_authorizedUsers = "admin";
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

$MM_restrictGoTo = "../../frontend/user/user.php";
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
<title>ໜ້າແອດມິນ</title>
<style type="text/css">
body,td,th {
	color: #000000;
}
.fontlao {
	font-family: "phetsarath ot";
}
.admin {
	font-family: boonbaan;
}
.font-footer {
	font-family: boonbaan;
}
</style>
<link href="../../webfonts/phetsarath_ot/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="../../webfonts/boonbaan/stylesheet.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background-image: linear-gradient(to top, #c1dfc4 0%, #deecdd 100%);
}
</style>
</head>

<body>
<h2 align="center" class="admin"><img src="../../img/005.png" width="99" height="96" /></h2>
<h2 align="center" class="admin">ກອງພັນໃຫຍ່ 693<br />
  ໜ້າບໍລິຫານຈັດການຂອງຜູ້ດູແລລະບົບ<br />
</h2>
<table width="467" height="124" border="1" align="center">
  <tbody>
    <tr>
      <td align="center" bgcolor="#F4C230" style="color: #FFFFFF; font-family: boonbaan; font-size: 20px;">ຂໍ້ມູນເບີໂທຣ</td>
      <td align="center" bgcolor="#F4C230" style="color: #FFFFFF; font-family: boonbaan; font-size: 20px;">ຂໍ້ມູນຜູ້ນໍາໃຊ້</td>
      <td align="center" bgcolor="#F4C230" style="color: #FFFFFF; font-family: boonbaan; font-size: 20px;">ແກ້ໄຂ້ຂໍ້ມູນ</td>
      <td align="center" bgcolor="#F4C230" style="color: #FFFFFF; font-family: boonbaan; font-size: 20px;">ອອກຈາກລະບົບ</td>
    </tr>
    <tr>
      <td align="center"><a href="../tel/show.php"><img src="../../img/001.png" width="128" height="126" alt=""/></a></td>
      <td align="center"><a href="../users/show.php"><img src="../../img/002.png" width="128" height="126" alt=""/></a></td>
      <td align="center"><a href="../users/edit-profile.php"><img src="../../img/003.png" width="128" height="126" alt=""/></a></td>
      <td align="center"><a href="<?php echo $logoutAction ?>"><img src="../../img/004.png" width="128" height="126" alt=""/></a></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center">__________________________________________________________________________________________________________________</p>
<p align="center" class="font-footer">Copyright © 2017 PB (<a href="http://mod.gov.la/">MOD.GOV.LA</a>). ກະຊວງ ປ້ອງກັນປະເທດ Powered By :<a href="https://web.facebook.com/khouvieng.KHAMCHANVONG" target="_blank"> ຄູວຽງ ຄໍາຈັນວົງ </a><br />
  ຄຸ້ມຄອງໂດຍ: ກົມວິທະຍາສາດ-ປະຫວັດສາດ ການທະຫານ ກະຊວງປ້ອງກັນປະເທດ<br />
  ບ.ໂພນເຄັງ, ຖະໜົນ ໄກສອນ ພົມວິຫານ<br />
ໂທຣ&amp;ແຟກ : (856-21) 911012</p>
</body>
</html>