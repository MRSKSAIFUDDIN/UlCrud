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

<body style=" font-family: 'Julius Sans One', sans-serif; background:linear-gradient(to right,#e4bcf39f,#c4fdd585); background-size: 100vw 100vh;  background-repeat: no-repeat;  background-attachment: fixed; ">
    {{-- SESSION MESSAGES --}}

    @if (Session::has('message'))
      <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong> {{ Session::get('message') }}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if($errors->any())
        <div class="alert alert-warning alert-dismissible fade show"  role="alert">
            <nav class="navbar navbar-expand-sm sticky-top">
            @foreach($errors->all() as $err)
            <ul class="navbar-nav">
                <li class="nav-item p-1"> <i class="fa-solid fa-oil-well"> </i> {{$err}} </li>
            </ul>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
            </nav> 
        </div>
    @endif 

{{-- name, email, phone, address, education select2, qualification, profile_img --}}
<div class="row">
    <div class="col-md-8 mx-auto mt-2 mb-5 ">

        <div class="p-3 nav justify-content-end ">
            <button type="button " class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#recordsModal">
                ADD RECORDS
            </button>  
            <button type="button " class="btn btn-outline-primary mx-3  " data-bs-toggle="modal" data-bs-target="#eduModal">
                ADD EDUCATION
            </button>            
        </div>
        {{-- ADD --}}
        <!-- Button trigger modal -->
        {{-- @if($errors->any())
        @foreach($errors->all() as $err)
            <li>{{$err}}</li>
        @endforeach
        @endif --}}
        <!-- Modal -->
        <div class="modal fade" id="recordsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD RECORDS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   
                    {{-- form --}}
                    <form method="post" action="/forminsertaction" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2 form-group">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="input-sm form-control" name="name">
                            <span class="text-danger">@error('name'){{$message}} @enderror </span>
                        </div>
                        <div class="mb-2 form-group">
                            <label for="" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control">
                            <span class="text-danger">@error('email'){{$message}} @enderror </span>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">Phone</label>
                            <input type="number" name="phone" class="form-control">
                            <span class="text-danger">@error('phone'){{$message}} @enderror </span>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control">
                            <span class="text-danger">@error('address'){{$message}} @enderror </span>
                        </div>
                        <div class="mb-2 form-group" id="myModal" >
                            <label class="form-label">Education</label>
                            <select name="edu[]" id="mySelect2"  class="form-control" multiple="multiple"  style="width:34vw !important;">
                                <option>Select</option>
                                @foreach($data as $i)
                                 <option value="{{$i->id}}">{{$i->title}}</option>
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
                            <label class="form-label">Add Image</label>
                            <input type="file" name="imgx">
                            <span class="text-danger">@error('imgx'){{$message}} @enderror </span>   
                        </div>
                        <div class="mb-2 modal-footer">
                            <button type="submit" class="btn  btn-primary">Submit</button>
                            <button type="reset" class="btn  btn-primary">Reset</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>
                {{-- <div class="modal-footer">
                                  
                </div> --}}
            </div>
            </div>
        </div>
        {{-- edu model  --}}
        <!-- Modal -->
        <div class="modal fade" id="eduModal" tabindex="-1" aria-labelledby="eduModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD EDUCATIONS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <form action="/eduadding" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="title" id="title" class="form-control" placeholder="Add education here">
                            <button type="submit" class="input-group-text btn btn-info" >Add </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                
                </div>
            </div>
            </div>
        </div>
        {{-- DATA TABLES --}}
        <table class="table align-middle table-hover table-sm" id="table_id">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Education</th>                    
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $c=0; ?>
                @foreach($benall as $i)
                <tr>                  
                    <td scope="col"><?php echo ++$c; ?></td>
                    <td scope="col">{{ $i['name']}}</td>
                    <td scope="col">{{$i['email']}}</td>
                    <td scope="col">{{$i['phone']}}</td>
                    <td scope="col">{{$i['address']}}</td>
                    <td scope="col">{{$i['education']}}</td>
                    <td scope="col"> <img src="{{$i['image']}}" height="35vh" alt=""> </td> 
                    <td scope="col">
                        <a href="{{route('editz',['id'=>$i['id']])}} " class="btn btn-outline-warning"><i class="fa-solid fa-user-pen"></i></a> 
                        <a href="/delete/{{$i['id']}}" class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></a> 
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>                   
        <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
        </script>

    </div>    
</div>
   
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"   integrity = "sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"     crossorigin = "anonymous"></script>
  
</body>
</html>