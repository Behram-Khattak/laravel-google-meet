<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                @if (Session::has('created'))
                    <div class="alert alert-primary" role="alert">
                        <strong>{{ Session::get('created') }}</strong>
                        Check your event details by clicking on the event in the calendar.
                    </div>
                @endif

                <div class="create-meeting-section p-6 capitalize flex flex-col items-center">

                    <form action="#" method="POST"
                        class="space-y-5 border-gray-500 border p-6 rounded">
                        @csrf

                        <h2 class="font-bold text-3xl text-center">create meet</h2>

                        {{-- subject --}}
                        <div class="subject-input">
                            <x-label class="font-bold" for="Subject" :value="__('subject')"/>

                            <x-input id="Subject" type="text" name="subject" placeholder="Enter Subject" />
                        </div>

                        {{-- Date Time --}}
                        <div class="dateTime-input">
                            <x-label class="font-bold" for="DateTime" :value="__('date & time')"/>

                            <x-input id="DateTime" type="datetime-local" name="datetime" />
                        </div>

                        {{-- Attendees --}}
                        <div class="attendees-input">
                            <x-label class="font-bold" for="Attendees" :value="__('attendees')"/>

                            <div class="flex space-x-5">
                                <x-input id="" type="text" placeholder="Attendee 1" />
                                <x-input id="" type="text" placeholder="Attendee 2" />
                            </div>
                        </div>

                        <div class="submit-btn text-center">
                            <x-button type="submit" class="">
                                {{ __('create') }}
                            </x-button>
                        </div>
                    </form>


                    {{-- @isset($event)
                        <button
                        class="bg-green-500 hover:bg-green-800 text-white rounded p-3 focus:ring-4 focus:outline-none focus:ring-green-300"
                        type="button">
                            <a href="{{ $event->hangoutLink }}">
                                Join Event
                            </a>
                        </button>
                    @endisset --}}
                </div>

                <div class="list-meetings bg-white rounded-lg p-10">
                    <div class="block overflow-x-auto">
                        <table class="items-center bg-transparent w-full border-collapse">
                          <thead>
                            <tr class="">
                              <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            subject
                                          </th>
                            <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-sm uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            date & time
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
                            <tr>
                                <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 text-left text-blueGray-700 ">
                                    interview
                                </th>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 ">
                                    2023-11-18 11:49:54
                                </td>
                                <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                    2
                                </td>
                                <td class="capitalize border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                    <a href="#" class="bg-blue-600 text-white py-2 px-3 rounded">edit</a>
                                    <a href="#" class="bg-red-600 text-white py-2 px-3 rounded">delete</a>
                                </td>
                            </tr>
                          </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
