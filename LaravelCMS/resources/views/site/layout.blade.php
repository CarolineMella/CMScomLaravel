<!DOCTYPE HTML>
<!--
	Spatial by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>MGCTec</title>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="@yield('description')" />
		<link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header" class="alt">
				<h1><strong><a href="index.html">MGC</a></strong>Tec</h1>
				<nav id="nav">
					<ul>
                        @foreach($front_menu as $menuslug => $menutitle)
                        <li><a href="{{$menuslug}}">{{$menutitle}}</a></li>
                        @endforeach
					</ul>
				</nav>
			</header>

			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Banner -->
			<section id="banner">
				<h2>{{$front_config['title']}}</h2>
				<p>{{$front_config['subtitle']}}</p>
				<ul class="actions">
					<li><a href="#" class="button special big">Get Started</a></li>
				</ul>
			</section>

			<div class="container">
				@yield('content')
			</div>






		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="#" class="icon fa-facebook"></a></li>
						<li><a href="#" class="icon fa-twitter"></a></li>
						<li><a href="#" class="icon fa-instagram"></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled</li>
						<li>Design: <a href="http://templated.co">TEMPLATED</a></li>
						<li>Images: <a href="http://unsplash.com">Unsplash</a></li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="{{asset('assetassets/js/jquery.min.js')}}"></script>
			<script src="{{asset('assetassets/js/skel.min.js')}}"></script>
			<script src="{{asset('assetassets/js/util.js')}}"></script>
			<script src="{{asset('assetassets/js/main.js')}}"></script>

	</body>
</html>