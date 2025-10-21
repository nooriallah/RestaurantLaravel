 <x-app-layout>

     <div class="row">

         <div class="col-md-12 grid-margin stretch-card">

             <div class="card p-4 d-flex flex-row justify-content-between align-items-center">
                 <h2>Add Menu!</h2>
                 <a href="{{ route('menu.index') }}" class="btn btn-outline-dark">All</a>
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

             @include('admin.menu._menu-form')

         </div>
     </div>

 </x-app-layout>
