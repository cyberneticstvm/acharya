  @extends("loginbase")
  @section("content")
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                  @if(session()->has('success'))
                      <div class="alert alert-success text-white">
                          {{ session()->get('success') }}
                      </div>
                  @endif
                  @if(session()->has('error'))
                      <div class="alert alert-danger text-white">
                          {{ session()->get('error') }}
                      </div>
                  @endif
                </div>
                <div class="card-body">                  
                  <form role="form" method="post" name="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="status" value="Active" />
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" aria-describedby="email-addon" value="{{ old('email') }}">
                      @error('email')
                          <small class="text-danger">{{ $errors->first('email') }}</small>
                      @enderror
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" placeholder="Password" name="password" aria-label="Password" aria-describedby="password-addon">
                      @error('password')
                          <small class="text-danger">{{ $errors->first('password') }}</small>
                      @enderror
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" value="1" >
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-submit bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6 mt-5">
                  <img src="{{ public_path().'/assets/img/acharya1.jpeg' }}" class="img-fluid" alt="" style="width:50%; margin:10%" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  @endsection("content")