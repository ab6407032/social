﻿      <!-- TEXT FEED -->
      <script>
		$('#text-update').ajaxForm({ 
			dataType: 'json', 
			success: function(json) { 
			$("#processing").show();
			$('#errorLog').css('display','none');
			$('input[type="submit"]').prop('disabled', true);
				setTimeout(function(){
					if(json.err == true) {
						$('#errorLog').css('display','block');
						$('#errorLog').html(json.message);
					} else if (json.err == false){
						$('#errorLog').css('display','none');
						$('#text-update').clearForm();
						$('#text-update').resetForm();
						$('.liveurl-loader').hide();
						//reload our timeline
						loadTimeline();
						$finished = true;
						$(':input').val('');
					}
					$('input[type="submit"]').prop('disabled', false);
					$("#processing").hide();
				}, 500);
			 } 
			});
			var $myForm = $("#text-update");
				$myForm.submit(function(){
					$myForm.submit(function(){
						return false;
					});
				});
		</script>
        
      <!-- IMAGE FEED -->
      <script>
		$('#imgFeed').ajaxForm({ 
			beforeSubmit: validate,
			dataType: 'json', 
			success: function(json) { 
				setTimeout(function(){
					if(json.err == true) {
						$('#errorLog').css('display','block');
						$('#errorLog').html(json.message);
					} else if (json.err == false){
						$('#errorLog').css('display','none');
						$('#imgFeed').clearForm();
						$('#preview').css('display','none');
						$('#preview2').css('display','block');
						$("#uplPic").css('display','block');
						$("#uplPic2").css('display','none');
						//reload our timeline
						loadTimeline();
					}
					$("#processing2").hide();
				}, 500);
			 } 
			});
			function validate(formData, jqForm, options) { 
				var form = jqForm[0]; 
				if (!form.feedImg.value) { 
					alert('Please select an image to upload'); 
					return false; 
				} 
				$("#processing2").show();
			}
			
		</script>
        
        <!-- FEED IMAGE PREVIEW -->
        <script>
			function readURL(input) {
			var url = input.value;
			var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
			if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
				var reader = new FileReader();
		
				reader.onload = function (e) {
					$('#preview2').css('display','none');
					$('#preview').css('display','block');
					$('#preview').attr('src', e.target.result);
				}
		
				reader.readAsDataURL(input.files[0]);
			}else{
				 //$('#preview').attr('src', 'http://localhost/isvipi/isv_inc/isv_style.lib/default/images/logo.png');
			}
		}
		$("#imgInp").change(function(){
			console.log('test');
			readURL(this);
		});
		</script>
        
        <!-- LOAD TIMELINE -->
        <script>
			function loadTimeline($feeds_to_load){
				//console.log($feeds_to_load);
				$('#tFeeds').load(site_url +'/feeds/'+$feeds_to_load);
			}
		</script>
