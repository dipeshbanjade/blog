 <div class="form-group">
  <label for="formGroupExampleInput">Title</label>
  <input type="text" name="title" class="form-control title" placeholder="title name here">
</div>
<div class="form-group">
  <label for="formGroupExampleInput2">Description</label>
  <!-- <input type="textarea" name="desc" class="form-control"  placeholder="blog description" rows='7' cols='10'> -->
  {!! Form::textarea('desc',null, ['class'=>'form-control desc', 'placeholder'=>'write short blog here']) !!}
</div>

<div class="form-group">
    <input type="file" name="featured_image">
</div>