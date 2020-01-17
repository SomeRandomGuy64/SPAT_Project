<?php
require_once ('Dataset.php');
class pagination {

    public function __construct() {

    }

    public function getNoOfData() {
        $DataSet = new DataSet();
        return $DataSet->getNoOfPOI();
    }

    public function getDataPerPage() {
        return 10;
    }

    public function getNoOfPages() {
        return ceil($this->getNoOfData()/$this->getDataPerPage());
    }

    public function getCurrentPageNo() {
        $currentPage = 0;
        if (isset($_GET['page']) == "" || $_GET['page'] == 1) {
            $currentPage = 1;
        } else {
            $currentPage = $_GET['page'];
        }
        return $currentPage;
    }

    public function getOffset() {
        $offset = ($this->getCurrentPageNo()-1)*$this->getDataPerPage();
        return $offset;
    }

    public function pagingDiv() {
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination">';
        for ($i = 1; $i <= $this->getNoOfPages(); $i++) {
            if ($i == $this->getCurrentPageNo()) {
                echo '<li class="page-item"></li><a class="active">'.$i.'</a></li>';
            } else {
                echo '<li class="page-item"><a href="../Controllers/pointOfInterest.php?page='.$i.'">'.$i.'</a></li>';
            }
        }
        echo '</ul></nav>';
    }




}
