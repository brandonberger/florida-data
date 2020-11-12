<div class="col-10 p-0 d-flex justify-content-between flex-wrap">
<?php foreach ($this->states as $state) { ?>
    <?= $this->partial('templates/admin/components/common/list-item.php', [
        'title' => $state->getState(), 
        'color' => $state->findColor($state->getState()),
        'link' => 'states/'.$state->getId().'/counties/'
        ]); 
    ?>
<?php } ?>
</div>