<div class="block block-layered-nav">
    <div class="block-title">Lọc sản phẩm theo: </div>
    <div class="block-content">
        <p class="block-subtitle"><a href="<?php echo !empty($oneItem) ? getUrlCateProduct($oneItem) : '' ?>" rel="nofollow" title="Xoá lọc" class="button button-clear"><span>Xóa lọc</span></a></p>
        <dl id="narrow-by-list">
            <?php if(!empty($data_property)) foreach ($data_property as $type => $property):
                switch ($type){
                    case 'color':
                        $nameProperty = 'Màu sắc';
                        break;
                    case 'pattern':
                        $nameProperty = 'Kiểu loại';
                        break;
                    case 'resolution':
                        $nameProperty = 'Độ phân giải';
                        break;
                    case 'machine':
                        $nameProperty = 'Đời máy';
                        break;
                    case 'kind':
                        $nameProperty = 'Chủng loại';
                        break;
                    case 'quality':
                        $nameProperty = 'Chất lượng';
                        break;
                    case 'qc':
                        $nameProperty = 'Kiểm định chất lượng';
                        break;
                    case 'warranty':
                        $nameProperty = 'Bảo hành';
                        break;
                    case 'feature':
                        $nameProperty = 'Đặc tính sản phẩm';
                        break;
                    default:
                        $nameProperty = '';
                }
                if(!empty($nameProperty)):
                    ?>
                    <dt class="odd"><?php echo $nameProperty ?></dt>
                    <dd class="odd">
                        <select name="filter_<?php echo $type ?>" title="<?php echo $nameProperty ?>" class="form-control">
                            <option value="0">Tất cả</option>
                            <?php if(!empty($property)) foreach ($property as $item): ?>
                                <option value="<?php echo $item->id ?>" <?php echo $this->input->get('filter_'.$type) === $item->id ? 'selected' : '' ?>><?php echo $item->title ?></option>
                            <?php endforeach; ?>
                        </select>
                    </dd>
                <?php endif; endforeach; ?>
        </dl>
    </div>
</div>
<div class="agency">
    <div class="panel panel-danger">
        <div class="panel-heading panel-danger">
            <h4 class="panel-title">Ưu đãi dành cho đại lý</h4>
        </div>
        <div class="panel-body">
            <a href="<?php echo base_url('dieu-kien-va-chinh-sach-dai-ly.html') ?>"
               class="btn btn-warning btn-block"
               title="Điều kiện và chính sách đại lý">Điều kiện và chính sách
                đại lý</a>
            <a href="<?php echo base_url('gia-dai-ly-va-uu-dai.html') ?>"
               class="btn btn-warning btn-block"
               title="Giá đại lý và ưu đãi">Giá đại lý và ưu đãi</a>
        </div>
    </div>
</div>
<div class="side-banner">
    <?php $bannerSidebar = listBannerByPosition(3);if(!empty($bannerSidebar)) foreach ($bannerSidebar as $item): ?>
        <a href="<?php echo $item->url ?>" title="banner center home" rel="nofollow">
            <img class="hidden-xs" src="<?php echo getImageThumb($item->thumbnail,265,500,false,false) ?>" alt="banner center home">
        </a>
    <?php endforeach; ?>
</div>
