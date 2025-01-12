@props(['member'])
<tr>
    <td></td>
    @if($member->viewed)
        <td>{{$member->order_no}}</td>
        <td>{{ $member->orderPrice() }}</td>
        <td>{{$member->customer_name}}</td>
        <td>{{ date('d/m/Y',strtotime($member->date)) }}</td>
        <td>{{ date('d/m/Y H:i:s',strtotime($member->created_at)) }}</td>
    @else
        <td class="fw-bold" >{{$member->order_no}}</td>
        <td class="fw-bold">{{ $member->orderPrice() }}</td>
        <td class="fw-bold">{{$member->customer_name}}</td>
        <td class="fw-bold">{{ date('d/m/Y',strtotime($member->date)) }}</td>
        <td class="fw-bold">{{ date('d/m/Y H:i:s',strtotime($member->created_at)) }}</td>
    @endif
    <td>
              <a type="button" href="{{ route('admin_order_view',$member->id) }}" target="_blank" class="btn btn-outline-primary">
                <span> <i class="fa fa-eye m-1" aria-hidden="true"></i></span>
                </a>
    </td>
   
</tr>