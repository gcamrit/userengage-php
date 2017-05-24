# userengage-php

# Usage

```php

$userEngage = new \Gc\UserEngage\UserEngage('API_KEY');

```
## Create User
```php
$user = new \Gc\UserEngage\Request\CreateUser;
$user->setFirstName('Amrit');
$user->setLastName('G.C');
$user->setEmail('mytestemail@gmail.com');

$userEngage->user()->create($user);

```
