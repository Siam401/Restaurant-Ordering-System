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
                                <center><h5>Update Employee</h5></center>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                        <li><i class="feather icon-maximize full-card"></i></li>
                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                        <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                        <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="row justify-content-center">
                                    <div class="col-sm-8">
                                    <form action="{{ route('employee.update',$employee->id) }}" method="post">
                                    @csrf    
                                    <input name="_method" type="hidden" value="PUT">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="username" class="form-control" value="{{ $employee->username }}">
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="password" class="form-control" value="{{ md5($employee->password) }}">
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Full Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="fullname" class="form-control" value="{{ $employee->fullname }}">
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Role</label>
                                        <div class="col-sm-10">
                                            <select type="text" name="role" class="form-control fill">
                                                <option value="1">Waiter</option>
                                                <option value="2">Employee</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <center><button type="submit" class="btn btn-primary">Update</button></center>   
                                    </form>  
                                    </div> 
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection