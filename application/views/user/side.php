<h2>Account</h2>
<ul class="list-group" id="user-sidebar">
    <?php if (!$this->ion_auth->logged_in()) {
        ?>
        <a href="/auth/login">
            <li class="list-group-item">Login</li>
        </a>
        <a href="/auth/register">
            <li class="list-group-item">Register</li>
        </a>
        <a href="/auth/forgot_password">
            <li class="list-group-item">Forgot Password</li>
        </a>
    <?php } else { ?>
        <a href="/user/">
            <li class="list-group-item">My Profile</li>
        </a>
        <a href="/user/edit">
            <li class="list-group-item">Edit Your Profile</li>
        </a>
    <?php } ?>
    <a href="/user/favourite">
        <li class="list-group-item">Bookmark</li>
    </a>
    <a href="/user/mypost">
        <li class="list-group-item">My Post</li>
    </a><!--
    <a href="/user/mycomment">
        <li class="list-group-item">My Comment</li>
    </a>-->
    <!--a href="/notification">
        <li class="list-group-item justify-content-between">Notification<span
                    class="badge badge-default badge-pill">2</span></li>
    </a-->
</ul>