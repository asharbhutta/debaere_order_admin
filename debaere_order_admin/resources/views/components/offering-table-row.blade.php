@props(['member'])
<tr>
    <td>{{$member->index}}</td>
    <td>
         <a href="{{ $member->getIconUrl() }}" class="m-2 hide" data-lightbox="photos">
                <img style="width:100px;" class="img-fluid" src="{{ $member->getIconUrl() }}">
        </a>
    </td>
    <td>{{$member->name}}</td>
    <td>
        <x-sliced-badge :sliced="$member->sliced" />
    </td>
    <td>
        <x-boolean-badge :boolean="$member->status" />
    </td>
    <td>
        <td>
              <x-offering-edit-btn text="" :member="$member" />
        </td>
    </td>
</tr>