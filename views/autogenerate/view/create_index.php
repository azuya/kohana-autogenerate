<h1><?php echo Inflector::plural($className); ?></h1><p><?php echo '<?php echo Html::anchor(\''.strtolower($className).'\new\', \'New\', array(\'class\' => \'btn btn-primary\')); ?>'; ?></p><table class="table table-bordered"><thead>	<tr>		<td>Show</td>		<td>Edit</td>		<td>Delete</td>	</tr></thead><tbody><?php echo "<?php foreach($".strtolower($className)."All as $".strtolower($className)."): ?>"; ?>		<tr>		<td><?php echo '<?php echo Html::anchor("'.strtolower($className).'/show/{$'.strtolower($className).'->id}", "Show"); ?>'; ?></td>		<td><?php echo '<?php echo Html::anchor("'.strtolower($className).'/edit/{$'.strtolower($className).'->id}", "Edit"); ?>'; ?></td>		<td><?php echo '<?php echo Html::anchor("'.strtolower($className).'/delete/{$'.strtolower($className).'->id}", "Delete"); ?>'; ?></td>	</tr><?php echo "<?php endforeach; ?>"; ?></tbody></table>