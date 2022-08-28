@props(['member'])

<tr>
    <td>{{$member->title}}</td>
    <td>
        <a href="{{ $member->url }}" data-lightbox="photos">
            <img style="width:50px;" class="img-fluid" src="{{ $member->thumb_url }}">
        </a>
    </td>
    <td>
        <button class="btn-sm btn-outline-success"><i class="fa fa-eye m-1" aria-hidden="true"></i>{{$member->views}}</button>
    </td>
    <td>{{ $member->post->created_at->format('d/m/Y') }}</td>
    <td>
        <x-post-edit-btn text="" :member="$member" />
    </td>
</tr>