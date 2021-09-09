@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{route('task.store',request("pid"))}}">
                @csrf
                <div class="form-group">
                    <label for="">Task Name</label> <input class="form-control" type="text" name="taskName" placeholder="Task Name">
                </div>
                <div class="form-group">
                    <label for="">Task Description</label> <textarea rows="10" name="taskDetail" class="form-control" placeholder="Task Description"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Assign To</label>
                    <select name="assignTo[]" id="" class="form-control" multiple>
                        @foreach($users as $user)
                            @if($user->id==$project->project_leader)
                                @php continue; @endphp
                             @endif
                            <option value="{{$user->id}}">{{$user->email}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Task Type</label>
                    <select name="taskType" class="form-control">
                        <option value="">Task Type</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>


                    </select>
                </div>
                {{--<div class="form-group">--}}
                    {{--<label for="">Task Status</label>--}}
                    {{--<select name="taskStatus" class="form-control">--}}
                        {{--<option value="">Task Status</option>--}}
                        {{--<option value="pending">Pending</option>--}}
                        {{--<option value="completed">Completed</option>--}}


                    {{--</select>--}}
                {{--</div>--}}
                <div class="form-group">
                    <input type="submit" value="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
