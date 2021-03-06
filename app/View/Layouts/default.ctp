<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Studiumdigitale - <?php echo $title_for_layout; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <?php echo $this->Html->css('bootstrap.min'); ?>
    <?php echo $this->Html->css('bootstrap-responsive.min'); ?>
    <?php echo $this->Html->css('main'); ?>
    <?php echo $this->Html->script('vendor/modernizr.custom'); ?>

    <!--[if gte IE 9]>
    <style type="text/css">
        .gradient {
            filter: none;
        }
    </style>
    <![endif]-->

    <script>
        var CAKEWORKSHOP = {
            controller: '<?php echo $this->request->params['controller']; ?>',
            action:     '<?php echo $this->request->params['action']; ?>',
            webroot:    '<?php echo $this->request->webroot; ?>'
        };
    </script>
    <?php echo $this->Html->script('vendor/require.js', array('data-main' => Router::url('/', true) . 'js/main')); ?>
    <?php echo $this->Html->script('require-config'); ?>
</head>

<body>
<!--[if lt IE 8]>
<p class="chromeframe">Ihr Webbrowser ist veraltet. <a
    href="http://browsehappy.com/">Upgrade your browser today</a> or <a
    href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.
</p>
<![endif]-->

<div id="content" class="container">
    <div id="header" class="row-fluid">
        <div class="row-fluid">
            <div class="span2 left offset1 head-logo">
                <?php echo $this->Html->image('head_logo.png'); ?>
            </div>
            <div class="right span2">
                <?php echo $this->Html->image('sd_logo_weiss.png'); ?>
            </div>
        </div>
    </div>

    <div id="navigation" class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <?php if (!$loggedIn) : ?>
                            <li data-controller="users"><?php echo $this->Html->link(__('Startseite'), array('controller' => 'users', 'action' => 'login')); ?></li>
                        <?php
                        else:
                            switch ($group):
                                case 'attendee':
                                    echo $this->element('nav_attendee');
                                    break;
                                case 'admin':
                                    echo $this->element('nav_admin');
                                    break;
                                case 'assistant':
                                    echo $this->element('nav_assistant');
                                    break;
                            endswitch;
                        endif; ?>
                    </ul>

                    <ul class="nav pull-right">
                        <?php if ($isAdmin): ?>
                            <li class="nav-search">
                                <form class="navbar-search form-search" method="POST"
                                      action="<?php echo Router::url('/admin/courses_terms/index'); ?>">
                                    <div class="input-append">
                                        <input required type="text" class="input-large search-query" name="query" placeholder="Semester-Kurs suchen"/>
                                        <button type="submit" name="submit" value="1" class="btn btn-inverse"><i class="icon-search icon-white"></i></button>
                                    </div>
                                </form>
                            </li>
                        <?php endif; ?>

                        <?php if ($loggedIn) : ?>
                            <li class="divider-vertical"></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="icon-user icon-white"></i> <?php echo $username; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><?php echo $this->Html->link(__('Mein Konto'), '/users/edit'); ?></li>
                                    <li><?php echo $this->Html->link(__('Abmelden'), '/users/logout'); ?></li>
                                    <li class="divider"></li>
                                    <li><?php echo $this->Html->link(__('Kontakt'), array('controller' => 'pages', 'action' => 'contact')); ?></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (!$loggedIn) : ?>
                            <li><?php echo $this->Html->link(__('Kontakt'), array('controller' => 'pages', 'action' => 'contact')); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>

    <div class="row-fluid">
        <div style="padding: 10px 30px;">
            <div id="messages" class="row-fluid">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
            </div>

            <?php echo $this->fetch('content'); ?>

            <?php if ($isDebug): ?>
                <div class="hero-unit">
                    <?php echo $this->element('sql_dump'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- /container -->

<div id="modalError" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3><?php echo __('Es ist ein Fehler aufgetreten'); ?></h3>
    </div>

    <div class="modal-body"></div>

    <div class="modal-footer">
        <button id="#btnSubmitError" class="btn btn-primary"
                aria-hidden="true"><?php echo __('Ja, bitte dieses Problem melden'); ?></button>
        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><?php echo __('Abbrechen'); ?></button>
    </div>
</div>
</body>
</html>