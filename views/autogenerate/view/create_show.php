<h1>Show <?php echo $className; ?></h1><p><?php echo '<?php echo Html::anchor("'.strtolower($className).'/edit/{$'.strtolower($className).'->id}", "Edit", array("class" => "btn btn-primary")); ?>'; ?> &nbsp; <?php echo '<?php echo Html::anchor("'.strtolower($className).'/index", "Back", array("class" => "btn")); ?>'; ?></p>