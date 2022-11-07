@extends('backend.layouts.master')

@section('body')

<div class="grid grid-cols-4 gap-4 m-3">
    @foreach ($data as $item)
    <a href="{{route('participants', $item->id)}}" class="block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 max-h-fit">
        <img class="rounded-t-lg" src="{{asset($item->thumbnail)}}" alt="No Image" />
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$item->title}}</h5>
    </a>

    @endforeach
  </div>

@endsection