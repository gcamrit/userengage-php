# userengage-php

# Usage

```php

$userEngage = new \Gc\UserEngage\UserEngage('API_KEY');

```
## Create User
```php
$user = new \Gc\UserEngage\Request\CreateUser;
$user->setFirstName('Amrit'); // required
$user->setLastName('G.C');
$user->setEmail('mytestemail@gmail.com'); // required

$userEngage->user()->create($user);

```
## Find User Detail
```php
$userEngage->user()->findByEmail('mytestemail@gmail.com');
$userEngage->user()->findByKey('7Q2VclcuKp7o');
$userEngage->user()->findById('123');

```
