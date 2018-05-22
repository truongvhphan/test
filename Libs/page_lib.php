<?php
class Page{
    public static function createPagination($rs, $limit=5)
    {
        $pages = '<ul class="pagination">';
        $number = count($rs);
        $active_page = 0;
        if(isset($_GET['start']))
        {
            $active_page = $_GET['start'];
        }
        $num_page = ceil($number/$limit);
        for($i = 0; $i < $num_page; $i++){
            $start = $i * $limit;
            if($start != $active_page)
                $pages .= "<li class='page-item'><a class='page-link' href='?start=" . ($start) . "'>" . ($i+1) . "</a></li>";
            else
                $pages .= "<li class='page-item active'><a class='page-link' href='?start=" . ($start) . "'>" . ($i+1) . "</a></li>";
        }
        $pages .= '</ul>';
        return $pages;
    }
}
?>