@section('title',$title)
<x-layout>
    <div class="row">
        <div class="col-md-12 m-2">
            <div class="bg-light rounded h-100 p-4">
                <h2 class="mb-4">Create Product</h2>
                <hr>
                 <div class="row">
                    <x-product-form :data="$data"  />
                </div>
            </div>
        </div>
    </div>
</x-layout>