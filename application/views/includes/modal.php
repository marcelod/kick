<div class="modal-dialog <?php if (isset($modal_class)): echo $modal_class; endif ?>">

    <div class="modal-content">
        <?php if ($title_modal): ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title "><?php echo $title_modal; ?></h4>
            </div>
        <?php endif ?>
        <div class="modal-body">
            <div class="te">
                <?php if ( ! $title_modal): ?>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <?php endif ?>
                <?php echo $content_modal; ?>
            </div>
        </div>

        <?php if ($buttons_modal): ?>
            <div class="modal-footer">
                <?php foreach ($buttons_modal as $key => $value): ?>

                    <?php if ($key === 'close' || $value === 'close'): ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <?php echo is_int($key) ? "Fechar" : $value; ?>
                        </button>
                    <?php endif ?>

                    <?php if ($key === 'previous' || $value === 'previous'): ?>
                        <button type="button" class="btn btn-danger" id="previous">
                            <?php echo is_int($key) ? "Anterior" : $value; ?>
                        </button>
                    <?php endif ?>

                    <?php if ($key === 'next' || $value === 'next'): ?>
                        <button type="button" class="btn btn-primary" id="next">
                            <?php echo is_int($key) ? "Próximo" : $value; ?>
                        </button>
                    <?php endif ?>


                    <?php if ($key === 'save' || $value === 'save'): ?>
                        <button type="button" class="btn btn-primary" id="save">
                            <?php echo is_int($key) ? "Salvar" : $value; ?>
                        </button>
                    <?php endif ?>

                    <?php if ($key === 'saveEdit' || $value === 'saveEdit'): ?>
                        <button type="button" class="btn btn-primary" id="saveEdit">
                            <?php echo is_int($key) ? "Salvar" : $value; ?>
                        </button>
                    <?php endif ?>

                    <?php if ($key === 'delete' || $value === 'delete'): ?>
                        <button type="button" class="btn btn-danger" id="remove">
                            <?php echo is_int($key) ? "Apagar" : $value; ?>
                        </button>
                    <?php endif ?>

                <?php endforeach ?>
            </div>
        <?php endif ?>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->