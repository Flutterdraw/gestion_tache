<h1 class="mt-4">Tableau de bord</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Statistiques Globales</li>
</ol>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4 shadow">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="small text-white-50">Total des tâches</div>
                    <div class="display-6 fw-bold"><?= $totalTaches ?></div>
                </div>
                <i class="fas fa-tasks fa-2x text-white-50"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between small">
                <a class="text-white stretched-link" href="index.php?page=accueil">Voir les détails</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4 shadow">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="small text-white-50">Tâches terminées</div>
                    <div class="display-6 fw-bold"><?= $tachesTerminees ?></div>
                </div>
                <i class="fas fa-check-circle fa-2x text-white-50"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between small">
                <span class="text-white">Taux de complétion : <?= $pourcentageTermine ?>%</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white mb-4 shadow">
            <div class="card-body">
                <div class="small text-white-50 mb-2">Progression globale</div>
                <div class="display-6 fw-bold mb-2"><?= $pourcentageTermine ?>%</div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-white" role="progressbar" style="width: <?= $pourcentageTermine ?>%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4 shadow">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="small text-white-50">Tâches en retard</div>
                    <div class="display-6 fw-bold"><?= $tachesEnRetard ?></div>
                </div>
                <i class="fas fa-exclamation-triangle fa-2x text-white-50"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between small">
                <a class="text-white stretched-link" href="index.php?page=accueil">Urgent : voir les retards</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>
</div>

<?php if ($tachesEnRetard > 0): ?>
<div class="alert alert-warning border-left-warning shadow" role="alert">
    <strong>Attention :</strong> Vous avez <?= $tachesEnRetard ?> tâche(s) dont la date limite est dépassée et qui ne sont pas encore terminées.
</div>
<?php endif; ?>