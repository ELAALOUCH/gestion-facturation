@extends('Template.dashboard')

@section('content')
<form action="{{route('invoice.store')}}" method="POST"  >
    @csrf

    <div class="flex flex-col" x-data="{ selectedType: 'tva' , type_produit:'produit',orderProducts: [{ product_id: '', price:'' ,quantity: 1 },],orderServices: [{ service_id: '', price:''  },]}">
            <div class="grid gap-6 mb-6 md:grid-cols-3">
                <div>
                    <label for="numero" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de facture </label>
                    <input readonly value="{{$numero}}" type="texte" name="numero" id="numero" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
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
                    <input value="{{$currentDate}}" type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                    @error('date') <span >{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="date_echeance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">La date d'échéance </label>
                    <input value="{{$currentDate}}" type="date" name="date_echeance" id="date_echeance" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   >
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
                <div>
                    <label for="type_produit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produit / Serivce </label>
                    <select x-model="type_produit" id="type_produit" name="type_produit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option value="produit">Produit</option>
                        <option value="service">Service</option>
                    </select>
                    @error('type_produit') <span >{{ $message }}</span> @enderror
                </div>
                <div x-show="selectedType !== 'exonéré'" >
                    <label for="tva" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TVA</label>
                    <input :value="selectedType === 'exonéré' ? 0 : 20" value="{{old('tva',20)}}" min="0" max="100"  type="number" name="tva" id="tva" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                    @error('tva') <span >{{ $message }}</span> @enderror
                </div>
            </div>

            <div x-show=" type_produit == 'produit' ">
                <template x-for="(product, index) in orderProducts" :key="index">
                    <div class="grid gap-6 mb-6 md:grid-cols-5 items-center">
                        <div>
                            <label :for="'product-' + index" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produit</label>
                            <select x-bind:required="type_produit === 'produit'" x-model="product.product_id" required :id="'product-' + index" :name="'Products[' + index + '][product_id]'" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Sélectionnez un produit</option>
                                @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->designation}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label :for="'prix-' + index" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix Unitaire</label>
                            <input  x-bind:required="type_produit === 'produit'" x-model="product.price" type="text" :name="'Products[' + index + '][price]'" :id="'prix-' + index" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                        <div>
                            <label :for="'quantite-' + index" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantité</label>
                            <input x-bind:required="type_produit === 'produit'" x-model="product.quantity" type="number" min="1" :name="'Products[' + index + '][quantity]'" :id="'quantite-' + index" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
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

                <div >
                    <button @click="orderProducts.push({ product_id: '', price:'' ,quantity: 1 })" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 21">
                            <path d="M15 14H7.78l-.5-2H16a1 1 0 0 0 .962-.726l.473-1.655A2.968 2.968 0 0 1 16 10a3 3 0 0 1-3-3 3 3 0 0 1-3-3 2.97 2.97 0 0 1 .184-1H4.77L4.175.745A1 1 0 0 0 3.208 0H1a1 1 0 0 0 0 2h1.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 10 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3Zm-8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm8 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                            <path d="M19 3h-2V1a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V5h2a1 1 0 1 0 0-2Z"/>
                          </svg>
                          Insérer un nouveau produit
                      </button>
                </div>
            </div>


            <div x-show=" type_produit == 'service' ">
                <template x-for="(product, index) in orderServices" :key="index">
                    <div class="grid gap-6 mb-6 md:grid-cols-5 items-center">
                        <div>
                            <label :for="'product-' + index" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service</label>
                            <select x-bind:required="type_produit === 'service'" x-model="product.product_id" required :id="'product-' + index" :name="'Services[' + index + '][service_id]'" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Sélectionnez un produit</option>
                                @foreach ($services as $service)
                                <option value="{{$service->id}}">{{$service->nom}}({{$service->type}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label :for="'prix-' + index" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prix </label>
                            <input  x-bind:required="type_produit === 'service'" x-model="product.price" type="text" :name="'Services[' + index + '][price]'" :id="'prix-' + index" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                        </div>
                        <div class="mt-6">
                            <button type="button" @click="orderServices.splice(index, 1)" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center ">
                                <svg class="w-4 h-4 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </template>

                <div >
                    <button @click="orderServices.push({ service_id: '', price:'' })" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 21">
                            <path d="M15 14H7.78l-.5-2H16a1 1 0 0 0 .962-.726l.473-1.655A2.968 2.968 0 0 1 16 10a3 3 0 0 1-3-3 3 3 0 0 1-3-3 2.97 2.97 0 0 1 .184-1H4.77L4.175.745A1 1 0 0 0 3.208 0H1a1 1 0 0 0 0 2h1.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 10 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3Zm-8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm8 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                            <path d="M19 3h-2V1a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V5h2a1 1 0 1 0 0-2Z"/>
                          </svg>
                          Insérer un nouveau produit
                      </button>
                </div>
            </div>
            </div>
            <div class="flex items-center justify-center">
                <button type="submit" class="text-white bg-gradient-to-r  from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Valider</button>
            </div>
    </div>
</form>
@endsection
