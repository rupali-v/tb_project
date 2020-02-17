<html>
   <head>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!------ Include the above in your HEAD tag ---------->
      <style>
         body#LoginForm{ background-image:url("https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;}
         .form-heading { color:#fff; font-size:23px;}
         .panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
         .panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
         .login-form .form-control {
         background: #f7f7f7 none repeat scroll 0 0;
         border: 1px solid #d4d4d4;
         border-radius: 4px;
         font-size: 14px;
         height: 50px;
         line-height: 50px;
         }
        
         .login-form .form-group {
         margin-bottom:10px;
         }
         .login-form{ text-align:center;}
         .forgot a {
         color: #777777;
         font-size: 14px;
         text-decoration: underline;
         }
         .login-form  .btn.btn-primary {
         background: #f0ad4e none repeat scroll 0 0;
         border-color: #f0ad4e;
         color: #ffffff;
         font-size: 14px;
         width: 100%;
         height: 50px;
         line-height: 50px;
         padding: 0;
         }
         .forgot {
         text-align: left; margin-bottom:30px;
         }
         .botto-text {
         color: #ffffff;
         font-size: 14px;
         margin: auto;
         text-align:center;
         margin-top:50px;
         }
         .login-form .btn.btn-primary.reset {
         background: #ff9900 none repeat scroll 0 0;
         }
         .back { text-align: left; margin-top:10px;}
         .back a {color: #444444; font-size: 13px;text-decoration: none;}
      </style>
   </head>
   <body id="LoginForm">
      <div class="container"><br>
         <h1 class="form-heading text-center">Send Mail</h1><br>
         <form id="Login" method="post" action="sendmail.php">
            <div class="form-group">
               <input type="email" class="form-control" id="emailtxt" name="emailtxt" placeholder="Email Address">
            </div>
            <div class="form-group">
               <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
            </div>
            <div class="form-group">
               <!-- <input type="password" class="form-control" id="inputPassword" placeholder="Password"> -->
               <textarea class="form-control" name="msg" id="msg" cols="4" rows="4" placeholder="Type here..."></textarea>
            </div>
            <button type="submit" name="sendMail" class="btn btn-primary col-md-12">Send Mail</button>
         </form>
      </div>
      <p class="botto-text">&copy; 2019 - <?php echo date("Y"); ?> Designed & Developed by Kundan Kotangale</p>
      </div>
   </body>
</html>