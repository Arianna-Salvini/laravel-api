 @extends ('layouts.admin')

 @section('content')
     <section class="bg-body-tertiary">
         <div class="container">
             <div class="d-flex justify-content-between align-items-center py-4">
                 <h2 class="text-center text-secondary-emphasis ">Projects</h2>
                 <a href="{{ route('admin.projects.create') }}" class="btn btn-dark"> <i
                         class="fa-solid fa-circle-plus pe-2"></i>New
                     Project</a>
             </div>

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

             <div class="table-responsivet" style="font-size:0.8rem">
                 <table class="table table-secondary table-striped table-bordered">
                     <thead>
                         <tr>
                             <th scope="col">ID</th>
                             <th scope="col">IMAGE</th>
                             <th scope="col">TITLE</th>
                             {{-- <th scope="col">SLUG</th> --}}
                             <th scope="col">SUBTITLE</th>
                             {{-- <th scope="col">DESCRIPTION</th> --}}
                             <th scope="col">TYPE</th>
                             <th scope="col">TECHNOLOGIES</th>
                             <th scope="col">URL</th>
                             <th scope="col" class="text-center">ACTION</th>
                         </tr>
                     </thead>
                     <tbody>
                         @forelse ($projects as $project)
                             <tr class="">
                                 <td scope="row">{{ $project->id }}</td>
                                 <td>

                                     {{-- <a href="{{ route('admin.projects.show', $project) }}"> --}}
                                     @if (Str::startsWith($project->image, 'https://'))
                                         <img width="100" loading="lazy" src="{{ $project->image }}"
                                             alt="{{ $project->title }}">
                                     @else
                                         <img width="100" loading="lazy" src="{{ asset('storage/' . $project->image) }}"
                                             alt="{{ $project->title }}">
                                     @endif
                                     {{-- </a> --}}
                                 </td>
                                 <td>{{ $project->title }}</td>

                                 {{-- <td>{{ $project->slug }}</td> --}}

                                 <td>{{ $project->subtitle }}</td>

                                 {{-- <td>{{ $project->description }}</td> --}}

                                 <td>
                                     @if ($project->type)
                                         {{ $project->type->name }}
                                     @else
                                         N/A
                                     @endif

                                 </td>
                                 <td>
                                     {{-- @dd($project->tecnology)  --}}
                                     @foreach ($project->technologies as $technology)
                                         <div class="d-flex justify-content-center p-1 m-1 bg-primary text-light rounded">
                                             {{ $technology->name }}
                                         </div>
                                     @endforeach

                                 </td>
                                 <td>{{ $project->url }}</td>
                                 <td
                                     class="text-center d-flex flex-column justify-content-center align-items-center gap-2 p-3">
                                     <a href="{{ route('admin.projects.show', $project) }}"
                                         class="btn btn-outline-secondary px-2 w-100">
                                         <i class="fa fa-eye fa-sm fa-fw pe-1" aria-hidden="true"></i>
                                         <span style="font-size:0.9rem"> View </span>
                                     </a>
                                     <a href="{{ route('admin.projects.edit', $project) }}"
                                         class="btn btn-outline-secondary px-2 w-100">
                                         <i class="fa fa-pencil" aria-hidden="true"></i>
                                         <span style="font-size:0.9rem"> Edit </span>
                                     </a>
                                     <!-- Modal trigger button -->
                                     <button type="button" class="btn btn-outline-danger w-100" data-bs-toggle="modal"
                                         data-bs-target="#modal-{{ $project->id }}">
                                         <i class="fas fa-trash fa-xs fa-fw"></i>
                                         <span style="font-size: 0.7rem" class="text-uppercase">Delete</span>
                                     </button>

                                     <!-- Modal Body -->
                                     <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                     <div class="modal fade" id="modal-{{ $project->id }}" tabindex="-1"
                                         data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                         aria-labelledby="modalTitle-{{ $project->id }}" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                             role="document">
                                             <div class="modal-content">
                                                 <div class="modal-header bg-dark text-danger" data-bs-theme="danger">
                                                     <h5 class="modal-title  text-center text-danger"
                                                         id="modalTitle-{{ $project->id }}">
                                                         DELETING PROJECT
                                                     </h5>
                                                     <button type="button" class="btn-close" aria-label="Close"></button>
                                                 </div>
                                                 <div class="modal-body">
                                                     Destroy all the evidence of the project:
                                                     {{ $project->title }} ?
                                                     Are you sure?

                                                 </div>
                                                 <div class="modal-footer d-flex justify-content-center">
                                                     <button type="button " class="btn btn-outline-secondary "
                                                         data-bs-dismiss="modal">
                                                         No!
                                                     </button>

                                                     <form action="{{ route('admin.projects.destroy', $project) }}"
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
             {{ $projects->links('pagination::bootstrap-5') }}
         </div>
     </section>
 @endsection
