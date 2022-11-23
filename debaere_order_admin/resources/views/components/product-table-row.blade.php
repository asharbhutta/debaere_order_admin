@props(['member'])
<tr>
    <td>{{$member->index}}</td>
    <td>{{$member->name}}</td>
    <td>{{$member->product_number}}</td>
    <td>{{$member->offering->name}}</td>
    <td>
        <x-sliced-badge :sliced="$member->sliced" />
    </td>
    <td>
        <x-boolean-badge :boolean="$member->status" />
    </td>
    <td>
        <input type="number" class="sequence-field form-control"  data-id="{{ $member->id }}" value="{{$member->sequence}}">
        
    </td>
    
    <td>
        <td>
              <x-product-edit-btn text="" :member="$member" />
              <a type="button" href="{{ route('admin_product_replicate',$member->id) }}" class="btn btn-outline-success">
                    <span> <i class="fa fa-edit m-1" aria-hidden="true"></i> Replicate  </span>
                </a>
        </td>
    </td>
</tr>