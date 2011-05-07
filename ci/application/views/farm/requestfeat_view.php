<?php
$this->load->view('header');
?>
<!--<h1>Request a Feature</h1>-->
<form method="post" action="<?=site_url('users/requestfeature');?>/">
<label for="subject">Subject:</label>
<input type="text" name="subject" id="subject" size="41" value="<?php if (isset($subject)) echo $subject;?>"/>
<?php echo form_error('subject'); ?>
<br/><br />

<label for="request">Request:</label>
<textarea rows="20" cols="30" name="request"><?php if (isset($request)) echo $request; ?></textarea>
<?php echo form_error('request'); ?>
<br />

<input type="submit" class="submit" name="submit" value="Request Feature"/>
</form>

<?php
$this->load->view('footer');
?>