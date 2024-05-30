@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Technologies</h2>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Input form for add new technology --}}
        <section>
            <form action="{{ route('admin.technologies.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Add a New Technology</label>
                    <div class="d-flex">
                        <input type="text" class="rounded w-50 @error('name') is-invalid @enderror " name="name"
                            id="name" aria-describedby="nameHelper" value="{{ old('name') }}" />

                        <button type="submit" class="btn btn-outline-dark px-3 py-2 rounded ">
                            <i class="fa fa-files-o" aria-hidden="true"></i>
                            Add
                        </button>
                    </div>
                    <small id="nameHelper" class="form-text text-secondary">Type your new technology</small>

                    @error('name')
                        <div class="text-danger py-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </form>
        </section>

        {{-- Table for index method to see all the technologies --}}
        <section class="bg-body-tertiary mt-5 text-center ">

            <script>
                var alertList = document.querySelectorAll(".alert");
                alertList.forEach(function(alert) {
                    new bootstrap.Alert(alert);
                });
            </script>

            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('message') }}
                </div>
            @endif

            <div class="table" style="font-size:0.8rem">
                <table class="table table-secondary table-striped table-bordered align-middle">
                    <thead>
                        <tr class="table-dark text-light">
                            <th scope="col">ID</th>
                            <th scope="col">TECHNOLOGY NAME</th>
                            <th scope="col">SLUG</th>

                            <th scope="col" class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($technologies as $technology)
                            <tr class="">
                                <td>{{ $technology->id }}</td>
                                <td contenteditable="true">
                                    {{ $technology->name }}

                                </td>
                                <td>
                                    {{ $technology->slug }}
                                </td>
                                <td class="text-center p-1">
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-{{ $technology->id }}">
                                        <i class="fas fa-trash fa-xs fa-fw"></i>
                                        <span style="font-size: 0.7rem" class="text-uppercase">Delete</span>
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modal-{{ $technology->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalName{{ $technology->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-dark text-danger" data-bs-theme="danger">
                                                    <h5 class="modal-name  text-center text-danger"
                                                        id="modalName-{{ $technology->id }}">
                                                        DELETING TECHNOLOGY
                                                    </h5>
                                                    <button type="button" class="btn-close" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Destroy all the evidence of the technology:
                                                    {{ $technology->name }} ?
                                                    Are you sure?

                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <button type="button " class="btn btn-outline-secondary "
                                                        data-bs-dismiss="modal">
                                                        No!
                                                    </button>

                                                    <form action="{{ route('admin.technologies.destroy', $technology) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-outline-danger ">
                                                            Yes
                                                        </button>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @empty
                            <tr class="">
                                <td scope="row" colspan="5">Work in progress!</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </section>

    </div>
@endsection
