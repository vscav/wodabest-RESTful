@php
$config = [
'appName' => config('app.name'),
'locale' => $locale = app()->getLocale(),
'locales' => config('app.locales'),
'githubAuth' => config('services.github.client_id'),
'googleAuth' => config('services.google.client_id'),
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Wodabest</title>

  <meta name="application-name" content="Wodabest">
  <meta name="msapplication-starturl" content="http://herokuapp.wodabest.com" />

  <meta name="description"
    content="Wodabest is THE platform for sharing your artistic and creative works. More than just a gallery, Wodabest allows you to compare your most beautiful works through a system based on the ELO algorithm.">

  <link rel="icon" type="image/png" href="img/icons/favicon/favicon.png" />

  <meta name="robots" content="index,follow">
  <meta name="googlebot" content="index,follow">

  <meta name="google" content="nositelinkssearchbox">
  <meta name="google" content="notranslate">

  <meta name="subject" content="Competitive student's Art gallery">

  <!-- Facebook Open Graph -->
  <meta property="og:url" content="http://herokuapp.wodabest.com">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Wodabest">
  <meta property="og:description"
    content="Wodabest is THE platform for sharing your artistic and creative works. More than just a gallery, Wodabest allows you to compare your most beautiful works through a system based on the ELO algorithm.">
  <meta property="og:site_name" content="Wodabest">
  <meta property="og:locale" content="fr">
  <meta property="article:author" content="Wodabest">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="@wodabest">
  <meta name="twitter:creator" content="@wodabest">
  <meta name="twitter:url" content="http://herokuapp.wodabest.com">
  <meta name="twitter:title" content="Wodabest">
  <meta name="twitter:description"
    content="Wodabest is THE platform for sharing your artistic and creative works. More than just a gallery, Wodabest allows you to compare your most beautiful works through a system based on the ELO algorithm.">
  <meta name="twitter:dnt" content="on">

  <title>{{ config('app.name') }}</title>

  <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
</head>

<body>
  <div id="app"></div>

  {{-- Global configuration object --}}
  <script>
    window.config = @json($config);
  </script>

  {{-- Load the application scripts --}}
  <script src="{{ mix('dist/js/app.js') }}"></script>
</body>

</html>