<x-app-layout>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            
            <div class="card p-4 d-flex flex-row justify-content-between align-items-center">
                <h2>Tables!</h2>
                <div>
                    <a href="{{ route('tables.index') }}" class="btn btn-outline-primary">All tables</a>
                </div>
            </div>

        </div>

    
    <div class="row">
        @include('admin.tables.__form')
    </div>

</x-app-layout>
