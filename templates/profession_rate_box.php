<?php $professions = getProfessions();
if (empty ($professions)): ?>
    <p style="font-family: Times new roman; font-size: 24px;">Сюда ещё не добавлены профессии</p>
<?php else: ?>
    <?php foreach ($professions as $profession): ?>
        <div class="profession-box">
            <h2>
                <?php echo $profession['name']; ?>
            </h2>
            <p>
                <?php echo $profession['description']; ?>
            </p>
            <button class="pvc-button">Показать рейтинг ПВК</button>
            <dl class="pvc-list">
                <?php $results = getProfResultRating($profession['id'], 10);
                if (empty ($results)): ?>
                    <p>Для данной профессии ещё нет оценок</p>
                <?php else: ?>
                    <?php foreach ($results as $piq_id => $result): ?>
                        <?php $importance = round($result['importance'] * 100);
                        $piq = $result['piq']; ?>
                        <?php echo $piq['name']; ?>
                        <br>
                        <div class="progress-bar"
                            style="width: 90%; background: linear-gradient(to right, red <?php echo $importance; ?>%, white 0%);">
                        </div>
                        <div class="progress">
                            <?php echo $importance . '%'; ?>
                        </div>
                        <br>
                    <?php endforeach; ?>
                <?php endif; ?>
                <br>
                <br>
                <!-- в name будет ид профессии и ид эксперта -->
                <?php
                $userId = getCurrentUser()['id'];
                $profId = $profession['id'];
                if (empty (getRatingBy($userId, $profId))):
                    ?>
                    <div class="button-container">
                        <button type="button" name="<?php echo $profId; ?>_<?php echo $userId; ?>" id="rate-button"
                            class="button">Оценить профессию</button>
                    </div>
                <?php else: ?>
                    <div class="button-container">
                        <button type="button" name="<?php echo $profId; ?>_<?php echo $userId; ?>" id="view-rating-button"
                            class="view-rating-button">Посмотреть свою оценку</button>
                        <form method="post" action="backend/delete_rate.php">
                            <input style='display: none;' name="delete_rate" value="<?php echo $profId;?>">
                            <button type="submit" class="button">Удалить свою оценку</button>
                        </form>
                    </div>
                <?php endif; ?>
            </dl>
        </div>
    <?php endforeach; ?>
<?php endif; ?>