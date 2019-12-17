<?php $__env->startSection('content'); ?>
    <div class="container-fluid app-body app-home">
         <form method="get" action="<?php echo e(route('/search')); ?>">
             <div class="form-inline">
                <i class="fa fa-search"></i> <input type="text" name="search" placeholder="Enter Any Key For Search" class="form-control">&nbsp;
                 <input type="date" name="date" class="form-control">
                 &nbsp;
                 <select class="form-control" name="group">
                     <option>All Group</option>
                     <?php $__currentLoopData = $groups = \Bulkly\View::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <option><?php echo e($group->groupName); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
                 &nbsp
                 <button class="btn btn-success" type="submit">Search</button>
             </div>
         </form>
        <hr>
        <div class="row">
            <div class="col-md-12">
            <?php if($user->plansubs()): ?>
                <?php

                $timestamp = $user->plansubs()['subscription']->current_period_start;
                if (!$timestamp) {
                    $timestamp = date('Y-m');
                    $timestamp = date('Y-m-d H:i:s', strtotime($timestamp));

                }
                $user_current_pph = \Bulkly\BufferPosting::where('user_id', $user->id)->where('created_at', '>', $timestamp)->count();
                ?>
                <?php if($user->plansubs()['plan']): ?>
                    <?php if( $user_current_pph > $user->plansubs()['plan']->ppm): ?>
                        <!--
    				<div class="alert alert-danger text-center" role="alert"> 
    					Whoops! You've reached your monthly limit of <?php echo e($user->plansubs()['plan']->ppm); ?> which is the number of posts you can send to Buffer. <b>Need to send more?</b> <a href="/settings">Visit your settings page to upgrade your account</a>.
    					</div> 
    				-->
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <!--<div class="alert alert-danger text-center" role="alert"> You have not any active subscription plan now</a>.
				</div> -->

                <?php endif; ?>





















                    <table class="table table-bordered table-hover">
                        <thead>
                            <th>Group Name</th>
                            <th>Group Type</th>
                            <th>Account Name</th>
                            <th>Post</th>
                            <th>Time</th>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $allDatas = \Bulkly\View::paginate(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($allData->groupName); ?></td>
                            <td><?php echo e($allData->groupType); ?></td>
                            <td><img src="<?php echo e(asset('images/avatar.png')); ?>" class="rounded-circle" style="width:60px; height:40px; border-radius: 50%;  "> </td>
                            <td><?php echo e($allData->post); ?></td>
                            <td><?php echo e($allData->created_at); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table>
                <div class="text-center"> <?php echo e($allDatas->links()); ?></div>

            </div>
        </div>
        <?php if(session()->has('buffer_token')): ?>


            <div class="row">
                <div class="col-md-5">
                    <div class="panel panel-default channel-activity">
                        <div class="panel-body">
                            <h3>Channel Activity</h3>
                            <div class="media">
                                <div class="media-left">
                                    <canvas id="myChart" width="230" height="230">
                                    </canvas>
                                    <span class="total-post"></span>
                                </div>
                                <div class="media-body media-middle">
                                    <ul class="list-unstyled">
                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li data-count=""><i
                                                        class="<?php echo e($service->account_service); ?> fa fa-circle"></i> <?php echo e(ucwords($service->account_service)); ?>

                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                            <script type="text/javascript">
                                var data = {
                                    labels: [<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>"<?php echo e($service->account_service); ?>",<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                                    datasets: [
                                        {
                                            data: [<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>"<?php echo e($service->count); ?>",<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                                            backgroundColor: ["#25396e", "#5584ff", "#5ccae7", "#3755a4",]
                                        }]
                                };
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Posting Frequency</h3>
                            <div style="overflow: hidden; margin-top: 35px;" class="layer">
                                <canvas style="margin-top: -25px; " id="homePostingFrequency" width="500" height="140">

                                </canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row home-block">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Recent Activity</h3>
                            <div class="activities">

                                <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(\Bulkly\SocialAccounts::find($activity->account_id) != null): ?>
                                        <div class="panel panel-default activity">
                                            <div class="panel-body">
                                                <div class="media">
                                                    <div class="media-left media-middle">
                                                        <i class="fa fa-<?php echo e(\Bulkly\SocialAccounts::find($activity->account_id)->type); ?>"></i>
                                                        <img width="50"
                                                             src="<?php echo e(\Bulkly\SocialAccounts::find($activity->account_id)->avatar); ?>">
                                                    </div>
                                                    <div class="media-body media-middle">
                                                        <h4 class="media-heading"> posted
                                                            <strong> <?php echo e(substr($activity->post_text, 0, 30)); ?>

                                                                ... </strong>
                                                        </h4>
                                                        <p><i class="fa fa-clock-o"></i> <span
                                                                    data-sent="<?php echo e(strtotime($activity->sent_at)); ?>"></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Recent Groups</h3>
                            <?php $__currentLoopData = $user->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($group->status == 0): ?>
                                    <div class="panel panel-default group-single" data-id="<?php echo e($group->id); ?>"
                                         data-status="pending">
                                        <div class="panel-body">
                                            <div class="media">
                                                <div class="media-left media-middle">
                                                    <?php if($group->type=='upload'): ?>
                                                        <a href="<?php echo e(route('content-pending', $group->id)); ?>">
                                                            <?php endif; ?>
                                                            <?php if($group->type=='curation'): ?>
                                                                <a href="<?php echo e(route('content-curation-pending', $group->id)); ?>">
                                                                    <?php endif; ?>
                                                                    <?php if($group->type=='rss-automation'): ?>
                                                                        <a href="<?php echo e(route('rss-automation-pending', $group->id)); ?>">
                                                                            <?php endif; ?>
                                                                            <?php echo e(substr($group->name, 0, 1)); ?>

                                                                        </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <?php if($group->type=='upload'): ?>
                                                        <a href="<?php echo e(route('content-pending', $group->id)); ?>">
                                                            <?php endif; ?>
                                                            <?php if($group->type=='curation'): ?>
                                                                <a href="<?php echo e(route('content-curation-pending', $group->id)); ?>">
                                                                    <?php endif; ?>
                                                                    <?php if($group->type=='rss-automation'): ?>
                                                                        <a href="<?php echo e(route('rss-automation-pending', $group->id)); ?>">
                                                                            <?php endif; ?>
                                                                            <h4 class="media-heading"><?php echo e($group->name); ?></h4>
                                                                            <p><i class="fa fa-clock-o"></i>
                                                                                <small> Schedule not set</small>
                                                                            </p>
                                                                        </a>
                                                </div>
                                                <div class="media-left media-middle">
                                                    <?php echo $__env->make('group.grouppop', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body  group-items completed">
                            <h3>Completed Groups</h3>
                            <?php $__currentLoopData = $user->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($group->status == 2): ?>
                                    <div class="panel panel-default group-single" data-id="<?php echo e($group->id); ?>"
                                         data-status="completed">
                                        <div class="panel-body">
                                            <div class="media">
                                                <div class="media-left media-middle">
                                                    <?php if($group->type=='upload'): ?>
                                                        <a href="<?php echo e(route('content-completed', $group->id)); ?>">
                                                            <?php endif; ?>
                                                            <?php if($group->type=='curation'): ?>
                                                                <a href="<?php echo e(route('content-curation-completed', $group->id)); ?>">
                                                                    <?php endif; ?>
                                                                    <?php if($group->type=='rss-automation'): ?>
                                                                        <a href="<?php echo e(route('rss-automation-completed', $group->id)); ?>">
                                                                            <?php endif; ?>
                                                                            <?php echo e(substr($group->name, 0, 1)); ?>

                                                                        </a>
                                                </div>
                                                <div class="media-body media-middle">
                                                    <?php if($group->type=='upload'): ?>
                                                        <a href="<?php echo e(route('content-completed', $group->id)); ?>">
                                                            <?php endif; ?>
                                                            <?php if($group->type=='curation'): ?>
                                                                <a href="<?php echo e(route('content-curation-completed', $group->id)); ?>">
                                                                    <?php endif; ?>
                                                                    <?php if($group->type=='rss-automation'): ?>
                                                                        <a href="<?php echo e(route('rss-automation-completed', $group->id)); ?>">
                                                                            <?php endif; ?>
                                                                            <h4 class="media-heading"><?php echo e($group->name); ?></h4>
                                                                            <p><i class="fa fa-check-circle-o"></i>
                                                                                <small> Completed</small>
                                                                            </p>
                                                                        </a>
                                                </div>
                                                <div class="media-left media-middle">
                                                    <?php echo $__env->make('group.grouppop', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                </div>
            </div>


        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>