@props(['member'])
<tr>
    <td>{{$member->index}}</td>
    <td>{{$member->name}}</td>
    <td>{{$member->product_number}}</td>
    <td>{{$member->offering->name}}</td>
    <td>
        <x-boolean-badge :boolean="$member->status" />
    </td>
    <td>
        <td>
              <x-product-edit-btn text="" :member="$member" />
        </td>
    </td>
</tr>