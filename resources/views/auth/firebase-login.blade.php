<html>
<head>
    <title>Laravel Phone Number Authentication using Firebase - raviyatechnical</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  
<div class="container">
    <h1>Laravel Phone Number Authentication using Firebase - raviyatechnical</h1>
  
    <div class="alert alert-danger" id="error" style="display: none;"></div>
  
    <div class="card">
      <div class="card-header">
        Enter Phone Number
      </div>
      <div class="card-body">
  
        <div class="alert alert-success" id="sentSuccess" style="display: none;"></div>
  
        <form>
            <label>Phone Number:</label>
            <input type="text" id="number" class="form-control" placeholder="+20********">
            <div id="recaptcha-container"></div>
            <button type="button" class="btn btn-success" onclick="phoneSendAuth();">SendCode</button>
        </form>
      </div>
    </div>
      
    <div class="card" style="margin-top: 10px">
      <div class="card-header">
        Enter Verification code
      </div>
      <div class="card-body">
  
        <div class="alert alert-success" id="successRegsiter" style="display: none;"></div>
  
        <form>
            <input type="text" id="verificationCode" class="form-control" placeholder="Enter verification code">
            <button type="button" class="btn btn-success" onclick="codeverify();">Verify code</button>
  
        </form>
      </div>
    </div>
  
</div>
  
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
  
<script>
      
  let firebaseConfig = {
    apiKey: "AIzaSyC2AiqOJ3CcKRcfappz54GNxlZNnmQLL5U",
    authDomain: "penta-b0191.firebaseapp.com",
    projectId: "penta-b0191",
    storageBucket: "penta-b0191.appspot.com",
    messagingSenderId: "1003768044641",
    appId: "1:1003768044641:web:9f058dbb53a3a13dadde20",
    measurementId: "G-ZT88HEGVXH"
  };
    
  firebase.initializeApp(firebaseConfig);
</script>
  
<script type="text/javascript">
  
    window.onload=function () {
      render();
    };
  
    function render() {
        window.recaptchaVerifier=new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }
  
    function phoneSendAuth() {
           
        let number = $("#number").val();
          
        firebase.auth().signInWithPhoneNumber(number,window.recaptchaVerifier).then(function (confirmationResult) {
              
          console.log(confirmationResult);
            window.confirmationResult=confirmationResult;
            // coderesult=confirmationResult;
            // console.log(coderesult);
  
            $("#sentSuccess").text("Message Sent Successfully.");
            $("#sentSuccess").show();

            setTimeout(function () {
                $("#sentSuccess").hide();
            }, 3000);
              
        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();

            setTimeout(function () {
            $("#error").hide();
               }, 3000);
        });
    }
  
    function codeverify() {
  
        let code = $("#verificationCode").val();
  
        coderesult.confirm(code).then(function (result) {
            let user=result.user;
            console.log(user);
  
            $("#successRegsiter").text("you are register Successfully.");
            $("#successRegsiter").show();
             // Hide the success message after 3 seconds
            setTimeout(function () {
                $("#successRegsiter").hide();
            }, 3000);
  
        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();

            setTimeout(function () {
            $("#error").hide();
        }, 3000);
        });
    }
  
</script>
  
</body>
</html>