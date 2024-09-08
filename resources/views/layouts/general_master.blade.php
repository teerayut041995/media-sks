	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="{{asset('template/frontend/img/fav.png')}}">
		<!-- Author Meta -->
		<meta name="author" content="teerayut khunsuk">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		@yield('frontend_seo')
		<meta name="robots" content="noindex,follow"/>

		<title>@yield('frontend_title')</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Kanit|Mitr|Prompt" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

		<!--
        CSS
        ============================================= -->
			<link rel="stylesheet" href="{{asset('template/frontend/css/linearicons.css')}}">
			<link rel="stylesheet" href="{{asset('template/frontend/css/font-awesome.min.css')}}">
			<link rel="stylesheet" href="{{asset('template/frontend/css/bootstrap.css')}}">
			<link rel="stylesheet" href="{{asset('template/frontend/css/magnific-popup.css')}}">
			<link rel="stylesheet" href="{{asset('template/frontend/css/nice-select.css')}}">							
			<link rel="stylesheet" href="{{asset('template/frontend/css/animate.min.css')}}">
			<link rel="stylesheet" href="{{asset('template/frontend/css/owl.carousel.css')}}">			
			<link rel="stylesheet" href="{{asset('template/frontend/css/jquery-ui.css')}}">			
			<link rel="stylesheet" href="{{asset('template/frontend/css/main.css')}}">


			<style type="text/css">
				.my-font {
					font-family: 'Mitr', sans-serif;
				}
				.cut-title {
				 font-size:1em;
				 line-height:1em;
				 height:2em;
				 white-space: nowrap;
				 overflow: hidden;
				 text-overflow: ellipsis;
				}
			</style>
			@yield('frontend_style')
		</head>
		<body>	
		  <header id="header" id="home">
	  		<div class="header-top">
	  			<div class="container">
			  		<div class="row">
			  			<div class="col-lg-6 col-sm-6 col-8 header-top-left no-padding">
			  				<ul>
								<li><a href="javascript:void(0)">การพัฒนาสื่ออนไลน์ ของศูนย์การศึกษาพิเศษประจำจังหวัดกาฬสินธุ์</a></li>
			  				</ul>			
			  			</div>
			  			<div class="col-lg-6 col-sm-6 col-4 header-top-right no-padding">
			  				<a href="tel:+953 012 3654 896"><span class="lnr lnr-phone-handset"></span> <span class="text">043-891405</span></a>
			  				<a href="mailto:support@colorlib.com"><span class="lnr lnr-envelope"></span> <span class="text">monitoringsksgoth@gmail.com</span></a>			
			  			</div>
			  		</div>			  					
	  			</div>
			</div>
		    <div class="container main-menu">
		    	@include('template.frontend.main_menu')
		    </div>
		  </header><!-- #header -->

		  	@yield('frontend_content')
						
			<!-- start footer Area -->		
			<footer class="footer-area section-gap">
			@include('template.frontend.footer')
			</footer>	
			<!-- End footer Area -->	


			<script src="{{asset('template/frontend/js/vendor/jquery-2.2.4.min.js')}}"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="{{asset('template/frontend/js/vendor/bootstrap.min.js')}}"></script>			
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="{{asset('template/frontend/js/easing.min.js')}}"></script>			
			<script src="{{asset('template/frontend/js/hoverIntent.js')}}"></script>
			<script src="{{asset('template/frontend/js/superfish.min.js')}}"></script>	
			<script src="{{asset('template/frontend/js/jquery.ajaxchimp.min.js')}}"></script>
			<script src="{{asset('template/frontend/js/jquery.magnific-popup.min.js')}}"></script>	
    		<script src="{{asset('template/frontend/js/jquery.tabs.min.js')}}"></script>						
			<script src="{{asset('template/frontend/js/jquery.nice-select.min.js')}}"></script>	
			<script src="{{asset('template/frontend/js/owl.carousel.min.js')}}"></script>								
			<script src="{{asset('template/frontend/js/mail-script.js')}}"></script>
			<script src="{{asset('template/frontend/js/main.js')}}"></script>
			<script src="{{asset('template/frontend/js/dotdotdot.js')}}"></script>
			<!-- <script type="text/javascript">
				$(document).ready(function(){
					$(".cut-title").dotdotdot({
						height: 90,
						fallbackToLetter: true,
						watch: true,
					});
				});
			</script> -->
			@yield('frontend_script')
		</body>
	</html>