@extends('layouts.adminSideBar')
@section('content')
@section('title', 'Reports')

<body class="bg-gray-100 font-family-karla flex">

    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">Reports</h1>

            <div class="w-full mt-6" x-data="{ openTab: 1 }">
                <div>
                    <ul class="flex border-b">
                        <li class="-mb-px mr-1" @click="openTab = 1">
                            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-blue-700 font-semibold' :
                                'text-blue-500 hover:text-blue-800'"
                                class="bg-white inline-block py-2 px-4 font-semibold" href="#">Top Selling
                                Items</a>
                        </li>
                        <li class="mr-1" @click="openTab = 2">
                            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-blue-700 font-semibold' :
                                'text-blue-500 hover:text-blue-800'"
                                class="bg-white inline-block py-2 px-4 font-semibold" href="#">Top Customers</a>
                        </li>
                        <li class="mr-1" @click="openTab = 3">
                            <a :class="openTab === 3 ? 'border-l border-t border-r rounded-t text-blue-700 font-semibold' :
                                'text-blue-500 hover:text-blue-800'"
                                class="bg-white inline-block py-2 px-4 font-semibold" href="#">Sales Report</a>
                        </li>
                        <li class="mr-1" @click="openTab = 4">
                            <a :class="openTab === 4 ? 'border-l border-t border-r rounded-t text-blue-700 font-semibold' :
                                'text-blue-500 hover:text-blue-800'"
                                class="bg-white inline-block py-2 px-4 font-semibold" href="#">Download Report</a>
                        </li>
                    </ul>
                </div>
                <div class="bg-white p-6">
                    <div id="" class="" x-show="openTab === 1">
                        <h1 class="mb-4 text-xl font-bold">Top Selling Items</h1>
                        @if ($topSellingItems->isEmpty())
                            <p class="text-center text-xl text-gray-500 font-bold pb-4 uppercase">No report related to
                                (Top Selling Items)
                            </p>
                        @else
                            <div class="w-full mt-12">
                                <div class="bg-white overflow-auto">
                                    <table class="min-w-full bg-white">
                                        <thead class="bg-gray-800 text-white">
                                            <tr>
                                                <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">
                                                    Toy
                                                    Image
                                                </th>
                                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Toy
                                                    Name
                                                </th>
                                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Price
                                                </th>
                                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">
                                                    Description
                                                </th>
                                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Number
                                                    Of
                                                    Orders
                                                </th>
                                            </tr>
                                        </thead>
                                        @foreach ($topSellingItems as $item)
                                            <tbody class="text-gray-700">
                                                <tr>
                                                    <td class="w-1/3 text-left py-3 px-4">
                                                        @php
                                                            $imagearray = explode(',', $item->toy->toy_image);
                                                        @endphp
                                                        <img src="{{ asset($imagearray[0]) }}" class="h-10 w-auto mr-3">
                                                    </td>
                                                    <td class="w-1/3 text-left py-3 px-4">{{ $item->toy->toyName }}</td>
                                                    <td class="text-left py-3 px-4">
                                                        {{ number_format($item->toy->price, 0, '.', '') }}
                                                    </td>
                                                    <td class="w-1/3 text-left py-3 px-4">
                                                        {{ Str::limit($item->toy->description, 30, '...') }}</td>
                                                    <td class="text-left py-3 px-4">
                                                        <p>{{ $item->order_count }}</p>
                                                    </td>
                                                </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="p-4">
                                        {{ $topSellingItems->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div id="" class="" x-show="openTab === 2">
                        <h1 class="mb-4 text-xl font-bold">Top Customers</h1>
                        @if ($customers->isEmpty())
                            <p class="text-center text-xl text-gray-500 font-bold pb-4 uppercase">No report related to
                                (Top Customers)
                            </p>
                        @else
                            <div class="w-full mt-12">
                                <div class="bg-white overflow-auto">
                                    <table class="min-w-full bg-white">
                                        <thead class="bg-gray-800 text-white">
                                            <tr>
                                                <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">
                                                    Name</th>
                                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email
                                                </th>
                                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Number
                                                    Of Orders
                                                </th>
                                            </tr>
                                        </thead>
                                        @foreach ($customers as $customer)
                                            <tbody class="text-gray-700">
                                                <tr>
                                                    <td class="w-1/3 text-left py-3 px-4">{{ $customer->name }}</td>
                                                    <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                                                            href="mailto:{{ $customer->email }}">{{ $customer->email }}</a>
                                                    </td>
                                                    <td class="text-left py-3 px-4">
                                                        <p>{{ $customer->orders_count }}</p>
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
                    </div>
                    <div id="" class="" x-show="openTab === 3">
                        <h1 class="mb-4 text-xl font-bold">Sales Report</h1>
                        @if ($orders->isEmpty())
                            <p class="text-center text-xl text-gray-500 font-bold pb-4 uppercase">No Sales report
                            </p>
                        @else
                            <div class="w-full mt-12">
                                <div class="bg-white overflow-auto">
                                    <table class="min-w-full bg-white">
                                        <thead class="bg-gray-800 text-white">
                                            <tr>
                                                <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">
                                                    Toy Name</th>
                                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Toy
                                                    Description
                                                </th>
                                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Payment
                                                    Status
                                                </th>
                                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Price
                                                </th>
                                            </tr>
                                        </thead>
                                        @foreach ($orders as $order)
                                            <tbody class="text-gray-700">
                                                <tr>
                                                    <td class="w-1/3 text-left py-3 px-4">{{ $order->toy->toyName }}
                                                    </td>
                                                    <td class="text-left py-3 px-4">
                                                        {{ Str::limit($order->toy->description, 30, '...') }}
                                                    </td>
                                                    <td class="text-left py-3 px-4 text-green-500">
                                                        {{ $order->payment_status }}
                                                    </td>
                                                    <td class="text-left py-3 px-4">RS.
                                                        {{ number_format($order->toy->price, 0, '.', '') }}
                                                        @php
                                                            $totalPrice += number_format($order->toy->price, 0, '.', '');
                                                        @endphp
                                                    </td>
                                                </tr>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-left py-3 px-4 border border-t-2">Total Sale:
                                            RS. {{ number_format($totalPrice, 0, '.', '') }}</td>
                                        </tbody>

                                    </table>
                                    <div class="p-4">
                                        {{ $orders->links() }}
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>
                    <div id="" class="" x-show="openTab === 4">
                        <button onclick="printDiv('topSellingItemsReport')"
                            class="w-full bg-blue-500 text-white font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-blue-600 flex items-center justify-center">
                            <i class="fa fa-download mr-3"></i> Full Report
                        </button>
                        <div id="topSellingItemsReport">
                            @if ($topSellingItems->isEmpty())
                                <p class="text-center text-xl text-gray-500 font-bold pb-4 uppercase">No report related
                                    to
                                    (Top Selling Items)
                                </p>
                            @else
                                <h1 class="mt-8 text-xl font-bold">Top Selling Items</h1>
                                <p class="ml-4 text-lg text-gray-500 mt-2">
                                    In this report, we present a detailed analysis of the top-selling items in our
                                    online
                                    toy shop. The report is centered around identifying the most popular toys based on
                                    the
                                    quantity sold over a specified time frame. Utilizing robust data analytics, we have
                                    identified and ranked the top-selling items, providing valuable insights into
                                    customer
                                    preferences and market trends. The report includes essential details such as the toy
                                    name, price, brief description, and the number of orders for each top-selling item.
                                    By
                                    examining this data, our aim is to empower the administration with actionable
                                    information that can be leveraged for strategic decision-making, inventory
                                    management,
                                    and marketing strategies. The presented information serves as a valuable resource
                                    for
                                    understanding customer demand, optimizing product offerings, and ensuring the
                                    continued
                                    success of our online toy shop.</p>
                                <div class="w-full mt-4">
                                    <div class="bg-white overflow-auto">
                                        <table class="min-w-full bg-white">
                                            <thead class="bg-gray-800 text-white">
                                                <tr>
                                                    <th
                                                        class="w-1/3 text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Toy
                                                        Image
                                                    </th>
                                                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Toy
                                                        Name
                                                    </th>
                                                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Price
                                                    </th>
                                                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Description
                                                    </th>
                                                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Number
                                                        Of
                                                        Orders
                                                    </th>
                                                </tr>
                                            </thead>
                                            @foreach ($topSellingItems as $item)
                                                <tbody class="text-gray-700">
                                                    <tr>
                                                        <td class="w-1/3 text-center py-3 px-4">
                                                            @php
                                                                $imagearray = explode(',', $item->toy->toy_image);
                                                            @endphp
                                                            <img src="{{ asset($imagearray[0]) }}"
                                                                class="toy-image h-10 w-auto mr-3">
                                                        </td>
                                                        <td class="w-1/3 text-center py-3 px-4">
                                                            {{ $item->toy->toyName }}
                                                        </td>
                                                        <td class="text-center py-3 px-4">
                                                            {{ number_format($item->toy->price, 0, '.', '') }}
                                                        </td>
                                                        <td class="w-1/3 text-center py-3 px-4">
                                                            {{ Str::limit($item->toy->description, 30, '...') }}</td>
                                                        <td class="text-center py-3 px-4">
                                                            <p>{{ $item->order_count }}</p>
                                                        </td>
                                                    </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="p-4">
                                            {{ $topSellingItems->links() }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($customers->isEmpty())
                                <p class="text-center text-xl text-gray-500 font-bold pb-4 uppercase">No report related
                                    to
                                    (Top Customers)
                                </p>
                            @else
                                <h1 class="mt-8 text-xl font-bold">Top Customers</h1>
                                <p class="ml-4 text-lg text-gray-500 mt-2">This comprehensive report highlights the top
                                    customers who have played a pivotal role in
                                    contributing to the success of our online toy shop. By analyzing their purchasing
                                    behavior and loyalty, we have identified and ranked the customers based on the
                                    number of
                                    orders they have placed. The report provides key details such as customer name,
                                    email
                                    address, and the total number of orders made. For each customer, we offer insights
                                    into
                                    their engagement with our platform, allowing the administration to recognize and
                                    appreciate our most loyal patrons. In cases where customers have made a substantial
                                    impact on our business, this report serves as a testament to their importance and
                                    provides a foundation for personalized customer relationship management. By
                                    understanding the preferences and buying patterns of our top customers, we aim to
                                    enhance their shopping experience, foster lasting relationships, and, ultimately,
                                    cultivate a thriving and satisfied customer base.</p>
                                <div class="w-full mt-12">
                                    <div class="bg-white overflow-auto">
                                        <table class="min-w-full bg-white">
                                            <thead class="bg-gray-800 text-white">
                                                <tr>
                                                    <th
                                                        class="w-1/3 text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Name</th>
                                                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Email
                                                    </th>
                                                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Number
                                                        Of Orders
                                                    </th>
                                                </tr>
                                            </thead>
                                            @foreach ($customers as $customer)
                                                <tbody class="text-gray-700">
                                                    <tr>
                                                        <td class="w-1/3 text-center py-3 px-4">{{ $customer->name }}
                                                        </td>
                                                        <td class="text-center py-3 px-4"><a
                                                                class="hover:text-blue-500"
                                                                href="mailto:{{ $customer->email }}">{{ $customer->email }}</a>
                                                        </td>
                                                        <td class="text-center py-3 px-4">
                                                            <p>{{ $customer->orders_count }}</p>
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
                                <p class="text-center text-xl text-gray-500 font-bold pb-4 uppercase">No Sales report
                                </p>
                            @else
                                <h1 class="mt-8 text-xl font-bold">Sales Report</h1>
                                <p class="ml-4 text-lg text-gray-500 mt-2">This comprehensive sales report provides a
                                    detailed overview of the financial performance
                                    of our online toy shop, offering valuable insights into revenue generation and key
                                    transactional details. By meticulously analyzing sales data over a specified time
                                    period, the report showcases the top-selling toys, their descriptions, and payment
                                    statuses. Additionally, it highlights the overall financial health of the business,
                                    including total revenue, the number of orders processed, and the average order
                                    value.
                                    The report also incorporates a breakdown of sales by product categories, providing a
                                    nuanced understanding of the performance of different segments of our inventory.
                                    Furthermore, the geographical analysis offers insights into sales trends across
                                    various
                                    regions. With a focus on transparency and data-driven decision-making, this sales
                                    report
                                    equips the administration with the necessary tools to assess market demand, optimize
                                    inventory, and formulate strategic initiatives for sustained growth in the dynamic
                                    online toy retail landscape.</p>
                                <div class="w-full mt-12">
                                    <div class="bg-white overflow-auto">
                                        <table class="min-w-full bg-white">
                                            <thead class="bg-gray-800 text-white">
                                                <tr>
                                                    <th
                                                        class="w-1/3 text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Toy Name</th>
                                                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Toy
                                                        Description
                                                    </th>
                                                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Payment
                                                        Status
                                                    </th>
                                                    <th class="text-center py-3 px-4 uppercase font-semibold text-sm">
                                                        Price
                                                    </th>
                                                </tr>
                                            </thead>
                                            @foreach ($orders as $order)
                                                <tbody class="text-gray-700">
                                                    <tr>
                                                        <td class="w-1/3 text-center py-3 px-4">
                                                            {{ $order->toy->toyName }}
                                                        </td>
                                                        <td class="text-center py-3 px-4">
                                                            {{ Str::limit($order->toy->description, 30, '...') }}
                                                        </td>
                                                        <td class="text-center py-3 px-4 text-green-500">
                                                            {{ $order->payment_status }}
                                                        </td>
                                                        <td class="text-center py-3 px-4">RS.
                                                            {{ number_format($order->toy->price, 0, '.', '') }}
                                                            @php
                                                                $totalPrice += number_format($order->toy->price, 0, '.', '');
                                                            @endphp
                                                        </td>
                                                    </tr>
                                            @endforeach
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center py-3 px-4 border border-t-2">Total Sale:
                                                RS. {{ number_format($totalPrice, 0, '.', '') }}</td>
                                            </tbody>

                                        </table>
                                        <div class="p-4">
                                            {{ $orders->links() }}
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>
                    </div>
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
    <script>
        function printDiv(divId) {
            var originalContent = document.getElementById(divId).cloneNode(true);

            // Resize toy images to 40px
            var toyImages = originalContent.querySelectorAll('.toy-image');
            toyImages.forEach(function(image) {
                image.style.width = '40px';
                image.style.height = 'auto'; // Maintain aspect ratio
            });

            var printContents = originalContent.innerHTML;
            var originalBodyContents = document.body.innerHTML;

            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Final Report</title></head><body>' + printContents +
                '</body></html>');
            printWindow.document.close();

            // Delay the printing process to ensure content is fully rendered
            setTimeout(function() {
                printWindow.print();
                printWindow.close();
                document.body.innerHTML = originalBodyContents;
            }, 500); // Delay time
        }
    </script>

</body>
@endsection
