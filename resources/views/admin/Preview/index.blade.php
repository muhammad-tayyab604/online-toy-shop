@extends('layouts.adminSideBar')
@section('content')
@section('title', 'Toy Preview')
<style>
    .modal {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
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

<body class="bg-gray-100 font-family-karla flex">


    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <div class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h1 class="text-xl font-bold underline mb-4">Confirmation!</h1>
                <p class="text-lg font-semibold">Do you want to delete this product?
                </p>
                <p class="text-lg font-semibold mb-4">This action cannot be undone!</p>
                <form action="{{ route('toy.delete', $toy->id) }}" method="post">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 text-white w-full hover:bg-red-700 text-lg font-semibold rounded-md duration-75 px-10 py-1">
                        Delete
                    </button>
                </form>
            </div>
        </div>


        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <div class=" p-4 w-full h-screen bg-white transition-transform dark:bg-gray-800" aria-hidden="false">
                    <div class="flex justify-between">
                        <div class="">
                            <h4 class="mb-1.5 leading-none text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $toy->toyName }}</h4>
                            <h5 class="mb-5 text-xl font-bold text-gray-900 dark:text-white">RS.
                                {{ number_format($toy->price, 0, '.', '') }}
                            </h5>
                        </div>
                        <a href="{{ route('admin.manageToy') }}">
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="createProductModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </a>
                    </div>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="grid grid-cols-3 gap-4 mb-4 sm:mb-5">
                        @php
                            $imageArray = explode(',', $toy->toy_image);
                        @endphp
                        @foreach ($imageArray as $image)
                            <div class="p-2 flex justify-center w-auto bg-gray-100 rounded-lg dark:bg-gray-700">

                                <img class="rounded-lg" src="{{ asset($image) }}" alt="iMac Side Image">
                            </div>
                        @endforeach
                    </div>
                    <dl class="sm:mb-5">
                        <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Description Of Toys
                        </dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $toy->description }}
                        </dd>
                    </dl>
                    <dl class="grid grid-cols-2 gap-4 mb-4">
                        <div
                            class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Quantity
                            </dt>
                            <dd class="text-gray-900">
                                <span
                                    class="bg-primary-100 text-primary-800 text-lg font-bold inline-flex items-center py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                    {{ $toy->quantity }}
                                </span>
                            </dd>
                        </div>
                        <div
                            class="p-3 bg-gray-100 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Availability</dt>
                            <dd class="text-gray-900 font-bold text-lg">
                                @if ($toy->availability === 'available')
                                    Available
                                @elseif($toy->availability === 'notAvailable')
                                    Not Available
                                @else
                                    Comming Soon
                                @endif
                            </dd>
                        </div>

                    </dl>
                    <div class="flex bottom-0 left-0 justify-center pb-4 space-x-4 w-full">
                        <a href="{{ route('edit.toy', $toy->id) }}" class="w-full">
                            <button type="button"
                                class="text-gray-100 w-full inline-flex items-center justify-center bg-[#2563eb] hover:bg-[#1e40af] focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd"
                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                Edit
                            </button>
                        </a>

                        {{-- <a href="" class="w-full"> --}}
                        <button
                            class="trigger inline-flex w-full items-center text-white justify-center bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" />
                            </svg>
                            Delete
                        </button>

                        {{-- </a> --}}
                    </div>
                </div>
            </main>
        </div>

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
