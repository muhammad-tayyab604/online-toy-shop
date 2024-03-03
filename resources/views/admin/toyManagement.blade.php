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

@extends('layouts.adminSideBar')
@section('content')
@section('title', 'Toy Management')

<body class="bg-gray-100 font-family-karla flex">


    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Toys Management</h1>


                <!-- Start block -->
                <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
                    <div class="mx-auto  px-4 lg:px-12">
                        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

                            <div
                                class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-end mx-4 py-4 border-t dark:border-gray-700">
                                @if (session('deleteToy'))
                                    <p class="text-red-900 text-lg font-bold">{{ session('deleteToy') }}</p>
                                @endif
                                @if (session('message'))
                                    <p class="text-green-900 text-lg font-bold">{{ session('message') }}</p>
                                @endif
                                <div
                                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                    <a href="{{ route('add.toy') }}">
                                        <button type="button" id="createProductButton"
                                            data-modal-toggle="createProductModal"
                                            class="flex items-center justify-center text-gray-100 bg-[#2563eb] hover:bg-[#1e40af] focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                            <svg class="h-3.5 w-3.5 mr-1.5 -ml-1" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                                aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                            </svg>
                                            Add Toy
                                        </button>
                                    </a>

                                </div>
                            </div>
                            @if ($toys->isEmpty())
                                <p class="text-center text-xl text-gray-500 font-bold pb-4 uppercase">Please add Toys
                                </p>
                            @else
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="p-4">
                                                    <div class="flex items-center">
                                                        <input id="checkbox-all" type="checkbox"
                                                            class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                                    </div>
                                                </th>
                                                <th scope="col" class="p-4">Toy Details</th>
                                                <th scope="col" class="p-4">Availability</th>
                                                <th scope="col" class="p-4">Quantity</th>
                                                <th scope="col" class="p-4">Price</th>
                                                <th scope="col" class="p-4">Description</th>
                                                <th scope="col" class="p-4">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($toys as $toy)
                                                <tr
                                                    class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <td class="p-4 w-4">
                                                        <div class="flex items-center">
                                                            <input id="checkbox-table-search-1" type="checkbox"
                                                                onclick="event.stopPropagation()"
                                                                class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="checkbox-table-search-1"
                                                                class="sr-only">checkbox</label>
                                                        </div>
                                                    </td>
                                                    <th scope="row"
                                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="flex items-center mr-3">
                                                            @php
                                                                $imagearray = explode(',', $toy->toy_image);
                                                            @endphp
                                                            <img src="{{ asset($imagearray[0]) }}"
                                                                alt="iMac Front Image" class="h-8 w-auto mr-3">
                                                            {{ $toy->toyName }}
                                                        </div>
                                                    </th>

                                                    <td
                                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="flex items-center">

                                                            @if ($toy->availability === 'available')
                                                                Available
                                                            @elseif ($toy->availability === 'notAvailable')
                                                                Not Available
                                                            @else
                                                                Comming Soon
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="flex items-center">

                                                            {{ $toy->quantity }}
                                                        </div>
                                                    </td>
                                                    <td
                                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ number_format($toy->price, 0, '.', '') }}</td>
                                                    <td
                                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        {{ Str::limit($toy->description, 30, '...') }}</td>

                                                    <td
                                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <div class="flex items-center space-x-4">
                                                            <a href="{{ route('edit.toy', $toy->id) }}">
                                                                <button type="button"
                                                                    data-drawer-target="drawer-update-product"
                                                                    data-drawer-show="drawer-update-product"
                                                                    aria-controls="drawer-update-product"
                                                                    class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-100 bg-[#2563eb] hover:bg-[#1e40af] rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20"
                                                                        fill="currentColor" aria-hidden="true">
                                                                        <path
                                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                        <path fill-rule="evenodd"
                                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                    Edit
                                                                </button>
                                                            </a>
                                                            <a href="{{ route('preview.toy', $toy->id) }}">
                                                                <button type="button"
                                                                    class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewbox="0 0 24 24" fill="currentColor"
                                                                        class="w-4 h-4 mr-2 -ml-0.5">
                                                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                                    </svg>
                                                                    Preview
                                                                </button>
                                                            </a>
                                                            <button id="myBtn" data-toy-id="{{ $toy->id }}"
                                                                class="trigger-delete flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20"
                                                                    fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <div class="modal">
                                                    <div class="modal-content">
                                                        <span class="close-button">&times;</span>
                                                        <h1 class="text-xl font-bold underline mb-4">Confirmation!</h1>
                                                        <p class="text-lg font-semibold">Do you want to delete this
                                                            product?
                                                        </p>
                                                        <p class="text-lg font-semibold mb-4">This action cannot be
                                                            undone!
                                                        </p>
                                                        <form action="{{ route('toy.delete', $toy->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                class="bg-red-600 text-white w-full hover:bg-red-700 text-lg font-semibold rounded-md duration-75 px-10 py-1">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach

                                </div>
                            @endif

                            </tbody>
                            </table>
                        </div>


                    </div>
        </div>
        </section>
        </main>

    </div>

    </div>

    <script>
        // Use class instead of ID for trigger-delete
        const deleteButtons = document.querySelectorAll(".trigger-delete");
        const modal = document.querySelector(".modal");
        const closeButton = document.querySelector(".close-button");

        function toggleModal() {
            modal.classList.toggle("show-modal");
        }

        function windowOnClick(event) {
            if (event.target === modal) {
                toggleModal();
            }
        }

        // Add an event listener to each Delete button
        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                // Retrieve the toyId from the data attribute
                const toyId = this.dataset.toyId;

                toggleModal();
            });
        });

        closeButton.addEventListener("click", toggleModal);
        window.addEventListener("click", windowOnClick);
    </script>



</body>
@endsection

<!-- jQuery -->
