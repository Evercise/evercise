## Evercise Setup

To set up Evercise on your local machine you need to do the following:

Duplicate Example.env.php and name it: .env.php

Edit the contents of that file to match your setup!

When done open terminal and migrate Sentry
```bash
   php artisan migrate --package=cartalyst/sentry
```


When Sentry is migrated you can migrate the rest of the DB
```bash
   php artisan migrate
```
