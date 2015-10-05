<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['datatables', 'dialogs']]);
    $color = $this->session->userdata('ASESOR') ? '#099a5b' : '#3D8EBC';
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 style="text-align: center;color: <?= $color ?>;"><span style="font-size: 25pt;"
                                                                               class="ios ion-android-list"></span>&nbsp;
                        Listado <?= pathinfo(__FILE__)['filename'] ?></h3>
                </div>
                <div class="box-body">
                    <?= Component::Table(['columns' => ['Nombre', 'Tipo de proyecto', 'Asesor', '#Practicantes'],
                        'tableName' => 'proyecto', 'autoNumeric' => true, 'id' => 'ID_PROYECTO', 'controller' => 'proyectos',
                        'fields' => ['NOMBRE_PROYECTO', 'NOMBRE_TIPO_PROYECTO', 'NOMBRE_USUARIO', 'PRACTICANTES',]
                        , 'dataProvider' => $this->session->userdata('ADMIN') ? $this->proyectos_model->TraeProyectos() : $this->proyectos_model->TraeProyectosAsesor(),
                        'actions' => $this->session->userdata('ADMIN') ? 'duv' : 'v']) ?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</section>

<?= $this->Footer() ?>


<script type="text/javascript">
    $(function () {
        $("#tabla").dataTable();

        $('body').on('click', 'a[data-id]', function () {
            Alert($(this + '[data-id]').data('id'), '<?=site_url('proyectos/eliminarproyecto') ?>');
        });

        function Alert(id, url) {
            BootstrapDialog.show({
                title: '<span class="ion ion-android-delete" style="font-size: 20pt;font-weight: bold; color: white;"></span>&nbsp;&nbsp;&nbsp; <span  style="font-size: 18pt;">Atención!</span>',
                type: BootstrapDialog.TYPE_DANGER,
                draggable: true,
                message: 'Está seguro que desea eliminar este ' + $('#tabla').data('name') + '?</span>',
                buttons: [{
                    label: 'Aceptar',
                    cssClass: 'btn-danger',
                    action: function () {
                        $.post(url, {Id: id}, function () {
                            location.href = '';
                        });
                    }
                },
                    {
                        label: 'Cancelar',
                        action: function (dialogItself) {
                            dialogItself.close();
                        }
                    }]
            });
        }
    });


</script>