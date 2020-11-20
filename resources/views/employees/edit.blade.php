@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Employee</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.update',$employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $employee->user->name }}" class="form-control" placeholder="Name">
                </div>
            </div>

           <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                   <strong>Salary:</strong>
                   <input type="text" name="salary" value="{{ $employee->salary}}" class="form-control"
                          placeholder="Salary">
               </div>
           </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Department:</strong>
                    <select name="department_id" class="form-control">
                        @foreach ($data['departments'] as $id => $name)
                            @if ($id ==$employee->department_id )
                            <option selected = 'selected' value="{{$id}}">{{$name}}</option>
                            @else
                                <option value="{{$id}}">{{$name}}</option>
                            @endif;
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection