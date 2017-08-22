<?php require_once('Connections/config.php'); ?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username_login'])) {
  $loginUsername=$_POST['username_login'];
  $password=$_POST['user_password'];
  $MM_fldUserAuthorization = "user_level";
  $MM_redirectLoginSuccess = "backend/admin/admin.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_config, $config);
  	
  $LoginRS__query=sprintf("SELECT username_login, user_password, user_level FROM tb_users WHERE username_login=%s AND user_password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $config) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'user_level');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ເຂົ້າສູ່ລະບົບ</title>
<link rel="stylesheet" href="css/style.css">
<style type="text/css">
@import url("webfonts/boonbaan/stylesheet.css");

body {
	background-image: linear-gradient(60deg, #abecd6 0%, #fbed96 100%);
}

.font-footer {
	font-family: boonbaan;
	font-size: 16px;
	font-style: normal;
	font-weight: normal;
	color: #000;
}
.font-input {
	font-family: boonbaan;
	font-size: 16px;
	color: #666;
}
.font-btnlogin {
	background-color:#33B5E5;
	font-family: boonbaan;
	font-size: 17px;
	color: #FFFFFF;
}
.font-header {
	font-family: boonbaan;
	font-size: 20px;
	font-style: normal;
	color: #33B5E5;
}
</style>
</head>
<body>
<center>
  <p><img src="img/005.png" width="99" height="96" alt=""/><br />
</p>
</center>
        <div class="module form-module">
          <div class="form"> 
            <h2 align="center" class="font-footer"><span class="font-header">ກະລຸນາປ່ອນຊື່&ລະຫັດຜ່ານ
            </span></h2>
            <form id="form_login" name="form_login" method="POST" action="<?php echo $loginFormAction; ?>">
              <input name="username_login" type="text" class="font-input" id="username_login"  placeholder="ຊື່ຜູ້ນໍາໃຊ້"/>
                <input name="user_password" type="password" class="font-input" id="user_password" placeholder="ລະຫັດຜ່ານ"/>
                <input name="btnlogin" type="submit" class="font-btnlogin" id="btnlogin" value="ກົດທີ່ນີ້ເພື່ອເຂົ້າສູ່ລະບົບ" />
                </form>
            </div>
        </div>
<p align="center">__________________________________________________________________________________________________</p>
<p align="center" class="font-footer">Copyright © 2017 PB (<a href="http://mod.gov.la/">MOD.GOV.LA</a>). ກະຊວງ ປ້ອງກັນປະເທດ Powered By :<a href="https://web.facebook.com/khouvieng.KHAMCHANVONG" target="_blank"> ຄູວຽງ ຄໍາຈັນວົງ </a><br />
  ຄຸ້ມຄອງໂດຍ: ກົມວິທະຍາສາດ-ປະຫວັດສາດ ການທະຫານ ກະຊວງປ້ອງກັນປະເທດ<br />
  ບ.ໂພນເຄັງ, ຖະໜົນ ໄກສອນ ພົມວິຫານ<br />
ໂທຣ&amp;ແຟກ : (856-21) 911012</p>
</body>
</html>