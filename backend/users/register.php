<?php require_once('../../Connections/config.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_register")) {
  $insertSQL = sprintf("INSERT INTO tb_users (username_login, user_password, user_level,user_registered) VALUES (%s, %s, %s,now())",
                       GetSQLValueString($_POST['username_login'], "text"),
                       GetSQLValueString($_POST['user_password'], "text"),
                       GetSQLValueString($_POST['select'], "text"));

  mysql_select_db($database_config, $config);
  $Result1 = mysql_query($insertSQL, $config) or die(mysql_error());

  $insertGoTo = "show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_config, $config);
$query_register_user = "SELECT * FROM tb_users";
$register_user = mysql_query($query_register_user, $config) or die(mysql_error());
$row_register_user = mysql_fetch_assoc($register_user);
$totalRows_register_user = mysql_num_rows($register_user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ລົງທະບຽນຜູ້ນໍາໃຊ້</title>
<style type="text/css">
@import url("../../webfonts/boonbaan/stylesheet.css");

body {
	background-image: linear-gradient(to right, #c1c161 0%, #c1c161 0%, #d4d4b1 100%);
}
.font-user_register {
	font-family: boonbaan;
	font-size: 25px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-footer_user_register {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-input_register_user {
	font-family: boonbaan;
	font-size: 20px;
	font-style: normal;
	font-weight: normal;
	color: #000;
	height: 33px;
	width: 250px;
	border-top-color: #C90;
	border-right-color: #C90;
	border-bottom-color: #C90;
	border-left-color: #C90;
}
.font-btn_register_user {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-name_user_register {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
</style>
</head>

<body>
<h3 align="center" class="font-user_register">ເພີມຂໍ້ມູນ ພະນັກງານ-ນັກຮົບ ພາຍໃນກອງ ງໍ697 ຜູ້ນໍາໃຊ້ລະບົບ</h3>
<form id="form_register" name="form_register" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="200" border="1" align="center" cellpadding="1" cellspacing="0">
    <tr>
      <td><table width="361" border="0" align="center">
        <tr>
          <td width="201" align="right" class="font-name_user_register"><label for="username_login">ຊື່ :</label></td>
          <td width="144"><input name="username_login" type="text" class="font-input_register_user" id="username_login" /></td>
        </tr>
        <tr>
          <td align="right" class="font-name_user_register"><label for="user_password">ລະຫັດຜ່ານ :</label></td>
          <td><input name="user_password" type="password" class="font-input_register_user" id="user_password" /></td>
        </tr>
        <tr>
          <td align="right" class="font-name_user_register">ເລືອກລຳດັບຜູ້ນໍາໃຊ້ :</td>
          <td><select name="select" class="font-btn_register_user" id="select">
            <option value="admin">ແອດມິນ</option>
            <option value="user">ຜູ້ນໍາໃຊ້</option>
          </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="btnregister" type="submit" class="font-btn_register_user" id="btnregister" value=" ບັນທືກຂໍ້ມູນ" />
            <input type="hidden" name="MM_insert" value="form_register" /></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
<p align="center" class="font-footer_user_register"><a href="../admin/admin.php">ກັບຄືນໜ້າແອດມິນ</a> | <a href="show.php">ກັບຄືນໜ້າຜູ້ໃຊ້</a></p>
</body>
</html>
<?php
mysql_free_result($register_user);
?>
