 <form id="postSearchForm">
     <td>
     </td>
     <td>
         <input name="order_no" type="text" value="{{ Request::get('order_no') }}" class="form-control">
     </td>
     <td>
        <input name="customer_name" type="text" value="{{ Request::get('customer_name') }}" class="form-control">
     </td>
     <td>
        <input name="date" type="text" value="{{ Request::get('date') }}" class="form-control">
     </td>
     <td>
        <input name="created_at" type="text" value="{{ Request::get('created_at') }}" class="form-control">
     </td>
     <td>
     </td>
 </form>
 @section ('page-js-script')
 <script type="text/javascript">
     $(document).ready(function() {
         $('.form-control').on('change', function() {
             $("#postSearchForm").submit();
         });
     });
 </script>
 @endsection