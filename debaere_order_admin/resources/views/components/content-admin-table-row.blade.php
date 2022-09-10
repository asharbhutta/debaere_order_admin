@props(['member'])

<tr>
    <td>{{$member->index}}</td>
    <td>{{$member->title}}</td>
    <td>
        <a href="{{ $member->url }}" data-lightbox="photos">
            <img style="width:50px;" class="img-fluid" src="{{ $member->thumb_url }}">
        </a>
    </td>
    <td>
        <x-post-tags-badges :member="$member" />
    </td>
    <td>
        <x-boolean-badge :boolean="$member->approved" />
    </td>
    <td>
        <x-boolean-badge :boolean="$member->posted" />
    </td>
    <td>
        <x-boolean-badge :boolean="!empty($member->explaination)" />
    </td>
    <td>
        <x-post-stats-badges :member="$member" />
    </td>
    <td>
        <x-post-edit-btn text="" :member="$member" />
        <x-post-update-btn text="" :member="$member" />

    </td>
</tr>