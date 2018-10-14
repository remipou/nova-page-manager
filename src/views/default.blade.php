<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>{{ $page->meta_title }}</title>
		<meta name="description" content="{{ $page->meta_description }}">
		<meta name="og:title" content="{{ $page->meta_title }}">
		<meta name="og:description" content="{{ $page->meta_description }}">
		<meta name="og:image" content="{{ !empty($page->og_image) ? url($page->og_image) : null }}">
	</head>
	<body class="template-{{ $page->template }} page-{{ $page->slug }}">
		<h1>{{ $page->title }}</h1>
		<div class="content">
			{!! $page->sanitizedContent !!}
		</div>
	</body>
</html>