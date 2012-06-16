<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Alternative Golf Day Society</title>
		
		<!--====================================================================-->
		<!-- Styles needed for all pages                                        -->
		<!--====================================================================-->
		<link rel="stylesheet" type="text/css" href="styles/layout.css" />
		<link rel="stylesheet" type="text/css" href="styles/appearance.css" />
		<link rel="stylesheet" type="text/css" href="styles/menu.css" />
		<link rel="stylesheet" type="text/css" href="styles/rss.css" />
		
		<!--====================================================================-->
		<!-- Highslide may be needed on many pages so load the style regardless -->
		<!--====================================================================-->
		<link rel="stylesheet" type="text/css" href="styles/highslide.css" />
		<!--[if lt IE 7]>
			<link rel="stylesheet" type="text/css" href="styles/highslide-ie6.css" />
		<![endif]-->
		
		
		
		<!--=====================================================================-->
		<!-- IE 7 and below need a different style for the max / min width stuff -->
		<!--=====================================================================-->
		<!--[if lte IE 7]>
			<style type="text/css">
				/* for IE6 */
				* html #container {display:inline-block;}
				* html #widthcontrol {width: expression(document.body.clientWidth < 702? "700px" : document.body.clientWidth > 1282? "1280px" : "auto");}
			</style>
		<![endif]-->
		
		
		<!--====================================================================-->
		<!-- Get all the variables loaded etc                                   -->
		<!--====================================================================-->
		<?php
			$pagetypeset = false;
			$menutypeset = false;
			if(isset($_GET["pagetype"])) {
				$pagetype = htmlspecialchars($_GET["pagetype"]);
				$menutype = $pagetype;
				$pagetypeset = true;
				$menutypeset = true;
				if($pagetype == "results" || $pagetype == "planning") {
					$menutype = $pagetype;
					$pagetype = "events";
				}
				$complexpage = array('events','scores', 'photos','videos');
				$simplepage = array ('contact','history','winners','players','playerhistory');
				if(in_array($pagetype, $complexpage)) {$iscomplex = true; $issimple = false;}
				elseif(in_array($pagetype, $simplepage)) {$issimple = true; $iscomplex = false;}
			}

			$seasonset = false;
			if(isset($_GET["season"])) {
				$season = htmlspecialchars($_GET["season"]);
				$seasonset = true;
			}
			$yearset = false;
			if(isset($_GET["year"])) {
				$year = htmlspecialchars($_GET["year"]);
				$yearset = true;
			}
			$ampmset = false;
			if(isset($_GET["ampm"])) {
				$ampm = htmlspecialchars($_GET["ampm"]);
				$ampmset = true;
			}
		?>
		
		
		<!--====================================================================-->
		<!-- Styles for players and winners pages                                            -->
		<!--====================================================================-->
		<?php
			if($pagetypeset) {
				if($pagetype == "scores" || "winners") {
		?>
					<link rel="stylesheet" type="text/css" href="styles/peopletables.css" />
		<?php
				}
			}
		
		?>
		
		
		<!--====================================================================-->
		<!-- jQuery for Scores pages                                            -->
		<!--====================================================================-->
		<?php
			if($pagetypeset) {
				if($pagetype == "scores") {
		?>
				<link rel="stylesheet" type="text/css" href="styles/resultstable.css" />
				<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.16.custom.css" />
				<script type="text/javascript" src="javascripts/js/jquery-1.6.2.min.js"></script>
				<script type="text/javascript" src="javascripts/js/jquery-ui-1.8.16.custom.min.js"></script>
				<script type="text/javascript">
					$(function(){
			
						// Tabs
						$('#score_tabs').tabs();
						
						//hover states on the static widgets
						$('#dialog_link, ul#icons li').hover(
							function() { $(this).addClass('ui-state-hover'); }, 
							function() { $(this).removeClass('ui-state-hover'); }
						);
						
					});
				</script>
			<?php
					}
				}
			?>
		<!--=====================================================================-->
		<!-- Bring in the correct highslide library and settings, it's different -->
		<!-- (larger) if it's a gallery page                                     -->
		<!--=====================================================================-->
		<?php
			if($pagetypeset) {
				if($pagetype == "photos") {
					include('inc/hsgalleryjs.inc');
				} elseif($pagetype == "videos") {
					include('inc/hshtml.inc');
				} else	{				
					include('inc/hsnormjs.inc');
				}
			} else {
				include('inc/hsnormjs.inc');
			}
		?>
		
		<!--====================================================================-->
		<!-- Specific meta data for the site                                    -->
		<!--====================================================================-->
		<meta name="Author" content="Mike Conroy" />
		<meta name="Keywords" content="Mike Conroy, Golf, Infineum" />
		<meta name="Description" content="Website of the Infineum Alternative Golf Day Society" />

	</head>

	<body>
		<div id="widthcontrol">
			<div id="header">
				<h1>Alternative Golf Day Society</h1>
			</div> <!-- end header -->

			<div id="menublock">
				<?php
					include('inc/topmenu.inc');
				?>
			</div> <!-- end menublock -->

			<div id="container">
				<div id="left_sidebar">
					<div class="spacing">
						<?php
							if($pagetypeset && $iscomplex) {
								$filename = "inc/leftmenu_" . $pagetype . ".inc";
								include($filename);
							} else {
								include('inc/leftmenu_events.inc');
							}
							if($menutypeset && $menutype == "results") {
							?>
								<script type="text/javascript">
									var eventsection = document.getElementById('futureevents');
									eventsection.style.display = 'none';
								</script>
						<?php
							}
							include('inc/ffad.inc');
								
						?>
					</div> <!-- end spacing -->
				</div> <!-- end left_sidebar -->

				<div id="right_sidebar">
					<div class="spacing">
						<?php include('javascripts/rss2html/rss2html.php'); ?>
					</div> <!-- end spacing -->
				</div> <!-- end right_sidebar -->

				<div id="content">
					<?php
						if($pagetypeset == false) {
							include('inc/items/donnington_newsflash.inc');
							include('inc/items/newname.inc');
						}
					?>
					<div class="full_item">
						<div class="spacing">
							<?php
								if($pagetypeset) {
									if ($iscomplex) {
										if(!$seasonset) {$season = "autumn";}
										if(!$yearset) {$year = "2011";}
										$filename = "inc/items/" . $menutype . "/" . $season . "_" . $year;
										if($pagetype == "videos") {
											if(!$ampmset) {$ampm = "am";}
											$filename = $filename . "_" . $ampm;
										}
										$filename = $filename . ".inc";
										include($filename);
										if($pagetype == 'scores') {include('inc/items/scores/example_scores.inc');}
									}
									elseif ($issimple) {
										$filename = "inc/items/other/" . $pagetype . ".inc";
										include($filename);
									}
								} else {
									include('inc/items/results/autumn_2011.inc');
								}
							?>
						</div> <!-- end spacing -->
					</div> <!-- end full_item -->
				</div> <!-- end content -->
			</div><!-- end #container -->

			<div id="footer" class="spacing">
				<?php
					include('inc/footer.inc');
				?>
			</div> <!-- end footer -->

		</div> <!-- end widthcontrol -->
	</body>
</html>