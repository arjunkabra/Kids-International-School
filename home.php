<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kid's International Home</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/slidemenu.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/slidedeck.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/fancybox.css" media="screen" />
<link rel="shortcut icon" href="images/favicon.png">
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="scripts/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="scripts/slidedeck.jquery.lite.pack.js"></script>
<script type="text/javascript" src="scripts/jqueryslidemenu.js"></script>
<script>
		!window.jQuery && document.write('<script src="scripts/jquery.min.js"><\/script>');
</script>
<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=StickyImage_popup]").fancybox({
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'overlayColor'		: '#000000',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
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
<style type="text/css">
            #slidedeck_frame {
                width: 1000px;
                height: 500px;
            }        
</style>
</head>

<body class="bodyBG">

<?php include('shared-resorces/header.php'); ?>

<div class="slideckHolder">
<div id="slidedeck_frame" class="skin-slidedeck">
			<dl class="slidedeck">
				<dt>OUR CAMPUS</dt>
				<dd><img src="images/campus.jpg" id="sliderImg" title="Our Campus" /></dd>
				<dt>STUDENTS</dt>
				<dd><img src="images/students.jpg" id="sliderImg" title="Students" /></dd>
				<dt>Multi-Media Education</dt>
				<dd><img src="images/multimedia-education.jpg" id="sliderImg" title="Multi-Media Education" /></dd>
				<dt>Computer Learing</dt>
				<dd><img src="images/computer-learning.jpg" id="sliderImg" title="Computer Learing" /></dd>
				<dt>Library</dt>
				<dd><img src="images/library.jpg" id="sliderImg" title="Library" /></dd>
			</dl>
</div>
<script type="text/javascript">
$('.slidedeck').slidedeck({ autoPlay: true, cycle: true, autoPlayInterval: 10000 });
</script>
</div>

<div class="slideDeckBelow">
<div class="slideDeckBelowLeft">
<h2 id="slideDeckBelowLeftHeader" class="slideDeckBelowLeftHeaderColor">Welcome</h2>
<p id="slideDeckBelowLeftP">Welcome to Kids international school, a co-educational school that seeks to provide education of the highest academic standards. The School is promoted by VIDYALAYA Group of Institutions.<br />&nbsp;<br />Our website contains a wealth of information about our unique program and approach. The best way to get to know Kids International though is to come see it in action. I invite you to tour our innovative, dynamic school. I'm sure you'll come away with a strong sense of our welcoming community, passionate faculty, and engaging learning environment. </p>
<a href="aboutschool" id="slideDeckBelowLeftBtn">Read More</a>
</div>
<div class="slideDeckBelowRight">
<div id="dottedLine" class="dottedLine1">&nbsp;</div>
<div id="dottedLine" class="dottedLine2">&nbsp;</div>
<h2 id="slideDeckBelowLeftHeader" class="slideDeckBelowRightHeaderColor">Working Hours</h2>
<div class="slideDeckBelowRightContent" id="slideDeckBelowRightContentImg1">
<h6 id="slideDeckBelowRightContentHeader">6 DAYS A WEEK</h6>
<h6 id="slideDeckBelowRightContentP">9:30 am - 3:45 pm</h6>
</div>
<div class="slideDeckBelowRightContent" id="slideDeckBelowRightContentImg2">
<h6 id="slideDeckBelowRightContentHeader">CONTACT PHONE</h6>
<h6 id="slideDeckBelowRightContentP">9964008008</h6>
</div>
<div class="slideDeckBelowRightContent2" id="slideDeckBelowRightContentImg3">
<h6 id="slideDeckBelowRightContentHeader">Address</h6>
<h6 id="slideDeckBelowRightContentP">kids International School,<br />Bellavi, Tumkur - 572153,<br />Karnataka</h6>
</div>
</div>
</div>

<div class="stickyPosts">&nbsp;
<div class="stickyposts_wrapper">
<div class="stickyPostsMain">
<h2 class="stickyPostHeader">We are Unique</h2>
<a rel="StickyImage_popup" href="images/unique.jpg" title="We are Unique"><img src="images/stickyPostUnique.jpg" border="0" title="We are Unique" /></a>
<p class="stickyPostP">Kids international school is the perfect place which provides a homely environment for your child to grow in, We intend to take care of your child a hassle free and enjoyable experience for you.</p>
<a href="weareunique" id="stickyPostBtn">Read More</a>
</div>
<div class="stickyPostsMain" id="stickyPostsMainMargin">
<h2 class="stickyPostHeader">Learning Center</h2>
<a rel="StickyImage_popup" href="images/learningCenter.jpg" title="Learning Center"><img src="images/StickypostLearningCenter.jpg" border="0" title="Learning Center" /></a>
<p class="stickyPostP">Teacher to Student Ratio 1:20 to develop individualised learning, 25 students per class to retain small class size for personal attention, Focus on self awareness and self esteem as the basis for learning.</p>
<a href="learningcenter" id="stickyPostBtn">Read More</a>
</div>
<div class="stickyPostsMain" id="stickyPostsMainMargin">
<h2 class="stickyPostHeader">Components</h2>
<a rel="StickyImage_popup" href="images/art.jpg" title="Components"><img src="images/stickyPostComponents.jpg" border="0" title="Components" /></a>
<p class="stickyPostP">Kids International School provides stress free environment, We provide a natural social environment where children spend an everyday life with our teachers.</p>
<a href="components" id="stickyPostBtn">Read More</a>
</div>
</div>
</div>

<?php include('shared-resorces/footer.php'); ?>

</body>
</html>