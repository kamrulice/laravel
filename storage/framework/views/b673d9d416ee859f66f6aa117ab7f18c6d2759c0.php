<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3">
						<div class="list-group"> 
						  	<a class="list-group-item <?php if(\Request::route()->getName()=='admin'): ?> active <?php endif; ?>" href="/admin/">Overview</a>
						  	<a class="list-group-item <?php if(\Request::route()->getName()=='admin/manage-user'): ?> active <?php endif; ?>" href="/admin/manage-user/">Manage User</a>
						  	<a class="list-group-item <?php if(\Request::route()->getName()=='admin/membership-plan'): ?> active <?php endif; ?>" href="/admin/membership-plan">Membership Plan</a>
						  	<a class="list-group-item <?php if(\Request::route()->getName()=='admin/free-sign-up'): ?> active <?php endif; ?>" href="/admin/free-sign-up">Free Sign Up</a>
						  	
						</div>
					</div>
					<div class="col-md-9">
						<ul class="list-unstyled">
							<li> <strong>Total users : </strong> <?php echo e(count($users)); ?> </li>


						<?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li> <strong><?php echo e($subscription->name); ?> : </strong>  <?php echo e($subscription->count); ?> </li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						
			

                        <li> <strong># of post sent to Buffer : </strong> <?php echo e(\Bulkly\BufferPosting::count()); ?> </li>
                        <li> <strong># of post saved on database : </strong> <?php echo e(\Bulkly\SocialPosts::count()); ?>  </li>

						</ul>


						

					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>