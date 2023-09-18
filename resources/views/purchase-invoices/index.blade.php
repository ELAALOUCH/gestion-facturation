@extends('Template.dashboard')

@section('content')

        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">

            <div class="border-b border-gray-200 dark:border-gray-700 pl-6">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                    <li class="mr-2">
                        <a href="{{route('purchase.index')}}" class="@if ($tab =='index')
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
                    @can('archive')
                    <li class="mr-2">
                        <a href="{{route('purchase.archive')}}" class="@if ($tab =='archive')
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
                    @endcan
                </ul>
            </div>

          <div class="mx-auto max-w-screen-2xl mt-2 sm:px-4">
              <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-stretch md:items-center md:space-x-3 space-y-3 md:space-y-0 justify-between mx-4 py-4 border-t dark:border-gray-700">
                    <div class="w-full md:w-1/2 flex flex-row items-center">
                        <form class="flex items-center pl-4" action="{{route('purchase.search')}}" method="GET">
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
                        @can('creer')
                        <button type="button" class="text-white bg-gradient-to-r font-roboto from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2 text-center mr-2 mb-2 ">
                            <a href="{{route('purchase.create')}}">Ajouter</a>
                        </button>
                        @endcan
                    </div>
                </div>

                  <div class="overflow-x-auto">
                      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                              <tr>
                                  <th scope="col" class="p-4">Code</th>
                                  <th scope="col" class="p-4">Type</th>
                                  <th scope="col" class="p-4">La date</th>
                                  <th scope="col" class="p-4">Fournisseur</th>
                                  <th scope="col" class="p-4">Echéance</th>
                                  <th scope="col" class="p-4">Etat de paiement</th>
                                  <th scope="col" class="p-4">Document</th>
                                  <th scope="col" class="p-4"></th>
                                  <th scope="col" class="p-4"></th>
                                  <th scope="col" class="p-4"></th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($invoices as $invoice)
                              <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                  <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      <div class="flex items-center">
                                          {{$invoice->id}}
                                      </div>
                                  </td>
                                  <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center">
                                        {{$invoice->type}}
                                    </div>
                                </td>
                                  <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      <div class="flex items-center">
                                          {{$invoice->date}}
                                      </div>
                                  </td>

                                  <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      <div class="flex items-center">
                                          {{$invoice->supplier->nom ?? ''}}
                                      </div>
                                  </td>

                                  <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      <div class="flex items-center">
                                          {{$invoice->date_echeance}}
                                      </div>
                                  </td>


                                  <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      <div class="flex items-center">
                                          @if ( $invoice->etat_paiement =='Payée' )
                                              <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Payée</span>
                                          @else
                                              <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">En attente</span>
                                          @endif
                                      </div>
                                  </td>
                                  <td class="px-4 py-3">
                                      @if ($invoice->document)
                                      <form action="{{route('purchase.download',['id'=>$invoice->id])}}" method="get">
                                          @csrf
                                          <button class="bg-grey-light hover:bg-grey text-grey-darkest font-bold py-2 px-4 rounded inline-flex items-center">
                                              <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                              <span>TÉLÉCHARGER</span>
                                            </button>
                                      </form>
                                      @endif
                                  </td>
                                  <td>
                                    <td >
                                        <ul class="py-1 text-sm flex flex-row" aria-labelledby="benq-ex2710q-dropdown-button">
                                            @can('voir')
                                            <li>
                                                <form action="{{route('purchase.show',['purchase' =>$invoice->id])}}" method="GET">
                                                    @csrf
                                                    <button type="submit" data-modal-target="updateProductModal" data-modal-toggle="updateProductModal" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                        <svg class="w-4 h-4  text-blue-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 14">
                                                            <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                              <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                                              <path d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z"/>
                                                            </g>
                                                          </svg>
                                                    </button>
                                                </form>
                                            </li>
                                            @endcan
                                            @can('editer')
                                            <li>
                                                <form action="{{route('purchase.edit',['purchase' =>$invoice->id])}}" method="GET">
                                                    @csrf
                                                    <button type="submit" data-modal-target="updateProductModal" data-modal-toggle="updateProductModal" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                        <svg class="w-4 h-4  text-green-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                                            <path d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z"/>
                                                            <path d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </li>
                                            @endcan
                                            @can('archiver')
                                            <li>
                                                <form action="{{route('purchase.destroy',['purchase' => $invoice->id])}}" method="POST" >
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400">

                                                        <svg class="w-4 h-4 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                                            <path d="M19 0H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1ZM2 6v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6H2Zm11 3a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8a1 1 0 0 1 2 0h2a1 1 0 0 1 2 0v1Z"/>
                                                          </svg>
                                                    </button>
                                                </form>
                                            </li>
                                            @endcan
                                        </ul>
                                </td>
                                </td>
                                @can('supprimer')
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button id="apple-imac-27-dropdown{{$invoice->id}}-button" data-dropdown-toggle="apple-imac-27-dropdown{{$invoice->id}}" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="apple-imac-27-dropdown{{$invoice->id}}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul  class="py-1 text-sm" aria-labelledby="apple-imac-27-dropdown{{$invoice->id}}-button">
                                            <li>
                                                <button type="button" data-modal-target="delete{{$invoice->id}}" data-modal-toggle="delete{{$invoice->id}}" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400">
                                                    <svg class="w-4 h-4 mr-2" viewbox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                                    </svg>
                                                    Supprimer
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                @endcan


                              </tr>
                              <div id="delete{{$invoice->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                        <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="delete{{$invoice->id}}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <p class="mb-4 text-gray-500 dark:text-gray-300">Etes-vous sûr de vouloir supprimer cette facture ?</p>
                                        <form action="{{route('purchase.forcedelete',['id'=>$invoice->id])}}" method="POST" >
                                            @method("DELETE")
                                            @csrf
                                            <button data-modal-toggle=delete {{$invoice->id}} type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Oui, je suis sûr</button>
                                        </form>
                                        <button data-modal-toggle=delete {{$invoice->id}} type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Non</button>
                                    </div>
                                </div>
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
      </section>

@endsection
