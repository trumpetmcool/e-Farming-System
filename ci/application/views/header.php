<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/green_bold.css"/> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/dark.css"/>
<style type="text/css">
code {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

/* start neat forms */
label
{
	width: 10em;
	float: left;
	text-align: right;
	margin-right: 0.5em;
	display: block;
}

.submit
{
	margin-left: 14em;
}
/* end neat forms */
</style>
<script src="<?php echo base_url(); ?>js/jsapi"></script>
<script type="text/javascript">google.load("jquery", "1");</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.5.2.js"></script>
<script type="text/javascript">
google.load("maps", "3", {other_params:"sensor=false"});
</script>
<title><?=$title?></title>
</head>

<body>

<div id="nav">
        <ul>
                <!--<li><a href="index.html">HOME</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="#">BLOG</a></li>
                <li><a href="#">CONTACT</a></li>-->
                <?php $this->load->view('menu'); ?>
        </ul>
</div>

<div id="head">
<h1>e-Farming System</h1>
<h2><?=$title?></h2>
</div>

<div class="main">
<div id="right">
<!--<h3>WHITE BACKGROUND</h3>
<ul>
        <li><a class="green" href="light_green_muted.html">Muted Green Accent</a></li>
        <li><a class="orange" href="light_orange_muted.html">Muted Orange Accent</a></li>
        <li><a class="blue" href="light_blue_muted.html">Muted Blue Accent</a></li>
        <li><a class="green" href="light_green_bold.html">Bold Green Accent</a></li>
        <li><a class="orange" href="light_orange_bold.html">Bold Orange Accent</a></li>
        <li><a class="blue" href="light_blue_bold.html">Bold Blue Accent</a></li>
</ul>
<h3>DARK BACKGROUND</h3>
<ul>
        <li><a class="green" href="dark_green_muted.html">Muted Green Accent</a></li>
        <li><a class="orange" href="dark_orange_muted.html">Muted Orange Accent</a></li>
        <li><a class="blue" href="dark_blue_muted.html">Muted Blue Accent</a></li>
        <li><a class="green" href="dark_green_bold.html">Bold Green Accent</a></li>
        <li><a class="orange" href="dark_orange_bold.html">Bold Orange Accent</a></li>
        <li><a class="blue" href="dark_blue_bold.html">Bold Blue Accent</a></li>
</ul>-->
</div>

<div id="content">
<!--<h1>A NEW TEMPLATE</h1>
<h2>FROM DEMUSDESIGN</h2>

<p><a href="#"><img class="content" src="stones.jpg" alt="" /></a>Choice is a fully fluid, two or three column template. It also has twelve different possible color combinations. You can have a light or dark background, and then six different accent colors to choose from. Check 'em out:</p>
        <a href="light_green_bold.html"><img class="color" src="light.gif" alt="Light Background" /></a>
        <a href="#"><img class="color" src="dark.gif" alt="Light Background" /></a><b>BACKGROUND COLOR</b><br /><br />
        
        <a href="dark_green_muted.html"><img class="color" src="green_muted.gif" alt="Muted Green" /></a>
        <a href="dark_orange_muted.html"><img class="color" src="orange_muted.gif" alt="Muted Orange" /></a>
        <a href="dark_blue_muted.html"><img class="color" src="blue_muted.gif" alt="Muted Blue" /></a>
        <a href="dark_green_bold.html"><img class="color" src="green_bold.gif" alt="Bold Green" /></a>
        <a href="dark_orange_bold.html"><img class="color" src="orange_bold.gif" alt="Bold Orange" /></a>
        <a href="dark_blue_bold.html"><img class="color" src="blue_bold.gif" alt="Bold Blue" /></a><b>ACCENT COLORS</b><br /><br />

<p>I thought the muted colors went best with the light background and the bold with the dark, but I decided to just let you pick and choose. I've included an html file for every permutation, but you'll see the style structure is pretty simple. The background and accent colors are called by two different stylesheets. The "mainstyle" directory has the stylesheets for light and dark. The "color" directory contains six smaller stylesheets for the six accent colors. Mix and match away!</p>

<p>I release it into public domain but ask that you keep a link back to <a href="http://demusdesign.com">my site</a> somewhere on your site. You can scroll down for styles including tags for tables, forms, blockquotes, and lists.</p>

<h1>ANOTHER ENTRY</h1>
<h2>AUG 29 2007</h2>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis laoreet velit eget sapien. Praesent ac lacus. Phasellus odio diam, ultrices non, scelerisque quis, scelerisque sit amet, ante. Duis ac metus vitae mauris tempus varius. Aliquam leo ipsum, posuere ut, tincidunt dictum, venenatis in, elit. Aliquam luctus erat sit amet lacus. Morbi nisl nibh, consequat quis, euismod quis, mattis ut, sem. Praesent sagittis, erat sed imperdiet interdum, tortor ante blandit augue, quis viverra justo mauris congue leo. Mauris vestibulum, tortor non consectetuer feugiat, ipsum neque molestie mi, et tristique odio erat sed elit. Nam mattis risus in purus. Donec mollis pretium urna. Mauris et libero.</p>
<h2>AUG 29 2007</h2>
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis laoreet velit eget sapien. Praesent ac lacus. Phasellus odio diam, ultrices non, scelerisque quis, scelerisque sit amet, ante. Duis ac metus vitae mauris tempus varius. Aliquam leo ipsum, posuere ut, tincidunt dictum, venenatis in, elit. Aliquam luctus erat sit amet lacus. Morbi nisl nibh, consequat quis, euismod quis, mattis ut, sem. Praesent sagittis, erat sed imperdiet interdum, tortor ante blandit augue, quis viverra justo mauris congue leo. Mauris vestibulum, tortor non consectetuer feugiat, ipsum neque molestie mi, et tristique odio erat sed elit. Nam mattis risus in purus. Donec mollis pretium urna. Mauris et libero.</p>
<p><a href="#">Comments (3)</a> | Posted by <a href="http://demusdesign.com/">Demus</a> | <a href="#">Permalink</a></p>-->
</div>
</div>

<div class="main">
<!--<div class="right2">
<h3>ARE ALSO HANDY</h3>
<ul>
        <li><a href="#">CSS Check</a></li>
        <li><a href="#">XHTML 1.0 Strict</a></li>
</ul>
<h3>BLOGROLL</h3>
<ul class="null">
        <li><a href="#">Lorem Ipsum</a></li>
        <li><a href="#">Dolor Sit</a></li>
        <li><a href="#">Amet</a></li>
        <li><a href="#">Consectetuer</a></li>
        <li><a href="#">Adipiscing Elit</a></li>
        <li><a href="#">Quisque Id</a></li>
        <li><a href="#">Massa Sed</a></li>
</ul>
</div>
<div class="right2">
<h3>THREE COLUMNS</h3>
<ul>
        <li><a href="#">DemusDesign</a></li>
        <li><a href="#">OpenDesigns</a></li>
</ul>
<h3>ARCHIVES</h3>
<ul>
        <li><a href="#">August 2007</a></li>
        <li><a href="#">July 2007</a></li>
        <li><a href="#">June 2007</a></li>
        <li><a href="#">May 2007</a></li>
        <li><a href="#">April 2007</a></li>
        <li><a href="#">March 2007</a></li>
        <li><a href="#">February 2007</a></li>
        <li><a href="#">January 2007</a></li>
</ul>
</div>-->
