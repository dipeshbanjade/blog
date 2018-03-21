<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title')</title>
    <meta name="description" content="@yield('page_description')">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Blog') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                        @if(Auth::user())
                                    <li>
                                          <a href="/userBlog">Home</a>
                                    </li>
                                        @endif
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
          <div class="container">
                  
                    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          </div>
        </div>
        @yield('content')
    </div>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
     <script type="text/javascript">
        $('.btnAddBlog').on('click', function(){
            $('.frmBlog').toggle();
        });
    </script>

    <script type="text/javascript">
         $(".deleteMe").click(function(e) {
                    var url = $(this).data('url');
                    var name = $(this).data('name');
                  var infoDiv   = $('.infoDiv');
                    if (confirm("Are you sure your want to  delete  " + name +'?')) {
                            $.ajax({
                                  'type' : "GET",
                                  'url'  : url,
                                  success:function(response){
                                    console.log(response.message);
                                    if (response.success == true) {
                                       infoDiv.addClass('alert alert-success').append(response.message).fadeOut(5000);
                                    }else{
                                      infoDiv.addClass('alert alert-danger').append(response.message).fadeOut(5000);
                                    }
                                   window.location.reload();
                                  }
                            });
                        }
                        return false;
                    e.preventDefault();
                });
    </script>

    <script type="text/javascript">
        function displayImage(input, divId){
            var divId = divId;
             if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+divId)
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
          }
    </script>

<script type="text/javascript">
      var btnUpdateBlog = $('.btnUpdateBlog');
         var title     = $('.title');
         var desc     = $('.desc');
         var featured_image    = $('.featured_image');
         var imgDiv         = $('.imgDiv');
             btnUpdateBlog.on('click', function() {
                 var url = $(this).data('url');
                 alert(url);
                 $.ajax({
                     'type': 'GET',
                     'url': url,
                     success: function (response) {
                      console.log(response);
                          var img_src = "http://mystore.dev/"+response.featured_image;
                         $('.blog_id').val(response.id),
                         title.val(response.title);
                         desc.val(response.desc);
                         featured_image.attr('src', img_src);
                         $("#myModal").modal('show');
                     }
                 })
             });


             /*update form*/
         var frmBlogUpdate = $('#frmBlogUpdate');
                 frmBlogUpdate.on('submit', function(e){
                 e.preventDefault();
                 var data = $(this).serialize();
                 var id   = $('.blog_id').val();
                 var url  = "{{URL::to('/')}}" + "/userBlog/"+id+"/update";
                  alert(url);
                 $.ajax({
                   'type' : 'POST',
                   'url'  : url,
                   data    : data,
                   success : function(response){
                    console.log(response);
                    if (response.success==true) {
                        $('.infoDiv').append('successfully updated').addClass('alert alert-success').fadeOut(10000);
                    }
                   },complete:function(){
                     window.location.reload();
                   }
                 })
                 .fail(function (response) {
                     alert('error while insert');
                 });
                 $('#frmBlogUpdate').modal('hide');
                 });
</script>

</body>
</html>
