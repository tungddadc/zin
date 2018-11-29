<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 10/01/2018
 * Time: 11:31 SA
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting_model extends CI_Model
{
    private function _all_setting(){
        $dataSetting = file_get_contents(FCPATH . 'database' . DIRECTORY_SEPARATOR . 'settings.cfg');
        $data = $dataSetting ? json_decode($dataSetting, true) : array();
        return $data;
    }
    public function getAll(){
        $this->load->library(array('session'));
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $data = '';
        if(CACHE_MODE == TRUE){
            $key = '_all_setting';
            $data = $this->cache->get($key);
        }
        if(empty($data)){
            $dataSetting = $this->_all_setting();
            if (!empty($dataSetting)) foreach ($dataSetting as $key => $item) {
                if ($key === 'meta') {
                    $oneMeta = $item[$this->session->userdata('public_lang_code')];
                    if (!empty($oneMeta)) foreach ($oneMeta as $keyMeta => $value) {
                        $data[$keyMeta] = str_replace('"', '\'', $value);
                    }
                } else
                    $data[$key] = $item;
            }
        }
        if(CACHE_MODE == TRUE) $this->cache->save($key,$data,3600);
        return $data;
    }

    public function getSetting($key){
        $data = $this->getAll();
        return !empty($data[$key]) ? $data[$key] : null;
    }
}