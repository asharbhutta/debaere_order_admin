@section('title',$title)
<x-layout>
    <div class="row">
        <div class="col-md-12 m-2">
            <div class="bg-light rounded h-100 p-4">
                <div class="row">
                    <div class="col-md-3">
                        <h2 class="mb-4">All Offerings</h2>
                    </div>
                    <div class="col-md-2 offset-md-7">
                        <a class="btn btn-outline-primary" href="{{ route('admin_offering_create') }}" >Create Offerings</a>
                    </div>
                </div>
                <hr>
                 <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Sliced</th>
                                    <th scope="col">Status</th>
                                </tr>
                                 <tr>
                                    <x-offering-search-form />
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $k=>$member)
                                <x-offering-table-row :member="$member" />
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