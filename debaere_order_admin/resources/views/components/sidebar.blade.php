<div class="sidebar pe-4 pb-3">
    <p>

    </p>
    <nav class="navbar bg-light navbar-light">
        <a class="navbar-brand mx-4 mb-3" href="" > 
                <img style="width:80%" src="{{ URL::asset('img/debaere_logo.png') }}"></a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <x-rounded-user-image />
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="" class="nav-item nav-link  {{ request()->route()->prefix('/admin')=='/admin' ? "active" : " " }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ route('admin_customer_admin') }}" class="nav-item nav-link  {{  strpos(request()->route()->getName(),'customer')!== false ? 'active' : ' ' }}"><i class="fa fa-user-alt me-2"></i>Customers</a>
            <a href="{{ route('admin_offering_admin') }}" class="nav-item nav-link  {{  strpos(request()->route()->getName(),'offering')!== false ? 'active' : ' ' }}"><i class="fa fa-cookie m-2"></i>Offerings</a>
             <a href="{{ route('admin_product_admin') }}" class="nav-item nav-link  {{  strpos(request()->route()->getName(),'product')!== false ? 'active' : ' ' }}"><i class="fa fa-bread-slice m-2"></i>Products</a>

        </div>
    </nav>
</div>