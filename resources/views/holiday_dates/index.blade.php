<x-layout>
    <div class="row">
        <div class="col-md-12 m-2">
            <div class="bg-light rounded h-100 p-4">
                <h2 class="mb-4">Holiday Dates</h2>
                <hr>
                 <div class="row">
                    <form method="POST">
                        @csrf
                         <div class="row">
                        <div class="col-md-12 form-floating mb-3">
                                <input type="date" class="form-control"  id="name" name="date" required="required" >
                                <label class="ml-2" for="name">Start Date</label>
                        </div>
                         <div class="col-md-12 form-floating mb-3">
                                <input type="date" class="form-control"  id="name" name="end_date" required="required" >
                                <label class="ml-2" for="name">End Date</label>
                        </div>
                        <div class="col-md-12 form-floating mb-3">
                                <input type="text" class="form-control"  id="product_number" name="message" required="required" >
                                <label class="ml-2" for="title">Message</label>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 text-center">
                                <input type="submit" value="save" name="save" class="btn btn-lg btn-primary text-center" >
                            </div>
                        </div>   
                     </div>
                    </form>
                </div>
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Date</td>
                                <td>End Date</td>
                                <td>Message</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count=0 ?>
                            @foreach($dates as $date)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ date("d/m/Y",strtotime($date->date)) }}</td>
                                    <td>{{ date("d/m/Y",strtotime($date->end_date)) }}</td>
                                    <td>{{ $date->message }}</td>
                                    <td> 
                                        <form method="POST" class="m-1" action="{{ route('admin_deleteHoliday',$date->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <div class="form-group">
                                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-outline-danger">
                                                <i class="fa fa-trash m-1" aria-hidden="true"></i> 
                                            </button>
                                        </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>