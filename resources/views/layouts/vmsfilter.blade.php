<div class="accordion accordion-solid accordion-toggle-plus" id="filterSection">
	<div class="card">
		<div class="card-header" id="filerHeading">
			<div class="card-title @if(stripos(url()->full(),'?')===false) collapsed @endif" data-toggle="collapse"
				data-target="#filterCollapse" aria-expanded="true" aria-controls="filterCollapse">
				<i class="la la-filter"></i> Filter
			</div>
		</div>
		<div id="filterCollapse" class="collapse @if(stripos(url()->full(),'?')!==false) show @endif" aria-labelledby="filerHeading" data-parent="#filterSection">
			<form class="kt-form" id="filterForm">
				<div class="card-body">
					<div class="kt-section kt-section--first">
						<div class="kt-section__body">
							<div class="row">
								@if(Request::segment(2) != "reports" && (Request::segment(2) != "dashboard" || Request::segment(2)==null))
								<div class="col-md-3">
									<div class="form-group">

										<label>Start Date</label>
										<div class="input-group date">
											<input type="text" class="form-control" name="start_date" readonly
												placeholder="Select date" id="start_date"
												value="{{Request::get('start_date')}}" />
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
											<input type="text" class="form-control" name="end_date" readonly
												placeholder="Select date" id="end_date" max="<?php $today?>"
												value="{{Request::get('end_date')}}" />
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar-check-o"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3 d-none">
									<div class="form-group">
										<label>
											Property Type
										</label>
										<div class="input-group date">
											<input type="text" class="form-control" name="type" readonly
											@if(request()->get('type')) value="{{request()->get('type')}}" @else value="{{Request::get('type')}}" @endif />
										</div>
									</div>
								</div>
								@if(in_array(Request::segment(2), ['sellers','agents','buyers']))
								<div class="col-md-3">
									<div class="form-group">
										<label>
											OTPIN/OPTOUT
										</label>
										<div class="input-group date">
											<select name="node" class="form-control">
												<option value="">Select</option>
												@foreach($opt_mode as $mode)
													<option value="{{ $mode }}">{{ $mode }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								@endif
								@else
								<div class="col-md-3">
									<div class="form-group">
										<label>
											Month
										</label>
										<div class="input-group month">
											<input type="text" class="form-control" name="month" readonly
												placeholder="Select month" id="month"
												value="{{Request::get('month')}}" />
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar-check-o"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-right">
					<button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">Filter</button>
					<a href="{{url()->full()}}" type="Reset" class="btn btn-default btn-elevate btn-icon-sm">Reset</a>
				</div>
			</form>
		</div>
	</div>
</div>