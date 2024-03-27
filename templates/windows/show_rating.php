<?php
require_once ('./backend/helper.php'); ?>

<div id="show_rating" class="window">
    <div class="window-content">
        <div class="window-header">
            <h2>Просмотр своей оценки профессии</h2>
            <span class="close-rate-windows">&times;</span>
        </div>
        <div class="window-body">
            <h3>Ваша оценка:</h3>
            <div class="piq_list" id="choose_piq_list">
                <?php foreach (getPiqs() as $piq): ?>
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
            </div>

        </div>
    </div>
</div>