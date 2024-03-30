<?php
require_once ('./backend/helper.php');

$profId = null;
$expertId = null;
if (isset($_POST['profId'])) {
    $profId = $_POST['profId'];
    $expertId = $_POST['expertId'];
}

?>



<div id="show_rating" class="window">
    <div class="window-content">
        <div class="window-header">
            <h2>Просмотр своей оценки профессии</h2>
            <span class="close-rate-windows">&times;</span>
        </div>
        <div class="window-body">
            <?php if (!is_null($profId) && !is_null($expertId)): ?>
                <h3>Ваша оценка:</h3>
                <div class="rate_list" id="rate_list">
                    <?php foreach (getRatingBy($profId, $expertId) as $piq): ?>
                        <?php
                        $piq_name = $piq['name'];
                        $piq_id = $piq['id'];
                        ?>
                        <label for="piq_<?php echo $piq_id; ?>">
                            <div class="piq_item" id="piq_item_<?php echo $piq['id']; ?>">
                                <input type="checkbox" id="piq_<?php echo $piq_id; ?>" title="<?php echo $piq_name; ?>"
                                    name="piqs[]" class="piq_checkbox">
                                <?php echo $piq_name; ?>
                            </div>
                        </label>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h3>Не удалось найти ваши оценки</h3>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>