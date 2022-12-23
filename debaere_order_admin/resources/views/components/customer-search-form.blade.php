 <form id="postSearchForm">
     <td>
     </td>
     <td>
         <input name="company_name" type="text" value="{{ Request::get('company_name') }}" class="form-control">
     </td>
    
     <td>
        <input name="contact_number" type="text" value="{{ Request::get('customer_number') }}" class="form-control">
     </td>
     <td>
        <input name="email" type="text" value="{{ Request::get('email') }}" class="form-control">
     </td>
     <td>
         <x-location-dropdown name="location" />
     </td>
     <td>
         <x-status-dropdown name="status" />
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