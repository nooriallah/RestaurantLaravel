 <form class="form-group" action="{{ isset($menu) ? route('menu.update', $menu->slug) : route('menu.store') }}  "
     method="POST" enctype="multipart/form-data">
     @if (isset($menu))
         @method('PUT')
     @endif
     @csrf

     <div class="card col-md-12">
         <div class="card-body">
             <div class="col col-md-6 mb-4">
                 <input type="text" name="name" class="form-control form-control-sm" placeholder="Food name *"
                     value="{{ $menu->name ?? '' }}" required>
                 @error('name')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror
             </div>

             <div class="col col-md-6 mb-4">
                 <input type="number" min="0" name="price" class="form-control form-control-sm"
                     placeholder="Price *" value="{{ $menu->price ?? '' }}" required>
                 @error('price')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror
             </div>


             <div class="col col-md-6 mb-3">
                 <textarea type="text" name="description" class="form-control form-control-sm" placeholder="Description"
                     rows="8">{{ $menu->description ?? '' }}</textarea>
                 @error('description')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror
             </div>


             <div class="col col-md-6 mb-3">
                 <select name="categories[]" class="form-control form-control-sm" required multiple
                     style="height: 150px">
                     <option value="" disabled selected>Select category *</option>
                     @foreach ($categories as $category)
                         <option value="{{ $category->id }}" @if (isset($menu) && $menu->categories->contains('id', $category->id)) selected @endif>
                             {{ $category->name }}</option>
                     @endforeach
                 </select>
                 @error('categories')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror
             </div>


             <div class="col col-md-6 mb-3">

                 @if (isset($menu) && $menu->image)
                     <img width="100" class="d-block mb-3" src="{{ asset('images/menus/' . $menu->image) ?? '' }}"
                         id="image__preview" />
                 @else
                     <img width="100 class d-none" id="image__preview" />
                     <br />
                 @endif
                 <label for="image__input" class="btn btn-sm btn-outline-dribbble inline-block">Choose image</label>
                 <input type="file" name="image" accept=".png, .jpg, .jpeg"
                     class="form-control form-control-sm d-none" id="image__input" />
                 @error('image')
                     <span class="text-danger">{{ $message }}</span>
                 @enderror
             </div>

             <div class="input-group-append">
                 <button class="btn btn-md btn-primary ms-2" type="submit">
                     @if (isset($menu))
                         Update
                     @else
                         Add +
                     @endif
                 </button>
             </div>
         </div>
     </div>
 </form>
