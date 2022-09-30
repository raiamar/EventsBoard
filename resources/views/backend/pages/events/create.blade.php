@extends('backend.layouts.master')

@section('body')

<main class="h-full overflow-y-auto">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ $page }}
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
                </span>
            </div>
            <span><a href="{{route('event')}}">Event &RightArrow;</a></span>
        </div>


        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            
            <form class="w-full p-10 mx-auto" action="{{route('manage.event')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <x-inline-form-input label="Event Title" value="{{old('title')}}" required="*" type="text" name="title"/>
                    <x-inline-form-input label="Event Info" value="{{old('info')}}" required="*" type="text" name="info"/>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <x-inline-form-input label="Thumbnail" name="thumbnail" required="*" type="file"/>
                    <x-inline-form-input label="QR Code" name="qr_code" type="file"/>
                </div>


                <div class="flex flex-wrap -mx-3 mb-6">
                    <x-inline-form-input label="End Date" value="{{old('end_date')}}" required="*" type="datetime-local" name="end_date"/>
                    <x-inline-form-input label="End Date" value="{{old('end_date')}}" required="*" type="datetime-local" name="end_date"/>
                </div>



                <div class="grid grid-cols-4">
                    <x-form-input label="Event At" value="{{old('address')}}" required="*" type="text" name="address"/>
                    <x-form-input label="Form Fee" value="{{old('form_fee')}}"  type="number" name="form_fee"/>
                    <x-form-input label="Ticket Price" value="{{old('ticket_price')}}" type="number" name="ticket_price"/>

                    <x-form-select name="pre_booking" label="Pre-Booking"  > 
                        <option value="1">YES</option>
                        <option value="0" selected>NO</option>
                    </x-form-select >
                </div>



                {{-- <div class="grid grid-cols-1"> --}}
                    <div class="w-full mb-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            Category
                        </label>
                    
                        <select name="category[]" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded p-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 multi-select" multiple="multiple">
                           @foreach ($category as $item)
                               <option value="{{$item->category_title}}">{{$item->category_title}}</option>
                           @endforeach
                        </select>                    
                    </div>
                {{-- </div> --}}
                

                  <button type="submit" class="focus:outline-none text-gray bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Submit
                  </button>
        
              </form>


        </div>


    </div>
</main>



@endsection