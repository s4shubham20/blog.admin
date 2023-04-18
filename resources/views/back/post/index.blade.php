@extends('layouts.home')
@section('title', 'Post')
@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="headingIn">Post</h4>
                <div class="float-right">
                    <a href="{{ route('post.create') }}"><button class="btn btn-primary"><span class="fa fa-plus"></span>New Record</button></a>
                </div>
            </div>
            <div class="mt-2 ms-2">
                <button id="deleteRecord" type="button" name="deleting" class="btn btn-danger">Delete All</button>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="selectAll" id="select_all"></th>
                            <th>#</th>
                            <th>Post</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $key => $item)
                            <tr>
                                <td><input type="checkbox" id="deleteAll" class="checkbox" data-id="{{ $item->id }}">
                                </td>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <b>Name: </b>{{ $item->name }}
                                    <br>
                                    <b>Slug: </b>{{ $item->slug }}
                                </td>
                                <td>{{ $item->category->name }}</td>
                                <td>
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->alt }}" width="100">
                                </td>
                                <td>
                                    <b>Created Date: </b>{{ $item->created_at }}
                                    <br>
                                    <b>Updated Date: </b>{{ $item->updated_at }}
                                </td>
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
                                    <a href="{{ route('post.edit', $eid) }}"><button class="btn btn-info mb-2"><span
                                                class="fa fa-edit"></span></button></a>
                                    <form action="{{ route('post.destroy', $eid) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"><span class="fa fa-trash"></span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#select_all').click(function() {
                var checked = this.checked;
                $('input[type="checkbox"]').each(function() {
                    this.checked = checked;
                });
            })
        });
        $(document).ready(function() {
            $("#deleteRecord").click(function() {
                var idsArr = [];
                $(".checkbox:checked").each(function() {
                    idsArr.push($(this).attr('data-id'));
                });
                if (idsArr.length <= 0) {
                    alert("please select atleast one")
                } else {
                    if (confirm("Are you sure, you want to delete the selected records?")) {
                        var strIds = idsArr.join(",");
                        $.ajax({
                            url: "{{ route('admin.post.deleteall') }}",
                            type: "post",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + strIds,
                            success: function(response) {
                                $("#msg").html(response);
                                window.location.reload();
                            },
                        })
                    }
                }
            });
        });
    </script>
@endsection
