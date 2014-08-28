# Evercise Setup
==================================================

To set up Evercise on your local machine you need to do the following:

Duplicate Example.env.php and name it: .env.php

Update composer
```bash
   composer update --prefer-dist -vvv
```

Edit the contents of that file to match your setup!

Reset your DB
```bash
   php artisan migrate:reset
```

When done open terminal and migrate Sentry
```bash
   php artisan migrate --package=cartalyst/sentry
```


When Sentry is migrated you can migrate and seed the rest of the DB
```bash
   php artisan migrate && php artisan db:seed
```

Set the correct permissions for your app (if you are in a local enviroment just 777 on it)
```bash
   chmod 777 -R app/storage/*
```

If you don't want to set 777 then just allow apache (or what ever user is running it) to be the $user:$group of the folder
```bash
   chmod apache:apache -R app/storage/*
```







# Evercise Vagrant
==================================================
## Dependencies

https://www.virtualbox.org/wiki/Downloads

http://www.vagrantup.com/downloads.html


## Setup

In you local setup first update the .env.php to look like this:

```php
return [

    'DEBUG_APP'             => true,
    'APP_URL'               => 'http://dev.evercise.com/',
    'ENCRYPTION_KEY'        => 'ozt38MwirMfb5STSJWowmnHBGUz0ziAR',
    'ASSETS_CACHE'          => true,
    //DB LIVE
    'DB_HOST'               => 'localhost',
    'DB_NAME'               => 'evercise',
    'DB_USER'               => 'root',
    'DB_PASS'               => '',
    //DB MIGRATION
    'DB_V1_HOST'            => 'localhost',
    'DB_V1_NAME'            => 'evercise_v1',
    'DB_V1_USER'            => 'root',
    'DB_V1_PASS'            => '',
    //EMAIL SETUP
    'EMAIL_DRIVER'          => 'smtp',
    'EMAIL_SMTP_HOST'       => '127.0.0.1',
    'EMAIL_SMTP_PORT'       => 1025,
    'EMAIL_FROM_ADDRESS'    => 'noreply@evercise.com',
    'EMAIL_FROM_NAME'       => 'Evercise',
    'EMAIL_SMTP_ENCRYPTION' => '',
    'EMAIL_SMTP_USERNAME'   => 'vagrant@evercise.com',
    'EMAIL_SMTP_PASSWORD'   => '',
    'EMAIL_SENDMAIL'        => '/usr/sbin/sendmail -bs',
    'EMAIL_PRETEND'         => false, //For Production Set to False
    //Facebook Data
    'FACEBOOK_ID'           => '306418789525126',
    'FACEBOOK_SECRET'       => 'd599aae625444706f9335ca10ae5f71d'

];
```

Then Run:
```bash
   vagrant up
```



When the machine boots. And you notice the page is loading slowly.

You should enable: I/O APIC

Located in the Settings/System of the Virtual Machine that you are using

![Setup](https://www.dropbox.com/s/c9v36501zoqbc35/Screen%20Shot%202014-08-27%20at%209.46.26%201.png?dl=1)

After that open your command line and go to the project root
