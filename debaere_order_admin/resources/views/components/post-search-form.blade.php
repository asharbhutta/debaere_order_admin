 <form id="postSearchForm">
     <td>
     </td>
     <td>
         <input name="title" type="text" value="{{ Request::get('title') }}" class="form-control">
     </td>
     <td>
     </td>
     <td>
         <x-tags-dropdown />
     </td>
     <td>
         <x-boolean-dropdown name="approved" />
     </td>
     <td>
         <x-boolean-dropdown name="posted" />
     </td>
     <td>
         <x-boolean-dropdown name="explaination" />
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