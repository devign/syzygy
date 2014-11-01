<?php
class MediaCollection extends Collection {
    public $collection;
    
    public function __construct($sku) {
        parent::__construct();  
        $count_media = Media::getTotalExisting($sku);
        
        for ($i=1;$i<$count_media+1;$i++) {
            $media = new Media($sku, $i);
            $this->add($media);
        }
    }
    

}
?>
