<?php

namespace Ecommvu\ProductEmail\Http\Controllers;

use Ecommvu\ProductEmail\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Webkul\Product\Repositories\ProductRepository as Product;
use Webkul\Customer\Repositories\CustomerGroupRepository as CustomerGroup;
use Webkul\Customer\Repositories\CustomerRepository as Customer;
use Ecommvu\ProductEmail\Notifications\ProductEmailNotification;

class ProductEmailController extends Controller
{
    /**
     * To hold the route related configuration
     */
    protected $_config;

    /**
     * Holds CustomerGroupRepository class instance
     */
    protected $customerGroup;

    /**
     * Holds CustomerRepository class instance
     */
    protected $customer;

    /**
     * Holds ProductRepository class instance
     */
    protected $product;

    public function __construct(
        CustomerGroup $customerGroup,
        Customer $customer,
        Product $product
    ) {
        $this->_config = request('_config');

        $this->middleware('auth:admin');

        $this->customerGroup = $customerGroup;

        $this->customer = $customer;

        $this->product = $product;
    }

    public function index()
    {
        return view($this->_config['view'])->with('data', [
            'products' => request()->input('indexes')
        ]);
    }

    public function createEmailJob()
    {
        $this->validate(request(), [
            'customer_groups' => 'required',
            'news_letter_subscribers' => 'boolean',
            'subject' => 'required|string',
            'intro_text' => 'required|string',
            'product_headline' => 'required|string',
            'products' => 'required|string'
        ]);

        $customers = $this->customer->findWhere([
            'subscribed_to_news_letter' => 1
        ]);

        $data = request()->all();

        $products = array();

        $productIndexes = explode(',', request()->input('products'));

        foreach ($productIndexes as $productIndex) {
            $product = $this->product->find($productIndex);

            if ($product->parent_id == null) {
                array_push($products, $product);
            }
        }

        if (count($products)) {
            $data['products'] = $products;

            foreach (request()->input('customer_groups') as $key => $value) {
                $customerGroup = $this->customerGroup->find($value);

                foreach ($customerGroup->customer as $key => $customer) {
                    $data['customer_name'] = $customer->first_name . ' ' . $customer->last_name;

                    $data['customer_email'] = $customer->email;

                    try {
                        Mail::queue(new ProductEmailNotification($data));
                    } catch (\Exception $e) {
                        session()->flash('success', 'Mails cannot be sent successfully');
                    }
                }
            }
        }

        session()->flash('success', 'Mails sent successfully');

        return redirect()->route($this->_config['redirect']);
    }
}