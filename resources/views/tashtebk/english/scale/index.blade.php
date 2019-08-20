@extends('tashtebk.english.layouts.master')

@section('content') 
<!--<div id="body">-->
<main>
    <section class="gray section">
        <div class="container">
            <div class="row scale_select text-center ">
                <div class="overlay-loader hidden">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <h2 class="title-p">Our BOQs</h2>
                @foreach($scales as $scale)
                    <div class="col-sm-6 col-md-3">
                        <div class="box-select text-center">
                            <a class="height-plus"  href="#" data-content="{{$scale->id}}">
                                <img src="{{asset('').$scale->image->link}}" width="150px" height="100px">
                                <h4 class="h-bold">{{ucfirst($scale->title)}}</h4>
                                <p>{{strip_tags($scale->description)}}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="project-container"></div>
</main>
@endsection
@section('custom-js')
    function initializeSelect2(){
        $('.select-project').select2({
            placeholder: "Assign Your Project",
            allowClear: true
        }); 
    }
    $( ".scale_select" ).on( "click", "a", function() {
        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var scale_id  = $( this ).data( "content" );
        
        $.ajax({
            url:"{{ route('en.scale.getSteps', [Auth::user()->username_tag]) }}",
            method:"POST",
            data:{_token: CSRF_TOKEN, scale_id:scale_id},
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success:function(data)
            {
                //console.log(data.project_modal);
                $(".overlay-loader").toggleClass('hidden');
                $('.project-container').html(data.project_modal);
                $('#project-modal').modal('show');
                $('#project-modal').css('display', 'block');
                $('#project-modal').addClass('in');
                initializeSelect2();
                $('.select2-container').css('width', '500px');
            
                //window.location.href = data.redirect;
            }
        });
    });
    $('.project-container').on('submit', '#assign_project', function(event){
        event.preventDefault();
        var serialized_form = $( this ).serialize();

        $.ajax({
            url:"{{ route('en.project.assign',['username_tag' => Auth::user()->username_tag]) }}",
            method:"POST",
            data:serialized_form,
            dataType:'JSON',
            beforeSend: function(){
                $(".overlay-loader").toggleClass('hidden');
            },
            success: function(data)
            {
                window.location.href = data.redirect;
                $(".overlay-loader").toggleClass('hidden');
            }
        });

    });
@endsection
