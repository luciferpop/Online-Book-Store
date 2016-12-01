<?php
//ini_set('display_errors', 'On');
// initialize shopping cart class
include 'cart.php';
$cart = new Cart;

// include database configuration file
include 'helper/dbconn.php';

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        $productID = $_REQUEST['id'];
        // get product details
        $sql = "SELECT BOOK.ISBN, Title, Price FROM BOOK, PRICE WHERE BOOK.ISBN = PRICE.ISBN AND BOOK.ISBN = '".$productID."'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $itemData = array(
                'id' => $row['ISBN'],
                'name' => $row['Title'],
                'price' => $row['Price'],
                'qty' => 1
            );
        }
        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem ? 'view_cart.php' : 'index.php';
        header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: view_cart.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0){
        // insert order details into database
        $insertOrder = $conn->query("INSERT INTO ORDERS (CUS_ID, Usrname, Total, Created, Modified) VALUES ('".$_SESSION['login_id']."', '".$_SESSION['login_name']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        if($insertOrder){
            // retruns the order id just created 
            $orderID = $conn->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO ORDER_ITEMS (ORD_ID, ISBN, Quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }
            // insert order items into database
            $insertOrderItems = $conn->multi_query($sql);
            
            if($insertOrderItems){
                $cart->destroy();
                header("Location: odr_success.php?id=$orderID");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}