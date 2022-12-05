
    <?php 
       /// $offering=$data["model"];
        // $formRoute=$data["formRoute"];
        // $routeObject=$data["routeObject"];
        $customer=$data["customer"];
        $data= $data["pricesData"];
        
    ?>

   
    <x-layout>
    <h3>Custom Pricing For {{ $customer->name }}</h3>
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-light rounded h-100 p-4">
            
    
            <hr>
            <div class="row">
                  <div class="table-responsive">
                  <table class="table  table-bordered">
                        <thead>
                            <tr>
                                <td>Minimum Order Price</td>
                                <td>{{ $customer->min_order_price }}</td>
                            </tr>
                        </thead>
                    </table>
                    <table class="table  table-bordered">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Product Name</td>
                                <td>Base Price</td>
                                <td>Price</td>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($data as $dt)
                           <tr>
                                <td>{{ $dt->product->product_number }}</td>
                                <td>{{ $dt->product->name }}</td>
                                <td>{{ $dt->product->price }}</td>
                                <td>{{ $dt->price }}</td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                  </div>
            </div>


           
            <hr>

           
        </div>
    </form>
</x-layout>