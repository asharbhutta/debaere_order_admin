
    <?php 
       /// $offering=$data["model"];
        // $formRoute=$data["formRoute"];
        // $routeObject=$data["routeObject"];
        
    ?>

   
    <x-layout>
    <h3>Import Customer Pricing File</h3>
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-light rounded h-100 p-4">
            
    
            <hr>
            <div class="row">
                  <div class="col-md-6">
                        <input type="file" name="file" required="required"  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  class="form-control">
                    </div>
            </div>


            <div class="row mt-3">
                  <div class="col-md-12">
                  @if ($data["errors"])
                        <div class="alert alert-warning">
                            <h3>Issues</h3>
                            <ul>
                                @foreach ($data["errors"] as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>  
                        @endif
                  </div>
            <hr>

            <div class="row mt-2">
                <div class="col-md-12 text-center">
                    <input type="submit" value="save" class="btn btn-lg btn-primary text-center" >
                </div>
            </div>   
        </div>
    </form>
</x-layout>