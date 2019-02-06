<div id="nav_hover" class="nav_hover"><i class="fas fa-angle-left nav_open"></i></div>

<div id="nav_container" class="nav_container">

    <div class="nav_close"><i class="far fa-times-circle"></i></div>

    <div class="nav_title">Ajouter un vhost</div>

    <div class="form_container">

        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">

            <div class="flex_container">

                <div class="field_container field_label">Nom du vhost</div>

                <div class="field_container"><input class="input_form_add" type="text" name="vhost_name" placeholder="Vhost name"></div>

                <div class="field_container field_label">Domaine du vhost</div>

                <div class="field_container"><input class="input_form_add" type="text" name="vhost_local_domain" placeholder="Vhost local domain"></div>

                <div class="field_container field_label">Logo du vhost</div>

                <div class="field_container"><label class="label_file" for="vhost_logo">Vhost logo<input id="vhost_logo" class="" type="file" name="vhost_logo"></label></div>

                <div class="field_container field_label">Environement</div>

                <div class="field_container">
                    <select class="select_form_add" name="vhost_env">
                        <option value="local">local</option>
                        <option value="dev">dev</option>
                        <option value="stag">staging</option>
                        <option value="prod">prod</option>
                    </select>
                </div>

                <input type="hidden" name="hidden_post_form" value="1">

                <div class="field_container"><button class="btn_form_add" type="submit">VALIDER</button></div>

            </div>

        </form>

    </div>

    <div class="nav_title">Affichage</div>

    <div class="form_container">

        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

            <div class="flex_container">

                <div class="field_container"><label for="view_block"><input id="view_block" type="radio" name="items_view" value="view_block" <?php if ($params['view'] === "block" ): echo "checked"; endif;?>>Vue en block</label></div>
                <div class="field_container"><label for="view_list"><input id="view_list" type="radio" name="items_view" value="view_list"<?php if ($params['view'] === "list" ): echo "checked"; endif;?>>Vue en liste</label></div>

                <input type="hidden" name="hidden_post_view" value="<?php echo $params['id'];?>">

                <div class="field_container"><button class="btn_form_add" type="submit">VALIDER</button></div>
            </div>

        </form>

    </div>

    <div class="form_container">

        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

            <div class="flex_container">

                <div class="field_container">
                    <label for="env_local"><input id="env_local" type="checkbox" name="env_local" value="local" <?php if ($params['local'] === "1" ): echo "checked"; endif;?>>Local</label>
                </div>

                <div class="field_container">
                    <label for="env_dev"><input id="env_dev" type="checkbox" name="env_dev" value="dev" <?php if ($params['dev'] === "1" ): echo "checked"; endif;?>>Développement</label>
                </div>

                <div class="field_container">
                    <label for="env_stag"><input id="env_stag" type="checkbox" name="env_stag" value="stag"<?php if ($params['stag'] === "1" ): echo "checked"; endif;?>>Staging</label>
                </div>

                <div class="field_container">
                    <label for="env_prod"><input id="env_prod" type="checkbox" name="env_prod" value="prod"<?php if ($params['prod'] === "1" ): echo "checked"; endif;?>>Production</label>
                </div>

                <input type="hidden" name="hidden_post_env" value="<?php echo $params['id'];?>">

                <div class="field_container"><button class="btn_form_add" type="submit">VALIDER</button></div>
            </div>

        </form>

    </div>

</div>