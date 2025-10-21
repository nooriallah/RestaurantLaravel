<x-app-layout>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">

            <div class="card p-4 d-flex flex-row justify-content-between align-items-center">
                <h2>Menu!</h2>
                <a href="{{ route('menu.create') }}" class="btn btn-outline-dark">Add new</a>
            </div>

        </div>
    </div>


    {{-- Success message after adding category --}}
    @if (session('success'))
        <script>
            window.laravelSuccess = @json(session('success'));
        </script>
    @endif


    @if (empty($menus))
        <div class="row">
            <div class="col text-center">
                <div class="card">
                    <div class="card-body ">
                        <h3>No menu added, </h3>
                        
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
                        <h4 class="card-title">All foods</h4>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Descripton</th>
                                        <th>Categories</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($menus as $menu)
                                        <tr>
                                            <td>{{ $menu->id }}</td>
                                            <td>{{ $menu->name }}</td>
                                            <td>{{ $menu->price }}</td>
                                            <td>{{ $menu->description }}</td>
                                            <td>
                                                @foreach ($menu->categories as $category)
                                                    <span class="badge badge-primary">{{ $category->name }}</span>
                                                @endforeach
                                            <td>
                                                <img width="100" src="{{ asset('images/menus/' . $menu->image) }}"
                                                    alt="{{ $menu->name }}" />
                                            </td>
                                            <td>
                                                <a href="{{ route('menu.edit', $menu->slug) }}"
                                                    class="btn btn-sm btn-primary"><i
                                                        class="mdi mdi-content-copy"></i></a>

                                                <form id="delete-form-{{ $menu->id }}"
                                                    name="delete-form-{{ $menu->id }}"
                                                    action="{{ route('menu.destroy', $menu->slug) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger show_confirm"
                                                        onclick="confirmDelete({{ $menu->id }})"><i
                                                            class="mdi mdi-delete text-white"></i></button>
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
