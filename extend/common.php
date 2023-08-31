<?php

function device()
{
    if (
        strstr($_SERVER['HTTP_USER_AGENT'], 'Windows NT') && !strstr($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')
    ) {
        return 'windows';
    } elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Mac OS') && !strstr($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
        return 'mac';
    } elseif (
        strstr($_SERVER['HTTP_USER_AGENT'], 'Windows NT') && strstr($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')
    ) {
        return 'windowsWechat';
    } elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Mac OS') && strstr($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
        return 'macWechat';
    }
    return 'unknown';
}
