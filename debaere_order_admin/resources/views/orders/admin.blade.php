@section('title',$title)
<x-layout>
    <div class="row">
        <div class="col-md-12 m-2">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                    <div class="col-md-3">
                        <h2 class="mb-4">All Orders</h2>
                    </div>
                    
                </div>
                <hr>
                 <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order No</th>
                                    <th scope="col">Order Value</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Action</th>

                                </tr>
                                 <tr>
                                    <x-order-search-form/>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $k=>$member)
                                <x-order-table-row :member="$member" />
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