@props(['member'])
<tr>
    <td>{{$member->index}}</td>
    <td>
         <a href="{{ $member->getIconUrl() }}" class="m-2" data-lightbox="photos">
                <img style="width:50px;" class="img-fluid" src="{{ $member->getIconUrl() }}">
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
        <input type="number" class="offering-sequence-field form-control"  data-id="{{ $member->id }}" value="{{$member->sequence}}">
    </td>
    <td>
        <td>
              <x-offering-edit-btn text="" :member="$member" />
        </td>
    </td>
   
    
</tr>