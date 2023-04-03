@extends('layouts.app')

@section('content')
    <div class="flex flex-col">
        <h1 class="text-3xl font-bold mb-8">All Stations</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                        Name
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                        City
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                        Address
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                        Latitude
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                        Longitude
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">Is
                        Open
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($estations as $estation)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="flex items-center">
                                <div>
                                    <div class="text-sm leading-5 font-medium text-gray-900">{{ $estation->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="text-sm leading-5 text-gray-900">{{ $estation->city }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="text-sm leading-5 text-gray-900">{{ $estation->address }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="text-sm leading-5 text-gray-900">{{ $estation->latitude }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                            <div class="text-sm leading-5 text-gray-900">{{ $estation->longitude }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $estation->is_open ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $estation->is_open ? 'Open' : 'Closed' }}
                        </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('estations.edit', ['estation' => $estation->id]) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 14.707a1 1 0 0 1-1.414-1.414l6-6a1 1 0 0 1 1.414 0l2.293 2.293a1 1 0 0 1 0 1.414l-6 6a1 1 0 0 1-1.414 0zM13 7.414L10.586 5H13v2.414z" clip-rule="evenodd" />
                                </svg>
                                Edit
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form id="delete-form" action="{{ route('estations.destroy', ['id' => $estation->id]) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-red-600 hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"
                                        onclick="return confirmDelete()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M6 8v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2zm6-2V5a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v1H4a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1v6a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-6h1a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-2zm-4 0h2v1h-2V6zM8 8v8h4V8H8z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>

                            <script>
                                function confirmDelete() {
                                    return confirm("Are you sure you want to delete this E-station?");
                                }
                            </script>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
