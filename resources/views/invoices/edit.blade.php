@extends('Template.dashboard')

@section('content')
<form action="{{route('invoice.update',['invoice'=>$invoice->id])}}" method="POST"  >
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
                    <option value="0">En attente</option>
                    <option value="1">Payé</option>
                    </select>
                    @error('etat_paiement') <span>{{ $message }}</span> @enderror
                </div>
                <div x-show="etat == '1'">
                    <label for="moyen_paiement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Moyen de paiement</label>
                    <select  x-model='moyen' id="moyen_paiement" name="moyen_paiement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Sélectionnez un moyen de paiement</option>
                        <option value="espèce">espèce</option>
                        <option value="chèque">chèque</option>
                        <option value="virement">virement</option>
                    </select>
                    @error('moyen_paiement') <span class="text-red-300">{{ $message }}</span> @enderror
                </div>
                <div x-show="etat == '1' && moyen=='chèque'">
                    <label for="n_cheque" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de chèque</label>
                    <input value="{{$invoice->no_cheque}}" type="text" name="n_cheque" id="n_cheque" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  >
                    @error('n_cheque') <span class="text-red-300">{{ $message }}</span> @enderror

                </div>
                <div x-show="etat == '1' && moyen=='virement'">
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
