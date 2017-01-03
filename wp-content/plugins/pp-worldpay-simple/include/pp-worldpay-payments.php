<?php

function pp_init_payments() {
?>
<div class="wrap">
<h2>PP WorldPay - Payments</h2>

<table border="1" width="100%" style="border-collapse: collapse;">
<tr>
 <th>Payment ID</th> 
 <th>Title</th>
 <th>Name</th>
 <th>Email</th>
 <th>Contact number</th>
 <th>Address, postcode</th>
 <th>Amount</th>
 <th>Status / Environment</th>
 <th>Gift aid</th>
 <th>Inform by</th>
</tr>
  <?php
    global $wpdb;
    $result = $wpdb->get_results ( "SELECT * FROM wp_worldpay_payments" );
    foreach ( $result as $print )   {
    ?>
    <tr>
    <td><?php echo $print->paymentID;?></td>
    <td><?php echo $print->title;?></td>
    <td><?php echo $print->firstname;?> <?php echo $print->lastname;?></td>
    <td><?php echo $print->email;?></td>
    <td><?php echo $print->contact_number;?></td>
    <td><?php echo $print->address_line_1;?> <?php echo $print->address_line_2;?> <?php echo $print->address_line_3;?><br /><?php echo $print->postcode;?></td>
    <td>£<?php echo $print->amount;?></td>
    <td><?php echo $print->paymentStatus;?><br /><?php echo $print->environment;?></td>
    <td>
    	<?php 
    		if($print->gift_aid == 1)
    		{
    			echo 'YES';
    		}
    		if($print->gift_aid == 2)
    		{
    			echo 'NO';
    		}
    	?>
    </td>
    <td>
    	<?php 
    		if($print->informed_by == 'mail')
    		{
    			echo 'By email';
    		}
    		if($print->informed_by == 'post')
    		{
    			echo 'By post';
    		}
    	?>
    </td>
    </tr>
        <?php }
  ?>              
<?php
}	
?>
</div>
