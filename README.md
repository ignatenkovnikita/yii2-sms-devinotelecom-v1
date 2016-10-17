Yii2 SMS Devino Telecom Client V1
=================================
Yii2 SMS Devino Telecom Client V1

Documentation on official suite [doc](http://devino-documentation.readthedocs.io/httpapi.html)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ignatenkovnikita/yii2-sms-devinotelecom-v1 "*"
```

or add

```
"ignatenkovnikita/yii2-sms-devinotelecom-v1": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
    'sms' => array(
    'class' => \ignatenkovnikita\devinotelecomsms\Client::className(),
    'from' =>  your_text,
    'login' => your_login,
    'password' => your_password,
),
```

TODO
----
Add other method
 - change sms send, add sendDate & validity
 - send sms by timezone
 - sms send to many number
 - state send sms
 - get sms on perion
 - get stat sms sending
 - add error code