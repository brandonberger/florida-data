<div class="col-10 p-0 d-flex justify-content-between flex-wrap">
<?php foreach ($this->counties as $county) { ?>
    <?= $this->partial('templates/admin/components/common/list-item.php', [
        'title' => $county->getName(), 
        'color' => $county->findColor($county->getName()),
        'link' => $county->getId().'/cities/'
        ]); 
    ?>
<?php } ?>
</div>