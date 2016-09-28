<?php
    $in = fopen("http://bestwhitesmile.com/wp-content/uploads/2013.zip", "rb");
    $out = fopen("2013.zip", "w+");
    echo pipe_streams($in, $out);
    function pipe_streams($in, $out)
    {
        $size = 0;
        while (!feof($in)) $size += fwrite($out,fread($in,8192));
        return $size;
    }
?>