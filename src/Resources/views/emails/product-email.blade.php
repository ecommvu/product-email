<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('themes/default/assets/css/shop.css') }}">
    </head>

    <body style="font-family: montserrat, sans-serif;">
        <div class="main-container-wrapper">
            <div class="container" style="max-width: 1000px; margin-left: auto; margin-right: auto;">
                <div>
                    <a href="{{ config('app.url') }}" style="font-size: 16px; color:#242424; font-weight:600; text-decoration: none;">
                        {{ \Company::getCurrent()->name }}
                    </a>
                </div>

                <div style="margin-top: 60px;">
                    {{ $context['intro_text'] }}
                </div>

                <div class="row" style="display: flex; flex-direction: row; margin-top: 40px; margin-bottom: 20px; justify-content: center; align-items: center;font-size: 22px;font-weight: bold;">
                   {{ $context['product_headline'] }}
                </div>

                <div class="product-grid-4" style="display: table; ">
                    @inject ('productImageHelper', 'Webkul\Product\Helpers\ProductImage')

                    @foreach($context['products'] as $key => $product)
                        <div class="product-card" style="display:table-cell;width: 25%;padding:10px;">
                            <?php $productBaseImage = $productImageHelper->getProductBaseImage($product); ?>

                            <div class="product-image">
                                <a href="{{ route('shop.products.index', $product->url_key) }}" title="{{ $product->name }}">
                                    <img src="{{ $productBaseImage['medium_image_url'] }}" onerror="this.src='{{ asset('vendor/webkul/ui/assets/images/product/meduim-product-placeholder.png') }}'"/>
                                </a>
                            </div>

                            <div class="product-information">
                                <div class="product-name">
                                    <a href="{{ url()->to('/').'/products/' . $product->url_key }}" title="{{ $product->name }}">
                                        <span>
                                            {{ $product->name }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>