<!-- Modified by Morehere, mostafa16 - Babiato -->


<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
<section class="section">
        <div class="section-header">
            <h1><?php echo e(trans('admin/main.notification_assignment')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/"><?php echo e(trans('admin/main.dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(trans('admin/main.notification_assignment')); ?></div>
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
                            <h4> <?php echo e(trans('admin/main.course')); ?> <?php echo e(trans('admin/main.notification_assignment')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($courseAssignmentsCount); ?>

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
                            <h4><?php echo e(trans('admin/main.pending_review')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($pendingReviewCount); ?>

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
                            <h4><?php echo e(trans('admin/main.passed')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($passedCount); ?>

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
                            <h4><?php echo e(trans('admin/main.failed')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($failedCount); ?>

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
                                    <label class="input-label"><?php echo e(trans('admin/main.start_date')); ?></label>
                                    <div class="input-group">
									    <input type="date" id="fsdate" class="text-center form-control" name="from" value="<?php echo e(request()->get('fsdate')); ?>" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label"><?php echo e(trans('admin/main.end_date')); ?></label>
                                    <div class="input-group">
									    <input type="date" id="lsdate" class="text-center form-control" name="to" value="<?php echo e(request()->get('lsdate')); ?>" placeholder="End Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label"><?php echo e(trans('admin/main.type_webinar')); ?></label>                                    
									<select name="webinar_ids[]" multiple="multiple" class="form-control search-webinar-select2" data-placeholder="Search classes">
                                        <?php if(!empty($webinars) and $webinars->count() > 0): ?>
                                            <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($webinar->id); ?>" selected><?php echo e($webinar->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
								</div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="input-label"><?php echo e(trans('admin/main.status')); ?></label>
									<select name="status" class="form-control populate">
                                        <option value=""><?php echo e(trans('admin/main.all')); ?></option>
                                        <option value="active" <?php if(request()->get('status') == 'active'): ?> selected <?php endif; ?>><?php echo e(trans('admin/main.active')); ?></option>
                                        <option value="inactive" <?php if(request()->get('status') == 'inactive'): ?> selected <?php endif; ?>><?php echo e(trans('admin/main.inactive')); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group mt-1">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-primary w-100" value="<?php echo e(trans('admin/main.show_results')); ?>">
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
								<th><?php echo e(trans('admin/main.title')); ?>/<?php echo e(trans('admin/main.course')); ?></th>
								<th class="text-center"><?php echo e(trans('admin/main.students')); ?></th>
								<th class="text-center"><?php echo e(trans('admin/main.grade')); ?></th>
								<th class="text-center"><?php echo e(trans('admin/main.pass_grade')); ?></th>
								<th class="text-center"><?php echo e(trans('admin/main.status')); ?></th>
								<th></th>
							</tr>
							<?php $__currentLoopData = $assignments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td class="text-left">                                  
										<?php if(!empty($assignment->title)): ?>
											<span class="d-block font-16 font-weight-500 text-dark-blue"><?php echo e($assignment->title); ?></span>
											<span class="d-block font-12 font-weight-500 text-gray"><?php echo e($assignment->webinar->title); ?></span>
										<?php else: ?>
                                        <div class="text-small text-warning"><?php echo e(trans('admin/main.no_chapter')); ?></div>
										<?php endif; ?>
									</td>

									<td class="align-middle">
										<span class="font-weight-500"><?php echo e($assignment->instructorAssignmentHistories->count()); ?></span>
									</td>

									<td class="align-middle">
										<span><?php echo e($assignment->grade); ?></span>
									</td>

									<td class="align-middle">
										<span><?php echo e($assignment->pass_grade); ?></span>
									</td>

									<td class="align-middle">
                                        <?php if($assignment->status == 'active'): ?>
										<?php echo e(trans('admin/main.active')); ?>

                                        <?php else: ?>
                                        <?php echo e(trans('admin/main.inactive')); ?>

                                        <?php endif; ?>
									</td>

									<td class="align-middle text-right">
										<a 
											href="/admin/assignments/<?php echo e($assignment->id); ?>/students" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Students">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a>
									</td>
									
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
                </div>
            </section>
        </div>
    </section>
	
	
	
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u1584790/public_html/learning/resources/views/admin/webinars/assignments/lists.blade.php ENDPATH**/ ?>