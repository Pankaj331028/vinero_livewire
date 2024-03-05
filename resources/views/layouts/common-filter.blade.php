
<div class="accordion accordion-solid accordion-toggle-plus" id="filterSection">
	<div class="card">
		<div class="card-header" id="filerHeading">
			<div class="card-title @if(stripos(url()->full(),'?')===false) collapsed @endif" data-toggle="collapse" data-target="#filterCollapse" aria-expanded="true" aria-controls="filterCollapse">
				<i class="la la-filter"></i> Filter
			</div>
		</div>
		<div id="filterCollapse" class="collapse @if(stripos(url()->full(),'?')!==false) show @endif" aria-labelledby="filerHeading" data-parent="#filterSection">
			<form class="kt-form" id="filterForm">
				<div class="card-body">
					<div class="kt-section kt-section--first">
		                <div class="kt-section__body">
		                	<div class="row">
		                		<div class="col-md-3">
				                    <div class="form-group">
				                        <label>
				                            From Date
				                        </label>
			                            <div class="input-group date">
											<input type="text" class="form-control" name="start_date" readonly placeholder="Select date" id="start_date" value="{{Request::get('start_date')}}" />
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar-check-o"></i>
												</span>
											</div>
										</div>
				                    </div>
			                    </div>
		                		<div class="col-md-3">
				                    <div class="form-group">
				                        <label>
				                            End Date
				                        </label>
			                            <div class="input-group date">
											<input type="text" class="form-control" name="end_date" readonly placeholder="Select date" id="end_date" value="{{Request::get('end_date')}}"/>
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar-check-o"></i>
												</span>
											</div>
										</div>
				                    </div>
			                    </div>
			                    <div class="col-md-3">
			                    	<div class="form-group">
			                    		<label>Status</label>
			                    		<select name="status" class="form-control">
			                    			<option value="">Select</option>
			                    			<option value="AC" {{Request::get('status')=='AC'?'selected="selected"':''}}>Active</option>
			                    			<option value="IN" {{Request::get('status')=='IN'?'selected="selected"':''}}>Inactive</option>
			                    		</select>
			                    	</div>
			                    </div>
			                </div>
		                </div>
		            </div>
				</div>
				<div class="card-footer text-right">
					<button type="submit" class="btn btn-success btn-elevate btn-icon-sm">Filter</button>
					<a href="{{URL::current()}}" class="btn btn-primaty btn-elevate btn-icon-sm">Reset</a>
				</div>
			</form>
		</div>
	</div>
</div>
