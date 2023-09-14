@extends('Template.dashboard')

@section('content')
        <div class="border-b border-gray-200 dark:border-gray-700 pl-6">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <li class="mr-2">
                    <a href="{{route('invoice.index')}}" class="@if ($tab =='index')
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
                    <a href="{{route('invoice.archive')}}" class="@if ($tab =='archive')
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
            </ul>
        </div>

         <div class="mx-auto max-w-screen-2xl px-4 lg:px-2 pt-4">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-4">Numéro de facture </th>
                            <th scope="col" class="px-4 py-3">Client</th>
                            <th scope="col" class="px-4 py-3">Type</th>

                            <th scope="col" class="px-4 py-3">La date de facture </th>
                            <th scope="col" class="px-4 py-3">La date d'échéance</th>
                            <th scope="col" class="px-4 py-3">Etat de paiement</th>

                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice )

                        <tr class="border-b dark:border-gray-700">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$invoice->numero}}</th>
                            <td class="px-4 py-3">{{$invoice->customer->nom ?? ''}}</td>
                            <td class="px-4 py-3 uppercase">{{$invoice->type}}</td>

                            <td class="px-4 py-3">{{$invoice->date}}</td>
                            <td class="px-4 py-3">{{$invoice->date_echeance}}</td>
                            <td class="px-4 py-3">{{$invoice->etat_paiement}}</td>
                            <td class="px-4 py-3 font-roboto text-gray-900 whitespace-nowrap dark:text-white">
                                <form action="{{route('invoice.restore',['id'=>$invoice->id])}}" method="POST" >
                                    @method('PATCH')
                                    @can('restorer')
                                    <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                                        <span class="relative px-2 py-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                            Restaurer
                                        </span>
                                    </button>
                                    @endcan
                                    @csrf
                                </form>
                        </td>

                        </tr>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">
            {{$invoices->links('pagination::tailwind')}}
        </div>
    </div>
@endsection
