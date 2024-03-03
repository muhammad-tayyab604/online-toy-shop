@extends('layouts.app')
@section('content')
@section('title', 'Checkout')
<style>
    .modal {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.773);
        backdrop-filter: blur(8px);
        z-index: 100;
        opacity: 0;
        visibility: hidden;
        transform: scale(1.1);
        transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
    }

    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 1rem 1.5rem;
        width: 24rem;
        border-radius: 0.5rem;
    }

    .close-button {
        float: right;
        width: 1.5rem;
        line-height: 1.5rem;
        text-align: center;
        cursor: pointer;
        border-radius: 0.25rem;
        background-color: lightgray;
    }

    .close-button:hover {
        background-color: darkgray;
    }

    .show-modal {
        opacity: 1;
        visibility: visible;
        transform: scale(1.0);
        transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
    }
</style>

<section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800">

    <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">

        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4 md:w-1/2">
                <div class="sticky top-0 z-50 overflow-hidden">
                    @php
                        $imageArray = explode(',', $checkout->toy_image);
                    @endphp
                    <a href="{{ route('home') }}">
                        <i class="fa-solid fa-arrow-left mb-4"></i>
                        Back
                    </a>
                    <div class="relative mb-6 lg:mb-10 lg:h-2/4">
                        <img src="{{ asset($imageArray[0]) }}" alt=""
                            class="trigger cursor-pointer object-cover w-4/5 lg:w-full h-auto" id="mainImage">
                    </div>
                    <div class="flex-wrap hidden md:flex ">
                        @foreach ($imageArray as $image)
                            <div class="w-1/2 p-2 sm:w-1/4">
                                <p onclick="showLargeImage('{{ asset($image) }}')"
                                    class="block cursor-pointer border border-blue-300 dark:border-transparent dark:hover:border-blue-300 hover:border-blue-300">
                                    <img src="{{ asset($image) }}" alt="" class="object-cover w-full lg:h-20">
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="w-full px-4 md:w-1/2 ">
                <div class="lg:pl-20">
                    <div class="mb-8 ">
                        <span class="text-lg font-medium text-rose-500 dark:text-rose-200">New</span>
                        <h2 class="max-w-xl mt-2 mb-6 text-2xl font-bold dark:text-gray-400 md:text-4xl">
                            {{ $checkout->toyName }}</h2>
                        <div class="flex items-center mb-6">

                        </div>
                        <p class="max-w-md mb-8 text-gray-700 dark:text-gray-400">
                            {{ $checkout->description }}
                        </p>
                        <p class="inline-block mb-8 text-4xl font-bold text-gray-700 dark:text-gray-400 ">
                            <span>RS. {{ number_format($checkout->price, 0, '.', '') }}</span>
                        </p>

                        <p class="text-green-600 dark:text-green-300 ">{{ $checkout->quantity }} in stock</p>
                    </div>
                    <div class="">
                        <form action="{{ route('order.details') }}" method="post">
                            @csrf
                            <input type="text" placeholder="Phone Number" class="w-full rounded "
                                name="phone_number">
                            <textarea name="address" id="" class="mt-3 w-full rounded" cols="30" rows="2"
                                placeholder="Enter Your Address"></textarea>
                            <div class="flex flex-wrap items-center -mx-4 mt-4 ">
                                <div class="w-full px-4 mb-4 lg:w-1/2 lg:mb-0">
                                    <input type="hidden" name="toy_id" value="{{ $checkout->id }}">
                                    @if ($checkout->availability === 'notAvailable')
                                        <p
                                            class="flex items-center justify-center w-full p-4 text-red-500 border border-red-500 rounded-md  hover:bg-red-600 hover:border-red-600 hover:text-gray-100 ">
                                            Not Available
                                        </p>
                                    @elseif ($checkout->availability === 'commingSoon')
                                        <p
                                            class="flex items-center justify-center w-full p-4 text-green-500 border border-green-500 rounded-md  hover:bg-green-600 hover:border-green-600 hover:text-gray-100 ">
                                            Comming Soon
                                        </p>
                                    @else
                                        <button type="submit"
                                            class="flex items-center justify-center w-full p-4 text-blue-500 border border-blue-500 rounded-md  hover:bg-blue-600 hover:border-blue-600 hover:text-gray-100 ">
                                            Order Now
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-xl mt-20 font-semibold ml-4">
            Explore Our Other Products
        </p>
        <hr class="">

        <div class="flex justify-center overflow-x-auto mt-5">
            <div class="flex flex-row space-x-4">
                @foreach ($toys->take(4) as $toy)
                    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-row">
                        <a href="{{ route('checkout', $toy->id) }}">
                            @php
                                $imagearray = explode(',', $toy->toy_image);
                            @endphp
                            <img class="hover:grow hover:shadow-lg" src="{{ asset($imagearray[0]) }}">

                            <div class="pt-3 flex items-center justify-between">
                                <p class="">{{ $toy->toyName }}</p>
                            </div>
                            <p class="pt-1 text-gray-900">RS. {{ $toy->price }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
</section>
<script>
    function showLargeImage(imageUrl) {
        // Get the main image element
        const mainImage = document.getElementById('mainImage');

        // Set the source of the main image to the clicked small image
        mainImage.src = imageUrl;
    }
</script>
@endsection
