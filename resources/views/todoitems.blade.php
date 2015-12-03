@extends('layouts.app')

@section('script')
<link rel="stylesheet" href="jquery-ui.css">
  <script src="jquery-1.10.2.js"></script>
  <script src="jquery-ui.js"></script>
  <script>
    $(function() 
      {
        $("#tabs").tabs();
      });
  </script>
  @endsection

@section('content')

  <div class="panel-body">
     
    <div id="tabs">
      <ul>
        <li><a href="#tabs-1" style="color:#000000">To-Do</a></li>
        <li><a href="#tabs-2" style="color:#000000">New Item</a></li>
     </ul>
  <!--Show the List-->
  <div id="tabs-1" >
    @if (count($todoitems) > 0)
          <div class="panel panel-default">
              <div class="panel-heading">
                 Todo Items
              </div>
              <br>
    @foreach ($todoitems as $todoitem)
          <div class="panel panel-default">
              <div class="panel-heading" >
                  <b>{{ $todoitem->title }}</b>
               <div style="float:right">
                  <form action="/todoitems/{{ $todoitem->id }}" method="POST">
                     {{ csrf_field() }}
                     {{ method_field('DELETE') }}
                    <input type="button" class="btn btn-default" class="fa fa-plus" id="Edit_{{ $todoitem->id }}" name="Edit_{{ $todoitem->id }}" value="Edit" onclick="show({{ $todoitem->id }})" />
                    <button type="submit" class="btn btn-danger">
                      <i class="fa fa-trash"></i>Delete
                    </button>     
                  </form>
              </div>
              </div>
             
             <div class="panel-body">  
               <div class="form-group">
                  {{ $todoitem->description }}
               </div>
             </div>
          </div>
          <!--Edit/Update-->
         <div id="myDIV{{$todoitem->id}}" style="display:none;margin:300px">
            <form action="/todoitems/{{ $todoitem->id }}" method="POST" class="form-horizontal">
              {{ csrf_field() }}                           
                <div class="form-group">
                  <label for="title" class="col-sm-3 control-label" >Title</label>
                      <div class="col-sm-6">                       
                          <input type="text" name="title" id="title-name" class="form-control" value="{{ $todoitem->title }}" />  
                      </div>
                 </div>
                                                 
                 <div class="form-group">
                   <label for="description" class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-6">
                     <input type="textArea" style="width:500px;height:60px" name="description" id="description-name" class="form-control" value="{{ $todoitem->description }}" />
                  </div>
                </div>
                                                    
                <div class="form-group">
                   <div class="col-sm-offset-3 col-sm-6">
                      <button type="submit" class="btn btn-default"  >
                       <i ></i>Update
                      </button>
                   </div>
                 </div>
           </form>
          </div>   
     @endforeach
  </div> 
  @endif
 </div>
<!--Add a new entry-->
  <div id="tabs-2" >
      <div class="panel panel-default">
            <div class="panel-heading">
              New Item
        </div>
      <div class="panel-body">
          @include('common.errors')
            <form action="/todoitems" method="POST" class="form-horizontal" >
              {{ csrf_field() }}
              <div class="form-group">
                <label for="title" class="col-sm-3 control-label">Title</label>
                  <div class="col-sm-6">
                <input type="text" name="title" id="title-name" class="form-control" value="">
              </div>
            </div>
            <div class="form-group">
               <label for="description" class="col-sm-3 control-label">Description</label>
              <div class="col-sm-6">
                <textarea style="width:500px;height:60px" name="description" id="description-name" class="form-control" value="" ></textarea>
              </div>
            </div>
            <input type="hidden" name="tabName" value="tabs-2" /> 
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                  <i class="fa fa-plus"></i>Add New Entry
                </button>
              </div>
            </div>
          </form>
      </div>
      </div>
  </div>
</div>
</div>
@endsection