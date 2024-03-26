<div id="rate_piqs" class="window">
    <div class="window-content">
        <div class="window-header">
            <h2>Выбор ПВК для профессии</h2>
            <span class="close-rate-windows">&times;</span>
        </div>
        <div class="window-body">
            <h3>Оцените значимость каждого ПВК (от 0 до 10 включительно, различными числами):</h3>
            <div class="piq_list" id="rate_piq_list">
                <?php foreach (getPiqs() as $piq): ?>
                    <div class="piq_control_item" id="piq_control_item_<?php echo $piq['id']; ?>"
                        value="<?php echo $piq_id; ?>">
                        <?php $piq_name = $piq['name'];
                        $piq_id = $piq['id']; ?>
                        <!-- <div class="piq_control" id="piq_control_<?php echo $piq_id; ?>" value="<?php echo $piq_id; ?>">
                            <button class="piq_up" data-list-id="piq_list" piq-id="<?php echo $piq_id; ?>">&#8593;</button>
                            <button class="piq_down" data-list-id="piq_list" piq-id="<?php echo $piq_id; ?>"
                                data-direction="down">&#8595;</button>
                        </div> -->
                        <p class="piq_imp_text">
                            <?php echo $piq_name; ?>
                        </p>
                        <input type="text" id="piq_imp_<?php echo $piq_id; ?>" class="piq_imp"
                            piq_id="<?php echo $piq_id; ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        <button type="button" id="rate-button2" class="rate-button">
            Оценить профессию
        </button>
        </div>
    </div>
</div>