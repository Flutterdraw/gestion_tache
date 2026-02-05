<h1 class="mt-4">Bienvenue !</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Liste actuelle des missions</li>
</ol>

<?php if ($tachesEnRetard > 0): ?>
    <div class="alert alert-danger shadow">
        <i class="fas fa-exclamation-triangle"></i> 
        <strong>Attention :</strong> <?= $tachesEnRetard ?> tâche(s) sont en retard !
    </div>
<?php endif; ?>

<div class="card mb-4 border-0 bg-light">
    <div class="card-body">
        <form class="row g-3" method="GET" action="index.php">
            <input type="hidden" name="page" value="accueil">
            <div class="col-md-4">
                <input type="text" name="motcle" class="form-control" placeholder="Rechercher par titre..." value="<?= htmlspecialchars($motcle) ?>">
            </div>
            <div class="col-md-3">
                <select name="fstatut" class="form-select">
                    <option value="">Tous les statuts</option>
                    <option value="à faire" <?= $fstatut == 'à faire' ? 'selected' : '' ?>>À faire</option>
                    <option value="en cours" <?= $fstatut == 'en cours' ? 'selected' : '' ?>>En cours</option>
                    <option value="terminée" <?= $fstatut == 'terminée' ? 'selected' : '' ?>>Terminée</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="fprio" class="form-select">
                    <option value="">Tous les priorités</option>
                    <option value="basse" <?= $fprio == 'basse' ? 'selected' : '' ?>>Basse</option>
                    <option value="moyenne" <?= $fprio == 'moyenne' ? 'selected' : '' ?>>Moyenne</option>
                    <option value="haute" <?= $fprio == 'haute' ? 'selected' : '' ?>>Haute</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
            </div>
            <?php if($motcle || $fstatut || $fprio): ?>
                <div class="col-md-2">
                    <a href="index.php?page=accueil" class="btn btn-outline-secondary w-100">Réinitialiser</a>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Priorité</th>
                        <th>Échéance</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($taches)): ?>
                        <?php foreach ($taches as $tache): 
                            $retard = ($tache['statut'] !== 'terminée' && !empty($tache['date_limite']) && $tache['date_limite'] < $aujourdhui);
                        ?>
                        <tr class="<?= $retard ? 'table-danger' : '' ?>">
                            <td class="text-muted small">#<?= $tache['ID'] ?></td>
                            <td><strong><?= htmlspecialchars($tache['titre']) ?></strong></td>
                            <td><i><?= htmlspecialchars($tache['description']) ?></i></td>
                            <td>
                                <span class="badge <?= $tache['priorite'] == 'haute' ? 'bg-danger' : ($tache['priorite'] == 'moyenne' ? 'bg-warning text-dark' : 'bg-info') ?>">
                                    <?= ucfirst($tache['priorite']) ?>
                                </span>
                            </td>
                            <td>
                                <i class="far fa-calendar-alt me-1"></i>
                                <?= date('d/m/Y', strtotime($tache['date_limite'])) ?>
                            </td>
                            <td>
                                <a href="treatments/action.php?action=statut&id=<?= $tache['ID'] ?>" class="text-decoration-none" title="Changer le statut">
                                    <span class="badge <?= $tache['statut'] == 'terminée' ? 'bg-success' : ($tache['statut'] == 'en cours' ? 'bg-primary' : 'bg-secondary') ?>">
                                        <?= $tache['statut'] ?>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fas fa-search me-2"></i> Aucune tâche ne correspond à votre recherche.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>