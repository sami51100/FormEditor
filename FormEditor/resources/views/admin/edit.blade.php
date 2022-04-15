@extends('layouts.admin')
@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<main class="admin-create">
    
            <div class="mb-8">
                <a href="{{ route('admin') }}" class="bg-darky hover:bg-darky text-white font-bold py-2 px-4 rounded text-decoration-none">Retour à la liste d'utilisateur</a>
            </div>
            <div class="content-admin content-taille mon-shadow">
                <form method="POST" action="{{ url('admin', $users->id) }}">
                    @csrf
                    @method('PUT')

                        <div class="form-floating mb-2">
                            <input type="text" name="lastname" id="lastname" value="{{ old('lastname', $users->lastname) }}" class="form-control" id="floatLastname" placeholder="Lastname">
                            <label   for="floatLastname">Nom</label>
                        </div>
                        @error('lastname')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror


                        <div class="form-floating mb-2">
                            <input type="text" name="firstname" id="firstname" value="{{ old('firstname', $users->firstname) }}" class="form-control" id="floatFirstname" placeholder="Firstname">
                            <label   for="floatFirstname">Prénom</label>
                        </div>
                        @error('firstname')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror


                        <div class="form-floating mb-2">
                            <input type="email" name="email" id="email" value="{{ old('email', $users->email) }}" class="form-control" id="floatEmail" placeholder="Email">
                            <label   for="floatEmail">Email</label>
                        </div>
                        @error('email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="form-floating">
                            <select name="role_id" class="form-select input-field mon-shadow" id="floatingSelect" aria-label="Floating label select example">
                            <option selected hidden value="{{ old('role_id', $users->role_id) }}">{{ old('role_nom', $users->role->role_nom) }}</option>
                            @if(Auth::user()->role_id==1)
                                <option value={{DB::table('roles')->where('role_nom', 'Modérateur')->value('id')}}>Modérateur</option>
                            @endif
                            <option value={{DB::table('roles')->where('role_nom', 'Etudiant')->value('id')}}>Etudiant</option>
                            <option value={{DB::table('roles')->where('role_nom', 'Professionnel')->value('id')}}>Professionnel</option>
                            <option value={{DB::table('roles')->where('role_nom', 'Particulier')->value('id')}}>Particulier</option>
                            </select>
                            <label for="role_id">Role</label>
                        </div>
                        @error('role_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Editer
                            </button>
                        </div>
                </form>
            </div>
        </div>
@endsection