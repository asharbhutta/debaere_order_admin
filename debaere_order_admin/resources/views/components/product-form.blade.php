    @props(['data'])

    <?php 
        $product=$data["model"];
        $offerings=$data["offering"];
        $formRoute=$data["formRoute"];
        $routeObject=$data["routeObject"];        
    ?>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>  
    @endif
 
    <form method="POST" enctype="multipart/form-data" action="{{ $routeObject }}">
        @csrf
        <div class="bg-light rounded h-100 p-4">
            <div class="row">
                <div class="col-md-4 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $product->name }}" id="name" name="name" required="required" >
                        <label class="ml-2" for="name">Name</label>
                </div>
                 <div class="col-md-4 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $product->product_number }}" id="product_number" name="product_number" required="required" >
                        <label class="ml-2" for="title">Product Number</label>
                </div>
                 <div class="col-md-4  mb-3">
                        <select class="form-control select2"  name="offering_id">
                            <option value="" >Select Offering</option>
                            @foreach($offerings as $k=>$v)
                                <option <?= $k== $product->offering_id ? "selected" : "" ?>  value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            
             <div class="row">
                <div class="col-md-12 form-floating mb-3">
                        <textarea class="form-control" placeholder="Add Description here" name="description" style="height: 150px;">{{ $product->description }}</textarea>
                        <label for="floatingTextarea">Description</label>
                </div>
            </div>
            <hr>
            
            <div class="row">
                <div class="col-md-3 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $product->weight }}" id="weight" name="weight" required="required" >
                        <label class="ml-2" for="title">Weight</label>
                </div>
                <div class="col-md-3 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $product->price }}" id="price" name="price" required="required" >
                        <label class="ml-2" for="title">Price</label>
                </div>
                <div class="col-md-3 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $product->size }}" id="size" name="size" required="required" >
                        <label class="ml-2" for="title">Size</label>
                </div>
                <div class="col-md-3 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $product->portions }}" id="portion" name="portions" required="required" >
                        <label class="ml-2" for="title">Portions</label>
                </div>
            </div>
            <hr>

            
            <div class="row">
                <div class="col-md-3 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $product->pack_size }}" id="pack_size" name="pack_size" required="required" >
                        <label class="ml-2" for="title">Pack Size</label>
                </div>
                <div class="col-md-3 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $product->shelf}}" id="price" name="shelf" required="required" >
                        <label class="ml-2" for="title">Shelf</label>
                </div>
                <div class="col-md-3 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $product->storage }}" id="storage" name="storage" required="required" >
                        <label class="ml-2" for="title">Storage</label>
                </div>
            </div>
            <hr>
    

            <div class="row">
                <div class="col-sm-5 ml-3 mt-3">
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="LondonDist" value="1" {{ $product->status == 1 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Active
                        </label>
                    </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="surreyDist" value="0" {{ $product->status == 0 ? "checked" : "" }} >
                        <label class="form-check-label" for="LondonDist">
                            Inactive
                        </label>
                    </div>
                </div>

                 <div class="col-sm-5 ml-3 mt-3">
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="sliced" id="sliced" value="yes" {{ $product->sliced == "yes" ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Sliced
                        </label>
                    </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="sliced" id="surreyDist" value="no" {{ $product->sliced == "no" ? "checked" : "" }} >
                        <label class="form-check-label" for="LondonDist">
                            Unsliced
                        </label>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row">
                  <div class="col-md-6">
                        <input type="file" name="image"  accept="image/png, image/gif, image/jpeg"  class="form-control">
                    </div>
            </div>
            <hr>

            <div class="row">
                <div class="text-center">
                    <a href="{{ $product->getImageUrl() }}" data-lightbox="photos">
                        <img style="width:500px;" class="img-fluid" src="{{ $product->getImageUrl() }}">
                    </a>
                </div>
            </div>
            <hr>

            

            <div class="row mt-2">
                <div class="col-md-12 text-center">
                    <input type="submit" value="save" class="btn btn-lg btn-primary text-center" >
                </div>
            </div>   
        </div>
    </form>