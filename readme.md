# Ecommvu ProductEmail v0.0.1

# Introduction:

This package is implements a feature which enables you to send product email to customer directly from product's datagrid via admin panel.

# Features of ProductEmail module:

* Select products from datagrid and email to customers.
* Easy installation.
* Instant support.

# Requirements:

* Bagisto v0.1.7 or higher.

# Installation:

* Inside packages directory make another directory 'Ecommvu'.

* Inside the directory 'Ecommvu' make another directory 'ProductEmail'.

* Copy content of this repo inside 'ProductEmail' directory.

* Do entry in composer.json in psr-4 object:

```
"Ecommvu\\ProductEmail\\": "packages/Ecommvu/ProductEmail/src"
```

* Do entry in config/app.php, inside providers array preferably at the end of it:

```
Ecommvu\ProductEmail\Providers\ProductEmailServiceProvider::class
```

* Run command below:

1. composer dump-autoload
> Proceed if there are no errors encountered

2. php artisan route:cache

> Hurrah, you are all set to use the module just goto admin panel -> catalog -> products.
