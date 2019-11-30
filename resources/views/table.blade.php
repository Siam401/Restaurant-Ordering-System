<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <center><h4>BRAC Microfinance</h4></center>           
  <center><h4>Dabi Monitoring Unit</h4></center>           
  <center><h4>Branch wise Monitoring new way score</h4></center>  
  <div class="row">
      <div class="col-md-4">
          <div class="row">
            <p class="text-left">Area: (Area Name)</p>
          </div>
          <div class="row">
            <p class="text-left">Quarter: (Select quarter)</p>
          </div>
      </div>
      <div class="col-md-4">
        <p class="text-center">Region: (Region Name)</p>
      </div>
      <div class="col-md-4">
        <p class="text-right">Division: (Division Name)</p>
      </div>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th rowspan="1">SL</th>
        <th rowspan="2">Full marks</th>
        <th rowspan="1">Section & Indicator Name</th>
        @foreach($data as $row)
        <th rowspan="1">Branche Name(Branch Code)</th>
        @endforeach
      </tr>
      <tr>
        <th rowspan="1">1</th>
        <th rowspan="1">Check new member admission</th>
        <th rowspan="1">412</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $sl=1;
      $sectionsdata = DB::select(DB::raw("SELECT CONCAT(section,'.', sub_id) AS si,string_agg
                    (DISTINCT CONCAT( branchcode, ':', point), ',')  as  brands, section, sub_id, question_point as fullmark FROM mnwv2.cal_section_point WHERE event_id IN(SELECT id FROM mnwv2.monitorevents WHERE area_id='118' and quarterly='2nd') GROUP BY section,sub_id,question_point,branchcode,si"));
      ?>
      @foreach($data as $row)
      <?php 
        $tabledatas=DB::table('mnwv2.cal_section_point')->where('event_id', '=', $row->id )->where('section', '=', 1 )->orderBy('sub_id', 'asc')->get();
      ?>
        @foreach ($tabledatas as $tabledata)
            <tr>
                <td>{{ $sl }}.{{ $tabledata->sub_id }}</td>
                <td>{{ $tabledata->question_point }}</td>
                <td>mary@example.com</td>
                <td>{{ $tabledata->point }}</td>
            </tr>
        @endforeach
        <?php $sl++; ?>
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
