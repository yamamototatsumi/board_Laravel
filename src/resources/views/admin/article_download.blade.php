<?php
 /* ダウンロード用のHTTPヘッダー送信 */
header("Content-Disposition: inline; filename=\"".basename($path_file)."\"");
header("Content-Length: ".$content_length);
header("Content-Type: application/octet-stream");
?>