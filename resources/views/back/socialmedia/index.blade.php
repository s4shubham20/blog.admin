@extends('layouts.home')
@section('title', "Social Media")
@section('content')
@section('')
<style>
    .card-header h4{
        display: inline;
    }
    .card-header .btn{
        float: right;
    }
    .form-inline{
        display: inline;
    }
    .form-inline .btn{
        display: inline;
    }
</style>
@show
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4>Social Media</h4>
                <a href="{{ route('social.create') }}" class="btn btn-primary"><span class="fa fa-plus"></span> Add New Record</a>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-hover table-bordered table-stripe">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Icon</th>
                            <th>Icon Color</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socials as  $key => $item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->url }}</td>
                            <td>{{ $item->icon }}</td>
                            <td><input type="color" value="{{ $item->color }}" class="form-control" disabled></td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            @php
                                $eid = Crypt::encrypt($item->id);
                            @endphp
                            <td>
                                <a href="{{ $item->status == 0 ? "javascript:void();": $item->url }}"><button class="btn btn-warning" {{ $item->status == 0 ? "disabled":'' }}><span class="fa fa-eye"></span></button></a>
                                <a href="{{ route('social.edit', $eid) }}" class="btn btn-info"><span class="fa fa-edit"></span></a>
                                <form action="{{ route('social.destroy', $eid) }}" method="post" class="form-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return DeleteConfirmation();"><span class="fa fa-trash"></span></button>
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
