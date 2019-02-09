<?php

    class database 
    {
        private $host;
        private $db_name;
        private $db_user;
        private $db_userpass;
        private $com;

        public function __construct()
        {
            require_once dirname( dirname( __FILE__ ) ).'/config.php';

            $this->host         = $conf_host;
            $this->db_name      = $conf_db_name;
            $this->db_user      = $conf_db_user;
            $this->db_userpass  = $conf_db_userpass;

            require_once dirname( __FILE__ ).'/common-function.php';

            $this->com  = new commonFunction();
        }

        public function pdoConnexion()
        {
            $dbh = new PDO( "mysql:host=".$this->host."; dbname=".$this->db_name, $this->db_user, $this->db_userpass );

            return $dbh;
        }

        /**
         * CHECK VHOST
         * @param {array} $_POST
         * @return array
         */
        public function checkVhost( $post )
        {
            $vhost_name             = $this->com->formFilterData( $post['vhost_name'] );
            $vhost_local_domain     = $this->com->formFilterData( $post['vhost_local_domain'] );
            $vhost_env              = $this->com->formFilterData( $post['vhost_env'] );

            $dbh    = $this->pdoConnexion();

            $sql    =  "SELECT id FROM vhost WHERE vhost_name=:vhost_name AND vhost_local_domain=:vhost_local_domain AND env=:env";

            $stmt   = $dbh->prepare( $sql );

            $stmt->execute( [ 'vhost_name' => $vhost_name, 'vhost_local_domain' => $vhost_local_domain, 'env' => $vhost_env ] );

            $data = $stmt->fetch();

            $dbh  = null;

            return $data;
        }

        
        public function getAllVhostDatas()
        {
            $dbh    = $this->pdoConnexion();

            $getDatas = $dbh->prepare("SELECT * FROM vhost ORDER BY position ASC");

            $getDatas->execute();

            $datas = $getDatas->fetchAll();

            $dbh    = null;

            return $datas;
        }

        public function addVhost( $post, $file )
        {
            $result = false;

            if ( isset( $post['vhost_name'] ) && isset( $post['vhost_local_domain'] ) && isset( $file ) )
            {
                $uploadfile = $this->uploadFile( $file );

                if( $uploadfile['result'] )
                {
                    $filename   = $uploadfile['filename'];

                    $vhosts     = $this->getAllVhostDatas();
                    $count      = count( $vhosts );
                    $position   = $count +1;

                    $dbh        = $this->pdoConnexion();

                    $stmt       = $dbh->prepare("INSERT INTO vhost (vhost_name, vhost_local_domain, vhost_logo, position, env) VALUES (:vhost_name, :vhost_local_domain, :vhost_logo, :position, :env)");

                    $stmt->bindParam(':vhost_name', $this->com->formFilterData( $post['vhost_name'] ) );

                    $stmt->bindParam(':vhost_local_domain', $this->com->formFilterData( $post['vhost_local_domain'] ) );

                    $stmt->bindParam(':vhost_logo', $filename);

                    $stmt->bindParam(':position', $position);

                    $stmt->bindParam(':env', $post['vhost_env']);

                    $stmt->execute();

                    $result = $uploadfile['echo'];
                }

                $dbh    = null;

                return $result;
            }
        }

        public function updateVhost( $post, $file=false )
        {
            $result     = false;

            $dbh    = $this->pdoConnexion();

            $sql    =  "SELECT id FROM vhost WHERE id=:id";

            $stmt   = $dbh->prepare( $sql );

            $stmt->execute( [ 'id' => $post['vhost_id_edit']  ] );

            $checkVhost = $stmt->fetch();

            if( $checkVhost )
            {
                $data = [
                    'vhost_name' => $post['vhost_name_edit'],
                    'vhost_local_domain' => $post['vhost_local_domain_edit'],
                    'env' => $post['env_edit'],
                    'vhost_description' => $post['vhost_description_edit'],
                    'id' => $post['vhost_id_edit']
                ];


                if( $file )
                {
                    $uploadfile = $this->uploadFile( $file );

                    if( $uploadfile['result'] )
                    {
                        $filename           = $uploadfile['filename'];
                        $data['vhost_logo'] = $filename;
                     }
                }

                

                $sql    = "UPDATE vhost SET vhost_name=:vhost_name, vhost_local_domain=:vhost_local_domain, env=:env, vhost_description=:vhost_description WHERE id=:id";
                
                $stmt   = $dbh->prepare( $sql );

                if( $stmt->execute( $data ) )
                {
                    $result = "success";
                }
            }

            return $result;
        }

        public function uploadFile( $file )
        {
            $result     = false;

            $name       = $file["vhost_logo"]["name"];

            $tmp        = explode( ".", $name );
            $ext        = end( $tmp );

            $datetime   = new Datetime();
            
            $filename   = $datetime->format( 'YmdHis' ).".".$ext;

            $uploaddir  = './uploads/';

            $uploadfile = $uploaddir . $filename;

            if ( move_uploaded_file( $file['vhost_logo']['tmp_name'], $uploadfile ) ) 
            {
                $echo   = "success";
                $result = true;
            } 
            else 
            {
                $echo   =  "error"; 
            }

            return [
                'filename'  => $filename,
                'echo'      => $echo,
                'result'    => $result
            ];
        }


        public function updatePosition( $id, $position )
        {
            $result = "La mise à jour de la position a échouée !";

            $dbh    = $this->pdoConnexion();

            $data   = [
                'position'  => (int)$position,
                'id'        => $id
            ];

            $sql    = "UPDATE vhost SET position=:position WHERE id=:id";
            $stmt   = $dbh->prepare( $sql );

            if( $stmt->execute( $data ) )
            {
                $result = "La mise à jour de la position réussie !";
            }

            $dbh = null;

            return $result;
        }

        public function selectVhost( $id )
        {
            $dbh    = $this->pdoConnexion();

            $sql    =  "SELECT * FROM vhost WHERE id=:id";

            $stmt   = $dbh->prepare( $sql );

            $stmt->execute( [ 'id' => $id ] );

            $data   = $stmt->fetch();

            $dbh    = null;

            return $data;
        }

        public function deleteItem( $id )
        {
            $result = "error";

            $dbh    = $this->pdoConnexion();

            $vhost  = $this->selectVhost( $id );

            if( $vhost )
            {
                $sql    = "DELETE FROM vhost WHERE id=:id";
                $stmt   = $dbh->prepare( $sql );

                $stmt->bindParam( ':id', $id );   
                $stmt->execute();

                if( $stmt->execute() )
                {
                    $result = "success";

                    if ( file_exists( './uploads/'.$vhost['vhost_logo'] ) ) 
                    {
                        unlink( './uploads/'.$vhost['vhost_logo'] );
                    }
                }
            }

            $dbh    = null;

            return $result;
        }

        public function getParams()
        {
            $dbh        = $this->pdoConnexion();

            $getData    = $dbh->prepare("SELECT * FROM params");

            $getData->execute();

            $data       = $getData->fetchAll();

            if( $data ) $data = $data[0];

            $dbh    = null;

            return $data;
        }

        public function updateParams( $id, $paramType, $dataValue )
        {

            if( $paramType === "view" ) 
            {
                $result = false;

                $dbh    = $this->pdoConnexion();

                $data = [
                    'view' => $this->com->formFilterData( $dataValue ),
                    'id' => $id
                ];

                $sql = "UPDATE params SET view=:view WHERE id=:id";

                $stmt= $dbh->prepare($sql);

                if( $stmt->execute( $data ) )
                {
                    $result = true;
                }
            }

            if( $paramType === "env" ) 
            {
                $result     = false;

                $dbh        = $this->pdoConnexion();

                $data       = $this->com->formFilterData( $dataValue );

                $data['id'] = $id;

                $sql        = "UPDATE params SET local=:local, dev=:dev, stag=:stag, prod=:prod WHERE id=:id";

                $stmt       = $dbh->prepare($sql);

                if( $stmt->execute( $data ) )
                {
                    $result = true;
                }
            }

            $dbh    = null;

            return $result;
        }
    }