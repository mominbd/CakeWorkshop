<div class="users view">
    <p class="lead"><?php  echo __('Daten des Benutzers: '. h($user['User']['firstname']) . ' ' . h($user['User']['lastname'])); ?></p>

	<dl>
		<dt><?php echo __('Geschlecht'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Gender']['name'], array('controller' => 'genders', 'action' => 'view', $user['Gender']['id'])); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Titel'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Title']['name'], array('controller' => 'titles', 'action' => 'view', $user['Title']['id'])); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Department'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Department']['name'], array('controller' => 'departments', 'action' => 'view', $user['Department']['id'])); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Occupation'); ?></dt>
		<dd>
            <?php echo h($user['User']['occupation']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Hrz'); ?></dt>
		<dd>
			<?php echo h($user['User']['hrz']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($user['User']['phone']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($user['User']['active']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>

	</dl>
</div>

<div class="related">
	<h3><?php echo __('Gebuchte Kurse'); ?></h3>
	<?php if (!empty($user['CoursesTerm'])): ?>
        <table class="table table-bordered">
        <tr>
            <th><?php echo __('Semester'); ?></th>
            <th><?php echo __('Kurs'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php
            $i = 0;
            foreach ($user['CoursesTerm'] as $coursesTerm): ?>
            <tr>
                <td><?php echo $coursesTerm['Term']['name']; ?></td>
                <td><?php echo $coursesTerm['Course']['name']; ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'courses_terms', 'action' => 'view', $coursesTerm['Booking']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'courses_terms', 'action' => 'edit', $coursesTerm['Booking']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'courses_terms', 'action' => 'delete', $coursesTerm['Booking']['id']), null, __('Are you sure you want to delete # %s?', $coursesTerm['Booking']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
