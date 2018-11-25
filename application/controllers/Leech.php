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

    public function convertSlug(){
        $allProduct = $this->_product_model->getDataAll('',$this->_product_model->table_trans);
        if(!empty($allProduct)) foreach ($allProduct as $item){
            echo "Result update ".$this->_product_model->update(['id' => $item->id],['slug' => $this->toSlug($item->slug)],$this->_product_model->table_trans)."<br>";
        }
        die('done');
    }

    public function convertAlbumProduct(){
        $allProduct = $this->_product_model->getDataAll('',$this->_product_model->table_trans);
        if(!empty($allProduct)) foreach ($allProduct as $item){
            echo "Result update ".$this->_product_model->update(['id' => $item->id],['slug' => $this->toSlug($item->slug)],$this->_product_model->table_trans)."<br>";
        }
        die('done');
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
            $tmp['type'] = 'product';
            $this->saveCategory($tmp);
        }
        echo "done save category";
    }

    public function convertBrand(){
        $file =  MEDIA_PATH.'brands.xlsx';

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
        if(!empty($arr_data)) foreach ($arr_data as $k => $item){
            if(!empty($item['G'])){
                $tmp['title'] = $item['G'];
                $tmp['meta_title'] = $item['G'];
                $tmp['description']  = $item['G'];
                $tmp['meta_description'] = $item['G'];
                $tmp['meta_keyword'] = $item['G'];
                $tmp['parent_id'] = 0;
                $tmp['slug'] = $this->toSlug($item['G']);
                $tmp['thumbnail'] = '';
                $tmp['type'] = 'brand';
                $this->saveCategory($tmp);
            }
        }
        echo "done save category brand";
    }

    public function convertProduct(){
        $file =  MEDIA_PATH.'excel_products/products_4000.xlsx';

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
        //dump($header);
        //dump($arr_data);
        if(!empty($arr_data)) foreach ($arr_data as $item){
            $tmp['id'] = $item['A'];
            $tmp['title'] = $item['B'];
            $tmp['meta_title'] = $item['AN'];
            $tmp['description']  = $item['E'];
            $tmp['meta_description'] = $item['F'];
            $tmp['meta_keyword'] = $item['H'];
            $tmp['category_id'] = $item['AI'];
            $tmp['slug'] = $item['X'];
            $tmp['model'] = $item['C'];
            $tmp['quantity'] = $item['R'];
            $tmp['price'] = $item['N'];
            $tmp['thumbnail'] = $item['T'];
            $tmp['created_time'] = $item['Y'];
            $tmp['data_related'] = $item['AM'];
            $tmp['brand'] = $item['AH']; //Phải check slug get ID rồi lưu ID
            echo $this->saveProduct($tmp);
        }
        echo "done save product";
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
        if(!empty($item->id)) $tmp['id'] = $item->id;
        $tmp['parent_id'] = $item->parent_id;
        $tmp['is_status'] = 1;
        $tmp['thumbnail'] = $item->thumbnail;
        $tmp['type'] = $item->type;

        $category_id = $this->_category->save($tmp);
        if(!empty($category_id)){
            $this->save_language($category_id, $tmpLang, $this->_category->table_trans);
        }
        return $category_id;
    }

    private function saveProduct($item){
        $item = (object) $item;
        $tmpLang[$this->_lang_code]['title'] = $item->title;
        $tmpLang[$this->_lang_code]['meta_title'] = $item->meta_title;
        $tmpLang[$this->_lang_code]['description'] = !empty($item->description) ? $item->description : $item->meta_title;
        $tmpLang[$this->_lang_code]['meta_description'] = !empty($item->meta_description) ? $item->meta_description : $item->meta_title;
        $tmpLang[$this->_lang_code]['meta_keyword'] = $item->meta_keyword;
        $tmpLang[$this->_lang_code]['slug'] = $this->toSlug($item->slug);
        $tmp['id'] = (int)$item->id;
        $tmp['model'] = $item->model;
        $tmp['quantity'] = (int)$item->quantity;
        $tmp['price'] = $item->price;
        $tmp['created_time'] = $item->created_time;
        $tmp['thumbnail'] = $item->thumbnail;
        $tmp['brand'] = (int)$this->convertBrandnameToId($item->brand);
        $tmp['is_status'] = 1;
        $listRelated = explode(', ',$item->data_related);
        $tmp['data_similar'] = json_encode($listRelated);
        $product_id = $this->_product_model->save($tmp);
        $category_id = trim($item->category_id);
        if(!empty($product_id)){
            $this->save_language($product_id, $tmpLang, $this->_product_model->table_trans);
            if(!empty($category_id)) {
                if(strpos($category_id,',') !== FALSE){
                    $arrCate = explode(',',$category_id);
                    $data_category = [];
                    if(!empty($arrCate)) foreach ($arrCate as $cateId){
                        $tmpCate['product_id'] = $product_id;
                        $tmpCate['category_id'] = $cateId;
                        $data_category[] = $tmpCate;
                    }
                    $this->_product_model->insertMultiple($data_category,$this->_product_model->table_category);
                }else{
                    $this->_product_model->save(['product_id' => $product_id, 'category_id' => $category_id],$this->_product_model->table_category);
                }
            }
        }
        return $product_id;
    }

    private function save_language($id, $data, $table_trans){
        if(!empty($data)) foreach ($data as $lang_code => $item){
            $data_trans = array_merge($item,['id'=>$id,'language_code' => $lang_code]);

            if(!$this->_category->insert($data_trans, $table_trans)){
                die('Lỗi save language '.$table_trans);
            }
        }
    }

    private function convertBrandnameToId($title){
        $slug = $this->toSlug($title);
        $id = $this->_category->slugToId($slug);
        return $id;
    }
    public function clearCache(){
        $this->cache->clean();
    }

}