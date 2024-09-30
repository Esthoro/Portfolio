<?php $title = "EH - A propos"; ?>

<?php ob_start(); ?>

    <section>
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">A propos</h1>
          </div>
        </div>

        <div class="row mb-5">

          <div class="d-md-flex post-entry-2 half">
            <a href="#" class="me-4 thumbnail">
              <img src="/public/assets/img/illustration-icone-ordinateur.png" alt="" class="img-fluid">
            </a>
            <div class="ps-md-5 mt-4 mt-md-0">
              <h2 class="mb-4 display-4">Mon parcours</h2>
                <p>Touche-à-tout curieuse, aimant apprendre en autonomie et toujours à la recherche de nouveaux défis, c'est tout naturellement que je me suis tournée vers l'informatique.</p>
                <p>Quelle autre discipline exige-t-elle une créativité sans cesse renouvelée, en même temps qu'une grande persévérance ?</p>
                <p>Après un bac S obtenu avec 19.22 de moyenne, cinq ans d'études à distance m'ont permis d'obtenir une licence de maths-info (Université d'Aix-Marseilleà puis un master d'Informatique Avancée (Université de Franche-Comté).</p>
                <p>Forte d'une expérience professionnelle de près de deux ans, je mets maintenant mes talents de développeuse back-end (PHP, JS) à votre disposition pour, ensemble, réaliser vos rêves.</p>
            </div>
          </div>

          <div class="d-md-flex post-entry-2 half mt-5">
            <a href="#" class="me-4 thumbnail order-2">
              <img src="/public/assets/img/mission.png" alt="" class="img-fluid">
            </a>
            <div class="pe-md-5 mt-4 mt-md-0">
              <h2 class="mb-4 display-4">Mes valeurs</h2>
                <ul>
                    <li>
                        L'écoute et le respect : pour communiquer avec sérénité.
                    </li>
                    <li>
                        La rigueur : chaque détail de votre projet est pris en compte et intégré au cahier des charges, pour qu'aucun aspect de la mission, qu'il soit technique ou plus global, ne soit laissé dans le flou.
                    </li>
                    <li>
                        La transparence : des discussions en amont pour prévoir un rythme de travail selon l'ampleur du défi, et, par la suite, des réunions planifiées pour rendre compte des avancées au fur et à mesure.
                    </li>
                </ul>
            </div>
          </div>

        </div>

      </div>
    </section>

    <section>
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-12 text-center mb-5">
            <div class="row justify-content-center">
              <div class="col-lg-6">
                  <h2 class="display-4">Mes projets</h2>
                  <p>Vous trouverez ci-dessous une brève description de quelques-uns de mes projets, ainsi que les éventuels liens des sites sur lesquels j'ai travaillés.</p>
                  <p>Pour plus de détails, n'hésitez pas à <strong><a href="/contact/">me contacter</a></strong>.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 text-center mb-5">
              <a href="/public/assets/pdf/doc_utilisateur.pdf" target="_blank">
                  <img src="/public/assets/img/logoChaletsCaviar.png" alt="" class="img-fluid rounded-circle w-50 mb-4">
                  <h4>Chalets & Caviar</h4>
                  <span class="d-block mb-3 text-uppercase">Formation OpenClassrooms</span>
                  <p>Création d'un site Wordpress pour location de chalets de luxe.</p>
              </a>
          </div>
          <div class="col-lg-4 text-center mb-5">
              <a href="/public/assets/pdf/cahierDesCharges.pdf" target="_blank">
                  <img src="/public/assets/img/logoFilmsPleinAir.png" alt="" class="img-fluid rounded-circle w-50 mb-4">
                  <h4>Films de Plein Air</h4>
                  <span class="d-block mb-3 text-uppercase">Formation OpenClassrooms</span>
                  <p>Conception d'un cahier des charges et réalisation d'une maquette de site HTML/CSS from scratch.</p>
              </a>
          </div>
          <div class="col-lg-4 text-center mb-5">
            <img src="/public/assets/img/diagrammeSequenceOCajoutPlat.drawio.png" alt="" class="img-fluid rounded-circle w-50 mb-4">
            <h4>ExpressFood</h4>
            <span class="d-block mb-3 text-uppercase">Formation OpenClassrooms</span>
            <p>Conception de la structure d'une application complexe : modèles et diagrammes UML, création de la base de données.</p>
          </div>
          <div class="col-lg-4 text-center mb-5">
              <a href="https://cigoland.fr/" target="_blank">
                  <img src="/public/assets/img/logoCigoland.png" alt="" class="img-fluid rounded-circle w-50 mb-4">
                  <h4>Cigoland</h4>
                  <p>Maintenance et mise à jour du site.<br>Développement de nombreuses fonctionnalités, notamment la boutique en ligne (auparavant dépendante d'un prestataire extérieur).</p>
              </a>
          </div>
          <div class="col-lg-4 text-center mb-5">
              <a href="https://m.cigoland.fr/" target="_blank">
                <img src="/public/assets/img/launch.png" alt="" class="img-fluid rounded-circle w-50 mb-4">
                <h4>Cigo'App (PWA)</h4>
                <p>Développement complet de l'application à partir d'un CMS personnalisé.</p>
              </a>
          </div>
          <div class="col-lg-4 text-center mb-5">
              <a href="https://new.outdoordesign-alsace.fr/" target="_blank">
                  <img src="/public/assets/img/OUTDOOR-OBERNAI-LOGO-1.png" alt="" class="img-fluid rounded-circle w-50 mb-4">
                  <h4>OutdoorDesign Alsace</h4>
                  <p>Développement complet du site web à partir d'un CMS personnalisé.</p>
              </a>
          </div>
        </div>
      </div>
    </section>

<?php $content = ob_get_clean(); ?>

<?php
require('layout.php'); ?>