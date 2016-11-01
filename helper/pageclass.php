<?php

class page {

    private $myde_total;         
    private $myde_size;         
    private $myde_page;           
    private $myde_page_count;     
    private $myde_i;              
    private $myde_en;             
    private $myde_url;            

    private $show_pages;

    public function __construct($myde_total = 1, $myde_size = 1, $myde_page = 1, $myde_url, $show_pages = 2) {
        $this->myde_total = $this->numeric($myde_total);
        $this->myde_size = $this->numeric($myde_size);
        $this->myde_page = $this->numeric($myde_page);
        $this->myde_page_count = ceil($this->myde_total / $this->myde_size);
        $this->myde_url = $myde_url;
        if ($this->myde_total < 0)
            $this->myde_total = 0;
        if ($this->myde_page < 1)
            $this->myde_page = 1;
        if ($this->myde_page_count < 1)
            $this->myde_page_count = 1;
        if ($this->myde_page > $this->myde_page_count)
            $this->myde_page = $this->myde_page_count;
        $this->limit = ($this->myde_page - 1) * $this->myde_size;
        $this->myde_i = $this->myde_page - $show_pages;
        $this->myde_en = $this->myde_page + $show_pages;
        if ($this->myde_i < 1) {
            $this->myde_en = $this->myde_en + (1 - $this->myde_i);
            $this->myde_i = 1;
        }
        if ($this->myde_en > $this->myde_page_count) {
            $this->myde_i = $this->myde_i - ($this->myde_en - $this->myde_page_count);
            $this->myde_en = $this->myde_page_count;
        }
        if ($this->myde_i < 1)
            $this->myde_i = 1;
    }

    private function numeric($num) {
        if (strlen($num)) {
            if (!preg_match("/^[0-9]+$/", $num)) {
                $num = 1;
            } else {
                $num = substr($num, 0, 11);
            }
        } else {
            $num = 1;
        }
        return $num;
    }

    private function page_replace($page) {
        return str_replace("{page}", $page, $this->myde_url);
    }

    private function myde_home() {
        if ($this->myde_page != 1) {
            return "<a href='" . $this->page_replace(1) . "' title='First Page'>First Page</a>";
        } else {
            return "<p>First Page</p>";
        }
    }

    private function myde_prev() {
        if ($this->myde_page != 1) {
            return "<a href='" . $this->page_replace($this->myde_page - 1) . "' title='Prev'>Prev</a>";
        } else {
            return "<p>Prev</p>";
        }
    }

    private function myde_next() {
        if ($this->myde_page != $this->myde_page_count) {
            return "<a href='" . $this->page_replace($this->myde_page + 1) . "' title='Next'>Next</a>";
        } else {
            return"<p>Next</p>";
        }
    }
    /**
    private function myde_last() {
        if ($this->myde_page != $this->myde_page_count) {
            return "<a href='" . $this->page_replace($this->myde_page_count) . "' title='Last'>Last</a>";
        } else {
            return "<p>Last</p>";
        }
    }*/

    public function myde_write($id = 'page') {
        $str = "<div id=" . $id . ">";
        $str.=$this->myde_home();
        $str.=$this->myde_prev();
        if ($this->myde_i > 1) {
            $str.="<p class='pageEllipsis'>...</p>";
        }
        for ($i = $this->myde_i; $i <= $this->myde_en; $i++) {
            if ($i == $this->myde_page) {
                $str.="<a href='" . $this->page_replace($i) . "' title='Page" . $i . "' class='cur'>$i</a>";
            } else {
                $str.="<a href='" . $this->page_replace($i) . "' title='Page" . $i . "'>$i</a>";
            }
        }
        if ($this->myde_en < $this->myde_page_count) {
            $str.="<p class='pageEllipsis'>...</p>";
        }
        $str.=$this->myde_next();
        //$str.=$this->myde_last();
        //$str.="<p class='pageRemark'>Total&nbsp&nbsp<b>" . $this->myde_page_count .
                "&nbsp&nbsp</b>Pages&nbsp&nbsp<b>" . $this->myde_total . "</b>&nbsp&nbspBooks</p>";
        $str.="</div>";
        return $str;
    }

}

?>