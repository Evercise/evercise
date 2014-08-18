#Laravel LiveLogger
==================================================
## Evercise Setup

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