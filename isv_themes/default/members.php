﻿<?php $pageManager->loadCustomHead('g_head','m_head'); ?>
<?php $pageManager->loadCustomHeader('g_header','m_header'); ?>
<?php $pageManager->loadsideBar('sidebar'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
        	<!-- members -->
        	<section class="col-lg-6">
				<div class="box box-solid members">
                    <div class="box-header with-border">
                      <h3 class="box-title">Browse Members</h3>
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
                      <hr style="margin:5px 0"/>
                    </div>
                	<div class="row">
                    
                    	<!--load members if more than one -->
                       
                    	<?php if(is_array($m_info)) foreach ($m_info as $key => $mi) {
							//get friends properties (request pending, rejected and so on)
							$fr_rquest = new friends();
						?>
                    	<div class="col-md-12">
                          <!-- Widget: user widget style 1 -->
                          <div class="box box-widget widget-user-2 <?php if($fr_rquest->friendReqExists($mi['m_id']) && ($fr_to === $_SESSION['isv_user_id']) && $friendReq_status === 1){ echo "f_req_exists"; }?>">
                          <div class="showme">pending friend request</div>
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
                              
                              <h5 class="widget-user-desc" style="color:#000"><?php echo ucfirst($mi['m_gender']); ?> (
							  <?php echo age($mi['m_dob']) ?>)</h5>
                              <div class="widget-user-username" style="margin-top:-5px;">
                              
                              	  <!-- will show these options only if the two are not blocked from each other -->
                                  <?php if(!$fr_rquest->blocked_users($_SESSION['isv_user_id'],$mi['m_id'])){?>
                                  <!-- check if request exists -->
								  <?php global $fr_id,$friendReq_status,$fr_from,$fr_to; ?>
                                  
                                  <!-- if friend request exists (sender point of view) -->
                              	  <?php if($fr_rquest->friendReqExists($mi['m_id']) && ($fr_from === $_SESSION['isv_user_id'])){?>
                                  	<a href="<?php echo ISVIPI_URL.'p/friends/'.$converter->encode('f_delete').'/'.$converter->encode($fr_id).'/' ?>" class="btn btn-danger btn-xs btn-flat">Delete Friend Request</a>
                                    
                                  <!-- if friend request exists and has not been ignored (recepient point of view) -->
								  <?php } else if($fr_rquest->friendReqExists($mi['m_id']) && ($fr_to === $_SESSION['isv_user_id']) && $friendReq_status === 1) {?>
                                  <a href="<?php echo ISVIPI_URL.'p/friends/'.$converter->encode('f_accept').'/'.$converter->encode($fr_id).'/'.$converter->encode($fr_from) ?>" class="btn btn-primary btn-xs btn-flat">Accept</a>
                                  <a href="<?php echo ISVIPI_URL.'p/friends/'.$converter->encode('f_ignore').'/'.$converter->encode($fr_id) ?>" class="btn btn-danger btn-xs btn-flat">Ignore</a> &nbsp;
								  <!-- if friend request exists and recepient had ignored it (recepient point of view) -->
								  <?php } else if($fr_rquest->friendReqExists($mi['m_id']) && ($fr_to === $_SESSION['isv_user_id']) && $friendReq_status === 0) {?>
								  <?php } else {?>
                                  <a href="<?php echo ISVIPI_URL.'p/friends/'.$converter->encode('f_req').'/'.$converter->encode($mi['m_id']) ?>" class="btn btn-primary btn-xs btn-flat">Send Friend Request</a> &nbsp;
                                  <?php } ?>
                                  <a href="<?php echo ISVIPI_URL.'profile/'.$mi['m_username'] ?>" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-eye"></i> View Profile</a>
                                  <?php } else if ($block_user1 === $_SESSION['isv_user_id']){?>
                                  	<button type="button" class="btn bg-red btn-xs btn-flat disabled">You blocked this user</button>
                                    <a href="<?php echo ISVIPI_URL.'p/friends/'.$converter->encode('f_unblock').'/'.$converter->encode($mi['m_id']) ?>" class="btn btn-success btn-xs btn-flat"><b>Unblock</b></a>
                                  <?php } else if ($block_user2 === $_SESSION['isv_user_id']){?>
                                  	<button type="button" class="btn bg-red btn-xs btn-flat disabled">You were blocked by this user</button>
                                  <?php } ?>
                              </div>
                            </div>
                          </div><!-- /.widget-user -->
                        </div><!-- /.col -->
                        <?php } else {?>
                        <div class="col-md-12">
                        	<li class="list-group-item">No active members found.</li>
                        </div>
						<?php } ?>
                    
                    
                    </div>
                </div>
            <div class="clear"></div> 
			</section>
            <!--end::members -->
			
            
            
            <!-- announcements -->
            <section class="col-lg-3 announcements">
            	<div class="box box-solid">
                    <div class="box-header">
                    	<?php require_once(ISVIPI_ACT_THEME .'pages/news.php') ?>
                    </div>
                </div>
            </section>
            
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
