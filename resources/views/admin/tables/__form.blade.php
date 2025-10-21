 <form class="form-group" action="{{ isset($table) ? route('tables.update', $table->id) : route('tables.store') }}  "
     method="POST" enctype="multipart/form-data">
     @csrf
     @if (isset($table))
         @method('PUT')
     @endif
     <div class="card col-md-12">
         <div class="card-body">
             <div class="input-group flex-column gap-2">

                 <div class="col-md-3">
                     <input type="text" name="name" class="form-control form-control-sm" placeholder="Table name"
                         value="{{ $table->name ?? '' }}" required>
                     @error('name')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="col-md-3">
                     <input type="number" name="capacity" class="form-control form-control-sm"
                         placeholder="Quest quantity" value="{{ $table->capacity ?? '' }}" required>
                     @error('capacity')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="col-md-3">
                     <select name="status" id="table__status" class="form-control">
                         <option value="">Select table status</option>
                         @foreach (App\Http\Enums\TableStatus::cases() as $status)
                             <option value="{{ $status->value }}" {{-- Check if current status is selected or not --}}
                                 @if ($table->status == $status->value) selected @endif>{{ $status->name }}</option>
                         @endforeach
                     </select>
                     @error('status')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="col-md-3">
                     <select name="location" id="table__location" class="form-control">
                         <option value="">Select table location</option>
                         @foreach (App\Http\Enums\TableLocation::cases() as $location)
                             <option value="{{ $location->value }}" @if ($table->location == $location->value) selected @endif>
                                 {{ $location->name }}</option>
                         @endforeach
                     </select>
                     @error('location')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="col-md-5">
                     <textarea type="text" name="description" class="form-control form-control-sm" placeholder="Description"
                         rows="8">{{ $table->description ?? '' }}</textarea>
                     @error('description')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="col-md-3">
                     @if (isset($table) && $table->image)
                         <img width="100" class="mb-3 d-block"
                             src="{{ asset('images/table/' . $table->image) ?? '' }}" id="image__preview" />
                     @else
                         <img width="100 class mb-3 d-none" src="" id="image__preview" />
                     @endif
                     <label for="image__input" class="d-block btn btn-sm btn-outline-dribbble mt-3">Choose image</label>
                     <input type="file" name="image" accept=".png, .jpg, .jpeg"
                         class="form-control form-control-sm d-none" id="image__input" />
                     @error('image')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="input-group-append">
                     <button class="btn btn-md btn-primary" type="submit">Add +</button>
                 </div>
             </div>
         </div>
     </div>
 </form>
