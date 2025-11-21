<x-app-layout>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            
            <div class="card p-4 d-flex flex-row justify-content-between align-items-center">
                <h2>Create reservation!</h2>
                <div>
                    <a href="{{ route('reservations.index') }}" class="btn btn-outline-primary">All reservations</a>
                </div>
            </div>

        </div>

    
    <div class="row">
        @include('admin.reservations._res_form')
    </div>

</x-app-layout>
