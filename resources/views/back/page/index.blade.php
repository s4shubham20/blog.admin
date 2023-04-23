@extends('layouts.home')
@section('title', 'Show Page')
@section('css')
    <style>
        .card-header .card-heading{
                display: inline;
            }
        .card-header .btn {
            float: right;
        }
        .cardheadin{
            display: inline;
        }
        .cardheadin .btn{
            display: inline;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid px-4">
    <div class="card mt-4">
        <div class="card-header">
            <h4 class="card-heading">Page List</h4>
            <a href="{{ route('page.create') }}"><button class="btn btn-primary"><span class="fa fa-plus"></span> Add New Record</button></a>
        </div>
        <div class="card-body">
            <table id="myTable" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Page Detail</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            <b>Name: </b>{{ $item->name }}
                            <br>
                            <b>Slug: </b>{{ $item->slug }}
                        </td>
                        <td>
                            <img src="{{ asset($item->image) }}" alt="{{ $item->alt }}" width="100">
                        </td>
                        <td>
                            @if ($item->status == 1)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('d-M-Y') }}</td>
                        @php
                            $eid = Crypt::encrypt($item->id);
                        @endphp
                        <td>
                            <a href="{{ route('page.edit', $eid) }}"  rel="noopener noreferrer" class="btn btn-info"><span class="fa fa-edit"></span></a>
                            <form action="{{ route('page.destroy', $eid) }}" method="post" class="mt-2 cardheadin">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-Inline" onclick="return DeleteConfirmation();"><span class="fa fa-trash"></span></button>
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
