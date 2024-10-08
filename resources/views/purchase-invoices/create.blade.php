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
        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Créer  une facture d'achat</span>
        </div>
    </li>
    </ol>
</nav>
<form action="{{route('purchase.store')}}" method="POST" enctype="multipart/form-data" class="px-10 pt-10" >
    @csrf

    <div class="flex flex-col" x-data="{type:'produit', etat: 'En attente',moyen:'' ,orderProducts: [{ product_id: '', price:'' ,quantity: 1 },],

         }">
            <div class="grid gap-6 mb-6 md:grid-cols-3">
                <div>
                    <label for="fornisseur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Le fournisseur</label>
                    <select id="fournisseur" name="fournisseur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        @foreach ($suppliers as $supplier )
                        <option value="{{$supplier->id}}">{{$supplier->nom}}</option>
                        @endforeach
                    </select>
                    @error('fornisseur') <span >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">La date de facture </label>
                    <input value="{{$currentDate}}" type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                    @error('date') <span >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="date_echeance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">La date d'échéance  </label>
                    <input  type="date" name="date_echeance" id="date_echeance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"    >
                    @error('date_echeance') <span >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service / Produit </label>
                    <select x-model="type" id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="produit">Produit</option>
                    <option value="service">Service</option>
                    </select>
                    @error('type') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="etat_paiement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Etat de paiement</label>
                    <select  x-model="etat" id="etat_paiement" name="etat_paiement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="En attente">En attente</option>
                    <option value="Payée">Payée</option>
                    </select>
                    @error('etat_paiement') <span>{{ $message }}</span> @enderror
                </div>
                <div x-show="etat == 'Payée'">
                    <label for="moyen_paiement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Moyen de paiement</label>
                    <select  x-model='moyen' id="moyen_paiement" name="moyen_paiement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Sélectionnez un moyen de paiement</option>
                        <option value="espèce">espèce</option>
                        <option value="chèque">chèque</option>
                        <option value="virement">virement</option>
                    </select>
                    @error('moyen_paiement') <span class="text-red-300">{{ $message }}</span> @enderror
                </div>
                <div x-show="etat == 'Payée' && moyen=='chèque'">
                    <label for="n_cheque" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de chèque</label>
                    <input type="text" name="n_cheque" id="n_cheque" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  >
                    @error('n_cheque') <span class="text-red-300">{{ $message }}</span> @enderror

                </div>
                <div x-show="etat == 'Payée' && moyen=='virement'">
                    <label for="n_virement" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de virement</label>
                    <input type="text" name="n_virement" id="n_virement" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                    @error('n_virement') <span class="text-red-300">{{ $message }}</span> @enderror

                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="document"> La facture </label>
                    <input name="document" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"  id="document" type="file">
                    @error('document') <span class="text-red-300">{{ $message }}</span> @enderror
                </div>
                <div x-show="etat == 'Payée'">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="document">Justif de paiement </label>
                    <input name="justif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"  id="document" type="file">
                    @error('justif') <span class="text-red-300">{{ $message }}</span> @enderror
                </div>
            </div>


            <div x-show=" type == 'produit' ">
                <template x-for="(product, index) in orderProducts" :key="index">
                    <div class="grid gap-6 mb-6 md:grid-cols-5 items-center">
                        <div>
                            <label :for="'product-' + index" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produit</label>
                            <select x-bind:required="type === 'produit'" x-model="product.product_id" required :id="'product-' + index" :name="'Products[' + index + '][product_id]'" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Sélectionnez un produit</option>
                                @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->designation}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label :for="'prix-' + index" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix Unitaire</label>
                            <input  x-bind:required="type === 'produit'" x-model="product.price" type="text" :name="'Products[' + index + '][price]'" :id="'prix-' + index" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                        <div>
                            <label :for="'quantite-' + index" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantité</label>
                            <input x-bind:required="type === 'produit'" x-model="product.quantity" type="number" min="1" :name="'Products[' + index + '][quantity]'" :id="'quantite-' + index" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                        <div class="mt-6">
                            <button type="button" @click="orderProducts.splice(index, 1)" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center ">
                                <svg class="w-4 h-4 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </template>

                <div  x-show=" type == 'produit' ">
                    <button @click="orderProducts.push({ product_id: '', price:'' ,quantity: 1 })" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 21">
                            <path d="M15 14H7.78l-.5-2H16a1 1 0 0 0 .962-.726l.473-1.655A2.968 2.968 0 0 1 16 10a3 3 0 0 1-3-3 3 3 0 0 1-3-3 2.97 2.97 0 0 1 .184-1H4.77L4.175.745A1 1 0 0 0 3.208 0H1a1 1 0 0 0 0 2h1.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 10 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3Zm-8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm8 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                            <path d="M19 3h-2V1a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V5h2a1 1 0 1 0 0-2Z"/>
                          </svg>
                          Insérer un nouveau produit
                      </button>
                </div>
            </div>

            <div x-show=" type=='service' "  class="grid gap-6 mb-6 md:grid-cols-5 items-center">
                <div>
                    <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Le nom de service </label>
                    <input x-bind:required="type === 'service'" type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                    @error('nom') <span >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="prix" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix</label>
                    <input x-bind:required="type === 'service'" type="text" name="prix" id="prix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                    @error('prix') <span >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description </label>
                    <textarea x-bind:required="type === 'service'"  type="description" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   cols="100" rows="2"></textarea>
                    @error('description') <span >{{ $message }}</span> @enderror
                </div>
            </div>
    </div>

    <div class="flex items-center justify-center">
        <button type="submit" class="text-white bg-gradient-to-r  from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Valider</button>
    </div>
</form>


@endsection
