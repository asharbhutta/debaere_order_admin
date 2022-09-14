@section('title',$title)
<x-layout>
    <div class="row">
        <div class="col-md-12 m-2">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                    <div class="col-md-3">
                        <h2 class="mb-4">All Products</h2>
                    </div>
                    <div class="col-md-2 offset-md-7">
                        <a class="btn btn-outline-primary" href="{{ route('admin_product_create') }}" >Create Products</a>
                    </div>
                </div>
                <hr>
                 <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Product Number</th>
                                    <th scope="col">Offering </th>
                                    <th scope="col">Sliced/Unsliced</th>
                                    <th scope="col">Status</th>
                                </tr>
                                 <tr>
                                    <x-product-search-form />
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $k=>$member)
                                <x-product-table-row :member="$member" />
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                     {{ $data->appends(request()->query())->links() }}

                </div>
            </div>
        </div>
    </div>
</x-layout>