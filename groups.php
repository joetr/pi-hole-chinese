<?php /*
*    Pi-hole: A black hole for Internet advertisements
*    (c) 2019 Pi-hole, LLC (https://pi-hole.net)
*    Network-wide ad blocking via your own hardware.
*
*    This file is copyright under the latest version of the EUPL.
*    Please see LICENSE file for your rights under this license. */
    require "scripts/pi-hole/php/header.php";
?>

<!-- Title -->
<div class="page-header">
    <h1>群组</h1>
</div>

<!-- Group Input -->
<div class="row">
    <div class="col-md-12">
        <div class="box" id="add-group">
            <!-- /.box-header -->
            <div class="box-header with-border">
                <h3 class="box-title">
                    添加一个新的群组
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="new_name">名称：</label>
                        <input id="new_name" type="text" class="form-control" placeholder="群组名称">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="new_desc">注释：</label>
                        <input id="new_desc" type="text" class="form-control" placeholder="群组描述（可选项）">
                    </div>
                </div>
            </div>
            <div class="box-footer clearfix">
                <button id="btnAdd" class="btn btn-primary pull-right">添加</button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box" id="groups-list">
            <div class="box-header with-border">
                <h3 class="box-title">
                    已经配置的群组列表
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="groupsTable" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>名称</th>
                        <th>状态</th>
                        <th>注释</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                </table>
                <button type="button" id="resetButton" hidden="true">重置排序</button>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<script src="scripts/pi-hole/js/groups-common.js"></script>
<script src="scripts/pi-hole/js/groups.js"></script>

<?php
require "scripts/pi-hole/php/footer.php";
?>
