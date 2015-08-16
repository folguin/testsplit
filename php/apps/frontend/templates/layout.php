<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
  </head>
	<body class="homepage">
		<div id="page-wrapper">
			<!-- Header -->
				<div id="header-wrapper">
					<div id="header" class="container">
						<!-- Logo -->
							<h1 id="logo"><a href="#">divide.me</a></h1>
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a class="icon fa-home" href="<?=url_for("index/");?>"><span>Home</span></a></li>
								</ul>
							</nav>
					</div>
				</div>
    <?php echo $sf_content ?>
  </body>
</html>
