 <form id="postSearchForm">
     <td>
     </td>
     <td>
     </td>
     <td>
         <input name="name" type="text" value="{{ Request::get('name') }}" class="form-control">
     </td>
     
     <td>
         <x-sliced-dropdown name="sliced" />
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