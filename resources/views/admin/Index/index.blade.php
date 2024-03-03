@extends('layouts.adminSideBar')
@section('content')
@section('title', 'Dashboard')

<body class="bg-gray-100 font-family-karla flex">

    <div class="w-full flex flex-col h-screen overflow-y-hidden">

        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Dashboard</h1>

                @if ($customers->isEmpty())
                    <p class="text-center text-xl text-gray-500 font-bold pb-4 uppercase">No users are registered yet!
                    </p>
                @else
                    <div class="w-full mt-12">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="fas fa-list mr-3"></i> Customers
                        </p>
                        <div class="bg-white overflow-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Number Of Orders
                                        </th>
                                    </tr>
                                </thead>
                                @foreach ($customers as $customer)
                                    <tbody class="text-gray-700">
                                        <tr>
                                            <td class="w-1/3 text-left py-3 px-4">{{ $customer->name }}</td>
                                            <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                                                    href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></td>
                                            <td class="text-left py-3 px-4">
                                                <p>{{ $customer->orders->count() }}</p>
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="p-4">
                                {{ $customers->links() }}
                            </div>
                        </div>
                    </div>

                @endif
                @if ($orders->isEmpty())
                    <p class="text-center text-xl text-gray-500 font-bold pb-4 uppercase mt-10">No Payments have been
                        made
                        yet!</p>
                @else
                    {{-- Payment Details --}}
                    <div class="w-full mt-12">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="fas fa-list mr-3"></i> Successfull Payments
                        </p>
                        <div class="bg-white overflow-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class=" text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Phone Number
                                        </th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Address</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Toy Name</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Payment</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Order at</th>
                                    </tr>
                                </thead>
                                @foreach ($orders as $order)
                                    <tbody class="text-gray-700">
                                        <tr>
                                            <td class=" text-left py-3 px-4">{{ $order->user->name }}</td>
                                            <td class="text-left py-3 px-4">{{ $order->user->email }}</td>
                                            <td class="text-left py-3 px-4">{{ $order->phone_number }}</td>
                                            <td class="text-left py-3 px-4">{{ $order->address }}</td>
                                            <td class="text-left py-3 px-4">{{ $order->toy->toyName }}</td>
                                            <td class="text-left py-3 px-4">PKR.
                                                {{ number_format($order->toy->price, 0, '.', '') }}</td>
                                            <td class="text-left py-3 px-4">{{ $order->created_at->format('m-d-Y') }}
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="p-4">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                @endif


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
