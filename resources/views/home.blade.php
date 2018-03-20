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
                    
                         <form action="#" method="post" enctype="multipart/form-data">
                           <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                           <div class="form-group">
                             <label for="formGroupExampleInput">Title</label>
                             <input type="text" name="title" class="form-control" placeholder="title name here">
                           </div>
                           <div class="form-group">
                             <label for="formGroupExampleInput2">Description</label>
                             <input type="textarea" name="desc" class="form-control"  placeholder="blog description" rows='7'>
                           </div>

                           <div class="form-group">
                               <input type="file" name="featured_image">
                           </div>

                           <input type="submit" class="btn btn-primary" value="create blog">
                         </form>
                     </div>
                    <table class="table table-striped">
                    
                         <caption>List of blog</caption>
                         <tr>
                             <thead>
                                 <tr>
                                     <th>Sn</th>
                                     <th>Title</th>
                                     <th>Description</th>
                                     <th>Action</th>
                                 </tr>

                             </thead>
                             <tbody>
                                 <tr>
                                     <td>1. </td>
                                     <td>First blog goes here</td>
                                     <td>List of all bloges goes here</td>
                                     <td></td>
                                 </tr>
                             </tbody>
                         </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
