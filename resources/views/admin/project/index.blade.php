@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{{url("/admin/project/create")}}">Add Project</a>
        </div>
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <th>id</th>
                    <th>project name</th>
                    <th>project leader</th>
                    <th>project start date</th>
                    <th>action</th>
                </tr>
                @foreach($model as $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td>{{$project->project_name}}</td>
                        <td>{{$project->user->first_name}}</td>
                        <td>{{$project->start_date}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route("project.edit",[$project->id])}}">Update</a>
                            <form action="{{route("project.destroy",[$project->id])}}" method="post">
                                @csrf
                                @method("delete")
                                <a class="btn btn-danger" href="javascript:void(0)" onclick="$(this).closest('form').submit()">Delete</a>
                            </form>

                        </td>
                    </tr>
                 @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
