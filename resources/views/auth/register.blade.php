<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from colorlib.com//polygon/admindek/default/auth-sign-up-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Oct 2019 06:28:23 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <title>Admindek | Admin Template</title>


<!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js') }}/1.4.2/respond.min.js') }}"></script>
  <![endif]-->

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
  <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
  <meta name="author" content="colorlib" />

  <link rel="icon" href="https://colorlib.com//polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/bower_components/bootstrap/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('ui/backend/files/assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all"> <link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/icon/feather/css/feather.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/icon/themify-icons/themify-icons.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/icon/icofont/css/icofont.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/icon/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/css/style.css') }}"><link rel="stylesheet" type="text/css" href="{{ asset('ui/backend/files/assets/css/pages.css') }}">
</head>
<body themebg-pattern="theme1">

    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="login-block">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">

                        <form class="md-float-material form-material" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="text-center">
                            <img style="height: 104px;width:275px" src="{{ asset('ui/backend/files/assets/images/logo.png') }}" alt="logo.png') }}">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Sign up</h3>
                                    </div>
                                </div>
                                <p class="text-muted text-center p-b-5">Sign up with your regular account</p>
                                <div class="form-group form-primary">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                    <span class="form-bar"></span>
                                    <label class="float-label">Choose Username</label>
                                </div>
                                <div class="form-group form-primary">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <span class="form-bar"></span>
                                    <label class="float-label">Your Email Address</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                            <span class="form-bar"></span>
                                            <label class="float-label">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            <span class="form-bar"></span>
                                            <label class="float-label">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign up</button>
                                    </div>
                                </div>
                            <hr />
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="text-inverse text-left m-b-0">Thank you.</p>
                                <p class="text-inverse text-left"><a href="{{ route('login') }}"><b>Already have an accoun? then click here</b></a></p>
                                </div>
                                <div class="col-md-2">
                                    <img src="{{ asset('ui/backend/files/assets/images/auth/Logo-small-bottom.png') }}" alt="small-logo.png') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>

    </div>

</section>


<!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="{{ asset('ui/backend/files/assets/images/browser/chrome.png') }}" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="{{ asset('ui/backend/files/assets/images/browser/firefox.png') }}" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="{{ asset('ui/backend/files/assets/images/browser/opera.png') }}" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="{{ asset('ui/backend/files/assets/images/browser/safari.png') }}" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="{{ asset('ui/backend/files/assets/images/browser/ie.png') }}" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->


<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/popper.js') }}/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('ui/backend/files/assets/pages/waves/js/waves.min.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>

<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/modernizr/js/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/modernizr/js/css-scrollbars.js') }}"></script>

<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/i18next/js/i18next.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('ui/backend/files/assets/js/common-pages.js') }}"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="text/javascript"></script>
<script type="text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>

<!-- Mirrored from colorlib.com//polygon/admindek/default/auth-sign-up-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Oct 2019 06:28:23 GMT -->
</html>
