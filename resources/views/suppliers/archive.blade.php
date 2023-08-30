@extends('Template.dashboard')

@section('content')


            {{--session message --}}
        @if (session()->has('status'))
        <div class="flex items-center p-4 my-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
            <span class="font-medium"> {{session()->get('status')}}
            </div>
        </div>
       @endif

       <div class="border-b border-gray-200 dark:border-gray-700 pl-6">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            <li class="mr-2">
                <a href="{{route('supplier.index')}}" class="@if ($tab =='index')
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
                <a href="{{route('supplier.archive')}}" class="@if ($tab =='archive')
                inline-flex items-center justify-center p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group
                @else
                inline-flex font-roboto items-center justify-center p-4 f border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300  group
                @endif ">
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
                <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                    <div class="w-full md:w-1/2 flex flex-row items-center">
                        <form class="flex items-center pl-4" action="{{route('supplier.searchArchive')}}" method="GET">
                            <div class="flex flex-row items-center">
                                <div>
                                    <p class="font-roboto">Show:</p>
                                </div>
                               <input min="1" type="number" name="number" class="bg-gray-50  ml-4 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-16 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="5">
                            </div>
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full ml-4 ">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" />
                                    </svg>
                                </div>
                                <input name="keyword" type="text" id="simple-search" placeholder="Recherche par mot clé"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>
                            <div>
                                <button type="submit" class="text-white bg-gradient-to-r font-roboto from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2 text-center mx-2 ">Valider</button>
                            </div>
                        </form>
                    </div>

                </div>



                <div class="overflow-x-auto">
                    <table class=" w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-4 font-roboto ">ice</th>
                                <th scope="col" class="px-4 py-3 font-roboto">nom</th>
                                <th scope="col" class="px-4 py-3 font-roboto">ville</th>
                                <th scope="col" class="px-4 py-3 font-roboto">email</th>
                                <th scope="col" class="px-4 py-3 font-roboto">telephone</th>
                                <th scope="col" class="px-4 py-3 font-roboto">adresse</th>
                                <th scope="col" class="px-4 py-3 font-roboto">site_web</th>
                                <th scope="col" class="px-4 py-3 font-roboto">
                                <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach ( $suppliers as $supplier )
                        <tr class="border-b dark:border-gray-700"></tr>
                            <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">{{$supplier->ice}}</td>
                            <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">
                                <span class="bg-blue-100 text-blue-800  font-roboto mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{$supplier->nom}}</span>
                            </td>
                            <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">{{$supplier->ville}}</td>

                                <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">{{$supplier->email}}</td>
                                <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">{{$supplier->telephone}}</td>
                                <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">{{$supplier->adresse}}</td>
                                <td scope="row" class="px-4 py-3  text-gray-900 whitespace-nowrap dark:text-white font-roboto ">{{$supplier->site_web}}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                        <ul class="py-1 text-sm flex flex-row" aria-labelledby="benq-ex2710q-dropdown-button">

                                            <li>
                                                <form action="{{route('supplier.restore',['id'=>$supplier->id])}}" method="POST" >
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
                {{$suppliers->links('pagination::tailwind')}}
            </div>
        </div>
    </section>
@endsection
