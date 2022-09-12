@extends('layouts.frontend')

@section('content')
    <main class="my-8">
        <div class="container px-6 mx-auto">
            <div class="flex justify-center my-6">
                <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                    
                    <livewire:cart-list />
                </div>
                <aside class="p-8 text-gray">
                    <figure class="itemside mb-3">
                        <aside class="aside"><img src="{{ URL::asset('assets/images/pay-visa.png') }}"></aside>
                        <div class="text-wrap small text-muted">
                            Pay 84.78 AED ( Save 14.97 AED ) By using ADCB Cards
                        </div>
                    </figure>
                    <figure class="itemside mb-3">
                        <aside class="aside"> <img src="{{ URL::asset('assets/images/pay-mastercard.png') }}"> </aside>
                        <div class="text-wrap small text-muted">
                            Pay by MasterCard and Save 40%.
                            <br> Lorem ipsum dolor
                        </div>
                    </figure>
                    <hr class="py-4">
                    <a href="#" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4">Proceed To Checkout</a>
                    
                </aside>
            </div>
        </div>
    </main>
@endsection