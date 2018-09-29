<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Pharmacia a Medical Based Website</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link href="{{asset('assets/mainWebsite/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="all">
<link href="{{asset('assets/mainWebsite/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="{{asset('assets/mainWebsite/css/owl.carousel.css')}}" type="text/css" media="all">
<link href="{{asset('assets/mainWebsite/css/owl.theme.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/mainWebsite/css/jquery-ui.css')}}" type="text/css" media="all" />
<link type="text/css" rel="stylesheet" href="{{asset('assets/mainWebsite/css/cm-overlay.css')}}" />
<link href="{{asset('assets/mainWebsite/css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Abel" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
<!-- Header -->
@include('inc.main.header')
<!-- /Header-->

{{-- Main Content --}}
@yield('content')

<script src="{{asset('assets/mainWebsite/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/mainWebsite/js/bootstrap.min.js')}}"></script>
<script  src="{{asset('assets/mainWebsite/js/move-top.js')}}"></script>
<script  src="{{asset('assets/mainWebsite/js/easing.js')}}"></script>
<script  src="{{asset('assets/mainWebsite/js/SmoothScroll.min.js')}}"></script>	
	<!-- for testimonials slider-js-file-->
			<script src="{{asset('assets/mainWebsite/js/owl.carousel.js')}}"></script>
	<!-- //for testimonials slider-js-file-->
		<script>
		$(document).ready(function() { 
		$("#owl-demo").owlCarousel({
 
			autoPlay: 3000, //Set AutoPlay to 3 seconds
			autoPlay:true,
			items : 3,
			itemsDesktop : [640,5],
			itemsDesktopSmall : [414,4]
		});
		}); 
</script>
<!-- for testimonials slider-js-script-->

 <!--script-->
<script src="{{asset('assets/mainWebsite/js/easyResponsiveTabs.js')}}" type="text/javascript"></script>
		    <script type="text/javascript">
			    $(document).ready(function () {
			        $('#horizontalTab').easyResponsiveTabs({
			            type: 'default', //Types: default, vertical, accordion           
			            width: 'auto', //auto or any width like 600px
			            fit: true   // 100% fit in a container
			        });
			    });
				
</script>
<!--script-->
<!-- Calendar -->
<script src="{{asset('assets/mainWebsite/js/jquery-ui.js')}}"></script>
	<script>
		$(function() {
		$( "#datepicker,#datepicker1" ).datepicker();
		});
	</script>
<!-- //Calendar -->
<!-- /gallery -->
    <script src="{{asset('assets/mainWebsite/js/jquery.tools.min.js')}}"></script>
    <script src="{{asset('assets/mainWebsite/js/jquery.mobile.custom.min.js')}}"></script>
    <script src="{{asset('assets/mainWebsite/js/jquery.cm-overlay.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.cm-overlay').cmOverlay();
        });
    </script>
    <!-- //gallery -->
<!-- start-smoth-scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- scrolling script -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script> 
<!-- //scrolling script -->
<!--//start-smoth-scrolling -->

</body>
</html>