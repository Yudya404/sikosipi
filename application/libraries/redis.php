<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redis {
    protected $redis;

    public function __construct() {
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }

    public function set($key, $value, $expire = 0) {
        $this->redis->set($key, $value);
        if ($expire > 0) {
            $this->redis->expire($key, $expire);
        }
    }

    public function get($key) {
        return $this->redis->get($key);
    }

    public function delete($key) {
        $this->redis->del($key);
    }

    public function exists($key) {
        return $this->redis->exists($key);
    }
}
