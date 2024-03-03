<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <script src="https://kit.fontawesome.com/9460aaea96.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    <title>Payment Successfull</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="w-full max-w-[570px] rounded-[20px] py-12 px-8 text-center md:py-[60px] md:px-[70px]">
        <div class="congrats">
            <h1 class="text-2xl font-bold animate-bounce">🎉🌟 Payment Successfull! 🎉🌟</h1>
        </div>

        <p class="text-gray-800 mb-10 text-xl mt-4 leading-relaxed">Congratulations! Your payment was successful. To
            access
            more details and keep track of your transactions, simply log in to your dashboard. Your dashboard provides a
            comprehensive overview of your account activity, allowing you to review payment history, monitor balances,
            and manage any additional information related to your transactions. This user-friendly interface ensures
            that you have complete visibility and control over your financial interactions. Feel free to explore the
            additional details available in your dashboard to stay informed and confident in your financial endeavors.
            Thank you for choosing our services, and we look forward to providing you with a seamless and secure
            experience.</p>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('user.dashboard') }}"
                class="bg-indigo-500 border-indigo-500 block w-full rounded-lg border p-3 text-center text-base font-medium text-white transition hover:bg-opacity-90"><span>&larr;</span>
                Dashboard</a>
        </div>
    </div>

</body>

</html>
