                    <div class="row">
                        <div class="col-md-6">
                            <form id="wizard_validation" novalidate>
                                <div id="wizard_form" class="wizard clearfix">
                                    <h3>Personal Info</h3>
                                    <section>
                                        <div class="form-group">
                                            <label for="wizard_fname" class="req">First Name</label>
                                            <input type="text" class="form-control" id="wizard_fname" name="wizard_fname" data-parsley-required="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="wizard_lname" class="req">Last Name</label>
                                            <input type="text" class="form-control" id="wizard_lname" name="wizard_lname" data-parsley-required="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="wizard_email" class="req">Email</label>
                                            <input type="text" class="form-control" id="wizard_email" name="wizard_email" data-parsley-required="true" data-parsley-type="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="wizard_pass" class="req">Password</label>
                                            <input type="password" class="form-control" id="wizard_pass" name="wizard_pass" data-parsley-required="true" data-parsley-minlength="6">
                                                <span class="help-block">Min 6 characters</span>
                                        </div>
                                    </section>
                                    <h3>Contact Information</h3>
                                    <section>
                                        <div class="form-group">
                                            <label for="wizard_address" class="req">Address</label>
                                            <input type="text" class="form-control" id="wizard_address" name="wizard_address" data-parsley-required="true">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <label for="wizard_city">City</label>
                                                    <input type="text" class="form-control" id="wizard_city" name="wizard_city">
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="wizard_zip">Zip Code</label>
                                                    <input type="text" class="form-control" id="wizard_zip" name="wizard_zip">
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="s2_country" class="req">Country</label>
                                                    <select id="s2_country" class="form-control" name="wizard_country" data-parsley-required="true" data-parsley-trigger="change">
                                                        <option value=""></option>
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
                                                        <option value="BO">Bolivia, Plurinational State of</option>
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
                                                        <option value="CD">Congo, the Democratic Republic of the</option>
                                                        <option value="CK">Cook Islands</option>
                                                        <option value="CR">Costa Rica</option>
                                                        <option value="CI">Côte d'Ivoire</option>
                                                        <option value="HR">Croatia</option>
                                                        <option value="CU">Cuba</option>
                                                        <option value="CW">Curaçao</option>
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
                                                        <option value="FK">Falkland Islands (Malvinas)</option>
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
                                                        <option value="IR">Iran, Islamic Republic of</option>
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
                                                        <option value="KP">Korea, Democratic People's Republic of</option>
                                                        <option value="KR">Korea, Republic of</option>
                                                        <option value="KW">Kuwait</option>
                                                        <option value="KG">Kyrgyzstan</option>
                                                        <option value="LA">Lao People's Democratic Republic</option>
                                                        <option value="LV">Latvia</option>
                                                        <option value="LB">Lebanon</option>
                                                        <option value="LS">Lesotho</option>
                                                        <option value="LR">Liberia</option>
                                                        <option value="LY">Libya</option>
                                                        <option value="LI">Liechtenstein</option>
                                                        <option value="LT">Lithuania</option>
                                                        <option value="LU">Luxembourg</option>
                                                        <option value="MO">Macao</option>
                                                        <option value="MK">Macedonia, the former Yugoslav Republic of</option>
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
                                                        <option value="FM">Micronesia, Federated States of</option>
                                                        <option value="MD">Moldova, Republic of</option>
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
                                                        <option value="MP">Northern Mariana Islands</option>
                                                        <option value="NO">Norway</option>
                                                        <option value="OM">Oman</option>
                                                        <option value="PK">Pakistan</option>
                                                        <option value="PW">Palau</option>
                                                        <option value="PS">Palestinian Territory, Occupied</option>
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
                                                        <option value="RE">Réunion</option>
                                                        <option value="RO">Romania</option>
                                                        <option value="RU">Russian Federation</option>
                                                        <option value="RW">Rwanda</option>
                                                        <option value="BL">Saint Barthélemy</option>
                                                        <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                        <option value="KN">Saint Kitts and Nevis</option>
                                                        <option value="LC">Saint Lucia</option>
                                                        <option value="MF">Saint Martin (French part)</option>
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
                                                        <option value="SX">Sint Maarten (Dutch part)</option>
                                                        <option value="SK">Slovakia</option>
                                                        <option value="SI">Slovenia</option>
                                                        <option value="SB">Solomon Islands</option>
                                                        <option value="SO">Somalia</option>
                                                        <option value="ZA">South Africa</option>
                                                        <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                        <option value="SS">South Sudan</option>
                                                        <option value="ES">Spain</option>
                                                        <option value="LK">Sri Lanka</option>
                                                        <option value="SD">Sudan</option>
                                                        <option value="SR">Suriname</option>
                                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                                        <option value="SZ">Swaziland</option>
                                                        <option value="SE">Sweden</option>
                                                        <option value="CH">Switzerland</option>
                                                        <option value="SY">Syrian Arab Republic</option>
                                                        <option value="TW">Taiwan, Province of China</option>
                                                        <option value="TJ">Tajikistan</option>
                                                        <option value="TZ">Tanzania, United Republic of</option>
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
                                                        <option value="US">United States</option>
                                                        <option value="UM">United States Minor Outlying Islands</option>
                                                        <option value="UY">Uruguay</option>
                                                        <option value="UZ">Uzbekistan</option>
                                                        <option value="VU">Vanuatu</option>
                                                        <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                        <option value="VN">Viet Nam</option>
                                                        <option value="VG">Virgin Islands, British</option>
                                                        <option value="VI">Virgin Islands, U.S.</option>
                                                        <option value="WF">Wallis and Futuna</option>
                                                        <option value="EH">Western Sahara</option>
                                                        <option value="YE">Yemen</option>
                                                        <option value="ZM">Zambia</option>
                                                        <option value="ZW">Zimbabwe</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h3>Aditional info</h3>
                                    <section>
                                        <div class="form-group">
                                            <label for="s2_languages" class="req">Languages</label>
                                            <input id="s2_languages" class="form-control" name="wizard_languages" data-parsley-required="true" data-parsley-trigger="change">
                                        </div>
                                        <div class="form-group">
                                            <h5>Terms & Conditions</h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus minima tempore odio quo impedit blanditiis sint quisquam perspiciatis aliquam atque quam in voluptate iste itaque quibusdam exercitationem quasi rem amet! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est officiis suscipit odit blanditiis iusto accusantium minus dolorum consequuntur perferendis! At placeat voluptatem quam praesentium facere facilis pariatur similique eos quas?</p>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" name="accept_terms" data-parsley-required="true" data-parsley-trigger="change" data-parsley-error-message="Please accept Terms & Conditions">
                                                    Accept Terms & Conditions
                                                </label>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-sep">
                            <div id="wizard_101" class="wizard clearfix">
                                <h3>Introduction</h3>
                                <section>
                                    <img src="assets/img/jQuery-Logo.png" alt="" class="pull-left" style="margin: 5px 10px 5px 0" width="140" height="36">
                                    <p>Introduced at the dawn of the web, JavaScript is a powerful and expressive language that runs inside the browser in conjunction with HTML and CSS. Based on an open standard called ECMAScript, JavaScript has quickly become the "programming language of the web." All the power of jQuery is accessed via JavaScript, so needless to say, it's an important language to learn. Having a basic knowledge of JavaScript will go a long way in understanding, structuring, and debugging your code.
                                    <br>
                                    This guide covers the foundational concepts of JavaScript, as well as frequent pitfalls developers fall into during their first foray into the language. When possible, we'll relate the JavaScript you learn here to how it's applied in jQuery.
                                    <br>
                                    If you have experience with other programming languages, good for you! If not, don't worry. We'll take it slow and teach you everything you need to know to unlock the power of jQuery with JavaScript.</p>
                                </section>
                                <h3>Running Code</h3>
                                <section>
                                    <p><strong>External</strong></p>
                                    <p>The first and recommended option is to write code in an external file (with a <code>.js</code> extension), which can then be included on our web page using an HTML <code>&lt;script&gt;</code> tag and pointing the <code>src</code> attribute to the file's location. Having JavaScript in a separate file will reduce code duplication if you want to reuse it on other pages. It will also allow the browser to cache the file on the remote client's computer, decreasing page load time.</p>
<pre class="line-numbers"><code class="language-markup">&lt;!-- Code is written in a .js file, included via the script tag src attribute. --&gt;
&lt;script src="/path/to/example.js"&gt;&lt;/script&gt;</code></pre>
                                    <br>
                                    <p><strong>Inline</strong></p>
                                    <p>The second option is to inline the code directly on the web page. This is also achieved using HTML <code>&lt;script&gt;</code> tags, but instead of pointing the <code>src</code> attribute to a file, the code is placed between the tags. While there are use cases for this option, the majority of the time it is best to keep our code in an external file as described above.</p>
<pre class="line-numbers"><code class="language-markup">&lt;!-- Embed code directly on a web page using script tags. --&gt;
&lt;script&gt;
alert( "Hello World!" );
&lt;/script&gt;</code></pre>
                                </section>
                                <h3>Syntax Basics</h3>
                                <section>
                                    <p><strong>Comments</strong></p>
                                    <p>JavaScript has support for single- and multi-line comments. Comments are ignored by the JavaScript engine and therefore have no side-effects on the outcome of the program. Use comments to document the code for other developers. Libraries like JSDoc are available to help generate project documentation pages based on commenting conventions.</p>
<pre class="line-numbers"><code class="language-markup">// Single- and multi-line comments.
// This is an example of a single-line comment.
/*
* this is an example
* of a
* multi-line
* comment.
*/</code></pre>
                                    <br>
                                    <p><strong>Variable Definition</strong></p>
                                    <p>Variables can be defined using multiple <code>var</code> statements, or in a single combined <code>var</code> statement.</p>
<pre class="line-numbers"><code class="language-markup">// This works:
var test = 1;
var test2 = function() { ... };
var test3 = test2( test );
// And so does this:
var test4 = 1,
test5 = function() { ... },
test6 = test2( test );</code></pre>
                                </section>
                            </div>
                        </div>
                    </div>
