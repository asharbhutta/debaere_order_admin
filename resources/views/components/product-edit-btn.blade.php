@props(['member','text'])
<a type="button" href="{{ route('admin_product_edit',$member->id) }}" class="btn btn-outline-primary">
    <span> <i class="fa fa-edit m-1" aria-hidden="true"></i>{{ $text }}</span>
</a>