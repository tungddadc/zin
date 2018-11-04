<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Public_Controller
{
    protected $cid = 0;
    protected $_data;
    protected $_data_category;
    protected $_lang_code;
    protected $_all_category;

    public function __construct()
    {
        parent::__construct();
        //tải model
        $this->load->model(['category_model', 'post_model']);
        $this->_data = new Post_model();
        $this->_data_category = new Category_model();
        //$this->session->category_type = 'post';
        //Check xem co chuyen lang hay khong thi set session lang moi
        if ($this->input->get('lang'))
            $this->_lang_code = $this->input->get('lang');
        else
            $this->_lang_code = $this->session->public_lang_code;

        if(!$this->cache->get('_all_category_'.$this->session->public_lang_code)){
            $this->cache->save('_all_category_'.$this->session->public_lang_code,$this->_data_category->getAll($this->session->public_lang_code),60*60*30);
        }
        $this->_all_category = $this->cache->get('_all_category_'.$this->session->public_lang_code);
    }

    public function ajax_log_view(){
        
    }

    public function category($id, $page = 1)
    {
        $oneItem = $this->_data_category->getById($id,'', $this->_lang_code);
        if (empty($oneItem)) show_404();

        if ($this->input->get('lang')) {
            redirect(getUrlCateNews(['slug' => $oneItem->slug, 'id' => $oneItem->id]));
        }
        $data['category'] = $oneItem;
        $data['oneParent'] = $oneParent = $this->_data_category->_recursive_one_parent($this->_all_category,$id);
        $this->_data_category->_recursive_child($this->_all_category,$oneParent->id);
        $data['list_category_child'] = $listCateChild = $this->_data_category->_list_category_child;

       /* if($oneItem->style === 'duan'){
            $idProduct = 1;
            $this->_data_category->_recursive_child($this->_all_category,$idProduct);
            $data['list_category_product'] = $this->_data_category->_list_category_child;

        }*/

        if($oneParent->style === 'hethongphanphoi'){
            $this->load->model(['partner_model','location_model']);
            $partnerModel = new Partner_model();
            $locationModel = new Location_model();
            $data['listArea'] = $this->_data_category->getAllCategoryByType($this->_lang_code, 'partner');
            
            $listCity = $partnerModel->getDataCity('');
            // dump($listCity);
            $timDaiLy = $this->input->get('tim-dai-ly');
            if(!empty($timDaiLy)){
                $data['data'] = $partnerModel->getDataPartner('', $timDaiLy);
            }else{
                $search = $this->input->get('search');
                // dd($search);
                if(!empty($listCity)) foreach ($listCity as $city){
                    $oneCity = (object)$locationModel->getCityById($city->city_id);
                    // dd($oneCity);
                    if (!empty($search)) {
                        if(strpos($this->toSlug($oneCity->name), $this->toSlug($search)) !== false){
                            $tmp['id'] = $city->city_id;
                            $tmp['title'] = $oneCity->name;
                            $data['listCity'][$city->area_id][] = $tmp;
                            // dd($data);
                        }
                    }else{
                        $tmp['id'] = $city->city_id;
                        $tmp['title'] = $oneCity->name;
                        $data['listCity'][$city->area_id][] = $tmp;
                        // dd($data);
                    }
                }
            }
            
        }else{
            /*Lay list id con của category*/
            $this->_data_category->_recursive_child_id($this->_all_category,$id);
            $listCateId = $this->_data_category->_list_category_child_id;
            /*Lay list id con của category*/

            $paramsFilter['search'] = $this->input->get('search');
            $paramsFilter['type_career'] = $this->input->get('type_career');
            $paramsFilter['address_career'] = $this->input->get('address_career');

            $limit = $this->input->get('filter_limit') ? $this->input->get('filter_limit') : 5;
            if($oneParent->style === 'album') $limit = 18;
            if($oneParent->style === 'hethongphanphoi') $limit = 18;
            $params = array(
                'is_status' => 1, //0: Huỷ, 1: Hiển thị, 2: Nháp
                'lang_code' => $this->_lang_code,
                'category_id' => $listCateId,
                'not_in' => !empty($data['data_hot'][0]->id) ? $data['data_hot'][0]->id: null,
                'limit' => $limit,
                'page' => $page
            );
            if(!empty($paramsFilter)) $params = array_merge($params,$paramsFilter);
            $data['data'] = $this->_data->getData($params);

            $data['total'] = $this->_data->getTotal($params);
            if(empty($listCateId)) $data['data'] = null;

            /*Pagination*/
            $this->load->library('pagination');
            $paging['base_url'] = getUrlCateNews(['slug' => $oneItem->slug, 'id' => $oneItem->id, 'page' => 1]);
            $paging['first_url'] = getUrlCateNews(['slug' => $oneItem->slug, 'id' => $oneItem->id]);
            $paging['total_rows'] = $data['total'];
            $paging['per_page'] = $limit;
            $paging['attributes'] = array('class'=>"");
            $this->pagination->initialize($paging);
            $data['pagination'] = $this->pagination->create_links();
            $data['max_page'] = round($data['total'] / $limit) + 1;
            /*Pagination*/
        }
        //add breadcrumbs
        $this->breadcrumbs->push("<span class='icon_house_alt'></span>", base_url());
        if($oneParent->id != 0) $this->breadcrumbs->push($oneParent->title, getUrlCateNews($oneParent));
        $this->breadcrumbs->push($oneItem->title, getUrlCateNews($oneItem));
        $data['breadcrumb'] = $this->breadcrumbs->show();
        //SEO Meta
        $data['SEO'] = [
            'meta_title' => !empty($oneItem->meta_title) ? $oneItem->meta_title : $oneItem->title,
            'meta_description' => !empty($oneItem->meta_description) ? $oneItem->meta_description : $oneItem->description,
            'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
            'url' => getUrlCateNews($oneItem),
            'image' => getImageThumb($oneItem->thumbnail, 400, 200)
        ];
        if(!empty($oneItem->style)) $layoutView = '-'.$oneItem->style;
        else $layoutView = '';
        if(!empty($timDaiLy)) $layoutView = '-search-hethongphanphoi';
        $data['main_content'] = $this->load->view($this->template_path . 'news/category'.$layoutView, $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    public function ajax_load_partner(){

        $this->load->model('partner_model');
        $partnerModel = new Partner_model();
        $params['search'] = $this->input->get('keyword');
        $params['area_id'] = $this->input->get('area_id');
        $list_showroom = $partnerModel->getData($params);
        die(json_encode($list_showroom));
    }

    public function ajax_load_partner_autocomplete(){

        $this->load->model('partner_model');
        $partnerModel = new Partner_model();
        $params['select'] = 'id, title as label, latitude, longitude, address';
        $params['search'] = $this->input->get('keyword');
        $params['area_id'] = $this->input->get('area_id');
        $list_showroom = $partnerModel->getData($params);
        die(json_encode($list_showroom));
    }

    public function detail($id)
    {
        $oneItem = $this->_data->getById($id,'', $this->_lang_code);
        $this->flushView($id,$oneItem->viewed);
        if (empty($oneItem)) show_404();
        //Check xem co chuyen lang hay khong thi redirect ve lang moi
        if ($this->input->get('lang')) {
            redirect(getUrlNews(['slug' => $oneItem->slug, 'id' => $oneItem->id]));
        }
        $data['oneCategory'] = $oneCategory = $this->_data->getOneCateIdById($id);
        $data['oneParent'] = $oneCategoryParent = $this->_data_category->_recursive_one_parent($this->_all_category,$data['oneCategory']->id);
        if(!empty($data['oneParent'])){
            $data['list_category_child'] = $this->_data_category->getCategoryChild($data['oneParent']->id,$this->session->public_lang_code);
        }
        $data['oneItem'] = $oneItem;


        $this->_data_category->_recursive_child_id($this->_all_category,$oneCategoryParent->id);
        $listCateId = $this->_data_category->_list_category_child_id;


        $params['is_status'] = 1;
        $params['lang_code'] = $this->_lang_code;
        $params['category_id'] = $listCateId;
        $params['limit'] = 4;
        $params['not_in'] = $id;
        /*Get news new*/
        $data['list_new'] = $this->_data->getData($params);
        /*Get news mostview*/
        $params['order'] = array('viewed' => 'DESC');
        $data['list_mostview'] = $this->_data->getData($params);

        /*Get news related*/

        $params['limit'] = 3;
        $data['list_related'] = $this->_data->getData($params);

        //add breadcrumbs
        $this->breadcrumbs->push($this->lang->line('home'), base_url());
        $this->_data_category->_recursive_parent($this->_all_category, $oneCategory->id);
        if(!empty($this->_data_category->_list_category_parent)) foreach (array_reverse($this->_data_category->_list_category_parent) as $item){
            $this->breadcrumbs->push($item->title, getUrlCateNews($item));
        }
        $this->breadcrumbs->push($oneItem->title, getUrlNews($oneItem));
        $data['breadcrumb'] = $this->breadcrumbs->show();
        //SEO Meta
        $data['SEO'] = [
            'meta_title' => !empty($oneItem->meta_title) ? $oneItem->meta_title : $oneItem->title,
            'meta_description' => !empty($oneItem->meta_title) ? $oneItem->meta_description : $oneItem->description,
            'meta_keyword' => !empty($oneItem->meta_title) ? $oneItem->meta_keyword : '',
            'url' => getUrlNews(['slug' => $oneItem->slug, 'id' => $oneItem->id]),
            'image' => getImageThumb($oneItem->thumbnail, 400, 200)
        ];
        if(!empty($oneCategoryParent->style)) $layoutView = '-'.$oneCategoryParent->style;
        else {
            if(!empty($oneCategory->style)) $layoutView = '-'.$oneCategory->style;
            else $layoutView = '';
        }
        $data['main_content'] = $this->load->view($this->template_path . 'news/detail'.$layoutView, $data, TRUE);
        $this->load->view($this->template_main, $data);
    }


    public function detail_partner($id)
    {
        $this->load->model(['partner_model','location_model']);
        $this->_data = new Partner_model();
        $locationModel = new Location_model();
        $oneItem = (object)$locationModel->getCityById($id);
        if (empty($oneItem)) show_404();
        $data['oneCategory'] = $oneCategory = $this->_data_category->getById(2,'',$this->_lang_code);
        $data['oneItem'] = $oneItem;

        $data['data'] = $this->_data->getDataPartner($id, $this->input->get('search'));
        //add breadcrumbs
        $this->breadcrumbs->push($this->lang->line('home'), base_url());
        $this->breadcrumbs->push($oneItem->name, getUrlCityPartner($id, $oneItem->name));
        $data['breadcrumb'] = $this->breadcrumbs->show();
        //SEO Meta
        $data['SEO'] = [
            'meta_title' => !empty($oneItem->name) ? $oneItem->name : $oneItem->name,
            'meta_description' => !empty($oneItem->name) ? $oneItem->name : $oneItem->name,
            'meta_keyword' => !empty($oneItem->name) ? $oneItem->name : '',
            'url' => getUrlCityPartner($id, $oneItem->name),
            'image' => getImageThumb('', 400, 200)
        ];
        $data['main_content'] = $this->load->view($this->template_path . 'news/detail-hethongphanphoi', $data, TRUE);
        $this->load->view($this->template_main, $data);
    }

    private function uploadCV(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('fullname', lang('text_fullname'), 'trim|required');
            $this->form_validation->set_rules('email', "Email", 'trim|required|valid_email');
            $this->form_validation->set_rules('phone', lang('form_text_phone'), 'trim|required|regex_match[/^[0-9.-]{0,18}+$/]');
            $this->form_validation->set_rules('file_cv', 'File CV', 'callback_valid_file_cv');
            //$this->form_validation->set_rules('file_letter', 'Cover letter', 'callback_valid_file_letter');
            $this->form_validation->set_rules('g-recaptcha-response', 'captcha', 'required');
            if ($this->form_validation->run() == true) {
                $fileCV = $this->input->post('email').'_cv';
                $fileCV = preg_replace('/[^a-z0-9]/i', '_', $fileCV);
                $fileCoverLetter = $this->input->post('email').'_coverletter';
                $fileCoverLetter = preg_replace('/[^a-z0-9]/i', '_', $fileCoverLetter);

                $fileNews = [
                    'file_cv' => $fileCV,
                    'file_letter' => $fileCoverLetter
                ];

                $fileNew = $this->do_upload($fileNews);

                $data = array(
                    'post_id' => $this->input->post('id'),
                    'name' => $this->input->post('fullname'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'file_cv' => 'cv/'.$fileNew['file_cv']['file_name'],
                    'file_letter' => !empty($fileNew['file_letter']['file_name']) ? 'cv/'.$fileNew['file_letter']['file_name']: ''
                );

                $this->load->model('career_model');
                $ungtuyenModel = new Career_model();
                if($ungtuyenModel->save($data)){
                    $message['type'] = 'success';
                    $message['message'] = "Gửi thông tin ứng tuyển thành công !";
                    $this->session->set_flashdata('message', $message);
                    $this->sendMailApply($this->input->post());
                }else{
                    $message['type'] = 'error';
                    $message['message'] = "Bạn đã ứng tuyển rồi !";
                    $this->session->set_flashdata('message', $message);
                }
                log_message('error', 'return.... ');
                redirect(uri_string());
            }

        }
    }

    public function valid_file_cv(){
        $allowed_mime_type_arr = array('application/msword', 'application/vnd.ms-office','application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword', 'application/x-zip','application/pdf', 'application/force-download', 'application/x-download', 'binary/octet-stream');
        $mime = get_mime_by_extension($_FILES['file_cv']['name']);
        if(isset($_FILES['file_cv']['name']) && $_FILES['file_cv']['name']!=""){
            if(!in_array($mime, $allowed_mime_type_arr)){
                $this->form_validation->set_message('valid_file_cv', 'Vui lòng chọn file CV PDF or Doc, Docx !');
                return false;
            }
            if(isset($_FILES['file_cv']['size']) && $_FILES['file_cv']['size'] > 5128931){
                log_message('error','FILE SIZE: '.$_FILES['file_cv']['size']);
                $this->form_validation->set_message('valid_file_cv', 'Vui lòng chọn file CV nhỏ hơn 5012 KB !');
                return false;
            }else return true;

        }else{
            $this->form_validation->set_message('valid_file_cv', 'Vui lòng chọn file CV để upload !');
            return false;
        }
        return true;
    }

    public function valid_file_letter(){
        $allowed_mime_type_arr = array('application/msword', 'application/vnd.ms-office','application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword', 'application/x-zip','application/pdf', 'application/force-download', 'application/x-download', 'binary/octet-stream');
        $mime = get_mime_by_extension($_FILES['file_letter']['name']);
        if(isset($_FILES['file_letter']['name']) && $_FILES['file_letter']['name']!=""){
            if(!in_array($mime, $allowed_mime_type_arr)){
                $this->form_validation->set_message('valid_file_letter', 'Vui lòng chọn cover letter PDF or Doc, Docx !');
                return false;
            }
            if(isset($_FILES['file_letter']['size']) && $_FILES['file_letter']['size'] > 5128931){
                $this->form_validation->set_message('valid_file_letter', 'Vui lòng chọn cover letter nhỏ hơn 5012 KB !');
                return false;
            }else return true;
        }else{
            $this->form_validation->set_message('valid_file_letter', 'Vui lòng chọn cover letter để upload !');
            return false;
        }
        return true;
    }


    private function do_upload($rename = array()){
        $this->load->library('upload');

        $files = $_FILES;
        $data = array();
        $data['error'] = true;
        $data['message'] = '';
        foreach ($files as $key => $file){
            if(!empty($files[$key]['name'])){
                $_FILES['files']['name']= $files[$key]['name'];
                $_FILES['files']['type']= $files[$key]['type'];
                $_FILES['files']['tmp_name']= $files[$key]['tmp_name'];
                $_FILES['files']['error']= $files[$key]['error'];
                $_FILES['files']['size']= $files[$key]['size'];

                $this->upload->initialize($this->set_upload_options($rename[$key]));
                if (!$this->upload->do_upload($key)) {
                    $error = $this->upload->display_errors();
                    log_message('error',json_encode($error));
                    $message['type'] = 'error';
                    $message['message'] = $error;
                    $this->session->set_flashdata('message', $message);
                    redirect(uri_string());
                }
                $data[$key] = $this->upload->data();
            }
        }
        return $data;
    }

    private function set_upload_options($rename){
        $path = MEDIA_PATH.'/cv/';
        if(!is_dir($path)){
            mkdir($path, 0755, TRUE);
        }

        $config['upload_path']          = MEDIA_PATH.'/cv/';
        $config['file_name']            = $rename;
        $config['overwrite']            = TRUE;
        $config['allowed_types']        = 'pdf|csv|doc|docx';
        $config['max_size']             = 5000;
        return $config;
    }

    private function sendMailApply($data){
        $this->load->library('email');
        $emailTo = $data['email'];
        $emailToCC = $this->settings['contact'][$this->session->public_lang_code]['email'];
        //$emailToCC = 'ductoan1991@outlook.com';

        $emailFrom = $this->settings['email_admin'];


        $message = '<strong>Thông tin ứng viên: </strong>' . "\n";

        $message .= "<p>Họ và tên: {$data['fullname']}</p>";

        $message .= '<p>Email: ' . $data['email'] . "</p>";

        $message .= '<p>Điện thoại: ' . $data['phone'] . "</p>";

        $message .= "<p>Trân trọng, </p>";

        $this->email->from($emailFrom, $this->settings['name']);

        $this->email->to($emailTo);
        if (!empty($emailToCC)) $this->email->cc($emailToCC);
        if (!empty($emailToBCC)) $this->email->bcc($emailToBCC);

        $this->email->subject(html_entity_decode('Job: ' . $data['title'] . ' - ' . $data['fullname'], ENT_QUOTES, 'UTF-8'));
        $this->email->message($message);
        if (!$this->email->send()) {
            $error = $this->email->print_debugger(array('headers'));
            log_message('error',$error);
        }
    }

    private function flushView($id, $view){
        $this->_data->update(array('id' => $id),array('viewed'=>$view+1));
    }




}
