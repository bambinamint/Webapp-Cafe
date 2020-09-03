<?php
require 'nav.php';
?>
<html lang="en">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function validate(e){
        if (e.name.value == ""){
            swal("Name is required");
            e.name.focus();
            return false;
        }	
        if (e.phone.value == ""){
            swal("Phone is required");
            e.phone.focus();
            return false;
        }	
        if (e.email.value == ""){
            swal("Email is required");
            e.email.focus();
            return false;
        }
        if (e.password.value == ""){
            swal("Password is required");
            e.password.focus();
            return false;
        }	
        if (e.repassword.value == ""){
            swal("Re-Password is required");
            e.repassword.focus();
            return false;
        }

        if (e.repassword.value !== e.password.value){
            swal("Password no math");
            e.repassword.focus();
            return false;
        }
        

    }
</script>  
    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/signup.css" rel="stylesheet" media="all">
</head>

<body>
<form action = "savemember.php" method="post" onsubmit="return validate(this);">
    <div class="page-wrapper p-t-180 p-b-100 font-poppins" style="background-image: url('img/arabica-aromatic-beverage-678654.jpg');">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading" style="background-image: url('img/art-coffee-coffee-shop-672998.jpg');"></div>
                <div class="card-body" >
                    <h2 class="title">Registration Info</h2>
                    <div class="input-group">
                        <input class="input--style-3" type="text" placeholder="Name" name="name" id="name">
                    </div>
                    <div class="input-group">
                        <input class="input--style-3" type="text" placeholder="Phone" name="phone" id="phone">
                    </div>
                    <div class="input-group">
                        <input class="input--style-3" type="email" placeholder="Email" name="email" id="email">
                    </div>
                    <div class="input-group">
                        <input class="input--style-3" type="password" placeholder="Password" name="password" id="password">
                    </div>
                    <div class="input-group">
                        <input class="input--style-3" type="password" placeholder="Re-Password" name="repassword" id="repassword">
                    </div>
                    <div class="p-t-10">
                        <button class="btn btn--pill btn--green"  type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/signup.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>