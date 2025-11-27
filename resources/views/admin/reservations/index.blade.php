<x-app-layout>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">

            <div class="card p-4 d-flex flex-row justify-content-between align-items-center">
                <h2>Reservations!</h2>
                <div>
                    <a href="{{ route('reservations.create') }}" class="btn btn-outline-primary">
                        Add new <i class="mdi mdi-plus"></i></a>
                </div>
            </div>

        </div>


    </div>

    @if ($reservations->isEmpty())
        <div class="row">
            <div class="col text-center">
                <div class="card">
                    <div class="card-body ">
                        <h3>No reservagtion added, </h3>
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
                        <h4 class="card-title">All tables</h4>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Phone No</th>
                                        <th>Email</th>
                                        <th>Time</th>
                                        <th>Table</th>
                                        <th>Guest number</th>
                                        <th>Descripton</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 0;
                                    @endphp
                                    @foreach ($reservations as $reservation)
                                        @php
                                            $counter += 1;
                                        @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $reservation->full_name }}</td>
                                            <td>{{ $reservation->contact_number }}</td>
                                            <td>{{ $reservation->email }}</td>
                                            <td>{{ $reservation->reservation_time }}</td>
                                            <td>{{ $reservation->table->name }}</td>
                                            
                                            <td>{{ $reservation->number_of_guests }}</td>
                                            <td>{{ $reservation->special_requests }}</td>

                                            <td>
                                                <a href="{{ route('reservations.edit', $reservation) }}"
                                                    class="btn btn-sm btn-primary"><i
                                                        class="mdi mdi-content-copy"></i></a>

                                                <form id="delete-form-{{ $reservation->id }}"
                                                    name="delete-form-{{ $reservation->id }}"
                                                    action="{{ route('reservations.destroy', $reservation) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger show_confirm"
                                                        onclick="confirmDelete({{ $reservation->id }})"><i
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
