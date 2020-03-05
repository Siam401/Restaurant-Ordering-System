@extends('backend.layouts.master')

@section('content')

<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                @endif
                                <h5>Package</h5>
                                <button type="button" style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#large-Modal">Add package</button>
                            </div>
                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    {{-- <table id="multi-colum-dt" class="table table-striped table-bordered nowrap"> --}}
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Package Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ipackages as $row)
                                                <tr>
                                                    <td>{{ $row->packagename }}</td>
                                                    <td>
                                                        <form action="{{ route('ipackage.destroy',$row->packageid) }}" method="POST" onsubmit="if(confirm('Are you sure, you want to delete?')){return ture } else {return false };"> 
                                                        @csrf
                                                            <a href="javascript:void(0)" id="showDetails" onclick="showDetails('{{ $row->packageid }}')" class="btn btn-info">Details</a>
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <button type="submit" class="btn btn-danger btn-rounded">Delete</button>
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
                </div>


                <!-- Create Modal -->
                <div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create package</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('ipackage.store') }}" method="post">
                                    @csrf    
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label">Package Code</label>
                                        <label class="col-sm-6 col-form-label float-right">Package Name</label>
                                    </div>     
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="text" name="packageid" class="form-control" value="{{ uniqid() }}" readonly>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="packagename" class="form-control" placeholder="Type package name" required>
                                        </div>
                                    </div> 
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th>Ingredient</th>
                                            <th>Unit</th>
                                            <th>Quantity</th>
                                            <th><a href="javascript:void(0);" class="btn btn-success add_button">+</a></th>
                                          </tr>
                                        </thead>
                                        <tbody class="field_wrapper">
                                          <tr>
                                            <td>
                                                <select class="form-control" name="ingredientid[]">
                                                  @foreach ($ingredients as $row)
                                                    <option value="{{ $row->id }}">{{ $row->ingredientname }}</option>
                                                  @endforeach  
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="unit[]">
                                                  @foreach ($units as $row)
                                                    <option value="{{ $row->id }}">{{ $row->unitname }}</option>
                                                  @endforeach  
                                                </select>
                                            </td>
                                            <td>
                                              <input type="number" min="0" class="form-control mb-2 mr-sm-2" id="email2" placeholder="Enter Quantity" name="quantity[]" required> 
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>  
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                <!--End Create Modal -->
                <!--Show Modal -->
                <div class="modal fade" id="showDetailsModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Package Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <label>Package Code: <label>
                                        <p id="PackageCode"></p>    
                                    </div>
                                    <div class="col">
                                        <label>Package Name: <label>
                                        <p id="PackageName"></p>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <ul class="list-group" id="itemList">
                                        <li class="list-group-item">Cras justo odio</li>
                                    </ul> 
                                    </div>  
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <!--End Show Modal -->
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
<script>
$(document).ready(function() {
    var x = 1;
    var fieldHTML = '';

    $('#simpletable').DataTable( {
        "order": [[ 0, "desc" ]]
    });

    $.ajax({
        url: "{{ url('/ingredient/all') }}",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            console.log(data.units);
            fieldHTML = '<tr><td><select class="form-control" name="ingredientid[]">'
            for(var i=0; i<data.ingredients.length; i++){ 
                var id = data.ingredients[i].id;  
                var ingredientname = data.ingredients[i].ingredientname;  
                fieldHTML += '<option value="'+id+'">'+ingredientname+'</option>'
            }
            fieldHTML += '</select></td>'
            fieldHTML += '<td><select class="form-control" name="unit[]">'
            for(var i=0; i<data.units.length; i++){ 
                var id = data.units[i].id;  
                var unitname = data.units[i].unitname;  
                fieldHTML += '<option value="'+id+'">'+unitname+'</option>'
            }
            fieldHTML += '</select></td><td><input type="number" min="0" class="form-control mb-2 mr-sm-2" id="email2" placeholder="Enter Quantity" name="quantity[]" required><td><a href="javascript:void(0);" class="btn btn-danger remove_button">-</a></td></td></tr>';
        },
        error: function (data) {
          alert('Ghorer Dim');
        }
    });    

    $('.add_button').click(function(){
        x++; //Increment field counter
        $('.field_wrapper').append(fieldHTML);
    });

    $('.field_wrapper').on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).closest('tr').remove(); //Remove field html
        x--; //Decrement field counter
    });
});

function showDetails(id){
    $('#showDetailsModal').modal('show'); 
    $.ajax({
        url: "{{ url('ipackage/show') }}" + '/' + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#itemList').empty();
            $('#PackageCode').empty();
            $('#PackageName').empty();

            $("#PackageCode").append(data.packageid[0]); 
            $("#PackageName").append(data.packagename[1]); 
            
            var details='';
            for(var i=0; i<data.ingredientname.length; i++)
            {
                var ingredientname= data.ingredientname[i];
                var unitname= data.unitname[i];
                var quantity= data.quantity[i];

                details='<li class="list-group-item">'+quantity+' '+unitname+' '+ingredientname+'</li>';

                $("#itemList").append(details); 
            }
        },
        error: function (data) {
        alert('Ghorer Dim');
        }
    });
}
</script>
@endsection

												