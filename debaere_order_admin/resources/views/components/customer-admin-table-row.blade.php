@props(['member'])

<tr>
    <td>{{$member->index}}</td>
    <td>{{$member->company_name}}</td>
    <td>{{$member->contact_number}}</td>
    <td>{{$member->user->email}}</td>
    <td>
        <x-location-badge :location="$member->location" />
    </td>
    <td>
        <x-boolean-badge :boolean="$member->status" />
    </td>
    <td>
        <td>
              <x-customer-edit-btn text="" :member="$member" />
              <x-customer-delete-btn text="" :member="$member" />
        </td>
    </td>
</tr>