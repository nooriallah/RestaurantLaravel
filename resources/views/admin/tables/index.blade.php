<x-app-layout>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">

            <div class="card p-4 d-flex flex-row justify-content-between align-items-center">
                <h2>Tables!</h2>
                <div>
                    <a href="{{ route('tables.create') }}" class="btn btn-outline-primary">Add new <i
                            class="mdi mdi-plus"></i></a>
                </div>
            </div>

        </div>


    </div>

    @if ($tables->isEmpty())
        <div class="row">
            <div class="col text-center">
                <div class="card">
                    <div class="card-body ">
                        <h3>No table added, </h3>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Success message after adding category --}}
        @if (session('success'))
            <script>
                window.laravelSuccess = @json(session('success'));
            </script>
        @endif

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Basic Table</h4>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Capacity</th>
                                        <th>Status</th>
                                        <th>Location</th>
                                        <th>Image</th>
                                        <th>Descripton</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 0;
                                    @endphp
                                    @foreach ($tables as $table)
                                    @php
                                        $counter += 1;
                                    @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $table->name }}</td>
                                            <td>{{ $table->capacity }}</td>
                                            <td>
                                                <label
                                                    class="badge 
                                                @if ($table->status == 'available') badge-success
                                                    @elseif ($table->status == 'reserved')
                                                        badge-danger
                                                    @else
                                                badge-warning @endif">
                                                    {{ $table->status }}</label>
                                            </td>

                                            <td>{{ $table->location }}</td>
                                            <td>
                                                <img src="{{ asset('images/table/' . $table->image) }}"
                                                    alt="{{ $table->name }}">
                                            </td>

                                            <td>{{ $table->description }}</td>

                                            <td>
                                                <a href="{{ route('tables.edit', $table) }}"
                                                    class="btn btn-sm btn-primary"><i
                                                        class="mdi mdi-content-copy"></i></a>

                                                <form id="delete-form-{{ $table->id }}"
                                                    name="delete-form-{{ $table->id }}"
                                                    action="{{ route('tables.destroy', $table) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger show_confirm"
                                                        onclick="confirmDelete({{ $table->id }})"><i
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
