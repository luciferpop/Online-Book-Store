<?php
ini_set('display_errors', 'On');
include_once('helper/dbconn.php');
require_once('helper/pageclass.php'); 
$showrow = 9; 
$curpage = empty($_GET['page']) ? 1 : $_GET['page'];
$url = "?page={page}"; 

//$sql = "SELECT * FROM userinfo";
$total = 265011;
if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))
    $curpage = ceil($total_rows / $showrow); 
// fetch data
$sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <style type="text/css">
            p{margin:0}
            #page{
                height:40px;
                padding:20px 0px;
            }
            #page a{
                display:block;
                float:left;
                margin-right:10px;
                padding:2px 12px;
                height:24px;
                border:1px #cccccc solid;
                background:#fff;
                text-decoration:none;
                color:#808080;
                font-size:12px;
                line-height:24px;
            }
            #page a:hover{
                color:#077ee3;
                border:1px #077ee3 solid;
            }
            #page a.cur{
                border:none;
                background:#077ee3;
                color:#fff;
            }
            #page p{
                float:left;
                padding:2px 12px;
                font-size:12px;
                height:24px;
                line-height:24px;
                color:#bbb;
                border:1px #ccc solid;
                background:#fcfcfc;
                margin-right:8px;

            }
            #page p.pageRemark{
                border-style:none;
                background:none;
                margin-right:0px;
                padding:4px 0px;
                color:#666;
            }
            #page p.pageRemark b{
                color:red;
            }
            #page p.pageEllipsis{
                border-style:none;
                background:none;
                padding:4px 0px;
                color:#808080;
            }
            .dates li {font-size: 14px;margin:20px 0}
            .dates li span{float:right}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="demo">

                <div class="showData">

                    <ul class="dates">
                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                            <li>
                                <?php echo $row['Title']; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="showPage">
                    <?php
                    if ($total > $showrow) {
                        $page = new page($total, $showrow, $curpage, $url, 2);
                        echo $page->myde_write();
                    	}
                    ?>
                </div>
            </div>
        </div>
        <div class="foot">
       </div>
    </body>
</html>