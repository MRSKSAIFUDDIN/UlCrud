<!doctype html>
<html lang="en">
    {{-- name, email, phone, address, education select2, qualification, profile_img --}}
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>DATE: 26/9/22</title>

    <!--  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>	    
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--  -->

    <!--  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <!--  -->
</head>
<body style="background:linear-gradient(to right, rgb(221, 168, 210) , rgb(11, 71, 99))">
    
<div class="row">
    <div class="col-4 mx-auto my-4 " >
        <div class="card mb-3 p-2" style="max-width: 540px; border-radius: 5px 50px; ">
            <div class="row g-0">
              <div class="col-md-4">
                {{-- <img src="../{{$data->image}}" alt="" height="140px" width="200px"> --}}
                <label for="" class="p-3 fw-bold">Previous Image:</label>
                <img src="../{{$data->image}}" class="img-fluid rounded-start p-2" alt="...">
                {{-- <label for="" class="p-3 fst-italic">{{$data->image}}</label> --}}
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  
                    {{-- form --}}
                    <form method="post" action="/formeditaction" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="eid" value="{{$data->id}}">
                        <input type="hidden" name="old_img" value="{{$data->image}}">                        
                        <div class="mb-2 form-group">
                            <label for="" class="form-label fw-bold">Name</label>
                            <input type="text" class="input-sm form-control" name="name" value="{{$data->name}}">
                            <span class="text-danger">@error('name'){{$message}} @enderror </span>   
                        </div>
                        <div class="mb-2 form-group">
                            <label for="" class="form-label fw-bold">Email address</label>
                            <input type="email" name="email" class="form-control" value="{{$data->email}}">
                            <span class="text-danger">@error('email'){{$message}} @enderror </span>   
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label  fw-bold">Phone</label>
                            <input type="number" name="phone" class="form-control" value="{{$data->phone}}">
                            <span class="text-danger">@error('phone'){{$message}} @enderror </span>   
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label fw-bold">Address</label>
                            <input type="text" name="address" class="form-control" value="{{$data->address}}">
                            <span class="text-danger">@error('address'){{$message}} @enderror </span>   
                        </div>
                        <div class="mb-2 form-group" id="myModal" >
                            <label class="form-label fw-bold">Education</label>
                            <select name="edu[]" id="mySelect2"  class="form-control" multiple="multiple"  >
                                <option>Select</option>
                                @foreach($eduall as $edualex)                                    
                                        <option value="{{ $edualex->id}}"@foreach($data2 as $eduone) @if($eduone->id==$edualex->id) selected @endif @endforeach> {{$edualex->title}} </option>                                    
                                @endforeach
                            </select>   
                            <span class="text-danger">@error('edu_id'){{$message}} @enderror </span>                         
                        </div>                                 
                        <script>
                            $(document).ready(function() {
                            //  $('.js-example-basic-multiple').select2();
                            }   );
                        </script>  
                        <script>
                            $('#mySelect2').select2({
                                dropdownParent: $('#myModal')
                            });
                        </script>        
                                            
                        <div class="my-2 form-group">
                            <label class="form-label fw-bold">Add Image</label>
                            <input type="file" name="imgx">
                            
                            
                        </div>
                        <div class="mb-2 modal-footer">
                            <button type="submit" class="btn  btn-primary">Submit</button>                            
                            <a href="/" class="btn btn-secondary" data-bs-dismiss="modal">Back</a>
                        </div>
                    </form>

                </div>
              </div>
            </div>
          </div>
    </div>
</div>

 







<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"   integrity = "sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"     crossorigin = "anonymous"></script>

</body>
</html>