<?php /*
*    Pi-hole: A black hole for Internet advertisements
*    (c) 2017 Pi-hole, LLC (https://pi-hole.net)
*    Network-wide ad blocking via your own hardware.
*
*    This file is copyright under the latest version of the EUPL.
*    Please see LICENSE file for your rights under this license. */
    require "scripts/pi-hole/php/header.php";

// Generate CSRF token
if(empty($_SESSION['token'])) {
    $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
}
$token = $_SESSION['token'];

$showing = "";

if(isset($setupVars["API_QUERY_LOG_SHOW"]))
{
	if($setupVars["API_QUERY_LOG_SHOW"] === "all")
	{
		$showing = "显示";
	}
	elseif($setupVars["API_QUERY_LOG_SHOW"] === "permittedonly")
	{
		$showing = "显示已允许";
	}
	elseif($setupVars["API_QUERY_LOG_SHOW"] === "blockedonly")
	{
		$showing = "显示已阻止";
	}
	elseif($setupVars["API_QUERY_LOG_SHOW"] === "nothing")
	{
		$showing = "showing no queries (due to setting)";
	}
}
else
{
	// If filter variable is not set, we
	// automatically show all queries
	$showing = "显示";
}

$showall = false;
if(isset($_GET["all"]))
{
	$showing .= " Pi-hole 日志中的所有查询";
}
else if(isset($_GET["client"]))
{
	$showing .= " queries for client ".htmlentities($_GET["client"]);
}
else if(isset($_GET["domain"]))
{
	$showing .= " queries for domain ".htmlentities($_GET["domain"]);
}
else if(isset($_GET["from"]) || isset($_GET["until"]))
{
	$showing .= " queries within specified time interval";
}
else
{
	$showing .= "最近 100 个查询";
	$showall = true;
}

if(isset($setupVars["API_PRIVACY_MODE"]))
{
	if($setupVars["API_PRIVACY_MODE"])
	{
		// Overwrite string from above
		$showing .= "，隐私模式开启";
	}
}

if(strlen($showing) > 0)
{
	$showing = "(".$showing.")";
	if($showall)
		$showing .= ", <a href=\"?all\">显示全部</a>";
}
?>
<!-- Send PHP info to JS -->
<div id="token" hidden><?php echo $token ?></div>


<!--
<div class="row">
    <div class="col-md-12">
        <button class="btn btn-info margin-bottom pull-right">Refresh Data</button>
    </div>
</div>
-->

<!-- Alert Modal -->
<div id="alertModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="fa-stack fa-2x" style="margin-bottom: 10px">
                        <div class="alProcessing">
                            <i class="fa-stack-2x alSpinner"></i>
                        </div>
                        <div class="alSuccess" style="display: none">
                            <i class="fa fa-circle fa-stack-2x text-green"></i>
                            <i class="fa fa-check fa-stack-1x fa-inverse"></i>
                        </div>
                        <div class="alFailure" style="display: none">
                            <i class="fa fa-circle fa-stack-2x text-red"></i>
                            <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                        </div>
                    </span>
                    <div class="alProcessing">添加 <span id="alDomain"></span> 到 <span id="alList"></span>...</div>
                    <div class="alSuccess text-bold text-green" style="display: none"><span id="alDomain"></span> 成功添加到 <span id="alList"></span></div>
                    <div class="alFailure text-bold text-red" style="display: none">
                        <span id="alNetErr">超时或网络连接错误！</span>
                        <span id="alCustomErr"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="box" id="recent-queries">
        <div class="box-header with-border">
          <h3 class="box-title">最近查询 <?php echo $showing; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="all-queries" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>时间</th>
                        <th>类型</th>
                        <th>域</th>
                        <th>客户端</th>
                        <th>状态</th>
                        <th>响应</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>时间</th>
                        <th>类型</th>
                        <th>域</th>
                        <th>客户端</th>
                        <th>状态</th>
                        <th>响应</th>
                        <th>操作</th>
                    </tr>
                </tfoot>
            </table>
            <label><input type="checkbox" id="autofilter">&nbsp;当点击类型、域、客户端字段时进行过滤</label><br/>
            <button type="button" id="resetButton" hidden="true">清除过滤器</button>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>
<!-- /.row -->

<script src="scripts/vendor/moment.min.js"></script>
<script src="scripts/pi-hole/js/queries.js"></script>

<?php
    require "scripts/pi-hole/php/footer.php";
?>
