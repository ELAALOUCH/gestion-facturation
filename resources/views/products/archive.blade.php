@extends('Template.dashboard')

@section('content')



    <div class="border-b border-gray-200 dark:border-gray-700 pl-6">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            <li class="mr-2">
                <a href="{{route('product.index')}}" class="@if ($tab =='index')
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
                <a href="{{route('product.archive')}}" class="@if ($tab =='archive')
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
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4 uppercase font-roboto">Produit</th>
                                <th scope="col" class="p-4 uppercase font-roboto">Categorie</th>
                                <th scope="col" class="p-4 uppercase font-roboto">Stock</th>
                                <th scope="col" class="p-4 uppercase font-roboto">Stock de Securite</th>
                                <th scope="col" class="p-4 uppercase font-roboto">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <th scope="row" class="px-4 py-3 font-roboto text-gray-900 font-roboto whitespace-nowrap dark:text-white">
                                    <div class="flex items-center mr-3">
                                        @if ($product->photo)
                                        <img src="{{ (Storage::url($product->photo))}}" class="h-8 w-auto mr-3">
                                        @endif
                                        <span class=" text-blue-800 text-sm font-roboto mr-2  dark:bg-blue-900 dark:text-blue-300">{{$product->designation}}</span>
                                    </div>
                                </th>
                                <td class="px-4 py-3">
                                    <span class=" bg-green-100 text-green-800 text-xs font-roboto mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{$product->category->categorie ?? null}}</span>
                                </td>
                                <td class="px-4 py-3 font-roboto text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center">
                                        @if ($product->stock >= $product->stock_alert)
                                            <div class="h-4 w-4 rounded-full inline-block mr-2 bg-green-700"></div>
                                        @else
                                            <div class="h-4 w-4 rounded-full inline-block mr-2 bg-red-700"></div>
                                        @endif
                                        {{$product->stock}}
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-roboto text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center">
                                        {{$product->stock_alert}}
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-roboto text-gray-900 whitespace-nowrap dark:text-white">
                                        <form action="{{route('product.restore',['id'=>$product->id])}}" method="POST" >
                                            @method('PATCH')
                                            @csrf
                                            @can('restorer')
                                            <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                                <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                                    Restaurer
                                                </span>
                                              </button>
                                            @endcan
                                        </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                {{$products->links('pagination::tailwind')}}
            </div>
        </div>
    </section>
    <!-- End block -->





@endsection
