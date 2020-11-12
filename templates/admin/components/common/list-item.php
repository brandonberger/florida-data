<div class="col-6">
    <?= ($this->link) ? '<a href="'.$this->link.'">' : ''; ?>
    <div class="list-item align-items-center d-flex" style="background-color:#<?= $this->color ?>">
        <div class="pl-4"><?=$this->title?></div>
    </div>
    <?= ($this->link) ? '</a>' : ''; ?>
</div>