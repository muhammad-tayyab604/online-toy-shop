<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '')</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/9460aaea96.js" crossorigin="anonymous"></script>
    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

    .font-family-karla {
        font-family: karla;
    }

    .bg-sidebar {
        background: #3d68ff;
    }

    .cta-btn {
        color: #3d68ff;
    }

    .upgrade-btn {
        background: #1947ee;
    }

    .upgrade-btn:hover {
        background: #0038fd;
    }

    .active-nav-link {
        background: #1947ee;
    }

    .nav-item:hover {
        background: #1947ee;
    }

    .account-link:hover {
        background: #3d68ff;
    }

    .modal {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(8px);
        z-index: 1000;
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
        width: 60%;
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

<body>
    <div class="modal">
        <div class="modal-content">
            <span class="close-button hidden">&times;</span>
            <h1 class="text-xl font-bold underline mb-4">Contact Us</h1>
            <div class="w-full ">
                <div class="leading-loose ">
                    <form method="POST" action="{{ route('user.feedback') }}" class="p-10  bg-white rounded shadow-xl">
                        @csrf
                        <div class="">
                            <label class="block text-sm text-gray-600" for="name">Name</label>
                            <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="name"
                                name="name" type="text" required="" placeholder="Your Name" aria-label="Name">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm text-gray-600" for="email">Email</label>
                            <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email"
                                name="email" type="text" required="" placeholder="Your Email"
                                aria-label="Email">
                        </div>
                        <div class="mt-2">
                            <label class=" block text-sm text-gray-600" for="message">Message</label>
                            <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" id="message" name="message" rows="6"
                                required="" placeholder="Your inquiry.." aria-label="Email"></textarea>
                        </div>
                        <div class="mt-6">
                            <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded"
                                type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="{{ route('user.dashboard') }}"
                class="text-white text-2xl font-semibold uppercase hover:text-gray-300">Dashboard</a>
            <button
                class="trigger w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fa-solid fa-comments mr-3"></i> Feedback
            </button>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('user.dashboard') }}"
                class="flex items-center {{ request()->routeIs('user.dashboard') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-4 pl-6 nav-item">
                <i class="fa-solid fa-gauge-high mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('profile.edit') }}"
                class="flex items-center {{ request()->routeIs('profile.edit') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-4 pl-6 nav-item">
                <i class="fa-solid fa-gears mr-3"></i>
                Profile Settings
            </a>
        </nav>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit"
                class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
                <i class="fa-solid fa-right-from-bracket mr-3"></i>
                Logout
            </button>
        </form>
    </aside>
    @yield('content')
    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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

            function closeModal() {
                modal.classList.remove("show-modal");
            }

            trigger.addEventListener("click", toggleModal);
            closeButton.addEventListener("click", closeModal);
            window.addEventListener("click", windowOnClick);

            console.log('Clicked');
        });
    </script>
</body>

</html>
