<script type="text/javascript">
function submitForm(event) {
    var target = event.target;
    var buttonId = target.id;
    var myForm = document.getElementById('item-form');
    myForm.action.value = buttonId;
    myForm.submit();
    return false;
}
</script>
<?php

$session = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;

if(!$session){
    session_start();
};

$session_started = isset($_SESSION['username']);




?>
<?php
   $product = $params['product']??null;  //?? is the 'null coalescing operator'.
   $action = $params['action']??"findItem";
   $result = $params['result']??null;
   if (is_null($product)) {
       $product = new product(0, "");
   }
   $disable = (($action == "findItem")||($action == "itemForm"))?"disabled":"";
   if (!is_null($result)) {
        <<<EOT
       <div><p class="alert">$result</p></div>
EOT;
?>
<?php 
   }
   if($session_started){
    if(in_array($_SESSION['role'], ['staff'])){
        echo <<<EOT
        <form id="item-form" method="post" action="index.php">
         <fieldset>
             <label for="id">Id: </label><input type="text" name="id" id="id" placeholder="enter id" value="{$product->getId()}"/>
             <label for="description">description: </label><input type="text" name="description" id="description" placeholder="enter description" value="{$product->getDescription()}"/>
             <label for="price">price: </label><input type="text" name="price" id="price" placeholder="enter price" value="{$product->getPrice()}" />
             <label for="stock">stock: </label><input type="text" name="stock" id="stock" placeholder="enter stock"  value="{$product->getStock()}"/>
        </fieldset>
         <fieldset>
             <button type="button" id="findProduct" name="findProduct" onclick="submitForm(event);return false;">Find</button>
             <button type="button" id="product/addProduct" name="product/addProduct" onclick="submitForm(event);return false;" disabled>Add</button>
             <button type="button" id="modifyProduct" name="modifyProduct" {$disable} onclick="submitForm(event);return false;" disabled>Modify</button>
             <button type="button" id="removeProduct" name="removeProduct" {$disable} onclick="submitForm(event);return false;"disabled>Remove</button>
             <input name="action" id="action" hidden="hidden" value="add"/>
         </fieldset>
     </form>
     EOT;
    };
}; 

?>
<?php 
if($session_started){
    if(in_array($_SESSION['role'], ['admin'])){
        echo <<<EOT
        <form id="item-form" method="post" action="index.php">
         <fieldset>
             <label for="id">Id: </label><input type="text" name="id" id="id" placeholder="enter id" value="{$product->getId()}"/>
             <label for="description">description: </label><input type="text" name="description" id="description" placeholder="enter description" value="{$product->getDescription()}"/>
             <label for="price">price: </label><input type="text" name="price" id="price" placeholder="enter price" value="{$product->getPrice()}" />
             <label for="stock">stock: </label><input type="text" name="stock" id="stock" placeholder="enter stock"  value="{$product->getStock()}"/>
        </fieldset>
         <fieldset>
             <button type="button" id="findProduct" name="findProduct" onclick="submitForm(event);return false;">Find</button>
             <button type="button" id="product/addProduct" name="product/addProduct" onclick="submitForm(event);return false;" >Add</button>
             <button type="button" id="modifyProduct" name="modifyProduct" {$disable} onclick="submitForm(event);return false;" >Modify</button>
             <button type="button" id="removeProduct" name="removeProduct" {$disable} onclick="submitForm(event);return false;">Remove</button>
             <input name="action" id="action" hidden="hidden" value="add"/>
         </fieldset>
     </form>
     EOT;        
    };
}
?>