
        <script src="/scripts/snippet-javascript-console.min.js?v=2"></script>
		<style type="text/css">.as-console-wrapper { position: fixed; bottom: 0; left: 0; right: 0; max-height: 150px; overflow-y: scroll; overflow-x: hidden; border-top: 1px solid #000; display: none; }
.as-console { background: #e9e9e9; border: 1px solid #ccc; display: table; width: 100%; border-collapse: collapse; }
.as-console-row { display: table-row; font-family: monospace; font-size: 13px; }
.as-console-row:after { display: table-cell; padding: 3px 6px; color: rgba(0,0,0,.35); border: 1px solid #ccc; content: attr(data-date); vertical-align: top; }
.as-console-row + .as-console-row > * { border: 1px solid #ccc; }
.as-console-row-code { width: 100%; white-space: pre-wrap; padding: 3px 5px; display: table-cell; font-family: monospace; font-size: 13px; vertical-align: middle; }
.as-console-error:before { content: 'Error: '; color: #f00; }
.as-console-assert:before { content: 'Assertion failed: '; color: #f00; }
.as-console-info:before { content: 'Info: '; color: #00f; }
.as-console-warning:before { content: 'Warning: '; color: #e90 }
@-webkit-keyframes flash { 0% { background: rgba(255,240,0,.25); } 100% { background: none; } }
@-moz-keyframes flash { 0% { background: rgba(255,240,0,.25); } 100% { background: none; } }
@-ms-keyframes flash { 0% { background: rgba(255,240,0,.25); } 100% { background: none; } }
@keyframes flash { 0% { background: rgba(255,240,0,.25); } 100% { background: none; } }
.as-console-row-code, .as-console-row:after { -webkit-animation: flash 1s; -moz-animation: flash 1s; -ms-animation: flash 1s; animation: flash 1s; }</style>
</head>
<body>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.1/css/flag-icon.min.css">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<style type="text/css">
	.phone-link {
		border-radius: 25px;
		background-color: lightblue;
		color: #ffffff;
		padding: 15px 25px;
	}

	.navbar-nav {
		margin-right: 40px;
	}

	.navbar-nav .nav-item {
		padding: 25px;
	}


	@media (max-width: 999px) {
		.phone-link {
			display: none;
		}
	}

	.dropdown.language {
		position: absolute; 
		right: 200px; 
		width: auto;
		top: 35px;
	}
	@media (max-width: 991px) {
		.dropdown.language {
			right: 100px;
			position: absolute; top: 10px;
		}
	}
</style>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">
		<img src="https://getbootstrap.com/docs/4.2/assets/brand/bootstrap-solid.svg" width="30" height="30" alt="">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>

	</button>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Features</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Pricing</a>
			</li>
			<!--
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Dropdown link
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="#">Action</a>
					<a class="dropdown-item" href="#">Another action</a>
					<a class="dropdown-item" href="#">Something else here</a>
				</div>
			</li>
			-->
		</ul>

	</div>

	<ul>
		<li><a href="{{ url('locale/en') }}" ><i class="fa fa-language"></i> EN</a></li>
		<li><a href="{{ url('locale/ru') }}" ><i class="fa fa-language"></i> RU</a></li>
	@foreach(config('app.available_locales') as $locale)
		
    	<a href="{{route('admin.item.create') }}">
        	{{ strtoupper($locale) }}
		</a>
	@endforeach
	<ul>

	<!--
	<div class="dropdown language">
		<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<span class="flag-icon flag-icon-us"></span> English
		</button>
		<div class="dropdown-menu dropdown-menu-right text-right language">
			<a class="dropdown-item" href="#fr"><span class="flag-icon flag-icon-fr"> </span> French</a>
			<a class="dropdown-item" href="#it"><span class="flag-icon flag-icon-it"> </span> Italian</a>
			<a class="dropdown-item" href="#ru"><span class="flag-icon flag-icon-ru"> </span> Russian</a>
		</div>
	</div>
-->
</nav>



<div class="as-console-wrapper"><div class="as-console"></div></div></body></html>