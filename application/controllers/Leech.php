<?php
/**
 * Created by PhpStorm.
 * User: ducto
 * Date: 11/13/2018
 * Time: 9:39 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

class Leech extends STEVEN_Controller
{
    protected $_post_model;
    protected $_product_model;
    protected $_category;
    protected $_lang_code = 'vi';

    public function __construct()
    {
        parent::__construct();
        //$this->load->library('Client');
        $this->load->model(array('post_model','product_model', 'category_model'));
        $this->_post_model = new Post_model();
        $this->_product_model = new Product_model();
        $this->_category = new Category_model();
    }

    public function convertCategory(){

        $file =  MEDIA_PATH.'categories.xlsx';

//load the excel library
        $this->load->library('phpexcel');

//read file from path

        $objPHPExcel = PHPExcel_IOFactory::load($file);
//get only the Cell Collection
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

//extract to a PHP readable array format
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

            //The header will/should be in row 1 only. of course, this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }
        if(!empty($arr_data)) foreach ($arr_data as $item){
            $tmp['id'] = $item['A'];
            $tmp['title'] = $item['B'];
            $tmp['meta_title'] = $item['P'];
            $tmp['description']  = $item['B'];
            $tmp['meta_description'] = $item['B'];
            $tmp['meta_keyword'] = $item['E'];
            $tmp['parent_id'] = $item['F'];
            $tmp['slug'] = $item['I'];
            $tmp['thumbnail'] = $item['J'];
            $this->saveCategory($tmp);
        }
        echo "done save category";
    }

    public function getChildCategory($url,$element,$parent_id = 0){
        $url = 'http://thanhchimobile.vn';
        $client = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60,
        ));
        $client->setClient($guzzleClient);
        $crawler = $client->request('GET', $url);
        $data = '';
        $crawler->filter('ul.super-menu > li > a')->each(function ($node){
            if($node->attr('href') !== '#' && $node->text() !== ''){
                $tmp['link']  = $node->attr('href');
                $tmp['title'] = trim($node->text());
                dump($tmp);
                //$this->saveCategory($tmp);
            }
        });
    }

    private function saveCategory($item){
        $item = (object) $item;
        $tmpLang[$this->_lang_code]['title'] = $item->title;
        $tmpLang[$this->_lang_code]['meta_title'] = $item->meta_title;
        $tmpLang[$this->_lang_code]['description'] = $item->description;
        $tmpLang[$this->_lang_code]['meta_description'] = $item->meta_description;
        $tmpLang[$this->_lang_code]['meta_keyword'] = $item->meta_keyword;
        $tmpLang[$this->_lang_code]['slug'] = $item->slug;
        $tmp['id'] = $item->id;
        $tmp['parent_id'] = $item->parent_id;
        $tmp['is_status'] = 1;
        $tmp['thumbnail'] = $item->thumbnail;
        if(strpos($item->thumbnail,'Thuong-hieu')  !== false) $tmp['type'] = 'brand';else $tmp['type'] = 'product';

        $category_id = $this->_category->save($tmp);
        if(!empty($category_id)){
            $this->save_language($category_id, $tmpLang, $this->_category->table_trans);
        }
        return $category_id;
    }

    private function save_language($id, $data, $table_trans){
        if(!empty($data)) foreach ($data as $lang_code => $item){
            $data_trans = array_merge($item,['id'=>$id,'language_code' => $lang_code]);

            if(!$this->_category->insert($data_trans, $table_trans)){
                die('Lỗi save language '.$table_trans);
            }
        }
    }
    public function clearCache(){
        $this->cache->clean();
    }

}