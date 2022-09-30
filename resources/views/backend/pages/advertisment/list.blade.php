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

                <span><a href="{{ route('adds.create') }}">Create New Advertisment &RightArrow;</a></span>
            </div>


            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Image</th>
                                <th class="px-4 py-3">Type</th>
                                <th class="px-4 py-3">Page</th>
                                <th class="px-4 py-3">Redirect To</th>
                                <th class="px-4 py-3">Order</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                            @if (!$data->isEmpty())
                                @foreach ($data as $item)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3">
                                            <a href="{{ asset($item->thumbnail) }}" target="_blank"
                                                rel="noopener noreferrer">Click to view image</a>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            @foreach (AddType::getAllAddType() as $key => $value)
                                                @if ($item->type == $value)
                                                    {{ $key }}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td class="px-4 py-3 text-sm">

                                            @foreach (AddPageType::getAllAddPageType() as $key => $value)
                                                @if ($item->page == $value)
                                                    {{$key}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $item->redirect_link }}
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            {{ $item->order }}
                                        </td>

                                        <td class="px-4 py-3 text-xs">
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                                <form action="{{ route('adds.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="submit">Delete</a>
                                                </form>
                                            </span>


                                            <span
                                                class="px-2 py-1 ml-3 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                                                <a href="{{ route('adds.edit', $item->id) }}">Edit</a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                                    role="alert">
                                    <span class="font-medium">Advertisment!</span> currently not avialble.
                                </div>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div
                    class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    <span class="flex items-center col-span-3">
                        Showing {{ ($data->currentpage() - 1) * $data->perpage() + 1 }} to
                        {{ $data->currentpage() * $data->perpage() }}
                        of {{ $data->total() }} entries
                    </span>
                    <span class="col-span-2"></span>
                    <!-- Pagination -->
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        {{ $data->links() }}
                    </span>
                </div>
            </div>

        </div>
    </main>
@endsection
