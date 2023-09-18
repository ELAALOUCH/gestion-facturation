@extends('Template.dashboard')
@section('content')
    <div>

        <div class="border-b border-gray-200 ">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 ">
                {{-- <li class="mr-2">
                    <a href="\setting" class="inline-flex font-roboto items-center justify-center p-4 f border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300  group" >
                        <svg class="w-4 h-4 mr-2 text-gray-400 group-hover:text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                        </svg>PROFIL
                    </a>
                </li> --}}
                @can('entreprise')

                <li class="mr-2">
                    <a href="{{route('company.index')}}" class="@if ($tab =='company')
                    inline-flex items-center justify-center p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group
                    @else
                    inline-flex font-roboto items-center justify-center p-4 f border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300  group
                    @endif"
                    aria-current="page"
                >
                <svg class="@if ($tab=='company')
                        w-4 h-4 mr-2 text-blue-600
                        @else
                        w-4 h-4 mr-2 text-gray-400 group-hover:text-gray-500
                        @endif " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"
                 >
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15V9m4 6V9m4 6V9m4 6V9M2 16h16M1 19h18M2 7v1h16V7l-8-6-8 6Z"/>
                        </svg>
                        ENTREPRISE
                    </a>
                </li>

                <li class="mr-2">
                    <a href="{{route('profile.edit')}}" class="@if ($tab =='profile')
                    inline-flex items-center justify-center p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group
                    @else
                    inline-flex font-roboto items-center justify-center p-4 f border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300  group
                    @endif"
                    aria-current="page"
                >
                        <svg class="@if ($tab=='profile')
                        w-4 h-4 mr-2 text-blue-600
                        @else
                        w-4 h-4 mr-2 text-gray-400 group-hover:text-gray-500
                        @endif "
                         aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                            <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                          </svg>
                        Profile
                    </a>
                </li>

                @endcan
            </ul>
        </div>
        @yield('settingsContent')
    </div>
@endsection
