@extends('backend.layouts.master')

@section('body')
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                {{-- {{ $page }} --}}
            </h2>
            <!-- CTA -->
            <div
                class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">

                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                    <span>
                        <a href="{{ route('dashboard') }}">
                            Dashboard |
                        </a>
                        {{ $breadcrum }}
                        {{-- \| {{ $event_name->title }} --}}
                    </span>
                </div>
            </div>

            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow">
                <div class="w-full overflow-x-auto">

                    <p class="p-2">
                        Name: {{ $participant->name }}
                    </p>
                    <p class="p-2">
                        Email : {{ $participant->email }}
                    </p>
                    <p class="p-2">
                        Age : {{ $participant->age }}
                    </p>
                    <p class="p-2">
                        Height : {{ $participant->height }}
                    </p>
                    <p class="p-2">
                        Weight : {{ $participant->weight }}
                    </p>
                    <p class="p-2">
                        Phone No : {{ $participant->phone_no }}
                    </p>
                    <p class="p-2">
                        Optional Number : {{ $participant->optional_number }}
                    </p>
                    <p class="p-2">
                        Permanent Address : {{ $participant->permanent_address }}
                    </p>
                    <p class="p-2">
                        Temporary Address : {{ $participant->temporary_address }}
                    </p>

                    <p class="p-2">
                        Details: {{ $participant->participant_details }}
                    </p>
                    <p class="p-2">
                        Guardian: {{ $participant->participant_gaurdian }}
                    </p>
                    <p class="p-2">
                        Gender: @foreach (GenderType::getGenderType() as $key => $value)
                            @if ($value == $participant->gender)
                                {{ $key }}
                            @endif
                        @endforeach
                    </p>
                    <p class="p-2">
                        Details: {{ $participant->details }}
                    </p>
                    <p class="p-2">
                        payment Method: {{ $participant->payment_method }}
                    </p>
                    <p class="p-2">
                        QR Payment: {{ $participant->qrcode_payment }}
                    </p>
                    <p class="p-2">
                        Payment Registration: {{ $participant->payment_reg }}
                    </p>
                    <p class="p-2">
                        Payment Confirmation : {{ $participant->payment_conformation }}
                    </p>
                    <p class="p-2">
                        Reference : {{ $participant->reference }}
                    </p>
                    <p class="p-2">
                        Confirmation: {{ $participant->conformation }}
                    </p>
                    <p class="p-2">
                        Social Media: {{ $participant->social_media }}
                    </p>
                    <p class="p-2">
                        Extra: {{ $participant->extra }}
                    </p>
                </div>

            </div>


        </div>
    </main>
@endsection
