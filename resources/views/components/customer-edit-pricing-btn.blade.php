@props(['member','text'])

@if($member->customPrice)
<a type="button" href="{{ route('admin_customer_pricing_edit',$member->id) }}" class="btn btn-outline-success">
    <span> <i class="fa fa-pound-sign m-1" aria-hidden="true"></i>{{ $text }}</span>
</a>
@endif