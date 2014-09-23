<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Evercise</title>

<style type="text/css">


@font-face{
	font-family:'UniversLTStd59UltraCondensed';
	src:url('/fonts/universltstd-ultracn.eot');
	src:url('/fonts/universltstd-ultracn.eot') format('embedded-opentype'),
		url('/fonts/universltstd-ultracn.woff') format('woff'),
		url('/fonts/universltstd-ultracn.ttf') format('truetype'),
		url('/fonts/universltstd-ultracn.svg#UniversLTStd59UltraCondensed') format('svg')
	}


body { width:100%; height: auto; margin: 0 auto; padding:0; background: #F0F0F0; }
h1, h2,h3,h4,h5 { font-family:'UniversLTStd59UltraCondensed', arial, helvetica, sans-serif; color: #3B3D48; }

.main_container { width: 1040px; height: 100%; margin: 0 auto; }
.inner_container { width: 1040px; height: auto; float: left; background: #FFFFFF; }
.hero { width: 1040px; height: 537px; float: left; background: url(/img/trainerlanding/hero.png);}
.logo { width: 298px; height: 28px; float: left; margin: 38px 0px 0px 80px; background: url(/img/trainerlanding/logo.png) no-repeat; }
h1.messaging { width:1040px; font-family:'UniversLTStd59UltraCondensed'; font-size:59px; text-align: center; color: #FFFFFF; float: left; padding: 180px 0 0 0; }
.cta_container { width: 1040px; height:90px; float: left; background: #FFD01A; text-align: center;}
.col1 { width: 400px; height: auto; float: left; margin: 70px 0px 0px 80px; }
.col2 { width: 400px; height: auto; float: left; margin: 70px 0px 0px 80px; }
h1 { width:100%; font-family:'UniversLTStd59UltraCondensed', arial, helvetica, sans-serif; font-size:36px; text-align: center; color: #3B3D48; float: left; padding: 0px 0 0 0; }
h1.popup{text-align: left}
a {font-family: arial, helvetica, sans-serif; font-size: 16px; text-align: left; }
p { font-family: arial, helvetica, sans-serif; font-size: 16px; line-height: 28px; text-align: left; color: #768690;  }

.col3 { width: 439px; height: auto; float: left; margin: 50px 0px 0px 80px; border-right: 1px solid #EAEAEB; border-bottom: 1px solid #EAEAEB; padding: 30px 0 50px 0; }
.col4 { width: 440px; height: auto; float: left; margin: 50px 0px 0px 0px; padding: 30px 0 50px 0; border-bottom: 1px solid #EAEAEB; }
.col5 { width: 439px; height: auto; float: left; margin: 0px 0px 0px 80px; clear: left; padding: 30px 0 50px 0; }
.col6 { width: 440px; height: auto; float: left; margin: 0px 0px 0px 0px; border-left: 1px solid #EAEAEB;  padding: 30px 0 50px 0; }

.footer { width: 1040px; height: 90px; border-top: 1px solid #EAEAEB; float: left; margin-top: 50px; }

.cta_container{position: relative}
/*.cta_container .site_button{position:absolute; left:50%; padding-left:200px; color:#4288CE; top:40%; text-decoration: none; color:#000}*/
.site_button{font-size:16px; text-decoration: none; color:#a7a7a9;font-weight: normal}
.site_button:hover{text-decoration: underline}


.myButton {margin-top:20px;-moz-box-shadow:inset 0px 1px 0px 0px #000000;-webkit-box-shadow:inset 0px 1px 0px 0px #000000;box-shadow:inset 0px 1px 0px 0px #000000;
background-color:#313232;-moz-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;border:1px solid #01090f;display:inline-block;cursor:pointer;color:#ffffff;font-family:arial;font-size:17px;padding:16px 30px;text-decoration:none;text-shadow:0px 1px 0px #000000;
}
.myButton:hover {background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #000305), color-stop(1, #02070a));background:-moz-linear-gradient(top, #000305 5%, #02070a 100%);background:-webkit-linear-gradient(top, #000305 5%, #02070a 100%);background:-o-linear-gradient(top, #000305 5%, #02070a 100%);background:-ms-linear-gradient(top, #000305 5%, #02070a 100%);background:linear-gradient(to bottom, #000305 5%, #02070a 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#000305', endColorstr='#02070a',GradientType=0);background-color:#000305;
}
.myButton:active {position:relative;top:1px;
}
.clear{clear:both}
#inline p {margin:0}
#inline label{width:100%; font-weight: bold; font-size:12px}
#inline input{width:100%;padding:5px}
label.error{color:#cc581e}
</style>


<link href="/css/jquery.fancybox.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="/js/jquery.fancybox.pack.js"></script>


<script type="text/javascript">

$(function() {
	$(".various").fancybox({
		maxWidth	: 720,
		maxHeight	: 600,
		fitToView	: true,
		width		: '720px',
		height		: '80%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});


        // Setup form validation on the #register-form element
        $("#contact").validate({

            // Specify the validation rules
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                profession: "required",
                location: "required"
            },

            // Specify the validation error messages
            messages: {
                name: "Please enter your name",
                email: "Please enter a valid email address",
                profession: "Please enter your profession",
                location: "Please enter a valid location"
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
});
</script>


</head>

<body>

<div class="main_container">
    <div class="inner_container">
			<div class="hero">
				<div class="logo"><a border="0" href="http://www.evercise.com"><img src="/img/trainerlanding/logo.png" width="298" height="28"/></a></div>
				<h1 class="messaging">
					{{ getenv('EVERCISE_TRAINER_MESSAGE') ?: 'REVOLUTIONARY MARKETING TOOL FOR FITNESS INDUSTRY' }} <br/>
			    <a href="http://www.evercise.com" class="site_button" target="_blank">Go to Evercise.com</a>
				</h1>
			</div>
			<div class="cta_container">
			    <a href="#inline" class="various myButton center">Make an Inquiry</a>
			</div>
			<div class="col1">
				<h1>WHAT IS EVERCISE?</h1>
				<p>Evercise is an exciting new platform designed to help trainers maximise promotional reach, fill classes and generate more income. It’s quick to join, easy to manage and absolutely FREE.<p>
				<p>From Aerobics to Zumba, whatever your specialism Evercise will connect you to a growing community of eager participants.</p>
				<p>Evercise is here to lead a fitness revolution and we want YOU to be part of it.</p>
				<p>Evercise makes it easier for trainers to fill classes and helps everyone to discover fun new ways to keep fit.</p>
			</div>
			<div class="col2">
				<h1>WHY JOIN EVERCISE?</h1>
				<p>Our platform gives users a simple, intuitive way to search for Evercise registered classes and personal trainers in their area. Then, once they’ve found you, our simple Pay As You Go booking system ensures that joining your class is as quick and easy as ordering a pizza!</p>
				<p>Evercise can help you to realise your potential as a professional trainer by improving your promotional reach and simplifying your booking process.</p>
				<p>Signing up as an Evercise trainer is quick and free. Simply leave your details below and we’ll get in touch as soon as possible.</p>
			</div>
			<br class="clear"/>

			<div class="col3">
				<img style="display:block; margin:auto auto;" src="/img/trainerlanding/empty.png"  width="300" height="300" alt="empty classes"/>
				<h1>CAN FILL EMPTY CLASSES</h1>
			</div>

			<div class="col4">
				<img style="display:block; margin:auto auto;" src="/img/trainerlanding/income.png" width="300" height="300" alt="empty classes"/>
				<h1>INCREASE YOUR INCOME</h1>
			</div>

			<div class="col5">
				<img style="display:block; margin:auto auto;" src="/img/trainerlanding/globe.png" width="300" height="300" alt="empty classes"/>
				<h1>GLOBAL ACCESS TO PROFILE</h1>
			</div>

			<div class="col6">
				<img style="display:block; margin:auto auto;" src="/img/trainerlanding/free.png" width="300" height="300" alt="empty classes"/>
				<h1>&amp; IT’S ABSOLUTELY FREE</h1>
			</div>

			<div class="footer"></div>



		</div>
</div>




<div id="inline" style="display:none;width:700px;">
			<h1 class="popup">Instructors / Gym or Studio managers</h1>
            <p>Contact us today and one of Evercise team will be in touch with you shortly.</p>
            <form method="post" id="contact" action="{{ URL::route('landing.trainerinquery.post') }}">
			<p>
			    <label>First and last name *</label>
			    <input type="text" name="name"/>
			</p>
			<p>
			    <label>Telephone *</label>
			    <input type="text" name="phone"/>
			</p>
			<p>
			    <label>Email *</label>
			    <input type="text" name="email"/>
			</p>
			<p>
			    <label>Profession *</label>
			    <input type="text" name="profession" placeholder="Example: Yoga Instructor, Personal Trainer or Dance Academy"/>
			</p>
			<p>
			    <label>City/Town *</label>
			    <input type="text" name="location"/>
			</p>
			<p>
			    <label>Website (optional)</label>
			    <input type="text" name="website"/>
			</p>
			<p>
				<input type="submit" value="Submit details" class="myButton" style="width:150px; float:right;"/>
			</p></form>
</div>


</body>

</html>