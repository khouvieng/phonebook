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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_show_users = 10;
$pageNum_show_users = 0;
if (isset($_GET['pageNum_show_users'])) {
  $pageNum_show_users = $_GET['pageNum_show_users'];
}
$startRow_show_users = $pageNum_show_users * $maxRows_show_users;

mysql_select_db($database_config, $config);
$query_show_users = "SELECT * FROM tb_users";
$query_limit_show_users = sprintf("%s LIMIT %d, %d", $query_show_users, $startRow_show_users, $maxRows_show_users);
$show_users = mysql_query($query_limit_show_users, $config) or die(mysql_error());
$row_show_users = mysql_fetch_assoc($show_users);

if (isset($_GET['totalRows_show_users'])) {
  $totalRows_show_users = $_GET['totalRows_show_users'];
} else {
  $all_show_users = mysql_query($query_show_users);
  $totalRows_show_users = mysql_num_rows($all_show_users);
}
$totalPages_show_users = ceil($totalRows_show_users/$maxRows_show_users)-1;

mysql_select_db($database_config, $config);
$query_paging = "SELECT * FROM tb_phonebook";
$paging = mysql_query($query_paging, $config) or die(mysql_error());
$row_paging = mysql_fetch_assoc($paging);
$totalRows_paging = mysql_num_rows($paging);

$queryString_show_users = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_show_users") == false && 
        stristr($param, "totalRows_show_users") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_show_users = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_show_users = sprintf("&totalRows_show_users=%d%s", $totalRows_show_users, $queryString_show_users);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ຂໍ້ມູນຜູ້ນໍາໃຊ້ລະບົບ</title>
<style type="text/css">
@import url("../../webfonts/boonbaan/stylesheet.css");

body {
	background-image: linear-gradient(to right, #c1c161 0%, #c1c161 0%, #d4d4b1 100%);
}
.font-header_user {
	font-family: boonbaan;
	font-size: 25px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-add_user {
	font-family: boonbaan;
	font-size: 23px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-footer_user {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-search_user1 {
	font-family: boonbaan;
	font-size: 16px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-search_user2 {
	font-family: boonbaan;
	font-size: 22px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-serch_input {
	font-size: 18px;
	color: #000;
	height: 29px;
	width: 200px;
}
.font-search_tb_header {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #FFF;
}
.font-search_tb_user {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-user_paging {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-count_user {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
</style>
</head>

<body>
<h3 align="center" class="font-header_user">ຂໍ້ມູນ ພະນັກງານ-ນັກຮົບ ພາຍໃນກອງ ງໍ697 ຜູ້ນໍາໃຊ້ລະບົບ</h3>
<p align="center"><a href="register.php" class="font-add_user">ເພີມພະນັກງານຜູ້ນໍາໃຊ້</a></p>
<center><form action="search.php" method="post" name="form_search" class="font-search_user2" id="form_search">
  <label for="searchword">ຄົ້ນຫາ :</label>
  <input name="searchword" type="text" class="font-serch_input" id="searchword" />
  <input name="btnsearch" type="submit" class="font-search_user1" id="btnsearch" value="ກົດຄົ້ນຫາ" />
</form></center>
<table border="0" align="center" cellpadding="4" cellspacing="2">
  <tr class="font-search_tb_header">
    <td width="50" height="36" align="center" bgcolor="#2AA49B" style="color: #FFFFFF">ລຳດັບ</td>
    <td width="150" height="36" align="center" bgcolor="#2AA49B" style="color: #FFFFFF">ຊື່ຜູ້ນໍາໃຊ້</td>
    <td width="130" height="36" align="center" bgcolor="#2AA49B" style="color: #FFFFFF">ລະຫັດຜ່ານ</td>
    <td width="100" height="36" align="center" bgcolor="#2AA49B" style="color: #FFFFFF">ລະດັບຜູ້ນໍາໃຊ້</td>
    <td width="170" height="36" align="center" bgcolor="#2AA49B" style="color: #FFFFFF">ວັນທີ່ເດືອນປີລົງທະບຽນ</td>
    <td width="80" height="36" align="center" bgcolor="#2AA49B" style="color: #FFFFFF">ລົບຜູ້ນໍາໃຊ້</td>
    <td width="95" height="36" align="center" bgcolor="#2AA49B" style="color: #FFFFFF">ແກ້ໄຂຜູ້ນໍາໃຊ້</td>
  </tr>
  <?php do { ?>
    <tr class="font-search_tb_user">
      <td align="center" bgcolor="#E8E8E8"><?php echo $row_show_users['id_users']; ?></td>
      <td align="center" bgcolor="#E8E8E8"><?php echo $row_show_users['username_login']; ?></td>
      <td align="center" bgcolor="#E8E8E8"><?php echo $row_show_users['user_password']; ?></td>
      <td align="center" bgcolor="#E8E8E8"><?php echo $row_show_users['user_level']; ?></td>
      <td align="center" bgcolor="#E8E8E8"><?php echo $row_show_users['user_registered']; ?></td>
      <td align="center" bgcolor="#E8E8E8"><a href="delete.php?id_users=<?php echo $row_show_users['id_users']; ?>">ລົບ</a></td>
      <td align="center" bgcolor="#E8E8E8"><a href="update.php?id_users=<?php echo $row_show_users['id_users']; ?>">ແກ້ໄຂ</a></td>
    </tr>
    <?php } while ($row_show_users = mysql_fetch_assoc($show_users)); ?>
</table>
<table border="0" align="center">
  <tr class="font-user_paging">
    <td><?php if ($pageNum_show_users > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_show_users=%d%s", $currentPage, 0, $queryString_show_users); ?>">ໜ້າທຳອິດ</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_show_users > 0) { // Show if not first page ?>
      <a href="<?php printf("%s?pageNum_show_users=%d%s", $currentPage, max(0, $pageNum_show_users - 1), $queryString_show_users); ?>">ຍ້ອນກັບ</a>
      <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_show_users < $totalPages_show_users) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_show_users=%d%s", $currentPage, min($totalPages_show_users, $pageNum_show_users + 1), $queryString_show_users); ?>">ຕໍ່ໄປ</a>
      <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_show_users < $totalPages_show_users) { // Show if not last page ?>
      <a href="<?php printf("%s?pageNum_show_users=%d%s", $currentPage, $totalPages_show_users, $queryString_show_users); ?>">ລ່າສຸດ</a>
      <?php } // Show if not last page ?></td>
  </tr>
</table>
<center>
  <div class="font-count_user">( ມີຜູ້ນໍາໃຊ້ລະບົບທັງໝົດ <?php echo $totalRows_show_users ?> ຄົນ )</div>
</center>
<center><a href="../admin/admin.php" class="font-footer_user">
ກັບໜ້າແອດມິນ</a></center>
</body>
</html>
<?php
mysql_free_result($show_users);

mysql_free_result($paging);
?>
