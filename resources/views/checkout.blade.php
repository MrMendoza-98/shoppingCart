@extends('layouts.frontend')

@section('content')

    <div class="container px-6 py-3 mx-auto">
        <section class="p-6 mt-4 ">
            <div class="container clearfix">
                <h2 class="text-2xl font-medium text-gray-700">Checkout</h2>
            </div>
        </section>
        <section class="section-content bg padding-y">
            <div class="container  px-6 mx-auto">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- @if (Session::has('error'))
                            <p class="alert alert-danger">{{ Session::get('error') }}</p>
                        @endif -->
                    </div>
                </div>
                <form action="{{ route('checkout.place.order') }}" method="POST" role="form">
                    @csrf
                    <div class="flex justify-center my-6">
                        <div class="flex flex-col w-full p-8 text-gray-800 ">
                            <div class="verflow-hidden bg-white shadow sm:rounded-lg">
                                <header class="px-4 py-5 sm:px-6">
                                    <h4 class="text-lg font-medium leading-6 text-gray-900">Billing Details</h4>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">details and application.</p>
                                </header>
                                <article class="border-t border-gray-200">
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                                        <div class="col form-group">
                                            <label class="text-sm font-medium text-gray-500">First name</label>
                                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="first_name">
                                        </div>
                                        <div class="col form-group">
                                            <label class="text-sm font-medium text-gray-500">Last name</label>
                                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="last_name">
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                                        <label class="text-sm font-medium text-gray-500">Address</label>
                                        <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="address">
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                                        <div class="form-group col-md-6">
                                            <label class="text-sm font-medium text-gray-500">City</label>
                                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="city">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="text-sm font-medium text-gray-500">Country</label>
                                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="country">
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                                        <div class="form-group  col-md-6">
                                            <label class="text-sm font-medium text-gray-500">Post Code</label>
                                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="post_code">
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label class="text-sm font-medium text-gray-500">Phone Number</label>
                                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="phone_number">
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                                        <label class="text-sm font-medium text-gray-500">Email Address</label>
                                        <input type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="email">
                                        <p class="mt-2 text-sm block text-gray-500">We'll never share your email with anyone else.</p>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                                        <label class="text-sm font-medium text-gray-500">Order Notes</label>
                                        <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="notes" rows="6"></textarea>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <aside class="p-8 text-gray w-full">
                            <div class="row">
                                <div class="verflow-hidden bg-white shadow sm:rounded-lg">
                                    <header class="px-4 py-5 sm:px-6">
                                        <h4 class="text-lg font-medium leading-6 text-gray-900">Your Order</h4>
                                    </header>
                                    <article class="border-t border-gray-200">
                                        <dl class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-2 sm:gap-4 sm:px-6">
                                            <dt>Total cost: ${{ \Cart::getSubTotal() }}</dt>
                                        </dl>
                                    </article>
                                </div>
                                <hr class="py-4">
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4">Place Order</button>
                            </div>
                        </aside>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection