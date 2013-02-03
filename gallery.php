<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gallery</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/slidemenu.css" rel="stylesheet" type="text/css" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/favicon.png">
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jqueryslidemenu.js"></script>
<script type="text/javascript" src="scripts/jquery.colorbox.js"></script>
<script>
		$(document).ready(function(){
			$(".gallery").colorbox({rel:'group2', transition:"fade"});
			$("#click").click(function(){ 
		    $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});
		});
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27771112-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body class="bodyBG">

<?php include('shared-resorces/header.php'); ?>

<div class="innerPage_teaser">
<div class="teaserContent">&nbsp;
<h2 class="pageName">Gallery</h2>
<h6 class="breadCrumb">You are Here : <a class="breadCrumbLink" href="home">Home</a> >> Gallery</h6>
&nbsp;</div>
</div>

<div class="contentIndex" id="contentindexHeightGALL">
<div class="contentIndexleft">

<div class="galleryHolder">

<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-01.jpg" title="Campus">
<img class="thumbnailImage" src="images/thumb-01.jpg" title="Campus" />
<h6>Campus</h6>
</a>
</div>

<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-02.jpg" title="Prayer">
<img class="thumbnailImage" src="images/thumb-02.jpg" title="Prayer" />
<h6>Prayer</h6>
</a>
</div>

<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-03.jpg" title="Unique Bonding">
<img class="thumbnailImage" src="images/thumb-03.jpg" title="Unique Bonding" />
<h6>Unique Bonding</h6>
</a>
</div>

</div>

<div class="galleryHolder">

<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-04.jpg" title="Brilliant Kids">
<img class="thumbnailImage" src="images/thumb-04.jpg" title="Brilliant Kids" />
<h6>Brilliant Kids</h6>
</a>
</div>

<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-05.jpg" title="Energetic Students">
<img class="thumbnailImage" src="images/thumb-05.jpg" title="Energetic Students" />
<h6>Energetic Students</h6>
</a>
</div>

<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-06.jpg" title="Interactive Class">
<img class="thumbnailImage" src="images/thumb-06.jpg" title="Interactive Class" />
<h6>Interactive Class</h6>
</a>
</div>

</div>

<div class="galleryHolder">

<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-07.jpg" title="Personalized Coaching">
<img class="thumbnailImage" src="images/thumb-07.jpg" title="Personalized Coaching" />
<h6>Personalized Coaching</h6>
</a>
</div>

<!--<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-08.jpg" title="Caring Staff">
<img class="thumbnailImage" src="images/thumb-08.jpg" title="Caring Staff" />
<h6>Caring Staff</h6>
</a>
</div>-->

<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-09.jpg" title="Creative Students">
<img class="thumbnailImage" src="images/thumb-09.jpg" title="Creative Students" />
<h6>Creative Students</h6>
</a>
</div>

</div>

<div class="galleryHolder">

<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-10.jpg" title="Library">
<img class="thumbnailImage" src="images/thumb-10.jpg" title="Library" />
<h6>Library</h6>
</a>
</div>

<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-11.jpg" title="Computer Lab">
<img class="thumbnailImage" src="images/thumb-11.jpg" title="Computer Lab" />
<h6>Computer Lab</h6>
</a>
</div>

<div class="galleryThumbnail">
<a style="text-decoration:none; color:#192021;" class="gallery" href="images/gallery-12.jpg" title="Extra Activities">
<img class="thumbnailImage" src="images/thumb-12.jpg" title="Extra Activities" />
<h6>Extra Activities</h6>
</a>
</div>

</div>

</div>
<div class="contentindexRight">
<?php include('shared-resorces/sidebar.php'); ?>
</div>
</div>

<?php include('shared-resorces/footer.php'); ?>

</body>
</html>