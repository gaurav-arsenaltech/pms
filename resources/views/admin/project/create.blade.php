@extends("layouts.app")

@section("content")

<div class="container">
    <form method="post" action="{{route("project.store")}}">
        @csrf
        <div class="row">

            <div class="col-md-6">
                <h2 class="text-center">Project Description</h2>
                <div class="form-group">
                    <label for="">Project Title</label>  <input class="form-control" type="text" name="project[title]" placeholder="Project Title">
                </div>
                <div class="form-group">
                    <label for="">Project Description</label> <textarea class="form-control" name="project[description]" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Project Start Date</label> <input type="date" class="form-control" name="project[start_date]">
                </div>
                <div class="form-group">
                    <label for="">Project Leader</label>


                    <select name="project[leader]" class="form-control" id="team_leader">
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->email}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="text-center">Project Member</h2>
                <div class="form-group float-right">
                    <a href="javascript:void(0)" onclick="addMember()" class="btn btn-primary text-right">Add Member</a>
                </div>
                <div id="member-list">
                    <table class="table" id="table-list">
                        <tr>
                            <th>Users</th>
                            <th>Assign As</th>
                        </tr>
                    </table>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <input type="submit" value="Save" name="submit" class="btn btn-lg btn-primary">

            </div>
        </div>
    </form>
</div>
@endsection

<?php
$arr_user=[];
foreach ($users as $user)
    {
        array_push($arr_user,['id'=>$user->id,'email'=>$user->email]);
    }

?>
<script type="text/javascript">
    var user = '<?php echo json_encode($arr_user); ?>';
    user = JSON.parse(user);
    var row=0;

    function addMember() {
         var html='';
          html+=`
            <tr id="row-${row}">
               <td>
                  <div class="form-group">
                     ${getUserDropDown(row)}

                  </div>

               </td>
               <td>
                  <div class="form-group">
                     <select class="form-control" name="member[${row}][as]">
                      <option value="">Select Option</option>
                      <option value="developer">Developer</option>
                      <option value="tester">Tester</option>
                    </select>
                  </div>
               </td>

            </tr>

          `;
          $("#table-list").append(html);
          row++;
    }
    function getUserDropDown(irow) {
        var option = getDropDwonOption();
        var html=`
         <select name="member[${irow}][user]" class="form-control">
          <option value="">Select Member</option>
          ${option}
         </select>
        `;
        return html;
    }
    function getDropDwonOption() {
        var option="";
        for (var i=0;i<user.length;i++)
        {
            option+=`<option value="${user[i].id}">${user[i].email}</option>`;
        }
        return option;
    }
</script>
