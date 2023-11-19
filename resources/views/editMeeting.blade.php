<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">

                <div class="create-meeting-section p-6 capitalize flex flex-col items-center">
                    <form action="{{ route('calendar.meeting.update', $event->id) }}" method="POST"
                        class="space-y-5 border-gray-500 border p-6 rounded">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-6 rounded">
                                <ul>
                                    @foreach ($errors->all() as $error )
                                    <li class="list-disc">{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <h2 class="font-bold text-3xl text-center">edit event</h2>

                        {{-- subject --}}
                        <div class="subject-input">
                            <x-label class="font-bold" for="Subject" :value="__('subject')"/>

                            <x-input id="Subject" type="text" value="{{ $event->subject }}" name="subject" placeholder="Enter Subject" />
                        </div>

                        {{-- Date Time --}}
                        <div class="dateTime-input">
                            <x-label class="font-bold" for="DateTime" :value="__('date & time')"/>

                            <x-input id="DateTime" type="datetime-local" value="{{ $event->startDateTime }}" name="startDateTime" />
                        </div>

                        <div class="dateTime-input">
                            <x-label class="font-bold" for="DateTime" :value="__('date & time')"/>

                            <x-input id="DateTime" type="datetime-local" value="{{ $event->endDateTime }}" name="endDateTime" />
                        </div>


                        {{-- Attendees --}}
                        <div class="attendees-input">
                            <x-label class="font-bold" for="Attendees" :value="__('attendees')"/>

                            <div class="flex space-x-5">
                                <x-input id="" type="email" value="{{ $event->attendees[0] }}" name="attendees[]" placeholder="Attendee 1" />
                                <x-input id="" type="email" value="{{ $event->attendees[1] }}" name="attendees[]" placeholder="Attendee 2" />
                            </div>
                        </div>

                        <div class="submit-btn text-center">
                            <x-button type="submit" class="">
                                {{ __('edit') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
{{--  --}}
@endsection
</x-app-layout>
