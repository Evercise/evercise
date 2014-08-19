<?php
// app/config/facebook.php

// Facebook app Config

return array(
    'appId'  => getenv('FACEBOOK_ID'),
    'secret' => getenv('FACEBOOK_SECRET')
);