<?php
$manager = new \Chloe\Admin\Model\Manager\ArticleManager();
$articles = $manager->getArticleID($_GET['id']);
foreach ($articles as $article) { ?>

    <main class="container">

        <h1 class="center">Modifier un article</h1>

        <div class="row">
            <form action="" method="post" class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="title" name="title" type="text" class="validate" value="<?=$article->getTitle()?>">
                        <label for="title">Titre</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="picture" name="picture" type="url" class="validate" placeholder="Insérer l'url d'une image" value="<?=$article->getPicture()?>">
                        <label for="picture">Image</label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <textarea id="content" name="content" class="materialize-textarea"><?=$article->getContent()?></textarea>
                    <label for="content">Contenu</label>
                </div>

                <input id="id" name="id" type="hidden" value="<?=$article->getId()?>">
                <input id="user_fk" name="user_fk" type="hidden" value="<?=$article->getUserFk()->getId()?>">

                <input id="addArticle" class="waves-effect waves-light btn #0091ea light-blue accent-4 width_100" type="submit" value="Modifier">

            </form>
        </div>
    </main>
    <?php
}
?>