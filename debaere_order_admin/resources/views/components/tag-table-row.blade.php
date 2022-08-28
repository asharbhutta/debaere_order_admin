@props(['member'])

<tr>
    <td></td>
    <td>{{$member->tag}}</td>
    <td>
        <a href="{{ $member->url }}" data-lightbox="photos">
            <img style="width:50px;" class="img-fluid" src="{{ $member->url }}">
        </a>
    </td>
    <td>
        {{ $member->posts->count() }}
    </td>
    <td>
        <a type="button" href="{{ route('admintagview',$member->id) }}" class="btn btn-outline-primary ">
            <span> <i class="fa fa-eye m-1" aria-hidden="true"></i></span>
        </a>
    </td>
</tr>