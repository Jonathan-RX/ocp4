Jonathan RX - Project 4
==
*Produced as part of project 4 of OpenClassroom training*

--------------
How to use
-

This code need to be deployed on an apache server, after installation it can display a site with the following features:
- Ticket sales for the Louvre museum
- Choice of a visit date with constraints by the visitor
- Collecting information from each ticket
- Setting the price according to the age of the visitor
- Cashing out the payment via Stripe
- Sending tickets by mail

--------------
Required
-

- Apache server 
- PHP 7.2 or more
- Mysql

--------------
Installation
-

The project integrates Symfony 4.2 with composer.
- [Composer](https://github.com/composer/composer)
- [Symfony 4](https://github.com/symfony/symfony/tree/4.2)

1. Clone Github repository
> git clone https://github.com/Jonathan-RX/ocp4.git .

2. Run the Composer Install command inside directory to install all dependencies
```shell
    php composer install
```

3. Modify line 27 of the .env file to indicate the parameters of your database, typically modify the user, the name of the database and the password
```php
    DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
``` 

4. Change the line 34 to indicate your setting for mail forwarding. 

*You can see an example with a generic smtp and a gmail smtp in Help, line 31 and 32*
```php
    MAILER_URL=null://localhost
```

5. Setup your database 
```shell
    php bin/console doctrine:migration:migrate
```

6. Set ticket prices by creating a single entry in the Price table
```Mysql
    INSERT INTO `price` (`regular`, `child`, `senior`, `discount`, `free`)
    VALUES (16,8,12,10,0);
```

7. Edit line 38 of the /src/Services/StripeCheckout.php file to specify your Stripe key.
```php
        \Stripe\Stripe::setApiKey('sk_Your_Stripe_API_Key');
```

8. To set the address from which tickets will be shipped, modify line 68 of the src/Services/StripeCheckout.php file
```php
            ->setFrom('your_mail@your_domain.com')
```

9. Done, now if installation success, you can now use the site to sell tickets.