@extends('layouts.admin')

@section('content')
    <div class="container d-flex justify-content-between align-items-center p-4">
        <h2 class="text-center text-secondary-emphasis ">Update this Project</h2>


    </div>

    <div class="container mb-5">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Project Title</label>
                <input type="text" class="form-control @error('title') is-inavlid @enderror" name="title"
                    id="title" aria-describedby="titleHelper" value="{{ old('title', $project->title) }}" />
                <small id="titleHelper" class="form-text text-secondary">Type the title of your new project</small>
                @error('title')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="subtitle" class="form-label">Project Subtitle</label>
                <input type="text" class="form-control @error('subtitle') is-inavlid @enderror" name="subtitle"
                    id="subtitle" aria-describedby="subtitleHelper" value="{{ old('subtitle', $project->subtitle) }}" />
                <small id="subtitleHelper" class="form-text text-secondary">Type the subtitle of your new
                    project</small>
                @error('subtitle')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex gap-5 m-4">

                @if (Str::startsWith($project->image, 'https:'))
                    <img width="200px" src=" {{ $project->image }}" alt="{{ $project->title }}">
                @else
                    <img width="200px" height="100%" src=" {{ asset('storage/' . $project->image) }}"
                        alt="{{ $project->title }}">
                @endif

                <div>
                    <label for="image" class="form-label">
                        <i class="fa fa-image fa-xs fa fw" aria-hidden="true"></i>
                        Project image
                    </label>
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose file</label>
                        <input type="file" class="form-control" name="image" id="image"
                            aria-describedby="imageHelper" />
                    </div>
                    <small id="imageHelper" class="form-text text-secondary">Type the image of your new
                        project</small l>
                    @error('image')
                        <div class="text-danger py-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select  @error('type') is-inavlid @enderror" name="type_id" id="type_id">
                    <option selected disabled>Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('type')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- CHECKBOX 👇 --}}
            <div class="mb-3 d-flex flex-wrap py-2 gap-3">

                @foreach ($technologies as $technology)
                    @if ($errors->any())
                        <div class="form-check">
                            <input class="form-check-input @error('technologies') is-inavlid @enderror" type="checkbox"
                                value="{{ $technology->id }}" id="technology-{{ $technology->id }}" name="technologies[]"
                                {{-- Use pluck('id') method on object collection Tecnology of current $project in order to have a new collection with the new id of tecnologies and,  combined with method toArray, the collection of id will converted into an array --}}
                                {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }} />
                            <label class="form-check-label" for="technology-{{ $technology->id }}">
                                {{ $technology->name }}
                            </label>
                        </div>
                    @else
                        <div class="form-check">
                            <input class="form-check-input @error('technologies') is-inavlid @enderror" type="checkbox"
                                value="{{ $technology->id }}" id="technology-{{ $technology->id }}" name="technologies[]"
                                {{-- Use pluck('id') method on object collection Tecnology of current $project in order to have a new collection with the new id of tecnologies and,  combined with method toArray, the collection of id will converted into an array --}}
                                {{ in_array($technology->id, $project->technologies->pluck('id')->toArray()) ? 'checked' : '' }}
                                {{-- {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}  --}} />
                            <label class="form-check-label" for="technology-{{ $technology->id }}">
                                {{ $technology->name }}
                            </label>
                        </div>
                    @endif
                @endforeach

                @error('technologies')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description of project</label>
                <textarea class="form-control @error('description') is-inavlid @enderror" name="description" id="description"
                    rows="5">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">

                <button type="submit" class="btn btn-outline-dark px-3 py-2 rounded">
                    <i class="fa-solid fa-file-arrow-up pe-1"></i>
                    Update
                </button>

                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-dark py-2 px-3">
                    <i class="fa-solid fa-delete-left pe-1"></i>
                    Cancel
                </a>

            </div>

        </form>
    </div>
@endsection
