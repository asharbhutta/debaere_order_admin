    @props(['data'])

    <?php
    $product = $data["model"];
    $offerings = $data["offering"];
    $formRoute = $data["formRoute"];
    $routeObject = $data["routeObject"];
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
                    <input type="text" class="form-control" value="{{ $product->name }}" id="name" name="name" required="required">
                    <label class="ml-2" for="name">Name</label>
                </div>
                <div class="col-md-4 form-floating mb-3">
                    <input type="text" class="form-control" value="{{ $product->product_number }}" id="product_number" name="product_number" required="required">
                    <label class="ml-2" for="title">Product Number</label>
                </div>
                <div class="col-md-4  mb-3">
                    <select class="form-control select2" name="offering_id">
                        <option value="">Select Offering</option>
                        @foreach($offerings as $k=>$v)
                        <option <?= $k == $product->offering_id ? "selected" : "" ?> value="{{ $k }}">{{ $v }}</option>
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
                    <input type="text" class="form-control" value="{{ $product->weight }}" id="weight" name="weight" required="required">
                    <label class="ml-2" for="title">Weight</label>
                </div>
                <div class="col-md-3 form-floating mb-3">
                    <input type="text" class="form-control" value="{{ $product->price }}" id="price" name="price" required="required">
                    <label class="ml-2" for="title">Price</label>
                </div>
                <div class="col-md-3 form-floating mb-3">
                    <input type="text" class="form-control" value="{{ $product->size }}" id="size" name="size" required="required">
                    <label class="ml-2" for="title">Size</label>
                </div>
                <div class="col-md-3 form-floating mb-3">
                    <input type="text" class="form-control" value="{{ $product->portions }}" id="portion" name="portions" required="required">
                    <label class="ml-2" for="title">Portions</label>
                </div>
            </div>
            <hr>


            <div class="row">
                <div class="col-md-3 form-floating mb-3">
                    <input type="text" class="form-control" value="{{ $product->pack_size }}" id="pack_size" name="pack_size" required="required">
                    <label class="ml-2" for="title">Pack Size</label>
                </div>
                <div class="col-md-3 form-floating mb-3">
                    <input type="text" class="form-control" value="{{ $product->shelf}}" id="price" name="shelf" required="required">
                    <label class="ml-2" for="title">Shelf</label>
                </div>
                <div class="col-md-3 form-floating mb-3">
                    <input type="text" class="form-control" value="{{ $product->storage }}" id="storage" name="storage" required="required">
                    <label class="ml-2" for="title">Storage</label>
                </div>
                <div class="col-md-3 form-floating mb-3">
                    <input type="text" class="form-control" value="{{ $product->sequence }}" id="sequence" name="sequence">
                    <label class="ml-2" for="title">Sequence</label>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-4 ml-3 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="update_price" id="update_price" value="1">
                        <label class="form-check-label" for="LondonDist">
                            Update price for all customers
                        </label>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 ml-3 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="LondonDist" value="1" {{ $product->status == 1 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="surreyDist" value="0" {{ $product->status == 0 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Inactive
                        </label>
                    </div>
                </div>

                <div class="col-sm-4 ml-3 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sliced" id="sliced" value="yes" {{ $product->sliced == "yes" ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Sliced
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sliced" id="surreyDist" value="no" {{ $product->sliced == "no" ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Unsliced
                        </label>
                    </div>
                </div>



                <div class="col-sm-4 ml-3 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="enable_notes" value="1" {{ $product->enable_notes == 1 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Notes Enabled
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="enable_notes" value="0" {{ $product->enable_notes == 0 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Notes Disabled
                        </label>
                    </div>
                </div>

                <div class="col-sm-4 ml-3 mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="prior_notice" id="LondonDist" value="0" {{ $product->prior_notice == 0 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Not Applicable
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="prior_notice" id="surreyDist" value="48" {{ $product->prior_notice == 48 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            48 Hour Prep Time
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="prior_notice" id="surreyDist" value="72" {{ $product->prior_notice == 72 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            72 Hour Prep Time
                        </label>
                    </div>
                </div>

                <div class="mt-3 ml-3">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="sun" {{ $product->mon ? "checked" : "" }} value="1">Sunday
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="mon" {{ $product->mon ? "checked" : "" }} value="1">Monday
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="tue" {{ $product->tue ? "checked" : "" }} value="1">Tuesday
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="wed" {{ $product->wed ? "checked" : "" }} value="1">Wednesday
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="thu" {{ $product->thu ? "checked" : "" }} value="1">Thursday
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="fri" {{ $product->fri ? "checked" : "" }} value="1">Friday
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="sat" value="1" {{ $product->sat ? "checked" : "" }}>Saturday
                        </label>
                    </div>
                </div>




            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <input type="file" name="image" accept="image/png, image/gif, image/jpeg" class="form-control">
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
                    <input type="submit" value="save" class="btn btn-lg btn-primary text-center">
                </div>
            </div>
        </div>
    </form>