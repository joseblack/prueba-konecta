@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Usuarios sistema') }}</div>

                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-6 d-flex justify-content-start">
                            <a class="btn btn-sm btn-outline-info btn-square mb-3" href="{{ route('users.create') }}">
                                <i class="fa fa-fw fa-plus mr-1"></i> @lang('Create')
                            </a>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <form class="form-inline" action="{{ route('users.index') }}">
                                <label for="name">Name:</label>
                                <input type="search" class="form-control" id="name" placeholder="Enter name" name="name">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search" id="search"></i>
                                </button>
                            </form>
                        </div>
                    </div>  
                    <table class="table table-hover table-vcenter table-striped table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th style="text-transform: capitalize">@lang('user.name')</th>
                                <th style="text-transform: capitalize">@lang('user.email')</th>
                                <th style="text-transform: capitalize">@lang('user.rol')</th>
                                <th style="text-transform: capitalize">@lang('date')</th>
                                <th style="text-transform: capitalize">@lang('editar')</th>
                                <th style="text-transform: capitalize">@lang('eliminar')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->nombre }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td> 
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">                                       
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <a type="button" id="btn-trash" class="btn btn-danger btn-sm delete" data-toggle="modal"
                                       data-target="#exampleModal" data-attr="{{ route('users.show', $user->id) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@include('users.partials.modal-delete')
@endsection

@section('js_after')
<script src="{{ asset('js/users/userdelete.js') }}" defer></script>
@endsection
