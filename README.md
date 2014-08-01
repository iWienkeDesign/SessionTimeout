SessionTimeout
==============

This code is intended to help people that are having problems with Redirecting on Session Timeout. 

There are three steps to this code. 

Create a last_activity column in your Users Table


```php 
  $table->timestamp('last_activity');

```

Whereever you are login the user in, you will also need to update that database table when they login 


```php
$now = new DateTime(); 
$user->last_activity = $now;
$user->save(); 

```

In your filters.php in the App::before section you will need to place the code from SessionTimeout.php 


