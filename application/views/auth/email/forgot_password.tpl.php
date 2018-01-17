<html>
<body>
Hello <?= $identity ?>, <br/><br/>
We have just received your request for resetting your password.<br/>
Please click the following link to reset your password.<br/>
<br/>
<a href="<?= base_url() . "auth/reset_password/" . $forgotten_password_code ?>"><?= lang('email_forgot_password_link') ?></a>
<br/><br/>
Please contact our IT administrator (Tel: 67698702) immediately if you have any problem.<br/>
Thank you for using TripTmr.com<br/><br/>
Best regards,<br/>
TripTmr
</body>
</html>