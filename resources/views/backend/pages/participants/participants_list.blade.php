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
                        {{ $breadcrum }} | {{ $event_name->title }}
                    </span>
                </div>
            </div>

            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Age</th>
                                <th class="px-4 py-3">Gender</th>
                                <th class="px-4 py-3">Payment</th>
                                <th class="px-4 py-3">Conformation</th>
                                <th class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                            @foreach ($data as $item)
                                <tr class="text-gray-700 dark:text-gray-400">

                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <!-- Avatar with inset shadow -->
                                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src="{{ asset($item->pp_image) }}" alt="" loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-semibold">{{ $item->name }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->age }} Years
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        @foreach (GenderType::getGenderType() as $key => $value)
                                            @if ($value == $item->gender)
                                                {{ $key }}
                                            @endif
                                        @endforeach
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            {{ $item->payment_conformation == 1 ? 'Paid' : 'Unpaid' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-blue-700 bg-blue-100 rounded-full dark:bg-blue-700 dark:text-blue-100">
                                            {{ $item->conformation == 1 ? 'Accepted' : 'Pending' }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-xs">
                                        <a href="{{ route('view.participant.details', ['id' => $item->id]) }}" title="view"
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
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
