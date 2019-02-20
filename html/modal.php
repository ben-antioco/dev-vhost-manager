<div class="modal modal_confirm">

    <div class="modal_title">Confirmez la suppression</div>

    <div class="modal_flex">
        <div class="confirm_btn">OUI</div>
        <div class="cancel_btn">NON</div>
    </div>
    
</div>


<div class="modal modal_edit">

    <div class="modal_close"><i class="fas fa-times-circle"></i></div>

    <div class="modal_title"></div>

    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">

        <div class="modal_flex_container">

            <div class="modal_edit_flex">

                <div class="field_container">

                    <label class="label_file" for="modal_edit_logo">

                        <img id="modal_edit_logo_img" src="">

                        <input id="modal_edit_logo" type="file" name="vhost_logo_edit">

                    </label>
                </div>

                
            </div>

            <div class="modal_edit_flex">

                <div class="field_container">
                    <label class="modal_label_field" for="modal_edit_vhost_name">Nom du vhost</label>
                    <input class="input_form_add" id="modal_edit_vhost_name" type="text" name="vhost_name_edit" required>
                </div>

                <div class="field_container">
                    <label class="modal_label_field" for="modal_edit_vhost_local_domain">Url du vhost</label>
                    <input class="input_form_add" id="modal_edit_vhost_local_domain" type="text" name="vhost_local_domain_edit" required>
                </div>

                <div class="field_container">

                    <label class="modal_label_field" for="modal_edit_vhost_local_domain">Environement du vhost</label>

                    <select class="select_form_add" name="env_edit" id="modal_edit_env" required>
                        <option value="local">Localhost</option>
                        <option value="dev">Developpement</option>
                        <option value="stag">Staging</option>
                        <option value="prod">Production</option>
                    </select>

                </div>
                
            </div>

        </div>

        <div>

            <div class="field_container">

                <label class="modal_label_field" for="modal_edit_vhost_local_domain">Détail ou memo du vhost</label>

                <textarea class="textarea_form_add" name="vhost_description_edit" id="modal_edit_vhost_description" cols="30" rows="5"></textarea>

            </div>

        </div>

        <div>

            <div class="field_container"><label class="modal_label_field" for="modal_edit_vhost_access">Ajouter des acces <span class="modal_vhost_access_add"><i class="fas fa-plus-square"></i></span></label></div>

            <div id="modal_acces_items" class="modal_flex_container"><!-- JS ADD --></div>

            <br>

            <input type="hidden" id="modal_edit_vhost_id" name="vhost_id_edit">

            <input type="hidden" name="vhost_edit_post" value="1">

            <div><button class="btn_form_add" type="submit">VALIDER</button></div>

        </div>

    </form>
    
</div>