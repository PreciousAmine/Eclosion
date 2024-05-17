<!DOCTYPE html>
<html lang="en">
	<head>
		@include('includes.admin.head')
		@yield('page_css')
	</head>

	<body>
		<script src="{{ asset('admin/js/initTheme.js') }}"></script>
		<div id="app">
			@include('includes.admin.header')

			<div id="main">
				<header class="mb-3">
					<a href="#" class="burger-btn d-block d-xl-none">
						<i class="bi bi-justify fs-3"></i>
					</a>
				</header>

				@yield('content')
			</div>
		</div>

		@include('includes.admin.scripts')
		@yield('page_scripts')
	</body>
</html>
