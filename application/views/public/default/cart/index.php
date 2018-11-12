<?php
    /**
     * Created by PhpStorm.
     * User: Steven Nguyen
     * Date: 01/07/2018
     * Time: 3:41 CH
     */
    defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Main Container -->
<section class="main-container col1-layout">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <article class="col-main">
                    <div class="cart">
                        <div class="page-title">
                            <h2>Shopping Cart</h2>
                        </div>
                        <div class="table-responsive">
                            <?php echo form_open('cart/update'); ?>
                                <fieldset>
                                    <table class="data-table cart-table" id="shopping-cart-table">
                                        <colgroup>
                                            <col width="1">
                                            <col>
                                            <col width="1">
                                            <col width="1">
                                            <col width="1">
                                            <col width="1">
                                            <col width="1">
                                        </colgroup>
                                        <thead>
                                        <tr class="first last">
                                            <th rowspan="1">&nbsp;</th>
                                            <th rowspan="1"><span class="nobr">Tên sản phẩm</span></th>
                                            <th rowspan="1"></th>
                                            <th class="a-center" colspan="1"><span class="nobr">Giá</span></th>
                                            <th class="a-center" rowspan="1">Số lượng</th>
                                            <th class="a-center" colspan="1">Tổng cộng</th>
                                            <th class="a-center" rowspan="1">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr class="first last">
                                            <td class="a-right last" colspan="50"><button title="Continue Shopping" class="button btn-continue" onclick="setLocation('#')" type="button"><span>Continue Shopping</span></button>
                                                <button name="update_cart_action" title="Update Cart" class="button btn-update" type="submit" value="update_qty"><span>Update Cart</span></button>
                                                <button name="update_cart_action" title="Clear Cart" class="button btn-empty" id="empty_cart_button" type="submit" value="empty_cart"><span>Clear Cart</span></button></td>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                            if(!empty($this->cart->contents())) foreach ($this->cart->contents() as $key => $item):
                                        ?>
                                        <tr class="first odd">
                                            <td class="image">
                                                <a title="Sample Product" class="<?php echo $item['name'] ?>" href="<?php echo getUrlProduct(array('slug'=>$item['slug'],'id'=>$item['id'])) ?>">
                                                    <img width="75" alt="Sample Product" src="<?php echo getImageThumb($item['image'],75,80,true) ?>">
                                                </a>
                                            </td>
                                            <td>
                                                <h2 class="product-name">
                                                    <a href="<?php echo getUrlProduct(array('slug'=>$item['slug'],'id'=>$item['id'])) ?>"><?php echo $item['name'] ?></a>
                                                </h2>
                                            </td>
                                            <td class="a-center">
                                                <a title="Edit item parameters" class="edit-bnt" href="#"></a>
                                            </td>
                                            <td class="a-right"><span class="cart-price"> <span class="price"><?php echo number_format($item['price']) ?> đ</span> </span></td>
                                            <td class="a-center movewishlist"><input name="cart[<?php echo $key ?>][qty]" title="Qty" class="input-text qty" size="4" maxlength="12" value="1"></td>
                                            <td class="a-right movewishlist"><span class="cart-price"> <span class="price"><?php echo number_format($item['subtotal']) ?> đ</span> </span></td>
                                            <td class="a-center last"><a title="Remove item" class="button remove-item" href="#"><span><span>Remove item</span></span></a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </form>
                        </div>
                        <!-- BEGIN CART COLLATERALS -->
                        <div class="cart-collaterals row">
                            <div class="col-sm-4">
                                <div class="shipping">
                                    <h3>Estimate Shipping and Tax</h3>
                                    <div class="shipping-form">
                                        <form id="shipping-zip-form" action="#estimatePost/" method="post">
                                            <p>Enter your destination to get a shipping estimate.</p>
                                            <ul class="form-list">
                                                <li>
                                                    <label class="required" for="country"><em>*</em>Country</label>
                                                    <div class="input-box">
                                                        <select name="country_id" title="Country" class="validate-select" id="country">
                                                            <option value=""> </option>
                                                            <option value="AF">Afghanistan</option>
                                                            <option value="AX">Åland Islands</option>
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
                                                            <option value="BA">Bosnia and Herzegovina</option>
                                                            <option value="BW">Botswana</option>
                                                            <option value="BV">Bouvet Island</option>
                                                            <option value="BR">Brazil</option>
                                                            <option value="IO">British Indian Ocean Territory</option>
                                                            <option value="VG">British Virgin Islands</option>
                                                            <option value="BN">Brunei</option>
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
                                                            <option value="CC">Cocos [Keeling] Islands</option>
                                                            <option value="CO">Colombia</option>
                                                            <option value="KM">Comoros</option>
                                                            <option value="CG">Congo - Brazzaville</option>
                                                            <option value="CD">Congo - Kinshasa</option>
                                                            <option value="CK">Cook Islands</option>
                                                            <option value="CR">Costa Rica</option>
                                                            <option value="CI">Côte d’Ivoire</option>
                                                            <option value="HR">Croatia</option>
                                                            <option value="CU">Cuba</option>
                                                            <option value="CY">Cyprus</option>
                                                            <option value="CZ">Czech Republic</option>
                                                            <option value="DK">Denmark</option>
                                                            <option value="DJ">Djibouti</option>
                                                            <option value="DM">Dominica</option>
                                                            <option value="DO">Dominican Republic</option>
                                                            <option value="EC">Ecuador</option>
                                                            <option value="EG">Egypt</option>
                                                            <option value="SV">El Salvador</option>
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
                                                            <option value="HN">Honduras</option>
                                                            <option value="HK">Hong Kong SAR China</option>
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
                                                            <option value="KW">Kuwait</option>
                                                            <option value="KG">Kyrgyzstan</option>
                                                            <option value="LA">Laos</option>
                                                            <option value="LV">Latvia</option>
                                                            <option value="LB">Lebanon</option>
                                                            <option value="LS">Lesotho</option>
                                                            <option value="LR">Liberia</option>
                                                            <option value="LY">Libya</option>
                                                            <option value="LI">Liechtenstein</option>
                                                            <option value="LT">Lithuania</option>
                                                            <option value="LU">Luxembourg</option>
                                                            <option value="MO">Macau SAR China</option>
                                                            <option value="MK">Macedonia</option>
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
                                                            <option value="MM">Myanmar [Burma]</option>
                                                            <option value="NA">Namibia</option>
                                                            <option value="NR">Nauru</option>
                                                            <option value="NP">Nepal</option>
                                                            <option value="NL">Netherlands</option>
                                                            <option value="AN">Netherlands Antilles</option>
                                                            <option value="NC">New Caledonia</option>
                                                            <option value="NZ">New Zealand</option>
                                                            <option value="NI">Nicaragua</option>
                                                            <option value="NE">Niger</option>
                                                            <option value="NG">Nigeria</option>
                                                            <option value="NU">Niue</option>
                                                            <option value="NF">Norfolk Island</option>
                                                            <option value="MP">Northern Mariana Islands</option>
                                                            <option value="KP">North Korea</option>
                                                            <option value="NO">Norway</option>
                                                            <option value="OM">Oman</option>
                                                            <option value="PK">Pakistan</option>
                                                            <option value="PW">Palau</option>
                                                            <option value="PS">Palestinian Territories</option>
                                                            <option value="PA">Panama</option>
                                                            <option value="PG">Papua New Guinea</option>
                                                            <option value="PY">Paraguay</option>
                                                            <option value="PE">Peru</option>
                                                            <option value="PH">Philippines</option>
                                                            <option value="PN">Pitcairn Islands</option>
                                                            <option value="PL">Poland</option>
                                                            <option value="PT">Portugal</option>
                                                            <option value="PR">Puerto Rico</option>
                                                            <option value="QA">Qatar</option>
                                                            <option value="RE">Réunion</option>
                                                            <option value="RO">Romania</option>
                                                            <option value="RU">Russia</option>
                                                            <option value="RW">Rwanda</option>
                                                            <option value="BL">Saint Barthélemy</option>
                                                            <option value="SH">Saint Helena</option>
                                                            <option value="KN">Saint Kitts and Nevis</option>
                                                            <option value="LC">Saint Lucia</option>
                                                            <option value="MF">Saint Martin</option>
                                                            <option value="PM">Saint Pierre and Miquelon</option>
                                                            <option value="VC">Saint Vincent and the Grenadines</option>
                                                            <option value="WS">Samoa</option>
                                                            <option value="SM">San Marino</option>
                                                            <option value="ST">São Tomé and Príncipe</option>
                                                            <option value="SA">Saudi Arabia</option>
                                                            <option value="SN">Senegal</option>
                                                            <option value="RS">Serbia</option>
                                                            <option value="SC">Seychelles</option>
                                                            <option value="SL">Sierra Leone</option>
                                                            <option value="SG">Singapore</option>
                                                            <option value="SK">Slovakia</option>
                                                            <option value="SI">Slovenia</option>
                                                            <option value="SB">Solomon Islands</option>
                                                            <option value="SO">Somalia</option>
                                                            <option value="ZA">South Africa</option>
                                                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                            <option value="KR">South Korea</option>
                                                            <option value="ES">Spain</option>
                                                            <option value="LK">Sri Lanka</option>
                                                            <option value="SD">Sudan</option>
                                                            <option value="SR">Suriname</option>
                                                            <option value="SJ">Svalbard and Jan Mayen</option>
                                                            <option value="SZ">Swaziland</option>
                                                            <option value="SE">Sweden</option>
                                                            <option value="CH">Switzerland</option>
                                                            <option value="SY">Syria</option>
                                                            <option value="TW">Taiwan</option>
                                                            <option value="TJ">Tajikistan</option>
                                                            <option value="TZ">Tanzania</option>
                                                            <option value="TH">Thailand</option>
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
                                                            <option value="GB">United Kingdom</option>
                                                            <option selected="selected" value="US">United States</option>
                                                            <option value="UY">Uruguay</option>
                                                            <option value="UM">U.S. Minor Outlying Islands</option>
                                                            <option value="VI">U.S. Virgin Islands</option>
                                                            <option value="UZ">Uzbekistan</option>
                                                            <option value="VU">Vanuatu</option>
                                                            <option value="VA">Vatican City</option>
                                                            <option value="VE">Venezuela</option>
                                                            <option value="VN">Vietnam</option>
                                                            <option value="WF">Wallis and Futuna</option>
                                                            <option value="EH">Western Sahara</option>
                                                            <option value="YE">Yemen</option>
                                                            <option value="ZM">Zambia</option>
                                                            <option value="ZW">Zimbabwe</option>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li>
                                                    <label for="region_id">State/Province</label>
                                                    <div class="input-box">
                                                        <select name="region_id" title="State/Province" class="required-entry validate-select" id="region_id" defaultvalue="">
                                                            <option value="">Please select region, state or province</option>
                                                            <option title="Alabama" value="1">Alabama</option>
                                                            <option title="Alaska" value="2">Alaska</option>
                                                            <option title="American Samoa" value="3">American Samoa</option>
                                                            <option title="Arizona" value="4">Arizona</option>
                                                            <option title="Arkansas" value="5">Arkansas</option>
                                                            <option title="Armed Forces Africa" value="6">Armed Forces Africa</option>
                                                            <option title="Armed Forces Americas" value="7">Armed Forces Americas</option>
                                                            <option title="Armed Forces Canada" value="8">Armed Forces Canada</option>
                                                            <option title="Armed Forces Europe" value="9">Armed Forces Europe</option>
                                                            <option title="Armed Forces Middle East" value="10">Armed Forces Middle East</option>
                                                            <option title="Armed Forces Pacific" value="11">Armed Forces Pacific</option>
                                                            <option title="California" value="12">California</option>
                                                            <option title="Colorado" value="13">Colorado</option>
                                                            <option title="Connecticut" value="14">Connecticut</option>
                                                            <option title="Delaware" value="15">Delaware</option>
                                                            <option title="District of Columbia" value="16">District of Columbia</option>
                                                            <option title="Federated States Of Micronesia" value="17">Federated States Of Micronesia</option>
                                                            <option title="Florida" value="18">Florida</option>
                                                            <option title="Georgia" value="19">Georgia</option>
                                                            <option title="Guam" value="20">Guam</option>
                                                            <option title="Hawaii" value="21">Hawaii</option>
                                                            <option title="Idaho" value="22">Idaho</option>
                                                            <option title="Illinois" value="23">Illinois</option>
                                                            <option title="Indiana" value="24">Indiana</option>
                                                            <option title="Iowa" value="25">Iowa</option>
                                                            <option title="Kansas" value="26">Kansas</option>
                                                            <option title="Kentucky" value="27">Kentucky</option>
                                                            <option title="Louisiana" value="28">Louisiana</option>
                                                            <option title="Maine" value="29">Maine</option>
                                                            <option title="Marshall Islands" value="30">Marshall Islands</option>
                                                            <option title="Maryland" value="31">Maryland</option>
                                                            <option title="Massachusetts" value="32">Massachusetts</option>
                                                            <option title="Michigan" value="33">Michigan</option>
                                                            <option title="Minnesota" value="34">Minnesota</option>
                                                            <option title="Mississippi" value="35">Mississippi</option>
                                                            <option title="Missouri" value="36">Missouri</option>
                                                            <option title="Montana" value="37">Montana</option>
                                                            <option title="Nebraska" value="38">Nebraska</option>
                                                            <option title="Nevada" value="39">Nevada</option>
                                                            <option title="New Hampshire" value="40">New Hampshire</option>
                                                            <option title="New Jersey" value="41">New Jersey</option>
                                                            <option title="New Mexico" value="42">New Mexico</option>
                                                            <option title="New York" value="43">New York</option>
                                                            <option title="North Carolina" value="44">North Carolina</option>
                                                            <option title="North Dakota" value="45">North Dakota</option>
                                                            <option title="Northern Mariana Islands" value="46">Northern Mariana Islands</option>
                                                            <option title="Ohio" value="47">Ohio</option>
                                                            <option title="Oklahoma" value="48">Oklahoma</option>
                                                            <option title="Oregon" value="49">Oregon</option>
                                                            <option title="Palau" value="50">Palau</option>
                                                            <option title="Pennsylvania" value="51">Pennsylvania</option>
                                                            <option title="Puerto Rico" value="52">Puerto Rico</option>
                                                            <option title="Rhode Island" value="53">Rhode Island</option>
                                                            <option title="South Carolina" value="54">South Carolina</option>
                                                            <option title="South Dakota" value="55">South Dakota</option>
                                                            <option title="Tennessee" value="56">Tennessee</option>
                                                            <option title="Texas" value="57">Texas</option>
                                                            <option title="Utah" value="58">Utah</option>
                                                            <option title="Vermont" value="59">Vermont</option>
                                                            <option title="Virgin Islands" value="60">Virgin Islands</option>
                                                            <option title="Virginia" value="61">Virginia</option>
                                                            <option title="Washington" value="62">Washington</option>
                                                            <option title="West Virginia" value="63">West Virginia</option>
                                                            <option title="Wisconsin" value="64">Wisconsin</option>
                                                            <option title="Wyoming" value="65">Wyoming</option>
                                                        </select>
                                                        <input name="region" title="State/Province" class="input-text required-entry" id="region" style="display: none;" type="text" value="">
                                                    </div>
                                                </li>
                                                <li>
                                                    <label for="postcode">Zip/Postal Code</label>
                                                    <div class="input-box">
                                                        <input name="estimate_postcode" class="input-text validate-postcode" id="postcode" type="text" value="">
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="buttons-set11">
                                                <button title="Get a Quote" class="button get-quote" onclick="coShippingMethodForm.submit()" type="button"><span>Get a Quote</span></button>
                                            </div>
                                            <!--buttons-set11-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="discount">
                                    <h3>Discount Codes</h3>
                                    <form id="discount-coupon-form" action="#couponPost/" method="post">
                                        <label for="coupon_code">Enter your coupon code if you have one.</label>
                                        <input name="remove" id="remove-coupone" type="hidden" value="0">
                                        <input name="coupon_code" class="input-text fullwidth" id="coupon_code" type="text" value="">
                                        <button title="Apply Coupon" class="button coupon " onclick="discountForm.submit(false)" type="button" value="Apply Coupon"><span>Apply Coupon</span></button>
                                    </form>
                                </div>
                            </div>
                            <div class="totals col-sm-4">
                                <h3>Shopping Cart Total</h3>
                                <div class="inner">
                                    <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                                        <colgroup>
                                            <col>
                                            <col width="1">
                                        </colgroup>
                                        <tfoot>
                                        <tr>
                                            <td class="a-left" colspan="1"><strong>Grand Total</strong></td>
                                            <td class="a-right"><strong><span class="price">$77.38</span></strong></td>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <tr>
                                            <td class="a-left" colspan="1"> Subtotal </td>
                                            <td class="a-right"><span class="price">$77.38</span></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <ul class="checkout">
                                        <li>
                                            <button title="Proceed to Checkout" class="button btn-proceed-checkout" type="button"><span>Proceed to Checkout</span></button>
                                        </li>
                                        <br>
                                        <li><a title="Checkout with Multiple Addresses" href="multiple_addresses.html">Checkout with Multiple Addresses</a> </li>
                                        <br>
                                    </ul>
                                </div>
                                <!--inner-->

                            </div>
                        </div>

                        <!--cart-collaterals-->
                        <div class="crosssel">
                            <div class="new_title">
                                <h2>you may be interested</h2>
                            </div>
                            <div class="category-products">
                                <ul class="products-grid">
                                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info"> <a title="Retis lapen casen" class="product-image" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product10.jpg"> </a>
                                                    <div class="box-hover">
                                                        <ul class="add-to-links">
                                                            <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                            <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                            <li><a class="link-compare" href="compare.html"></a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="info-inner">
                                                    <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                    <div class="item-content">
                                                        <div class="rating">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div class="rating" style="width: 80%;"></div>
                                                                </div>
                                                                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                            </div>
                                                        </div>
                                                        <div class="item-price">
                                                            <div class="price-box"> <span class="regular-price"> <span class="price">$155.00</span> </span> </div>
                                                        </div>
                                                        <div class="action">
                                                            <button title="" class="button btn-cart" type="button" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info"> <a title="Retis lapen casen" class="product-image" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product1.jpg"> </a>
                                                    <div class="box-hover">
                                                        <ul class="add-to-links">
                                                            <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                            <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                            <li><a class="link-compare" href="compare.html"></a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="info-inner">
                                                    <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                    <div class="item-content">
                                                        <div class="rating">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div class="rating" style="width: 80%;"></div>
                                                                </div>
                                                                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                            </div>
                                                        </div>
                                                        <div class="item-price">
                                                            <div class="price-box"> <span class="regular-price"> <span class="price">$225.00</span> </span> </div>
                                                        </div>
                                                        <div class="action">
                                                            <button title="" class="button btn-cart" type="button" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info"> <a title="Retis lapen casen" class="product-image" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product2.jpg"> </a>
                                                    <div class="box-hover">
                                                        <ul class="add-to-links">
                                                            <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                            <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                            <li><a class="link-compare" href="compare.html"></a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="info-inner">
                                                    <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                    <div class="item-content">
                                                        <div class="rating">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div class="rating" style="width: 80%;"></div>
                                                                </div>
                                                                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                            </div>
                                                        </div>
                                                        <div class="item-price">
                                                            <div class="price-box"> <span class="regular-price"> <span class="price">$99.00</span> </span> </div>
                                                        </div>
                                                        <div class="action">
                                                            <button title="" class="button btn-cart" type="button" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                        <div class="item-inner">
                                            <div class="item-img">
                                                <div class="item-img-info"> <a title="Retis lapen casen" class="product-image" href="product_detail.html"> <img alt="Retis lapen casen" src="products-images/product3.jpg"> </a>
                                                    <div class="new-label new-top-left">new</div>
                                                    <div class="box-hover">
                                                        <ul class="add-to-links">
                                                            <li><a class="link-quickview" href="quick_view.html"></a> </li>
                                                            <li><a class="link-wishlist" href="wishlist.html"></a> </li>
                                                            <li><a class="link-compare" href="compare.html"></a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info">
                                                <div class="info-inner">
                                                    <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html"> Retis lapen casen </a> </div>
                                                    <div class="item-content">
                                                        <div class="rating">
                                                            <div class="ratings">
                                                                <div class="rating-box">
                                                                    <div class="rating" style="width: 80%;"></div>
                                                                </div>
                                                                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                                                            </div>
                                                        </div>
                                                        <div class="item-price">
                                                            <div class="price-box">
                                                                <p class="special-price"> <span class="price-label">Special Price</span> <span class="price"> $156.00 </span> </p>
                                                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> $167.00 </span> </p>
                                                            </div>
                                                        </div>
                                                        <div class="action">
                                                            <button title="" class="button btn-cart" type="button" data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </article>
                <!--	///*///======    End article  ========= //*/// -->
            </div>

        </div>
    </div>
</section>
<!-- Main Container End -->

