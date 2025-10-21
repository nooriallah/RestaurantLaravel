 <form class="form-group"
     action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}  "
     method="POST" enctype="multipart/form-data">
     @csrf
     @if (isset($category))
         @method('PUT')
     @endif
     <div class="card col-md-12">
         <div class="card-body">
             <div class="input-group d-flex  align-items-start gap-2">
                 <div class="col-md-3">
                     <input type="text" name="name" class="form-control form-control-sm" placeholder="Category name"
                         value="{{ $category->name ?? '' }}" required>
                     @error('name')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="col-md-5">
                     <textarea type="text" name="description" class="form-control form-control-sm" placeholder="Description"
                         rows="8">{{ $category->description ?? '' }}</textarea>
                     @error('description')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="col-md-3">

                     @if (isset($category) && $category->image)
                         <img width="100" class="mb-3 d-block"
                             src="{{ asset('images/categories/' . $category->image) ?? '' }}" id="image__preview" />
                     @else
                         <img width="100 class mb-3 d-none" id="image__preview" />
                     @endif
                     <label for="image__input" class="btn btn-sm btn-outline-dribbble mt-3">Choose image</label>
                     <input type="file" name="image" accept=".png, .jpg, .jpeg"
                         class="form-control form-control-sm d-none" id="image__input" />
                     @error('image')
                         <span class="text-danger">{{ $message }}</span>
                     @enderror
                 </div>

                 <div class="input-group-append">
                     <button class="btn btn-md btn-primary ms-2" type="submit">
                         @if (isset($category))
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
