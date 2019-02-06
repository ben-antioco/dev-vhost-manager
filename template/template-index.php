<?php

    require_once './class/common-function.php';

    require_once './class/database.php';

    $db     = new database();

    $dbh    = $db->pdoConnexion();

    if( isset ( $_POST['hidden_post_form'] ) )
    {
        $checkVhost = $db->checkVhost( $_POST );

        if( !$checkVhost )
        {
            $addvhost   = $db->addVhost( $_POST, $_FILES );

            if( $addvhost ) 
            {
                //echo $addvhost;

                //header("Refresh:2; url=http://local.dom");

                header("Refresh:0; url=http://local.dom");
            }
        }
        else
        {
            //echo "<pre class='pre_top'>Le vhost existe !\n</pre>";

            //header("Refresh:2; url=http://local.dom");

            header("Refresh:0; url=http://local.dom");
        }
    }

    if( isset( $_POST['update_position'] ) )
    {
        $updatePositionItem = $db->updatePosition( $_POST['id'], $_POST['position'] );

        echo $updatePositionItem;

        exit;
    }

    if( isset( $_POST['delete_item'] ) )
    {
        $deleteItem = $db->deleteItem( $_POST['id'] );

        echo $deleteItem;
        
        exit;
    }

    if( isset( $_POST['hidden_post_view'] ) )
    {
        $paramId        = $_POST['hidden_post_view'];
        $view           = "block";
        $viewSelected   = $_POST['items_view'];

        if( $viewSelected != "view_block" ) $view = "list";

        $updateParam = $db->updateParams( $paramId, "view", $view );

        if( $updateParam )
        {
            //echo "<pre class='pre_top'>Mise à jour de la vue réussie !\n</pre>";

            //header("Refresh:2; url=http://local.dom");

            header("Refresh:0; url=http://local.dom");
        }
    }

    if( isset( $_POST['hidden_post_env'] ) )
    {
        $paramId        = $_POST['hidden_post_env'];

        $env = [
            "local" => 0,
            "dev"   => 0,
            "stag"  => 0,
            "prod"  => 0
        ];

        if( isset( $_POST['env_local'] ) ) $env['local'] = 1;
        if( isset( $_POST['env_dev'] ) ) $env['dev'] = 1;
        if( isset( $_POST['env_stag'] ) ) $env['stag'] = 1;
        if( isset( $_POST['env_prod'] ) ) $env['prod'] = 1;

        $updateParam = $db->updateParams( $paramId, "env", $env );

        if( $updateParam )
        {
            //echo "<pre class='pre_top'>Mise à jour des environements réussie !\n</pre>";

            //header("Refresh:2; url=http://local.dom");
            header("Refresh:0; url=http://local.dom");
        }
    }

    $datas      = $db->getAllVhostDatas();

    $params     = $db->getParams();

    $stateEnv   = false;

    if( $params['local'] == "1" && $params['dev'] === "1" && $params['stag'] === "1" && $params['prod'] === "1" )
    {
        $stateEnv = true;
    }


    $dbh    = null;