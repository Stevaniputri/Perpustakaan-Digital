<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in & Sign up Form</title>
    <link rel="stylesheet" href="assets/css/auth.css" />
  </head>
  <body>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <form method="POST" action="{{ route('login') }}" class="sign-in-form">
              @csrf
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <div class="logo">
                  <h4>DigiLibrary</h4>
              </div>
              <div class="heading">
                  <h2>Welcome Back</h2>
                  <h6>Not registered yet?</h6>
                  <a href="#" class="toggle">Sign up</a>
              </div>
          
              <div class="actual-form-logIn">
                  <div class="input-wrap">
                      <input name="username" type="text" class="input-field" autocomplete="off" required />
                      <label>Username</label>
                  </div>
          
                  <div class="input-wrap">
                      <input name="password" type="password" class="input-field" autocomplete="off" required />
                      <label>Password</label>
                  </div>
          
                  <input type="submit" value="Sign In" class="sign-btn" />
              </div>
          </form>
          

            <form method="POST" action="{{route('register')}}" class="sign-up-form">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @csrf
              <div class="heading">
                <h2>Get Started</h2>
                <h6>Already have an account?</h6>
                <a href="#" class="toggle">Sign in</a>
              </div>

              <div class="actual-form-signIn" style="margin-top: 40px;">
                <div class="input-wrap">
                  <input
                  name="fullname"
                    type="text"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Full Name</label>
                </div>

                <div class="input-wrap">
                    <input
                    name="username"
                      type="text"
                      minlength="4"
                      class="input-field"
                      autocomplete="off"
                      required
                    />
                    <label>Username</label>
                  </div>

                <div class="input-wrap">
                  <input
                  name="email"
                    type="email"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                  <input
                  name="password"
                    type="password"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Password</label>
                </div>

                <div class="input-wrap">
                    <input
                    name="address"
                      type="text"
                      minlength="4"
                      class="input-field"
                      autocomplete="off"
                      required
                    />
                    <label>Address</label>
                  </div>

                <input type="submit" value="Sign Up" class="sign-btn" />
              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="assets/img/image1.png" class="image img-1 show" alt="" />
              <img src="assets/img/image2.png" class="image img-2" alt="" />
              <img src="assets/img/image3.png" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Create your own courses</h2>
                  <h2>Customize as you like</h2>
                  <h2>Invite students to your class</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript file -->
    <script src="assets/js/auth.js"></script>
  </body>
</html>
