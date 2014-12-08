<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2014/11/27
 * Time: 22:21
 */


/**
 * @param $inCode
 * @param int $id
 * @return bool
 */
function check_verify($inCode, $id = 1)
{
    $theVerify = new \Think\Verify();
    return $theVerify->check($inCode, $id);
}

/**
 * @param $inString
 * @param string $inKey
 * @return string
 */
function sys_md5($inString, $inKey = '')
{
    $theKey = $inKey . C('DATA_AUTH_KEY');
    return md5(sha1($inString) . $theKey);
}

/**
 * @param $inFile
 * @return string
 */
function read_file($inFile)
{
    // if file null return
    if (!file_exists($inFile)) {
        return false;
    }

    if (function_exists('file_get_contents')) {
        return file_get_contents($inFile);
    }

    if (!$theFP = fopen($inFile, 'rb')) {
        return false;
    }

    flock($theFP, LOCK_SH);
    $theData = '';

    if (($theFileSize = filesize($inFile)) > 0) {
        $theData = &fread($theFP, $theFileSize);
    }

    flock($theFP, LOCK_UN);
    fclose($theFP);
    return $theData;
}