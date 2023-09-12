@extends('Template.dashboard')

@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
     <div class="flex flex-row px-5 py-8 bg-white " >
                <div>
                    <button type="button" onclick="printDiv()" id="print_Button" class=" w-32 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Impimer PDF</button>
                </div>
                <div class="w-1/2 flex flex-col">
                    <div class="flex items-center justify-center ">
                        <img class="h-32 max-w-xl rounded-lg   " src= {{ (Storage::url($company->logo)) ?? null}} alt="{{$company->logo}}">
                    </div>
                    <div class="text-center pt-4">
                        <p class=" text-blue-600 pt-2 text-xl font-bold uppercase font-serif">{{$company->nom}}</p>
                    </div>
                </div>
                <div class="w-1/2 flex flex-col px-5 ">
                    <div class="font-mono text-xl   ">
                        <p class="py-1">
                            <span class="text-blue-500 uppercase">Date :</span> {{$invoice->date}}
                        </p>
                        <p class="font-mono py-1">
                            <span class="uppercase "> <span class="text-blue-500">Facture N°</span>  {{$invoice->numero}}</span>
                        </p>
                    </div>

                    <div class="pt-2">
                        <fieldset class="border-solid border-2 p-3">
                            <legend class="font-mono">Adressé à </legend>
                            <p class="text-blue-600 font-serif uppercase text-xl py-1 font-bold">{{$invoice->customer->nom}}</p>
                            <p class="font-mono "> Client N° {{$invoice->customer->code_client}}</p>
                            <p class="font-mono ">{{$invoice->customer->adresse}}</p>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class=" mt-2 px-10 py-8 bg-white">
                <div class="relative overflow-x-auto shadow-md ">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-white uppercase bg-blue-600 ">
                            <tr>
                                <th scope="col" class="px-6 py-1">
                                    Désignation
                                </th>
                                <th scope="col" class="px-6 py-1">
                                    Quantité
                                </th>
                                <th scope="col" class="px-6 py-1">
                                    @if ($invoice->type == "ttc")
                                    Prix unitaire TTC
                                    @else
                                    Prix unitaire HT
                                    @endif
                                </th>
                                <th scope="col" class="px-6 py-1">
                                    @if ($invoice->type == "ttc")
                                    Total TTC
                                    @else
                                    Total HT
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->orders as $order)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-2 font-roboto text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$order->product->designation}}
                                </th>
                                <td class="px-6 py-2">
                                    {{$order->quantite}}
                                </td>
                                <td class="px-6 py-2">
                                    @if ($invoice->type == "ttc")
                                    {{ number_format($order->prix+ $order->prix* ($invoice->tva/100) ,2)}} MAD

                                    @else
                                    {{ number_format($order->prix,2)}} MAD
                                    @endif
                                </td>
                                <td class="px-6 py-2">
                                    {{number_format($order->quantite * ($order->prix+ $order->prix* ($invoice->tva/100) ),2)}} MAD
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-5 px-10 flex flex-row items-center bg-white">
                <div class="w-2/3 ">
                    <p class="font-mono">Arrêtée la présente facture à la somme de : </p>
                    <p class="font-mono uppercase py-4 font-bold">{{$integerWords}} et {{$decimalWords}} centimes   </p>
                </div>
                <div class="w-1/3 bg-white">
                    <table class="flex justify-center items-center right-0 text-sm text-left text-gray-500 dark:text-gray-400">

                        <tbody>
                            @if ($invoice->type != 'ttc')
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 text-xs text-gray-700 uppercase ">
                                    TOTAL HT
                                </td>
                                <td class="px-6 py-4 font-bold">
                                    {{number_format( $invoice->total_ht,2)}} MAD
                                </td>
                            </tr>
                            @endif

                            @if ($invoice->type =='tva')
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 text-xs text-gray-700 uppercase ">
                                     tva ({{$invoice->tva}}%)
                                </td>
                                <td class="px-6 py-4 font-bold">
                                    {{number_format( $invoice->total_ht * ($invoice->tva)/100,2)}} MAD
                                </td>
                            </tr>
                            @endif
                            @if ($invoice->type !='exonéré')
                            <tr class="bg-white border-b">
                                <td class="px-6 py-4 text-xs text-gray-700 uppercase ">
                                    TOTAL ttc
                                </td>
                                <td class="px-6 py-4 font-bold">
                                    {{ number_format($invoice->total_tva,2) }} MAD
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="h-12">

            </div>

            <div class=" mx-10 border-t-4  border-blue-600 flex-col items-center justify-center print:fixed print:bottom-4  print:pt-4  bg-white ">

                <div class="flex flex-wrap gap-x-[25px] ">
                    <div class="font-semibold  text-sm font-mono  uppercase ">ICE: {{$company->ice}}</div>
                    <div class="font-semibold  text-sm font-mono uppercase">ADRESSE: {{$company->adresse}}</div>
                    <div class="font-semibold  text-sm font-mono uppercase">TELEPHONE: {{$company->telephone}}</div>

                    <div class="font-semibold  text-sm font-mono uppercase">RIB: {{$company->rib}}</div>
                    <div class="font-semibold  text-sm font-mono uppercase">PATENTE N°{{$company->patente}}</div>
                    <div class="font-semibold  text-sm font-mono uppercase ">RC N°{{$company->rc}}</div>
                    <div class="font-semibold  text-sm font-mono uppercase ">IF N°{{$company->if}}</div>
                    <div class="font-semibold  text-sm font-mono uppercase ">cnss N°{{$company->cnss}}</div>
                </div>

            </div>
@endsection

@section('js')
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>

@endsection
