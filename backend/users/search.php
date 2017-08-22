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

$maxRows_search_users = 10;
$pageNum_search_users = 0;
if (isset($_GET['pageNum_search_users'])) {
  $pageNum_search_users = $_GET['pageNum_search_users'];
}
$startRow_search_users = $pageNum_search_users * $maxRows_search_users;

$colname_search_users = "-1";
if (isset($_POST['searchword'])) {
  $colname_search_users = $_POST['searchword'];
}
mysql_select_db($database_config, $config);
$query_search_users = sprintf("SELECT * FROM tb_users WHERE username_login LIKE %s", GetSQLValueString("%" . $colname_search_users . "%", "text"));
$query_limit_search_users = sprintf("%s LIMIT %d, %d", $query_search_users, $startRow_search_users, $maxRows_search_users);
$search_users = mysql_query($query_limit_search_users, $config) or die(mysql_error());
$row_search_users = mysql_fetch_assoc($search_users);

if (isset($_GET['totalRows_search_users'])) {
  $totalRows_search_users = $_GET['totalRows_search_users'];
} else {
  $all_search_users = mysql_query($query_search_users);
  $totalRows_search_users = mysql_num_rows($all_search_users);
}
$totalPages_search_users = ceil($totalRows_search_users/$maxRows_search_users)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ຜົນການຄົ້ນຫາ</title>
<style type="text/css">
@import url("../../webfonts/boonbaan/stylesheet.css");

body {
	background-image: linear-gradient(to right, #c1c161 0%, #c1c161 0%, #d4d4b1 100%);
}
.font-header_tb {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #FFF;
}
.font-in_tb {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-header_search_user {
	font-family: boonbaan;
	font-size: 24px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-footer_search_user {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
</style>
</head>

<body>
<p>&nbsp;</p>
<h3 align="center" class="font-header_search_user">ຜົນການຄົ້ນຫາຂໍ້ມູນ ພະນັກງານ-ນັກຮົບ ຜູ້ນໍາໃຊ້ພາຍໃນກອງ ງໍ697</h3>
<table border="0" align="center" cellpadding="4" cellspacing="2">
  <tr align="center" bgcolor="#2AA49B" class="font-header_tb">
    <td width="50" height="36">ລຳດັບ</td>
    <td width="150" height="36">ຊື່ຜູູ້ນໍາໃຊ້</td>
    <td width="130" height="36">ລະຫັດຜ່ານ</td>
    <td width="100" height="36">ລະດັບຜູ້ນໍາໃຊ້</td>
    <td width="170" height="36">ວັນທີ່ເດືອນປີລົງທະບຽນ</td>
    <td width="80" height="36">ລົບຜູ້ນໍາໃຊ້</td>
    <td width="95" height="36">ແກ້ໄຂຜູ້ນໍາໃຊ້</td>
  </tr>
  <?php do { ?>
    <tr align="center" bgcolor="#E8E8E8" class="font-in_tb">
      <td><?php echo $row_search_users['id_users']; ?></td>
      <td><?php echo $row_search_users['username_login']; ?></td>
      <td><?php echo $row_search_users['user_password']; ?></td>
      <td><?php echo $row_search_users['user_level']; ?></td>
      <td><?php echo $row_search_users['user_registered']; ?></td>
      <td>ລົບ</td>
      <td>ແກ້ໄຂ</td>
    </tr>
    <?php } while ($row_search_users = mysql_fetch_assoc($search_users)); ?>
</table>
<p align="center" class="font-footer_search_user"><a href="../admin/admin.php">ກັບຄືນໜ້າແອດມິນ</a> | <a href="show.php">ກັບຄືນໜ້າຜູນໍາໃຊ້</a></p>
</body>
</html>
<?php
mysql_free_result($search_users);
?>
