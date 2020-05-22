<?php /*
*    Pi-hole: A black hole for Internet advertisements
*    (c) 2017 Pi-hole, LLC (https://pi-hole.net)
*    Network-wide ad blocking via your own hardware.
*
*    This file is copyright under the latest version of the EUPL.
*    Please see LICENSE file for your rights under this license. */
    require "scripts/pi-hole/php/header.php";
?>
<!-- Title -->
<div class="page-header">
    <h1>生成调试日志</h1>
</div>

<p><input type="checkbox" id="upload"> 上传调试日志并在完成后提供令牌</p>
<p>单击此按钮后，如果我们检测到 Internet 连接正常，将生成调试日志并自动上传。</p>
<button class="btn btn-lg btn-primary btn-block" id="debugBtn">生成调试日志</button>
<pre id="output" style="width: 100%; height: 100%;" hidden="true"></pre>

<script src="scripts/pi-hole/js/debug.js"></script>

<?php
    require "scripts/pi-hole/php/footer.php";
?>
