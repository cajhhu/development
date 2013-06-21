<!DOCTYPE html>
<html>
<head>
<title>Pearly Pics</title>

<link href="styles.css" rel="stylesheet" type="text/css"></link>
<link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</head>
<body>
<div class="header"><div class="header-text"><font color="#FF9C00">B</font>usiness <font color="#FF9C00">M</font>anagement <font color="#FF9C00">S</font>ystem</div></div>
<div class="navbar">
<ul class="navigation">
{loop:navigation}
<li><a href="index.php?page={module}">{title}</a>
{/loop:navigation}
</ul>
</div>
<br>
<div class="wrapper">
