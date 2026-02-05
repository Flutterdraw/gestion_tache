<h1 class="mt-4 text-center">Gestion des Tâches</h1>
<hr>

<div class="row">
    <div class="col-xl-4 col-md-5">
        <div class="card shadow mb-4">
            <div class="fs-5 fw-bold text-center card-header <?= $tache_a_modifier ? 'bg-warning text-dark' : 'bg-primary text-white' ?>">
                <?= $tache_a_modifier ? "Modifier la tâche" : "Nouvelle tâche" ?>
            </div>
            <div class="card-body">
                <form method="POST" action="treatments/action.php">
                    <input type="hidden" name="action" value="<?= $tache_a_modifier ? 'modifier' : 'ajouter' ?>">
                    <?php if ($tache_a_modifier): ?>
                        <input type="hidden" name="id" value="<?= $tache_a_modifier['ID'] ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Titre</label>
                        <input type="text" class="form-control" name="titre" required value="<?= htmlspecialchars($tache_a_modifier['titre'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea class="form-control" name="description" rows="2"><?= htmlspecialchars($tache_a_modifier['description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Priorité</label>
                        <select class="form-select" name="priorite">
                            <?php $prio = $tache_a_modifier['priorite'] ?? ''; ?>
                            <option value="basse" <?= $prio == "basse" ? "selected" : "" ?>>Basse</option>
                            <option value="moyenne" <?= $prio == "moyenne" ? "selected" : "" ?>>Moyenne</option>
                            <option value="haute" <?= $prio == "haute" ? "selected" : "" ?>>Haute</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Date limite</label>
                        <input type="date" class="form-control" name="datel" required value="<?= $tache_a_modifier['date_limite'] ?? '' ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Responsable</label>
                        <input type="text" class="form-control" name="responsable" required value="<?= htmlspecialchars($tache_a_modifier['responsable'] ?? '') ?>">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn <?= $tache_a_modifier ? 'btn-warning' : 'btn-success' ?>">
                            <?= $tache_a_modifier ? "Mettre à jour" : "Ajouter" ?>
                        </button>
                        <?php if ($tache_a_modifier): ?>
                            <a href="index.php?page=indexTache" class="btn btn-secondary btn-sm text-center">Annuler la modification</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-md-7">
        <div class="card shadow mb-4">
            <div class="card-header bg-dark text-white">
                Liste de gestion
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Titre</th>
                                <th>Responsable</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($taches)): ?>
                                <?php foreach ($taches as $tache): ?>
                                    <tr>
                                        <td><?= $tache['ID'] ?></td>
                                        <td><strong><?= htmlspecialchars($tache['titre']) ?></strong></td>
                                        <td><?= htmlspecialchars($tache['responsable']) ?></td>
                                        <td>
                                            <span class="badge <?= $tache['statut'] == 'terminée' ? 'bg-success' : 'bg-secondary' ?>">
                                                <?= $tache['statut'] ?>
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <?php if ($tache['statut'] !== 'terminée'): ?>
                                                <a href="index.php?page=indexTache&modifier=<?= $tache['ID'] ?>" class="btn btn-sm btn-outline-warning" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            <?php endif; ?>
                                            
                                            <a href="treatments/action.php?action=supprimer&id=<?= $tache['ID'] ?>" 
                                               class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Confirmer la suppression de la tâche #<?= $tache['ID'] ?> ?')" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center py-4">Aucune tâche trouvée.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>