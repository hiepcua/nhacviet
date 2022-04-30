
<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
</head>
<body class="hold-transition register-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('admin.dashboard') }}"><b>Admin</b></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">

                @if(session()->has('msg'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <span>{{ session()->get('msg') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                @endif

                <form id="frm-register" action="{{route('admin.register')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" {{ old('terms')=='agree' ? 'checked' : null }} value="agree">
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button id="btn-submit-register" type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="{{ route('admin.login') }}" class="text-center">Login</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    @include('admin.footer')
    <script>
        $(document).ready(function(){
            const checkbox = document.getElementById('agreeTerms')

            checkbox.addEventListener('change', (event) => {
                if (event.currentTarget.checked) {
                    $('#btn-submit-register').removeAttr('disabled');
                } else {
                    $('#btn-submit-register').attr('disabled', true);
                }
            });

            $('#frm-register').on('submit', function(e){
                if (document.getElementById("agreeTerms").checked){
                    $("#frm-register").submit();
                }else{
                    e.preventDefault();
                    $('#btn-submit-register').attr('disabled', true);
                }
            });
        });
    </script>
</body>
</html>