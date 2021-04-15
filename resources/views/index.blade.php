

<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="zxx">

<head>
  <title>Wings by NINESEAS Logistics :: wingsbenchmark</title>
  <!-- Meta-Tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="keywords" content="Wings by Nineseas Logistics,Logistics, Wings , Developed by Yakubu Damilola,Logistics in Nigeria"/>

  <script>
    addEventListener("load", function () {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <!-- //Meta-Tags -->
  <!-- Stylesheets -->
  <link href="css/style.css" rel='stylesheet' type='text/css' />
  <!--// Stylesheets -->
  <!--fonts-->
  <!-- title -->
  <link href="//fonts.googleapis.com/css?family=Abhaya+Libre:400,500,600,700,800" rel="stylesheet">
  <!-- body -->
  <!--//fonts-->
</head>

<body>
  <header>
    <h1 style="color: #fff">Wings by Nineseas Logistics</h1>
  </header>
  <div class="w3ls-contact">
     <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- form starts here -->
    <form method="post" action="{{ url('/login') }}">

       {!! csrf_field() !!}

     <div class="form-group has-feedback agile-field-txt {{ $errors->has('email') ? ' has-error' : '' }}">
      <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      @if ($errors->has('email'))
      <span class="help-block">
        <strong>{{ $errors->first('email') }}</strong>
      </span>
      @endif
    </div>

    <div class="form-group agile-field-txt has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
      <input type="password" class="form-control" placeholder="Password" name="password">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      @if ($errors->has('password'))
      <span class="help-block">
        <strong>{{ $errors->first('password') }}</strong>
      </span>
      @endif

    </div>

    <div class="w3ls-contact  w3l-sub">
      <input type="submit" value="Login">
    </div>

  </form>
</div>
<!-- //form ends here -->
<div class="copy-wthree">
    <p>© {{ date('Y') }} Wings Workbench Form . All Rights Reserved <!--| Design by
      <a href="http://w3layouts.com/" target="_blank">W3layouts</a>-->
    </p>
  </div>
</body>
<!-- //Body -->

</html>