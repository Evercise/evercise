@if(isset($notification))
	<div class="notification-msg">{{ $notification }}</div>
@endif
@if ($notification = Session::get('notification'))
	<div class="notification-msg">{{ $notification }}</div>
@endif

@if(isset($errorNotification))
	<div class="notification-msg">{{ $errorNotification }}</div>
@endif
@if ($errorNotification = Session::get('errorNotification'))
	<div class="notification-msg-error">{{ $errorNotification }}</div>
@endif



@if(isset($trackSocial) || Session::get('trackSocial'))
	<script src="//platform.twitter.com/oct.js" type="text/javascript"></script>
    <script type="text/javascript">
    twttr.conversion.trackPid('l53jb');</script>
    <noscript>
    <img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=l53jb&p_id=Twitter" />
    <img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l53jb&p_id=Twitter" /></noscript>​
    Facebook:

    <!-- Facebook Conversion Code for Trainer Enquiries -->
    <script>(function() {
      var _fbq = window._fbq || (window._fbq = []);
      if (!_fbq.loaded) {
        var fbds = document.createElement('script');
        fbds.async = true;
        fbds.src = '//connect.facebook.net/en_US/fbds.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(fbds, s);
        _fbq.loaded = true;
      }
    })();
    window._fbq = window._fbq || [];
    window._fbq.push(['track', '6015475418008', {'value':'0.00','currency':'GBP'}]);
    </script>
    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6015475418008&amp;cd[value]=0.00&amp;cd[currency]=GBP&amp;noscript=1" /></noscript>​

@endif