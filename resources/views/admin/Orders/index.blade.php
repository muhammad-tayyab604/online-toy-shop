@extends('layouts.adminSideBar')
@section('content')
@section('title', 'Orders')
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

    <div class="w-full flex flex-col h-screen overflow-y-hidden">

        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Orders</h1>



                <div class="w-full mt-12">
                    @if ($orders->isEmpty())
                        <p class="text-center text-xl text-gray-500 font-bold pb-4 uppercase">There is no orders Yet!
                        </p>
                        <div class="bg-white overflow-auto">
                        @else
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Customer
                                            Name
                                        </th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Toy Name</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Price</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Payment</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Action</th>
                                    </tr>
                                </thead>
                                @foreach ($orders as $order)
                                    <tbody class="text-gray-700">
                                        <tr>
                                            <td class="w-1/3 text-left py-3 px-4">{{ $order->user->name }}</td>
                                            <td class="text-left py-3 px-4">{{ $order->toy->toyName }}</td>
                                            <td class="text-left py-3 px-4">
                                                {{ number_format($order->toy->price, 0, '.', '') }}</td>
                                            @if ($order->payment_status === 'notPaid')
                                                <td class="text-left py-3 px-4 text-red-600">Pending</td>
                                            @else
                                                <td class="text-left py-3 px-4 text-green-600">Paid</td>
                                            @endif
                                            <td class="text-left py-3 px-4">
                                                <a href="{{ route('order.preview', $order->id) }}">
                                                    <button type="button"
                                                        class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"
                                                            fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                        </svg>
                                                        Preview
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                    @endif

                </div>
        </div>
        </main>
    </div>

    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
        integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
</body>
@endsection
