<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 m-6 flex justify-between align-middle">
                    Welcom to You'r Google Calendar
                    <div class="add_event_btn">
                        <!-- Modal Button -->
                        <button
                        class="bg-blue-500 hover:bg-blue-800 text-white rounded p-3 focus:ring-4 focus:outline-none focus:ring-blue-300"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#modelId">
                            Add Event
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Event Credentials</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('Calendar.store') }}" method="POST" class="p-3">
                                            @csrf
                                            <div class="form-group m-2">
                                                <label for="event_name" class="form-label">Event Name</label>
                                                <input type="text" name="name" id="event_name" class="form-control rounded border-gray-300" required placeholder="Enter Event Name" aria-describedby="helpId">
                                            </div>
                                            <div class="form-group m-2">
                                                <label for="start_date_time" class="form-label">Event Start DateTime</label>
                                                <input type="datetime" name="startDateTime" id="start_date_time" class="form-control border-gray-300" required placeholder="Enter Event StartDateTime" aria-describedby="helpId">
                                            </div>
                                            <div class="form-group m-2">
                                                <label for="end_date_time" class="form-label">Event End DateTime</label>
                                                <input type="datetime" name="endDateTime" id="end_date_time" class="form-control border-gray-300" required placeholder="Enter Event EndDateTime" aria-describedby="helpId">
                                            </div>
                                            <div class="form-group m-2 text-center">
                                                <button type="submit" class="btn btn-lg bg-green-500 text-white hover:bg-green-800">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-red-500 text-white hover:bg-red-800" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <iframe
                    src="https://calendar.google.com/calendar/embed?src=behramkttk9%40gmail.com&ctz=UTC"
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
