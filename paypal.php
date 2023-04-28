<?php # DISPLAY SHOPPING CART PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
//if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Reservation' ;
include ( 'header2.php' ) ;

# Open database connection.
require ( 'connect_db.php' ) ;
 

  echo '<div class="container">
<br>
<h5 class="text-center"><em>Please be aware that your account will be activated within two hours!</em></h5>
<br>
        <a href="login.php" role="button" type="button" class="btn btn-outline-warning btn-lg btn-block">Create account without subscription</a>
           <br>
           <h3 class="text-center">or</h3>
           <br>
			<div class="middlea">
				<h1 class="display-4 text-muted">Your subscription option</h1>
				<hr class="bg-info">
			</div><span style="color:white">
			<div class="table-responsive">
				<table class="table">
				<thead class="thead-dark">
				<tr>
				<th scope="col">Booking Refrence</th>
				<th scope="col">Total</th>
				<th scope="col">Date of Booking</th>
				<th scope="col">Status</th>
				</tr>
				</thead>
				</span>
				<tbody>
			<tr>
			<td>Full Packet</td>
			<td>£99.99</td>
			<td>' . date("Y.m.d") . '</td>
			<td>One year subscription</td>
  ';
	echo '</tr>
		  </tbody>
		  </table>
';

?>
			<div id="paypal-button-container"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
// Render the PayPal button
paypal.Button.render({
// Set your environment
env: 'sandbox', // sandbox | production

// Specify the style of the button
style: {
  layout: 'vertical',  // horizontal | vertical
  size:   'medium',    // medium | large | responsive
  shape:  'rect',      // pill | rect
  color:  'gold'       // gold | blue | silver | white | black
},

funding: {
  allowed: [
    paypal.FUNDING.CARD,
    paypal.FUNDING.CREDIT
  ],
  disallowed: []
},

// Enable Pay Now checkout flow (optional)
commit: true,

// PayPal Client IDs - replace with your own

client: {
  sandbox: 'AeClmmvlaMBi5VLuTM5qkVY6C9s8fUf5lK_Py4Pa4kfaD9SL4blXrKgBPlSsqa5nKtIRoVh3CyZt8CeX',
  production: '<insert production client id>'
},

payment: function (data, actions) {
  return actions.payment.create({
    payment: {
      transactions: [
        {
          amount: {
            total: '99.99',
            currency: 'GBP'
          }
        }
      ]
    }
  });
},

onAuthorize: function (data, actions) {
  return actions.payment.execute()
    .then(function () {
      window.alert('Payment Complete!');window.location.href = "index2.php";
    });
}
}, '#paypal-button-container');
</script>

<!--John-->
<!--First name:-->
<!--Doe-->
<!--Last name:-->
<!--sb-7rd1c25073343@personal.example.com-->
<!--Email ID:-->
<!--Qb[L0V$p-->
<!--password-->
