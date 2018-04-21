# UserEngage Php 

# Usage

```php

$userEngage = new \Gc\UserEngage\UserEngage('API_KEY');

```
## Create User
```php

$userEngage->user()->create([
  "first_name": "Amrit",
  "last_name": "G.C"
  "email": "myemail@example.org",
]);

```
## Find User Detail

```php
$userEngage->user()->findByEmail('mytestemail@gmail.com');
$userEngage->user()->findByKey('7Q2VclcuKp7o');
$userEngage->user()->findById('123');
$userEngage->user()->findByPhoneNumber('9847463745');
```

## Delete User Detail
```php
$userEngage->user()->delete($userId);
```
