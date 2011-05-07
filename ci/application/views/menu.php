<?php
echo "<p>";
if (!isset($logged) || !$logged)
{
	// not logged in
	echo "<li>".anchor(base_url(), 'Home', 'title="Home"')."</li>";
	//echo "<li>".anchor('/users/about', 'about', 'title="About"')."</li>";
	echo "<li>".anchor('/users/login', 'Login', 'title="Login"')."</li>";
	echo "<li>".anchor('/users/register', 'Register', 'title="Register"')."</li>";
}
else
{
	// registered and logged in
	echo "<li>".anchor(base_url(), 'Home', 'title="Home"')."</li>";
	//echo "<li>".anchor('/users/about', 'about', 'title="About"')."</li>";
	echo "<li>".anchor('/users/updateprofile', 'Update Account Settings', 'title="Update Account"')."</li>";
	echo "<li>".anchor('/users/viewfarm', 'View Map', 'title="View Map"')."</li>";
	echo "<li>".anchor('/users/requestfeature', 'Request Feature', 'title="Request Farm"')."</li>";
	//echo "<li>".anchor('/users/deletefarm', 'Delete Farm', 'title="Delete Farm"')."</li>";
	echo "<li>".anchor('/users/logout', 'Logout', 'title="Logout"')."</li>";
}
echo "</p>";
?>