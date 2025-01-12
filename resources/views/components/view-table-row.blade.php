@props(['member'])

<tr>
    <td>{{$member->title}}</td>
    <td>
        <a href="{{ $member->url }}" data-lightbox="photos">
            <img style="width:50px;" class="img-fluid" src="{{ $member->thumb_url }}">
        </a>
    </td>
    <td>{{ $member->views }}</td>
    <td>
        <x-post-edit-btn text="" :member="$member" />
    </td>
</tr>