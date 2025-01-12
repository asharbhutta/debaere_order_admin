<?php


?>
<x-layout>
    <h2>{{ $data["message"] }}</h2>
    <form>
        <div class="row">
                <div class="col-md-3">
                    <label>Start</label>
                     <input type="date" name="date">
                </div>
                <div class="col-md-3">
                    <label>End</label>
                     <input type="date" name="end_date">
                </div>
                <div class="col-md-3">
                    <x-offering-dropdown/>
                </div>

                <div class="col-md-3">
                     <input type="submit" name="generate" class="btn btn-success">
                </div>
        </div>
    </form>
    <div class="row">
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Name</th>
        <th scope="col">Offering</th>
      <th scope="col">Count</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data["results"] as $row){ ?>
        <tr>
            <td>{{ $row->code }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->of_name }}</td>
            <td>{{ $row->pcount }}</td>
        </tr>
    <?php } ?>
  </tbody>
</table>

    </div>
</x-layout>