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
        <div class="mb-4">
            <a href="{{ route('admin') }}" class="bg-darky hover:bg-darky text-white font-bold py-2 px-4 rounded text-decoration-none">Retour à la liste d'utilisateur</a>
        </div>
        <div class="content-admin content-taille mon-shadow">
            <form method="post" action="{{ route('admin.store') }}">
                @csrf
                    
                    <div class="form-floating mb-2">
                        <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" class="form-control" id="floatLastname" placeholder="Lastname">
                        <label   for="floatLastname">Nom</label>
                    </div>
                    @error('lastname')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    

                    <div class="form-floating mb-2">
                        <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" class="form-control" id="floatFirstname" placeholder="Firstname">
                        <label   for="floatFirstname">Prénom</label>
                    </div>
                    @error('firstname')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    

                    <div class="form-floating mb-2">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" id="floatEmail" placeholder="Email">
                        <label   for="floatEmail">Email</label>
                    </div>
                    @error('email')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    

                    <div class="form-floating mb-2">
                        <input type="password" name="password" id="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    @error('password')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror


                    <div class="form-floating">
                        <select name="role_id" value="{{ old('role_id') }}" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <option value="2" selected>Modérateur</option>
                        <option value="3">Etudiant</option>
                        <option value="4">Professionnel</option>
                        <option value="5">Particulier</option>
                        </select>
                        <label for="role_id">Role</label>
                    </div>
                    @error('role_id')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                {{-- <div class="px-4 bg-white sm:p-6">
                    <label for="profile_photo_path" class="block font-medium text-sm text-gray-700">Profile Photo</label>
                    <input type="text" name="profile_photo_path" id="profile_photo_path" class="form-input rounded-md shadow-sm mt-1 block w-full"
                            value="{{ old('profile_photo_path') }}" />
                    @error('profile_photo_path')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div> --}}

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Créer
                    </button>
                </div>
            </form>
        </div>
</main>
@endsection