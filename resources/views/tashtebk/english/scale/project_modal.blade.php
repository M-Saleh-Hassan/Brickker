<!-- Project Modal -->
<div class="modal fade" id="project-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="overlay-loader hidden">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
	<div class="modal-dialog extend-modal-width" role="document">
	  <div class="modal-content" >
		<div class="modal-header project-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h4 class="modal-title" id="myModalLabel">Assign Your Project</h4>
		</div>
		<div class="modal-body">
			<form class="project-form" method="POST" id="assign_project" action="javascript:void(0)" enctype="multipart/form-data">
				@csrf
				<input type="hidden" name="redirect" value="{{$redirect}}">
				<input type="hidden" name="subscription_id" value="{{$subscription->id}}">
                <div class="form-group col-md-12 text-center col">
                    <label  class="col-sm-2 control-label pad-15">Project</label>

                    <div class="col-sm-10  " style="z-index: 2;">
                        <select class="select-project" name="project_id" required>
                            <option></option>
                            @foreach ($projects as $project)
                            <option value="{{$project->id}}">
                                {{$project->title}}
                            </option>                                                    
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3 center-button">
                        <div class="form-group">
                            <button type="submit" class="btn btn-home">Save</button>
                        </div>
                    </div>
                </div>
                
			</form>
		</div>
	  </div>
	</div>
</div>
