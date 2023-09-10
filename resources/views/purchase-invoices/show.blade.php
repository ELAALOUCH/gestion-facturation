@extends('Template.dashboard')

@section('content')


    <div  class="m-4">
            <div class="flex flex-col">
                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="fournisseur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Le fournissseur</label>
                            <input value="{{$invoice->supplier->nom}}" disabled  type="text" name="fournisseur" id="fournisseur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                        </div>
                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type </label>
                            <input value="{{$invoice->type}}" disabled type="text" name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                        </div>

                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">La date de facture </label>
                            <input value="{{$invoice->date}}" disabled type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                        </div>
                        <div>
                            <label for="date_echeance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">La Date d'échéance  </label>
                            <input value="{{$invoice->date_echeance}}" disabled  type="date" name="date_echeance" id="date_echeance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
                        </div>
                        <div>
                            <label for="etat_paiement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Etat de paiement  </label>
                            <input value= @if($invoice->etat_paiement=="1") "Payé" @else "En attente" @endif disabled  type="text" name="etat_paiement" id="etat_paiement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
                        </div>
                        @if ($invoice->moyen_paiement)
                        <div>
                            <label for="moyen_paiement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Moyen de paiement  </label>
                            <input value="{{$invoice->moyen_paiement}}" disabled  type="text" name="moyen_paiement" id="moyen_paiement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
                        </div>
                        @endif

                        @if ($invoice->no_cheque)
                        <div>
                            <label for="no_cheque" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de cheque  </label>
                            <input value="{{$invoice->no_cheque}}" disabled  type="text" name="no_cheque" id="no_cheque" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
                        </div>
                        @endif

                        @if ($invoice->no_virement)
                        <div>
                            <label for="no_virement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero  de virement  </label>
                            <input value="{{$invoice->no_virement}}" disabled  type="text" name="no_virement" id="no_virement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
                        </div>
                        @endif
                    </div>

                        @if ($invoice->type == "service")
                        <p class="p-4">Le Service :</p>
                        <div  class="grid gap-6 mb-6 md:grid-cols-5 items-center">

                            <div>
                                <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Le nom de service </label>
                                <input value="{{ $invoice->purchaseItems->first()->service->nom}}"  type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                            </div>
                            <div>
                                <label for="prix" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix</label>
                                <input value="{{ $invoice->purchaseItems->first()->service->prix}}"  type="text" name="prix" id="prix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                            </div>
                            <div>
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description </label>
                                <textarea  type="description" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   cols="14" rows="2">{{ $invoice->purchaseItems->first()->service->description}}</textarea>
                            </div>
                            </div>
                        @else

                        <p class="p-4">Les produits :</p>
                        @foreach ($invoice->purchaseItems as $key => $value)
                            <div class="grid gap-6 mb-6 md:grid-cols-5 items-center">
                                <div>
                                        <div>
                                            <label for="product{{$key}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produit</label>
                                            <input value="{{$value->product->designation}}" disabled type="text" name="product" id="product{{$key}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="prix{{$key}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix Unitaire</label>
                                        <input value="{{$value->prix_unitaire	}}" disabled  type="text" name="prix" id="prix{{$key}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                                    </div>

                                    <div>
                                        <label for="quantite{{$key}}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantite</label>
                                        <input value="{{$value->quantite	}}" disabled   min="1" name="quantite" id="quantite{{$key}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                                    </div>

                                </div>
                @endforeach

                        @endif

                </div>
            </div>
@endsection
