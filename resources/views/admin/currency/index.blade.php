@extends('admin.layouts.master')

@section('content')   
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            currency
            </h1>
            <ol class="breadcrumb">
            <li><a href="{{route('admin.home.index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">currency</li>
            </ol>
        </section>
    
        <!-- Main content -->
        <section class="content container-fluid">
    
            <!------------------------
            | Your Page Content Here |
            -------------------------->                      
            <div class="col-md-12">
                <div class="box box-warning box-solid collapsed-box">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Add new currency</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form method="post" id="add_currency_form" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Title EN</label>
                                        <input type="text" class="form-control" placeholder="currency Title EN" name="title_en">
                                    </div>
                                    <div class="form-group">
                                        <label>Title AR</label>
                                        <input type="text" class="form-control" placeholder="currency Title AR" name="title_ar">
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>        
                        </div>
                    </div>
                </div>

                <!-- All currencies -->
                <div class="box box-warning box-solid">
                    <div class="overlay hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">All currencies</h3>
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
                                        <th>title en</th>
                                        <th>active</th>
                                        <th>edit</th>
                                        <th>delete</th>
                                    </tr>
                                </thead>
                                <tbody class="categories_body">
                                    @foreach ($currencies as $currency)
                                        <tr id="row{{$currency->id}}">
                                            <td>{{$counter}}</td>
                                            <td>{{$currency->title_en}}</td>
                                            <td id="active{{$currency->id}}" class="active-curency">
                                                @if($currency->active)
                                                    <button type="button" class="btn btn-success make-not-active" data-content="{{$currency->id}}">
                                                        <i class="fa fa-check"></i>
                                                        <span>YES</span>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-danger make-active" data-content="{{$currency->id}}">
                                                        <i class="fa fa-times"></i>
                                                        <span>NO</span>
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <a  href="{{route('admin.currencies.edit', [$currency->id])}}" class="btn btn-primary" data-content="{{$currency->id}}">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete" data-content="{{$currency->id}}">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span>Delete</span>
                                                </button>
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
        $('#add_currency_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"{{ route('admin.currencies.add') }}",
                method:"POST",
                data:$("#add_currency_form").serialize(),
                dataType:'JSON',
                beforeSend: function(){
                    $(".overlay").toggleClass('hidden');
                },
                success:function(data)
                {
                    if(data.errors == '')
                    {
                        alert(data.message);
                        
                        var rowNode = t.row.add( [
                            data.currency_count,
                            data.currency_title,
                            '<button type="button" class="btn btn-danger make-active" data-content="' + data.currency_id + '"><i class="fa fa-times"></i><span> NO</span></button>',
                            '<a  href="' + data.currency_link_edit +'" class="btn btn-primary" data-content="data.currency_id"><i class="glyphicon glyphicon-edit"></i><span> edit</span></a>',
                            '<button type="button" class="btn btn-danger delete" data-content="' + data.currency_id + '"><i class="glyphicon glyphicon-trash"></i><span> Delete</span></button>'
                        ] ).draw().node();
                        
                        $( rowNode )
                            .css( 'color', 'red' )
                            .attr('id', 'row' + data.currency_id );
                    }
                    else{
                        var errors_message = '';
                        $.each(data.errors, function( index, value ) {
                            errors_message += value + '  ......  ';
                        });
                            alert( errors_message );
                    }
                    $(".overlay").toggleClass('hidden');
                }
            })
        });
    });
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('#example').on('click', '.delete', function(){
        // $(".delete").click(function(){ // not working at page 2 see reason at https://www.gyrocode.com/articles/jquery-datatables-why-click-event-handler-does-not-work/
            if(confirm('Are you sure you want to Delete ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.currencies.delete")}}',
                    method: 'POST',
                    data: {_token: CSRF_TOKEN, id: content},
                    dataType: 'JSON',
                    beforeSend: function(){
                        $(".overlay").toggleClass('hidden');
                    },
                    success: function (data) { 
                        var id= data.id;
                        $( '#row' + id ).html('');
                        $(".overlay").toggleClass('hidden');
                    }
                }); 
            }
        });

        $('#example').on('click', '.make-active', function(){
            if(confirm('Are you sure you want to Make it active ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.currencies.active")}}',
                    method: 'POST',
                    data: {_token: CSRF_TOKEN, id: content},
                    dataType: 'JSON',
                    beforeSend: function(){
                        $(".overlay").toggleClass('hidden');
                    },
                    success: function (data) { 
                        /* Make all button have No state*/
                        var divs = $( ' .active-curency ' );
                        divs.each(function( index, value ) {
                            $(this).html('<button type="button" class="btn btn-danger make-active" data-content="' + this.id.substr(6, 1) + '"><i class="fa fa-times"></i><span> No</span></button>');
                        });

                        var id= data.id;
                        $( '#active' + id ).html('');
                        $( '#active' + id ).html('<button type="button" class="btn btn-success make-not-active" data-content="' + id + '"><i class="fa fa-check"></i><span> Yes</span></button>');
                        $(".overlay").toggleClass('hidden');
                    }
                }); 
            }
        });
        
        $('#example').on('click', '.make-not-active', function(){
            if(confirm('Are you sure you want to Make it not active ?'))
            {
                var content = $( this ).data( "content" );
                $.ajax({
                    url: '{{route("admin.currencies.deactive")}}',
                    method: 'POST',
                    data: {_token: CSRF_TOKEN, id: content},
                    dataType: 'JSON',
                    beforeSend: function(){
                        $(".overlay").toggleClass('hidden');
                    },
                    success: function (data) {
                        var id= data.id;
                        $( '#active' + id ).html('');
                        $( '#active' + id ).html('<button type="button" class="btn btn-danger make-active" data-content="' + id + '"><i class="fa fa-times"></i><span> No</span></button>');
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
