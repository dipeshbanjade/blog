 <div class="form-group">
 <div class="infoDiv"></div>
  <label for="formGroupExampleInput">Title</label>
  <input type="text" name="title" class="form-control title" placeholder="title name here">
</div>
<div class="form-group">
  <label for="formGroupExampleInput2">Description</label>
  <!-- <input type="textarea" name="desc" class="form-control"  placeholder="blog description" rows='7' cols='10'> -->
  {!! Form::textarea('desc',null, ['class'=>'form-control desc', 'placeholder'=>'write short blog here']) !!}
</div>

<div class="form-group">
      @if(isset($blog))
               <img src="{{ asset($blog->featured_image) }}" width="100" height="100">
       @endif
    <img src="" width="100" height="100" id="blogImage">
     <input name="featured_image" type='file' onchange="displayImage(this, 'blogImage');" title="select event featured image" />
</div>