<?php
//print an HTML header
function doHtmlHeader($title){
    
?>
<html>
<head>
    <title><?php echo $title;?></title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif; font-size:13px}
        li,td{font-family:Arial,Helvetica,sans-serif; font-size:13px}
        hr{color:#3333cc; width=300px; text-align:left}
        a{color:#000000}
    </style>
</head>
<body>
    <img alt="PHPbookmark logo" src="bookmark.gif" border="0"
        align="left"  height="55" width="57" />
    <h1>PHPbookmark</h1>
    <hr />
<?php 
if ($title){
    doHtmlHeading($title);
}
}

function doHtmlFooter(){
    
?>
</body>
</html>
<?php 
}
function doHtmlHeading($heading){
?>
<h2><?php echo $heading?></h2>
<?php 
}
function displaySiteInfo(){ 
?>
<ul>
<li>Store your bookmarks online with us!</li>
<li>See what other users use!</li>
<li>Share your favorite links with others!</li>
</ul>
<?php 
}
//print a login form
function displayLoginForm(){
    
?>
<a href="register_form.php">Not a member?</a>
<form method="post" action="member.php">
<table>
<tr><td>Members log in here</td></tr>
<tr>
    <td>Username:</td>
    <td><input type="text" name="username"/></td>
</tr>
<tr><td>Password:</td> 
    <td><input type="password" name="password"></td>
</tr>
<tr><td><input type="submit" value="Log in"></td></tr>
<tr><td><a href="forgot_form.php">Forgot your passowrd?</a></td></tr>
</table>
</form>

<?php 
}
function displayRegistrationForm(){
?>
<form action="register_new.php" method="post">
<table>
<tr>
    <td>Email address</td>
    <td><input type="email" name="email"/></td>
</tr>
<tr>
    <td>Preferred username<br/>(max 16 chars)</td>
    <td><input type="text" name="username"/></td>
</tr>
<tr>
    <td>Password<br/>(between 6 and 16 chars)</td>
    <td><input type="password" name="password"/></td>
</tr>
<tr>
    <td>Confirm password</td>
    <td><input type="password" name="password2"/></td>
</tr>
<tr>
    <td><input type="submit" value="Register"/></td>
</tr>
</table>
</form>
<?php 
}
function displayUserUrls($array){
    //全局变量用于测试删除的标签是否位于当前页
    global $bmTable;
    $bmTable = true;
?>
<form name="bmTable" action="delete_bm.php" method="post">
<table>
<?php 
$color = "#cccccc";
echo "<tr bgcolor=\"".$color."\"><td><strong>Bookmark</strong></td>";
echo "<td><strong>Delete?</strong></td></tr>";
if (is_array($array) && count($array)>0) {
    foreach ($array as $url) {
        if ($color == "#cccccc") {
            $color = "#ffffff";
        }else {
            $color = "#cccccc";
        }
        echo "<tr bgcolor=\"".$color."\"><td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td>
            <td><input type=\"checkbox\" name=\"delMe[]\" value=\"".$url."\"/></td></tr>";
            
    };
}
else {
    echo "<tr><td>No bookmarks on record!</td></tr>";
}
?>
</table>
</form>
<?php 
}
//显示转向其他页面的链接
function doHtmlUrl($url,$name) {
?>
<br/><a href="<?php echo $url;?>"><?php echo $name;?></a><br/>
<?php 
}
function displayPasswdForm(){
?>
<form action='change_passwd.php' method='post'>
<table>
<tr>
    <td>Old password</td>
    <td><input type="password" name="oldPasswd"></td>
</tr>
<tr>
    <td>New password</td>
    <td><input type="password" name="newPasswd"></td>
</tr>
<tr>
    <td>Repeat new password</td>
    <td><input type="password" name="newPasswd2"></td>
</tr>
<tr>
    <td><input type="submit" value="Change password"></td>
</tr>
</table>
</form>
<?php 
}
function displayForgotForm(){
?>
<form action="forgot_password.php" method="post">
<table>
<tr><td>Enter your username</td></tr>
<tr><td><input type="text" name="username"></td></tr>
<tr><td><input type="submit" value="Reset password"></td></tr>
</table>
</form>
<?php 
}
function displayUserMenu(){
?>
<a href="member.php">Home</a>|
<a href="add_bm_form.php">Add BM</a>|
<?php 
global $bmTable;
// bookmark在当前页才可以删除
if ($bmTable == true) {
    //将delete bm链接的单击事件绑定到bmTable表的submit()提交事件
    echo "<a href=\"#\" onclick=\"bmTable.submit();\">Delete BM</a>|";
}
else {
    echo "<span style=\"color:#cccccc\">Delete BM</span>|";
}
?>
<a href="change_passwd_form.php">Change password</a>|
<a href="recommend.php">Recommend URLs to me</a>|
<a href="logout.php">Logout</a>
<?php 
}
function displayAddBMForm(){
?>
<form action="add_bm.php" method="post">
New BM:<input type="url" name="newURL" value="http://"><br/><br/>
<input type="submit" value="Add bookmark">
</form>
<?php 
}
//扩展:将推荐的书签添加到自己的书签列表
function displayRecommendURLs($urls) {
?>
<form action="add_recommend.php" method="post">
<table>
<?php 
$color = "#cccccc";
echo "<tr bgcolor=\"".$color."\"><td><strong>Recommendations</strong></td></tr>";
if (is_array($urls) && count($urls)>0) {
    foreach ($urls as $url) {
        if ($color == "#cccccc") {
            $color = "#ffffff";
        }else {
            $color = "#cccccc";
        }
        echo "<tr bgcolor=\"".$color."\"><td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td>; 
             <td><input type=\"checkbox\" name=\"recommend[]\" value=\"".$url."\"/></td></tr>";
            
    };
    echo "<br/><br/>";
    echo "<tr><td><input type=\"submit\" value=\"add recommend\"";
}else {
    echo "<tr><td>No recommendations for you today.</td></tr><br/>";
};

?>
</table>
</form>
<?php
}
?>


