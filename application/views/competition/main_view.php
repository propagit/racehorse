<div class="container app-container">
    <div class="col-xs-12 header text-center">
        <img src="<?= base_url(); ?>assets/img/logo.png"/>        
    </div>
    <div class="col-xs-12 competition-slogan x-gutters">
        <img src="<?= base_url(); ?>assets/img/Header.png" width="105%;"/>
    </div>    

    <div class="col-sm-8 col-xs-12 img-wrap x-gutters">
        <img src="<?= base_url(); ?>assets/img/HeroPic.png" width="100%;" />
    </div>



        

        <div class="col-sm-4 col-xs-12 x-r-gutter competition-form-wrap">

             <img src="<?= base_url(); ?>assets/img/Header-Enter.png" width="100%;" />
             <p>
                To celebrate the impending launch of our new site we are giving someone the Dream of racehorse ownership. In conjunction with Dream Thoroughbreds you can become an owner for 2 years in this exciting Sebring filly trained at Caulfield by Ciaron Maher
            </p>
            <form id="competition-form">	

                <div class="col-xs-12">
                    <div class="form-group">
                        <input placeholder="your first name..." type="text" class="form-control" name="firstname">
                    </div>

                    <div class="form-group">
                        <input placeholder="your surname..." type="text" class="form-control" name="lastname" >
                    </div>
                    <div class="form-group">
                        <input placeholder="your email..." type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <input placeholder="your mobile..." type="text" class="form-control" name="mobile">
                    </div>
                    <div class="form-group">
                        <label class="radio-inline">
                            Previously owned a racehorse?
                        </label>
                        <label class="radio-inline">                            
                            <input type="radio" name="owned_racehorse" id="owned_racehorseYes" value="Yes">Yes
                        </label>
                        <label class="radio-inline">                            
                            <input type="radio" name="owned_racehorse" id="owned_racehorseNo" value="No">No
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="radio-inline">
                            Your Gender
                        </label>
                        <label class="radio-inline">                            
                            <input type="radio" name="gender" id="gender_male" value="M">Male
                        </label>
                        <label class="radio-inline">                            
                            <input type="radio" name="gender" id="gender_female" value="F">Female
                        </label>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="state">
                            <option value="" selected>Select State</option> 
                            <?php
                            foreach ($states as $state) {
                                ?>
                                <option value="<?= $state['name']; ?>"><?= $state['name'] ?></option> 
                            <?php } ?>
                        </select>
                    </div>
                    <!--<div class="form-group">
                      <select class="form-control" name="country">
                          <option value="">Select Country</option> 
                    <?php
                    foreach ($countries as $country) {
                        ?>
                                      <option value="<?= $country['name']; ?>" <?= strtolower($country['name']) == 'australia' ? 'selected="selected"' : ''; ?>><?= $country['name'] ?></option> 
                    <?php } ?>
                      </select>
                    </div> -->

                </div>
                



                <!--<div class="col-xs-12 friend-box">
                    <div class="form-group">
                        <input type="text" placeholder="Friend's Name" class="form-control" name="friend_name[]">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Friend's Email" class="form-control friend-email" name="friend_email[]">
                    </div>
                </div>-->
                <input name="token" type="hidden" value="<?= $token ? $token : ''; ?>">

                <div class="col-xs-12">
                    <button class="btn btn-success" type="button" id="enter-competition" style="float:right;">Enter</button>
                </div>
                </form>
            
            
            <form id="additional-friends-form">
                <div class="col-xs-12 friend-box">
                    <div class="form-group">
                        <input type="text" placeholder="Friend's Name" class="form-control" name="friend_name[]">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Friend's Email" class="form-control friend-email" name="friend_email[]">
                    </div>
                </div>
                <div class="col-xs-12">
                    <button class="btn btn-success" type="button" id="enter-additional-friends" style="float:right;">Enter</button>
                </div>
                <div class="col-xs-12">
                    <button class="btn btn-success" type="button" id="additional-friends-no-thanks" style="float:right;">No Thanks</button>
                </div>
            </form>
            
            <div id="facebook-part">
                <i class="fa fa-facebook"></i>
                <div class="col-xs-12">
                    <button class="btn btn-success" type="button" id="facebook-no-thanks" style="float:right;">No Thanks</button>
                </div>
            </div>
        </div>



</div>
<script>
    $('#additional-friends-form').hide();
    $('#facebook-part').hide();
    $(function () {
        $(document).on('focus', '.friend-email', function () {
            if ($(this).parent().is(':last-child')) {
                append_friend();
            }
        });

        // submit form
        $('#enter-competition').click(function () {
            enter_competition();
            //$('#competition-form').submit();
        });
        
        // additional-friends form
        $('#enter-additional-friends').click(function () {
            enter_additional_friends();
            //$('#competition-form').submit();
        });
        
        // no thanks button for additional friends
        $('#additional-friends-no-thanks').click(function(){
            redirect_facebook();
        });
        
        //no thanks button for facebook part
        $('#facebook-no-thanks').click(function(){
            end_part();
        });
    });
    
    function redirect_facebook(){
        $('#additional-friends-form').remove();
        $('#facebook-part').show();
    }

    function append_friend() {
        var count = 1;
        var inc = 1;
        var friends = $('.friend-email').length - 1;
        $('.friend-email').each(function () {
            if ($(this).val()) {
                count++;
            }
        });
        if (count >= friends) {
            inc++;
            var html = '<div class="additional-friends"><div class="form-group"><input type="text" placeholder="Friend\'s Name" class="form-control" name="friend_name[]"></div><div class="form-group"><input type="text" placeholder="Friend\'s Email" class="form-control friend-email" name="friend_email[]"></div></div>';
            $('.friend-box').append(html);
        }
    }

    function enter_competition() {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>competition/enter_competition",
            data: $('#competition-form').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data['status'] == 'ok') {
                    //$('#message-modal-content').html('<span class="text-success">You have successfully entered the competition.</span>');
                    //$('#anyModalFooter').modal('show');

                    // clear form and remove additional friend invite fields
                    //$('.additional-friends').remove();
                    $('#competition-form').remove();
                    //var html = '<form id="additional-friends-form"><div class="col-xs-12 friend-box"><div class="form-group"><input type="text" placeholder="Friend\'s Name" class="form-control" name="friend_name[]"></div><div class="form-group"><input type="text" placeholder="Friend\'s Email" class="form-control friend-email" name="friend_email[]"></div></div><div class="col-xs-12"><button class="btn btn-success" type="button" id="enter-additional-friends" style="float:right;">Enter</button></div></div></div><div class="col-xs-12"><button class="btn btn-success" type="button" id="additional-friends-no-thanks" style="float:right;">No Thanks</button></div></form>';
                   //$('.competition-form-wrap').append(html);
                   $('#additional-friends-form').show();
                   var html = '<input name="token" type="hidden" value="'+ data['token']+'"><input name="email" type="hidden" value="'+data['email']+'"><input name="entry_id" type="hidden" value="'+data['entry_id']+'">';
                   $('#additional-friends-form').append(html);
                } else {
                    $('#message-modal-content').html('<span class="text-danger">' + data['msg'] + '</span>');
                    $('#message-modal').modal('show');
                }
            }
        });

    }
    
    function enter_additional_friends(){
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>competition/insert_invites",
            data: $('#additional-friends-form').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data['status'] == 'ok') {
                    $('#additional-friends-form').remove();
                    $('#facebook-part').show();
                } else {
                    $('#message-modal-content').html('<span class="text-danger">' + data['msg'] + '</span>');
                    $('#anyModalFooter').modal('show');
                }
            }
        });
    }
    
    function end_part() {
        $('#message-modal-content').html('<span class="text-success">You have successfully entered the competition.</span>');
        $('#message-modal').modal('show');
    }

</script>