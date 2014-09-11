<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

Artisan::add(new CheckSessions);
Artisan::add(new CheckPayments);
Artisan::add(new SendEmails);
Artisan::add(new SalesForce);
Artisan::add(new IndexerCreate);
Artisan::add(new IndexerIndex);

