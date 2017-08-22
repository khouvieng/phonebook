<?php require_once('../../Connections/config.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
    if (($strUsers == "") && true) { 
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
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_config, $config);
$query_count = "SELECT * FROM tb_phonebook";
$count = mysql_query($query_count, $config) or die(mysql_error());
$row_count = mysql_fetch_assoc($count);
$totalRows_count = mysql_num_rows($count);

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_show_phonebook = 10;
$pageNum_show_phonebook = 0;
if (isset($_GET['pageNum_show_phonebook'])) {
  $pageNum_show_phonebook = $_GET['pageNum_show_phonebook'];
}
$startRow_show_phonebook = $pageNum_show_phonebook * $maxRows_show_phonebook;

mysql_select_db($database_config, $config);
$query_show_phonebook = "SELECT * FROM tb_phonebook";
$query_limit_show_phonebook = sprintf("%s LIMIT %d, %d", $query_show_phonebook, $startRow_show_phonebook, $maxRows_show_phonebook);
$show_phonebook = mysql_query($query_limit_show_phonebook, $config) or die(mysql_error());
$row_show_phonebook = mysql_fetch_assoc($show_phonebook);

if (isset($_GET['totalRows_show_phonebook'])) {
  $totalRows_show_phonebook = $_GET['totalRows_show_phonebook'];
} else {
  $all_show_phonebook = mysql_query($query_show_phonebook);
  $totalRows_show_phonebook = mysql_num_rows($all_show_phonebook);
}
$totalPages_show_phonebook = ceil($totalRows_show_phonebook/$maxRows_show_phonebook)-1;

mysql_select_db($database_config, $config);
$query_paging = "SELECT * FROM tb_phonebook";
$paging = mysql_query($query_paging, $config) or die(mysql_error());
$row_paging = mysql_fetch_assoc($paging);
$totalRows_paging = mysql_num_rows($paging);

$queryString_show_phonebook = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_show_phonebook") == false && 
        stristr($param, "totalRows_show_phonebook") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_show_phonebook = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_show_phonebook = sprintf("&totalRows_show_phonebook=%d%s", $totalRows_show_phonebook, $queryString_show_phonebook);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ຂໍ້ມູນເບີໂທຣ</title>
<style type="text/css">
@import url("../../webfonts/boonbaan/stylesheet.css");

.font-header_tel {
	font-family: boonbaan;
	font-size: 16px;
	font-style: normal;
	font-weight: normal;
	color: #FFF;
}
.font-header_color {
	color: #FFF;
	font-family: boonbaan;
	font-size: 17px;
}
body {
	background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);
}
.font-tel {
	font-family: boonbaan;
	font-size: 16px;
	color: #000;
}
.font-search {
	font-family: boonbaan;
	font-size: 20px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-sbtn {
	font-family: boonbaan;
	font-size: 16px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-inputsearch {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
	border-top-color: #CCC;
	border-right-color: #CCC;
	border-bottom-color: #CCC;
	border-left-color: #CCC;
	height: 30px;
	width: 220px;
}
.font-paging {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
</style>
</head>
<body class="font-infotel">
<span class="font-tel"></span>
<h2 align="center"><span style="font-family: boonbaan">ຂໍ້ມູນເບີໂທຣ ພະນັກງານ-ນັກຮົບ ພາຍໃນກອງ ງໍ697</span></h2>
<p align="center"><a href="registerphonebook.php" style="font-family: boonbaan; font-size: 20px;">ເພີມຂໍ້ມູນເບີໂທໃໝ່</a><a href="registerphonebook.php"></a></p>
<center>
<form action="search.php" method="post" name="form_searchphonebook" class="font-search" id="form_searchphonebook">
<label for="searchphonebook" class="font-infotel">ຄົ້ນຫາຊື່ພະນັກງານ :</label>
  <input name="searchphonebook" type="text" class="font-inputsearch" id="searchphonebook" placeholder="ພີມຊື່ຜູ່ທີ່ຕ້ອງການຄົ້ນຫາ" value="" />
  <input name="btnsearchphonebook" type="submit" class="font-sbtn" id="btnsearchphonebook" value="ກົດເພື່ອຄົ້ນຫາ" />
  
</form>
</center>
<table border="0" align="center" cellpadding="4" cellspacing="1">
  <tr class="font-header_color">
    <td width="50" height="36" align="center" bgcolor="#1DAC73">ລຳດັບ</td>
    <td width="130" align="center" bgcolor="#1DAC73">ຊື່</td>
    <td width="150" align="center" bgcolor="#1DAC73">ນາມສະກຸນ</td>
    <td width="80" align="center" bgcolor="#1DAC73">ຊັ້ນ</td>
    <td width="140" align="center" bgcolor="#1DAC73">ໜ້າທີ່ຮັບຜິດຊອບ</td>
    <td width="120" align="center" bgcolor="#1DAC73">ສັງກັດ</td>
    <td width="150" align="center" bgcolor="#1DAC73">ເບີມືຖື</td>
    <td width="150" align="center" bgcolor="#1DAC73">ເບີຕັ້ງໂຕະ</td>
    <td width="50" align="center" bgcolor="#1DAC73">ລົບ</td>
    <td width="50" align="center" bgcolor="#1DAC73">ແກ້ໄຂ</td>
  </tr>
  <?php do { ?>
    <tr class="font-tel">
      <td align="center" bgcolor="#CDCDCD"><?php echo $row_show_phonebook['id_phonebook']; ?></td>
      <td width="130" align="center" bgcolor="#CDCDCD"><?php echo $row_show_phonebook['firstname']; ?></td>
      <td width="150" align="center" bgcolor="#CDCDCD"><?php echo $row_show_phonebook['lastname']; ?></td>
      <td width="80" align="center" bgcolor="#CDCDCD"><?php echo $row_show_phonebook['ranks']; ?></td>
      <td width="140" align="center" bgcolor="#CDCDCD"><?php echo $row_show_phonebook['position']; ?></td>
      <td width="120" align="center" bgcolor="#CDCDCD"><?php echo $row_show_phonebook['department']; ?></td>
      <td width="150" align="center" bgcolor="#CDCDCD"><?php echo $row_show_phonebook['tel']; ?></td>
      <td width="150" align="center" bgcolor="#CDCDCD"><?php echo $row_show_phonebook['home']; ?></td>
      <td width="50" align="center" bgcolor="#CDCDCD"><a href="delete.php?id_phonebook=<?php echo $row_show_phonebook['id_phonebook']; ?>">ລົບ</a></td>
      <td width="50" align="center" bgcolor="#CDCDCD"><a href="update.php?id_phonebook=<?php echo $row_show_phonebook['id_phonebook']; ?>">ແກ້ໄຂ</a></td>
    </tr>
    <?php } while ($row_show_phonebook = mysql_fetch_assoc($show_phonebook)); ?>
</table>
<table border="0" align="center">
  <tr class="font-paging">
    <td><?php if ($pageNum_show_phonebook > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_show_phonebook=%d%s", $currentPage, 0, $queryString_show_phonebook); ?>">ໜ້າທຳອິດ</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_show_phonebook > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_show_phonebook=%d%s", $currentPage, max(0, $pageNum_show_phonebook - 1), $queryString_show_phonebook); ?>">ຍ້ອນກັບ</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_show_phonebook < $totalPages_show_phonebook) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_show_phonebook=%d%s", $currentPage, min($totalPages_show_phonebook, $pageNum_show_phonebook + 1), $queryString_show_phonebook); ?>">ໜ້າທັດໄປ</a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_show_phonebook < $totalPages_show_phonebook) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_show_phonebook=%d%s", $currentPage, $totalPages_show_phonebook, $queryString_show_phonebook); ?>">ລ່າສຸດ</a>
      <?php } // Show if not last page ?></td>
  </tr>
</table>
<div align="center" class="font-paging">
  ( ລາຍຊື່ທັງໝົດ<?php echo $totalRows_count ?> ຄົນ )
  <br />
  <a href="../admin/admin.php">ກັບຄືນໜ້າແອດມິນ </a>
  </div>
</body>
</html>
<?php
mysql_free_result($count);

mysql_free_result($show_phonebook);

mysql_free_result($paging);
?>
