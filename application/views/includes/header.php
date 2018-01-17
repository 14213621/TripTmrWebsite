<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TripTmr | Let's have Trip Tomorrow</title>
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<header class="header">
    <div class="container">
        <div class="col-xs-12">
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#header-panel" aria-controls="header-panel" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="header-panel">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item  ">
                            <a class="nav-link" href="/main/welcome">Welcome <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item  ">
                            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/user/favourite">My Bookmark</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#"
                               id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <?php
                                $user = null;
                                if ($this->ion_auth->logged_in()) {
                                    $user = $this->ion_auth->user()->row();
                                    echo $user->username;
                                } else {
                                    echo "My Account";
                                }
                                ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <?php if (!$this->ion_auth->logged_in()) { ?>
                                    <a class="dropdown-item" href="<?= base_url() ?>auth/register">Register</a>
                                    <a class="dropdown-item" href="<?= base_url() ?>auth">Login</a>
                                <?php } else {
                                    ?>
                                    <a class="dropdown-item" href="<?= base_url() ?>user/<?= $user->user_id ?>">View
                                        Profile</a>
                                    <a class="dropdown-item" href="<?= base_url() ?>auth/logout">Logout</a>
                                <?php } ?>
                            </div>
                        </li>
                    </ul>
                    <script>

                        function getSearchHints(text) {
                            console.log("searching: " + text);
                            $.ajax({
                                type: "get",
                                url: "/search?k=" + text + "&<?php echo $this->security->get_csrf_token_name()?>=<?php echo $this->security->get_csrf_hash(); ?>",
                                timeout: 10000,
                                dataType: "json",
                                success: function (data) {
                                    var script = '';
                                    $(".searchbox").html('');
                                    for (var i = 0; i < data.length; i++) {
                                        script += '<a href="' + data[i].herf + '" ><li>' + (data[i].name).replace(new RegExp($("#search input").val(), 'g'), "<mark>" + $("#search input").val() + "</mark>") + '<span class="float-right">' + data[i].type + '</span></li></a>';
                                    }
                                    $(".searchbox").append(script);
                                }
                            })
                        }
                    </script>
                    <div id="search" class="search my-1">
                        <input name="search" value="" placeholder="Search" type="text">
                        <ul class="searchbox">
                            <a href="#" disabled="">
                                <li>Please enter keywords.</li>
                            </a>
                        </ul>
                        <button type="button" class="button-search"><i class="fa fa-search"></i></button>
                        <div class="clear"></div>
                    </div>
                    <div>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com"
                                   id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    HKD
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">HKD</a>
                                    <!--<a class="dropdown-item" href="#">HK</a>-->
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="logo" class="logo">
                    <a class="navbar-brand" href="<?= base_url() ?>"><img class="nav-logo"
                                                                          src="/vendor/img/triptmr_vertical.svg"
                                                                          width="270"
                                                                          height="80"
                                                                          alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <div id="header-menu" class="my-2">
        <div class="container">
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <!--
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Spotlight</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">News</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Week Trip</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Latest</a>
                        </li>-->
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="/post">Explore+</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="/post/create">Create Trip</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav social-list">
                        <li>
                            <a class="nav-link fa fa-facebook-square" href="//www.facebook.com/"></a>
                        </li>
                        <li>
                            <a class="nav-link fa fa-twitter" href="//twitter.com/"></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>