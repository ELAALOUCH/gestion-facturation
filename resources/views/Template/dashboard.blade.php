<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    
</head>

<body class="bg-gray-50">
<nav class=" top-0 z-50  bg-white  lg:ml-[255px] lg:w-[clac(100%)-[255px]] pr-8 py-2 shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px]">
            <div class="flex flex-wrap justify-between items-center">
                <div class="flex justify-start items-center">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                           <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                     </button>
                  </div>
                <div class="flex items-center lg:order-2">
                    <!-- Notifications -->
                    <button type="button" data-dropdown-toggle="notification-dropdown" class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                        <span class="sr-only">View notifications</span>
                        <!-- Bell icon -->
                        <svg class="w-6 h-6 text-blue-500 transition-transform transform animate-bell" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 21">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 3.464V1.1m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C15 15.4 15 16 14.462 16H1.538C1 16 1 15.4 1 14.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 8 3.464ZM4.54 16a3.48 3.48 0 0 0 6.92 0H4.54Z"/>
                            <circle cx="12" cy="6" r="3" fill="red" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:divide-gray-600 dark:bg-gray-700" id="notification-dropdown">
                        <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            Notifications
                        </div>
                        <div>
                        <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                            <div class="flex-shrink-0">
                            <img class="w-11 h-11 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Bonnie Green avatar">
                            <div class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-primary-700 dark:border-gray-700">
                                <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                            </div>
                            </div>
                            <div class="pl-3 w-full">
                                <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">New message from <span class="font-semibold text-gray-900 dark:text-white">Bonnie Green</span>: "Hey, what's up? All set for the presentation?"</div>
                                <div class="text-xs font-medium text-primary-700 dark:text-primary-400">a few moments ago</div>
                            </div>
                        </a>
                        </div>
                        <a href="#" class="block py-2 text-base font-normal text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:underline">
                            <div class="inline-flex items-center ">
                            <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                            View all
                            </div>
                        </a>
                    </div>
                    <!-- Apps -->

                    <!-- Dropdown menu -->

                    <button type="button" class="pl-8" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                        <span class="sr-only">Open user menu</span>
                        <svg class="w-4 w-4 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z"/>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown">
                        <div class="py-3 px-4">
                            <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name ?? null }}</span>
                            <span class="block text-sm font-light text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email ??null }}</span>
                        </div>
                        <ul class="py-1 font-light text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                            <li>
                                <a href="#" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Mon profil</a>
                            </li>
                            <li>
                                <a href="{{route('setting.show')}}" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Paramètres</a>
                            </li>
                        </ul>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Se déconnecter') }}
                                </x-dropdown-link>
                            </form>
                    </div>
                </div>
            </div>
  </nav>

  <aside id="logo-sidebar" class="fixed bg-blue-950 top-0 left-0 z-40 w-64 h-screen  transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 " aria-label="Sidebar">

    <div class="h-full px-3 pb-4 overflow-y-auto bg-blue-950 pt-4 ">
        <ul class="space-y-2 font-medium">
            @if (Auth::check() && Auth::user()->company)
            <li class="flex justify-center items-center">
                <img class="rounded-full w-24 h-24 shadow-[0_20px_50px_rgba(8,_112,_184,_0.7)]" src="{{ Storage::url(Auth::user()->company->logo)}}" alt="image description " >
            </li>
            <li>
                <h1 class="text-white text-center font-mono text-blue-800 font-bold">
                Gestion
                    <br class="text-center">
                    Stock et Facturation
                  </h1>
            </li>
            @endif
           <li>
              <a href="#" class="flex items-center p-2 text-gray-200  border-b-[0.05px] border-graye-200  @if (Auth::check() && Auth::user()->company) pt-5 @else pt-[150px] @endif">
                 <svg class="w-5 h-5 text-gray-200 transition duration-75  group-hover:text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                    <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                 </svg>
                 <span class="ml-3 font-roboto text-sm">Dashboard</span>
              </a>
           </li>
           <li>
            <a href="{{route('supplier.index')}}" class="flex items-center p-2 text-gray-200  border-b-[0.05px] border-graye-200 pt-6 ">
                <svg class="w-5 h-5 text-gray-200 transition duration-75  group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                    <path d="M10.013 4.175 5.006 7.369l5.007 3.194-5.007 3.193L0 10.545l5.006-3.193L0 4.175 5.006.981l5.007 3.194ZM4.981 15.806l5.006-3.193 5.006 3.193L9.987 19l-5.006-3.194Z"/>
                    <path d="m10.013 10.545 5.006-3.194-5.006-3.176 4.98-3.194L20 4.175l-5.007 3.194L20 10.562l-5.007 3.194-4.98-3.211Z"/>
                  </svg>
               <span class="ml-3 font-roboto text-sm">Fournisseur</span>
            </a>
         </li>
         @can('product')

         <li>
            <button type="button" class="flex items-center p-2 text-gray-200 w-full  border-b-[0.05px] border-graye-200 pt-6" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                <svg class="w-5 h-5 text-gray-200 transition duration-75  group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                 </svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Produit</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                  <li>
                     <a href="{{route('category.index')}}" class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-blue-950">Catégorie</a>
                  </li>
                  <li>
                    <a href="{{route('product.index')}}" class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-blue-950">List des produits</a>
                 </li>
            </ul>
         </li>

         @endcan
         <li>
            <button type="button" class="flex items-center p-2 text-gray-200 w-full  border-b-[0.05px] border-graye-200 pt-6" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example2">
                <svg class="w-5 h-5 text-gray-200 transition duration-75  group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                    <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
                    <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
                  </svg>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Utilisateurs</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example2" class="hidden py-2 space-y-2">
                  <li>
                     <a href="{{route('user.index')}}" class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-blue-950">Utlisateurs</a>
                  </li>
                  <li>
                    <a href="{{route('roles.index')}}" class="flex items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-blue-950">Roles</a>
                 </li>
            </ul>
         </li>

        </ul>
     </div>
  </aside>

    {{-- Un contenu dynamique  --}}
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed  dark:border-gray-700 ">
            @yield('content')
        </div>
    </div>

    {{-- le code Js de la page  --}}
    @yield('js')
</body>
</html>
