<div class="page-header">
    <h3><?php echo __('Semester bearbeiten'); ?></h3>
</div>

<div class="well ">
    <?php echo $this->Form->create('Term', array('class' => 'form')); ?>

    <div class="control-group">
        <label class="control-label"><?php echo __('Semester-Bezeichnung'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('name', array('required' => true, 'label' => false, 'class' => 'span3')); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><?php echo __('Von'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('start', array('id' => 'start', 'required' => true, 'type' => 'text', 'dateFormat' => 'DMY', 'label' => false)); ?>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label"><?php echo __('Bis'); ?></label>

        <div class="controls">
            <?php echo $this->Form->input('end', array('id' => 'end', 'required' => true, 'type' => 'text', 'dateFormat' => 'DMY', 'label' => false)); ?>
        </div>
    </div>

    <div class="control-group">
        <hr/>
        <input type="submit" class="btn btn-primary btn-medium" value="<?php echo __('Speichern'); ?>"/>
        <input type="button" class="btn btn-danger btn-medium" value="<?php echo __('Löschen'); ?>"
               data-id=""
               data-confirm="<?php echo __('Wirklich löschen?'); ?>"
               data-url="<?php echo Router::url('/admin/terms/delete/') . $this->Form->value('Term.id'); ?>"/>
    </div>
    <?php echo $this->Form->end(); ?>
</div>

<div class="row-fluid">
    <div class="span12">
        <?php echo $this->Html->link(__('All Semester anzeigen'), array('action' => 'index'), array('class' => 'btn btn-medium')); ?>
        <?php echo $this->Html->link(__('Kurs für dieses Semester anlegen'), array('controller' => 'courses', 'action' => 'add'), array('class' => 'btn btn-medium')); ?>
    </div>
</div>

<?php echo $this->Html->css('jquery-ui-custom/css/flick/jquery-ui-1.10.2.custom.min'); ?>
<?php echo $this->Html->script('terms/admin/edit'); ?>