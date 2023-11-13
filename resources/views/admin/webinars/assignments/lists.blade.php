<!-- Modified by Morehere, mostafa16 - Babiato -->
@extends('admin.layouts.app')

@push('libraries_top')

@endpush


@section('content')
<section class="section">
        <div class="section-header">
            <h1>{{trans('admin/main.notification_assignment')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{trans('admin/main.dashboard')}}</a></div>
                <div class="breadcrumb-item">{{trans('admin/main.notification_assignment')}}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-pen"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4> {{trans('admin/main.course')}} {{trans('admin/main.notification_assignment')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $courseAssignmentsCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-eye"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{trans('admin/main.pending_review')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $pendingReviewCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{trans('admin/main.passed')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $passedCount }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-times"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{trans('admin/main.failed')}}</h4>
                        </div>
                        <div class="card-body">
                            {{ $failedCount }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label">{{trans('admin/main.start_date')}}</label>
                                    <div class="input-group">
									    <input type="date" id="fsdate" class="text-center form-control" name="from" value="{{ request()->get('fsdate') }}" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label">{{trans('admin/main.end_date')}}</label>
                                    <div class="input-group">
									    <input type="date" id="lsdate" class="text-center form-control" name="to" value="{{ request()->get('lsdate') }}" placeholder="End Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">{{trans('admin/main.type_webinar')}}</label>                                    
									<select name="webinar_ids[]" multiple="multiple" class="form-control search-webinar-select2" data-placeholder="Search classes">
                                        @if(!empty($webinars) and $webinars->count() > 0)
                                            @foreach($webinars as $webinar)
                                                <option value="{{ $webinar->id }}" selected>{{ $webinar->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
								</div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label">{{trans('admin/main.status')}}</label>
									<select name="status" class="form-control populate">
                                        <option value="">{{trans('admin/main.all')}}</option>
                                        <option value="active" @if(request()->get('status') == 'active') selected @endif>{{trans('admin/main.active')}}</option>
                                        <option value="inactive" @if(request()->get('status') == 'inactive') selected @endif>{{trans('admin/main.inactive')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group mt-1">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-primary w-100" value="{{trans('admin/main.show_results')}}">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </section>

            <section class="card">
                <div class="card-body">
                    <table class="table table-striped font-14" id="datatable-details">
                        <tbody>
							<tr>
								<th>{{trans('admin/main.title')}}/{{trans('admin/main.course')}}</th>
								<th class="text-center">{{trans('admin/main.students')}}</th>
								<th class="text-center">{{trans('admin/main.grade')}}</th>
								<th class="text-center">{{trans('admin/main.pass_grade')}}</th>
								<th class="text-center">{{trans('admin/main.status')}}</th>
								<th></th>
							</tr>
							@foreach($assignments as $assignment)
								<tr>
									<td class="text-left">                                  
										@if(!empty($assignment->title))
											<span class="d-block font-16 font-weight-500 text-dark-blue">{{ $assignment->title }}</span>
											<span class="d-block font-12 font-weight-500 text-gray">{{ $assignment->webinar->title }}</span>
										@else
                                        <div class="text-small text-warning">{{trans('admin/main.no_chapter')}}</div>
										@endif
									</td>

									<td class="align-middle">
										<span class="font-weight-500">{{ $assignment->instructorAssignmentHistories->count() }}</span>
									</td>

									<td class="align-middle">
										<span>{{ $assignment->grade }}</span>
									</td>

									<td class="align-middle">
										<span>{{ $assignment->pass_grade }}</span>
									</td>

									<td class="align-middle">
                                        @if($assignment->status == 'active')
										{{trans('admin/main.active')}}
                                        @else
                                        {{trans('admin/main.inactive')}}
                                        @endif
									</td>

									<td class="align-middle text-right">
										<a 
											href="/admin/assignments/{{ $assignment->id }}/students" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Students">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a>
									</td>
									
								</tr>
							@endforeach
						</tbody>
					</table>
                </div>
            </section>
        </div>
    </section>
	
	
	
@endsection

@push('scripts_bottom')

@endpush
