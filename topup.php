<?php
require 'nav.php';
require 'connectdb.php';
?>
<html>
<head>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util2.css">
	<link rel="stylesheet" type="text/css" href="css/topup.css">
<!--===============================================================================================-->
</head>
<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 300px;
            display: inline-block;
        }
    }
    
</style>
<body background='img/lop.jpg'>

	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form">

				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
					<input id="money" class="input100" type="text" name="email" placeholder="กรุณากรอกจำนวนเงิน">
                    <input type="hidden" id="username" name="username" value="<?php echo $_SESSION["email"] ?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Message is required">
				</div>
                <center><div id="paypal-button-container"></div></center>

        <script>

            paypal.Button.render({
                
                // Set your environment

                env: 'sandbox', // sandbox | production
                
                // Specify the style of the button
                style: {
                    label: 'checkout',  // checkout | credit | pay | buynow | generic
                    size:  'responsive', // small | medium | large | responsive
                    shape: 'pill',   // pill | rect
                    color: 'gold'   // gold | blue | silver | black
                },

                // PayPal Client IDs - replace with your own
                // Create a PayPal app: https://developer.paypal.com/developer/applications/create

                client: {
                    sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                    production: '<insert production client id>'
                },

                // Wait for the PayPal button to be clicked
                payment: function(data, actions) {
                    var money = document.getElementById("money").value;
                    return actions.payment.create({
                        payment: {
                            transactions: [
                                {
                                    amount: { total: money, currency: 'USD' }
                                }
                            ]
                        }
                    });
                },

                // Wait for the payment to be authorized by the customer
                onAuthorize: function(data, actions) {
                    return actions.payment.execute()
                    .then(function() {
                        topup();
                    });
                }
            }, '#paypal-button-container');

        </script>
			</form>
		</div>
	</div>
	<div id="dropDownSelect1"></div>
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->

	<script src="js/topup.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
		function topup(){
			var user = document.getElementById("username").value;
            var moneys = document.getElementById("money").value;
			$.post("keeptopup.php",
			{
				username: user,
				money: moneys
			},
			function(data,status){
				if(data == 1){
                    swal("เติมเงินได้แล้วนะ");	
				} else {
					swal("สำเร็จ");	
				}
			});
		}
	</script>
</body>
</html>
