<html>
<body>
Hi <?=$identity?>,<br/><br/>
Thank you for registering with TripTmr.com.<br/>
Please click on the following link to verify your email and activate your account.<br/><br/>
<a href="<?=base_url().'auth/activate/' . $id . '/' . $activation?>"><?=lang('email_activate_link')?></a><br/><br/>
Best regards,<br/>
TripTmr<br/>

</body>
</html>