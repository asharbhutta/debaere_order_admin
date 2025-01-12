
    <?php 
        $offering=$data["model"];
        // $formRoute=$data["formRoute"];
        // $routeObject=$data["routeObject"];
        
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
    <x-layout>
    <h3>Promotion</h3>
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-light rounded h-100 p-4">
            
             <div class="row">
                <div class="col-md-12 form-floating mb-3">
                        <textarea class="form-control" placeholder="Add Description here" name="description" style="height: 150px;">{{ $offering->description }}</textarea>
                        <label for="floatingTextarea">Description</label>
                </div>
            </div>
            <hr>

    

            <div class="row">
                <div class="col-sm-5 ml-3 mt-3">
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="active" id="LondonDist" value="1" {{ $offering->active == 1 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Active
                        </label>
                    </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="active" id="surreyDist" value="0" {{ $offering->active == 0 ? "checked" : "" }} >
                        <label class="form-check-label" for="LondonDist">
                            Inactive
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
                    <a href="{{ $offering->image }}" data-lightbox="photos">
                        <img style="width:150px;" class="img-fluid" src="{{ $offering->image }}">
                    </a>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12 text-center">
                    <input type="submit" value="save" class="btn btn-lg btn-primary text-center" >
                </div>
            </div>   
        </div>
    </form>
</x-layout>