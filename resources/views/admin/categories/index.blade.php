<x-app-layout>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">

            <div class="card p-4 d-flex flex-row justify-content-between align-items-center">
                <h2>Categories!</h2>
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
            @include('admin.categories._form')
           
        </div>
    </div>


    @if ($categories->isEmpty())
        <div class="row">
            <div class="col text-center">
                <div class="card">
                    <div class="card-body">
                        <h3>No Ctegory added, </h3>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Category Table --}}
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Basic Table</h4>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Descripton</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td><img width="100"
                                                    src="{{ asset('images/categories/' . $category->image) }}" />
                                            </td>
                                            <td>{{ $category->description }}</td>
                                            <td>
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="mdi mdi-content-copy"></i></a>

                                                <form id="delete-form-{{ $category->id }}"
                                                    name="delete-form-{{ $category->id }}"
                                                    action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger show_confirm"
                                                        onclick="confirmDelete({{ $category->id }})"><i class="mdi mdi-delete text-white"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


</x-app-layout>
