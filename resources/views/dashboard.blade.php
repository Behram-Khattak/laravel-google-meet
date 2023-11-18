<x-app-layout>

    <div class="py-12">
        <div class="container mx-auto px-10">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="bg-white border-gray-200 m-6 text-center space-y-10">
                    <h1 class="font-bold text-2xl text-gray-500">
                        Welcome to You'r Google Calendar
                    </h1>

                    <a href="{{ route('calendar.events') }}"
                    class="bg-blue-500 hover:bg-blue-800 text-white rounded-lg p-3 focus:ring-4 focus:outline-none focus:ring-blue-300"
                    type="button">
                        Add Event
                    </a>
                </div>

                <iframe
                    src="https://calendar.google.com/calendar/embed?src={{ auth()->user()->email }}&ctz=UTC"
                    style="border: 0"
                    width="100%"
                    height="600"
                    frameborder="0"
                    scrolling="no">
                </iframe>
            </div>
        </div>
    </div>
</x-app-layout>
