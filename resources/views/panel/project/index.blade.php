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
            <a class="btn btn-primary" href="{{route('task.create',[request('id')])}}">Add Task</a>
            <table class="table">

            </table>
        </div>
    </div>
</div>
@endsection
