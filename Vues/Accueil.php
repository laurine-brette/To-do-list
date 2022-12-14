<!doctype html>
<html lang="fr">
<head>
      <title>To do list</title>
      <meta charset="utf-8" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
      <script type="text/javascript" src="Vues/cacher.js"></script>    
</head>

<body>
  
<?php require_once("Menu.php") ?>
    
  <section style="background-color: #eee;">
  <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mt-2" methode="post">
  
    <div class="form-outline">
      <input type="text" id="form1" class="form-control" name="nomEntrerListe" required/>
      <input type="hidden" class="btn btn-primary" name="action" value="ajouterListe" > 
      <label class="form-label" for="form1">Entrez un nom de liste ici</label>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Ajouter nouvelle liste</button>
    </div>

  </form>
  </section>

<?php
    Foreach($tabListe as $liste){
      echo '
<section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-25">
    <div class="row d-flex justify-content-center align-items-center h-25">
      <div class="col col-lg-9 col-xl-7">
        <div class="card rounded-3">
          <div class="card-body p-4">

            <h4 class="text-center my-3 pb-3">'.$liste->get_nom().'</h4>

            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" methode="post">
              <div class="col-12">
                <div class="form-outline">
                  <input type="text" id="form1" class="form-control" name="nomEntrerTache" required/>
                  <input type="hidden" name="action" value="ajouterTache"> 
                  <label class="form-label" for="form1">Entrez une tâche ici</label>
                </div>

              <div class="col-12">
                <input type="hidden" name="id_liste" value="'.$liste->get_id().'">
                <button type="submit" class="btn btn-primary">Ajouter la tache</button>
              </div>

            </form>
            </div>
            <table class="table mb-4">
              <thead>
                <tr>
                  <th scope="col">N°</th>
                  <th scope="col">Nom tache</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>';
  
              Foreach($taches[$liste->get_id()] as $tacheLocal){
                echo '
                <tr>
                  <td class="text-center" style="width : 10%;"> <input type="checkbox" class="form-check-input" id="'.$tacheLocal->get_id().'" onclick="cacher('.$tacheLocal->get_id().')"></td>';
                  if($tacheLocal->get_isCoche() == true){
                    echo'
                  <td><strike> '.$tacheLocal->get_nom().'</strike> </td';}
                  else{
                    echo'
                  <td>'.$tacheLocal->get_nom().'</td>';
                  }
                  echo'
                  <td>
                    <form methode="post">
                      <input type="hidden" name="idTache" value="'.$tacheLocal->get_id().'"/>
                      <input type="hidden" name="action" value="supprimerTache"> 
                      <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    
                  </td>
                  </tr> 
                ';}

                echo'
              </tbody>
            </table>  
            <form methode="post">
              <input type="hidden" name="suppression" value="'.$liste->get_id().'"> 
              <input type="hidden" name="action" value="supprimerListe"> 
              <button type="submit" class="btn btn-danger">Supprimer Liste</button>
            </form>
          </div>
        </div>
      </div>    
    </div>   
  </div>
</section>';
    }
  ?>

</main>
</body>
</html>