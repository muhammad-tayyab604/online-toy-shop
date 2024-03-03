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
</style>

<body>
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="{{ route('admin.index') }}"
                class="text-white text-2xl font-semibold uppercase hover:text-gray-300">Admin Panel</a>
            <a href="{{ route('home') }}"
                class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fa fa-globe mr-3"></i> Visit Site
            </a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('admin.index') }}"
                class="flex items-center {{ request()->routeIs('admin.index') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-4 pl-6 nav-item">
                <i class="fa-solid fa-gauge-high mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.manageToy') }}"
                class="flex items-center {{ request()->routeIs('admin.manageToy') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-4 pl-6 nav-item">
                <i class="fa-solid fa-bars-progress mr-3"></i>
                Toy Management
            </a>
            <a href="{{ route('admin.orders') }}"
                class="flex items-center {{ request()->routeIs('admin.orders') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-4 pl-6 nav-item">
                <i class="fa-solid fa-truck-ramp-box mr-3"></i>
                Orders
            </a>
            <a href="{{ route('admin.reports') }}"
                class="flex items-center {{ request()->routeIs('admin.reports') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-4 pl-6 nav-item">
                <i class="fa fa-file mr-3"></i>
                Reports
            </a>
            <a href="{{ route('admin.feedback') }}"
                class="flex items-center {{ request()->routeIs('admin.feedback') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} py-4 pl-6 nav-item">
                <i class="fa-solid fa-comments mr-3"></i>
                Feedbacks
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
</body>

</html>
