<?php

  //set headers to NOT cache a page
  header("private, must-revalidate, max-age=1");
  header("Expires: -1");

?>