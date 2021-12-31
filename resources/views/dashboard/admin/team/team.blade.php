@extends('layouts.admin.app')
  @section('details')
 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>team Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">team Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Horizontal Form -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">team Add</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal"method="post" action="{{ route('store.team') }}"enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" name="name" placeholder="name">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">position</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputEmail3" name="position" placeholder="position">
                </div>
              </div>
              <div class="form-group row pull-right" style="margin-right:20px;">
                <div class="col-sm-10"style="margin-left:35px;">
                    <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                    <img style="height: 200px; width:200px;" src="#" id="image" alt="image" />
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                  <input type="file" id="file"  name="image" onchange="readURLOne(this);"  accept="image"></input>
                </div>
              </div>

              

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-info">save </button>
              <button type="submit" class="btn btn-default float-right">Cancel</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>

    </section>
    <!-- /.content -->
    <script type="text/javascript">
        function readURLOne(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(155);
                };
                reader.readAsDataURL(input.files[0]);
            }
         }
      </script>
  @endsection