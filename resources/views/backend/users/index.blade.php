@extends('layouts.backend')
<div class="content-header text-center">
    <h2>Manager Users</h2>
</div>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if ($message = Session::get('success'))
                @endif
                @if ($message = Session::get('error'))
                @endif
                <div class="table-responsive">
                    <button class="btn btn-success" style="margin: 10px 0px"><a href="{{ route('user.create') }}"><i
                                    class="fa fa-plus"></i> Thêm mới</a></button>
                    <form class="form-search" action="/action_page.php">
                        <input type="text" placeholder="Search.." name="search2">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <table class="table table-bordered table-hover tablesorter">
                    <thead>
                    <tr>
                        <th>Name <i class="fa fa-sort"></i></th>
                        <th>Gender</th>
                        <th>Avatar</th>
                        <th>Birthday <i class="fa fa-sort"></i></th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->gender }}</td>
                            <td class="text-center"><img class="img-thumbnail img-user"
                                                         src="{{ asset('uploads/'.$user->avatar) }}" alt=""></td>
                            <td>{{ $user->dob }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                <button class="btn btn-info float-left"><a
                                            href="{{ route('user.show',['id'=>$user->id]) }}"><i
                                                class="fa fa-eye"></i></a></button>
                                <button class="btn btn-warning float-left"><a
                                            href="{{ route('user.edit',['id'=>$user->id]) }}"><i
                                                class="fa fa-edit"></i></a></button>
                                <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Xác nhận xóa?')"><i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
    </div>
    <style>
        form.form-search {
            padding: 20px 0;
        }

        form.form-search input[type=text] {
            padding: 10px;
            border: 1px solid grey;
            float: left;
            background: #f1f1f1;
        }

        form.form-search button {
            float: left;
            padding: 12px;
            color: white;
            font-size: 17px;
            border: 1px solid grey;
            cursor: pointer;
        }

        form.form-search button:hover {
            background: #0b7dda;
        }
    </style>
@endsection
