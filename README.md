# Laravel Db Encrypter Package

This package was created to encrypt and decrypt values of Eloquent model attributes.

## Donnations
If You think this package helped You, please donate. Thank You.

https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SPYLWZ8Y5E4JE&source=url

## Key features

* Encrypt, decrypt values stored in database fields
* Using standard Laravel's Crypt service
* Easy configuration

## Installation

| Command                                             | Laravel |
|-----------------------------------------------------|---------|
| composer install betterapp/laravel-db-encrypter:^v5 | 12     |
| composer install betterapp/laravel-db-encrypter:^v4 | 11     |
| composer install betterapp/laravel-db-encrypter:^v3 | 10     |
| composer install betterapp/laravel-db-encrypter:^v2 | 9      |
| composer install betterapp/laravel-db-encrypter:^v1 | 6, 7, 8 |


## Requirements

* Laravel: 9
* PHP: 8.0 and newer

#### Database schema

Encrypted values are stored as plain text so in most cases takes up more spaces then unencrypted one.
Recommendation is to alter table column to `TEXT` type.
If you want use `VARCHAR` or `CHAR` column type still you need to check if encrypted value fit.

#### Note:
Do not worry if you have current data in your database not encrypted and added column to `$encryptable`  - they will return as is.    
On save values will be encrypted and everything will work fine.

## Installation

Via Composer command line:

```bash
$ composer require betterapp/laravel-db-encrypter
```

## Usage

1. Use the `betterapp\LaravelDbEncrypter\Traits\EncryptableDbAttribute` trait in any Eloquent model that you wish to use encryption
2. Define a `protected $encryptable` array containing a list of the encrypted attributes.

For example:

```php
    
    use betterapp\LaravelDbEncrypter\Traits\EncryptableDbAttribute;

    class Client extends Eloquent {
        use EncryptableDbAttribute;
       
        /** @var array The attributes that should be encrypted/decrypted */
        protected $encryptable = [
            'id_number', 
            'email',
        ];
    }
```

3. You can use Laravel's original $casts to cast decrypted values

### License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
