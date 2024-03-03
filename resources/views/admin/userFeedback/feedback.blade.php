@extends('layouts.adminSideBar')
@section('content')
@section('title', 'Feedback')
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
        @include('components.Navbar')

        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Feedback</h1>



                <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> User's Feedback
                    </p>

                    @if ($feedbacks->isEmpty())
                        <p class="text-center text-xl text-gray-500 font-bold pb-4 uppercase">There is no feedbacks Yet!
                        </p>
                    @else
                        <div class="bg-white overflow-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Message</th>
                                    </tr>
                                </thead>
                                @foreach ($feedbacks as $feedback)
                                    <tbody class="text-gray-700">
                                        <tr>
                                            <td class="w-1/3 text-left py-3 px-4">{{ $feedback->name }}</td>
                                            <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                                                    href="mailto:{{ $feedback->email }}">{{ $feedback->email }}</a></td>
                                            <td data-feedback-message="{{ $feedback->message }}"
                                                class="trigger text-left py-3 px-4 cursor-pointer">
                                                {{ Str::limit($feedback->message, 30, '...') }}
                                            </td>
                                        </tr>
                                @endforeach
                                <div class="modal">
                                    <div class="modal-content">
                                        <span class="close-button">&times;</span>
                                        <h1 class="text-xl font-bold underline mb-4">User's Message!</h1>
                                        <p id="modal-message" class=" text-lg font-semibold mb-4"></p>
                                    </div>
                                </div>
                                </tbody>
                            </table>
                            <div class="p-4">
                                {{ $feedbacks->links() }}
                            </div>
                        </div>
                    @endif
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



    <script>
        // Use class instead of ID for trigger
        const feedPreviewButtons = document.querySelectorAll(".trigger");
        const modal = document.querySelector(".modal");
        const modalMessage = document.getElementById("modal-message");
        const closeButton = document.querySelector(".close-button");

        function toggleModal(message) {
            modalMessage.textContent = message;
            modal.classList.toggle("show-modal");
        }

        function windowOnClick(event) {
            if (event.target === modal) {
                toggleModal("");
            }
        }

        // Add an event listener to each preview button
        feedPreviewButtons.forEach(button => {
            button.addEventListener("click", function() {
                // Retrieve the feedback message from the data attribute
                const feedbackMessage = this.dataset.feedbackMessage;

                toggleModal(feedbackMessage);
            });
        });

        closeButton.addEventListener("click", toggleModal);
        window.addEventListener("click", windowOnClick);
    </script>
</body>
@endsection
