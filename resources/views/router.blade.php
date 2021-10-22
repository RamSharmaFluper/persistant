@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">
    
    <button type="button" style="margin-bottom: 6px;
      width: 113px;"  id = 'myModal' class="btn btn-primary" data-toggle="modal" onclick="showModal()">Add</button>

      <table class="table table-bordered">
        <thead >
          <tr>
            <th scope="col">IP</th>
            <th scope="col">SAPID</th>
            <th scope="col">HOSTNAME</th>
            <th scope="col">LOOPBACK</th>
            <th scope="col">MAC</th>
            <th scope="col">ACTION</th>

            
          </tr>
        </thead>
        <tbody id="added-router">
        @foreach ($routers as $key=>$router)
          <tr class='row_{{$router->id}}'>
            <td class='ip_{{$router->id}}'>{{$router->ip}}</td>      
            <td class='sapid_{{$router->id}}'>{{$router->sapid}}</td>
            <td class='hostname_{{$router->id}}'>{{$router->hostname}}</td>
            <td class='loopback_{{$router->id}}'>{{$router->loopback}}</td>
            <td class='mac_address_{{$router->id}}'>{{$router->mack_address}}</td>
            <td>
             
              <a href="javascript:void(0)" onclick="edit({{$router->id}})" id = "{{$router->id}}" class="btn btn-success">Edit</a>
              <a href="javascript:void(0)" onclick="doSomething({{$router->id}})" id = "{{$router->id}}" class="btn btn-danger">Delete</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

    </div>
  </div>
</div>
@endsection
@include('modal')
@include('edit')



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

function showModal(){
    $('#ModalLoginForm').modal('show');
}
function edit(id){
    $('#ModalEditForm').modal('show');
    $.ajax({
        type:'get',
        url:'/edit/'+id,
        success:function(data) {
            console.log(data);
            $('#id_field').val(id);
            $('#edit_ip').val(data.ip);
            $('#edit_sapid').val(data.sapid);
            $('#edit_host').val(data.hostname);
            $('#edit_loop').val(data.loopback);
            $('#edit_mac').val(data.mack_address);
        }
    });
}

function doSomething(id) {
    $.ajax({
        type:'DELETE',
        url:'/delete/'+id,
        
        success:function(data) {
            $(".row_"+id).hide();
        }
    });
}

$(document).ready(function(){

    $(".router-submite").click(function(event){
        event.preventDefault();
        var ip = $('#ip').val();
        var sapid = $('#sapid').val();
        var host = $('#host').val();
        var loop = $('#loop').val();
        var mac = $('#mac').val();
        $.ajax({
            type:'POST',
            url:'/create',
            data: {
                "ip": ip,
                "sapid": sapid,
                "host": host,
                "loop": loop,
                "mac": mac
            },
            success:function(data) {
                console.log(data.id);
                var $tableSearch = $('#added-router');
                $tableSearch.append('<tr  class = row_'+data.id+'><td>'+ data.ip +'</td><td>'+ data.sapid +'</td><td>'+ data.hostname +'</td><td>'+ data.loopback +'</td><td>'+ data.mack_address +'</td><td><a href="#"  id = '+data.id+' class="btn btn-success">Edit</a><a href="#"  id = '+data.id+' class="btn btn-danger">Delete</a></td></tr>');
                $('#ModalLoginForm').modal('hide');
            }
        });

    });


    $(".router-update").click(function(event){
        event.preventDefault();
        var id = $('#id_field').val();
        var ip = $('#edit_ip').val();
        var sapid = $('#edit_sapid').val();
        var host = $('#edit_host').val();
        var loop = $('#edit_loop').val();
        var mac = $('#edit_mac').val();
        $.ajax({
            type:'PUT',
            url:'/update/'+id,
            data: {
                "ip": ip,
                "sapid": sapid,
                "host": host,
                "loop": loop,
                "mac": mac
            },
            success:function(data) {
                console.log(data);
                var $tableSearch = $('#added-router');
                $('.ip_'+id).text(data.ip);
                $('.sapid_'+id).text(data.sapid);
                $('.hostname_'+id).text(data.hostname);
                $('.loopback_'+id).text(data.loopback);
                $('.mac_address_'+id).text(data.mack_address);        
                $('#ModalEditForm').modal('hide');
            }
        });

    });
});
</script>



