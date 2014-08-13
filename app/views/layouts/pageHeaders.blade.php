<?php

  //set headers to NOT cache a page
 /* header("must-revalidate");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
*/
   header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>