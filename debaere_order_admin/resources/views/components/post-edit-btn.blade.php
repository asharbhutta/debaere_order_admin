@props(['member','text'])


<a type="button" href="{{ route('adminshow',$member->id) }}" class="btn btn-outline-primary ">
    <span> <i class="fa fa-eye m-1" aria-hidden="true"></i>{{ $text }}</span>
</a>