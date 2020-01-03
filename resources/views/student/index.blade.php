@extends('welcome')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-md-10 mx-auto">

            <a href="{{ url('student/create') }}" class="btn btn-danger">Add Student</a>

            <hr>

            <table class="table table-responsive">
            <tr>
            <th>SL</th>
            <th>Student Name</th>
            <th>Student Email</th>
            <th>Student Phone</th>
            <th>Action</th>
            </tr>

            @foreach($student as $row)
            <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->phone }}</td>
            <td>
            <a href="{{ URL::to('student/'.$row->id.'/edit') }}" class="btn btn-sm btn-info">Edit</a>
            <form action="{{ URL::to('student/'.$row->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" style="submit" >Delete</button>
            </form>
            <!-- <a href="{{ URL::to('student/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a> -->
            <a href="{{ URL::to('student/'.$row->id) }}" class="btn btn-sm btn-success">View</a>
            </td>
            </tr>
            @endforeach
            </table>



        </div>
    </div>
</div>

@endsection
