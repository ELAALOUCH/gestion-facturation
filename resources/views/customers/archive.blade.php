@extends('Template.dashboard')

@section('content')




       <div class="border-b border-gray-200 dark:border-gray-700 pl-6">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            <li class="mr-2">

                <a href="{{route('customer.index')}}" class="@if ($tab =='index')
                inline-flex items-center justify-center p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group
                @else
                inline-flex font-roboto items-center justify-center p-4 f border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300  group
                @endif">

                    <svg class="@if ($tab=='index')
                    w-4 h-4 mr-2 text-blue-600
                    @else
                    w-4 h-4 mr-2 text-gray-400 group-hover:text-gray-500
                    @endif " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M6 1h10M6 5h10M6 9h10M1.49 1h.01m-.01 4h.01m-.01 4h.01"/>
                      </svg>
                    List
                </a>
            </li>
            <li class="mr-2">
                <a href="{{route('customer.archive')}}" class="@if ($tab =='archive')
                inline-flex items-center justify-center p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group
                @else
                inline-flex font-roboto items-center justify-center p-4 f border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300  group
                @endif" aria-current="page">
                    <svg class="@if ($tab=='archive')
                    w-4 h-4 mr-2 text-blue-600
                    @else
                    w-4 h-4 mr-2 text-gray-400 group-hover:text-gray-500
                    @endif " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M8 8v1h4V8m4 7H4a1 1 0 0 1-1-1V5h14v9a1 1 0 0 1-1 1ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z"/>
                      </svg>
                    Archive
                </a>
            </li>

    </div>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-4">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                
                <div class="overflow-x-auto">
                    <table class=" w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-4 font-roboto ">Code client</th>
                                <th scope="col" class="px-4 py-3 font-roboto">nom</th>
                                <th scope="col" class="px-4 py-3 font-roboto">ville</th>
                                <th scope="col" class="px-4 py-3 font-roboto">email</th>
                                <th scope="col" class="px-4 py-3 font-roboto">telephone</th>
                                <th scope="col" class="px-4 py-3 font-roboto">site_web</th>
                                <th scope="col" class="px-4 py-3 font-roboto">
                                <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach ( $customers as $customer )
                        <tr class="border-b dark:border-gray-700">
                            <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto text-center ">{{$customer->code_client}}</td>
                            <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">
                                <span class="bg-blue-100 text-blue-800  font-roboto mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{$customer->nom}}</span>
                            </td>
                            <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">{{$customer->ville}}</td>

                                <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">{{$customer->email}}</td>
                                <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">{{$customer->telephone}}</td>
                                <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">{{$customer->site_web}}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                        <ul class="py-1 text-sm flex flex-row" aria-labelledby="benq-ex2710q-dropdown-button">
                                            <li>
                                                <form action="{{route('customer.restore',['id'=>$customer->id])}}" method="POST" >
                                                    @method('PATCH')
                                                    @csrf
                                                    <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                                        <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                                            Restaurer
                                                        </span>
                                                      </button>
                                                </form>
                                            </li>
                                        </ul>
                                </td>
                            </tr>
                    @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{$customers->links('pagination::tailwind')}}
            </div>
        </div>
    </section>
@endsection

