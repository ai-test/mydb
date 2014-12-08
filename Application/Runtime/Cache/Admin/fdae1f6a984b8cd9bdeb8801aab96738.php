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



    <div class="bs-docs-section clearfix container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bs-component">
                    <div class="navbar navbar-inverse">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo U('Index/index');?>">My Database</a>
                        </div>
                        <div class="navbar-collapse collapse navbar-inverse-collapse">
                            <ul class="nav navbar-nav">
                                <li <?php if($Think.CONTROLLER_NAME == 'Index' && $Think.ACTION_NAME == 'index') echo 'class="active"'; ?>><a href="<?php echo U('Index/index');?>">首页</a></li>
                                <li <?php if($Think.CONTROLLER_NAME == 'Db') echo 'class="active"'; ?>><a href="<?php echo U('Db/index');?>">数据库导入</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a><?php echo (session('be_user')); ?>，您好！</a></li>
                                <li><a href="<?php echo U('Public/logout');?>">退出登录</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">菜单 <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo U('Index/profile');?>">个人信息</a></li>
                                        <li><a href="<?php echo U('Index/password');?>">修改密码</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<div class="container">
    
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1>数据库导入</h1>
            </div>
        </div>
    </div>

    <div class="well bs-component">
        <form action="<?php echo U('Db/import');?>" method="post" class="form-horizontal" id="file-import" enctype="multipart/form-data">
            <fieldset>
                <legend>文件上传</legend>
                <div class="form-group">
                    <label class="col-md-2 control-label">文件</label>

                    <div class="col-md-10">
                        <input type="file" name="db">
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-2">
                    <button class="btn btn-primary" type="submit">上传</button>
                </div>
            </fieldset>
        </form>
    </div>

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