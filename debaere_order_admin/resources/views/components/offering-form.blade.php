    @props(['data'])

    <?php 
        $offering=$data["model"];
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
                <div class="col-md-6 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $offering->name }}" id="name" name="name" required="required" >
                        <label class="ml-2" for="name">Name</label>
                </div>
                 <div class="col-md-6 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $offering->slug }}" id="slug" name="slug" required="required" >
                        <label class="ml-2" for="title">Slug</label>
                </div>
            </div>
            
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
                        <input class="form-check-input" type="radio" name="status" id="LondonDist" value="1" {{ $offering->status == 1 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Active
                        </label>
                    </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="surreyDist" value="0" {{ $offering->status == 0 ? "checked" : "" }} >
                        <label class="form-check-label" for="LondonDist">
                            Inactive
                        </label>
                    </div>
                </div>

                  <div class="col-sm-5 ml-3 mt-3">
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="sliced" id="LondonDist" value="1" {{ $offering->sliced == 1 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Sliced
                        </label>
                    </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="sliced" id="surreyDist" value="0" {{ $offering->sliced == 0 ? "checked" : "" }} >
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
                <div class="col-md-5 m-2">
                    <a href="{{ $offering->getIconUrl() }}" data-lightbox="photos">
                        <img style="width:150px;" class="img-fluid" src="{{ $offering->getIconUrl() }}">
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