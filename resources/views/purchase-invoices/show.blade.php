@extends('Template.dashboard')

@section('content')
<nav class="flex px-10" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
    <li class="inline-flex items-center">
        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
        </svg>
        Home
        </a>
    </li>
    <li>
        <div class="flex items-center">
        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <a href="{{route('purchase.index')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white"> Les factures d'achat </a>
        </div>
    </li>
    <li aria-current="page">
        <div class="flex items-center">
        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Voir facture d'achat</span>
        </div>
    </li>
    </ol>
</nav>
    <div  class="px-10 ">
            <div class="flex flex-col">
                <p class=" h-11 w-full pt-2.5 bg-blue-50 my-8 pl-2 font-roboto font-bold text-blue-950 border-l-4 border-blue-900">Le infos de la  facture :</p>

                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="fournisseur" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Le fournissseur</label>
                            <input value="{{$invoice->supplier->nom}}" disabled  type="text" name="fournisseur" id="fournisseur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                        </div>
                        <div>
                            <label for="type" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Type </label>
                            <input value="{{$invoice->type}}" disabled type="text" name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                        </div>

                        <div>
                            <label for="date" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">La date de facture </label>
                            <input value="{{$invoice->date}}" disabled type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                        </div>
                        <div>
                            <label for="date_echeance" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">La Date d'échéance  </label>
                            <input value="{{$invoice->date_echeance}}" disabled  type="date" name="date_echeance" id="date_echeance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
                        </div>
                        <div>
                            <label for="etat_paiement" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Etat de paiement  </label>
                            <input value= @if($invoice->etat_paiement=="1") "Payé" @else "En attente" @endif disabled  type="text" name="etat_paiement" id="etat_paiement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
                        </div>
                        @if ($invoice->moyen_paiement)
                        <div>
                            <label for="moyen_paiement" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Moyen de paiement  </label>
                            <input value="{{$invoice->moyen_paiement}}" disabled  type="text" name="moyen_paiement" id="moyen_paiement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
                        </div>
                        @endif

                        @if ($invoice->no_cheque)
                        <div>
                            <label for="no_cheque" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Numero de cheque  </label>
                            <input value="{{$invoice->no_cheque}}" disabled  type="text" name="no_cheque" id="no_cheque" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
                        </div>
                        @endif

                        @if ($invoice->no_virement)
                        <div>
                            <label for="no_virement" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Numero  de virement  </label>
                            <input value="{{$invoice->no_virement}}" disabled  type="text" name="no_virement" id="no_virement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
                        </div>
                        @endif
                    </div>

                        @if ($invoice->type == "service")
                        <p class=" h-11 w-full pt-2.5 bg-blue-50 my-8 pl-2 font-roboto font-bold text-blue-950 border-l-4 border-blue-900">Le Service :</p>
                        <div  class="grid gap-6 mb-6 md:grid-cols-5 items-center">

                            <div>
                                <label for="nom" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Le nom de service </label>
                                <input value="{{ $invoice->purchaseItems->first()->service->nom}}"  type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                            </div>
                            <div>
                                <label for="prix" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Prix</label>
                                <input value="{{ $invoice->purchaseItems->first()->service->prix}}"  type="text" name="prix" id="prix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                            </div>
                            <div>
                                <label for="description" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Description </label>
                                <textarea  type="description" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   cols="14" rows="2">{{ $invoice->purchaseItems->first()->service->description}}</textarea>
                            </div>
                            </div>
                        @else

                        <p class=" h-11 w-full pt-2.5 bg-blue-50 my-8 pl-2 font-roboto font-bold text-blue-950 border-l-4 border-blue-900">Les produits :</p>
                        @foreach ($invoice->purchaseItems as $key => $value)
                            <div class="grid gap-6 mb-6 md:grid-cols-5 items-center">
                                <div>
                                        <div>
                                            <label for="product{{$key}}" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Produit</label>
                                            <input value="{{$value->product->designation}}" disabled type="text" name="product" id="product{{$key}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="prix{{$key}}" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Prix Unitaire</label>
                                        <input value="{{$value->prix_unitaire	}}" disabled  type="text" name="prix" id="prix{{$key}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                                    </div>

                                    <div>
                                        <label for="quantite{{$key}}" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Quantite</label>
                                        <input value="{{$value->quantite	}}" disabled   min="1" name="quantite" id="quantite{{$key}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                                    </div>

                                </div>
                @endforeach

                        @endif

                </div>
            </div>
@endsection
