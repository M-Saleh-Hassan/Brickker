@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Quantities
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Quantities</li>
            </ol>
        </section>
    
        <!-- Main content -->
        <section class="content container-fluid">
    
            <!------------------------
            | Your Page Content Here |
            -------------------------->                      
            <div class="col-md-12">
                {{--<div class="box box-warning box-solid collapsed-box">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Add new Unit</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="add_unit_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" placeholder="Unit Title" name="title">
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>        
                        </div>
                    </div>
                </div>--}}

                <!-- All quantities -->
                <div class="box box-warning box-solid">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">All quantities</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Main Product</th>
                                        <th>Consultant</th>
                                        <th>Show</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="categories_body">
                                    @foreach ($quantities as $quantity)
                                        <tr id="row{{$quantity->id}}">
                                            <td>{{$counter}}</td>
                                            <td>
                                                <a  href="{{ route('en.product.index', ['title_tag'=>$quantity->product->title_tag])}}" target="_blank">
                                                    <span>{{$quantity->product->title}}</span>
                                                </a>
                                            </td>
                                            <td>
                                                <a  href="{{ route('en.profile.show', ['title_tag'=>$quantity->consultant->username_tag])}}" target="_blank">
                                                    <span>{{$quantity->consultant->username}}</span>
                                                </a>
                                            </td>
                                            <td>
                                                <a  href="{{ route('en.product.index', ['title_tag'=>$quantity->product->title_tag])}}" class="btn btn-primary">
                                                    <i class="fa fa-eye"></i>
                                                    <span>Show</span>
                                                </a>
                                            </td>
                                            <td id="status{{$quantity->id}}">
                                                @if($quantity->accepted)
                                                    <button type="button" class="btn btn-success make-not-approved" data-content="{{$quantity->id}}">
                                                        <i class="fa fa-check"></i>
                                                        <span> Approved</span>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-danger make-approved" data-content="{{$quantity->id}}">
                                                        <i class="fa fa-times"></i>
                                                        <span> Not Approved</span>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>   
                                        @php $counter++; @endphp                             
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    
@endsection
@section('js')
<script>
    $(document).ready(function(){
        var t = $('#example').DataTable({
            "order": [[ 0, "desc" ]]
        }); 

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        
    });
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#example').on('click', '.make-approved', function(){
            if(confirm('Are you sure you want to Make it approved ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.quantities.approve")}}',
                    method: 'POST',
                    data: {_token: CSRF_TOKEN, id: content},
                    dataType: 'JSON',
                    beforeSend: function(){
                        $(".overlay").toggleClass('hidden');
                    },
                    success: function (data) { 
                        var id= data.id;
                        $( '#status' + id ).html('');
                        $( '#status' + id ).html('<button type="button" class="btn btn-success make-not-approved" data-content="' + id + '"><i class="fa fa-check"></i><span> Approved</span></button>');
                        $(".overlay").toggleClass('hidden');
                    }
                }); 
            }
        });
        
        $('#example').on('click', '.make-not-approved', function(){
            if(confirm('Are you sure you want to Make it not approved ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.quantities.disapprove")}}',
                    method: 'POST',
                    data: {_token: CSRF_TOKEN, id: content},
                    dataType: 'JSON',
                    beforeSend: function(){
                        $(".overlay").toggleClass('hidden');
                    },
                    success: function (data) { 
                        var id= data.id;
                        $( '#status' + id ).html('');
                        $( '#status' + id ).html('<button type="button" class="btn btn-danger make-approved" data-content="' + id + '"><i class="fa fa-times"></i><span> Not Approved</span></button>');
                        $(".overlay").toggleClass('hidden');
                    }
                }); 
            }
        });
    });   

</script> 
<style>
li.custom-image
{
    width:18.5%;
}
img.custom-image
{
    height: 200px
}
span.select2
{
    width: 100% !important;
}
</style>
@endsection
