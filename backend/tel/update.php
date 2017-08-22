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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tb_phonebook SET firstname=%s, lastname=%s, ranks=%s, `position`=%s, department=%s, tel=%s, home=%s, remarrk=%s WHERE id_phonebook=%s",
                       GetSQLValueString($_POST['firstname'], "text"),
                       GetSQLValueString($_POST['lastname'], "text"),
                       GetSQLValueString($_POST['ranks'], "text"),
                       GetSQLValueString($_POST['position'], "text"),
                       GetSQLValueString($_POST['department'], "text"),
                       GetSQLValueString($_POST['tel'], "text"),
                       GetSQLValueString($_POST['home'], "text"),
                       GetSQLValueString($_POST['remarrk'], "text"),
                       GetSQLValueString($_POST['id_phonebook'], "int"));

  mysql_select_db($database_config, $config);
  $Result1 = mysql_query($updateSQL, $config) or die(mysql_error());

  $updateGoTo = "show.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_update_phonebook = "-1";
if (isset($_GET['id_phonebook'])) {
  $colname_update_phonebook = $_GET['id_phonebook'];
}
mysql_select_db($database_config, $config);
$query_update_phonebook = sprintf("SELECT * FROM tb_phonebook WHERE id_phonebook = %s", GetSQLValueString($colname_update_phonebook, "int"));
$update_phonebook = mysql_query($query_update_phonebook, $config) or die(mysql_error());
$row_update_phonebook = mysql_fetch_assoc($update_phonebook);
$totalRows_update_phonebook = mysql_num_rows($update_phonebook);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ແກ້ໄຂຂໍ້ມູນ</title>
<style type="text/css">
@import url("../../webfonts/boonbaan/stylesheet.css");

body {
	background-image: linear-gradient(to top, #c1dfc4 0%, #deecdd 100%);
}
.font-header_update_tel {
	font-family: boonbaan;
	font-size: 25px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-footer_tel {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
}
.font-tel_update_input {
	font-family: boonbaan;
	font-size: 20px;
	font-style: normal;
	font-weight: normal;
	height: 35px;
	width: 250px;
	border-top-color: #FFFFFF;
	border-right-color: #FFFFFF;
	border-bottom-color: #FFFFFF;
	border-left-color: #FFFFFF;
}
.font-btn_tel_update {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-tel_update {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
</style>
</head>

<body>

<h3 align="center" class="font-header_update_tel">ແກ້ໄຂ ຂໍ້ມູນພະນັກງານ-ນັກຮົບ ພາຍໃນກອງ ງໍ697</h3>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<table width="200" border="1" align="center" cellpadding="1" cellspacing="1">
    <tbody>
      <tr>
        <td><table align="center">
          <tr valign="baseline">
            <td align="right" nowrap="nowrap" class="font-tel_update">ຊື່:</td>
            <td><input name="firstname" type="text" class="font-tel_update_input" value="<?php echo htmlentities($row_update_phonebook['firstname'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap" class="font-tel_update">ນາມສະກຸນ:</td>
            <td><input name="lastname" type="text" class="font-tel_update_input" value="<?php echo htmlentities($row_update_phonebook['lastname'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap" class="font-tel_update">ຊັ້ນ:</td>
            <td><input name="ranks" type="text" class="font-tel_update_input" value="<?php echo htmlentities($row_update_phonebook['ranks'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap" class="font-tel_update">ໜ້າທີ່ຮັບຜິດຊອບ:</td>
            <td><input name="position" type="text" class="font-tel_update_input" value="<?php echo htmlentities($row_update_phonebook['position'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap" class="font-tel_update">ສັງກັດ:</td>
            <td><input name="department" type="text" class="font-tel_update_input" value="<?php echo htmlentities($row_update_phonebook['department'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap" class="font-tel_update">ເບີມືຖື:</td>
            <td><input name="tel" type="text" class="font-tel_update_input" value="<?php echo htmlentities($row_update_phonebook['tel'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td align="right" nowrap="nowrap" class="font-tel_update">ເບີຕັ້ງໂຕະ:</td>
            <td><input name="home" type="text" class="font-tel_update_input" value="<?php echo htmlentities($row_update_phonebook['home'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" class="font-btn_tel_update" value="ບັນທຶກແກ້ໄຂຂໍ້ມູນ" /></td>
          </tr>
        </table></td>
      </tr>
    </tbody>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_phonebook" value="<?php echo $row_update_phonebook['id_phonebook']; ?>" />
</form>
<p align="center" class="font-footer_tel"><a href="show.php">ກັບຄືນໜ້າເບີໂທຣ</a> | <a href="../admin/admin.php">ກັບຄືນໜ້າແອດມິນ</a></p>
</body>
</html>
<?php
mysql_free_result($update_phonebook);
?>
