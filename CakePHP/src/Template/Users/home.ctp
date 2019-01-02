<?php
$user = "";
//$loguser = $this->Session->read('Auth.User');
$loguser = $this->request->session()->read('Auth.User');
if(!empty($loguser)){
    $user = $loguser['username'];
}
?>
<h1 style="font-weight: bold;">Home Page </h1>
<p class="login-user"> Hello <?php echo $user ;?> </p>
<h4 style="font-weight: bold;">Welcome to Home Page.</h4>

<?php if(!empty($loguser)){ ?><span class="user-logout"><a href="logout">Logout </a></span> <?php }?>
