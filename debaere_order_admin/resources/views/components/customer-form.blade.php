    @props(['data'])

    <?php 
        $customer=$data["model"];
        $user=$data["user"];
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
 
    <form method="POST" action="{{ $routeObject }}">
        @csrf
        <div class="bg-light rounded h-100 p-4">
            <div class="row">
                <div class="col-md-6 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $customer->name }}" id="name" name="name" required="required" >
                        <label class="ml-2" for="name">Name</label>
                </div>
                 <div class="col-md-6 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $customer->company_name }}" id="company_name" name="company_name" required="required" >
                        <label class="ml-2" for="title">Company Name</label>
                </div>
            </div>
            
             <div class="row">
                <div class="col-md-4 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $customer->customer_number }}" id="customer_number" name="customer_number" required="required" >
                        <label class="ml-2" for="title">Customer Number</label>
                </div>
                <div class="col-md-4 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $customer->contact_number }}" id="contact_number" name="contact_number" required="required" >
                        <label class="ml-2" for="title">Contact Number</label>
                </div>
                 <div class="col-md-4 form-floating mb-3">
                        <input type="text" class="form-control" value="{{ $customer->contact_person }}" id="contact_person" name="contact_person" required="required" >
                        <label class="ml-2" for="title">Contact Person</label>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12 form-floating mb-3">
                        <input type="text" class="form-control required" value="{{ $customer->address_1 }}" id="address_1" name="address_1">
                        <label class="ml-2" for="title">Address 1</label>
                    </div>
                    <div class="col-md-12 form-floating mb-3">
                        <input type="text" class="form-control required" value="{{ $customer->address_2 }}" id="address_2" name="address_2">
                        <label class="ml-2" for="title">Address 2</label>
                    </div>
                    <div class="col-md-12 form-floating mb-3">
                        <input type="text" class="form-control required" value="{{ $customer->address_3 }}" id="address_3" name="address_3">
                        <label class="ml-2" for="title">Address 3</label>
                    </div>
                    <div class="col-md-12 form-floating mb-3">
                        <input type="text" class="form-control required" value="{{ $customer->address_4 }}" id="address_4" name="address_4">
                        <label class="ml-2" style="color:red;" for="title">Post Code *</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="col-md-12 form-floating mb-3">
                        <input type="text" class="form-control required" value="{{ $customer->d_address_1 }}" id="d_address_1" name="d_address_1">
                        <label class="ml-2" for="title">Delivery Address 1</label>
                    </div>
                    <div class="col-md-12 form-floating mb-3">
                        <input type="text" class="form-control required" value="{{ $customer->d_address_2 }}" id="d_address_2" name="d_address_2">
                        <label class="ml-2" for="title">Delivery Address 2</label>
                    </div>
                    <div class="col-md-12 form-floating mb-3">
                        <input type="text" class="form-control required" value="{{ $customer->d_address_3 }}" id="d_address_3" name="d_address_3">
                        <label class="ml-2" for="title">Delivery Address 3</label>
                    </div>
                    <div class="col-md-12 form-floating mb-3">
                        <input type="text" class="form-control required" value="{{ $customer->d_address_4 }}" id="d_address_4" name="d_address_4">
                        <label class="ml-2 required" style="color:red;" for="title">Post Code *</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-check col-md-5 ml-4">
                    <input class="form-check-input" type="checkbox" id="sameAsMain">
                    <label class="form-check-label" for="sameAsMain">
                        Delivery Address Same As Main Address
                    </label>
                </div>
               
               
            </div>

            <hr>

            <div class="row">
                <div class="col-sm-10 ml-3 mt-3">
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="location" id="LondonDist" value="1" {{ $customer->location == 1 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            London Distribution
                        </label>
                    </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="location" id="surreyDist" value="2" {{ $customer->location == 2 ? "checked" : "" }} >
                        <label class="form-check-label" for="LondonDist">
                            Surrey Distribution
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-10 ml-3 mt-3">
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="LondonDist" value="1" {{ $customer->status == 1 ? "checked" : "" }}>
                        <label class="form-check-label" for="LondonDist">
                            Active
                        </label>
                    </div>
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="surreyDist" value="0" {{ $customer->location == 0 ? "checked" : "" }} >
                        <label class="form-check-label" for="LondonDist">
                            Inactive
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12 form-floating mb-3">
                        <input type="email" class="form-control required" value="{{ $user->email }}" id="email" name="email">
                        <label class="ml-2 required" for="email">Email</label>
                    </div>         
                </div>
                 <div class="col-md-6">
                    <div class="col-md-12 form-floating mb-3">
                        <input type="password" class="form-control required" value="{{ $formRoute=='admin_customeredit' ? '' : $user->password }}" id="password" name="password">
                        <label class="ml-2 required" for="password">Password</label>
                    </div>         
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12 text-center">
                    <input type="submit" value="save" class="btn btn-lg btn-primary text-center" >
                </div>
            </div>   

        </div>
    </form>