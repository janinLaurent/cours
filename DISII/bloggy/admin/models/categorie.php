<?php
function connection(){
     try{
         return new PDO('mysql:host=localhost;dbname=bloggy', 'root', '');
     } catch (Exception $ex) {
        echo  $ex->getMessage();
     }
}
function listing() {
    $db = connection();
    $sql = 'select *  from categories';
    return $db->query($sql, PDO::FETCH_ASSOC);
}

function edit($unId) {
     $db = connection();
    $sql = 'select *  from categories where idCategories='.(int) $unId;
    $st=$db->prepare($sql);
    $st->execute();
    $catAModifier=$st->fetchAll();
    return $catAModifier[0];
}

function update($unId) {
     $db = connection();
     $sql = "UPDATE categories SET nom = '".$_POST['nom']."' "
             . ", slug= '".$_POST['slug'].
             "' WHERE idCategories=".(int) $unId;
     return $db->exec($sql);
}

function delete($unId) {
     $db = connection();
     $sql = "DELETE FROM categories WHERE idCategories=".(int) $unId;
   //  var_dump($sql);die;
     return $db->exec($sql);
}

function insert(){
       $db = connection(); 
     $sql = "INSERT INTO categories (nom, slug)"
             . " values('". addslashes(htmlspecialchars($_POST['nom'])).
             "', '". addslashes(htmlspecialchars($_POST['slug']))."')";
   //  var_dump($sql);die;
     return $db->exec($sql); 
}