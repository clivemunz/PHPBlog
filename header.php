<!DOCTYPE html>
<html>
<head>
    <title>Clive's Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">
	<link rel="shortcut icon" href="/favicon.ico">
    <script src="/js/jquery-1.11.1.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/parallax.js"></script>
    <script src="/galleria/galleria-1.3.5.js"></script>
    <script src="/galleria/plugins/picasa/galleria.picasa.js"></script>

</head>
<body id="bod">
<?php include_once("analyticstracking.php") ?>
<input style="display: none" id="page" value="<?php echo $page ?>">
<div class = "navbar navbar-inverse navbar-fixed-top">
    <div class = "container">
        <a href = "/Home" class="navbar-brand">Clive's Blog</a>

        <button class="navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class = "collapse navbar-collapse navHeaderCollapse">
            <ul class = "nav navbar-nav navbar-right">
                <li class="<?php echo($page == "home" ? "active" : "")?>"><a href="/Home">Home</a> </li>
                <li class="<?php echo($page == "tech" ? "active" : "")?>"><a href="/Tech">Tech</a> </li>
                <li class="<?php echo($page == "sports" ? "active" : "")?>"><a href="/Sports">Sports</a> </li>
                <li class="<?php echo($page == "about" ? "active" : "")?>"><a href="/About">About</a> </li>
            </ul>

        </div>
    </div>
</div>


