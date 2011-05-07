<?php
$this->load->view('header');
$this->load->model('users_model');
$data['username'] = $this->session->userdata('username');
$info = $this->users_model->getUser($data);
?>
<h1>Edit Profile</h1>
<form method="post" action="<?=site_url('users/updateprofile');?>/">
<label for="first_name">First Name:</label>
<input type="text" name="first_name" id="first_name" value="<?php if (isset($first_name)) echo $first_name; else echo $info['first_name'];?>"/>
<?php echo form_error('first_name'); ?>
<br/>

<label for="last_name">Last Name:</label>
<input type="text" name="last_name" id="last_name" value="<?php if (isset($last_name)) echo $last_name; else echo $info['last_name'];?>"/>
<?php echo form_error('last_name'); ?>
<br/>

<label for="username">Username:</label>
<input type="text" name="username" id="username" value="<?php if (isset($username)) echo $username; else echo $info['username'];?>"/>
<?php echo form_error('username'); ?>
<br/>

<label for="email">Email:</label>
<input type="text" name="email" id="email" value="<?php if (isset($email)) echo $email; else echo $info['email'];?>"/>
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

<input type="submit" class="submit" name="submit" value="Update Profile"/>
</form>

<?php
$this->load->view('footer');
?>