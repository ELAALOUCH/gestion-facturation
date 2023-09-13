@extends('Template.dashboard')

@section('content')



    <div class="border-b border-gray-200 dark:border-gray-700 pl-6">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            <li class="mr-2">

                <a href="{{route('service.index')}}" class="@if ($tab =='index')
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
                <a href="{{route('service.archive')}}" class="@if ($tab =='archive')
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
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                    <div class="w-full md:w-1/2 flex flex-row items-center">
                        <form class="flex items-center pl-4" action="{{route('service.search')}}" method="GET">
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
                            <button type="button" class="text-white bg-gradient-to-r font-roboto from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2 text-center mr-2 mb-2 ">
                                <a href="{{route('service.create')}}">Ajouter</a>
                            </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="p-4 uppercase font-roboto">Service</th>
                                <th scope="col" class="p-4 uppercase font-roboto">Type</th>
                                <th scope="col" class="p-4 uppercase font-roboto">Description</th>
                                <th scope="col" class="p-4 uppercase font-roboto"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3">
                                    <span class=" bg-green-100 text-green-800 text-xs font-roboto mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{$service->nom}}</span>
                                </td>

                                <td class="px-4 py-3 font-roboto text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center uppercase font-semibold ">
                                        {{$service->type}}
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-roboto text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center">
                                        {{ Str::limit($service->description, 60) }}
                                    </div>
                                </td>

                                <td class="px-4 py-3 font-roboto text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center space-x-4">
                                        <form action="{{route('service.edit',['service' =>$service->id])}}" method="GET">
                                            @csrf
                                            <button type="submit" data-drawer-target="drawer-update-service" data-drawer-show="drawer-update-service" aria-controls="drawer-update-service" class="py-2 px-3 flex items-center text-sm font-roboto text-center text-white bg-blue-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                </svg>
                                                Editer
                                            </button>
                                        </form>
                                        @if ($service->type=="interne")
                                        <button type="button" data-modal-target={{$service->id}} data-modal-toggle={{$service->id}} class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-roboto rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            Supprimer
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <!-- Delete Modal -->
                            <div id={{$service->id}} tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full h-auto max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle={{$service->id}}>
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-6 text-center">
                                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this service?</h3>
                                            <form action="{{route('service.destroy',['service'=> $service->id])}}" method="POST" >
                                                @method('DELETE')
                                                @csrf
                                                <button data-modal-toggle={{$service->id}} type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Yes, I'm sure</button>
                                            </form>
                                            <button data-modal-toggle={{$service->id}} type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
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
                {{$services->links('pagination::tailwind')}}
            </div>
        </div>
    </section>
    <!-- End block -->





@endsection
