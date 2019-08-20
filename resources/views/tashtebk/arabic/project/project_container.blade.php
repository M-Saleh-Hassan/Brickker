<div class="col-md-3">
    
    <div class="modal fade" id="ProjectModal{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog extend-modal-width" role="document">
		  <div class="modal-content" >
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="myModalLabel">{{$project->title}}</h4>
			</div>
			<div class="modal-body">
				<form class="project-edit-form" method="POST" action="{{ route('ar.project.update', ['username_tag' => Auth::user()->username_tag, 'project_id' => $project->id]) }}" enctype="multipart/form-data">
					@csrf
					<div class="form-group col-md-12">
                        <label  class="col-sm-2 control-label">العنوان</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="project_title" placeholder="عنوان المشروع" value="{{(empty(Request::old('project_title'))) ? $project->title : Request::old('project_title')}}">
                        </div>
                    </div>
                    
					<div class="form-group col-md-12">
                        <label  class="col-sm-2 control-label">الارضيات</label>
                        
                        <div class="col-sm-10">
                            <select class="floors_select form-control col-md-12" name="floors[]" multiple="multiple" required>
                                @foreach ($project->floors as $floor)
                                <option value="{{$floor->id}}"selected>{{$floor->title}}</option>                                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
					<div class="form-group col-md-12">
                        <label  class="col-sm-2 control-label">الشقق</label>
                        
                        <div class="col-sm-10">
                            <select class="flats_select form-control col-md-12" name="flats[]" multiple="multiple" required>
                                @foreach ($project->flats as $flat)
                                <option value="{{$flat->id}}"selected>{{$flat->title}}</option>                                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
					<div class="form-group col-md-12">
                        <label  class="col-sm-2 control-label">الغرف</label>
                        
                        <div class="col-sm-10">
                            <select class="rooms_select form-control col-md-12" name="rooms[]" multiple="multiple" required>
                                @foreach ($project->rooms as $room)
                                <option value="{{$room->id}}"selected>{{$room->title}}</option>                                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3 center-button">
                            <div class="form-group">
                                <button type="submit" class="btn btn-home">حفظ</button>
                            </div>
                        </div>
                    </div>
                    
				</form>
			</div>
		  </div>
		</div>
    </div>
    <div class="p-item relate-item project">
        <div class="overlay-product">
            <div class="elements">
                <a class="delete-project danger" title="Delete"  data-project="{{$project->id}}"><i class="fa fa-close"></i></a>
                <a type="button" data-toggle="modal" data-target="#ProjectModal{{$project->id}}" class="primary"  title="Edit"><i class="fa fa-edit"></i></a>
                <!--<a href="{{route('ar.product.index', ['title_tag'=>$project->title])}}" class="success" title="view BOQ" target="_blank"><i class="fa fa-eye"></i></a>-->
            </div>
            
        </div>
        <div class="img-item">
                <img src="{{asset('')}}/tashtebk/images/icons/project-management.png" alt="" style="height:110px;">
        </div>
        
        <div class="p-info">
            <h4 class="edit-form-title">{{$project->title}} </h4>
        </div>
    </div>
</div>                                                                    
