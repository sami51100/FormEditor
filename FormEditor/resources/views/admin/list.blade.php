@extends('layouts.admin')
@section('content')
<main>
                <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('admin.create') }}" class="bg-darky hover:bg-darky text-white font-bold py-2 px-4 rounded text-decoration-none">Créer un utilisateur</a>
            </div>
                        <div class="content-admin mon-shadow tableWrap">
                            <table class="divide-y divide-gray-200">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="uppercase text-gray-500 px-6 text-xs bg-gray-50">
                                        ID
                                    </th>
                                    <th scope="col" width="50" class="uppercase text-gray-500 px-6 text-xs bg-gray-50">
                                        Profile
                                    </th>
                                    <th scope="col" class="uppercase text-gray-500 px-6 text-xs bg-gray-50">
                                        Lastame
                                    </th>
                                    <th scope="col" class="uppercase text-gray-500 px-6 text-xs bg-gray-50">
                                        Firstame
                                    </th>
                                    <th scope="col" class="uppercase text-gray-500 px-6 text-xs bg-gray-50">
                                        Email
                                    </th>
                                    <th scope="col" class="uppercase text-gray-500 px-6 text-xs bg-gray-50">
                                        Role
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y bg-white">
                                @foreach ($usersList as $user)
                                    <tr>
                                        <td class="px-6 text-sm">
                                            {{ $user->id }}
                                        </td>

                                        <td class="px-6 text-sm profile">
                                            <img src=" {{ $user->profile_photo_path }} ">
                                        </td>

                                        <td class="px-6 text-sm">
                                            {{ $user->lastname }}
                                        </td>

                                        <td class="px-6 text-sm">
                                            {{ $user->firstname }}
                                        </td>

                                        <td class="px-6 text-sm">
                                            {{ $user->email }}
                                        </td>

                                        <td class="px-6 text-sm">
                                            <div class="badge" id="role" style="background-color: {{ $user->role->role_couleur }} ;"> {{ $user->role->role_nom }} </div>
                                        </td>

                                        <td class="px-6 text-sm icon-flex">
                                            <a href="{{ route('admin.show', $user->id) }}" id="black" class="btn btn-sm btn-outline-dark mb-1 button-glow"><i class="bi-search"></i></a>
                                            @if(Gate::allows('user-access', $user->role_id))
                                                <a href="{{ route('admin.edit', $user->id) }}" id="blue" class="btn btn-sm btn-outline-primary mb-1 button-glow"><i class="bi-pencil"></i></a>
                                                <form id="delete-user{{$user->id}}" class="inline-block" action="{{ route('admin.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Etes-vous sûr de vouloir supprimer cette utilisateur ?');">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    {{-- <input type="submit" id="red" class="btn btn-sm btn-outline-danger mb-1 button-glow" value="Delete"> --}}
                                                    <button type="submit" id="red" class="btn btn-sm btn-outline-danger mb-1 button-glow" value="Delete"><i class="bi-trash2"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

        </div>
    </div>
            </main>
@endsection