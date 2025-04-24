<!DOCTYPE html>
<html lang="en">
   
<!-- Mirrored from themewagon.github.io/pluto/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Mar 2025 14:38:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <!-- site icon -->
      <link rel="icon" href="{{asset('images/fevicon.html')}}" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
      <!-- site css -->
      <link rel="stylesheet" href="{{asset('style.css')}}" />
      <!-- responsive css -->
      <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
      <!-- color css -->
      <link rel="stylesheet" href="{{asset('css/colors.html')}}" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="{{asset('css/perfect-scrollbar.css')}}" />
      <!-- custom css -->
      <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="inner_page login">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                        <img width="210" src="images/logo/logo.png" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                     <form action="{{ route('login') }}" method="POST">
                        @csrf
                         <fieldset>
                             <!-- Email Field -->
                             <div class="field">
                                 <label class="label_field" for="email">Email Address</label>
                                 <input type="email" name="email" id="email" placeholder="E-mail" required />
                             </div>
                 	
                             <!-- Password Field -->
                             <div class="field">
                                 <label class="label_field" for="password">Password</label>
                                 <input type="password" name="password" id="password" placeholder="Password" required />
                             </div>
                 	
                             <!-- Remember Me & Forgotten Password -->
                             <div class="field">
                                 <label class="label_field hidden">hidden label</label>
                                 <div class="d-flex justify-content-between align-items-center">
                                     <label class="form-check-label">
                                         <input type="checkbox" class="form-check-input"> Remember Me
                                     </label>
                                     <a class="forgot" href="#">Forgotten Password?</a>
                                 </div>
                             </div>
                 	
                             <!-- Sign In Button -->
                             <div class="field margin_0">
                                 <label class="label_field hidden">hidden label</label>
                                 <button type="submit" class="main_bt">Sign In</button>
                             </div>
                         </fieldset>
                     </form>
                 </div>
                 
                  <!-- Log Out Form -->
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>

                  <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <span>Log Out</span> <i class="fa fa-sign-out"></i>
                  </a>
                  
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>

<!-- Mirrored from themewagon.github.io/pluto/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Mar 2025 14:38:46 GMT -->
</html>
