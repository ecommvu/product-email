@extends('admin::layouts.content')

@section('page_title')
    {{ __('productemail::design email') }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('send.product.email') }}" @submit.prevent="onSubmit">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('productemail::app.design email') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('productemail::app.send') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

                    @php
                        $customerGroups = app('Webkul\Customer\Repositories\CustomerGroupRepository');

                        $customerGroups = $customerGroups->all();
                    @endphp

                    <input type="hidden" name="products" value="{{ $data['products'] }}">

                    <div class="control-group" :class="[errors.has('customer_groups') ? 'has-error' : '']">
                        <label for="customer_groups" class="required">{{ __('productemail::app.cgs') }}:</label>

                        <select class="control" name="customer_groups[]" v-validate="'required'" data-vv-as="{{ __('productemail::app.cgs') }}" multiple>
                            @foreach($customerGroups as $key => $value)
                                <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                            @endforeach
                        </select>

                        <span class="control-error" v-if="errors.has('customer_groups[]')">@{{ errors.first('customer_groups[]') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('news_letter_subscribers') ? 'has-error' : '']">
                        <label for="name" class="required">{{ __('productemail::app.subs') }}</label>

                        <select class="control" name="news_letter_subscribers" data-vv-as="{{ __('productemail::app.subs') }}">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>

                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('subject') ? 'has-error' : '']">
                        <label for="subject" class="required">{{ __('productemail::app.subj') }}</label>

                        <input class="control" type="text" name="subject" v-validate="'required'" data-vv-as="{{ __('productemail::app.subj') }}" placeholder="{{ __('productemail::app.subj') }}">

                        <span class="control-error" v-if="errors.has('subject')">@{{ errors.first('subject') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('intro_text') ? 'has-error' : '']">
                        <label for="intro_text" class="required">{{ __('productemail::app.intro') }}:</label>

                        <textarea class="control" type="text" name="intro_text" v-validate="'required'" placeholder="{{ __('productemail::app.intro') }}" data-vv-as="{{ __('productemail::app.intro') }}"></textarea>

                        <span class="control-error" v-if="errors.has('intro_text')">@{{ errors.first('intro_text') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('product_headline') ? 'has-error' : '']">
                        <label for="product_headline" class="required">Headline before products:</label>

                        <input class="control" type="text" name="product_headline" v-validate="'required'" placeholder="Product headline">

                        <span class="control-error" v-if="errors.has('product_headline')">@{{ errors.first('product_headline') }}</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop