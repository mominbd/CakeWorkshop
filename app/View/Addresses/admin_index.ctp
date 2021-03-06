<div class="page-header">
    <h3><?php echo __('Rechnungsadressen'); ?></h3>
</div>

<table class="table table-bordered table-striped table-condensed table-hover">
    <tr>
        <th><?php echo $this->Paginator->sort('user_id', __('Teilnehmer')); ?></th>
        <th><?php echo $this->Paginator->sort('institution', __('Einrichtung')); ?></th>
        <th><?php echo $this->Paginator->sort('department', __('Fachbereich')); ?></th>
        <th><?php echo $this->Paginator->sort('postbox', __('Postfach')); ?></th>
        <th><?php echo $this->Paginator->sort('to_person', __('z. Hd.')); ?></th>
        <th><?php echo $this->Paginator->sort('street', __('Straße')); ?></th>
        <th><?php echo $this->Paginator->sort('zip', __('PLZ')); ?></th>
        <th><?php echo $this->Paginator->sort('location', __('Ort')); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($addresses as $address): ?>
        <tr>
            <td>
                <?php echo $this->Html->link($address['User']['name'], array('controller' => 'users', 'action' => 'view', $address['User']['id'])); ?>
            </td>
            <td><?php echo h($address['Address']['institution']); ?>&nbsp;</td>
            <td><?php echo h($address['Address']['department']); ?>&nbsp;</td>
            <td><?php echo h($address['Address']['postbox']); ?>&nbsp;</td>
            <td><?php echo h($address['Address']['to_person']); ?>&nbsp;</td>
            <td><?php echo h($address['Address']['street']); ?>&nbsp;</td>
            <td><?php echo h($address['Address']['zip']); ?>&nbsp;</td>
            <td><?php echo h($address['Address']['location']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $address['Address']['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $address['Address']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $address['Address']['id']), null, __('Are you sure you want to delete # %s?', $address['Address']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
    ?>    </p>

<div class="paging">
    <?php
    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>