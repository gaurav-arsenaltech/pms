@extends("layouts.app")
<?php $record=false; ?>
@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Task List</h1>

            <table class="table">

               @if($model!=null)

                   @foreach($model as $task)
                       <?php $record=true;?>
                    <tr>

                        <td width="50%">{{$task->title}}</td>
                        <td><a class="btn btn-info" href="{{route("task.show",[$task->project_id,$task->id])}}">Check Detail</a></td>
                    </tr>
                    @endforeach
              @endif

            </table>
            @if(!$record)
            <h2 class="text-center">Record Not Found.</h2>
            @endif
        </div>
    </div>
</div>
@endsection
