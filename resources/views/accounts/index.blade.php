@extends('layouts.backend')

@section('links')
    <link href="{{ asset('css/accountCreation.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'accountCreation' }}@endsection

@section('navTheme')
{{ 'light' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')
<style>

.btn-danger {
    background-color: black; 
    color: white;
    border: gray;
}

.btn-complete {
    background-color: red; 
    color: white;
    border: gray;
} 

.btn-warning {
    background-color: orange; 
    color: white;
    border: gray;
} 

.btn-success {
    color: white;
} 
.btn-success:hover {
    background-color: white;
    color: black;
}



</style>
<div class="pt-5">
    <section class="container mt-5 pt-5">
        <div class="row d-flex justify-content-center" id="top-bar">
            <div class="col-12 col-md-6 text-center" id="title">
                <h2>Manage Accounts</h2>
            </div>
        </div>

        <div class="container mt-4">
            <h2 class="mb-4 text-center">Accounts</h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Role</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact No.</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $users)
                        <tr>
                            <th scope="row">{{ $users->id }}</th>
                            <td>{{ $users->role }}</td>
                            <td>{{ $users->name }}</td>
                            <td>{{ $users->email }}</td>
                            <td>{{ $users->mobile_number }}</td>
                            <td>
                                <a href="{{ route('user.update', ['id' => $users->id]) }}" class="btn btn-{{ $users->status ? 'success' : 'danger' }}">
                                    {{ $users->status ? 'Enable' : 'Disable' }}
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $users->id }}">Edit</button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $users->id }}">Delete</button>
                            </td>
                        </tr>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $users->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $users->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $users->id }}">Edit Account</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('user.saveChanges', ['id' => $users->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="mobile_number" class="form-label">Contact Number</label>
                                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ $users->mobile_number }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Edit Modal -->

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $users->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $users->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $users->id }}">Delete Account</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this account?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('user.delete', ['id' => $users->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Delete Modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>



@endsection