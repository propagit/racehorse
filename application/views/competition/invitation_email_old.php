<table border="0" cellpadding="0" cellspacing="0" class="body" width="600" style="margin-bottom: 20px">
    <tbody>
    <tr>
        <td style="width: 100%;">
            <p style="padding:20px; margin: 0; color: #000; font-size: 14px; font-family:Arial, sans-serif;">
            	Dear <?php echo ucwords($invitee_firstname); ?>,<br/><br/>
                
                I'm spreading the word about the Race Horse Competiton. I thought you would like to enter too!<br><br>
                
                Thanks, <br>
                <?php echo ucwords($inviter_firstname); ?>
           </p>
        </td>
    </tr>
    <tr>    
        <td style="width: 100%;text-align:left; padding:20px;">
            <a href="<?=base_url();?>competition/entry/<?=$token;?>" target="_blank">
                Join
            </a>
        </td>
    </tr>
    </tbody>
</table>