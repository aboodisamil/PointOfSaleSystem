
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Favicons -->
    <link href=" {{{ asset('control/img/favicon.png') }}}" rel="icon">
    <link href=" {{ asset('control/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href=" {{ asset('control/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--external css-->
    <link href=" {{ asset('control/lib/font-awesome/css/font-awesome.css') }} " rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('control/css/style.css') }} " rel="stylesheet">
    <link href="{{ asset('control/css/style-responsive.css') }} " rel="stylesheet">


</head>

<body>
<div id="login-page">
    <div class="container">
        <form class="form-login" action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <h2 class="form-login-heading">sign in now</h2>
            <div class="login-wrap">
                <input type="email"  name="email" value="{{ old('email') }}"  class="form-control" placeholder="E-mail" autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                     </span>
                @endif

                <br>

                <input type="password" name="password" class="form-control" placeholder="Password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

                <br>
                <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                <hr>
                <div class="login-social-link centered">
                    <p>or you can sign in via your social network</p>
                    <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
                    <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
                </div>
                <div class="registration">
                    Don't have an account yet?<br/>
                    <a class="" href="#">
                        Create an account
                    </a>
                </div>
            </div>
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button  class="btn btn-theme" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->
        </form>
    </div>
</div>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ asset('control/lib/jquery/jquery.min.js') }} "></script>
<script src="{{ asset('control/lib/bootstrap/js/bootstrap.min.js') }} "></script>
<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="{{ asset('control/lib/jquery.backstretch.min.js') }} "></script>
<script>
    $.backstretch("{{ asset('control/img/login-bg.jpg') }} ", {
        speed: 500
    });
</script>
</body>

</html>
