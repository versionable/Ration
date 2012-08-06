<?php

namespace Versionable\Ration\Stream;

/**
 * Dummy stream wrapper for unit tests
 *
 * @author Harry Walter <harry.walter@lqdinternet.com>
 */
class TestWrapper
{
    const SCHEME = 'test';
    
    public $context;
    
    public function dir_closedir()
    {
        return true;
    }
    
    public function dir_opendir($path, $options)
    {
        return true;
    }
    
    public function dir_readdir()
    {
        return '';
    }
    
    public function dir_rewinddir()
    {
        return true;
    }
    
    public function mkdir($path, $mode, $options)
    {
        return true;
    }
    
    public function rename($path_from , $path_to)
    {
        return true;
    }
    
    public function rmdir($path, $options)
    {
        return true;
    }
    
    public function stream_cast($cast_as)
    {
        return false;
    }
    
    public function stream_close()
    { }
    
    public function stream_eof()
    {
        return true;
    }
    
    public function stream_flush()
    {
        return true;
    }
    
    public function stream_lock($operation)
    {
        return true;
    }
    
    public function stream_metadata($path, $option, $var)
    {
        return true;
    }
    
    public function stream_open($path, $mode , $options , &$opened_path)
    {
        return true;
    }
    
    public function stream_read($count)
    {
        return '';
    }
    
    public function stream_seek($offset, $whence = SEEK_SET)
    {
        return true;
    }
    
    public function stream_set_option($option, $arg1, $arg2)
    {
        return true;
    }
    
    public function stream_stat()
    {
        return array();
    }
    
    public function stream_tell()
    {
        return 1;
    }
    
    public function stream_truncate($new_size)
    {
        return true;
    }
    
    public function stream_write($data)
    {
        return 1;
    }
    
    public function unlink($path)
    {
        return true;
    }
    
    public function url_stat($path, $flags)
    {
        return array();
    }
}
