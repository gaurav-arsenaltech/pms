<?php
$task_type=['high'=>"High",'medium'=>"Medium",'low'=>"Low"];
$status_type=['1'=>"New","2"=>"Pending","3"=>"Complete"];
?>
@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{route('task.update',[request("pid"),request('task')])}}">
                    @csrf
                    @method("put")
                    <div class="form-group">
                        <label for="">Task Name</label> <input class="form-control" value="{{$task->title}}" type="text" name="taskName" placeholder="Task Name">
                    </div>
                    <div class="form-group">
                        <label for="">Task Description</label> <textarea rows="10" name="taskDetail" class="form-control" placeholder="Task Description">{{$task->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Assign To</label>
                        <select name="assignTo[]" id="" class="form-control" multiple>
                            @foreach($users as $user)
                                @if($user->id==$project->project_leader)
                                    @php continue; @endphp
                                @endif
                                @if(in_array($user->id,json_decode($task->assign_to)))
                                        <option selected="selected" value="{{$user->id}}">{{$user->email}}</option>
                                @else
                                        <option value="{{$user->id}}">{{$user->email}}</option>
                                @endif

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Task Type</label>
                        <select name="taskType" class="form-control">
                            <option value="">Task Type</option>
                            @foreach($task_type as $key=> $type)
                              @if($task->type==$key)
                              <option selected="selected" value="{{$key}}">{{$type}}</option>
                              @else
                                    <option value="{{$key}}">{{$type}}</option>
                              @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Task Status</label>
                        <select name="taskStatus" class="form-control">
                            <option value="">Task Status</option>
                            @foreach($status_type as $key=> $status)
                                @if($key == $task->status)
                                <option selected="selected" value="{{$key}}">{{$status}}</option>
                                @else
                                    <option value="{{$key}}">{{$status}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
