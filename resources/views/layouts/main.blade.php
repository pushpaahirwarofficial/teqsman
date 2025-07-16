<html>

   <title>@yield('pagetitle')</title>
  <meta name="description" content="@yield('description')">
    <!-- #keywords -->
    <meta name="keywords" content="@yield('keywords')">



@include('layouts.main.head') 

<body>
<div class="page-wrapper">
@include('layouts.main.header') 
<main>
 @yield('content')
</main>

@include('layouts.main.footer') 

</div>

</body>
</html>