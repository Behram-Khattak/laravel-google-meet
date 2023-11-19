<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">

                <div class="create-meeting-section p-6 capitalize flex flex-col items-center">

                    @if (session('created'))
                        <div class="p-3 bg-green-500 mb-4 rounded text-white">
                            <p>{{ session('created') }}</p>
                        </div>

                    @elseif (session('updated'))
                        <div class="p-3 bg-blue-500 mb-4 rounded text-white">
                            <p>{{ session('updated') }}</p>
                        </div>

                    @elseif (session('deleted'))
                        <div class="p-3 bg-red-500 mb-4 rounded text-white">
                            <p>{{ session('deleted') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('calendar.meeting.create') }}" method="POST"
                        class="space-y-5 border-gray-500 border p-6 rounded">
                        @csrf

                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-6 rounded">
                                <ul>
                                    @foreach ($errors->all() as $error )
                                    <li class="list-disc">{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <h2 class="font-bold text-3xl text-center">create event</h2>

                        {{-- subject --}}
                        <div class="subject-input">
                            <x-label class="font-bold" for="Subject" :value="__('subject')"/>

                            <x-input id="Subject" type="text" name="subject" placeholder="Enter Subject" />
                        </div>

                        {{-- Date Time --}}
                        <div class="dateTime-input">
                            <x-label class="font-bold" for="startDateTime" :value="__('start date & time')"/>

                            <x-input id="startDateTime" type="datetime-local" name="startDateTime" />
                        </div>

                        <div class="dateTime-input">
                            <x-label class="font-bold" for="endDateTime" :value="__('end date & time')"/>

                            <x-input id="endDateTime" type="datetime-local" name="endDateTime" />
                        </div>

                        {{-- Attendees --}}
                        <div class="attendees-input">
                            <x-label class="font-bold" for="Attendees" :value="__('attendees')"/>

                            <div class="flex space-x-5">
                                <x-input id="" type="email" name="attendees[]" placeholder="Attendee 1" />
                                <x-input id="" type="email" name="attendees[]" placeholder="Attendee 2" />
                            </div>
                        </div>

                        <div class="submit-btn text-center">
                            <x-button type="submit" class="">
                                {{ __('create') }}
                            </x-button>
                        </div>
                    </form>
                </div>

                <div class="list-meetings rounded-lg p-10 border border-gray-800">
                    <div class="block overflow-x-auto">
                        <table class="items-center bg-transparent w-full border-collapse">
                          <thead>
                            <tr class="">
                              <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            subject
                                          </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            start date & time
                                          </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            end date & time
                                          </th>
                             <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            attendees
                                          </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            actions
                                          </th>
                            </tr>
                          </thead>

                          <tbody>
                            @foreach ($events as $event)
                                <tr class="border-b border-gray-800">
                                    <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                        {{ $event->subject }}
                                    </th>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 ">
                                        {{ $event->startDateTime }}
                                    </td>
                                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 ">
                                        {{ $event->endDateTime }}
                                    </td>
                                    <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                        @foreach ($event->attendees as $value)
                                            {{ $value }} <br>
                                        @endforeach
                                    </td>
                                    <td class="capitalize border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                        <a href="{{ route('calendar.meeting.show', $event->id) }}"
                                            class="bg-blue-600 text-white py-2 px-3 rounded"
                                            id="openModal">edit</a>

                                        <a href="{{ route('calendar.meeting.delete', $event->id) }}"
                                            class="bg-red-600 text-white py-2 px-3 rounded">delete</a>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>

                        </table>
                        <div class="pagination mt-5">
                            {{ $events->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
{{--  --}}
@endsection
</x-app-layout>
