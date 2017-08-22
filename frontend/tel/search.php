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

$maxRows_searchphonebook_user = 10;
$pageNum_searchphonebook_user = 0;
if (isset($_GET['pageNum_searchphonebook_user'])) {
  $pageNum_searchphonebook_user = $_GET['pageNum_searchphonebook_user'];
}
$startRow_searchphonebook_user = $pageNum_searchphonebook_user * $maxRows_searchphonebook_user;

$colname_searchphonebook_user = "-1";
if (isset($_POST['searchphonebookuser'])) {
  $colname_searchphonebook_user = $_POST['searchphonebookuser'];
}
mysql_select_db($database_config, $config);
$query_searchphonebook_user = sprintf("SELECT * FROM tb_phonebook WHERE firstname LIKE %s", GetSQLValueString("%" . $colname_searchphonebook_user . "%", "text"));
$query_limit_searchphonebook_user = sprintf("%s LIMIT %d, %d", $query_searchphonebook_user, $startRow_searchphonebook_user, $maxRows_searchphonebook_user);
$searchphonebook_user = mysql_query($query_limit_searchphonebook_user, $config) or die(mysql_error());
$row_searchphonebook_user = mysql_fetch_assoc($searchphonebook_user);

if (isset($_GET['totalRows_searchphonebook_user'])) {
  $totalRows_searchphonebook_user = $_GET['totalRows_searchphonebook_user'];
} else {
  $all_searchphonebook_user = mysql_query($query_searchphonebook_user);
  $totalRows_searchphonebook_user = mysql_num_rows($all_searchphonebook_user);
}
$totalPages_searchphonebook_user = ceil($totalRows_searchphonebook_user/$maxRows_searchphonebook_user)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ຜົນການຄົ້ນຫາເບີໂທຣ</title>
<style type="text/css">
@import url("../../webfonts/boonbaan/stylesheet.css");

.font-search_user_tel {
	font-family: boonbaan;
	font-size: 24px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-header_search_user_tel {
	font-family: boonbaan;
	font-size: 20px;
	font-style: normal;
	font-weight: normal;
	color: #FFF;
}
.font-info_search_user_tel {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-footer_user_tel {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
body {
	background-image: linear-gradient(to right, #c1c161 0%, #c1c161 0%, #d4d4b1 100%);
}
</style>
</head>

<body>
<div align="center">
  <h3 class="font-search_user_tel">ຜົນການຄົ້ນຫາເບີໂທຣ ພະນັກງງານ-ນັກຮົບ </h3>
</div>
<br />
<table border="0" align="center" cellpadding="4" cellspacing="1">
  <tr align="center" bgcolor="#FF9966" class="font-header_search_user_tel">
    <td width="50" height="36">ລຳດັບ</td>
    <td width="130" height="36">ຊື່</td>
    <td width="150" height="36">ນາມສະກຸນ</td>
    <td width="80" height="36">ຊັ້ນ</td>
    <td width="140" height="36">ໜ້າທີ່ຮັບຜິດຊອບ</td>
    <td width="120" height="36">ສັງກັດ</td>
    <td width="150" height="36">ເບີມືຖື</td>
    <td width="150" height="36">ເບີຕັ້ງໂຕະ</td>
  </tr>
  <?php do { ?>
    <tr align="center" bgcolor="#CCCCCC" class="font-info_search_user_tel">
      <td><?php echo $row_searchphonebook_user['id_phonebook']; ?></td>
      <td><?php echo $row_searchphonebook_user['firstname']; ?></td>
      <td><?php echo $row_searchphonebook_user['lastname']; ?></td>
      <td><?php echo $row_searchphonebook_user['ranks']; ?></td>
      <td><?php echo $row_searchphonebook_user['position']; ?></td>
      <td><?php echo $row_searchphonebook_user['department']; ?></td>
      <td><?php echo $row_searchphonebook_user['tel']; ?></td>
      <td><?php echo $row_searchphonebook_user['home']; ?></td>
    </tr>
    <?php } while ($row_searchphonebook_user = mysql_fetch_assoc($searchphonebook_user)); ?>
</table>
<p align="center" class="font-footer_user_tel"><a href="../user/user.php">ກັບຄືນໜ້າຫຼັກ</a> | <a href="show.php">ກັບຄືນໜ້າເບີໂທຣ</a></p>
</body>
</html>
<?php
mysql_free_result($searchphonebook_user);
?>
