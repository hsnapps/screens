<!DOCTYPE html>
<html lang="ar" dir="rtl">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ config('app.name', 'Laravel') }}</title>
		<link rel="icon" href="favicon.ico">
		<!-- CSS FILES -->
        <link rel="stylesheet" type="text/css" href="/css/uikit-rtl.min.css">
        <link rel="stylesheet" href="/css/style.css">
	</head>
	<body class="uk-flex uk-flex-center uk-flex-middle uk-background-muted uk-height-viewport" data-uk-height-viewport>
		<div class="uk-position-bottom-center uk-position-small uk-visible@m uk-position-z-index">
			<img data-src="images/login-footer.png" width="290" height="64" alt="login-footer" uk-img>
        </div>

		@yield('content')

		<!-- JS FILES -->
		<script src="/js/uikit.min.js"></script>
		<script src="/js/uikit-icons.min.js"></script>
	</body>
</html>
