@extends("layouts.app")


@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Member of project</h1>
            <table class="table">
                <tr>
                    <th>Assigned To</th>
                    <th>User Role</th>
                </tr>
                @foreach($model as $member)
                    <tr>
                        <td>{{$member->user->email}}</td>
                        <td>{{$member->designation}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-12">
            <h1 class="text-center">List of Task</h1>
            <a class="btn btn-primary" href="{{route('task.create',[request('pid')])}}">Add Task</a>
            <table class="table mt-3">
                @if($task)
                    <tr>
                        <th>Task Name</th>
                        <th>Task Detail</th>
                        <th>Check Details</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($task as $t)
                        <tr>
                            <td>{{$t->title}}</td>
                            <td>{{$t->description}}</td>
                            <td><a href="{{route('task.show',[request('pid'),$t->id])}}">click here</a></td>
                            <td>
                                <a class="btn btn-primary" href="{{route("task.edit",[request('pid'),$t->id])}}">Update</a>
                                <form method="post" action="{{route("task.destroy",[request("pid"),$t->id])}}">
                                    @csrf
                                    @method("delete")
                                    <a class="btn btn-danger" href="javascript:void(0)" onclick="$(this).closest('form').submit()">Delete</a>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                @endif

            </table>
        </div>
    </div>
</div>
@endsection
