<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <link href="<?= URL::to('assets/css/inputFile.css') ?>" rel="stylesheet" />

        <form method="post" enctype="multipart/form-data" id="formFileUpload">
            <input type="file" name="idarchivo">
            <p>Arrastra tu archivo aquí o haz clic en esta área.</p>
            <button id="btnUploadFile" type="submit" class="btn btn-primary" >UpLoad  <span class="glyphicon glyphicon-ok"></span></button>
        </form>
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <script>
            $(document).ready(function () {
                $('form input').change(function () {
                    $('form p').text(this.files.length + " file(s) selected");
                });
            });
        </script>
        <script src="<?= URL::to("assets/js/modules/loadInformation.js") ?>" type="text/javascript"></script>

    </body>
</html>