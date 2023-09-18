@extends('Template.dashboard')

@section('content')

    <section class="bg-white dark:bg-gray-900">


        <nav class="flex px-10" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-roboto text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
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
                <a href="{{route('user.index')}}" class="ml-1 text-sm font-roboto text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white"> Les utilisateurs</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="ml-1 text-sm font-roboto text-gray-500 md:ml-2 dark:text-gray-400">Ajouter un utilisateur</span>
                </div>
            </li>
            </ol>
        </nav>
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-roboto text-gray-900 dark:text-white">Ajouter un utilisateur</h2>
            <form action="{{route('user.store')}}" method="POST" >
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="nom" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Nom</label>
                        <input type="text" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required value="{{old('nom')}}">                        @error('telephone') <span class="text-red-600 font-roboto">{{ $message }}</span> @enderror
                        @error('nom') <span class="text-red-600 font-roboto">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-full">
                        <label for="username" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required value="{{old('username')}}">                        @error('telephone') <span class="text-red-600 font-roboto">{{ $message }}</span> @enderror
                        @error('username') <span class="text-red-600 font-roboto">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"   value="{{old('email')}}">
                        @error('email') <span class="text-red-600 font-roboto">{{ $message }}</span> @enderror

                    </div>
                    <div >
                        <label for="role" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Role</label>
                        <select required id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach ($roles as $role )
                                <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Mot de passe</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required  value="{{old('password')}}">
                        @error('password') <span class="text-red-600 font-roboto">{{ $message }}</span> @enderror

                    </div>
                    <div>
                        <label for="confirm" class="block mb-2 text-sm font-roboto text-gray-900 dark:text-white">Confirmer le mot de passe</label>
                        <input type="password" name="confirm" id="confirm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required  value="{{old('confirm')}}">
                    </div>

                </div>
                <button type="submit" class="text-white bg-gradient-to-r font-roboto from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg mt-6 shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2 text-center mr-2 mb-2">
                   Ajouter
                </button>
            </form>
        </div>
      </section>

@endsection
