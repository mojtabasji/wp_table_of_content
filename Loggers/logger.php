<?php

namespace tableManagement\Loggers;

class logger
{
    public function log(string $message): void
    {
        $file = fopen(plugin_dir_path(__FILE__) . 'log.txt', 'a');
        $date = date('Y-m-d H:i:s');
        fwrite($file, "$date: $message\n");
        fclose($file);
    }
}
