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
Artisan::add(new SendExtraEmails);
Artisan::add(new SalesForceCommand);
Artisan::add(new IndexerCreate);
Artisan::add(new IndexerIndex);
Artisan::add(new IndexerImport);
Artisan::add(new IndexerGeo);
Artisan::add(new ConvertImages);
Artisan::add(new GenerateUrls);
Artisan::add(new GalleryImport);
Artisan::add(new FixImages);
Artisan::add(new FixDisplayNames);
Artisan::add(new UpdateUserNewsletter);
Artisan::add(new FixLocation);



