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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tb_phonebook (firstname, lastname, ranks, `position`, department, tel, home, remarrk) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['firstname'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"),
                       GetSQLValueString($_POST['ranks'], "text"),
                       GetSQLValueString($_POST['position'], "text"),
                       GetSQLValueString($_POST['department'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['home'], "text"),
                       GetSQLValueString($_POST['remarrk'], "text"));

  mysql_select_db($database_config, $config);
  $Result1 = mysql_query($insertSQL, $config) or die(mysql_error());

  $insertGoTo = "show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ບັນທືກຂໍ້ມູນເບີໂທຣ</title>
<style type="text/css">
@import url("../../webfonts/boonbaan/stylesheet.css");

.font-input_register {
	font-family: boonbaan;
	font-style: normal;
	font-weight: normal;
	color: #000;
	height: 35px;
	width: 250px;
}
.font-btn_register {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-header_register {
	font-family: boonbaan;
	font-size: 29px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-input_register {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
body {
	background-image: linear-gradient(to right, #c1c161 0%, #c1c161 0%, #d4d4b1 100%);
}
.font-footer_register {
	font-family: boonbaan;
	font-size: 20px;
	font-style: normal;
	font-weight: normal;
	color: #000000;
}
</style>
</head>

<body>
<p>&nbsp;</p>
<h2 align="center" class="font-header_register">ລົງທະບຽນຂໍ້ມູນເບີໂທຣ ພະນັກງານ-ນັກຮົບ ພາຍໃນກອງ ງໍ697</h2>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form_register">
  <table width="384" border="1" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="376"><table align="center">
        <tr valign="baseline" class="font-input_register">
          <td align="right" valign="middle" nowrap="nowrap">ຊື່:</td>
          <td><input name="firstname" type="text" class="font-input_register" value="" size="32" /></td>
        </tr>
        <tr valign="baseline" class="font-input_register">
          <td align="right" valign="middle" nowrap="nowrap">ນາມສະກຸນ:</td>
          <td><input name="lastname" type="text" class="font-input_register" value="" size="32" /></td>
        </tr>
        <tr valign="baseline" class="font-input_register">
          <td align="right" valign="middle" nowrap="nowrap">ຊັ້ນ:</td>
          <td><input name="ranks" type="text" class="font-input_register" value="" size="32" /></td>
        </tr>
        <tr valign="baseline" class="font-input_register">
          <td align="right" valign="middle" nowrap="nowrap">ໜ້າທີ່ຮັບຜິດຊອບ:</td>
          <td><input name="position" type="text" class="font-input_register" value="" size="32" /></td>
        </tr>
        <tr valign="baseline" class="font-input_register">
          <td align="right" valign="middle" nowrap="nowrap">ສັງກັດ:</td>
          <td><input name="department" type="text" class="font-input_register" value="" size="32" /></td>
        </tr>
        <tr valign="baseline" class="font-input_register">
          <td align="right" valign="middle" nowrap="nowrap">ເບີມືຖື:</td>
          <td><input name="tel" type="text" class="font-input_register" value="" size="32" /></td>
        </tr>
        <tr valign="baseline" class="font-input_register">
          <td align="right" valign="middle" nowrap="nowrap">ເບີຕັ້ງໂຕະ:</td>
          <td><input name="home" type="text" class="font-input_register" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td align="right" valign="middle" nowrap="nowrap">&nbsp;</td>
          <td><input type="submit" class="font-btn_register" value="ບັນທືກຂໍ້ມູນ" /></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p align="center" class="font-footer_register"><a href="show.php">ກັນໜ້າເບີໂທຣ</a> | <a href="../admin/admin.php">ກັບໜ້າແອດມິນ</a></p>
</body>
</html>