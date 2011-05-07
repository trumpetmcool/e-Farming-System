<?php
$this->load->view('header');
?>
<?php if (isset($message)) echo $message; ?>
<h1>Login</h1>
<form method="POST" action="<?=site_url('users/login');?>/">
<label for="username">Username:</label>
<input type="text" name="username" id="username" value="" />
<?php echo form_error('username'); ?>
<br/>

<label for="password">Password:</label>
<input type="password" name="password" id="password" value="" />
<?php echo form_error('password'); ?>
<br/>

<label for="remember">Remember me?</label>
<input type="checkbox" name="remember" id="remember" />
<br />

<input type="submit" class="submit" name="submit" value="Login"/>
</form>

<?php
$this->load->view('footer');
?>