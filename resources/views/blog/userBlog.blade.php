@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                     <p class="pull-right">
                         <button class="btn btn-primary btnAddBlog">Add Blog</button>
                     </p>
                     @if(Session::has('message'))
                         <div class="row">
                             <div class="alert alert-info">
                                 {{ Session::get('message') }}
                             </div>
                         </div>
                     @endif
                     
                     <div class="row frmBlog" style="display: none; padding: 2em;">
                         {!! Form::open(['route'=>'saveBlog', 'method'=>'post', 'files'=>true]) !!}
                            

                           @include('blog._form')

                           <input type="submit" class="btn btn-primary" value="create blog">
                     {!! Form::close() !!}
                     </div>
                     @if(count($userBlog) > 0)
                        <table class="table table-striped">
                         <caption>List of blog</caption>
                         <tr>
                             <thead>
                                 <tr>
                                     <th>Sn</th>
                                     <th>Image</th>
                                     <th>Title</th>
                                     <th>Description</th>
                                     <th>Action</th>
                                 </tr>

                             </thead>
                             <tbody>
                                 <?php  $count = 1;  ?>
                                 @foreach($userBlog as $blog)
                                 <tr>
                                     <td>{{ $count ++ }} </td>
                                     <td><img src="{{ asset($blog->featured_image) }}" width="50" height="50"></td>
                                     <td>{{ $blog->title }}</td>
                                     <td>{{ $blog->desc }}</td>
                                     <td>

                                     <a href="#"  title="Edit">
                                          <i class="fa fa-fw fa-lg fa-pencil-square-o btnUpdateBlog" data-toggle="modal" data-target="#myModal" data-id="{{ $blog->id }}" data-url="{!! route('editBlog', $blog->id) !!}">Edit</i>
                                      </a>
                                        
                                         <span>
                                          <a href="" class="txt-color-red deleteMe" 
                                            data-url="{!! route('blogDelete', $blog->id ) !!}" title="Delete this blog" data-name="{{ $blog->name }}" data-id = "{{ $blog->id }}">
                                            <i class="fa fa-fw fa-lg fa-trash-o deletable"> Delete</i> </a>
                                        </span>
                                     </td>

                                 </tr>
                                 @endforeach
                             </tbody>
                         </tr>
                    </table>
                     @endif
                </div>

                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       {!! Form::open(['id'=>'frmBlogUpdate', 'files'=>true]) !!}
                           {{ Form::hidden('blogId',null, ['class'=>'blog_id']) }}
                           @include('blog._form')
                           <img src="" class="featured_image" width="50" height="50">
                           {{ Form::submit('Update Blog', ['class'=>'btn btn-success updateBlog']) }}
                      {!! Form::close() !!}
                      </div>
                      
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection