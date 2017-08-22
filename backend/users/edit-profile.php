<?php 
session_start();
require_once('../../Connections/config.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_users SET username_login=%s, user_password=%s, user_level=%s WHERE id_users=%s",
                       GetSQLValueString($_POST['username_login'], "text"),
                       GetSQLValueString($_POST['user_password'], "text"),
                       GetSQLValueString($_POST['user_level'], "text"),
                       GetSQLValueString($_POST['id_users'], "int"));

  mysql_select_db($database_config, $config);
  $Result1 = mysql_query($updateSQL, $config) or die(mysql_error());

  $updateGoTo = "../../index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_edit_profile = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_edit_profile = $_SESSION['MM_Username'];
}
mysql_select_db($database_config, $config);
$query_edit_profile = sprintf("SELECT * FROM tb_users WHERE username_login = %s", GetSQLValueString($colname_edit_profile, "text"));
$edit_profile = mysql_query($query_edit_profile, $config) or die(mysql_error());
$row_edit_profile = mysql_fetch_assoc($edit_profile);
$totalRows_edit_profile = mysql_num_rows($edit_profile);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
@import url("../../webfonts/boonbaan/stylesheet.css");

body {
	background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);
}
.font-header_edit_profile {
	font-family: boonbaan;
	font-size: 25px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-footer_edit_profile {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-remark_user_update1 {	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-remark_user_update2 {	font-family: boonbaan;
	font-size: 23px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-input_edit_profile {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #000;
	height: 35px;
	width: 250px;
	border-top-color: #FFF;
	border-right-color: #FFF;
	border-bottom-color: #FFF;
	border-left-color: #FFF;
}
.font-btn_edit_profile {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-edit_profile {
	font-family: boonbaan;
	font-size: 20px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
</style>
</head>

<body>
<center>
  <h3 class="font-header_edit_profile">ແກ້ຂໍ້ມູນສວນຕົວເຮົາທີ່ໃຊ້ລ່ອງອິນເຂົ້າສູ່ລະບົບ
  </h3>
</center>
<p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form_edit_profile" id="form_edit_profile">
  <table width="200" border="1" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td><table align="center">
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" class="font-edit_profile">ຊື່ຜູ້ນໍາໃຊ້:</td>
          <td><input name="username_login" type="text" class="font-input_edit_profile" value="<?php echo htmlentities($row_edit_profile['username_login'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" class="font-edit_profile">ລະຫັດຜູ້ນໍາໃຊ້:</td>
          <td><input name="user_password" type="text" class="font-input_edit_profile" value="<?php echo htmlentities($row_edit_profile['user_password'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap="nowrap" class="font-edit_profile">ລະດັບຜູ້ນໍາໃຊ້:</td>
          <td><input name="user_level" type="text" class="font-input_edit_profile" value="<?php echo htmlentities($row_edit_profile['user_level'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" class="font-btn_edit_profile" value="ບັນທືກແກ້ໄຂ" /></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_users" value="<?php echo $row_edit_profile['id_users']; ?>" />
</form>
<table width="400" height="80" border="1" align="center">
  <tr>
    <td valign="top" bgcolor="#FFFFFF"><p align="center" class="font-remark_user_update2">ໝາຍເຫດ :</p>
      <p align="center" class="font-remark_user_update1">ລະດັບຜູ້ນໍາໃຊ້ ແມ່ນໃຫ້ພີມໃສ່ user ກັບ admin ເທົານັ້ນ</p>
      <p align="center" class="font-remark_user_update1">&nbsp;</p></td>
  </tr>
</table>
<p align="center" class="font-footer_edit_profile"><a href="../admin/admin.php">
ກັບໜ້າແອດມິນ</a> | <a href="show.php">ກັບໄປໜ້າຂໍ້ມູນຜູ້ໃຊ້</a></p>
</body>
</html>
<?php
mysql_free_result($edit_profile);
?>
