RatingView 
==========

It is a simple example widget application to inject a rating widget in other website with few lines of html code.

For now it is only provide a rating widget that you can use only with add the follow lines on your html code:

```shell
<script src="http://{ratingviewdomainOrIPAddress}/widget/{{USER_UUID}}.js"></script>
```

Getting Started with RatingView
--------------------

### Installing Prerequisites
-  Mysql
-  Php 5.5 >=
-  Composer
-  Git.

Now you are ready to install the **RatingView**.

### Installing **RatingView**

```shell
    cd rating

    composer install

    #Creating database (Read Note section)
    php bin/console doctrine:schema:create
```

### Running **RatingView**

```shell

 php bin/console server:run
```
Now you can see **RatingView** at <http://localhost:8000>. Whoa! That was fast!

### Note:
On the project folder you can find a sql script called rating_test.sql for testing propose with phpunit and normal user.



