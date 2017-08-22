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

$maxRows_searchphonebook = 10;
$pageNum_searchphonebook = 0;
if (isset($_GET['pageNum_searchphonebook'])) {
  $pageNum_searchphonebook = $_GET['pageNum_searchphonebook'];
}
$startRow_searchphonebook = $pageNum_searchphonebook * $maxRows_searchphonebook;

$colname_searchphonebook = "-1";
if (isset($_POST['searchphonebook'])) {
  $colname_searchphonebook = $_POST['searchphonebook'];
}
mysql_select_db($database_config, $config);
$query_searchphonebook = sprintf("SELECT * FROM tb_phonebook WHERE firstname LIKE %s", GetSQLValueString("%" . $colname_searchphonebook . "%", "text"));
$query_limit_searchphonebook = sprintf("%s LIMIT %d, %d", $query_searchphonebook, $startRow_searchphonebook, $maxRows_searchphonebook);
$searchphonebook = mysql_query($query_limit_searchphonebook, $config) or die(mysql_error());
$row_searchphonebook = mysql_fetch_assoc($searchphonebook);

if (isset($_GET['totalRows_searchphonebook'])) {
  $totalRows_searchphonebook = $_GET['totalRows_searchphonebook'];
} else {
  $all_searchphonebook = mysql_query($query_searchphonebook);
  $totalRows_searchphonebook = mysql_num_rows($all_searchphonebook);
}
$totalPages_searchphonebook = ceil($totalRows_searchphonebook/$maxRows_searchphonebook)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ຜົນການຄົ້ນຫາລາຍຊື່ພະນັກງານ</title>
<style type="text/css">
@import url("../../webfonts/boonbaan/stylesheet.css");

.font-color_header_seacrch {
	font-family: boonbaan;
	font-size: 17px;
	font-style: normal;
	font-weight: normal;
	color: #FFFFFF;
}
.font-tel_search {
	font-family: boonbaan;
	font-size: 17px;
	font-style: normal;
	font-weight: normal;
	color: #000000;
}
.font-footer_search {
	font-family: boonbaan;
	font-size: 18px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-header_search {
	font-family: boonbaan;
	font-size: 30px;
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
<h2 align="center" class="font-header_search">ຜົນການຄົ້ນຫາເບີໂທຣ ພະນັກງານ-ນັກຮົບ ພາຍໃນກອງ ງໍ697</h2>
<table border="0" align="center" cellpadding="4" cellspacing="1">
  <tr align="center" bgcolor="#1DAC73" class="font-color_header_seacrch">
    <td width="50" height="36">ລຳດັບ</td>
    <td width="130" height="36">ຊື່</td>
    <td width="150" height="36">ນາມສະກຸນ</td>
    <td width="80" height="36">ຊັ້ນ</td>
    <td width="140" height="36">ໜ້າທີ່ຮັບຜິດຊອບ</td>
    <td width="120" height="36">ສັງກັດ</td>
    <td width="150" height="36">ເບີມືຖື</td>
    <td width="150" height="36">ເບີຕັ້ງໂຕະ</td>
    <td width="50" height="36">ລົບ</td>
    <td width="50" height="36">ແກ້ໄຂ</td>
  </tr>
  <?php do { ?>
    <tr align="center" bgcolor="#CDCDCD" class="font-tel_search">
      <td><?php echo $row_searchphonebook['id_phonebook']; ?></td>
      <td><?php echo $row_searchphonebook['firstname']; ?></td>
      <td><?php echo $row_searchphonebook['lastname']; ?></td>
      <td><?php echo $row_searchphonebook['ranks']; ?></td>
      <td><?php echo $row_searchphonebook['position']; ?></td>
      <td><?php echo $row_searchphonebook['department']; ?></td>
      <td><?php echo $row_searchphonebook['tel']; ?></td>
      <td><?php echo $row_searchphonebook['home']; ?></td>
      <td><a href="delete.php?id_phonebook=<?php echo $row_searchphonebook['id_phonebook']; ?>">ລົບ</a></td>
      <td><a href="update.php?id_phonebook=<?php echo $row_show_phonebook['id_phonebook']; ?>">ແກ້ໄຂ</a></td>
    </tr>
    <?php } while ($row_searchphonebook = mysql_fetch_assoc($searchphonebook)); ?>
</table>
<h4 align="center"><a href="show.php" class="font-footer_search">ກັບຄືນໜ້າເບີໂທຣ</a> | <span class="font-footer_search"><a href="../admin/admin.php">ກັບໜ້າແອດມິນ</a></span></h4>
</body>
</html>
<?php
mysql_free_result($searchphonebook);
?>
