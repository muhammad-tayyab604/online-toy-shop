@extends('layouts.app')
@section('content')
@section('title', 'Home')
<style>
    .work-sans {
        font-family: 'Work Sans', sans-serif;
    }

    #menu-toggle:checked+#menu {
        display: block;
    }

    .hover\:grow {
        transition: all 0.3s;
        transform: scale(1);
    }

    .hover\:grow:hover {
        transform: scale(1.02);
    }

    .carousel-open:checked+.carousel-item {
        position: static;
        opacity: 100;
    }

    .carousel-item {
        -webkit-transition: opacity 0.6s ease-out;
        transition: opacity 0.6s ease-out;
    }

    #carousel-1:checked~.control-1,
    #carousel-2:checked~.control-2,
    #carousel-3:checked~.control-3 {
        display: block;
    }

    .carousel-indicators {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        bottom: 2%;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 10;
    }

    #carousel-1:checked~.control-1~.carousel-indicators li:nth-child(1) .carousel-bullet,
    #carousel-2:checked~.control-2~.carousel-indicators li:nth-child(2) .carousel-bullet,
    #carousel-3:checked~.control-3~.carousel-indicators li:nth-child(3) .carousel-bullet {
        color: #000;
        /*Set to match the Tailwind colour you want the active one to be */
    }

    .modal {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.816);
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
        width: 30rem;
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

<body class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">



    <div class="carousel relative container mx-auto" style="max-width:1600px;">
        <div class="carousel-inner relative overflow-hidden w-full">
            <!--Slide 1-->
            <input class="carousel-open hidden" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden
                checked="checked">
            <div class="carousel-item absolute opacity-0 bg-cover bg-right" style="height:50vh;">
                @if ($firstToy)
                    @php
                        $imagearray = explode(',', $firstToy->toy_image);
                    @endphp
                    <div class="h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right"
                        style="background-image: url('{{ asset($imagearray[0]) }}')">
                        <div class="container mx-auto">
                            <div
                                class="bg-white opacity-75 absolute bottom-0 left-0 w-full h-40 flex items-center justify-start">
                                <div
                                    class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                                    <p class="text-black text-2xl my-2">{{ $firstToy->toyName }}</p>
                                    <p class="text-black text-2xl">RS. {{ number_format($firstToy->price, 0, '.', '') }}
                                    </p>
                                    <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black"
                                        href="{{ route('checkout', $firstToy->id) }}">view product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right"
                        style="background-image: url('{{ asset('/images/stayTuned.png') }}')">
                        <div class="container mx-auto">
                        </div>
                    </div>
                @endif
            </div>
            <label for="carousel-3"
                class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-2"
                class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

            <!--Slide 2-->
            <input class="carousel-open hidden" type="radio" id="carousel-2" name="carousel" aria-hidden="true"
                hidden="">
            <div class="carousel-item absolute opacity-0 bg-cover bg-right" style="height:50vh;">
                @if ($secondToy)
                    @php
                        $imagearray = explode(',', $secondToy->toy_image);
                    @endphp
                    <div class="h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right"
                        style="background-image: url('{{ asset($imagearray[0]) }}')">
                        <div class="container mx-auto">
                            <div
                                class="bg-white opacity-75 absolute bottom-0 left-0 w-full h-40 flex items-center justify-start">
                                <div
                                    class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                                    <p class="text-black text-2xl my-2">{{ $secondToy->toyName }}</p>
                                    <p class="text-black text-2xl">RS.
                                        {{ number_format($secondToy->price, 0, '.', '') }}</p>
                                    <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black"
                                        href="{{ route('checkout', $secondToy->id) }}">view product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right"
                        style="background-image: url('{{ asset('/images/commingSoon.png') }}')">
                        <div class="container mx-auto">
                        </div>
                    </div>
                @endif
            </div>

            <label for="carousel-1"
                class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-3"
                class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

            <!--Slide 3-->
            <input class="carousel-open hidden" type="radio" id="carousel-3" name="carousel" aria-hidden="true"
                hidden="">

            <div class="carousel-item absolute opacity-0 bg-cover bg-right" style="height:50vh;">
                @if ($thirdToy)
                    @php
                        $imagearray = explode(',', $thirdToy->toy_image);
                    @endphp
                    <div class="h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right"
                        style="background-image: url('{{ asset($imagearray[0]) }}')">
                        <div class="container mx-auto">
                            <div
                                class="bg-white opacity-75 absolute bottom-0 left-0 w-full h-40 flex items-center justify-start">
                                <div
                                    class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                                    <p class="text-black text-2xl my-2">{{ $thirdToy->toyName }}</p>
                                    <p class="text-black text-2xl">RS.
                                        {{ number_format($thirdToy->price, 0, '.', '') }}</p>
                                    <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black"
                                        href="{{ route('checkout', $thirdToy->id) }}">view product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="h-full w-full mx-auto flex pt-6 md:pt-0 md:items-center bg-cover bg-right"
                        style="background-image: url('{{ asset('/images/commingSoon.png') }}')">
                        <div class="container mx-auto">
                        </div>
                    </div>
                @endif
            </div>

            <label for="carousel-2"
                class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
            <label for="carousel-1"
                class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900  leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>

            <!-- Add additional indicators for each slide-->
            <ol class="carousel-indicators">
                <li class="inline-block mr-3">
                    <label for="carousel-1"
                        class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                </li>
                <li class="inline-block mr-3">
                    <label for="carousel-2"
                        class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                </li>
                <li class="inline-block mr-3">
                    <label for="carousel-3"
                        class="carousel-bullet cursor-pointer block text-4xl text-gray-400 hover:text-gray-900">•</label>
                </li>
            </ol>
        </div>
    </div>

    <section class="bg-white py-8">
        <div class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h1 class="text-xl font-bold">Search For Toys</h1>
                <hr>
                <form action="{{ route('search.toys') }}" method="GET">
                    <input name="query" class="border-gray-400 h-8 rounded-md mt-4 outline-none"
                        placeholder="E.g. Nerf Gun" type="text">
                    <button type="submit"
                        class="bg-gray-500 px-10 py-1 ml-3 rounded-md hover:bg-gray-600 text-white duration-75">Search</button>
                </form>
            </div>
        </div>


        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">

            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl "
                        href="{{ route('home') }}">
                        Store
                    </a>

                    <div class="flex items-center" id="store-nav-content">

                        <button class="trigger pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                            </svg>
                        </button>

                    </div>
                </div>
            </nav>
            @if ($noToysFound)
                <div class="h-full w-screen flex justify-center items-center flex-col">
                    <p class="text-xl text-center p-5 text-gray-500 font-bold ">No toys available for the search term
                        "{{ $query }}"</p>
                    <a href="{{ route('home') }}" class="text-xl text-blue-500 hover:text-blue-600 duration-75">Back
                        To Home</a>
                </div>
            @endif
            @foreach ($toys as $toy)
                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <a href="{{ route('checkout', $toy->id) }}">
                        @php
                            $imagearray = explode(',', $toy->toy_image);
                        @endphp
                        <img class="hover:grow hover:shadow-lg" src="{{ asset($imagearray[0]) }}">
                    </a>
                    <div class="pt-3 flex items-center justify-between">
                        <p class="">{{ $toy->toyName }}</p>
                        <a href="{{ route('checkout', $toy->id) }}"
                            class="flex items-center justify-center px-8 py-1 text-blue-500 border border-blue-500 rounded-md dark:text-gray-200 dark:border-blue-600 hover:bg-blue-600 hover:border-blue-600 hover:text-gray-100 dark:bg-blue-600 dark:hover:bg-blue-700 dark:hover:border-blue-700 dark:hover:text-gray-300">Checkout</a>
                    </div>
                    <p class="pt-1 text-gray-900">RS. {{ number_format($toy->price, 0, '.', '') }}</p>

                </div>
            @endforeach


        </div>

    </section>

    <script>
        const modal = document.querySelector(".modal");
        const trigger = document.querySelector(".trigger");
        const closeButton = document.querySelector(".close-button");

        function toggleModal() {
            modal.classList.toggle("show-modal");
        }

        function windowOnClick(event) {
            if (event.target === modal) {
                toggleModal();
            }
        }

        trigger.addEventListener("click", toggleModal);
        closeButton.addEventListener("click", toggleModal);
        window.addEventListener("click", windowOnClick);
    </script>
</body>
@endsection
