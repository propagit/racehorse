<div class="container app-container">
		

        
        <div class="row">
       
            <div class="col-sm-12 col-xs-12 x-r-gutter competition-form-wrap">
                <form id="competition-form">	
        
                    <div class="col-xs-12">
                      <div class="form-group">
                        <input placeholder="Your First Name" type="text" class="form-control" name="firstname">
                      </div>
                      
                      <div class="form-group">
                        <input placeholder="Your Surname" type="text" class="form-control" name="lastname" >
                      </div>
                      <div class="form-group">
                        <input placeholder="Your Email" type="text" class="form-control" name="email">
                      </div>
                      <div class="form-group">
                        <select class="form-control" name="state">
                            <option value="" selected>Select State</option> 
                            <?php
                                foreach($states as $state){
                            ?>
                            <option value="<?=$state['name'];?>"><?=$state['name']?></option> 
                            <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <select class="form-control" name="country">
                            <option value="">Select Country</option> 
                            <?php
                                foreach($countries as $country){
                            ?>
                            <option value="<?=$country['name'];?>" <?=strtolower($country['name']) == 'australia' ? 'selected="selected"' : '';?>><?=$country['name']?></option> 
                            <?php } ?>
                        </select>
                      </div>
                    
                    </div>
                    

                    
                    <div class="col-xs-12">
                      <div class="form-group">
                        <input type="text" placeholder="Friend's Name" class="form-control" name="friend_name[]">
                      </div>
                      <div class="form-group">
                        <input type="text" placeholder="Friend's Email" class="form-control friend-email" name="friend_email[]">
                      </div>
                    </div>
                    <input name="token" type="hidden" value="<?=$token ? $token : '';?>">
                    
                    <div class="col-xs-12">
                    	<button class="btn btn-success" type="button" id="enter-competition" style="float:right;">Enter</button>
                    </div>
                </form>    
            </div>
        
        </div>

</div>
<script>

$(function(){
	$(document).on('focus','.friend-email',function(){
		if($(this).parent().is(':last-child')){
			append_friend();	
		}
	});
	
	// submit form
	$('#enter-competition').click(function(){
		enter_competition();
		//$('#competition-form').submit();
	});
});

function append_friend(){
	var count = 1;
	var inc = 1;
	var friends = $('.friend-email').length - 1;
	$('.friend-email').each(function(){
		if($(this).val()){
			count++;
		}
	});
	if(count >= friends){
		inc++;
		var html = '<div class="additional-friends"><div class="form-group"><input type="text" placeholder="Friend\'s Name" class="form-control" name="friend_name[]"></div><div class="form-group"><input type="text" placeholder="Friend\'s Email" class="form-control friend-email" name="friend_email[]"></div></div>';
		$('.friend-box').append(html);
	}
}

function enter_competition(){
	$('#message-modal-content').html('<i class="fa fa-spinner fa-spin"></i> Please wait while we submit your entry.');
	$('#message-modal').modal('show');
	$.ajax({
		type: "POST",
		url: "<?=base_url();?>competition/enter_competition",
		data: $('#competition-form').serialize(),
		dataType:"JSON",
		success: function(data){
			if(data['status'] == 'ok'){
			 	$('#message-modal-content').html('<span class="text-success">You have successfully entered the competition.</span>');
				//$('#anyModalFooter').modal('show');
				
				// clear form and remove additional friend invite fields
				$('.additional-friends').remove();
				$('#competition-form')[0].reset();
			}else{
				$('#message-modal-content').html('<span class="text-danger">'+data['msg']+'</span>');
				//$('#anyModalFooter').modal('show');
			}
		}
	});	
	
}

</script>