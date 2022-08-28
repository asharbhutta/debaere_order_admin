 <form id="postSearchForm">
     <td>
     </td>
     <td>
         <input name="tag" type="text" value="{{ Request::get('tag') }}" class="form-control">
     </td>
     <td>
     </td>
     <td>
         
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