@extends("layouts.app")

@section("content")
 <div class="container">
     <div class="row">
         <div class="col-md-12">
             <h1 class="text-center">Task Details</h1>
             <table class="table">
                 <tr>
                     <th width="40%">
                         Task Name:
                     </th>
                     <td>
                         {{$task->title}}
                     </td>
                 </tr>
                 <tr>
                     <th width="40%">
                         Task Detail:
                     </th>
                     <td>
                         {{$task->description}}
                     </td>
                 </tr>
                 <tr>
                     <th width="40%">
                         Project:
                     </th>
                     <td>
                         {{$task->project->project_name}}
                     </td>
                 </tr>
                 <tr>
                     <th width="40%">
                         Task Created By:
                     </th>
                     <td>
                         {{$task->user->email}}
                     </td>
                 </tr>
                 <tr>
                     <th width="40%">
                         Task Assigned To:
                     </th>
                     <td>
                         <?php
                           $assignedUser= $task->arrayUser();
                           if($assignedUser)
                           {
                             foreach ($assignedUser as $user)
                             {
                                 echo $user->email."&nbsp ,";
                             }
                           }
                         ?>
                     </td>
                 </tr>
                 <tr>
                     <th width="40%">
                         Task Type:
                     </th>
                     <td>
                         {{$task->type}}
                     </td>
                 </tr>
                 <tr>
                     <th width="40%">
                         Task Status:
                     </th>
                     <td>
                         <?php
                           if($task->status==1)
                           {
                               echo "new";
                           }
                         if($task->status==2)
                         {
                             echo "pending";
                         }
                         if($task->status==3)
                         {
                             echo "complete";
                         }
                         ?>
                     </td>
                 </tr>

             </table>
         </div>
     </div>
     <div class="row">
         <div class="col-md-12">
             <h1 class="">Comments:</h1>
              <div id="">

                  <form id="comment-form" enctype="multipart/form-data" method="post" action="{{route("comment.store",[request('pid'),request('task')])}}">
                      @csrf

                      <div class="form-group">
                          <textarea name="comment" class="form-control" rows="5" placeholder="Enter Your New Comment"></textarea>
                          <input type="hidden" id="comment_id" name="comment_id" value="0">
                          <input type="hidden" id="form-method" name="_method" value="post">

                      </div>
                      <div class="form-group">
                          <label>Attach File: </label><input type="file" name="myfile">
                      </div>
                      <div class="form-group">
                          <input type="submit" value="Submit" class="btn btn-primary">
                      </div>
                  </form>
              </div>
         </div>

     </div>
     <div class="row">
         <div class="col-md-12">
             <h1>List Of Comments</h1>
         </div>
         @foreach($task->comments as $comment)
         <div class="col-md-12 m-2">
             <div class="card">
                 <div class="card-header">
                     <div class="float-left">
                         User: {{$comment->user->first_name}}
                     </div>
                     <div class="float-right">
                         <a class="btn btn-primary" href="javascript:void(0)" onclick="updateComment({{$comment->id}},'{{route("comment.update",[request('pid'),request('task'),$comment->id])}}')">Edit</a> &nbsp;
                         <form action="{{route("comment.destroy",[request('pid'),request("task"),$comment->id])}}" method="post">
                             @method("delete")
                             @csrf
                             <a class="btn btn-danger" href="javascript:void(0)" onclick="$(this).closest('form').submit()">Delete</a>
                         </form>

                     </div>
                 </div>
                 <div class="card-body">

                     <p id="comment_data-{{$comment->id}}" class="card-text">{{$comment->comment_data}}</p>
                     @if($comment->link_type!= "")
                         @if($comment->link_type=="image")
                          <img src="{{\Illuminate\Support\Facades\Storage::url($comment->file)}}" alt="">
                         @endif
                         @if($comment->link_type=="file")
                             <a href="{{\Illuminate\Support\Facades\Storage::url($comment->file)}}">Download File</a>
                         @endif
                     @endif
                 </div>
             </div>
         </div>
         @endforeach
     </div>
 </div>
@endsection
<script>
    var commentUrl= "{{route("comment.store",[request('pid'),request('task')])}}";

    function updateComment(id,url) {
       $("#comment-form").attr("action",url);
       $("#comment_id").val(id);
       $("#form-method").val("put");
       $("#comment-form textarea[name=comment]").val($(`#comment_data-${id}`).html());
        $('html, body').animate({
            scrollTop: $("#comment-form").offset().top-80
        }, 1000);
        $("textarea[name=comment]").focus();

    }

</script>
