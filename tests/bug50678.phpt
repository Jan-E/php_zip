--TEST--
Bug #50678 (files extracted by ZipArchive class lost their original modified time)
--SKIPIF--
<?php
if (!extension_loaded('zip')) die('skip zip extension not available');
?>
--FILE--
<?php
$filename = __DIR__ . '/test.zip';
$dirname = __DIR__ . '/bug50678';

@mkdir($dirname);

$zip = new ZipArchive();
$zip->open($filename);
$zip->extractTo($dirname);
$zip->close();

var_dump(date('Ymd', filemtime($dirname . '/entry1.txt')));
?>
Done
--EXPECT--
string(8) "20060706"
Done
--CLEAN--
<?php
include __DIR__ . '/utils.inc';
rmdir_rf(__DIR__ . '/bug50678');
?>
