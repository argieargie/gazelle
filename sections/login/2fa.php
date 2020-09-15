<?php View::show_header('Two-factor Authentication'); ?>
<span id="no-cookies" class="hidden warning">You appear to have cookies disabled.<br/><br/></span>
<noscript><span class="warning"><?= SITE_NAME ?> requires JavaScript to function properly. Please enable JavaScript in your browser.</span><br/><br/>
</noscript>
<?php if (strtotime($BannedUntil) >= time()) { ?>
    <span class="warning">You are banned from logging in for another <?= time_diff($BannedUntil) ?>.</span>
<?php } else { ?>
    <form class="auth_form" name="login" id="loginform" method="post" action="login.php?act=2fa">
        <?php
        if ($BannedUntil) {
            $DB->prepared_query("
                UPDATE login_attempts
                SET BannedUntil = NULL, Attempts = 0
                WHERE ID = ?
                ", $AttemptID
            );
            $Attempts = 0;
        }
        if (isset($Err)) {
            ?>
            <span class="warning"><?= $Err ?><br/><br/></span>
        <?php } ?>
        <?php if ($Attempts > 0) { ?>
            You have <span class="info"><?= (6 - $Attempts) ?></span> attempts remaining.<br/><br/>
            <strong>WARNING:</strong> You will be banned for 6 hours<br />after your login attempts run out!<br/><br/>
        <?php } ?>
<div id="logo">
<a href="/" style="margin-left: 0;"><img src="<?= STATIC_SERVER ?>/styles/public/images/loginlogo.png" alt="Orpheus Network" title="Orpheus Network" /></a>
</div>

<div style="width: 100%">
<div style="width: 35%; margin: auto;">
        <table class="layout">
            <tr>
                <td>2FA&nbsp;Key</td>
                <td colspan="2">
                    <input type="text" name="2fa" id="2fa" class="inputtext" required="required"
                           maxlength="6" pattern="[0-9]{6}" autofocus="autofocus" placeholder="Two-factor Auth Key"/>
                </td>
            </tr>

            <tr>
                <td></td>
                <td><input type="submit" name="login" value="Log in" class="submit"/></td>
            </tr>
        </table>
    </form>
    <a href="login.php?act=2fa_recovery" class="tooltip" title="Use 2FA Backup Code">Use a 2FA backup key?</a>
</div>
</div>
<?php } /* $BannedUntil in the past */ ?>

<script type="text/javascript">
    cookie.set('cookie_test', 1, 1);
    if (cookie.get('cookie_test') != null) {
        cookie.del('cookie_test');
    } else {
        $('#no-cookies').gshow();
    }
</script>
<?php
View::show_footer();
