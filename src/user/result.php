<?php


include_once('./includes/header.php');



include_once('./includes/header.php');
include_once('./includes/my_connection.php');


if(isset($_POST['search']) AND !empty($_POST['search'])){     
    $_POST['search']= htmlspecialchars($_POST['search']);
    $search = $_POST['search'];
    $search = strip_tags($search);
    
    $req=$connect->prepare("SELECT name, price, photo, description, category_name, parent_category_name FROM products WHERE description like '%$search%' OR name like '%$search%' OR category_name like '%$search%' OR parent_category_name like '%$search%'");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
    $result=$req->fetchAll();
    $afficher="oui";

    
}

elseif (isset($_GET['valid_AZ'])) {
    $search=$_GET['valid_AZ'];
    $req=$connect->prepare("SELECT name, price, photo, description, category_name, parent_category_name FROM products WHERE description like '%$search%' OR name like '%$search%' OR category_name like '%$search%' OR parent_category_name like '%$search%' ORDER BY name ASC");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
    $result=$req->fetchAll();
    $afficher="oui";
}

elseif (isset($_GET['valid_ZA'])) {
    $search=$_GET['valid_ZA'];
    $req=$connect->prepare("SELECT name, price, photo, description, category_name, parent_category_name FROM products WHERE description like '%$search%' OR name like '%$search%' OR category_name like '%$search%' OR parent_category_name like '%$search%' ORDER BY name DESC");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
    $result=$req->fetchAll();
    $afficher="oui";
}

elseif (isset($_GET['price_up'])) {
    $search=$_GET['price_up'];
    $req=$connect->prepare("SELECT name, price, photo, description, category_name, parent_category_name FROM products WHERE description like '%$search%' OR name like '%$search%' OR category_name like '%$search%' OR parent_category_name like '%$search%' ORDER BY price ASC");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
    $result=$req->fetchAll();
    $afficher="oui";
}
elseif (isset($_GET['price_down'])) {
    $search=$_GET['price_down'];
    $req=$connect->prepare("SELECT name, price, photo, description, category_name, parent_category_name FROM products WHERE description like '%$search%' OR name like '%$search%' OR category_name like '%$search%' OR parent_category_name like '%$search%' ORDER BY price DESC");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
    $result=$req->fetchAll();
    $afficher="oui";
}

else{
    header("location: ./index.php");
      }


?>

<body>
<form action="" method="post">
    <div class="search_bar">
        <button type="valid"><img class="loupe" src="./images/Search.png" alt="search" name="valid"></button>
        <input type="search" id="site-search" name="search" value="<?php if(isset($_POST['search'])){echo $_POST['search'];} ?>" >
       
    </div> 
    </form>
<div>
<?php  
    
        if ($afficher=="oui") {  ?>
            <div id="results">
            <div class="nbr_results"><?php echo count($result)." ".(count($result)>1?"résultats trouvés !" : "résultat trouvé !"); ?></div>
            <table class ="table_result">
                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            <form action="" method="get">
                                <button type="valid" name="valid_AZ" value ="<?php echo $search; ?>"><img class="loupe" src="./images/Search.png" alt="search"></button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="get">
                                <button type="valid" name="price_up" value = "<?php echo $search; ?>"><img class="loupe" src="./images/Search.png" alt="search"></button>
                            </form>
                        </td>
                        
                    </tr>
                <?php for($i=0;$i<count($result);$i++){ ?>
                    <tr>
                        <td>
                        <a href="shop_product.php?id=<?= $result[$i]['id'] ?>"><img src="<?php echo $result[$i]['photo']; ?>" alt="test"/></a>
                        </td>
                        <td>
                            <?php echo $result[$i]['name']; ?>
                        </td>
                        <td>
                            <?php echo $result[$i]['price'] . "&dollar;"; ?>
                        </td>
                        
                    </tr>
                <?php } ?>
                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            <form action="" method="get">
                                <button type="valid" name="valid_ZA" value = "<?php echo $search; ?>"><img class="loupe" src="./images/Search.png" alt="search"></button>
                            </form>
                        </td>
                        <td>
                            <form action="" method="get">
                                <button type="valid" name="price_down" value = "<?php echo $search; ?>"><img class="loupe" src="./images/Search.png" alt="search"></button>
                            </form>
                        </td>
                       
                    </tr>
            </table>   
        </div>
    
    
     <?php  } 
     include_once("./includes/footer.php");
     ?>  
  
</div>
</body>
</html>