<h2><?= esc($title) ?></h2>

<?php if (! empty($activities) && is_array($activities)): ?>

    <?php foreach ($activities as $activities_item): ?>

        <h3><?= esc($activities_item['title']) ?></h3>

        <div class="main">
            <?= esc($activities_item['body']) ?>
        </div>
        <p><a href="/activities/<?= esc($activities_item['slug'], 'url') ?>">View activity</a></p>

    <?php endforeach ?>

<?php else: ?>

    <h3>No Activities</h3>

    <p>Unable to find any activities for you.</p>

<?php endif ?>