<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Fudosan-Properties : CMS $ CRM Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="msapplication-tap-highlight" content="no">

<link href="{{asset('css/main.css')}}" rel="stylesheet">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>

<body>
<div class="app-container app-theme-white body-tabs-shadow">
    <div class="app-container">
        <div class="h-100">
            <div class="h-100 no-gutters row">
                <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-12">
                    <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                        <div class="app-logo"></div>
                        <h4 class="mb-0">
                            <span class="d-block">Welcome {{Session::get('username')}},</span>
                            <span>Please Change Your Default Password.</span>
                        </h4>
                        @if(Session::has('flash_message_error'))
                        <div class="alert alert-danger fade show">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong style="color: red">{!! session('flash_message_error') !!}</strong>
                        </div>
                    @endif
                     @if(Session::has('flash_message_success'))
                        <div class="alert alert-success fade show">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <strong>{!! session('flash_message_success') !!}</strong>
                        </div>
                    @endif
                        <div class="divider row"></div>
                        <span id='message'></span>
                        <div>
                            <form class="" method="POST" id="signupForm" action="{{url('/login/password-change/'.Session::get('profile_id').'')}}">
                                {{ csrf_field() }}
                                <div class="form-row">

                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="password" class="">New Password</label>
                                            <input name="npassword" id="password" placeholder="New Password here..." type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="confirm_password" class="">Conform Password</label>
                                            <input name="cpassword" id="confirm_password" placeholder="Conform Password here..." type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="divider row"></div>
                                <div class="d-flex align-items-center">
                                    <div class="ml-auto">
                                        <button class="btn btn-primary btn-lg">Continue</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>
<script>
    $('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else
    $('#message').html('Not Matching').css('color', 'red');
});
    </script>

</body>
</html>
