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
            <span><a href="{{route('testimonial')}}">Testimonials &RightArrow;</a></span>
        </div>


        <!-- New Table -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            
            <form class="w-full p-10 mx-auto" action="{{route('manage.testimonial')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                    <x-inline-form-input label="Name" value="{{old('name')}}" required="*" placeholder="Amar Rai" type="text" name="name"/>
                    <x-inline-form-input label="Designation" value="{{old('designation')}}" required="*" placeholder="Chairman at ABC.pvt.ltd" type="text" name="designation"/>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <x-form-input label="Profile" name="thumbnail" required="*" type="file"/>
                </div>


                <div class="flex flex-wrap -mx-3 mb-6">
                    <textarea id="summernote" value="{{old('message')}}" name="message"></textarea>
                </div>



                  <button type="submit" class="focus:outline-none text-gray bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Submit
                  </button>
        
              </form>


        </div>


    </div>
</main>

@endsection