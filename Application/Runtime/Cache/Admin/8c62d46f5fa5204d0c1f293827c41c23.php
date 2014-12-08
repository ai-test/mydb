<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="<?php echo LANG_SET;?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Database-后台管理</title>
    
        <!-- css files -->
        <link rel="stylesheet" type="text/css" href="/mydb/Public/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/mydb/Public/css/ripples.min.css" />
        <link rel="stylesheet" type="text/css" href="/mydb/Public/css/material.min.css" />
        <link rel="stylesheet" type="text/css" href="/mydb/Public/css/formValidation.min.css" />
        <link rel="stylesheet" type="text/css" href="/mydb/Public/css/backend.css" />
    

    <!--[if lt IE 9]>
    <script type="text/javascript" src="/mydb/Public/html5/html5shiv.min.js"></script>
    <script type="text/javascript" src="/mydb/Public/html5/respond.min.js"></script>
    <![endif]-->

    
        <!-- script files -->
        <script type="text/javascript" src="/mydb/Public/js/jquery.min.js"></script>
        <script type="text/javascript" src="/mydb/Public/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/mydb/Public/js/formValidation.min.js"></script>
        <script type="text/javascript" src="/mydb/Public/js/framework/bootstrap.min.js"></script>
        <script type="text/javascript" src="/mydb/Public/js/ripples.min.js"></script>
        <script type="text/javascript" src="/mydb/Public/js/material.min.js"></script>
    
</head>
<body id="<?php echo (CONTROLLER_NAME); ?>_<?php echo (ACTION_NAME); ?>">







<div class="container">
    
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1>My Database</h1>
            </div>
        </div>
    </div>
    <div class="well bs-component">
        <form action="<?php echo U('Public/login');?>" method="post" class="form-horizontal" id="be-login">
            <fieldset>
                <legend>用户登录</legend>
                <div class="form-group">
                    <label class="col-md-2 control-label">用户名 或 邮件</label>

                    <div class="col-md-10">
                        <div class="form-control-wrapper">
                            <input type="text" name="username" class="form-control empty"/>
                            <span class="material-input"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">密码</label>

                    <div class="col-md-10">
                        <div class="form-control-wrapper">
                            <input type="password" name="password" class="form-control empty" autocomplete="off"/>
                            <span class="material-input"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">验证码</label>

                    <div class="col-md-10">
                        <div class="form-control-wrapper">
                            <input type="text" name="verify" class="form-control empty" autocomplete="off" maxlength="4"/>
                            <span class="material-input"></span>
                            <img class="verify-captcha" src="<?php echo U('Public/verify');?>" alt="<?php echo L('LABEL_VERIFY');?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox col-md-10 col-md-offset-2">
                        <label>
                            <input type="checkbox" name="keep"/>
                            <span class="ripple"></span>
                            <span class="check"></span>
                            记住我
                        </label>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-2">
                    <button class="btn btn-primary btn-raised" type="submit">登录</button>
                </div>
            </fieldset>
        </form>
        <div>
            <a href="#">忘记了密码？<span class="glyphicon glyphicon-arrow-right"></span></a>
        </div>
    </div>

    <script>
        $(function () {
            /**
             * bind verify captcha image click event
             */
            $(".verify-captcha").bind('click', function () {
                var captcha = $(this).attr('src');
                if (captcha.indexOf('?') > 0) {
                    $(this).attr("src", captcha + '&random=' + Math.random());
                } else {
                    $(this).attr("src", captcha.replace(/\?.*$/, '') + '?' + Math.random());
                }
            });

            $('#be-login').bootstrapValidator({
                message: '不能为空',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    username: {
                        group: '.col-md-10',
                        validators: {
                            notEmpty: {
                                message: '用户名不能为空'
                            }
                        }
                    },
                    password: {
                        group: '.col-md-10',
                        validators: {
                            notEmpty: {
                                message: '密码不能为空'
                            }
                        }
                    },
                    verify: {
                        group: '.col-md-10',
                        validators: {
                            notEmpty: {
                                message: '验证码不能为空'
                            }
                        }
                    }
                }
            }).on('success.form.bv', function (e) {
                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function (result) {
                    $('.modal-body', $('#modal')).html(result.info);
                    $('#modal').modal('show');
                    if (parseInt(result.status) == 0) {
                        setTimeout(function () {
                            $('#modal').modal('hide');
                            $(".verify-captcha").trigger('click');
                            $('input[name="verify"]').val('').trigger('focus');
                        }, 1500);
                    } else {
                        setTimeout(function () {
                            location.href = result.url;
                        }, 1500);
                    }
                }, 'json');
            });
        });
    </script>

</div> 

<footer id="footer">
</footer>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>