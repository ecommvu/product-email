<?php

Route::post('prepare/email/products', 'Ecommvu\ProductEmail\Http\Controllers\ProductEmailController@index')->defaults('_config', [
    'view' => 'productemail::prepare-email'
])->name('product.email.prepare');

Route::post('send/email/products', 'Ecommvu\ProductEmail\Http\Controllers\ProductEmailController@createEmailJob')->defaults('_config' , [
    'redirect' => 'admin.catalog.products.index'
])->name('send.product.email');