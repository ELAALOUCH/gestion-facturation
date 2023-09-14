@extends('Template.dashboard')

@section('content')
<div id="content" class="bg-white/10 col-span-9 rounded-lg p-6 flex flex-col  ">
    <div id="24h">

        <div id="stats" class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-blue-900 to-white/5 p-6 rounded-lg">
                <div class="flex flex-row space-x-4 items-center">
                    <div id="stats-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                          </svg>
                    </div>
                    <div>
                        <p class="text-indigo-300 text-sm font-medium uppercase leading-4">Users</p>
                        <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                            <span>{{$nbrUsers}}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-900 p-6 rounded-lg">
                <div class="flex flex-row space-x-4 items-center">
                    <div id="stats-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>

                    </div>
                    <div>
                        <p class="text-teal-300 text-sm font-medium uppercase leading-4">Chiffre d'affaire</p>
                        <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                            <span>{{$totalCA}} MAD</span>

                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-900 p-6 rounded-lg">
                <div class="flex flex-row space-x-4 items-center">
                    <div id="stats-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                          </svg>

                    </div>
                    <div>
                        <p class="text-blue-300 text-sm font-medium uppercase leading-4">Factures</p>
                        <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                            <span>{{$totalInvoice}}</span>

                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-900 p-6 rounded-lg">
                <div class="flex flex-row space-x-4 items-center">
                    <div id="stats-1">
                        <svg class="w-10 h-10 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z"/>
                          </svg>

                    </div>
                    <div>
                        <p class="text-red-300 text-sm font-medium uppercase leading-4">Clients</p>
                        <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                            <span>{{$totalClient}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row mt-16 gap-x-4">
        <div class="rounded-lg border w-1/3 ">
            <h2 class="font-roboto pb- font-semibold text-blue-950 text-center py-8 italic">{{ $chart1->options['chart_title'] }}</h2>
            {!! $chart1->renderHtml() !!}
        </div>

        <div class="rounded-lg border w-2/3 px-2 ">
            <h2 class="font-roboto pb- font-semibold text-blue-950 text-center py-8 italic ">{{ $chart2->options['chart_title'] }}</h2>
                    {!! $chart2->renderHtml() !!}
        </div>
    </div>
    <div class="flex flex-row mt-16 gap-x-4">
        <div class=" w-1/2 ">
            <h2 class="font-roboto pb- font-semibold text-blue-950 text-center py-2 italic">Top clients par chiffre d'affaire</h2>

            <div class="relative overflow-x-auto">
                <table class="w-full px-2 text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Client
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Chiffre d'affaire
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customersWithTotalTVA as $customer)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$customer->nom}}
                            </th>
                            <td class="px-6 py-4">
                               {{ $customer->total_tva_sum}} MAD
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

        <div class=" w-1/2 ">
            <h2 class="font-roboto pb- font-semibold text-blue-950 text-center py-2 italic">Top  produits vendus</h2>

            <div class="relative overflow-x-auto">
                <table class="w-full px-2 text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Produit
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantité
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topProducts as $product)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$productDetails = $topProductDetails->where('id', $product->product_id)->first()->designation}}
                            </th>
                            <td class="px-6 py-4">
                                {{ $product->total_quantite }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="flex items-center justify-center">
        <div class=" w-1/2 mt-16  ">
            <h2 class="font-roboto pb- font-semibold text-blue-950 text-center py-2 italic">Top services vendus</h2>

            <div class="relative overflow-x-auto">
                <table class="w-full px-2 text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Service
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantité
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topServices  as $service)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$serviceDetails  = $topServiceDetails->where('id', $service->service_id)->first()->nom}}
                            </th>
                            <td class="px-6 py-4">
                                {{ $service->total_quantite }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection


@section('js')
{!! $chart1->renderChartJsLibrary() !!}

{!! $chart1->renderJs() !!}
{!! $chart2->renderJs() !!}

@endsection
