@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        @foreach($model as $project)
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$project->project_name}}</h5>
                    <p class="card-text">{{$project->description}}</p>
                    <a href="{{route('projectInfo',[$project->id])}}" class="btn btn-primary">Check Task</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
