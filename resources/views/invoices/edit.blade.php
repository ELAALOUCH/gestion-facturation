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
        <a href="{{route('invoice.index')}}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white"> Les factures de vente </a>
        </div>
    </li>
    <li aria-current="page">
        <div class="flex items-center">
        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Editer la facture de vente </span>
        </div>
    </li>
    </ol>
</nav>
<form action="{{route('invoice.update',['invoice'=>$invoice->id])}}" method="POST"  class="px-10 pt-10" >
    @csrf
    @method('PATCH')

    <div class="flex flex-col" x-data="{ etat: '{{$invoice->etat_paiement}}',moyen:'{{$invoice->moyen_paiement}}',selectedType: '{{$invoice->type}}' , type_produit:'{{$invoice->type_produit}}',orderProducts: [{ product_id: '', price:'' ,quantity: 1 },],orderServices: [{ service_id: '', price:'',quantity: 1 },]}">
            <div class="grid gap-6 mb-6 md:grid-cols-3">
                <div>
                    <label for="numero" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de facture </label>
                    <input readonly value="{{$invoice->numero}}" type="texte" name="numero" id="numero" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                    @error('numero') <span >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="client" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Le client</label>
                    <select id="client" name="client" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        @foreach ($customers as $customer )
                        <option value="{{$customer->id}}">{{$customer->nom}}</option>
                        @endforeach
                    </select>
                    @error('client') <span >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">La date de facture </label>
                    <input value="{{$invoice->date}}" type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                    @error('date') <span >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="date_echeance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">La date d'échéance </label>
                    <input value="{{$invoice->date_echeance}}" type="date" name="date_echeance" id="date_echeance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
                    @error('date_echeance') <span >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                    <select x-model="selectedType" id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option value="tva">TVA</option>
                        <option value="ttc">TTC</option>
                        <option value="exonéré">Exonération de TVA</option>
                    </select>
                    @error('type') <span >{{ $message }}</span> @enderror
                </div>

                <div x-show="selectedType !== 'exonéré'" >
                    <label for="tva" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TVA</label>
                    <input :value="selectedType === 'exonéré' ? 0 : 20" value="{{old('tva',20)}}" min="0" max="100"  type="number" name="tva" id="tva" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                    @error('tva') <span >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="etat_paiement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Etat de paiement</label>
                    <select  x-model="etat" id="etat_paiement" name="etat_paiement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="en attente">En attente</option>
                    <option value="payé">Payé</option>
                    </select>
                    @error('etat_paiement') <span>{{ $message }}</span> @enderror
                </div>
                <div x-show="etat == 'payé'">
                    <label for="moyen_paiement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Moyen de paiement</label>
                    <select  x-model='moyen' id="moyen_paiement" name="moyen_paiement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Sélectionnez un moyen de paiement</option>
                        <option value="espèce">espèce</option>
                        <option value="chèque">chèque</option>
                        <option value="virement">virement</option>
                    </select>
                    @error('moyen_paiement') <span class="text-red-300">{{ $message }}</span> @enderror
                </div>
                <div x-show="etat == 'payé' && moyen=='chèque'">
                    <label for="n_cheque" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de chèque</label>
                    <input value="{{$invoice->no_cheque}}" type="text" name="n_cheque" id="n_cheque" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  >
                    @error('n_cheque') <span class="text-red-300">{{ $message }}</span> @enderror

                </div>
                <div x-show="etat == 'payé' && moyen=='virement'">
                    <label for="n_virement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de virement</label>
                    <input value="{{$invoice->no_virement}}" type="text" name="n_virement" id="n_virement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    @error('n_virement') <span class="text-red-300">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-center">
                <button type="submit" class="text-white bg-gradient-to-r  from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Valider</button>
            </div>

    </div>
</form>
@endsection
