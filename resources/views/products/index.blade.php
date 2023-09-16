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
            @can('archiver')
            <li class="mr-2">
                <a href="{{route('product.archive')}}" class="@if ($tab =='archive')
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
            @endcan
    </div>

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <div class="flex flex-row pr-5 px-4 pb-2 gap-x-2" >
                <div>
                    <a href="{{ route('product.export') }}" >
                        <button type="button" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 text-white mr-2" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                                <path fill="#4CAF50" d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"></path><path fill="#FFF" d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z"></path><path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"></path><path fill="#FFF" d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z"></path>
                            </svg>
                            Export Excel
                          </button>
                    </a>
                </div>
                <div>
                    <a href="{{ route('product.export-pdf') }}" >
                        <button type="button" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg  class="w-4 h-4 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4.5 11H4v1h.5a.5.5 0 0 0 0-1ZM7 5V.13a2.96 2.96 0 0 0-1.293.749L2.879 3.707A2.96 2.96 0 0 0 2.13 5H7Zm3.375 6H10v3h.375a.624.624 0 0 0 .625-.625v-1.75a.624.624 0 0 0-.625-.625Z"/>
                                <path d="M19 7h-1V2a1.97 1.97 0 0 0-1.933-2H9v5a2 2 0 0 1-2 2H1a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h1a1.969 1.969 0 0 0 1.933 2h12.134c1.1 0 1.7-1.236 1.856-1.614a.988.988 0 0 0 .07-.386H19a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1ZM4.5 14H4v1a1 1 0 1 1-2 0v-5a1 1 0 0 1 1-1h1.5a2.5 2.5 0 1 1 0 5Zm8.5-.625A2.63 2.63 0 0 1 10.375 16H9a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1h1.375A2.63 2.63 0 0 1 13 11.625v1.75ZM17 12a1 1 0 0 1 0 2h-1v1a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h2a1 1 0 1 1 0 2h-1v1h1Z"/>
                              </svg>
                            Export PDF
                          </button>
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                    <div class="w-full md:w-1/2 flex flex-row items-center">
                        <form class="flex items-center pl-4" action="{{route('product.search')}}" method="GET">
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
                    <div>
                        @can('creer')
                        <button type="button" class="text-white bg-gradient-to-r font-roboto from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2 text-center mr-2 mb-2 ">
                            <a href="{{route('product.create')}}">Ajouter</a>
                        </button>
                        @endcan
                    </div>
                </div>
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
                                        <span class=" text-blue-800 text-sm font-roboto   ">{{$product->designation}}</span>
                                    </div>
                                </th>
                                <td class="px-4 py-3">
                                    <span class=" bg-green-100 text-green-800 text-xs font-roboto mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{$product->category->categorie ?? ''}}</span>
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
                                    <div class="flex items-center space-x-4">
                                        <form action="{{route('product.edit',['product' =>$product->id])}}" method="GET">
                                            @csrf
                                            @can('editer')
                                            <button type="submit" data-drawer-target="drawer-update-product" data-drawer-show="drawer-update-product" aria-controls="drawer-update-product" class="py-2 px-3 flex items-center text-sm font-roboto text-center text-white bg-blue-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                </svg>
                                                Editer
                                            </button>
                                            @endcan
                                        </form>
                                        @can('archiver')
                                        <button type="button" data-modal-target={{$product->id}} data-modal-toggle={{$product->id}} class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-roboto rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                            <svg class="h-4 w-4 mr-2 -ml-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                                <path d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z"/>
                                              </svg>
                                            Archiver
                                        </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            <!-- Delete Modal -->
                            <div id={{$product->id}} tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full h-auto max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle={{$product->id}}>
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                                            <form action="{{route('product.destroy',['product'=> $product->id])}}" method="POST" >
                                                @method('DELETE')
                                                @csrf
                                                <button data-modal-toggle={{$product->id}} type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Yes, I'm sure</button>
                                            </form>
                                            <button data-modal-toggle={{$product->id}} type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  end Delete Modal -->
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
