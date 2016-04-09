﻿<?php $pageManager->loadCustomHead('g_head','m_head'); ?>
<?php $pageManager->loadCustomHeader('g_header','m_header'); ?>
<?php $pageManager->loadsideBar('sidebar'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
        	<!-- members -->
        	<section class="col-lg-9">
				<div class="box box-solid members">
                    <div class="box-header with-border">
                      <h3 class="box-title">My Friends</h3>
                      <div class='box-tools'>
                      	<div class="dropdown" style="display:inline-block">
                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="fa fa-chevron-down"></span>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="<?php echo ISVIPI_URL ."members/latest/$limit" ?>">Order by Latest</a></li>
                            <li><a href="<?php echo ISVIPI_URL ."members/oldest/$limit" ?>">Order by Oldest</a></li>
                          </ul>
                    	</div>
                        <div class="dropdown" style="display:inline-block">
                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="fa fa-bars"></span>
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="<?php echo ISVIPI_URL ."members/$oderBY/25" ?>">25 per page</a></li>
                            <li><a href="<?php echo ISVIPI_URL ."members/$oderBY/50" ?>">50 per page</a></li>
                            <li><a href="<?php echo ISVIPI_URL ."members/$oderBY/100" ?>">100 per page</a></li>
                            <li><a href="<?php echo ISVIPI_URL ."members/$oderBY/all" ?>">All</a></li>
                          </ul>
                    	</div>
                    </div>
                    </div>
                	<div class="row">
                    
                    	<!--load members if more than one -->
                        <?php if($allMs = $m->totalFriends($_SESSION['isv_user_id']) > 0 ){?>
                    	<?php if(is_array($m_info)) foreach ($m_info as $key => $mi) {?>
                    	<div class="col-md-6" style="margin-top:10px">
                          <!-- Widget: user widget style 1 -->
                          <div class="box box-widget widget-user-2">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-white">
                              <a href="<?php echo ISVIPI_URL.'profile/'.$mi['m_username'] ?>">
                              <div class="widget-user-image">
                                <img class="img-square" src="<?php echo user_pic($mi['m_profile_pic']) ?>" alt="User Avatar">
                              </div><!-- /.widget-user-image -->
                              </a>
                              <h3 class="widget-user-username" style="color:#000; font-weight:500">
                              <a href="<?php echo ISVIPI_URL.'profile/'.$mi['m_username'] ?>">
							  	<?php echo $mi['m_fullname']; ?>
                              </a>
                              </h3>
                              <div class="widget-user-username" style="margin-top:-5px;">
                              
                                  <a href="<?php echo ISVIPI_URL.'profile/'.$mi['m_username'] ?>" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-eye"></i> View Profile</a>
                                  <a href="#" data-toggle="modal" data-target="#unfriend<?php echo $mi['m_id'] ?>" class="btn btn-danger btn-xs btn-flat">Unfriend</a>
                              </div>
                            </div>
                          </div><!-- /.widget-user -->
                        </div><!-- /.col -->
                        <!-- Unfriend MODAL-->
                        <div class="modal fade" id="unfriend<?php echo $mi['m_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="unfriend">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Unfriend <?php echo $mi['m_fullname']; ?></h4>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to unfriend <strong><?php echo $mi['m_fullname']; ?></strong>.
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <a href="<?php echo ISVIPI_URL.'p/friends/'.$converter->encode('f_remove').'/'.$converter->encode($mi['m_id']).'/' ?>" class="btn btn-primary">Yes, Unfriend <?php echo $mi['m_fullname']; ?></a>
                              </div>
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <?php } ?>
                        <?php } else {?>
                        <div class="col-md-12">
                        	<li class="list-group-item">You do not have any friends yet. Click <a href="<?php echo ISVIPI_URL .'members/' ?>">browse</a> to meet new people.</li>
                        </div>
                        <?php } ?>
                    
                    
                    </div>
                </div>
            <div class="clear"></div> 
			</section>
            <!--end::members -->
			
            
            <!-- online friends -->
            <section class="col-lg-3 friends-sidebar">
            	<div class="box box-solid">
                    <div class="box-header">
                    	<?php require_once(ISVIPI_ACT_THEME .'pages/friends_sidebar.php') ?>
                    </div>
                </div>
            </section>
            
            <div class="clear"></div>
            </section>
        </section>
        <!-- /.content -->
        
      </div>
      <!-- /.content-wrapper -->
      
      <!-- scripts section -->
<?php $pageManager->loadCustomFooter('g_footer','m_footer'); ?>
