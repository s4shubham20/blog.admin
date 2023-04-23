@extends('layouts.home')
@section('title', 'Category')
@section('css')
@show
@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="headingIn">All Categories</h4>
            <div class="float-right">
                <a href="{{ route('category.create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Record</button></a>
            </div>
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <b>Name: </b>{{ $item->name }}
                            <br>
                            <b>Slug: </b>{{ $item->slug }}
                        </td>
                        <td>
                            <img src="{{ asset($item->image) }}" alt="{{ $item->alt }}" width="100" height="100">
                        </td>
                        <td>
                            @if ($item->status == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <b>Create Date:</b>{{ $item->created_at }}
                            <br>
                            <b>Updated Date:</b>{{ $item->updated_at }}
                        </td>
                        <td>
                            @php
                                $eid = Crypt::encrypt($item->id);
                            @endphp
                            <form action="{{ route('category.destroy',$eid) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mb-2"><i class="fa fa-trash"></i></button>
                            </form>
                            <a href="{{ route('category.edit',$eid) }}"><i class="fa fa-edit btn btn-info"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
