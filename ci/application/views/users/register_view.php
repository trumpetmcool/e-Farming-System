<?php
$this->load->view('header');
?>
<h1>Signup</h1>
<form method="post" action="<?=site_url('users/register');?>/">
<label for="first_name">First Name:</label>
<input type="text" name="first_name" id="first_name" value="<?php if (isset($first_name)) echo $first_name;?>"/>
<?php echo form_error('first_name'); ?>
<br/>

<label for="last_name">Last Name:</label>
<input type="text" name="last_name" id="last_name" value="<?php if (isset($last_name)) echo $last_name;?>"/>
<?php echo form_error('last_name'); ?>
<br/>

<label for="username">Username:</label>
<input type="text" name="username" id="username" value="<?php if (isset($username)) echo $username;?>"/>
<?php echo form_error('username'); ?>
<br/>

<label for="email">Email:</label>
<input type="text" name="email" id="email" value="<?php if (isset($email)) echo $email;?>"/>
<?php echo form_error('email'); ?>
<br/>

<label for="password">Password:</label>
<input type="password" name="password" id="password"/>
<?php echo form_error('password'); ?>
<br/>

<label for="confirm_password">Confirm Password:</label>
<input type="password" name="confirm_password" id="confirm_password"/>
<?php echo form_error('confirm_password'); ?>
<br/>

<input type="submit" class="submit" name="submit" value="Register"/>
</form>

<?php
$this->load->view('footer');
?>