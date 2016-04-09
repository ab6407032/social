﻿      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- Default to the left -->
        <?php footerCopyright() ?>
      </footer>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <script src="<?php echo ISVIPI_STYLE_URL . 'default/js/bootstrap.min.js' ?>"></script>
    <script src="<?php echo ISVIPI_STYLE_URL . 'default/js/app.min.js' ?>"></script>
    <?php 
		//load only on feeds page
		if($PAGE[0] == "home" || $PAGE[0] == "feeds" ){
	
	?>
		<script src="<?php echo ISVIPI_STYLE_URL . 'plugins/link-preview/jquery.liveurl.js' ?>"></script>
        <script> 

                var curImages = new Array();
                
                $('textarea').liveUrl({
                    loadStart : function(){
                        $('.liveurl-loader').show();
                    },
                    loadEnd : function(){
                        $('.liveurl-loader').hide();
                    },
                    success : function(data) 
                    {         
						
						//console.log(data);             
						$('#text-update').append("<input type='hidden' id='tt' name='app_title' value=' " + data.title + " '/>");
						$('#text-update').append("<input type='hidden' id='td' name='app_descr' value=' " + data.description + " '/>");
						$('#text-update').append("<input type='hidden' id='tl' name='app_link' value=' " + data.url + " '/>");
						
						
						var output = $('.liveurl');
						
                        output.find('.title').html(data.title);
                        output.find('.description').text(data.description);
                        output.find('.url').html(linkify(data.url));
                        output.find('.image').empty();
						
						$( "#text-update" ).submit(function( event ) {
						  	close_preview();
							$('#text-update').append("<input type='hidden' name='no_include' value=''/>");
							$('#text-update').append("<input type='hidden' name='app_video' value=''/>");
							$('#text-update').append("<input type='hidden' name='app_image' value=''/>");
						});
                        output.find('.close').one('click', function(){
                            close_preview();
							
							//notify server not to include embedded hidden fields
							$('#text-update').append("<input type='hidden' name='no_include' value='no'/>");
							
                        });
                        
                        output.show('fast');
                        
                        if (data.video != null) {       
							
                            var ratioW        = data.video.width  /350;
                            data.video.width  = 350;
                            data.video.height = data.video.height / ratioW;
        
                            var video = 
                            '<object width="' + data.video.width  + '" height="' + data.video.height  + '">' +
                                '<param name="movie"' +
                                      'value="' + data.video.file  + '"></param>' +
                                '<param name="allowScriptAccess" value="always"></param>' +
                                '<embed src="' + data.video.file  + '"' +
                                      'type="application/x-shockwave-flash"' +
                                      'allowscriptaccess="always"' +
                                      'width="' + data.video.width  + '" height="' + data.video.height  + '"></embed>' +
                            '</object>';
                            output.find('.video').html(video).show();
                            
                         $('#text-update').append("<input type='hidden' id='tv' name='app_video' value=' " + data.video.file + " '/>");
                        }
                    },
                    addImage : function(image)
                    {   
                        var output  = $('.liveurl');
                        var jqImage = $(image);
                        jqImage.attr('alt', 'Preview');
						
						$(function() {
						  $lin = $(image).attr("src");
						});
						
						$('#text-update').append("<input type='hidden' id='ti' name='app_image' value='"+$lin+"'/>");
                        
                        if ((image.width / image.height)  > 7 
                        ||  (image.height / image.width)  > 4 ) {
                            // we dont want extra large images...
                            return false;
                        } 

                        curImages.push(jqImage.attr('src'));
                        output.find('.image').append(jqImage);
                        
                        
                        if (curImages.length == 1) {
                            // first image...
                            
                            output.find('.thumbnail .current').text('1');
                            output.find('.thumbnail').show();
                            output.find('.image').show();
                            jqImage.addClass('active');
                            
                        }
                        

                        if (curImages.length == 2) {
                            output.find('.controls .next').removeClass('inactive');
                        }
                        
                        output.find('.thumbnail .max').text(curImages.length);
                    }
                });
              
              
                $('.liveurl ').on('click', '.controls .button', function() 
                {
                    var self        = $(this);
                    var liveUrl     = $(this).parents('.liveurl');
                    var content     = liveUrl.find('.image');
                    var images      = $('img', content);
                    var activeImage = $('img.active', content);
					if (self.hasClass('next')) 
                         var elem = activeImage.next("img");
                    else var elem = activeImage.prev("img");
      
                    if (elem.length > 0) {
                        activeImage.removeClass('active');
                        elem.addClass('active');  
                        liveUrl.find('.thumbnail .current').text(elem.index() +1);
                        
                        if (elem.index() +1 == images.length || elem.index()+1 == 1) {
                            self.addClass('inactive');
                        }
                    }

                    if (self.hasClass('next')) 
                         var other = elem.prev("img");
                    else var other = elem.next("img");
                    
                    if (other.length > 0) {
                        if (self.hasClass('next')) 
                               self.prev().removeClass('inactive');
                        else   self.next().removeClass('inactive');
                   } else {
                        if (self.hasClass('next')) 
                               self.prev().addClass('inactive');
                        else   self.next().addClass('inactive');
                   }
                   
                   
                   
                });
				
				function close_preview(){
					var liveUrl     = $('.close').parent();
                            liveUrl.hide('slow');
                            liveUrl.find('.video').html('').hide();
                            liveUrl.find('.image').html('');
                            liveUrl.find('.controls .prev').addClass('inactive');
                            liveUrl.find('.controls .next').addClass('inactive');
                            liveUrl.find('.thumbnail').hide();
                            liveUrl.find('.image').hide();
							
                            $('textarea').trigger('clear'); 
                            curImages = new Array();
					
				}
				
				
          </script>
          
          <!-- function to load more feeds -->
          <script>
		  	$(window).bind('scroll', function() {
				if($(window).scrollTop() >= $('#tFeeds').offset().top + $('#tFeeds').outerHeight() - window.innerHeight) {
					
					//if we have reached the bottom of the div we show the loading more animation
					if(end_reached == "no"){
						document.getElementById("load_more").style.display = "block";
						
						setTimeout(function(){
						
							//calculate our next number of feeds to load
							var newload = feed_limit + feeds_to_load;
	
								loadTimeline(newload);
								document.getElementById("load_more").style.display = "none";
						}, 2500);
					} else {
						document.getElementById("no_more_feeds").style.display = "block";
						document.getElementById("load_more").style.display = "none";
					}
					
				}
			});
		  </script>
	
    <?php } ?>
    <script>
		$('#notifications').on('click mouseover', function () {
			$('#notifications').timer('stop');
		});
		$('.content-wrapper').on('click', function () {
			$('#notifications').timer('start');
		});
		function linkify(inputText) {
			var replacedText, replacePattern1, replacePattern2, replacePattern3;
		
			//URLs starting with http://, https://, or ftp://
			replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
			replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');
		
			//URLs starting with "www." (without // before it, or it'd re-link the ones done above).
			replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
			replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');
		
			//Change email addresses to mailto:: links.
			replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
			replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');
		
			return replacedText;
		}
	</script>
    <?php if($p === "profile" || $p === "home" || $p === "post"){?>
    	<script src="<?php echo ISVIPI_STYLE_URL . 'plugins/lightbox/featherlight.js' ?>"></script>
        <script src="<?php echo ISVIPI_STYLE_URL . 'plugins/lightbox/featherlight.gallery.js' ?>"></script>
        <?php if(isset($PAGE[2]) && $PAGE[2] ==="photos"){?>
        	<script src="<?php echo ISVIPI_STYLE_URL . 'plugins/upload/js/jquery.filer.min.js' ?>"></script>
            <script>
			$(document).ready(function() {
				 $('#filer_input').filer({
    changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-folder"></i></div><div class="jFiler-input-text"><h3>Click on this box</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
    showThumbs: true,
	limit: 5,
    maxSize: 10,
    extensions: ['jpg', 'jpeg', 'png', 'gif'],
    theme: "dragdropbox",
    templates: {
        box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
        item: '<li class="jFiler-item">\
                    <div class="jFiler-item-container">\
                        <div class="jFiler-item-inner">\
                            <div class="jFiler-item-thumb">\
                                <div class="jFiler-item-status"></div>\
                                <div class="jFiler-item-info">\
                                    <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                    <span class="jFiler-item-others">{{fi-size2}}</span>\
                                </div>\
                                {{fi-image}}\
                            </div>\
                            <div class="jFiler-item-assets jFiler-row">\
                                <ul class="list-inline pull-left"></ul>\
                                <ul class="list-inline pull-right">\
                                    <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                </ul>\
                            </div>\
                        </div>\
                    </div>\
                </li>',
        itemAppend: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
        itemAppendToEnd: false,
        removeConfirmation: true,
        _selectors: {
            list: '.jFiler-items-list',
            item: '.jFiler-item',
            remove: '.jFiler-item-trash-action'
        }
    }
});
			});
			</script>
        <?php } ?>
      <?php } ?>
    
    

  </body>
</html>
