<h2>Méthode avec le DAO</h2>

<p>Récupérer l'ensemble des noms de la table 'Fields' :</p>
<?php
    foreach($testDao as $te){
    	var_dump($te->name);
    }
?>

<hr />

<p>Récupérer l'enregistrement qui a pour nom 'Test' :</p>

<?php var_dump($testDao2); ?>
