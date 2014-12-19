
@if(getenv('TRACKING_ACTIVE'))
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-W9FJFT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W9FJFT');</script>
<!-- End Google Tag Manager -->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '{{ getenv('GA_CODE') }}', 'auto');
  ga('send', 'pageview');


@if(!empty($track_cart) && !empty($cart))

    ga('require', 'ecommerce');
    ga('ecommerce:addTransaction', {
      'id': '{{ $transaction }}',                     // Transaction ID. Required.
      'affiliation': 'Evercise',   // Affiliation or store name.
      'revenue': '{{ round(($cart['total']['final_cost'] + $cart['total']['from_wallet']) , 2) }}',               // Grand Total.
      'shipping': '0',                  // Shipping.
      'tax': '0',                     // Tax.
      'currency': 'GBP'
    });

    @foreach($cart['packages'] as $row)
    ga('ecommerce:addItem', {
      'id': '{{ $transaction }}',                     // Transaction ID. Required.
      'name': '{{ $row['name'] }}',    // Product name. Required.
      'sku': '{{ EverciseCart::toProductCode('package', $row['id']) }}',                 // SKU/code.
      'category': 'Package',         // Category or variation.
      'price': '{{ round($row['price'],2) }}',                 // Unit price.
      'quantity': '1'
    });
    @endforeach

    @foreach($cart['sessions_grouped'] as $row)
    ga('ecommerce:addItem', {
      'id': '{{ $transaction }}',                     // Transaction ID. Required.
      'name': '{{ $row['name'] }}',    // Product name. Required.
      'sku': '{{ EverciseCart::toProductCode('session', $row['id']) }}',                 // SKU/code.
      'category': 'Session',         // Category or variation.
      'price': '{{ round($row['price'],2) }}',                 // Unit price.
      'quantity': '{{ $row['qty'] }}'
    });
    @endforeach

    ga('ecommerce:send');


@endif

  function removeEvents() {
  	document.body.removeEventListener('click', sendInteractionEvent);
  	window.removeEventListener('scroll', sendInteractionEvent);
  }

  function sendInteractionEvent() {
  	ga('send', 'event', 'Page Interaction');
  	removeEvents();
  }

 // document.body.addEventListener('click', sendInteractionEvent);
  window.addEventListener('scroll', sendInteractionEvent);

</script>




<script type="text/javascript">
   var _mfq = _mfq || [];
   (function() {
       var mf = document.createElement("script"); mf.type = "text/javascript"; mf.async = true;
       mf.src = "//cdn.mouseflow.com/projects/c0202bf2-270c-42d5-9231-3d03589665ab.js";
       document.getElementsByTagName("head")[0].appendChild(mf);
   })();
</script>
<!-- begin olark code -->
<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
f[z]=function(){
(a.s=a.s||[]).push(arguments)};var a=f[z]._={
},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
0:+new Date};a.P=function(u){
a.p[u]=new Date-a.p[0]};function s(){
a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
b.contentWindow[g].open()}catch(w){
c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('4020-649-10-3648');/*]]>*/</script><noscript><a href="https://www.olark.com/site/4020-649-10-3648/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
<!-- end olark code -->


@endif