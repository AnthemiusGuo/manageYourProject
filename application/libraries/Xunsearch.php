<?
require "xunsearch/lib/XS.php";
class Xunsearch {
    public $is_inited = false;
    public $limit = 50;
    public $skip = 0;

    public function __construct(){

    }

    public function init($doc_name){
        $this->doc_name = $doc_name;

        try {
            $this->xs = new XS($doc_name);
            $this->index = $this->xs->index;
            $this->is_inited = true;
        } catch (Exception $e) {
            log_message('error in xunsearch',  $e->getMessage());
        }

    }

    public function search($query,$addWeight=array(),$isAnd=false){
        $this->search = $this->xs->search;

        $this->search->setLimit($this->limit,$this->skip);
        if (!$isAnd){
            $this->search->setFuzzy();
        }

        $this->search->setQuery($query); // 设置搜索语句
        foreach ($addWeight as $key => $value) {
            $this->search->addWeight($key,$value);
        }
        $docs = $this->search->search(); // 执行搜索，将搜索结果文档保存在 $docs 数组中
        $this->count = $this->search->getLastCount();

        return $docs;
    }

    public function setDoc($data){
        // 创建文档对象
        $doc = new XSDocument;
        $doc->setFields($data);
        // 更新到索引数据库中
        $this->index->update($doc);
    }

}
