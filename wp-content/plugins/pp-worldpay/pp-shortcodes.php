<?php

add_shortcode('pp_worldpay_slide_1', 'pp_worldpay_slide_1');
function pp_worldpay_slide_1() {

$strContent = '';

	$strContent .= '
 
	<form action="" id="paymentForm" method="post">
		<ul class="grid later equal">
				<li class="col-4-12">
					<div class="fix-4-12">
						<div class="pp-amount-box">
							<div class="pp-amount-box-header pp-amount-box-header-1"></div>
							<span class="pp-amount-box-circle pp-set-amount" data-pp-amount="50">£50</span>
							<p>Our first priority when we close an orphanage is to try to reunite children with their birth families. This takes time and care. An important stage in this process is a child’s first overnight stay with their family. Your £50 could help fund the specialist support that children need to take this important step</p>
						</div>
					</div>
				</li>
				<li class="col-4-12">
					<div class="fix-4-12">
						<div class="pp-amount-box">
							<div class="pp-amount-box-header pp-amount-box-header-2"></div>
							<span class="pp-amount-box-circle pp-set-amount" data-pp-amount="100">£100</span>
							<p>Many children who leave orphanages to live in our Small Family Homes have never had the chance to celebrate Christmas. Your £100 could help staff to create special memories for them, by providing a loving family atmosphere with decorations, presents, games and festive food.</p>
						</div>
					</div>
				</li>
				<li class="col-4-12">
					<div class="fix-4-12">
						<div class="pp-amount-box">
							<div class="pp-amount-box-header pp-amount-box-header-3"></div>
							<span class="pp-amount-box-circle pp-set-amount" data-pp-amount="500">£500</span>
							<p>Essential items such as a stove, cooking utensils, basic furniture and bedding can be enough to prevent a struggling family from placing their child in an orphanage. Your £500 could help keep a family together and ensure that children grow up with the love and emotional security they need.</p>
						</div>

					</div>
				</li>
		</ul>	

		<ul class="grid later equal">
				<li class="col-2-12">
					<div class="fix-2-12">
						<span class="pp-amount-box-circle-white pp-set-amount" data-pp-amount="10">£10</span>
					</div>
				</li>
				<li class="col-2-12">
					<div class="fix-2-12">
						<span class="pp-amount-box-circle-white pp-set-amount" data-pp-amount="50">£50</span>
					</div>
				</li>
				<li class="col-2-12">
					<div class="fix-2-12">
						<span class="pp-amount-box-circle-white pp-set-amount" data-pp-amount="100">£100</span>
					</div>
				</li>
				<li class="col-2-12">
					<div class="fix-2-12">
						<span class="pp-amount-box-circle-white pp-set-amount" data-pp-amount="250">£250</span>
					</div>
				</li>
				<li class="col-2-12">
					<div class="fix-2-12">
						<span class="pp-amount-box-circle-white pp-set-amount" data-pp-amount="500">£500</span>
					</div>
				</li>
				<li class="col-2-12">
					<div class="fix-2-12">
						<span class="pp-amount-box-circle-white pp-set-amount" data-pp-amount="1000">£1000</span>
					</div>
				</li>

		</ul>	


		<ul class="grid later equal">
				<li class="col-12-12">
					<div class="fix-12-12">
						<img src="'.plugin_dir_url( __FILE__ ).'images/down-arrow.png" class="down-arrow" />
					</div>
				</li>
		</ul>	
	';
	return $strContent;
}



add_shortcode('pp_worldpay_slide_2', 'pp_worldpay_slide_2');
function pp_worldpay_slide_2() {
	$strContent = '
		<ul class="grid later equal">
				<li class="col-3-12">
					<div class="fix-3-12">
						&nbsp;
					</div>
				</li>

				<li class="col-6-12">
					<div class="fix-6-12">
						<div class="gift-aid">
							<h2 class="gbp">£GBP</h2>
							<input type="number" class="pp-worldpay-amount" name="pp_amount" tabindex="1" placeholder="Enter your own amount" required="true" min="1" />
							<br /><br />
							<h3>Gift aid declaration</h3>
							<h3>Add 25p for every £1 you donate</h3>
							<br /><br />
							<p>If you are a UK taxpayer, please tick the box below and we can receive an extra 25p from every £1 you give at no extra cost to you. Your address is needed to identify you as a current UK taxpayer.</p>
						
							<label>
								<input type="radio" tabindex="2" name="pp_giftaid" value="1" />
								Yes: I want to Gift Aid my donation and any donations I make in the future or have made in the past 4 years to Hope and Homes for Children.  I am a UK taxpayer and understand that if I pay less Income Tax and/or Capital Gains Tax than the amount of Gift Aid claimed on all my donations in that tax year it is my responsibility to pay any difference.
							</label>

							<label>
								<input type="radio" tabindex="3" name="pp_giftaid" value="2" />
								No: I am not a UK taxpayer (this helps us to know not to contact you about this again).
							</label>

							<img src="'.plugin_dir_url( __FILE__ ).'images/giftaid-label.png" class="down-arrow" />
						
						</div>
					</div>
				</li>

				<li class="col-3-12">
					<div class="fix-3-12">
						&nbsp;
					</div>
				</li>

		</ul>	
		<ul class="grid later equal">
				<li class="col-12-12">
					<div class="fix-12-12">
						<img src="'.plugin_dir_url( __FILE__ ).'images/down-arrow.png" class="down-arrow" />
					</div>
				</li>
		</ul>	
	';
	return $strContent;
}



add_shortcode('pp_worldpay_slide_3', 'pp_worldpay_slide_3');
function pp_worldpay_slide_3() {
	$strContent = '
		<ul class="grid later equal">
				<li class="col-1-12">
					<div class="fix-1-12">
						&nbsp;
					</div>
				</li>

				<li class="col-10-12">
					<div class="fix-10-12">
						<div class="payment-method">
							<h2 class="gbp">Select your payment method</h2>

								<ul class="grid later equal">
										<li class="col-2-12">
											<div class="fix-2-12">
												<label class="payment-select">
													<img src="'.plugin_dir_url( __FILE__ ).'images/payment-mastercard.png" class="payment-icon" />
													<input type="radio" tabindex="4" name="payment_method" value="mastercard" />
												</label>
											</div>
										</li>
										<li class="col-2-12">
											<div class="fix-2-12">
												<label class="payment-select">
													<img src="'.plugin_dir_url( __FILE__ ).'images/payment-mastercard-debit.png" class="payment-icon" />
													<input type="radio" tabindex="5" name="payment_method" value="mastercard-debit" />
												</label>
											</div>
										</li>
										<li class="col-2-12">
											<div class="fix-2-12">
												<label class="payment-select">
													<img src="'.plugin_dir_url( __FILE__ ).'images/payment-maestro.png" class="payment-icon" />
													<input type="radio" tabindex="6" name="payment_method" value="maestro" />
												</label>
											</div>
										</li>
										<li class="col-2-12">
											<div class="fix-2-12">
												<label class="payment-select">
													<img src="'.plugin_dir_url( __FILE__ ).'images/payment-visa.png" class="payment-icon" />
													<input type="radio" tabindex="7" name="payment_method" value="visa" />
												</label>
											</div>
										</li>
										<li class="col-2-12">
											<div class="fix-2-12">
												<label class="payment-select">
													<img src="'.plugin_dir_url( __FILE__ ).'images/payment-visa-debit.png" class="payment-icon" />
													<input type="radio" tabindex="8" name="payment_method" value="visa-debit" />
												</label>
											</div>
										</li>
										<li class="col-2-12">
											<div class="fix-2-12">
												<label class="payment-select">
													<img src="'.plugin_dir_url( __FILE__ ).'images/payment-visa-electron.png" class="payment-icon" />
													<input type="radio" tabindex="9" name="payment_method" value="visa-electron" />
												</label>
											</div>
										</li>

								</ul>	
								


							<h2 class="gbp">Billing details</h2>
							<h3>Fields marked with a <span style="color: #ff0000;">*</span> are mandatory</h3>
					
  <span id="paymentErrors"></span>

						
						</div>
					</div>
				</li>

				<li class="col-1-12">
					<div class="fix-1-12">
						&nbsp;
					</div>
				</li>

		</ul>	


		<ul class="grid later equal">
				<li class="col-6-12">
					<div class="fix-6-12">
						<div class="form-fields-col">
							<label>
								<span>Name on Card <span class="mandatory">*</span></span>
								<input type="text" tabindex="10" data-worldpay="name" name="name" required="true" />
							</label>

							<label>
								<span>Expiration (MM/YYYY) <span class="mandatory">*</span></span>
								<input type="text" tabindex="12" data-worldpay="exp-month" style="width: 45%;" required="true" />
								<div style="width: 5%; text-align: center; display: inline-block;">/</div>
								<input type="text" tabindex="13" data-worldpay="exp-year" style="width: 45%; float: right;" required="true" />
							</label>

							<label>
								<span>Title</span>
								<input type="text" tabindex="15" name="pp_title" />
							</label>

							<label>
								<span>First name <span class="mandatory">*</span></span>
								<input type="text" tabindex="17" name="pp_firstname" required="true" />
							</label>

							<label>
								<span>Email address <span class="mandatory">*</span></span>
								<input type="email" tabindex="19" name="pp_email" required="true" />
							</label>

							<label>
								<span>Address line 1 <span class="mandatory">*</span></span>
								<input type="text" tabindex="21" name="pp_address_line_1" required="true" />
							</label>

							<label>
								<span>Address line 3 <span class="mandatory">*</span></span>
								<input type="text" tabindex="23" name="pp_address_line_3" required="true" />
							</label>

							<label>
								<span>Postcode <span class="mandatory">*</span></span>
								<input type="text" tabindex="25" name="pp_postcode" required="true" />
							</label>

						</div>
					</div>
				</li>

				<li class="col-6-12">
					<div class="fix-6-12">
						<div class="form-fields-col">
							<label>
								<span>Card number <span class="mandatory">*</span></span>
								<input type="text" tabindex="11" data-worldpay="number" required="true" />
							</label>

							<label>
								<span>CVC <span class="mandatory">*</span></span>
								<input type="text" tabindex="14" data-worldpay="cvc"  required="true" />
							</label>


							<label>
								<span>Contact number</span>
								<input type="text" tabindex="16" name="pp_contact_number" />
							</label>

							<label>
								<span>Last name <span class="mandatory">*</span></span>
								<input type="text" tabindex="18" name="pp_lastname" required="true" />
							</label>

							<label>
								<span>Confirm email address <span class="mandatory">*</span></span>
								<input type="email" tabindex="20" name="pp_reemail" required="true" />
							</label>

							<label>
								<span>Address line 2</span>
								<input type="text" tabindex="22" name="pp_address_line_2" />
							</label>

							<label>
								<span>Town/City <span class="mandatory">*</span></span>
								<input type="text" tabindex="24" name="pp_city" required="true" />
							</label>

							<label>
								<span>Country</span>
								<input type="text" tabindex="26" name="pp_country" />
							</label>


						</div>

					</div>
				</li>


		</ul>	
		<ul class="grid later equal">
				<li class="col-12-12">
					<div class="fix-12-12">
						<img src="'.plugin_dir_url( __FILE__ ).'images/down-arrow.png" class="down-arrow" />
					</div>
				</li>
		</ul>
	';
	return $strContent;
}


add_shortcode('pp_worldpay_slide_4', 'pp_worldpay_slide_4');
function pp_worldpay_slide_4() {
	$strContent = '
		<ul class="grid later equal">
				<li class="col-1-12">
					<div class="fix-1-12">
						&nbsp;
					</div>
				</li>

				<li class="col-10-12">
					<div class="fix-10-12">
						<div class="keep-me-posted">
							<h3 class="">Keep me posted</h3>
							<p>Don\'t worry, we definitely won\'t send you spam or junk mail, or give your details to anyone else. We don\'t like that sort of thing - see our privacy policy.</p>
							<img src="'.plugin_dir_url( __FILE__ ).'images/envelope.png" class="keep-me-img" />
							<p><strong>Would you like to be kept informed<br />by email about what we are up to?</strong></p>
					
							<label>
								<input type="radio" tabindex="23" name="pp_informed_by" value="mail" />
								By email
							</label>
							<label>
								<input type="radio" tabindex="24" name="pp_informed_by" value="post" />
								By post
							</label>
							<input type="hidden" name="pp_worldpay_send" value="true" />
							<input type="submit" tabindex="25" name="send" value="Make payment" />
	
						
						</div>
					</div>
				</li>

				<li class="col-1-12">
					<div class="fix-1-12">
						&nbsp;
					</div>
				</li>

		</ul>	

		<ul class="grid later equal">
				<li class="col-12-12">
					<div class="fix-12-12">
						<img src="'.plugin_dir_url( __FILE__ ).'images/down-arrow.png" class="down-arrow" />
					</div>
				</li>
		</ul>
	';
	return $strContent;
}


add_shortcode('pp_worldpay_slide_5', 'pp_worldpay_slide_5');
function pp_worldpay_slide_5() {
	$strContent = '
		<ul class="grid later equal">
				<li class="col-1-12">
					<div class="fix-1-12">
						&nbsp;
					</div>
				</li>

				<li class="col-10-12">
					<div class="fix-10-12">
						<div class="worldpay-info">
							<p>With concerns about security of financial data at an all-time high, we want to reassure you that by working with the best partners like WorldPay, we\'ll keep your data safe.</p>
							<br />
							<p>More information on your donation</p>
					
							<img src="'.plugin_dir_url( __FILE__ ).'images/worldpay.png" class="down-arrow" />
						
						</div>
					</div>
				</li>

				<li class="col-1-12">
					<div class="fix-1-12">
						&nbsp;
					</div>
				</li>
		</ul>
	';
	if(get_option('pp_worldpay_api_mode') == 1)
	{
		$strClientKey = get_option('pp_worldpay_client_key_test');
	}
	else
	{
		$strClientKey = get_option('pp_worldpay_client_key_live');
	}
	
	$strContent .= '<input type="hidden" id="pp-client-key" value="'.$strClientKey.'" />';
	
	$strContent .= '	
		</form>	
	';
	
	
	$strContent .= '<script src="https://cdn.worldpay.com/v1/worldpay.js"></script>';
	$strContent .= '<script src="'.plugin_dir_url( __FILE__ ).'js/script.js"></script>';

	return $strContent;
}


