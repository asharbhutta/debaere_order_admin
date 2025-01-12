 @props(['member','text'])
 <form method="POST" class="m-1" action="{{ route('admin_customerdelete',$member->id) }}">
        {{ csrf_field() }}
        <div class="form-group">
            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-outline-danger">
                <i class="fa fa-trash m-1" aria-hidden="true"></i> 
            </button>
        </div>
    </form>