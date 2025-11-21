 <form class="row gap-2 form-group"
     action="{{ isset($reservation) ? route('reservations.update', $reservation->id) : route('reservations.store') }}  "
     method="POST" enctype="multipart/form-data">
     @csrf
     @if (isset($reservation))
         @method('PUT')
     @endif

     <div class="card col-md-6">
         <div class="card-body">
             <div class="input-group flex-column gap-2">

                 <div class="col">
                     <input type="text" name="full_name" class="form-control form-control-sm"
                         placeholder="Guest full name" value="{{ $reservation->full_name ?? '' }}" required >
                     @error('full_name')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="col">
                     <input type="tel" name="contact_number" class="form-control form-control-sm"
                         placeholder="Contact number" value="{{ $reservation->contact_number ?? '' }}" required >
                     @error('contact_number')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="col">
                     <input type="email" name="email" class="form-control form-control-sm" placeholder="Email"
                         value="{{ $reservation->email ?? '' }}" required>
                     @error('email')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="col">
                     <input type="number" min="1" name="number_of_guests" class="form-control form-control-sm"
                         placeholder="Guest number" value="{{ $reservation->number_of_guests ?? '' }}" required>
                     @error('number_of_guests')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

             </div>
         </div>
     </div>

     <div class="card col-md-5">
         <div class="card-body">
             <div class="input-group flex-column gap-2">

                 <div class="col">
                     <select name="table_id" id="table_id" class="form-control p-3">
                         <option value="">Select table</option>
                         @foreach ($tables as $table)
                             <option value="{{ $table->id }}" @if (isset($reservation) && $reservation->status == $table->status)
                                 selected
                             @endif>{{ $table->name }}</option>
                         @endforeach
                     </select>
                     @error('table_id')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 {{--  --}}
                 <div class="col">
                     <select name="status" id="status" class="form-control p-3">
                         <option value="">Select stauts</option>
                         @foreach (App\Http\Enums\TableStatus::cases() as $status)
                             <option value="{{ $status->value }}" @if (isset($reservation) && $reservation && $reservation->status === $status->value)
                                 selected
                             @endif>{{ $status->name }}</option>
                         @endforeach
                     </select>
                     @error('status')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                 <div class="col">
                     <textarea type="text" name="special_requests" class="form-control form-control-sm" placeholder="Note" rows="8">{{ $reservation->special_requests ?? '' }}</textarea>
                     @error('special_requests')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="col">
                     <input type="datetime-local" name="reservation_time" id="curDate"
                         class="form-control form-control-sm" placeholder="Reservation time"
                         value="{{ $reservation->reservation_time ?? '' }}" required>
                     @error('reservation_time')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>


                 <div class="input-group-append text-end mt-3">
                     <button class="btn btn-lg btn-primary" type="submit">
                         @if (isset($reservation))
                             Update
                         @else
                             Add +
                         @endif
                     </button>
                 </div>
             </div>
         </div>
     </div>
 </form>

 @if (empty($reservation))
     <script>
         let now = new Date();
         let year = now.getFullYear();
         let month = (now.getMonth() + 1).toString().padStart(2, '0');
         let day = now.getDate().toString().padStart(2, '0');
         let hours = now.getHours().toString().padStart(2, '0');
         let minutes = now.getMinutes().toString().padStart(2, '0');
         let localDatetime = `${year}-${month}-${day}T${hours}:${minutes}`;
         document.getElementById('curDate').value = localDatetime;
     </script>
 @endif
