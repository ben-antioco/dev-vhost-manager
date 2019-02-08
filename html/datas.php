<div class="data_container">

    <div class="search_container"><input class="field_search" type="text" name="research" placeholder="Rechercher un vhost..."></div>

    <?php if ( $params['view'] === "block" ): ?>

        <div class="flex_item_container data_items">

            <?php if ( $datas ): foreach( $datas as $data ): if( $params[$data["env"]] === "1" ): ?>


                <div data-id="<?php echo $data['id']; ?>" class="data_item keyword_data">

                    <div class="in_data_item color_<?php echo $data['env']; ?>">

                        <div data-id="<?php echo $data['id']; ?>" class="item_params">
                            <?php if( $stateEnv ): ?><div class="param_move"><i class="fas fa-grip-horizontal"></i></div><?php endif; ?>
                            <div class="param_edit"><i class="fas fa-edit"></i></div>
                            <div class="param_delete"><i class="fas fa-window-close"></i></div>
                        </div>

                        <a href="<?php echo $data['vhost_local_domain']; ?>" target="_blank">

                            <div class="item_vhost_img" style="background-image: url(./uploads/<?php echo $data['vhost_logo']; ?>);">
                                <div class="item_vhost_env color_<?php echo $data['env']; ?>"><?php echo $data['env']; ?></div>
                            </div>

                            <div class="item_vhost_name"><?php echo $data['vhost_name']; ?></div>

                            <div class="item_vhost_domain"><?php echo $data['vhost_local_domain']; ?></div>

                            <div class="item_vhost_position"><?php echo $data['position']; ?></div>

                        </a>

                    </div>

                </div>

        <?php endif; endforeach; endif; ?>

        </div>

    <?php elseif ( $params['view'] === "list" ): ?>

    <div class="list_items_container">

        <?php if ( $datas ): foreach( $datas as $data ): if( $params[$data["env"]] === "1" ): ?>

            <div data-id="<?php echo $data['id']; ?>" class="list_item keyword_data">

                <div class="list_item_action">

                    <div data-id="<?php echo $data['id']; ?>" class="list_item_params">
                        <?php if( $stateEnv ): ?><div class="param_move"><i class="fas fa-grip-horizontal"></i></div><?php endif; ?>
                        <div class="param_delete"><i class="fas fa-window-close"></i></div>
                    </div>

                </div>

                <a href="<?php echo $data['vhost_local_domain']; ?>" target="_blank">

                    <div class="list_item_content">

                        <div class="list_item_img" style="background-image: url(./uploads/<?php echo $data['vhost_logo']; ?>);"></div>

                        <div class="list_item_text">

                            <div class="list_item_vhost_name"><?php echo $data['vhost_name']; ?></div>

                            <div class="list_item_vhost_domain"><?php echo $data['vhost_local_domain']; ?></div>

                            <div class="list_item_vhost_domain"><?php echo $data['env']; ?></div>

                            <div class="list_item_vhost_domain"><?php echo $data['position']; ?></div>

                        </div>

                    </div>

                </a>

            </div>

        <?php endif; endforeach; endif; ?>

        </div>

    <?php endif; ?>

</div>