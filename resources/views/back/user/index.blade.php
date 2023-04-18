@extends('layouts.home')
@section('title', 'Users')
@section('css')
    <style>
        .cardheadin{
            display: inline;
        }
        .cardheadin .btn{
            display: inline;
        }
    </style>
@show
@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="cardheadin">User Details</h4>
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <b>Name: </b>{{ $item->name }}
                            <br>
                            <b>Email: </b>{{ $item->email }}
                        </td>
                        <td>
                            <b>Created Date: </b>{{ $item->created_at }}
                            <br>
                            <b>Updated Date: </b>{{ $item->updated_at }}
                        </td>
                        @php
                            $eid = Crypt::encrypt($item->id);
                        @endphp
                        <td>
                            <a href="{{ route('user.edit',$eid) }}"><button class="btn btn-info"><span class="fa fa-edit"></span></button></a>
                            <form action="{{ route('user.destroy',$eid) }}" method="post" class="mt-2 cardheadin">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return DeleteConfirmation('')"><span class="fa fa-trash"></span></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
