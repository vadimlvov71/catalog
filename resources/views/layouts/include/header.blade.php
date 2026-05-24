<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">Brand</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarContent">
		
		<!-- Search form -->
		<form class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>

		<!-- Language chooser -->
		<ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Language
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
					@foreach(config('app.available_locales') as $locale)
    					<a class="dropdown-item" href="{{ route('set-locale', ['locale' => $locale]) }}">
        					{{ strtoupper($locale) }}
						</a>
					@endforeach
					
					<!-- Add more languages as needed -->
				</div>
			</li>
		</ul>
	</div>
</nav>