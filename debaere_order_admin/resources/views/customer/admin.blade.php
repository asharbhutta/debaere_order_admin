@section('title',$title)
<x-layout>
    <div class="row">
        <div class="col-md-12 m-2">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                    <div class="col-md-3">
                        <h2 class="mb-4">All Customers</h2>
                    </div>
                    <div class="col-md-2 offset-md-7">
                        <a class="btn btn-outline-primary" href="{{ route('admin_customer_create') }}" >Create Customer</a>
                    </div>
                </div>
                <hr>
                 <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                 <tr>
                                    <x-customer-search-form />
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $k=>$member)
                                <x-customer-admin-table-row :member="$member" />
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>