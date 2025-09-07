<x-app-layout>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">

            <div class="card p-4 d-flex flex-row justify-content-between align-items-center">
                <h2>Edit category!</h2>
            </div>

        </div>
    </div>

    {{-- Success message after adding category --}}
    @if (session('success'))
        <script>
            window.laravelSuccess = @json(session('success'));
        </script>
    @endif

    <div class="row mb-3">
        <div class="col-lg-12">
            @include('admin.categories._form', ['category' => $category])
            {{-- <form class="form-group" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card col-md-12">
                    <div class="card-body">
                        <div class="input-group d-flex  align-items-start gap-2">
                            <div class="col-md-3">
                                <input type="text" name="name" class="form-control form-control-sm"
                                    placeholder="Category name" value="{{ $category->name }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <textarea type="text" name="description" class="form-control form-control-sm" placeholder="Description"
                                    rows="8">{{ $category->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <img width="100 class mb-3" src="{{ asset('images/categories/' . $category->image) }}" id="image__preview"/>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg"
                                    class="form-control form-control-sm" id="image__input" />
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group-append">
                                <button class="btn btn-md btn-primary ms-2" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> --}}
        </div>
    </div>





</x-app-layout>
