<?php

// Set Environment Variables
function setEnv($key, $value)
{
    file_put_contents(app()->environmentFilePath(), str_replace(
        $key . '=' . env($key),
        $key . '=' . $value,
        file_get_contents(app()->environmentFilePath())
    ));
}