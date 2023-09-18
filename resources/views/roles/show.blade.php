@extends('Template.dashboard')

@section('content')


    <section class="bg-white dark:bg-gray-900">
        @php
         $permissions =['entreprise','dashboard','produit','service','fournisseur','categorie','facture_achat','client','facture_vente','user','role','creer','editer','voir','supprimer','archiver','archive','restaurer'];
        @endphp
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <form action="{{route('roles.update',['role'=>$role->id])}}" method="post">
                @method('PATCH')
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label disabled for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                        <input value="{{old('nom',$role->name)}}" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required value="{{old('nom')}}">
                    </div>
                </div>
                <div>
                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white mt-4">Le roles</h3>
                    @foreach (  $permissions as $permission )
                    <ul class="items-center w-full my-1 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input disabled name="roles[]" id="vue-checkbox-list" {{ $role->hasPermissionTo($permission) ? 'checked' : '' }} type="checkbox" value="{{$permission}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="vue-checkbox-list" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 font-roboto ">{{$permission}}</label>
                            </div>
                        </li>
                    </ul>
                    @endforeach

                     </form>
            </div>
    </section>

@endsection
