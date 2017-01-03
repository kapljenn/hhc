<?php

add_shortcode('pp_worldpay_redirect_form', 'pp_worldpay_redirect_form');
function pp_worldpay_redirect_form() {

if(get_option('pp_worldpay_test_mode') == 100)
{
	$redirectLink = 'https://secure-test.worldpay.com/wcc/purchase';
}
else
{
	$redirectLink = 'https://secure.worldpay.com/wcc/purchase';
}

$intAmount = abs(floor(base64_decode($_GET['amount'])));
$paymentId = abs(base64_decode($_GET['pid']));

$strName = base64_decode($_GET['firstname']).' '.base64_decode($_GET['lastname']);
$strAddress1 = base64_decode($_GET['address1']);
$strAddress2 = base64_decode($_GET['address2']);
$strAddress3 = base64_decode($_GET['address3']);
$strTown = base64_decode($_GET['town']);
$strPostcode = base64_decode($_GET['postcode']);
$strTel = base64_decode($_GET['tel']);
$strEmail = base64_decode($_GET['email']);
$strPaymentType = base64_decode($_GET['paymenttype']);
$strCountry = base64_decode($_GET['country']);

$strContent = '

<form action="'.$redirectLink.'" method="POST" name="redirect-form">
<input type="hidden" name="testMode" value="'.get_option('pp_worldpay_test_mode').'">
<input type="hidden" name="instId" value="'.get_option('pp_worldpay_instalation_id').'">
<input type="hidden" name="cartId" value="'.$paymentId.'">
<input type="hidden" name="amount" value="'.$intAmount.'">
<input type="hidden" name="name" value="'.$strName.'">

<input type="hidden" name="address1" value="'.$strAddress1.'">
<input type="hidden" name="address2" value="'.$strAddress2.'">
<input type="hidden" name="address3" value="'.$strAddress3.'">
<input type="hidden" name="town" value="'.$strTown.'">
<input type="hidden" name="postcode" value="'.$strPostcode.'">
<input type="hidden" name="tel" value="'.$strTel.'">
<input type="hidden" name="email" value="'.$strEmail.'">
<input type="hidden" name="country" value="'.$strCountry.'">

<input type="hidden" name="currency" value="GBP">
<input type="hidden" name="Lang" value="en">
<input type="hidden" name="paymentType" value="'.$strPaymentType.'">
<input type="submit" value=" Make Payment ">
</form>
<script type="text/javascript">
(function ($) {
	
jQuery(document).ready(function() {

document.forms["redirect-form"].submit();

});

}(jQuery));
	
</script>

';


	return $strContent;
}



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
													<input type="radio" tabindex="4" name="payment_method" value="MSCD" />
												</label>
											</div>
										</li>
										<li class="col-2-12">
											<div class="fix-2-12">
												<label class="payment-select">
													<img src="'.plugin_dir_url( __FILE__ ).'images/payment-mastercard-debit.png" class="payment-icon" />
													<input type="radio" tabindex="5" name="payment_method" value="DMC" />
												</label>
											</div>
										</li>
										<li class="col-2-12">
											<div class="fix-2-12">
												<label class="payment-select">
													<img src="'.plugin_dir_url( __FILE__ ).'images/payment-maestro.png" class="payment-icon" />
													<input type="radio" tabindex="6" name="payment_method" value="MAES" />
												</label>
											</div>
										</li>
										<li class="col-2-12">
											<div class="fix-2-12">
												<label class="payment-select">
													<img src="'.plugin_dir_url( __FILE__ ).'images/payment-visa.png" class="payment-icon" />
													<input type="radio" tabindex="7" name="payment_method" value="VISA" />
												</label>
											</div>
										</li>
										<li class="col-2-12">
											<div class="fix-2-12">
												<label class="payment-select">
													<img src="'.plugin_dir_url( __FILE__ ).'images/payment-visa-debit.png" class="payment-icon" />
													<input type="radio" tabindex="8" name="payment_method" value="VISD" />
												</label>
											</div>
										</li>
										<li class="col-2-12">
											<div class="fix-2-12">
												<label class="payment-select">
													<img src="'.plugin_dir_url( __FILE__ ).'images/payment-visa-electron.png" class="payment-icon" />
													<input type="radio" tabindex="9" name="payment_method" value="VIED" />
												</label>
											</div>
										</li>

								</ul>	
								


							<h2 class="gbp">Billing details</h2>
							<h3>Fields marked with a <span style="color: #ff0000;">*</span> are mandatory</h3>

						
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
								<span>Address line 3</span>
								<input type="text" tabindex="23" name="pp_address_line_3" />
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
								<select name="pp_country" class="pp-select-country" tabindex="26">
									<option value="">Choose your country.</option>
									<option value="AF">Afghanistan</option>
									<option value="AX">Aland Islands</option>
									<option value="AL">Albania</option>
									<option value="DZ">Algeria</option>
									<option value="AS">American Samoa</option>
									<option value="AD">Andorra</option>
									<option value="AO">Angola</option>
									<option value="AI">Anguilla</option>
									<option value="AQ">Antarctica</option>
									<option value="AG">Antigua and Barbuda</option>
									<option value="AR">Argentina</option>
									<option value="AM">Armenia</option>
									<option value="AW">Aruba</option>
									<option value="AU">Australia</option>
									<option value="AT">Austria</option>
									<option value="AZ">Azerbaijan</option>
									<option value="BS">Bahamas</option>
									<option value="BH">Bahrain</option>
									<option value="BD">Bangladesh</option>
									<option value="BB">Barbados</option>
									<option value="BY">Belarus</option>
									<option value="BE">Belgium</option>
									<option value="BZ">Belize</option>
									<option value="BJ">Benin</option>
									<option value="BM">Bermuda</option>
									<option value="BT">Bhutan</option>
									<option value="BO">Bolivia</option>
									<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
									<option value="BA">Bosnia and Herzegovina</option>
									<option value="BW">Botswana</option>
									<option value="BV">Bouvet Island</option>
									<option value="BR">Brazil</option>
									<option value="IO">British Indian Ocean Territory</option>
									<option value="BN">Brunei Darussalam</option>
									<option value="BG">Bulgaria</option>
									<option value="BF">Burkina Faso</option>
									<option value="BI">Burundi</option>
									<option value="KH">Cambodia</option>
									<option value="CM">Cameroon</option>
									<option value="CA">Canada</option>
									<option value="CV">Cape Verde</option>
									<option value="KY">Cayman Islands</option>
									<option value="CF">Central African Republic</option>
									<option value="TD">Chad</option>
									<option value="CL">Chile</option>
									<option value="CN">China</option>
									<option value="CX">Christmas Island</option>
									<option value="CC">Cocos (Keeling) Islands</option>
									<option value="CO">Colombia</option>
									<option value="KM">Comoros</option>
									<option value="CG">Congo</option>
									<option value="CK">Cook Islands</option>
									<option value="CR">Costa Rica</option>
									<option value="HR">Croatia</option>
									<option value="CU">Cuba</option>
									<option value="CW">Curacao</option>
									<option value="CY">Cyprus</option>
									<option value="CZ">Czech Republic</option>
									<option value="CI">Côte d\'Ivoire</option>
									<option value="DK">Denmark</option>
									<option value="DJ">Djibouti</option>
									<option value="DM">Dominica</option>
									<option value="DO">Dominican Republic</option>
									<option value="EC">Ecuador</option>
									<option value="EG">Egypt</option>
									<option value="SV">El salvador</option>
									<option value="GQ">Equatorial Guinea</option>
									<option value="ER">Eritrea</option>
									<option value="EE">Estonia</option>
									<option value="ET">Ethiopia</option>
									<option value="FK">Falkland Islands</option>
									<option value="FO">Faroe Islands</option>
									<option value="FJ">Fiji</option>
									<option value="FI">Finland</option>
									<option value="FR">France</option>
									<option value="GF">French Guiana</option>
									<option value="PF">French Polynesia</option>
									<option value="TF">French Southern Territories</option>
									<option value="GA">Gabon</option>
									<option value="GM">Gambia</option>
									<option value="GE">Georgia</option>
									<option value="DE">Germany</option>
									<option value="GH">Ghana</option>
									<option value="GI">Gibraltar</option>
									<option value="GR">Greece</option>
									<option value="GL">Greenland</option>
									<option value="GD">Grenada</option>
									<option value="GP">Guadeloupe</option>
									<option value="GU">Guam</option>
									<option value="GT">Guatemala</option>
									<option value="GG">Guernsey</option>
									<option value="GN">Guinea</option>
									<option value="GW">Guinea-Bissau</option>
									<option value="GY">Guyana</option>
									<option value="HT">Haiti</option>
									<option value="HM">Heard Island and McDonald Islands</option>
									<option value="VA">Holy See (Vatican City State)</option>
									<option value="HN">Honduras</option>
									<option value="HK">Hong Kong</option>
									<option value="HU">Hungary</option>
									<option value="IS">Iceland</option>
									<option value="IN">India</option>
									<option value="ID">Indonesia</option>
									<option value="IR">Iran</option>
									<option value="IQ">Iraq</option>
									<option value="IE">Ireland</option>
									<option value="IM">Isle of Man</option>
									<option value="IL">Israel</option>
									<option value="IT">Italy</option>
									<option value="JM">Jamaica</option>
									<option value="JP">Japan</option>
									<option value="JE">Jersey</option>
									<option value="JO">Jordan</option>
									<option value="KZ">Kazakhstan</option>
									<option value="KE">Kenya</option>
									<option value="KI">Kiribati</option>
									<option value="KS">Kosovo</option>
									<option value="KW">Kuwait</option>
									<option value="KG">Kyrgyzstan</option>
									<option value="LA">Lao</option>
									<option value="LV">Latvia</option>
									<option value="LB">Lebanon</option>
									<option value="LS">Lesotho</option>
									<option value="LR">Liberia</option>
									<option value="LY">Libyan Arab Jamahiriya</option>
									<option value="LI">Liechtenstein</option>
									<option value="LT">Lithuania</option>
									<option value="LU">Luxembourg</option>
									<option value="MO">Macau</option>
									<option value="MK">Macedonia (FYR)</option>
									<option value="MG">Madagascar</option>
									<option value="MW">Malawi</option>
									<option value="MY">Malaysia</option>
									<option value="MV">Maldives</option>
									<option value="ML">Mali</option>
									<option value="MT">Malta</option>
									<option value="MH">Marshall Islands</option>
									<option value="MQ">Martinique</option>
									<option value="MR">Mauritania</option>
									<option value="MU">Mauritius</option>
									<option value="YT">Mayotte</option>
									<option value="MX">Mexico</option>
									<option value="FM">Micronesia</option>
									<option value="MD">Moldova</option>
									<option value="MC">Monaco</option>
									<option value="MN">Mongolia</option>
									<option value="ME">Montenegro</option>
									<option value="MS">Montserrat</option>
									<option value="MA">Morocco</option>
									<option value="MZ">Mozambique</option>
									<option value="MM">Myanmar</option>
									<option value="NA">Namibia</option>
									<option value="NR">Nauru</option>
									<option value="NP">Nepal</option>
									<option value="NL">Netherlands</option>
									<option value="NC">New Caledonia</option>
									<option value="NZ">New Zealand</option>
									<option value="NI">Nicaragua</option>
									<option value="NE">Niger</option>
									<option value="NG">Nigeria</option>
									<option value="NU">Niue</option>
									<option value="NF">Norfolk Island</option>
									<option value="KP">North Korea</option>
									<option value="MP">Northern Mariana Islands</option>
									<option value="NO">Norway</option>
									<option value="OM">Oman</option>
									<option value="PK">Pakistan</option>
									<option value="PW">Palau</option>
									<option value="PS">Palestinian Territory Occupied</option>
									<option value="PA">Panama</option>
									<option value="PG">Papua New Guinea</option>
									<option value="PY">Paraguay</option>
									<option value="PE">Peru</option>
									<option value="PH">Philippines</option>
									<option value="PN">Pitcairn</option>
									<option value="PL">Poland</option>
									<option value="PT">Portugal</option>
									<option value="PR">Puerto Rico</option>
									<option value="QA">Qatar</option>
									<option value="RE">Reunion</option>
									<option value="RO">Romania</option>
									<option value="RU">Russian Federation</option>
									<option value="RW">Rwanda</option>
									<option value="BL">Saint Barthelemy</option>
									<option value="SH">Saint Helena</option>
									<option value="KN">Saint Kitts and Nevis</option>
									<option value="LC">Saint Lucia</option>
									<option value="MF">Saint Martin (French)</option>
									<option value="PM">Saint Pierre and Miquelon</option>
									<option value="VC">Saint Vincent and the Grenadines</option>
									<option value="WS">Samoa</option>
									<option value="SM">San Marino</option>
									<option value="ST">Sao Tome and Principe</option>
									<option value="SA">Saudi Arabia</option>
									<option value="SN">Senegal</option>
									<option value="RS">Serbia</option>
									<option value="SC">Seychelles</option>
									<option value="SL">Sierra Leone</option>
									<option value="SG">Singapore</option>
									<option value="SX">Sint Maarten (Dutch)</option>
									<option value="SK">Slovakia</option>
									<option value="SI">Slovenia</option>
									<option value="SB">Solomon Islands</option>
									<option value="SO">Somalia</option>
									<option value="ZA">South Africa</option>
									<option value="GS">South Georgia</option>
									<option value="KR">South Korea</option>
									<option value="ES">Spain</option>
									<option value="LK">Sri Lanka</option>
									<option value="SD">Sudan</option>
									<option value="SR">Suriname</option>
									<option value="SJ">Svalbard and Jan Mayen Islands</option>
									<option value="SZ">Swaziland</option>
									<option value="SE">Sweden</option>
									<option value="CH">Switzerland</option>
									<option value="SY">Syria</option>
									<option value="TW">Taiwan</option>
									<option value="TJ">Tajikistan</option>
									<option value="TZ">Tanzania</option>
									<option value="TH">Thailand</option>
									<option value="CD">The Democratic Republic of the Congo</option>
									<option value="TL">Timor-Leste</option>
									<option value="TG">Togo</option>
									<option value="TK">Tokelau</option>
									<option value="TO">Tonga</option>
									<option value="TT">Trinidad and Tobago</option>
									<option value="TN">Tunisia</option>
									<option value="TR">Turkey</option>
									<option value="TM">Turkmenistan</option>
									<option value="TC">Turks and Caicos Islands</option>
									<option value="TV">Tuvalu</option>
									<option value="UG">Uganda</option>
									<option value="UA">Ukraine</option>
									<option value="AE">United Arab Emirates</option>
									<option value="GB" selected="selected">United Kingdom</option>
									<option value="US">United States</option>
									<option value="UM">United States Minor Outlying Islands</option>
									<option value="UY">Uruguay</option>
									<option value="UZ">Uzbekistan</option>
									<option value="VU">Vanuatu</option>
									<option value="VE">Venezuela</option>
									<option value="VN">Viet Nam</option>
									<option value="VG">Virgin Islands (British)</option>
									<option value="VI">Virgin Islands (U.S.)</option>
									<option value="WF">Wallis and Futuna Islands</option>
									<option value="EH">Western Sahara</option>
									<option value="YE">Yemen</option>
									<option value="ZM">Zambia</option>
									<option value="ZW">Zimbabwe</option>
								</select>

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
								<input type="radio" tabindex="27" name="pp_informed_by" value="mail" />
								By email
							</label>
							<label>
								<input type="radio" tabindex="28" name="pp_informed_by" value="post" />
								By post
							</label>
							<input type="hidden" name="pp_worldpay_send" value="true" />
							<input type="submit" tabindex="29" name="send" value="Make payment" />
	
						
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
		</form>	
	';
	
	
	$strContent .= '<script src="'.plugin_dir_url( __FILE__ ).'js/script.js"></script>';

	return $strContent;
}
