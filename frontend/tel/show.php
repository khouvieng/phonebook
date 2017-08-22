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

$maxRows_showphonebook_user = 10;
$pageNum_showphonebook_user = 0;
if (isset($_GET['pageNum_showphonebook_user'])) {
  $pageNum_showphonebook_user = $_GET['pageNum_showphonebook_user'];
}
$startRow_showphonebook_user = $pageNum_showphonebook_user * $maxRows_showphonebook_user;

mysql_select_db($database_config, $config);
$query_showphonebook_user = "SELECT * FROM tb_phonebook";
$query_limit_showphonebook_user = sprintf("%s LIMIT %d, %d", $query_showphonebook_user, $startRow_showphonebook_user, $maxRows_showphonebook_user);
$showphonebook_user = mysql_query($query_limit_showphonebook_user, $config) or die(mysql_error());
$row_showphonebook_user = mysql_fetch_assoc($showphonebook_user);

if (isset($_GET['totalRows_showphonebook_user'])) {
  $totalRows_showphonebook_user = $_GET['totalRows_showphonebook_user'];
} else {
  $all_showphonebook_user = mysql_query($query_showphonebook_user);
  $totalRows_showphonebook_user = mysql_num_rows($all_showphonebook_user);
}
$totalPages_showphonebook_user = ceil($totalRows_showphonebook_user/$maxRows_showphonebook_user)-1;

$queryString_showphonebook_user = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_showphonebook_user") == false && 
        stristr($param, "totalRows_showphonebook_user") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_showphonebook_user = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_showphonebook_user = sprintf("&totalRows_showphonebook_user=%d%s", $totalRows_showphonebook_user, $queryString_showphonebook_user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ຂໍ້ມູນເບີໂທຣພະນັກງານ-ນັກຮົບ</title>
<style type="text/css">
@import url("../../webfonts/boonbaan/stylesheet.css");

.font-header_user_tel {
	font-family: boonbaan;
	font-size: 24px;
	font-style: normal;
	font-weight: normal;
}
.font-footer_user_tel {
	font-family: boonbaan;
	font-size: 22px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-search_user_tel {
	font-family: boonbaan;
	font-size: 22px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-btnsearch_user_tel {
	font-family: boonbaan;
	font-size: 17px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-input_user_tel {
	font-family: boonbaan;
	font-size: 17px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-user_tel {
	font-family: boonbaan;
	font-size: 20px;
	font-style: normal;
	font-weight: normal;
	color: #FFFFFF;
}
.font-infouser_tel {
	font-family: boonbaan;
	font-size: 19px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
body {
	background-image: linear-gradient(to right, #c1c161 0%, #c1c161 0%, #d4d4b1 100%);
}
.font-show_tel_paging {
	font-family: boonbaan;
	font-size: 20px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
</style>
</head>

<body class="font-show_tel_paging">
<h3 align="center" class="font-header_user_tel">ຂໍ້ມູນເບີໂທຣ ພະນັກງານ-ນັກຮົບພາຍໃນ</h3>
<center>
  <form action="search.php" method="post" name="form_search_user" class="font-search_user_tel" id="form_search_user">
  <label for="searchphonebookuser">ຄົ້ນຫາຊື່ :</label>
  <input name="searchphonebookuser" type="text" class="font-input_user_tel" id="searchphonebookuser" />
  <input name="btnsearchphonebookuser" type="submit" class="font-btnsearch_user_tel" id="btnsearchphonebookuser" value="ກົດເພື່ອຄົ້ນຫາຊື່" />
</form></center>
<table border="0" align="center" cellpadding="4" cellspacing="1">
  <tr align="center" bgcolor="#DB7B1C" class="font-user_tel">
    <td width="50" height="36">ດຳດັບ</td>
    <td width="130" height="36">ຊື່</td>
    <td width="150" height="36">ນາມສະກຸນ</td>
    <td width="80" height="36">ຊັ້ນ</td>
    <td width="140" height="36">ໜ້າທີ່ຮັບຜິດຊອບ</td>
    <td width="120" height="36">ສັງກັດ</td>
    <td width="150" height="36">ເບີມືຖືກ</td>
    <td width="150" height="36">ເບີຕັ້ງໂຕະ</td>
  </tr>
  <?php do { ?>
    <tr align="center" bgcolor="#D6D6D6" class="font-infouser_tel">
      <td><?php echo $row_showphonebook_user['id_phonebook']; ?></td>
      <td><?php echo $row_showphonebook_user['firstname']; ?></td>
      <td><?php echo $row_showphonebook_user['lastname']; ?></td>
      <td><?php echo $row_showphonebook_user['ranks']; ?></td>
      <td><?php echo $row_showphonebook_user['position']; ?></td>
      <td><?php echo $row_showphonebook_user['department']; ?></td>
      <td><?php echo $row_showphonebook_user['tel']; ?></td>
      <td><?php echo $row_showphonebook_user['home']; ?></td>
    </tr>
    <?php } while ($row_showphonebook_user = mysql_fetch_assoc($showphonebook_user)); ?>
</table>
<p align="center">
<table border="0" align="center" class="font-show_tel_paging">
  <tr>
    <td><?php if ($pageNum_showphonebook_user > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_showphonebook_user=%d%s", $currentPage, 0, $queryString_showphonebook_user); ?>">ໜ້າທຳອິດ</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_showphonebook_user > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_showphonebook_user=%d%s", $currentPage, max(0, $pageNum_showphonebook_user - 1), $queryString_showphonebook_user); ?>">ຍ້ອນກັບ</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_showphonebook_user < $totalPages_showphonebook_user) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_showphonebook_user=%d%s", $currentPage, min($totalPages_showphonebook_user, $pageNum_showphonebook_user + 1), $queryString_showphonebook_user); ?>">ໜ້າຕໍ່ໄປ</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_showphonebook_user < $totalPages_showphonebook_user) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_showphonebook_user=%d%s", $currentPage, $totalPages_showphonebook_user, $queryString_showphonebook_user); ?>">ລ່າສຸດ</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
( ມີຂໍ້ມູນເບີໂທຣທັງໝົດ <?php echo $totalRows_showphonebook_user ?> ຄົນ)<a href="../user/user.php" class="font-footer_user_tel"><br />
ກັບຄືນໜ້າຫຼັກ</a>
</p>
</body>
</html>
<?php
mysql_free_result($showphonebook_user);
?>
