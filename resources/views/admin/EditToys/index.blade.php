@extends('layouts.adminSideBar')
@section('content')
@section('title', 'Edit Toy')

<body class="bg-gray-100 font-family-karla flex">


    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <div id="createProductModal"
                    class="flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] md:h-full">
                    <div class="relative p-4 w-full  h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                            <!-- Modal header -->
                            <div
                                class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Toy</h3>
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
                            <form action="{{ route('update.toy', $toy->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                    <div>
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Toy
                                            Name</label>
                                        <input type="text" name="toyName" id="name" value="{{ $toy->toyName }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Type product name" required="">
                                    </div>
                                    <div><label for="category"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Availability</label><select
                                            id="category" name="availability"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option {{ $toy->availability === 'available' ? 'selected' : '' }}
                                                value="available">Available</option>
                                            <option {{ $toy->availability === 'notAvailable' ? 'selected' : '' }}
                                                value="notAvailable">Not Available</option>
                                            <option {{ $toy->availability === 'commingSoon' ? 'selected' : '' }}
                                                value="commingSoon">Coming Soon</option>
                                        </select></div>
                                    <div>
                                        <label for="quantity"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity
                                            Available</label>
                                        <input type="number" name="quantity" id="quantity"
                                            value="{{ $toy->quantity }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="e.g. 1000" required="">
                                    </div>
                                    <div>
                                        <label for="price"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                        <input type="number" value="{{ number_format($toy->price, 0, '.', '') }}"
                                            name="price" id="price"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="$2999" required="">
                                    </div>

                                    <div class="sm:col-span-2"><label for="description"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                        <textarea id="description" rows="4" name="description"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Write product description here">{{ $toy->description }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Toy
                                        Images</span>
                                    <div class="flex justify-center items-center w-full">
                                        <label for="dropzone-file"
                                            class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                            <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                                <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400"
                                                    fill="none" stroke="currentColor" viewbox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                                    <span class="font-semibold">Click to upload</span>
                                                    or drag and drop
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or
                                                    GIF (MAX. 800x400px)</p>
                                            </div>
                                            <input id="dropzone-file" type="file" accept="image/*" multiple
                                                onchange="loadFiles(event)" name="toy_image[]" class="hidden">
                                        </label>
                                    </div>
                                    <div class="flex flex-wrap justify-center mt-4">
                                        @php
                                            $imageArray = explode(',', $toy->toy_image);
                                        @endphp

                                        @foreach ($imageArray as $index => $image)
                                            <div class="image-container" id="image_container_{{ $index }}">
                                                <i class="fa-solid fa-circle-xmark cursor-pointer"
                                                    onclick="deleteImage({{ $index }})"></i>
                                                <img class="w-64 p-2" src="{{ asset($image) }}" alt="">
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Hidden input field for deleted image indices -->
                                    <input type="hidden" name="deleted_images" id="deleted_images" value="">
                                    <div id="image-preview" class="flex justify-center mt-4">
                                    </div>
                                </div>
                                <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                                    <button type="submit"
                                        class="w-full sm:w-auto justify-center text-gray-100 inline-flex bg-[#2563eb] hover:bg-[#1e40af] focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Edit
                                        Toy</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- </div> --}}

            </main>
        </div>

    </div>
    <script>
        function loadFiles(event) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Clear previous previews

            const files = event.target.files;

            for (const file of files) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-32 h-32 object-cover rounded-md m-2';
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>

    <script>
        var deletedImagesCounter = 0;

        function deleteImage(index) {
            var deletedImagesInput = document.getElementById('deleted_images');
            var imageContainer = document.getElementById('image_container_' + index);

            // Check if there is an image container before updating the input value
            if (imageContainer) {
                // Optionally, you can also remove the image element from the DOM for a better visual effect
                imageContainer.remove();

                // Update the index for the next deleted image
                deletedImagesInput.value += index + ',';
            }

            // Update the delete icon based on the remaining images
            updateDeleteIcons();
        }

        function updateDeleteIcons() {
            var deleteIcons = document.querySelectorAll('.delete-icon');

            // Hide delete icons if there are no images
            if (deleteIcons.length === 0) {
                deletedImagesCounter = 0; // Reset the counter when no images are present
            }

            deleteIcons.forEach(function(icon, index) {
                icon.style.display = index + deletedImagesCounter < deleteIcons.length ? 'inline-block' : 'none';
            });
        }
    </script>





    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


</body>
@endsection
