﻿<?php if($_SESSION['isv_user_id'] === $m_info['m_user_id']){?>
<!-- upload prifle pic modal-->
<div class="modal fade" id="profilePic" tabindex="-1" role="dialog" aria-labelledby="profilePic">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="<?php echo ISVIPI_URL .'p/member' ?>" method="post" enctype="multipart/form-data" id="imgFeed" runat="server">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload Profile Picture</h4>
      </div>
      <div class="modal-body">
      	<div class="fileUpload btn btn-upload">
        	<span>Click to Choose Image</span>
           	<input type="file" class="upload" name="p_pic" id="imgInp1"/>
      	</div>
       	<img id="preview1" src="<?php echo ISVIPI_STYLE_URL.'/default/images/preview.png' ?>"/>
       	<input type="hidden" name="isv_op" value="<?php echo $converter->encode('prof_pic') ?>" />
      	<div class="clear"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- upload cover photo modal-->
<div class="modal fade" id="cover" tabindex="-1" role="dialog" aria-labelledby="cover">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="<?php echo ISVIPI_URL .'p/member' ?>" method="post" enctype="multipart/form-data" id="imgFeed" runat="server">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload Cover Photo</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-info" style="padding:10px">
        	Your cover photo should be approximately 800px by 250 px
        </div>
      	<div class="fileUpload btn btn-upload">
        	<span>Click to Choose Image</span>
           	<input type="file" class="upload" name="cover" id="imgInp2"/>
      	</div>
       	<img id="preview2" src="<?php echo ISVIPI_STYLE_URL.'/default/images/preview.png' ?>"/>
       	<input type="hidden" name="isv_op" value="<?php echo $converter->encode('cover_pic') ?>" />
      	<div class="clear"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!------------------------------------------------------------!>
        <!-- FEED IMAGE PREVIEW -->
        <script>
			function readURL1(input) {
			var url = input.value;
			var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
			if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
				var reader = new FileReader();
		
				reader.onload = function (e) {
					$('#preview1').css('display','block');
					$('#preview1').attr('src', e.target.result);
				}
		
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#imgInp1").change(function(){
			readURL1(this);
		});
		</script>
        
        <script>
			function readURL(input) {
			var url = input.value;
			var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
			if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
				var reader = new FileReader();
		
				reader.onload = function (e) {
					$('#preview2').css('display','block');
					$('#preview2').attr('src', e.target.result);
				}
		
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#imgInp2").change(function(){
			readURL(this);
		});
		</script>

<?php } ?>

<!-- Block User Modal-->
<div class="modal fade" id="block" tabindex="-1" role="dialog" aria-labelledby="block">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Block <?php echo $m_info['m_fullname']; ?></h4>
      </div>
      <div class="modal-body">
		Are you sure you want to block <strong><?php echo $m_info['m_fullname']; ?></strong>. Once blocked:
        <ul>
        	<li>If you are friends, you will automatically be unfriended.</li>
            <li>You will not be able to exchange messages</li>
            <li>Any pending friend request will be automatically deleted</li>
            <li>You will not be able to like, share or comment on each other's posts</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="<?php echo ISVIPI_URL.'p/friends/'.$converter->encode('f_block').'/'.$converter->encode($m_info['m_user_id']) ?>" class="btn btn-primary">Yes, Block User</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Unfriend-->
<div class="modal fade" id="unfriend" tabindex="-1" role="dialog" aria-labelledby="unfriend">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Unfriend <?php echo $m_info['m_fullname']; ?></h4>
      </div>
      <div class="modal-body">
		Are you sure you want to unfriend <strong><?php echo $m_info['m_fullname']; ?></strong>.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="<?php echo ISVIPI_URL.'p/friends/'.$converter->encode('f_remove').'/'.$converter->encode($m_info['m_user_id']).'/' ?>" class="btn btn-primary">Yes, Unfriend <?php echo $m_info['m_fullname']; ?></a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Send Message -->
<div class="modal fade" id="pm" tabindex="-1" role="dialog" aria-labelledby="private message">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="<?php echo ISVIPI_URL .'p/messaging' ?>" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Send <strong><?php echo $m_info['m_fullname']; ?></strong> a message</h4>
      </div>
      <div class="modal-body">
      	<div class="form-group">
       		<label>Message</label>
          	<textarea class="form-control" rows="3" placeholder="Type message here..." name="msg"></textarea>
      	</div>
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="to" value="<?php echo $converter->encode($m_info['m_user_id']) ?>" />
        <input type="hidden" name="isv_op" value="<?php echo $converter->encode('send_pm') ?>" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- upload photo album modal-->
<div class="modal fade" id="photo_album" tabindex="-1" role="dialog" aria-labelledby="photo_album">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload Photo Album</h4>
      </div>
      <div class="modal-body">
      <form action="<?php echo ISVIPI_URL .'p/photo_album' ?>" method="post" enctype="multipart/form-data" runat="server">
      	<div class="alert alert-info" style="padding:10px">
        	<li>Maximum photo size is 2MB</li>
            <li>Maximum number of photos in an album is <?php echo MAX_PHOTOS_IN_ALBM ?></li>
            <li>Allowed file types 'jpg', 'jpeg', 'png', 'gif'</li>
            <li>Hold ctrl to select multiple pictures (max. 5 photos)</li>
        </div>
        <div style="clear:both"></div>
            <label>Album Title</label>
            <input name="title" type="text" id="title" class="form-control" placeholder="enter album title e.g. my new album"/>
            <div style="clear:both"></div>
            <hr style="margin:10px 0"/>
            <input type="file" name="files[]" id="filer_input" multiple="multiple">
        
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="aop" value="<?php echo $converter->encode('new_albm') ?>" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


