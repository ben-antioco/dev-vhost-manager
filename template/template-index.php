<?php

    require_once './class/dump.php';

    require_once './class/CommonFunction.php';

    $com = new CommonFunction();

    require_once './class/Database.php';

    $db         = new Database();
    $dbh        = $db->pdoConnexion();

    if( isset( $_POST['get_update'] ) )
    {
        $output = shell_exec('git status -s && git pull');

        echo $output;

        exit;
    }


    if( isset ( $_POST['hidden_post_form'] ) )
    {
        $checkVhost = $db->checkVhost( $_POST );

        if( !$checkVhost )
        {
            $addvhost   = $db->addVhost( $_POST, $_FILES );

            if( $addvhost ) 
            {
                header("Refresh:0; url=http://local.dom?result=success&type=vhost_add");
            }
        }
        else
        {
            header("Refresh:0; url=http://local.dom?result=error&type=vhost_add");
        }
    }

    if( isset( $_POST['update_position'] ) )
    {
        $updatePositionItem = $db->updatePosition( $com->formFilterData( $_POST['id'] ), $com->formFilterData( $_POST['position'] ) );

        echo $updatePositionItem;

        exit;
    }

    if( isset( $_POST['delete_item'] ) )
    {
        $deleteItem = $db->deleteItem( $com->formFilterData( $_POST['id'] ) );

        echo $deleteItem;
        
        exit;
    }

    if( isset( $_POST['hidden_post_view'] ) )
    {
        $paramId        = $com->formFilterData( $_POST['hidden_post_view'] );
        $view           = "block";
        $viewSelected   = $com->formFilterData( $_POST['items_view'] );

        if( $viewSelected != "view_block" ) $view = "list";

        $updateParam = $db->updateParams( $paramId, "view", $view );

        if( $updateParam )
        {
            header("Refresh:0; url=http://local.dom?result=success&type=view");
        }
    }

    if( isset( $_POST['hidden_post_env'] ) )
    {
        $paramId        = $com->formFilterData( $_POST['hidden_post_env'] );

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
            header("Refresh:0; url=http://local.dom?result=success&type=env");
        }
    }

    if( isset( $_POST['edit_item_get'] ) )
    {
        $editItemGet = $db->selectVhost( $com->formFilterData( $_POST['id'] ) );

        echo json_encode( $editItemGet );
        
        exit;
    }

    if( isset( $_POST['vhost_edit_post'] ) && isset( $_FILES['vhost_logo_edit'] )  )
    {
        $access = [];

        $access["vhost_id"] = $_POST['vhost_id_edit'];
        
        if( isset( $_POST['vhost_access_label_edit'] ) )
        {
            $acces_label = $_POST['vhost_access_label_edit'];

            foreach( $acces_label as $key => $label )
            {
                $access[$key]["vhost_access_label"] = $label;
            }
        }

        if( isset( $_POST['vhost_access_login_edit'] ) )
        {
            $acces_login = $_POST['vhost_access_login_edit'];

            foreach( $acces_login as $key => $login )
            {
                $access[$key]["vhost_access_login"] = $login;
            }
        }

        if( isset( $_POST['vhost_access_password_edit'] ) )
        {
            $acces_password = $_POST['vhost_access_password_edit'];

            foreach( $acces_password as $key => $password )
            {
                $access[$key]["vhost_access_password"] = $password;
            }
        }

        $vhostUpdate = false;

        if( ( $_FILES['vhost_logo_edit']['name'] != '' ) && ( $_FILES['vhost_logo_edit']['tmp_name'] != '' ) && ( $_FILES['vhost_logo_edit']['size'] >= 1 ) )
        {
            $vhostUpdate    = $db->updateVhost( $_POST, $_FILES );
        }
        else
        {
            $vhostUpdate    = $db->updateVhost( $_POST );
        }

        if( $vhostUpdate )
        {
            if( count( $access ) >= 1 )
            {
                $AddAccess    = $db->addAccessVhost( $access );
            }

            header("Refresh:0; url=http://local.dom?result=success&type=vhost_update");
        }
        else
        {
            header("Refresh:0; url=http://local.dom?result=error&type=vhost_update");
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